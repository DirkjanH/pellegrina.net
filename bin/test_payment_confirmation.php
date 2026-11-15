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
			if (!empty($fixture['mail_fails'])) return false;
			file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/mails', "sent\n", FILE_APPEND);
			if (!empty($fixture['marker_write_fails'])) {
				$type = $fixture['status'] === 'paid' ? 'confirmation' : 'failure';
				mkdir($_SERVER['DOCUMENT_ROOT'] . '/mail_sent/payment-' . $type . '-tr_TestPayment.sent');
			}
			return true;
		}
	}

	function d(...$values) {}
	function quote($value) { return "'" . addslashes($value) . "'"; }
	function euro($value) { return (string) $value; }
	function euro_en($value) { return (string) $value; }
	function format_datum_noyear($value, $locale) { return $value; }
	function format_datum($value, $locale) { return $value; }
	function format_datum_short($value, $locale) { return $value; }
	function select_query($query, $index = 2) {
		global $fixture;
		if (str_starts_with($query, 'SELECT CONCAT')) return 'Test address';
		if (str_starts_with($query, 'SELECT * FROM cursus')) return [
			'datum_begin' => '2027-07-01', 'datum_eind' => '2027-07-10',
			'datum_beslissing' => '2027-05-01', 'datum_betaling' => '2027-06-01',
			'inschrijfgeld' => 100, 'cursusnaam_nl' => 'Test', 'cursusnaam_en' => 'Test',
			'cursusplaats_nl' => 'Test', 'cursusplaats_en' => 'Test',
		];
		if (str_starts_with($query, 'SELECT * FROM instr')) return [
			['id' => 112, 'nl' => 'viool', 'en' => 'violin'],
			['id' => 30, 'nl' => 'alt', 'en' => 'alto'],
		];
		if (preg_match('/^SELECT (dankmail_verzonden|mislukkingsmail_verzonden) FROM inschrijving/', $query, $match)) {
			return [$match[1] => $fixture[$match[1]]];
		}
		return $fixture;
	}
	function exec_query($query) {
		global $fixture;
		foreach (['dankmail_verzonden', 'mislukkingsmail_verzonden'] as $column) {
			if (str_contains($query, 'SET ' . $column)) {
				if (!empty($fixture['database_write_fails'])) {
					$fixture['database_write_fails'] = false;
					file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/fixture.json', json_encode($fixture));
					return false;
				}
				$fixture[$column] = date('Y-m-d H:i:s');
				file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/fixture.json', json_encode($fixture));
			}
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
		if (str_starts_with($argv[3], 'dank-')) {
			$_GET['res'] = 'test-booking';
			$cursus_offset = 0;
			require $repository . '/' . substr($argv[3], 5) . '/dank.php';
			exit;
		}
		require $repository . ($argv[3] === 'legacy' ? '/webhook.php' : '/algemeen/webhook.php');
		exit;
	}

	$root = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'lp-mail-test-' . bin2hex(random_bytes(6));
	$directories = ['includes', 'vendor', 'css', 'mail_sent', 'bevestiging'];
	$files = [
		'includes/includes2027.php' => '<?php',
		'includes/mollie.php' => '<?php',
		'includes/LPmailer.inc.php' => '<?php',
		'vendor/autoload.php' => '<?php',
		'css/mailing.css' => '',
		'includes/mailfuncties.inc.php' => '<?php require ' . var_export($repository . '/includes/mailfuncties.inc.php', true) . ';',
		'includes/metatags+javascript.NL.php' => '<?php exit;',
		'includes/metatags+javascript.EN.php' => '<?php exit;',
		'bevestiging/briefhoofd_NL.htm' => '<html><body></html>',
		'bevestiging/briefhoofd_EN.htm' => '<html><body></html>',
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
			foreach ([false, true] as $failed) {
				$fixture = ['dankmail_verzonden' => null, 'mislukkingsmail_verzonden' => null];
				$fixture[$failed ? 'mislukkingsmail_verzonden' : 'dankmail_verzonden'] = $date;
				if (LPconfirmationSent(1, $failed) !== ($date === '2026-01-02 12:00:00')
					|| LPconfirmationSent(1, !$failed)) {
					throw new \RuntimeException('Incorrect independent database mail check for ' . var_export($date, true));
				}
			}
		}

		$base = [
			'InschId' => 1, 'random_id' => 'test-booking', 'email' => 'test@example.invalid',
			'naam' => 'Test', 'voornaam' => 'Test', 'taal' => 'nl',
			'dankmail_verzonden' => null, 'status' => 'paid',
			'mislukkingsmail_verzonden' => null,
			'Mollie_ID' => 'tr_TestPayment', 'aanbet_bedrag' => 100,
			'CursusId_FK' => 1, 'instr' => '112', 'zangstem' => '30',
			'telefoon' => 'test', 'mobiel' => '', 'password' => 'test',
			'betaalstatus' => 'paid',
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
			'open payment defers mail' => ['status' => 'open', 'mails' => 0],
			'pending payment defers mail' => ['status' => 'pending', 'mails' => 0],
			'authorized payment defers mail' => ['status' => 'authorized', 'mails' => 0],
			'pending to paid sends once' => ['statuses' => ['open', 'pending', 'paid', 'paid'], 'mails' => 1, 'database' => true],
			'repeated failed notification is recorded' => ['status' => 'failed', 'mails' => 1, 'repeat' => true, 'database' => false, 'failure_database' => true],
			'expired payment sends failure mail' => ['status' => 'expired', 'mails' => 1, 'database' => false, 'failure_database' => true],
			'canceled payment sends failure mail' => ['status' => 'canceled', 'mails' => 1, 'database' => false, 'failure_database' => true],
			'failed notification without marker uses database' => ['status' => 'failed', 'mails' => 1, 'repeat' => true, 'remove_marker' => true, 'database' => false, 'failure_database' => true],
			'database failure notification without marker' => ['status' => 'failed', 'failure_date' => '2026-01-02 12:00:00', 'mails' => 0, 'failure_database' => true],
			'legacy failure marker is registered in database' => ['status' => 'failed', 'marker' => 'payment-failure-tr_TestPayment.sent', 'mails' => 0, 'failure_database' => true],
			'failure marker write failure with database fallback' => ['status' => 'failed', 'mails' => 1, 'repeat' => true, 'marker_write_fails' => true, 'failure_database' => true],
			'failure database write retries without resending' => ['status' => 'failed', 'mails' => 1, 'repeat' => true, 'database_write_fails' => true, 'failure_database' => true],
			'failed mail send is not registered' => ['status' => 'failed', 'mail_fails' => true, 'mails' => 0, 'database' => false, 'failure_database' => false],
			'paid after failure still sends confirmation' => ['statuses' => ['failed', 'failed', 'paid', 'paid'], 'expected_counts' => [1, 1, 2, 2], 'mails' => 2, 'database' => true, 'failure_database' => true],
			'paid notification without marker uses database' => ['mails' => 1, 'repeat' => true, 'remove_marker' => true, 'database' => true],
			'pending notifications beyond retry limit still defer mail' => ['status' => 'pending', 'mails' => 0, 'requests' => 6],
			'English paid notification' => ['language' => 'en', 'mails' => 1, 'database' => true],
			'English failed notification' => ['language' => 'en', 'status' => 'failed', 'mails' => 1, 'database' => false, 'failure_database' => true],
		];
		foreach (['NL', 'EN'] as $language) {
			foreach (['open', 'pending', 'authorized', 'failed', 'paid'] as $status) {
				$cases["{$language} thank-you page: {$status}"] = [
					'status' => $status, 'mails' => $status === 'paid' ? 1 : 0,
					'endpoint' => 'dank-' . $language, 'repeat' => true,
					'database' => $status === 'paid',
				];
			}
			$cases["{$language} thank-you page after webhook confirmation"] = [
				'mails' => 0, 'date' => '2026-01-02 12:00:00', 'endpoint' => 'dank-' . $language,
			];
		}
		foreach ($cases as $name => $case) {
			foreach (glob($root . '/mail_sent/*') as $file) {
				if (is_dir($file)) rmdir($file);
				else unlink($file);
			}
			if (is_file($root . '/mails')) unlink($root . '/mails');
			if (isset($case['marker'])) file_put_contents($root . '/mail_sent/' . $case['marker'], 'sent');
			file_put_contents($root . '/fixture.json', json_encode(array_merge($base, [
				'dankmail_verzonden' => $case['date'] ?? null, 'status' => $case['status'] ?? 'paid',
				'mislukkingsmail_verzonden' => $case['failure_date'] ?? null,
				'betaalstatus' => $case['status'] ?? 'paid',
				'taal' => $case['language'] ?? (($case['endpoint'] ?? '') === 'dank-EN' ? 'en' : 'nl'),
				'marker_write_fails' => $case['marker_write_fails'] ?? false,
				'database_write_fails' => $case['database_write_fails'] ?? false,
				'mail_fails' => $case['mail_fails'] ?? false,
			])));
			$statuses = $case['statuses'] ?? array_fill(0, $case['requests'] ?? (!empty($case['repeat']) ? 2 : 1), $case['status'] ?? 'paid');
			foreach ($statuses as $request => $status) {
				$fixture = json_decode(file_get_contents($root . '/fixture.json'), true, 512, JSON_THROW_ON_ERROR);
				$fixture['status'] = $status;
				$fixture['betaalstatus'] = $status;
				file_put_contents($root . '/fixture.json', json_encode($fixture));
				if ($request > 0 && !empty($case['remove_marker'])) {
					foreach (glob($root . '/mail_sent/*.sent') as $marker) unlink($marker);
				}
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
				$database_failure = !empty($case['database_write_fails']) && $request === 0;
				$mail_failure = !empty($case['mail_fails']);
				$is_thank_you = str_starts_with($case['endpoint'] ?? '', 'dank-');
				$pending = !in_array($status, ['paid', 'failed', 'expired', 'canceled'], true) && !$is_thank_you;
				$expected_status = $is_thank_you ? false : (($marker_failure || $database_failure || $mail_failure || ($pending && $request < 5)) ? 503 : 200);
				$expected_output = $database_failure ? 'Verzendstatus van de betalingsmail kon niet worden opgeslagen.'
					: ($mail_failure ? 'Mail kon niet worden verzonden.' : ($marker_failure ? 'Mailmarker kon niet worden opgeslagen.' : ($pending
					? ($request >= 5 ? 'Maximumaantal webhookpogingen is bereikt.'
						: ($request === 4 ? 'Maximumaantal webhookpogingen bereikt; betalingsstatus is niet definitief.'
							: 'Betalingsstatus nog niet definitief (status: ' . $status . ').'))
					: '')));
				$expected_errors = $marker_failure
					? str_contains($errors, 'Mollie-mail verzonden maar marker kon niet worden opgeslagen')
					: (($pending || $database_failure || $mail_failure) ? str_contains($errors, 'Mollie-webhook tijdelijk mislukt') : $errors === '');
				if ($exit_code !== 0 || !$expected_errors || $response['status'] !== $expected_status || (!$is_thank_you && $output !== $expected_output)) {
					throw new \RuntimeException($name . ': request failed: ' . $errors . $output);
				}
				$mail_count = is_file($root . '/mails') ? count(file($root . '/mails')) : 0;
				if (isset($case['statuses'])) {
					$expected_mails_so_far = $case['expected_counts'][$request] ?? ($status === 'paid' ? 1 : 0);
					if ($mail_count !== $expected_mails_so_far) throw new \RuntimeException($name . ': mail sent at wrong payment status ' . $status);
				}
			}
			$mail_count = is_file($root . '/mails') ? count(file($root . '/mails')) : 0;
			if ($mail_count !== $case['mails']) throw new \RuntimeException($name . ': unexpected mail count ' . $mail_count);
			$fixture = json_decode(file_get_contents($root . '/fixture.json'), true, 512, JSON_THROW_ON_ERROR);
			if (isset($case['database']) && (!empty($fixture['dankmail_verzonden'])) !== $case['database']) {
				throw new \RuntimeException($name . ': unexpected database confirmation state');
			}
			if (isset($case['failure_database']) && (!empty($fixture['mislukkingsmail_verzonden'])) !== $case['failure_database']) {
				throw new \RuntimeException($name . ': unexpected database failure mail state');
			}
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
