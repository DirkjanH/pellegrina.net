<?php
//stel php in dat deze fouten weergeeft
ini_set('display_errors', 1);

error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

Kint::$enabled_mode = false;

?>
<!DOCTYPE HTML>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bus from/to the course</title>
	<meta charset="utf-8">
	<link href="/css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="inhoud w3-content">

		<?php
		//Connection statement
		require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2025.php');

		$query_cursussen = "SELECT cursusid, cursusnaam_en, plaats_kort AS plaats, YEAR(datum_begin) as jaar FROM cursus WHERE CursusId >= {$eerstecursus} AND CursusId <= {$laatstecursus}"; // AND  plaats_kort = 'Bechyně'";
		$cursussen = select_query($query_cursussen);

		d($cursussen, $_REQUEST);

		foreach ($cursussen as $cursus) {

			// begin Recordset
			$query_passagiers = "SELECT d.naam, d.mobiel, i.busheen, i.busterug, i.bus_bijzonderheden FROM dlnmr d, inschrijving i 
	WHERE NOT (d.achternaam LIKE \"%XXX%\" OR d.achternaam LIKE \"%YYY%\" OR d.achternaam LIKE \"%ZZZ%\") AND i.CursusId_FK = {$cursus['cursusid']} 
	AND d.dlnmrid = i.dlnmrid_fk AND NOT (afgewezen <=> 1) AND (busheen = 1 OR busterug = 1) ORDER BY d.achternaam ASC";

			$passagiers = select_query($query_passagiers);
			if (is_array($passagiers)) $totalRows_passagiers = count($passagiers);
			else $totalRows_passagiers = 0;

			$query_heen = "SELECT count(*) as aantal FROM inschrijving WHERE CursusId_FK = {$cursus['cursusid']} 
	AND aangenomen=1 AND NOT (afgewezen <=> 1) AND busheen=1";
			$totalRows_heen = select_query($query_heen, 0);

			$query_terug = "SELECT count(*) as aantal FROM inschrijving WHERE CursusId_FK = {$cursus['cursusid']} 
	AND aangenomen=1 AND NOT (afgewezen <=> 1) AND busterug=1";
			$totalRows_terug = select_query($query_terug, 0);

		?>
			<div class="pagina">
				<h2>Course "<?php echo $cursus['cursusnaam_en']; ?>"</h2>
				<p>&nbsp;</p>
				<table border="1" cellpadding="5" class="w3-table-all">
					<tr>
						<th>Name:</th>
						<th>Mobile:</th>
						<th>Bus to <?php echo $cursus['plaats'] ?></th>
						<th>Bus to Prague</th>
						<th>Remarks</th>
					</tr>
					<?php if (is_array($passagiers)) foreach ($passagiers as $passagier) {
					?>
						<tr>
							<td><?php echo $passagier['naam']; ?>&nbsp;</td>
							<td><?php echo $passagier['mobiel']; ?>&nbsp;</td>
							<td>
								<div align="center"><?php if ($passagier['busheen'] == 1) echo 'X'; ?>&nbsp;</div>
							</td>
							<td>
								<div align="center"><?php if ($passagier['busterug'] == 1) echo 'X'; ?>&nbsp;</div>
							</td>
							<td>
								<div align="center">
									<?php echo $passagier['bus_bijzonderheden']; ?>
									&nbsp;</div>
							</td>
						</tr>
					<?php
					}
					?>
					<tr>
						<td>&nbsp;</td>
						<td>
							<div align="right"><strong>TOTAL:</strong></div>
						</td>
						<td>
							<div align="center"><strong><?php echo $totalRows_heen; ?>&nbsp;</strong></div>
						</td>
						<td>
							<div align="center"><strong><?php echo $totalRows_terug; ?>&nbsp;</strong></div>
						</td>
						<td>&nbsp;</td>
					</tr>

				</table>
			</div>
		<?php } ?>
	</div>
</body>

</html>