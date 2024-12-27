<?php //Connection statement
// stel php in dat deze fouten weergeeft
ini_set('display_errors', 1);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2025.php');

Kint::$enabled_mode = false;

d($_GET);
d($_POST);

$docenten_eenpersoons[1 + $cursus_offset] = 7;
$docenten_eenpersoons[2 + $cursus_offset] = 3;

$i = $eerstecursus;
$deelnemers_vorigjaar['totaal'] = 0;
$deelnemers['totaal'] = 0;
$aangenomen['totaal'] = 0;
$toehoorder['totaal'] = 0;
$student['totaal'] = 0;
$oost['totaal'] = 0;
$ooststudent['totaal'] = 0;
$donateurs['totaal'] = 0;
$vroeg['totaal'] = 0;
$nieuw['totaal'] = 0;
$cursus['totaal']['cursusgeld'] = 0;
$cursus['totaal']['aanbet_bedrag'] = 0;
$cursus['totaal']['donatie'] = 0;
$cursus['totaal']['korting'] = 0;

while ($i <= ($laatstecursus)) {

	switch ($i) {
		case $cursus_offset + 1:
			$oud = 59; // romantiek
			break;
		case $cursus_offset + 2:
			$oud = 58; // barok
			break;
	}

	$tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND CursusId_FK = {$oud} AND NOT (afgewezen <=> 1) AND datum_inschr <= DATE_SUB(NOW(), INTERVAL 1 Year)";
	d($tel_query);
	d($deelnemers_vorigjaar[$i] = select_query($tel_query, 0));
	$deelnemers_vorigjaar['totaal'] += $deelnemers_vorigjaar[$i];

	$tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND geboortedatum != 0  AND CursusId_FK = {$i} and NOT (afgewezen <=> 1)";
	$deelnemers[$i] = select_query($tel_query, 0);
	$deelnemers['totaal'] += $deelnemers[$i];

	$tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND geboortedatum != 0  AND CursusId_FK = {$i} and aangenomen = 1 and NOT (afgewezen <=> 1) ";
	$aangenomen[$i] = select_query($tel_query, 0);
	$aangenomen['totaal'] += $aangenomen[$i];

	$tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND geboortedatum != 0  AND CursusId_FK = {$i} and toehoorder = 1 and NOT (afgewezen <=> 1) ";
	$toehoorder[$i] = select_query($tel_query, 0);
	$toehoorder['totaal'] += $toehoorder[$i];

	$tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND geboortedatum != 0  AND CursusId_FK = {$i} and oost != 1 and student = 1 and NOT (afgewezen <=> 1) ";
	$student[$i] = select_query($tel_query, 0);
	$student['totaal'] += $student[$i];

	$tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND geboortedatum != 0  AND CursusId_FK = {$i} and oost = 1 and student != 1 and NOT (afgewezen <=> 1) ";
	$oost[$i] = select_query($tel_query, 0);
	$oost['totaal'] += $oost[$i];

	$tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND geboortedatum != 0  AND CursusId_FK = {$i} and student = 1 and oost = 1 and NOT (afgewezen <=> 1) ";
	$ooststudent[$i] = select_query($tel_query, 0);
	$ooststudent['totaal'] += $ooststudent[$i];

	$tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND geboortedatum != 0  AND CursusId_FK = {$i} and donatie > 0 and NOT (afgewezen <=> 1) ";
	$donateurs[$i] = select_query($tel_query, 0);
	$donateurs['totaal'] += $donateurs[$i];

	$tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr, cursus WHERE DlnmrId=DlnmrId_FK AND CursusId=CursusId_FK 
	AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND geboortedatum != 0  AND CursusId_FK = {$i} 
	and datum_inschr <= datum_korting AND aangenomen = 1 AND NOT(afgewezen <=> 1)";
	$vroeg[$i] = select_query($tel_query, 0);
	$vroeg['totaal'] += $vroeg[$i];

	$eerste_inschrijving = ($jaar - 1) . '-12-01';
	$tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr, cursus WHERE DlnmrId=DlnmrId_FK AND CursusId=CursusId_FK 
	AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" 
	AND geboortedatum != 0  AND CursusId_FK = {$i} 
	and eerste_inschrijving >= '{$eerste_inschrijving}' and NOT (afgewezen <=> 1) ";
	$nieuw[$i] = select_query($tel_query, 0);
	$nieuw['totaal'] += $nieuw[$i];

	$tel_query = "SELECT ROUND(AVG((YEAR(CURDATE())- YEAR(geboortedatum)) - (RIGHT(CURDATE(),5)<RIGHT(geboortedatum,5)))) as gemiddelde, 
	MIN((YEAR(CURDATE())- YEAR(geboortedatum)) - (RIGHT(CURDATE(),5)<RIGHT(geboortedatum,5))) as min, 
	MAX((YEAR(CURDATE())- YEAR(geboortedatum)) - (RIGHT(CURDATE(),5)<RIGHT(geboortedatum,5))) as max 
	FROM inschrijving, dlnmr, cursus WHERE DlnmrId=DlnmrId_FK AND CursusId=CursusId_FK 
	AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND geboortedatum != 0  AND CursusId_FK = {$i} 
	and NOT (afgewezen <=> 1) AND NOT (inschrijving.toehoorder <=> 1)";
	$tel = select_query($tel_query, 1);
	$leeftijd['gemiddelde'][$i] = $tel['gemiddelde']; // gemiddelde leeftijd 
	$leeftijd['min'][$i] = $tel['min'];
	$leeftijd['max'][$i] = $tel['max'];

	$gewoon[$i] = $aangenomen[$i] - $student[$i] - $oost[$i] - $ooststudent[$i] - $toehoorder[$i];

	$cursussen = select_query("select sum(cursusgeld) as cursusgeld, sum(aanbet_bedrag) as aanbet_bedrag, 
	sum(donatie) as donatie, sum(korting) as korting from inschrijving, dlnmr WHERE DlnmrId_FK = DlnmrId 
	AND aangenomen = 1 AND NOT(afgewezen <=> 1) AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" 
	AND geboortedatum != 0 AND cursusid_fk = {$i}");
	d($cursussen);
	foreach ($cursussen as $rij) {
		$cursus[$i] = $rij;
		$cursus['totaal']['cursusgeld'] += $rij['cursusgeld'];
		$cursus['totaal']['aanbet_bedrag'] += $rij['aanbet_bedrag'];
		$cursus['totaal']['donatie'] += $rij['donatie'];
		$cursus['totaal']['korting'] += $rij['korting'];
	}

	// begin Recordset busheen
	$query_busheen = "SELECT count(*) as heen FROM inschrijving WHERE aangenomen = 1 AND busheen = 1 AND cursusid_fk = {$i} and NOT (afgewezen <=> 1) ";
	$cursus[$i]['busheen'] = select_query($query_busheen, 0);
	// end Recordset

	// begin Recordset busterug
	$query_busterug = "SELECT count(*) as terug FROM inschrijving WHERE aangenomen = 1 AND busterug = 1 AND cursusid_fk = {$i} and NOT (afgewezen <=> 1) ";
	$cursus[$i]['busterug'] = select_query($query_busterug, 0);
	// end Recordset

	// begin Recordset
	$query_Eenp = "SELECT InschId FROM inschrijving WHERE aangenomen = 1 AND CursusId_FK = {$i} AND eenpersoons = 1 and NOT (afgewezen <=> 1)";
	$Eenp = select_query($query_Eenp);
	if (is_array($Eenp)) $Eenp_aantal[$i] = count($Eenp);
	// end Recordset

	// begin Recordset
	$query_kamperen = "SELECT count(*) FROM inschrijving WHERE aangenomen = 1 AND CursusId_FK = {$i} AND kamperen = 1 and NOT (afgewezen <=> 1)";
	$kamperen_aantal[$i] = select_query($query_kamperen, 0);
	// end Recordset

	// begin Recordset
	$query_meerpers = "SELECT count(*) FROM inschrijving WHERE aangenomen = 1 AND CursusId_FK = {$i} AND meerpers = 1 and NOT (afgewezen <=> 1)";
	$meerpers_aantal[$i] = select_query($query_meerpers, 0);
	// end Recordset

	// begin Recordset
	$query_eigenacc = "SELECT count(*) FROM inschrijving WHERE aangenomen = 1 AND CursusId_FK = {$i} AND eigen_acc = 1 and NOT (afgewezen <=> 1)";
	$eigenacc_aantal[$i] = select_query($query_eigenacc, 0);
	// end Recordset

	// begin Recordset
	$query_hotel_2pp = "SELECT count(*) FROM inschrijving WHERE aangenomen = 1 AND CursusId_FK = {$i} AND hotel_2pp = 1 and NOT (afgewezen <=> 1)";
	$hotel_2pp_aantal[$i] = select_query($query_hotel_2pp, 0);
	// end Recordset

	// begin Recordset
	$query_hotel_1pp = "SELECT count(*) FROM inschrijving WHERE aangenomen = 1 AND CursusId_FK = {$i} AND hotel_1pp = 1 and NOT (afgewezen <=> 1)";
	$hotel_1pp_aantal[$i] = select_query($query_hotel_1pp, 0);
	// end Recordset

	/* 	// begin Recordset
		$query_maaltijdpas = "SELECT count(*) FROM inschrijving WHERE aangenomen = 1 AND CursusId_FK = {$i} AND maaltijdpas = 1 and NOT (afgewezen <=> 1)";
		$maaltijdpas_aantal[$i] = select_query($query_maaltijdpas, 0);
		// end Recordset
	 */
	// begin Recordset
	$query_afgewezen = "SELECT count(*) FROM inschrijving WHERE CursusId_FK = {$i} AND afgewezen <=> 1";
	$afgewezen_aantal[$i] = select_query($query_afgewezen, 0);
	// end Recordset

	$i++;
}

?>

<!DOCTYPE HTML>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<html>

	<head>
		<title>statistieken</title>
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
		<style type="text/css">
			body {
				background-color: white;
			}

			td {
				width: 30%;
			}

			li {
				margin: 0px;
				padding: 0px;
			}

			p {
				margin-top: 0;
				margin-bottom: 0;
			}

			ul {
				margin-top: 0;
			}

			-->
		</style>
	</head>

<body>
	<div class="w3-panel">
		<table class="w3-table w3-striped">
			<tr>
				<?php

				$i = $cursus_offset + 1;

				while ($i <= ($aantal_cursussen + $cursus_offset)) {
				?>
					<td valign="top">
						<p><b>Cursus <?php echo $i ?>: </b>
						</p>
						<ul>
							<li><b>Aangenomen:&nbsp;<?php echo $aangenomen[$i]; ?>, waarvan:</b>
								<ul>
									<li>Gewoon:&nbsp;
										<?php echo $gewoon[$i]; ?>
									</li>
									<li>Student:&nbsp;
										<?php echo $student[$i]; ?>
									</li>
									<li>Oost-Europa:&nbsp;
										<?php echo $oost[$i]; ?>
									</li>
									<li>Student Oost-Eur.:&nbsp;
										<?php echo $ooststudent[$i]; ?>
									</li>
									<li>Toehoorder:&nbsp;
										<?php echo $toehoorder[$i]; ?>
									</li>
								</ul>
							</li>
							<li><strong>Nog niet aangenomen:&nbsp;<?php echo ($deelnemers[$i] - $aangenomen[$i]); ?></strong>
							</li>
							<li>Afgewezen:&nbsp;
								<?php echo $afgewezen_aantal[$i]; ?>
							</li>
							<li>Tijdige inschrijvers:&nbsp;
								<?php echo $vroeg[$i]; ?>
							</li>
							<li>Vorig jaar op deze dag:&nbsp;
								<?php echo $deelnemers_vorigjaar[$i]; ?>
							</li>
							<li>Nieuwe deelnemers:&nbsp;
								<?php echo $nieuw[$i]; ?>
							</li>
							<li>Gem. leeftijd:&nbsp;
								<?php echo $leeftijd['gemiddelde'][$i]; ?>, min.
								<?php echo $leeftijd['min'][$i] ?>, max.
								<?php echo $leeftijd['max'][$i] ?>
							</li>
						</ul>
						<p><strong>Accommodatie:</strong>
						</p>
						<ul>
							<li>Eenp.:&nbsp;
								<?php echo $Eenp_aantal[$i]; ?> +
								<?php echo $docenten_eenpersoons[$i]; ?> docenten =
								<?php echo ($docenten_eenpersoons[$i] + $Eenp_aantal[$i]); ?>
							</li>
							<li>Kamperen:&nbsp;
								<?php echo $kamperen_aantal[$i]; ?>
							</li>
							<li>Meerpers.:&nbsp;
								<?php echo $meerpers_aantal[$i]; ?>
							</li>
							<li>Elektra eenpers.:&nbsp;
								<?php echo $hotel_1pp_aantal[$i]; ?>
							</li>
							<li>Elektra tweepers.:&nbsp;
								<?php echo $hotel_2pp_aantal[$i]; ?>
							</li>
							<li>Eigen accommodatie:&nbsp;
								<?php echo $eigenacc_aantal[$i]; ?>
							</li>
							<!--						<li>Maaltijdpas:&nbsp;<?php echo $maaltijdpas_aantal[$i]; ?></li>-->
						</ul>
						<p><strong>Bus:</strong>
						</p>
						<ul>
							<li>Buspassagiers heen:&nbsp;
								<?php echo $cursus[$i]['busheen']; ?>
							</li>
							<li>Buspassagiers terug:&nbsp;
								<?php echo $cursus[$i]['busterug']; ?>
							</li>
						</ul>
						<p><strong>Betaling:</strong>
						</p>
						<ul>
							<li>Cursusgeld:&nbsp;
								<?php echo euro($cursus[$i]['cursusgeld']); ?>
							</li>
							<li>Donaties:&nbsp;
								<?php echo euro($cursus[$i]['donatie']); ?>
							</li>
							<li>Kortingen:&nbsp;
								<?php echo euro($cursus[$i]['korting']); ?>
							</li>
							<li><strong>Totaal te ontvangen:&nbsp;
									<?php echo euro($cursus[$i]['cursusgeld'] + $cursus[$i]['donatie'] - $cursus[$i]['korting']); ?></strong>
							</li>
							<li>Al betaald:&nbsp;
								<?php echo euro($cursus[$i]['aanbet_bedrag']); ?>
							</li>
							<li>Nog te ontvangen:&nbsp;
								<?php echo euro($cursus[$i]['cursusgeld'] + $cursus[$i]['donatie'] - $cursus[$i]['korting'] -
									$cursus[$i]['aanbet_bedrag']); ?>
							</li>
						</ul>
					</td>
				<?php
					$i++;
				}
				?>
			</tr>
			<tr>
				<td colspan="<?php echo $aantal_cursussen; ?>" valign="top">
					<p>Totaal aangenomen deelnemers:&nbsp;
						<?php echo $aangenomen['totaal']; ?> | cursusgeld:&nbsp;
						<?php echo euro($cursus['totaal']['cursusgeld']); ?> | donaties:&nbsp;
						<?php echo euro($cursus['totaal']['donatie']); ?> | aantal donateurs:&nbsp;
						<?php echo $donateurs['totaal']; ?> | kortingen:&nbsp;
						<?php echo euro($cursus['totaal']['korting']); ?> | totaal te ontvangen:&nbsp;
						<?php echo euro($cursus['totaal']['cursusgeld'] + $cursus['totaal']['donatie'] - $cursus['totaal']['korting']); ?>
					</p>
					<p>Totaal al betaald:&nbsp;
						<?php echo euro($cursus['totaal']['aanbet_bedrag']); ?> | Totaal nog te ontvangen:&nbsp;
						<?php echo euro($cursus['totaal']['cursusgeld'] + $cursus['totaal']['donatie'] - $cursus['totaal']['korting'] - $cursus['totaal']['aanbet_bedrag']); ?> | gemiddelde leeftijd
						<?php $meer = $aangenomen['totaal'] - $deelnemers_vorigjaar['totaal'];
						if (isset($aangenomen['totaal']) and $aangenomen['totaal'] > 0) $percentage_meer = round(($meer / $aangenomen['totaal']) * 100);
						if (isset($leeftijd['gemiddelde']) and $leeftijd['gemiddelde'] > 0) echo round(array_sum($leeftijd['gemiddelde']) / (count($leeftijd['gemiddelde']))); ?> | aantal deelnemers vorig jaar
						<?php echo $deelnemers_vorigjaar['totaal']; ?> (<?php if ($meer >= 0) echo '+';
																		echo $meer . ' = ' . $percentage_meer . '%'; ?>)
					</p>
				</td>
			</tr>
		</table>
	</div>
</body>

</html>