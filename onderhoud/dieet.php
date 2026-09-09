<?php
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

require_once dirname(__DIR__) . '/vendor/autoload.php';

Kint::$enabled_mode = false;

?>
<!DOCTYPE HTML>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<html>

	<head>
		<title>Dieet/Dieta/Régime</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/pellegrina_stijlen.css"
			type="text/css">
		<style type="text/css">
			body,
			td,
			th {
				font-family: "Alegreya Sans", Verdana, sans-serif;
			}
		</style>
	</head>

<body>
	<div class="inhoud"> <?php
							//Connection statement
							require_once dirname(__DIR__) . '/includes/includes2027.php';
							/* echo '<pre>';
print_r($_GET);
echo '</pre>';
 */
							$CursusId = (int) $eerstecursus;

							while ($CursusId <= $laatstecursus) {

								// begin Recordset
								$query_passagiers = "SELECT d.naam, d.dieet FROM dlnmr d, inschrijving i 
	WHERE NOT (d.naam LIKE \"%XXX%\" OR d.naam LIKE \"%YYY%\" OR d.naam LIKE \"%ZZZ%\") AND i.CursusId_FK = {$CursusId} 
	AND d.dlnmrid = i.dlnmrid_fk AND NOT (afgewezen <=> 1) AND NOT(dieet IS NULL OR dieet LIKE \"%[geen]%\" 
	OR dieet LIKE \"%none%\") ORDER BY d.achternaam ASC";

								$passagiers = select_query($query_passagiers) ?: [];
								$totalRows_passagiers = count($passagiers);

								$query_Cursusnaam = "SELECT cursusnaam_en, YEAR(datum_begin) as jaar FROM cursus WHERE CursusId = {$CursusId}";
								$Cursusnaam = select_query($query_Cursusnaam, 1);
							?> <h2>Course
				"<?php echo htmlspecialchars($Cursusnaam['cursusnaam_en'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
			</h2>
			<p>&nbsp;</p> <?php if ($totalRows_passagiers === 0) { ?> <p>No
					participants with dietary requirements were found for this course.
				</p> <?php } else { ?> <table width="600" border="1" cellpadding="5">
					<tr>
						<td width="40%"><strong><em>Naam/Jmeno/Nom:</em></strong></td>
						<td width="40%"><strong><em>Dieet/Dieta/Régime:</em></strong>
						</td>
					</tr> <?php
									foreach ($passagiers as $passagier) {
							?> <tr>
							<td width="40%">
								<?php echo htmlspecialchars($passagier['naam'] ?? '', ENT_QUOTES, 'UTF-8'); ?>&nbsp;
							</td>
							<td width="40%">
								<?php echo htmlspecialchars($passagier['dieet'] ?? '', ENT_QUOTES, 'UTF-8'); ?>&nbsp;
							</td>
						</tr> <?php	  } ?>
				</table> <?php } ?> <p>&nbsp;</p> <?php
													$CursusId++;
												}
													?>
	</div>
</body>

</html>