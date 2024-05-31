<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2024.php');

Kint::$enabled_mode = true;

$cursus = $cursus_offset + 1; // alleen cursus 1

$alleen_aanwezig = '';
if (isset($_POST['aanwezig']) and $_POST['aanwezig'] == 'aanwezig') $alleen_aanwezig = 'AND NOT (inzeepdag LIKE \'%niet%\')';

$volgorde = 'achternaam';
if (isset($_POST['instr']) and $_POST['instr'] == 'instr') $volgorde = 'instr';

$query_inzeepdag = "SELECT naam, inzeepdag, instr, CursusId_FK FROM inschrijving, dlnmr WHERE dlnmrid = dlnmrid_fk AND CursusId_FK = {$cursus} 
AND naam NOT LIKE \"%XXX%\" AND naam NOT LIKE \"%YYY%\" AND naam NOT LIKE \"%ZZZ%\" AND NOT (afgewezen <=> 1) 
AND NOT (toehoorder <=> 1) {$alleen_aanwezig}
order by cursusid_fk, {$volgorde}";
$inzeepdag = select_query($query_inzeepdag);
if (is_array($inzeepdag)) $totalRows_inzeepdag = count($inzeepdag);
d($query_inzeepdag, $inzeepdag);
// end Recordset

// begin Recordset
$query_aantal_niet = "SELECT count(*) FROM inschrijving, dlnmr 
WHERE dlnmrid = dlnmrid_fk AND CursusId_FK = {$cursus} 
AND naam NOT LIKE \"%XXX%\" AND naam NOT LIKE \"%YYY%\" AND naam NOT LIKE \"%ZZZ%\" AND NOT (afgewezen <=> 1) 
AND NOT (toehoorder <=> 1) AND inzeepdag LIKE '%niet%'";
$aantal_niet = select_query($query_aantal_niet, 0);

$tel_query = "SELECT COUNT(*) FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND naam NOT LIKE \"%XXX%\" AND naam NOT LIKE \"%YYY%\" AND naam NOT LIKE \"%ZZZ%\" AND CursusId_FK = {$cursus} and aangenomen = 1 
and NOT (toehoorder <=> 1) and NOT (afgewezen <=> 1) ";
$aangenomen = select_query($tel_query, 0);

// begin Recordset
$query_instrumenten = "SELECT * FROM instr ORDER BY id ASC";
$instrumenten = select_query($query_instrumenten);
foreach ($instrumenten as $ins) $instrumententabel[$ins['id']] = $ins['nl'];
// end Recordset

d($instrumententabel, $aangenomen);

?>
<!DOCTYPE HTML>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Inzeepdag</title>
	<link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
</head>

<body>
	<form id="form1" method="post"></form>
	<div class="w3-content w3-white">
		<h3 class="w3-panel w3-blue-gray">Aantal afwezigen inzeepdag:
			<?php
			if (isset($aangenomen) and $aangenomen > 0) $percentage = round($aantal_niet / $aangenomen * 100, 0) . ' %';
			else $percentage = '?';
			echo $aantal_niet . ' van ' . $aangenomen . ' (' . $percentage . ')'; ?>
			<button class="w3-right w3-red w3-btn w3-small" form="form1" type="submit" name="instr" value="achternaam">Sorteer op achternaam</button>
			&nbsp;&nbsp;<button class="w3-right w3-green w3-btn w3-small" form="form1" type="submit" name="instr" value="instr">Sorteer op instrument</button>
			&nbsp;&nbsp;<button class="w3-right w3-black w3-btn w3-small" form="form1" type="submit" name="aanwezig" value="aanwezig">Alleen aanwezigen</button>
		</h3>
		<table class="w3-table w3-striped w3-border-blue-gray">
			<tr>
				<th>Nr:</th>
				<th>Naam:</th>
				<th>Instr./stem:</th>
				<th>Inzeepdag:</th>
			</tr>
			<?php
			if (is_array($inzeepdag)) foreach ($inzeepdag as $inz) {
				$ins = explode(', ', trim($inz['instr']));
				d($ins);
				unset($instr);
				foreach ($ins as $in) $instr[] = $instrumententabel[$in];
				$instr = implode(', ', $instr);
			?>
				<tr>
					<td><?php echo $inz['CursusId_FK']; ?></td>
					<td><?php echo $inz['naam']; ?></td>
					<td><?php echo $instr; ?></td>
					<td><?php echo $inz['inzeepdag']; ?></td>
				</tr>
			<?php
			}
			?>
		</table>
	</div>
</body>

</html>