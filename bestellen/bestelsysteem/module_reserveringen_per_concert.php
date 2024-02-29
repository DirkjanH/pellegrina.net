<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"].'/../vendor/autoload.php';

Kint::$enabled_mode = false;

session_start();
require_once('bestelsysteem/bestelfuncties.php');

$query_concert = "SELECT * FROM {$tabel_concerten} WHERE online = 1 ORDER BY datum";
$concerten = mysqli_query($KAARTEN_DB, $query_concert) or die(mysqli_error($KAARTEN_DB));
while ($row = mysqli_fetch_assoc($concerten)) {
	$datum = strftime("%A %e %B %Y", strtotime($row['datum']));
	$tijd = strftime("%H:%M", strtotime($row['tijd']));
	$row['euro_vol'] = money_format('%n', $row['prijs_vol']);
	$row['euro_red'] = money_format('%n', $row['prijs_red']);
	$row['euro_kind'] = money_format('%n', $row['prijs_kind']);
	$row['concert'] = stripslashes("<b>{$row['concerttitel']}</b>, te {$row['plaats']}, op {$datum}, {$tijd} uur");
	$row['concert_kort'] = stripslashes('<b>' . $row['concerttitel']. '</b> (' . $row['plaats']. ' ' . strftime("%e %b", strtotime($row['datum'])) . ')');
	if (!($row['prijs_vol'] > 0 or $row['prijs_red'] > 0)) 
		$row['entree'] =  "toegang gratis (collecte na afloop)";		
	else {
		$row['entree'] =  "entree {$row['euro_vol']}";
		if ($row['prijs_red'] > 0) $row['entree'] .=  " | CJP/studenten {$row['euro_red']}";
		if ($row['prijs_kind'] > 0) $row['entree'] .=  " | {$row['txt_kind']} {$row['euro_kind']}";
		}
	$concert[$row['concertId']] = $row;
}

$_SESSION['sort'] = 'reserveringnr';
if (empty($_SESSION['sort']) OR $_SESSION['sort'] == 'reserveringnr') $_SESSION['sort'] = 'reserveringnr';	
if (isset($_POST['sort']) AND $_POST['sort'] == 'naam') $_SESSION['sort'] = 'achternaam';
if (isset($_POST['sort']) AND $_POST['sort'] == 'via') $_SESSION['sort'] = 'publiciteit, aanbrenger';
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Reserveringen per concert</title>
<meta charset="utf-8">
<meta http-equiv="refresh" content="900; url=<?php echo $_SERVER['PHP_SELF']; ?>">
<link href="<?php echo $css; ?>" rel="stylesheet" type="text/css">
<link href="<?php echo $bestellijst_css; ?>" rel="stylesheet" type="text/css">
<link href="<?php echo $w3_css; ?>" rel="stylesheet" type="text/css">

<script type="text/javascript">
<!--
function sorteer (waarde) {
	document.formulier.sort.value = waarde;
	document.formulier.submit();
}
-->
</script>
</head>

