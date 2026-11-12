<?php
namespace Pelago\Emogrifier {
	class CssInliner
	{
		public static function fromHtml($html) { return new self(); }
		public function inlineCss($css) { return $this; }
		public function render() { return ''; }
	}
}

namespace {
	class Kint { public static $enabled_mode; }
	class LPmailer
	{
		public $Subject, $Body, $AltBody;
		public function AddAddress($to, $name) {}
		public function SetFrom($from, $name) {}
		public function AddBCC($to, $name) {}
		public function clearAddresses() {}
		public function Send() {
			global $fixture;
			file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/mails', "sent\n", FILE_APPEND);
			if (!empty($fixture['marker_write_fails'])) {
				mkdir($_SERVER['DOCUMENT_ROOT'] . '/mail_sent/payment-confirmation-tr_TestPayment.sent');
			}
			return true;
		}
	}

	function d(...$values) {}
	function quote($value) { return "'" . addslashes($value) . "'"; }
	function select_query($query, $index = 2) {
		global $fixture;
		return str_starts_with($query, 'SELECT dankmail_verzonden')
			? ['dankmail_verzonden' => $fixture['dankmail_verzonden']]
			: $fixture;
	}
	function exec_query($query) {
		global $fixture;
		if (str_contains($query, 'SET dankmail_verzonden')) {
			$fixture['dankmail_verzonden'] = date('Y-m-d H:i:s');
			file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/fixture.json', json_encode($fixture));
		}
		return true;
	}

