<?php
//Connection statement
require_once($_SERVER['DOCUMENT_ROOT'] . '/connections/connect_PDO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/functies.php');
require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/mailing_afmelden.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/mailing_verzenden.php';

session_start();
ob_start();

function h($value)
{
	return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

$selection = $_GET['mailing'] ?? ($_POST['mailing'] ?? ($_SESSION['mailing'] ?? null));
$mailing_nr = filter_var($selection, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($mailing_nr !== false && $mailing_nr !== null) $_SESSION['mailing'] = $mailing_nr;
else $mailing_nr = 0;
if (empty($_SESSION['mailing_csrf'])) $_SESSION['mailing_csrf'] = bin2hex(random_bytes(32));
$actieFout = '';

// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1);
error_reporting(E_ALL);

Kint::$enabled_mode = false;
d($_POST);

if (isset($_POST['actie']) || isset($_POST['delete_mailing'])) {
	if (!is_string($_POST['csrf_token'] ?? null) || !hash_equals($_SESSION['mailing_csrf'], $_POST['csrf_token'])) {
		http_response_code(403);
		exit('Ongeldige beveiligingstoken.');
	}
}

if (isset($_POST['actie'])) {
	$actie = $_POST['actie'];
	if (!$mailing_nr || !is_string($actie) || !in_array($actie, ['starten', 'pauzeren', 'opnieuw', 'registreren'], true)) {
		http_response_code(400);
		exit('Ongeldige mailing of actie.');
	}
	try {
		$stmt = $db->prepare('SELECT mailingId FROM mailing_opdrachten WHERE mailingId = ?');
		$stmt->execute([$mailing_nr]);
		if ($stmt->fetchColumn() === false) {
			http_response_code(404);
			exit('Mailing bestaat niet.');
		}
		if (!mailingVerzendLock($db)) {
			throw new RuntimeException('De mailingwerker is bezig. Probeer het over enkele ogenblikken opnieuw.');
		}
		try {
			if ($actie === 'pauzeren') {
				$stmt = $db->prepare("UPDATE mailing_verzendtaken SET status = 'gepauzeerd' WHERE mailing_id = ? AND status = 'wacht' AND bezig_adres IS NULL");
				$stmt->execute([$mailing_nr]);
				if ($stmt->rowCount() !== 1) throw new RuntimeException('Pauzeren is niet mogelijk; controleer de status van de mailing.');
			} elseif ($actie === 'opnieuw' || $actie === 'registreren') {
				mailingLosOnzekereVerzendingOp($db, $mailing_nr, $actie === 'registreren');
			} else {
				mailingInWachtrij($db, $mailing_nr);
			}
		} finally {
			mailingVerzendUnlock($db);
		}
		header('Location: statistiek_mailing.php?mailing=' . $mailing_nr, true, 303);
		exit;
	} catch (PDOException $exception) {
		error_log('Mailingwachtrij niet beschikbaar: ' . $exception->getMessage());
		$actieFout = 'De mailingwachtrij is niet beschikbaar. Controleer de installatie en de serverlog.';
		http_response_code(500);
	} catch (RuntimeException $exception) {
		$actieFout = $exception->getMessage();
		http_response_code(409);
	}
}

if (isset($_POST['delete_mailing'])) {
	$deleteMailingId = filter_var($_POST['delete_mailing'], FILTER_VALIDATE_INT);
	if ($deleteMailingId !== false && $deleteMailingId > 0) {
		$mailingLock = false;
		try {
			$mailingLock = mailingVerzendLock($db);
			if (!$mailingLock) throw new RuntimeException('De mailingwerker is bezig. Probeer het later opnieuw.');
			$db->beginTransaction();
			$deleteTaak = $db->prepare('DELETE FROM mailing_verzendtaken WHERE mailing_id = :mailingId');
			$deleteTaak->execute([':mailingId' => $deleteMailingId]);
			$deleteAdressen = $db->prepare('DELETE FROM mailing_adressen WHERE mailingId_FK = :mailingId');
			$deleteAdressen->execute([':mailingId' => $deleteMailingId]);
			$deleteMailing = $db->prepare('DELETE FROM mailing_opdrachten WHERE mailingId = :mailingId');
			$deleteMailing->execute([':mailingId' => $deleteMailingId]);
			$db->commit();
			if (($_SESSION['mailing'] ?? null) == $deleteMailingId) {
				unset($_SESSION['mailing']);
				$mailing_nr = 0;
			}
		} catch (PDOException | RuntimeException $exception) {
			if ($db->inTransaction()) $db->rollBack();
			echo '<p><strong>Verwijderen mislukt:</strong> ' . htmlspecialchars(
				$exception->getMessage(),
				ENT_QUOTES,
				'UTF-8'
			) . '</p>';
		} finally {
			if ($mailingLock) mailingVerzendUnlock($db);
		}
	}
}

$mailings = select_query("SELECT * FROM mailing_opdrachten");
$mailings = is_array($mailings) ? $mailings : [];
$mailing = null;
$aantal = 0;
$aantal_niet_geopend = 0;
$aantal_verzonden = 0;
$alles = true;
$jsonTable = json_encode(['cols' => [], 'rows' => []]);
$chartType = 'Histogram';
$percentage_geopend = '';
if (!$mailing_nr && count($mailings) > 0) {
	$laatsteMailing = end($mailings);
	$mailing_nr = (int) ($laatsteMailing['MAILINGiD'] ?? $laatsteMailing['mailingId']);
}

d($mailings);

if ($mailing_nr > 0) {
	$mailing = select_query("SELECT * FROM mailing_opdrachten WHERE mailingId = {$mailing_nr}", 1);
}
if ($mailing) {
	$mailing_status = null;
	$taak = null;
	$onzekerAdres = null;
	try {
		$mailing_status = mailingAfmeldVerzendStatus($db, $mailing_nr);
		$stmt = $db->prepare('SELECT * FROM mailing_verzendtaken WHERE mailing_id = ?');
		$stmt->execute([$mailing_nr]);
		$taak = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($taak && $taak['status'] === 'gestopt' && $taak['bezig_adres'] !== null) {
			$stmt = $db->prepare('SELECT email FROM mailing_adressen WHERE mailingId_FK = ? AND mailadresId = ?');
			$stmt->execute([$mailing_nr, $taak['bezig_adres']]);
			$onzekerAdres = $stmt->fetchColumn();
		}
	} catch (PDOException $exception) {
		error_log('Mailingwachtrij niet beschikbaar: ' . $exception->getMessage());
		$actieFout = 'De mailingwachtrij is niet beschikbaar. Controleer de installatie en de serverlog.';
	}
	$adressen = select_query("SELECT naam, (UNIX_TIMESTAMP(tijd_geopend) - UNIX_TIMESTAMP(tijd_aanmaak)) AS verschil_verzenden, (UNIX_TIMESTAMP(tijd_geopend) - UNIX_TIMESTAMP(tijd_verzonden)) AS verschil FROM mailing_adressen, mailing_opdrachten WHERE mailingId = mailingId_FK AND mailingId_FK = {$mailing_nr} AND tijd_geopend IS NOT NULL");
	$aantal = select_query("SELECT count(*) as aantal FROM mailing_adressen WHERE mailingId_FK = {$mailing_nr}", 0);
	$aantal_niet_geopend = select_query("SELECT count(*) as aantal FROM mailing_adressen WHERE mailingId_FK = {$mailing_nr} AND tijd_geopend IS NOT NULL", 0);
	$aantal_verzonden = select_query("SELECT count(*) as aantal FROM mailing_adressen WHERE mailingId_FK = {$mailing_nr} AND tijd_verzonden IS NOT NULL", 0);
	$alles = ($aantal == $aantal_verzonden); // waar als alle mails verzonden zijn
	d($adressen);
	d($aantal);
	d($aantal_verzonden);
	d($aantal_niet_geopend);

	$table = array();
	$table['cols'] = array(
		/* define your DataTable columns here
     * each column gets its own array
     * syntax of the arrays is:
     * label => column label
     * type => data type of column (string, number, date, datetime, boolean)
     */
		// I assumed your first column is a "string" type
		// and your second column is a "number" type
		// but you can change them if they are not
		array('label' => 'Naam', 'type' => 'string'),
		array('label' => 'Tijd', 'type' => 'number')
	);

	$rows = array();
	foreach (is_array($adressen) ? $adressen : [] as $adres) {
		$temp = array();
		// each column needs to have data inserted via the $temp array
		$temp[] = array('v' => $adres['naam']);
		$temp[] = array('v' => (round($adres['verschil'] / 3600, 2)));

		// insert the temp array into $rows
		$rows[] = array('c' => $temp);
	}

	// populate the table with rows of data
	$table['rows'] = $rows;
	if (count($rows) === 0) {
		$table['rows'][] = [
			'c' => [
				['v' => 'Geen geopende mails'],
				['v' => 0],
			]
		];
	}

	// encode the table as JSON
	$jsonTable = json_encode($table);
	$chartType = count($table['rows']) <= 1 ? 'ColumnChart' : 'Histogram';

	d($jsonTable);
} //if ($mailing_nr > 0)
?>

<!DOCTYPE HTML>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="shortcut icon" href="/mailing/favicon.ico">
	<meta http-equiv="refresh" content="900">
	<title>Statistieken mailings</title>
	<link href="/css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load("current", {
			packages: ["corechart"],
			'language': 'nl'
		});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			if (!document.getElementById('chart_div')) return;
			var options = {
				title: 'Tijd voor het openen van emails, in uren',
				legend: {
					position: 'none'
				},
				colors: ['green', 'red'],
				histogram: {
					bucketSize: 1,
					maxNumBuckets: 100
				},
				hAxis: {
					gridlines: {
						count: 10
					},
					title: 'uren na verzenden',
					format: '0',
					slantedText: false,
				},
				vAxis: {
					gridlines: {
						color: 'green',
						width: 10,
						count: -1
					},
					minValue: 4,
					viewWindow: {
						min: 0
					},
					/*this also makes 0 = min value*/
					format: '0',
					title: 'aantal emails'
				}
			};

			// Create our data table out of JSON data loaded from server.
			var data = new google.visualization.DataTable(<?php echo $jsonTable ?>);

			var chart = new google.visualization.<?php echo $chartType; ?>(document.getElementById('chart_div'));
			chart.draw(data, options);
		}

	</script>
	<style>
		.mailing-statistieken {
			max-width: 1400px;
		}

		.verzendkop,
		.verzendtotalen {
			display: flex;
			align-items: center;
			flex-wrap: wrap;
			gap: 0.5em 1.5em;
		}

		.verzendkop h3,
		.verzendkop form {
			margin: 0;
		}

		.delete-mailing {
			width: 1.5em;
			height: 1.5em;
			padding: 0;
			border: 0;
			border-radius: 25%;
			background: #d32f2f;
			color: #fff;
			font-size: 1em;
			font-weight: bold;
			line-height: 1.5em;
			cursor: pointer;
		}

		.delete-mailing:hover,
		.delete-mailing:focus {
			background: #a51f1f;
		}
	</style>