<body>
<div id="main" class="w3-content w3-margin-top">
	<div class="w3-white w3-panel w3-card-4">
		<form action="<?php echo $editFormAction; ?>" method="post" name="formulier" id="formulier">
			<p>Sorteer op:
				<label>
					<input name="s" type="radio" id="res" OnClick="sorteer('reserveringnr')" value="reserveringnr" <?php if ($_SESSION['sort'] == 'reserveringnr') echo 'checked'; ?>>
				reserveringsnummer</label>
				&nbsp;&nbsp;|
				<label>
					<input OnClick="sorteer('naam')" type="radio" name="s" value="naam" id="naam" <?php if ($_SESSION['sort'] == 'achternaam') echo 'checked'; ?>>
				achternaam</label>
				&nbsp;&nbsp;|
				<label>
					<input OnClick="sorteer('via')" type="radio" name="s" value="via" id="via" <?php if ($_SESSION['sort'] == 'publiciteit, aanbrenger') echo 'checked'; ?>>
				aanbrenger</label>
			</p>
			<input name="sort" id="sort" type="hidden" value="">
			<?php if (is_array($concert) AND count($concert) > 0) {
foreach ($concert as $pl) {
	$query_aantal = "SELECT sum(aantal_vol) as aantal_vol, sum(aantal_red) as aantal_red, sum(aantal_kind) as aantal_kind FROM {$tabel_reserveringen} 
	WHERE concertId={$pl['concertId']} AND {$pl['online']} = 1";
	$tabel_aantal = mysqli_query($KAARTEN_DB, $query_aantal) or die(mysqli_error($KAARTEN_DB));
	$aantal = mysqli_fetch_assoc($tabel_aantal);
	// begin Recordset
	$query_reserveringen = "SELECT reserveringnr, CONCAT_WS(' ', voornaam, tussenvoegsel, achternaam) as naam, plaats,
	telefoon, email, concertId, aantal_vol, aantal_red, aantal_kind, publiciteit, aanbrenger, opmerkingen, flyers, timestamp FROM {$tabel_reserveringen} 
	WHERE concertId={$pl['concertId']} ORDER BY {$_SESSION['sort']} ASC";
	$reserveringen = mysqli_query($KAARTEN_DB, $query_reserveringen) or die(mysqli_error($KAARTEN_DB));
	// end Recordset

	$vol = $aantal['aantal_vol']; 
	$bedrag_vol = $aantal['aantal_vol'] * $pl['prijs_vol']; 
	if ($pl['prijs_red'] > 0) {
		$red = $aantal['aantal_red']; 
		$bedrag_red = $aantal['aantal_red'] * $pl['prijs_red']; 
	}
	else {
		$red = 0;
		$bedrag_red = 0;
	}
	if ($pl['prijs_kind'] > 0) {
		$kind = $aantal['aantal_kind']; 
		$bedrag_kind = $aantal['aantal_kind'] * $pl['prijs_kind']; 
	}
	else {
		$kind = 0;
		$bedrag_kind = 0;
	}
	$som = $vol + $red + $kind;
	$totaal[vol] += $vol;
	$totaal[red] += $red;
	$totaal[kind] += $kind;
	$totaal[totaal] += $som;	
	$bedrag_som = $bedrag_vol + $bedrag_red + $bedrag_kind;
	$bedrag_totaal[vol] += $bedrag_vol;
	$bedrag_totaal[red] += $bedrag_red;
	$bedrag_totaal[kind] += $bedrag_kind;
	$bedrag_totaal[totaal] += $bedrag_som;	
	$euro_vol = euro2($bedrag_vol);
	$euro_red = euro2($bedrag_red);
	$euro_kind = euro2($bedrag_kind);
	$euro_som = euro2($bedrag_som);
	$euro_totaal[vol] = euro2($bedrag_totaal[vol]);
	$euro_totaal[red] = euro2($bedrag_totaal[red]);
	$euro_totaal[kind] = euro2($bedrag_totaal[kind]);
	$euro_totaal[som] = euro2($bedrag_totaal[totaal]);
// end Recordset

$output .= 	"<h3>{$pl['concert_kort']}</h3>";
if ($pl['prijs_vol'] > 0) $output .= "<p class=\"w3-small\">Aantal volle kaarten: {$vol} ({$euro_vol}); ";
if ($pl['prijs_red'] > 0) $output .= "aantal red. kaarten: {$red} ({$euro_red}); ";
if ($pl['prijs_kind'] > 0) $output .= "aantal kaarten {$pl['txt_kind']}: {$kind} ({$euro_kind}); ";
$output .= "samen: {$som} ({$euro_som})</p>";

$output .= "<table id=\"res\" class=\"w3-table-all\">
    <tr>
      <th width=\"1%\">Res. nr.:</th>
      <th width=\"40px\">Datum/tijd:</th>
      <th width=\"140px\">Naam:</th>
      <th>Plaats:</th>
      <th>Telefoon:</th>
      <th>Email:</th>
      <th width=\"1%\">Aantal kaarten vol:</th>";
if ($pl['prijs_red'] > 0) $output .= "<th width=\"1%\">Aantal kaarten red.:</th>";
if ($pl['prijs_kind'] > 0) $output .= "<th width=\"1%\">Aantal kaarten kind:</th>";
$output .= "<th>Weet ervan via:</th>
      <th>Opmer-<br>kingen:</th>
      <th>Wil digi-<br>flyers:</th>
    </tr>";

	while ($res = mysqli_fetch_assoc($reserveringen)) {
		$c = $res['concertId'];
		$concertnaam = $concert[$c]['concert_kort'];
		if ($res['aanbrenger'] != '') 
			$via = $res['aanbrenger'];
		else
			$via = $res['publiciteit'];
$output .= "<tr>
        <td><div align=\"right\">{$res['reserveringnr']}</div></td>
        <td>{$res['timestamp']}&nbsp;</td>
        <td>{$res['naam']}&nbsp;</td>
        <td>{$res['plaats']}&nbsp;</td>
        <td>{$res['telefoon']}&nbsp;</td>
        <td>{$res['email']}&nbsp;</td>
        <td width=\"1%\"><div align=\"center\">{$res['aantal_vol']}</div></td>";     
if ($pl['prijs_red'] > 0) $output .= "<td><div align=\"center\">{$res['aantal_red']}</div></td>";
if ($pl['prijs_kind'] > 0) $output .= "<td><div align=\"center\">{$res['aantal_kind']}</div></td>";
$output .= '<td>'.$via.'&nbsp;</td>';
$output .= '<td>'.$res['opmerkingen'].'&nbsp;</td><td><div align=\"center\">';
if ($res['flyers'] == 1) $output .= 'ja';
$output .= '&nbsp;</div></td>
      </tr>';
  }
  $output .= '</table>';
}
echo "<p class=\"w3-small\"><b>Totaal via de site verkochte kaarten: $totaal[vol] x vol ({$euro_totaal[vol]});  $totaal[red] x red. ({$euro_totaal[red]}); $totaal[kind] x 3e tarief ({$euro_totaal[kind]}); samen: $totaal[totaal] ({$euro_totaal[som]})</b></p>";
echo $output;
  } 
  else echo 'Momenteel geen concerten in de verkoop.<br>'
  ?>
			<p>laatste verversing: <?php echo strftime("%c"); ?></p>
		</form>
	</div>
</div>
</body>
</html>