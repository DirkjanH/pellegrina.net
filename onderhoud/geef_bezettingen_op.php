<?php //Connection statement
require_once('../includes/includes2025.php');
// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1 );

error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

Kint::$enabled_mode = false;

// begin Recordset
$query_instrumenten = "SELECT id, nl, en FROM instr ORDER BY id ASC";
$instrumenten = select_query($query_instrumenten);
$totalRows_instrumenten = count($instrumenten);
// end Recordset

d($_POST);

if (isset($_POST["Submit"])) {
	foreach ($instrumenten as $instr) {
		$cursus = $eerstecursus;
		while ($cursus <= $laatstecursus) {
			$oms = $cursus . _ . $instr['id'];
			if (isset($_POST[$oms]) and $_POST[$oms] != '' and $_POST[$oms] >= 0) {
				$aantalSQL = sprintf(
					"INSERT INTO instr_aantallen (Aantal, InstrId, CursusId_FK)
VALUES (%s, %s, %s) ON DUPLICATE KEY UPDATE Aantal = %s;",
					GetSQLValueString($_POST[$oms], "int"),
					GetSQLValueString($instr['id'], "int"),
					GetSQLValueString($cursus, "int"),
					GetSQLValueString($_POST[$oms], "int")
				);

				d($aantalSQL);

				exec_query($aantalSQL);
			} // if
			$cursus++;
		} // while
	} // while
} // if
?>
<!DOCTYPE HTML>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Geef bezettingen op</title>
	<link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css" />
	<link href="../css/w3.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		input[type="number"] {
			text-align: center;
			width: 50px;
		}
	</style>
</head>

<body>
	<form id="form" method="post" action="<?php echo $editFormAction; ?>" class="w3-content w3-white">
		<table class="w3-table w3-striped w3-border-blue-gray">
			<tr>
				<th>Id:
				</th>
				<th>Naam:
				</th>
				<?php
				$cursus = $eerstecursus;
				while ($cursus <= $laatstecursus) {
					echo '<th>Aantal (cursus ' . $cursus . ']:</th>';
					$cursus++;
				}
				echo "</tr>\n";

				foreach ($instrumenten as $instr) {
					$cursus = $eerstecursus;
					$query_aantallen = "SELECT * FROM instr_aantallen WHERE InstrId = {$instr['id']}";
					$aantallen = select_query($query_aantallen);
					unset($aantal);
					foreach ($aantallen as $aant) $aantal[$aant['CursusId_FK']] = $aant['Aantal'];
				?>
			<tr>
				<td>
					<?php echo $instr['id']; ?>
				</td>
				<td>
					<?php echo $instr['nl']; ?>
				</td>
			<?php
					while ($cursus <= $laatstecursus) {
						echo '<td><input name="' . $cursus . "_{$instr['id']}" .
							'" type="number" value="' . $aantal[$cursus] . '" size="3"/>&nbsp;</td>';
						$cursus++;
					}
					echo '</tr>';
				}
			?>
			<tr>
				<td>&nbsp;</td>
				<td><strong>TOTAAL:</strong>
				</td>
				<?php
				$cursus = $eerstecursus;
				while ($cursus <= $laatstecursus) {
					$totaalSQL = "SELECT SUM(aantal) as totaal FROM instr_aantallen WHERE CursusId_FK = {$cursus}";
					$totaal = select_query($totaalSQL, 0);
					echo '<td><strong>' . $totaal . '</strong></td>';
					$cursus++;
				}
				echo "</tr>\n";
				?>
		</table>
		<p>
			<input type="submit" name="Submit" value="Wijzig aantallen">
		</p>
	</form>
</body>

</html>