	$repository = dirname(__DIR__);
	if (($argv[1] ?? '') === '--request') {
		$_SERVER['DOCUMENT_ROOT'] = $argv[2];
		$fixture = json_decode(file_get_contents($argv[2] . '/fixture.json'), true, 512, JSON_THROW_ON_ERROR);
		$_POST['id'] = 'tr_TestPayment';
		$payment = new class($fixture['status']) {
			public $status;
			public $amount;
			public function __construct($status) {
				$this->status = $status;
				$this->amount = (object) ['value' => '100.00'];
			}
			public function isPaid() { return $this->status === 'paid'; }
			public function hasRefunds() { return false; }
			public function hasChargebacks() { return false; }
		};
		$mollie = (object) ['payments' => new class($payment) {
			private $payment;
			public function __construct($payment) { $this->payment = $payment; }
			public function get($id) { return $this->payment; }
		}];
		register_shutdown_function(static function () {
			file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/response.json', json_encode([
				'status' => http_response_code(),
				'headers' => headers_list(),
			]));
		});
		require $repository . ($argv[3] === 'legacy' ? '/webhook.php' : '/algemeen/webhook.php');
		exit;
	}

	$root = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'lp-mail-test-' . bin2hex(random_bytes(6));
	$directories = ['includes', 'vendor', 'css', 'mail_sent'];
	$files = [
		'includes/includes2027.php' => '<?php',
		'includes/mollie.php' => '<?php',
		'includes/LPmailer.inc.php' => '<?php',
		'vendor/autoload.php' => '<?php',
		'css/mailing.css' => '',
		'includes/mailfuncties.inc.php' => '<?php require ' . var_export($repository . '/includes/mailfuncties.inc.php', true) . ';',
	];
	mkdir($root);
	foreach ($directories as $directory) mkdir($root . '/' . $directory);
	foreach ($files as $file => $contents) file_put_contents($root . '/' . $file, $contents);

	try {
		$_SERVER['DOCUMENT_ROOT'] = $root;
		ob_start();
		require $repository . '/includes/mailfuncties.inc.php';
		$bootstrap_output = ob_get_clean();
		if ($bootstrap_output !== '') throw new \RuntimeException('Mail bootstrap must not output HTML before webhook headers.');

		foreach ([null, '', '0', 0, '0000-00-00', '0000-00-00 00:00:00', '2026-01-02 12:00:00'] as $date) {
			$fixture = ['dankmail_verzonden' => $date];
			if (LPconfirmationSent(1) !== ($date === '2026-01-02 12:00:00')) {
				throw new \RuntimeException('Incorrect database confirmation check for ' . var_export($date, true));
			}
		}

		$base = [
			'InschId' => 1, 'random_id' => 'test-booking', 'email' => 'test@example.invalid',
			'naam' => 'Test', 'voornaam' => 'Test', 'taal' => 'nl',
			'dankmail_verzonden' => null, 'status' => 'paid',
		];
		$cases = [
			'database confirmation without marker' => ['date' => '2026-01-02 12:00:00', 'mails' => 0],
			'legacy booking marker' => ['marker' => 'test-booking.sent', 'mails' => 0],
			'payment marker' => ['marker' => 'payment-confirmation-tr_TestPayment.sent', 'mails' => 0],
			'first paid notification' => ['mails' => 1],
			'repeated paid notification' => ['mails' => 1, 'repeat' => true],
			'marker write failure with database fallback' => ['mails' => 1, 'repeat' => true, 'marker_write_fails' => true],
			'legacy endpoint' => ['mails' => 1, 'endpoint' => 'legacy'],
			'failure after earlier registration confirmation' => ['date' => '2026-01-02 12:00:00', 'status' => 'failed', 'mails' => 1],
		];
		foreach ($cases as $name => $case) {
			foreach (glob($root . '/mail_sent/*') as $file) {
				if (is_dir($file)) rmdir($file);
				else unlink($file);
			}
			if (is_file($root . '/mails')) unlink($root . '/mails');
			if (isset($case['marker'])) file_put_contents($root . '/mail_sent/' . $case['marker'], 'sent');
			file_put_contents($root . '/fixture.json', json_encode(array_merge($base, [
				'dankmail_verzonden' => $case['date'] ?? null, 'status' => $case['status'] ?? 'paid',
				'marker_write_fails' => $case['marker_write_fails'] ?? false,
			])));
			for ($request = 0; $request < (!empty($case['repeat']) ? 2 : 1); $request++) {
				$process = proc_open(
					[PHP_BINARY, '-d', 'display_errors=0', '-d', 'log_errors=1', '-d', 'error_log=', __FILE__, '--request', $root, $case['endpoint'] ?? 'current'],
					[1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes
				);
				if (!is_resource($process)) throw new \RuntimeException('Could not start test request.');
				$output = stream_get_contents($pipes[1]);
				$errors = stream_get_contents($pipes[2]);
				fclose($pipes[1]);
				fclose($pipes[2]);
				$exit_code = proc_close($process);
				$response = json_decode(file_get_contents($root . '/response.json'), true, 512, JSON_THROW_ON_ERROR);
				$marker_failure = !empty($case['marker_write_fails']) && $request === 0;
				$expected_status = $marker_failure ? 503 : 200;
				$expected_output = $marker_failure ? 'Mailmarker kon niet worden opgeslagen.' : '';
				$expected_errors = $marker_failure
					? str_contains($errors, 'Mollie-mail verzonden maar marker kon niet worden opgeslagen')
					: $errors === '';
				if ($exit_code !== 0 || !$expected_errors || $response['status'] !== $expected_status || $output !== $expected_output) {
					throw new \RuntimeException($name . ': request failed: ' . $errors . $output);
				}
			}
			$mail_count = is_file($root . '/mails') ? count(file($root . '/mails')) : 0;
			if ($mail_count !== $case['mails']) throw new \RuntimeException($name . ': unexpected mail count ' . $mail_count);
			echo "PASS: {$name}\n";
		}
	} finally {
		foreach (glob($root . '/mail_sent/*') as $file) {
			if (is_dir($file)) rmdir($file);
			else unlink($file);
		}
		foreach (array_keys($files) as $file) unlink($root . '/' . $file);
		foreach (['mails', 'fixture.json', 'response.json'] as $file) {
			if (is_file($root . '/' . $file)) unlink($root . '/' . $file);
		}
		foreach (array_reverse($directories) as $directory) rmdir($root . '/' . $directory);
		rmdir($root);
	}
}
