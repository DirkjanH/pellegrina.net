<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1);
error_reporting(E_ALL);

//Connection statement
require_once($_SERVER['DOCUMENT_ROOT'] . '/connections/connect_PDO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/functies.php');
require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

Kint::$enabled_mode = false;

session_start();
ob_start();

if (isset($_POST['mailing'])) $_SESSION['mailing']	= $_POST['mailing'];
elseif (isset($_SESSION['mailing'])) $_POST['mailing'] = $_SESSION['mailing'];

d($_POST);

$mailings = select_query("SELECT * FROM mailing_opdrachten");

if (isset($_POST['mailing'])) {
	$mailing_nr = $_POST['mailing'];
} else {
	$mailing_nr = end($mailings)['MAILINGiD'];
	//echo 'Mailing bestaat niet<br><br>';
}

d($mailings);

if ($mailing_nr > 0) {
	$mailing = select_query("SELECT * FROM mailing_opdrachten WHERE mailingId = {$mailing_nr}", 1);
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
	foreach ($adressen as $adres) {
		$temp = array();
		// each column needs to have data inserted via the $temp array
		$temp[] = array('v' => $adres['naam']);
		$temp[] = array('v' => (round($adres['verschil_verzenden'] / 60, 2)));

		// insert the temp array into $rows
		$rows[] = array('c' => $temp);
	}

	// populate the table with rows of data
	$table['rows'] = $rows;

	// encode the table as JSON
	$jsonTable = json_encode($table);

	d($jsonTable);
} //if ($mailing_nr > 0)
?>

<!DOCTYPE HTML>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="shortcut icon" href="/mailing/favicon.ico">
	<META HTTP-EQUIV=Refresh CONTENT="900" ; URL="<?php echo $_SERVER['PHP_SELF']; ?>">
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
			var options = {
				title: 'Tijd voor het openen van emails, in minuten',
				legend: {
					position: 'none'
				},
				colors: ['green', 'red'],
				histogram: {
					bucketSize: 60,
					maxNumBuckets: 100
				},
				hAxis: {
					gridlines: {
						count: -1
					},
					title: 'minuten',
					format: '0',
					slantedText: true,
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

			var chart = new google.visualization.Histogram(document.getElementById('chart_div'));
			chart.draw(data, options);
		}

		function formSubmit(val) {
			document.getElementById('mailing').value = val;
			document.getElementById('form1').submit();
		}
	</script>

</head>

<body>
	<div class="w3-panel">
		<form id="form1" action="" method="post">
			<?php foreach ($mailings as $m) {
				$totaal = select_query("SELECT count(*) as aantal FROM mailing_adressen WHERE mailingId_FK = {$m['MAILINGiD']}", 0);
				$geopend = select_query("SELECT count(*) as aantal FROM mailing_adressen WHERE mailingId_FK = {$m['MAILINGiD']} AND tijd_geopend IS NOT NULL", 0);
				d($geopend, $totaal);
				if ($totaal > 0) $percentage_geopend = ' (' . round(($geopend / $totaal) * 100, 1) . ' %)';
				else echo ('Geen mails verzonden<br>');
				echo "<p class=\"w3-small\"><input TYPE=\"button\" class=\"w3-light-green w3-border-green\" onclick=\"javascript: formSubmit({$m['MAILINGiD']})\" value=\"{$m['MAILINGiD']}\"> 
				{$m['subject']} $percentage_geopend</p>" . PHP_EOL;
			} ?>
			<input type="hidden" name="mailing" id="mailing" value="">
		</form>
		<h1><?php if (isset($mailing)) echo $mailing['subject']; ?></h1>
		<h3>Verzonden op <?php if (isset($mailing)) echo $mailing['tijd_aanmaak']; ?></h3>
		<?php
		echo 'aantal emails = ' . $aantal . ' | ';
		if (!$alles) echo 'aantal verzonden emails = ' . $aantal_verzonden . ' (' . round(($aantal_verzonden / $aantal) * 100, 1) . ' %) | ';
		echo 'aantal geopende emails = ' . $aantal_niet_geopend . ' (' . round(($aantal_niet_geopend / $aantal) * 100, 1) . ' %)';
		if (!$alles) echo '; van verzonden ' . round(($aantal_niet_geopend / $aantal_verzonden) * 100, 1) . ' %)';
		echo '<br>';
		?>
		<div id="chart_div" style="width: 900px; height: 500px;" class="w3-card-4 w3-margin-top"></div>
		<p class="w3-small w3-text-grey">laatste verversing: <?php echo strftime("%c"); ?></p>
	</div>

	<?php ob_end_flush(); ?>
</body>

</html>