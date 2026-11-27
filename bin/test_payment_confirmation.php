<?php
namespace Pelago\Emogrifier {
	class CssInliner
	{
		private $html;
		public static function fromHtml($html) { $inliner = new self(); $inliner->html = $html; return $inliner; }
		public function inlineCss($css) { return $this; }
		public function render() { return $this->html; }
	}
}

namespace {
	require dirname(__DIR__) . '/vendor/autoload.php';

	class FixturePaymentNotFound extends \Mollie\Api\Exceptions\ApiException
	{
		public function __construct() { $this->code = 404; }
	}

	class FixturePayments
	{
		private $payment, $modus;
		public function __construct($payment, $modus) { $this->payment = $payment; $this->modus = $modus; }
		public function get($id) {
			global $fixture;
			if ($this->modus !== ($fixture['payment_mode'] ?? 'live')) throw new FixturePaymentNotFound();
			return $this->payment;
		}
	}

	function maakMollieClient($modus) {
		global $payment;
		return (object) ['payments' => new FixturePayments($payment, $modus)];
	}

	class Kint { public static $enabled_mode; }
	class LPmailer
	{
		public $Subject, $Body, $AltBody;
		public function AddAddress($to, $name) {}
		public function SetFrom($from, $name) {}
		public function AddBCC($to, $name) {}
		public function html2text($html) { return html_entity_decode(trim(strip_tags($html)), ENT_QUOTES, 'UTF-8'); }
		public function clearAddresses() {}
		public function Send() {
			global $fixture;
			if (!empty($fixture['mail_fails'])) return false;
			file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/mails', json_encode(['subject' => $this->Subject, 'body' => $this->Body]) . "\n", FILE_APPEND);
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
		if (preg_match("/SET betaalstatus = '([^']+)'/", $query, $match)) {
			$fixture['betaalstatus'] = $match[1];
			file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/fixture.json', json_encode($fixture));
		}
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
		$cursus_offset = 0;
		$fixture = json_decode(file_get_contents($argv[2] . '/fixture.json'), true, 512, JSON_THROW_ON_ERROR);
		$mollieModus = $fixture['current_mode'] ?? 'live';
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
		$mollie = maakMollieClient($mollieModus);
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
		'includes/mollie.php' => '<?php require_once ' . var_export($repository . '/includes/mollie_config.php', true) . ';',
		'includes/LPmailer.inc.php' => '<?php',
		'vendor/autoload.php' => '<?php',
		'css/mailing.css' => '',
		'includes/mailfuncties.inc.php' => '<?php require ' . var_export($repository . '/includes/mailfuncties.inc.php', true) . ';',
		'includes/metatags+javascript.NL.php' => '<?php',
		'includes/metatags+javascript.EN.php' => '<?php',
		'includes/GA_code.php' => '<?php',
		'includes/GA_tagmanager.php' => '<?php',
		'includes/header.NL.php' => '<?php',
		'includes/header.EN.php' => '<?php',
		'includes/footer.php' => '<?php',
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
			'first paid notification' => ['mails' => 1, 'initial_status' => 'open', 'database' => true],
			'live payment after switching to test' => ['current_mode' => 'test', 'payment_mode' => 'live', 'mails' => 1, 'database' => true],
			'test payment after switching to live' => ['current_mode' => 'live', 'payment_mode' => 'test', 'mails' => 1, 'database' => true],
			'repeated paid notification' => ['mails' => 1, 'repeat' => true, 'database' => true],
			'legacy endpoint' => ['mails' => 1, 'endpoint' => 'legacy', 'database' => true],
			'failure after earlier registration confirmation' => ['date' => '2026-01-02 12:00:00', 'status' => 'failed', 'mails' => 0],
			'open payment defers mail' => ['status' => 'open', 'mails' => 0],
			'pending payment defers mail' => ['status' => 'pending', 'mails' => 0],
			'authorized payment defers mail' => ['status' => 'authorized', 'mails' => 0],
			'pending to paid sends once' => ['statuses' => ['open', 'pending', 'paid', 'paid'], 'mails' => 1, 'database' => true],
			'repeated failed notification' => ['status' => 'failed', 'mails' => 1, 'repeat' => true, 'database' => true],
			'database write failure does not duplicate confirmation' => ['mails' => 1, 'repeat' => true, 'database_write_fails' => true, 'database' => false],
			'expired payment sends confirmation' => ['status' => 'expired', 'mails' => 1, 'database' => true],
			'canceled payment sends confirmation' => ['status' => 'canceled', 'mails' => 1, 'database' => true],
			'failed mail send is retried' => ['status' => 'failed', 'mail_fails' => true, 'mails' => 0, 'database' => false],
			'paid after failure does not send another confirmation' => ['statuses' => ['failed', 'failed', 'paid', 'paid'], 'expected_counts' => [1, 1, 1, 1], 'mails' => 1, 'database' => true],
			'paid notification without marker uses database' => ['mails' => 1, 'repeat' => true, 'remove_marker' => true, 'database' => true],
			'pending notifications beyond retry limit still defer mail' => ['status' => 'pending', 'mails' => 0, 'requests' => 6],
			'English paid notification' => ['language' => 'en', 'mails' => 1, 'database' => true],
			'English failed notification' => ['language' => 'en', 'status' => 'failed', 'mails' => 1, 'database' => true],
			'webhook then thank-you page' => ['endpoints' => ['current', 'dank-NL'], 'mails' => 1, 'database' => true],
			'thank-you page then webhook' => ['endpoints' => ['dank-NL', 'current'], 'mails' => 1, 'database' => true],
			'English failed page then webhook' => ['language' => 'en', 'status' => 'failed', 'endpoints' => ['dank-EN', 'current'], 'mails' => 1, 'database' => true],
		];
		foreach (['NL', 'EN'] as $language) {
			foreach (['open', 'pending', 'authorized', 'failed', 'expired', 'canceled', 'paid', 'transfer'] as $status) {
				$final = in_array($status, ['failed', 'expired', 'canceled', 'paid', 'transfer'], true);
				$cases["{$language} thank-you page: {$status}"] = [
					'status' => $status, 'mails' => $final ? 1 : 0,
					'endpoint' => 'dank-' . $language, 'repeat' => true,
					'database' => $final,
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
				'current_mode' => $case['current_mode'] ?? 'live',
				'payment_mode' => $case['payment_mode'] ?? 'live',
			])));
			$statuses = $case['statuses'] ?? array_fill(0, count($case['endpoints'] ?? []) ?: ($case['requests'] ?? (!empty($case['repeat']) ? 2 : 1)), $case['status'] ?? 'paid');
			foreach ($statuses as $request => $status) {
				$fixture = json_decode(file_get_contents($root . '/fixture.json'), true, 512, JSON_THROW_ON_ERROR);
				$fixture['status'] = $status;
				$fixture['betaalstatus'] = $request === 0 ? ($case['initial_status'] ?? $status) : $status;
				if ($status === 'transfer') $fixture['Mollie_ID'] = '';
				file_put_contents($root . '/fixture.json', json_encode($fixture));
				if ($request > 0 && !empty($case['remove_marker'])) {
					foreach (glob($root . '/mail_sent/*.sent') as $marker) unlink($marker);
				}
				$endpoint = $case['endpoints'][$request] ?? ($case['endpoint'] ?? 'current');
				$process = proc_open(
					[PHP_BINARY, '-d', 'display_errors=0', '-d', 'log_errors=1', '-d', 'error_log=', __FILE__, '--request', $root, $endpoint],
					[1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes
				);
				if (!is_resource($process)) throw new \RuntimeException('Could not start test request.');
				$output = stream_get_contents($pipes[1]);
				$errors = stream_get_contents($pipes[2]);
				fclose($pipes[1]);
				fclose($pipes[2]);
				$exit_code = proc_close($process);
				$response = json_decode(file_get_contents($root . '/response.json'), true, 512, JSON_THROW_ON_ERROR);
				$mail_failure = !empty($case['mail_fails']);
				$is_thank_you = str_starts_with($endpoint, 'dank-');
				$pending = !in_array($status, ['paid', 'failed', 'expired', 'canceled'], true) && !$is_thank_you;
				$expected_status = $is_thank_you ? false : (($mail_failure || ($pending && $request < 5)) ? 503 : 200);
				$expected_output = $mail_failure ? 'Dankmail kon niet worden verzonden of geregistreerd.' : ($pending
					? ($request >= 5 ? 'Maximumaantal webhookpogingen is bereikt.'
						: ($request === 4 ? 'Maximumaantal webhookpogingen bereikt; betalingsstatus is niet definitief.'
							: 'Betalingsstatus nog niet definitief (status: ' . $status . ').'))
					: '');
				$database_failure = !empty($case['database_write_fails']) && $request === 0;
				$expected_errors = $database_failure
					? str_contains($errors, 'Verzendstatus van dankmail kon niet volledig worden opgeslagen')
					: (($pending || $mail_failure) ? str_contains($errors, 'Mollie-webhook tijdelijk mislukt') : $errors === '');
				if ($exit_code !== 0 || !$expected_errors || $response['status'] !== $expected_status || (!$is_thank_you && $output !== $expected_output)) {
					throw new \RuntimeException($name . ': request failed: ' . $errors . $output);
				}
				$mail_count = is_file($root . '/mails') ? count(file($root . '/mails')) : 0;
				if ($is_thank_you) {
					$is_final = in_array($status, ['paid', 'failed', 'expired', 'canceled', 'transfer'], true);
					$thank_you = str_contains($output, $endpoint === 'dank-EN' ? 'Thank you for registering' : 'Bedankt voor je inschrijving');
					if ($thank_you !== $is_final) throw new \RuntimeException($name . ': incorrect thank-you page for ' . $status);
				}
				if (isset($case['statuses'])) {
					$expected_mails_so_far = $case['expected_counts'][$request] ?? ($status === 'paid' ? 1 : 0);
					if ($mail_count !== $expected_mails_so_far) throw new \RuntimeException($name . ': mail sent at wrong payment status ' . $status);
				}
			}
			$mail_count = is_file($root . '/mails') ? count(file($root . '/mails')) : 0;
			if ($mail_count !== $case['mails']) throw new \RuntimeException($name . ': unexpected mail count ' . $mail_count);
			if ($mail_count) {
				$mail = json_decode(file($root . '/mails')[0], true, 512, JSON_THROW_ON_ERROR);
				$english = ($case['language'] ?? '') === 'en' || ($case['endpoint'] ?? '') === 'dank-EN';
				$thank_you = $english ? 'Thank you for registering' : 'Bedankt voor je inschrijving';
				$provisional = $english ? 'final confirmation of participation can only be given later' : 'definitieve bevestiging van deelname pas later';
				if (!str_contains($mail['body'], $thank_you) || !str_contains($mail['body'], $provisional)) {
					throw new \RuntimeException($name . ': missing full provisional registration confirmation');
				}
				if (in_array($case['status'] ?? '', ['failed', 'expired', 'canceled'], true)
					&& !str_contains($mail['body'], $english ? 'was unsuccessful' : 'niet geslaagd')) {
					throw new \RuntimeException($name . ': missing payment failure information');
				}
			}
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
