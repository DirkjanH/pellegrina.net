<?php
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

require_once dirname(__DIR__) . '/includes/includes2027.php';
require_once dirname(__DIR__) . '/includes/LP_security.php';

function dieet_select_query($query, $single = false)
{
	global $db;

	try {
		$rows = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
		return $single ? ($rows[0] ?? []) : $rows;
	} catch (Throwable $exception) {
		error_log($exception->getMessage());
		return [];
	}
}

?>
<!DOCTYPE HTML>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Dieet/Dieta/Régime</title>
	<link rel="stylesheet" href="../css/w3.css" type="text/css">
	<link rel="stylesheet" href="../css/pellegrina_stijlen.css" type="text/css">
</head>

<body>
	<div id="inhoud" class="w3-auto w3-main"> <?php
												$CursusId = (int) $eerstecursus;

												while ($CursusId <= $laatstecursus) {

													// begin Recordset
													$query_passagiers = "SELECT d.naam, d.dieet
	FROM dlnmr AS d
	INNER JOIN inschrijving AS i ON d.dlnmrid = i.dlnmrid_fk
	WHERE NOT (d.naam LIKE \"%XXX%\" OR d.naam LIKE \"%YYY%\" OR d.naam LIKE \"%ZZZ%\")
	AND i.CursusId_FK = {$CursusId}
	AND NOT (i.afgewezen <=> 1)
	AND NOT (d.dieet IS NULL OR d.dieet LIKE \"%[geen]%\" OR d.dieet LIKE \"%none%\")
	ORDER BY d.achternaam ASC";

													$passagiers = dieet_select_query($query_passagiers);
													$totalRows_passagiers = count($passagiers);

													$query_Cursusnaam = "SELECT cursusnaam_en, YEAR(datum_begin) as jaar FROM cursus WHERE CursusId = {$CursusId}";
													$Cursusnaam = dieet_select_query($query_Cursusnaam, true);
												?> <h2>Course
				"<?php echo htmlspecialchars($Cursusnaam['cursusnaam_en'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
			</h2>
			<p>&nbsp;</p> <?php if ($totalRows_passagiers === 0) { ?> <p>No
					participants with dietary requirements were found for this course.
				</p> <?php } else { ?> <div class="w3-responsive">
					<table class="w3-table-all w3-striped">
						<thead>
							<tr>
								<th scope="col">Naam/Jmeno/Nom:</th>
								<th scope="col">Dieet/Dieta/Régime:</th>
							</tr>
						</thead>
						<tbody> <?php
														foreach ($passagiers as $passagier) {
								?> <tr>
									<td> <?php echo htmlspecialchars($passagier['naam'] ?? '', ENT_QUOTES, 'UTF-8'); ?>&nbsp;
									</td>
									<td> <?php echo htmlspecialchars($passagier['dieet'] ?? '', ENT_QUOTES, 'UTF-8'); ?>&nbsp;
									</td>
								</tr> <?php	  } ?> </tbody>
					</table>
				</div> <?php } ?> <p>&nbsp;</p> <?php
													$CursusId++;
												}
												?>
	</div>
</body>

</html>