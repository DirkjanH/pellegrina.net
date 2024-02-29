<?php //Connection statement
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/includes2024.php');
// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1 );

error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';

Kint::$enabled_mode = false;

// begin Recordset
$query_instrumenten = "SELECT id, nl, en FROM instr ORDER BY id ASC";
$instrumenten = select_query($query_instrumenten);
$totalRows_instrumenten = count($instrumenten);
// end Recordset

$cursus = $cursus_offset + 1;

while ($cursus <= $aantal_cursussen + $cursus_offset) {

	$query_streefgetal = "SELECT * FROM instr_aantallen WHERE CursusId_FK = {$cursus}";
	d($query_streefgetal);
	$streefgetallen = select_query($query_streefgetal);
	d($streefgetallen);
	
	foreach ($streefgetallen as $streefgetal) {	
		$streven[$cursus][$streefgetal['InstrId']] = $streefgetal['Aantal'];
		$streven[$cursus]['totaal'] += $streefgetal['Aantal'];
	}
	$cursus++;
}

$cursus = $cursus_offset + 1;

while ($cursus <= $aantal_cursussen + $cursus_offset) {

	foreach ($instrumenten as $instr) {
		$ins = $instr['id'];
		$query_instrument = "SELECT count(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId = DlnmrId_FK AND 
		achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND aangenomen = 1
		AND SUBSTRING_INDEX(instr, ', ', 1) = \"{$ins}\" and NOT (afgewezen <=> 1) and cursusid_FK = {$cursus}";
		d($query_instrument);
		$aantal_ins = select_query($query_instrument, 0);
		d($aantal_ins);
		if ($aantal_ins > 0)
			$bezetting[$cursus][$ins] = $aantal_ins;
	  }
	$cursus++;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<title>Bezetting</title>
<link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css" />
<link href="../css/w3.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.klein {
	font-size: 75%;
	color: #CC0000;
}
-->
</style>
</head>

<body>
<div class="w3-content w3-white">

	<table class="w3-table w3-striped w3-border-blue-gray">
		<tr>
			<th>Id:</th>
			<th>Naam:</th>
			<?php
	$cursus = $cursus_offset + 1;
	while ($cursus <= $aantal_cursussen + $cursus_offset) {
      	echo '<th>Cursus ' . $cursus . ':</th>';
		$cursus++;
		}
    echo "</tr>\n";

	foreach ($instrumenten as $instr) {
	$cursus = $cursus_offset + 1;
	while ($cursus <= $aantal_cursussen + $cursus_offset) {
		$aantal[$cursus] = $bezetting[$cursus][$instr['id']];
		if ($streven[$cursus][$instr['id']] > 0)
			$aantal[$cursus] .= " <span class=\"klein\">({$streven[$cursus][$instr['id']]})</span>";
		$totaal[$cursus] += $bezetting[$cursus][$instr['id']];
		$cursus++;
	}
	
?>
		 <tr>
			 <td><?php echo $instr['id']; ?></td>
			 <td><?php echo $instr['nl']; ?></td>
			 <?php
	$cursus = $cursus_offset + 1;
	while ($cursus <= $aantal_cursussen + $cursus_offset) {
      	echo '<td>' . $aantal[$cursus] . '</td>';
		$cursus++;
		}
    echo "</tr>\n";
   }
?>
		<tr>
			<td>&nbsp;</td>
			<td><strong>TOTAAL:</strong></td>
			<?php
	$cursus = $cursus_offset + 1;
	while ($cursus <= $aantal_cursussen + $cursus_offset) {
      	echo '<td><strong>' . $totaal[$cursus] . ' <span class="klein">(' . $streven[$cursus]['totaal'] . ']</span></strong></td>';
		$cursus++;
		}
    echo "</tr>\n";
	?>
	</table>
</div>
</body>
</html>