</head>

<body>
	<div class="w3-panel w3-content mailing-statistieken">
		<form id="form1" action="" method="post">
			<input type="hidden" name="csrf_token" value="<?= h($_SESSION['mailing_csrf']) ?>">
			<?php foreach ($mailings as $m) {
				$id = (int) ($m['MAILINGiD'] ?? $m['mailingId']);
				$totaal = select_query("SELECT count(*) as aantal FROM mailing_adressen WHERE mailingId_FK = {$id}", 0);
				$geopend = select_query("SELECT count(*) as aantal FROM mailing_adressen WHERE mailingId_FK = {$id} AND tijd_geopend IS NOT NULL", 0);
				d($geopend, $totaal);
				$percentage_geopend = $totaal > 0 ? ' (' . round(($geopend / $totaal) * 100, 1) . ' %)' : '';
				echo '<p class="w3-small"><a class="w3-light-green w3-border-green" href="?mailing=' . $id . '">' . $id . '</a> '
					. h($m['subject']) . h($percentage_geopend)
					. ' <button type="submit" class="delete-mailing" name="delete_mailing" value="' . $id . '" aria-label="Mailing wissen" title="Mailing wissen" onclick="return confirm(\'Deze mailing en alle bijbehorende adressen definitief wissen?\');">&times;</button></p>' . PHP_EOL;
			} ?>
		</form>
		<?php if ($actieFout !== ''): ?>
			<p><strong><?= h($actieFout) ?></strong></p>
		<?php endif; ?>
		<?php if ($mailing): ?>
		<h1><?= h($mailing['subject']) ?></h1>
		<div class="verzendkop">
			<h3>Verzonden op <?= h($mailing['tijd_aanmaak']) ?></h3>
			<?php if ($mailing_status !== null && $taak && $taak['status'] === 'wacht'): ?>
				<form method="post" action="?mailing=<?= h($mailing_nr) ?>">
					<input type="hidden" name="csrf_token" value="<?= h($_SESSION['mailing_csrf']) ?>">
					<button type="submit" name="actie" value="pauzeren">Mailing pauzeren</button>
				</form>
			<?php endif; ?>
		</div>
		<?php if ($mailing_status !== null): ?>
		<section>
			<h2>Verzending</h2>
			<p class="verzendtotalen"><span><strong>Totaal aantal mails:</strong> <?= h($mailing_status['totaal']) ?></span>
				<span><strong>Te verzenden mails:</strong> <?= h($mailing_status['resterend']) ?></span></p>
			<?php if ($taak && $taak['status'] === 'wacht'): ?>
				<p>De mailing staat in de wachtrij. De server verwerkt deze in blokken van maximaal 40 mails.
					Volgende poging vanaf: <?= h($taak['volgende_poging']) ?>.</p>
			<?php elseif ($taak && $taak['status'] === 'afgerond'): ?>
				<p>Mailing afgehandeld.</p>
			<?php else: ?>
				<?php if ($taak && $taak['status'] === 'gestopt'): ?>
					<p>De verzending is gestopt: <?= h($taak['laatste_fout']) ?></p>
					<?php if ($taak['bezig_adres'] !== null): ?>
						<p>Het is onzeker of het bericht aan <?= h($onzekerAdres ?: 'mailadresId ' . $taak['bezig_adres']) ?> is afgeleverd. Controleer de maillogs en los de fout op voordat je een keuze maakt.</p>
						<form method="post" action="?mailing=<?= h($mailing_nr) ?>">
							<input type="hidden" name="csrf_token" value="<?= h($_SESSION['mailing_csrf']) ?>">
							<button type="submit" name="actie" value="opnieuw" onclick="return confirm('Opnieuw proberen kan een dubbele mail veroorzaken. Doorgaan?')">Opnieuw proberen en hervatten</button>
							<button type="submit" name="actie" value="registreren" onclick="return confirm('Alleen kiezen als de mail daadwerkelijk verzonden is. Doorgaan?')">Als verzonden registreren en hervatten</button>
						</form>
					<?php else: ?>
						<p>Los de fout op voordat je de mailing hervat.</p>
					<?php endif; ?>
				<?php elseif ($taak && $taak['status'] === 'gepauzeerd'): ?>
					<p>De mailing is gepauzeerd.</p>
				<?php endif; ?>
				<?php if (!$taak || $taak['bezig_adres'] === null): ?>
					<form method="post" action="?mailing=<?= h($mailing_nr) ?>">
						<input type="hidden" name="csrf_token" value="<?= h($_SESSION['mailing_csrf']) ?>">
						<button type="submit" name="actie" value="starten"><?= $taak ? 'Mailing hervatten' : 'Mailing starten' ?></button>
					</form>
				<?php endif; ?>
			<?php endif; ?>
			<p>Je kunt deze pagina sluiten zodra de geplande taak op de server is ingesteld.</p>
		</section>
		<?php endif; ?>
		<?php
		echo 'aantal emails = ' . $aantal . ' | ';
		if (!$alles && $aantal > 0) echo 'aantal verzonden emails = ' . $aantal_verzonden . ' (' . round(($aantal_verzonden / $aantal) * 100, 1) . ' %) | ';
		echo 'aantal geopende emails = ' . $aantal_niet_geopend . ' (' . ($aantal > 0 ? round(($aantal_niet_geopend / $aantal) * 100, 1) : 0) . ' %)';
		if (!$alles && $aantal_verzonden > 0) echo '; van verzonden ' . round(($aantal_niet_geopend / $aantal_verzonden) * 100, 1) . ' %)';
		echo '<br>';
		?>
		<div id="chart_div" style="width: 100%; max-width: 900px; height: 500px;" class="w3-card-4 w3-margin-top"></div>
		<?php elseif ($mailing_nr): ?>
		<p>Mailing bestaat niet.</p>
		<?php endif; ?>
		<p class="w3-small w3-text-grey">laatste verversing: <?php echo strftime("%c"); ?></p>
	</div>

	<?php ob_end_flush(); ?>
</body>

</html>