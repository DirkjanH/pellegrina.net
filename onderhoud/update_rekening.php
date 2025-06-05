<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['inschrijving']) and empty($_GET['DlnmrId'])) $inschrijving = $_SESSION['inschrijving'];

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2025.php');

Kint::$enabled_mode = true;

d($_REQUEST, $_SESSION);

// Kies tarievenmodule:
require_once('tarieven.php');

require_once('../includes/LPmailer.inc.php');

function send_alert($msg)
{

	echo "<script language=\"javascript\">alert(\"{$msg}\");</script>";
}  //end function 

if (empty($_GET['DlnmrId']) or $_GET['DlnmrId'] == "") $id = -1;
else $id = $_GET['DlnmrId'];

// begin Recordset inschrijving

if ($id == -1) {
	$query_inschrijving = sprintf(
		"SELECT
  voornaam,
  naam,
  adres,
  postcode,
  plaats,
  land,
  taal,
  email,
  (YEAR(CURDATE())-YEAR(geboortedatum)) - (RIGHT(CURDATE(),5)<RIGHT(geboortedatum,5)) AS leeftijd,
  i.toehoorder,
  eenpersoons,
  i.hotel_2pp, 
  i.hotel_1pp,
  i.kamperen,
  i.meerpers,
  aangenomen,
  afgewezen,
  aanbet_bedrag,
  info_korting,
  voorl_bev,
  cursusgeld,
  storting_fonds,
  donatie,
  PayPal,
  korting,
  extra,
  DATEDIFF(datum_inschr, datum_korting) as tijdig,
  paypal,
  oost,
  student,
  meerdaneen,
  eigen_acc,
  i.diner,
  rekening_verzonden,
  CursusId_FK,
  DlnmrId_FK,
  InschId
FROM inschrijving AS i,
  dlnmr AS d,
  adres AS a, 
  cursus AS c
WHERE DlnmrId = DlnmrId_FK
    AND AdresId = AdresId_FK
    AND CursusId = CursusId_FK
    AND aangenomen = 1
    AND achternaam NOT LIKE \"%%XXX%%\"
    AND achternaam NOT LIKE \"%%YYY%%\"
    AND achternaam NOT LIKE \"%%ZZZ%%\"
    AND geboortedatum != 0  
	AND NOT(afgewezen <=> 1)
    AND CursusId_FK BETWEEN %s AND %s
    AND rekening_verzonden Is Null
--	AND cursusgeld + donatie - korting - aanbet_bedrag != 0
ORDER BY CursusId_FK, achternaam ASC",
		GetSQLValueString($eerstecursus, "int"),
		GetSQLValueString($laatstecursus, "int")
	);

	d($query_inschrijving);

	$inschrijving = select_query($query_inschrijving);
	d($inschrijving);
	if ($inschrijving) echo 'Totaal te versturen rekeningen: ' . count($inschrijving) . '<br>';
} else { // ook naar mensen die al een rekening ontvingen
	$query_inschrijving = sprintf(
		"SELECT
  voornaam,
  naam,
  adres,
  postcode,
  plaats,
  land,
  taal,
  email,
  (YEAR(CURDATE())-YEAR(geboortedatum)) - (RIGHT(CURDATE(),5)<RIGHT(geboortedatum,5)) AS leeftijd,
  i.toehoorder,
  eenpersoons,
  i.hotel_2pp, 
  i.hotel_1pp, 
  i.kamperen,
  i.meerpers,
  aangenomen,
  afgewezen,
  aanbet_bedrag,
  info_korting,
  voorl_bev,
  cursusgeld,
  storting_fonds,
  donatie,
  PayPal,
  korting,
  extra,
  DATEDIFF(datum_inschr, datum_korting) as tijdig,
  paypal,
  oost,
  student,
  meerdaneen,
  eigen_acc,
  i.diner,
  aangebracht,
  rekening_verzonden,
  CursusId_FK,
  DlnmrId_FK,
  InschId
FROM inschrijving AS i,
  dlnmr AS d,
  adres AS a, 
  cursus AS c
WHERE DlnmrId = DlnmrId_FK
    AND AdresId = AdresId_FK
    AND CursusId = CursusId_FK
    AND aangenomen = 1
    AND achternaam NOT LIKE \"%%XXX%%\"
    AND achternaam NOT LIKE \"%%YYY%%\"
    AND achternaam NOT LIKE \"%%ZZZ%%\"
    AND geboortedatum != 0  
	AND NOT(afgewezen <=> 1)
    AND CursusId_FK BETWEEN %s AND %s
	AND DlnmrId_FK=%s 
ORDER BY CursusId_FK, achternaam ASC",
		GetSQLValueString($eerstecursus, "int"),
		GetSQLValueString($laatstecursus, "int"),
		GetSQLValueString($id, "int")
	);

	if (empty($inschrijving) or $inschrijving == FALSE) $inschrijving = select_query($query_inschrijving);
	if (is_array($inschrijving)) $aantal_inschrijvingen = count($inschrijving);
	else echo ('<div class="w3-container w3-panel w3-card-4 w3-white w3-text-red"><p><b>Deze inschrijving bestaat (nog) niet</b></p></div>');
	d($inschrijving);
}
// end Recordset inschrijving

$query_cursus = "SELECT
    CursusId
    , cursusnr
    , cursusnaam_nl
    , cursusplaats_nl
    , cursusdatum_nl
    , cursusnaam_en
    , cursusplaats_en
    , cursusdatum_en
    , cursusnaam_de
    , cursusplaats_de
    , cursusdatum_de
    , datum_begin
    , datum_eind
    , datum_korting
	, UNIX_TIMESTAMP(datum_korting) as u_datum_korting 
    , datum_beslissing
	, UNIX_TIMESTAMP(datum_beslissing) as u_datum_beslissing 
    , datum_betaling
	, UNIX_TIMESTAMP(datum_betaling) as u_datum_betaling 
    , max_dlnmrs
    , login_website
    , prijs_volledig
    , prijs_student
    , prijs_ce
    , prijs_ce_student
    , prijs_cr
    , prijs_cr_student
    , eenpers
    , hotel_2pp
    , hotel_1pp
    , meerpers
    , kamperen
    , toehoorder
    , diner
    , korting_vroeg
    , korting_meer
	, korting_eigen_acc
FROM
    cursus 
WHERE cursusId BETWEEN {$eerstecursus} AND {$laatstecursus} 
ORDER BY datum_begin";
//echo "query_cursus = {$query_cursus}<br><br>";
$cursus = select_query($query_cursus, 'CursusId');
foreach ($cursus as &$cur) {
	$cur['NL'] = $cur['cursusnaam_nl'] . ' ' . $jaar;
	$cur['EN'] = $cur['cursusnaam_en'] . ' ' . $jaar;
}
d($cursus);
// end Recordset cursusgegevens

// Open de rekeningteksten
$mail_text_file_NL = "../bevestiging/rekening_NL.htm";
$mail_text_file_EN = "../bevestiging/rekening_EN.htm";

$fh = fopen($mail_text_file_NL, 'rb');
$rek_NL = fread($fh, filesize($mail_text_file_NL));
fclose($fh);

$fh = fopen($mail_text_file_EN, 'rb');
$rek_EN = fread($fh, filesize($mail_text_file_EN));
fclose($fh);

if ((isset($_POST["verzend"])) && ($_POST["verzend"] == "Maak rekeningen")) {

	$totaal_rekeningen = 0;
	foreach ($inschrijving as $inschr) {

		$inschr['aanbet_bedrag'] = intval($inschr['aanbet_bedrag']);
		d($inschr);

		$ins['oost'] = $inschr['oost'];
		$ins['student'] = $inschr['student'];
		$ins['leeftijd'] = $inschr['leeftijd'];
		$ins['taal'] = $inschr['taal'];
		$ins['toehoorder'] = intval($inschr['toehoorder']);
		$ins['eenpersoons'] = $inschr['eenpersoons'];
		$ins['hotel_2pp'] = $inschr['hotel_2pp'];
		$ins['hotel_1pp'] = $inschr['hotel_1pp'];
		$ins['kamperen'] = $inschr['kamperen'];
		$ins['meerpers'] = $inschr['meerpers'];
		$ins['storting_fonds'] = $inschr['storting_fonds'];
		$ins['aangebracht'] = $inschr['aangebracht'];
		$ins['tijdig'] = $inschr['tijdig'];
		$ins['donatie'] = bedrag($inschr['donatie']);
		$ins['PayPal'] = $inschr['paypal'];
		$ins['meerdaneen'] = $inschr['meerdaneen'];
		$ins['eigen_acc'] = $inschr['eigen_acc'];
		$ins['diner'] = intval($inschr['diner']);
		$ins['ACMP'] = $inschr['ACMP'];
		$ins['korting'] = bedrag($inschr['korting']);
		$ins['extra'] = bedrag($inschr['extra']);
		$ins['CursusId'] = $inschr['CursusId_FK'];

		d($ins);

		$factuur = cursusgeld($ins);

		d($factuur);

		$cursusgeld = intval($inschr['cursusgeld']);
		$factuurbedrag = intval($factuur['cursusgeld']);

		if ($factuurbedrag != $cursusgeld) {
			$boodschap = "{$inschr['naam']} heeft € {$factuurbedrag} berekend cursusgeld en € {$cursusgeld} cursusgeld volgens de database";
			send_alert($boodschap);
		}


		// kies de tekst-file
		if ($inschr['taal'] == "NL") {
			$mail_text = $rek_NL;
			setlocale(LC_ALL, "nl_NL");
		} else {
			$mail_text = $rek_EN;
			setlocale(LC_ALL, 'en_US.UTF-8');
		}

		$totaal = $inschr['cursusgeld'] + $inschr['donatie'];

		if ($totaal > 0) {
			$totaal_euro = bedrag($totaal);
			$tebetalen = bedrag($inschr['cursusgeld'] + $inschr['donatie'] - $inschr['aanbet_bedrag']);
			$inschr['cursusgeld'] = bedrag($inschr['cursusgeld']);
			$inschr['donatie'] = bedrag($inschr['donatie']);
			$inschr['aanbet_bedrag'] = bedrag($inschr['aanbet_bedrag'] * -1);
			$adresblok = $inschr['naam'] . '<br>' . $inschr['adres'] . '<br>' .
				$inschr['postcode'] . ' ' . $inschr['plaats'] . '<br>';
			if ($inschr['land'] != 'Netherlands' and $inschr['land'] != 'Nederland')
				$adresblok .= $inschr['land'] . '<br>';
			$mail_text = str_replace("{adresblok}", $adresblok, $mail_text);
			$mail_text = str_replace("{voornaam}", $inschr['voornaam'], $mail_text);
			$mail_text = str_replace("{cursus}", $cursus[$inschr['CursusId_FK']][$inschr['taal']], $mail_text);
			$mail_text = str_replace("{nr}", $inschr['InschId'], $mail_text);
			$mail_text = str_replace("{datum}", strftime('%D'), $mail_text);
			$mail_text = str_replace("{factuurregels}", $factuur['regels'], $mail_text);
			$mail_text = str_replace("{aanbet_bedrag}", $inschr['aanbet_bedrag'], $mail_text);
			$mail_text = str_replace("{cursusgeld}", $totaal_euro, $mail_text);
			$datum_betaling = strftime('%e %B %Y', strtotime($cursus[$inschr['CursusId_FK']]['datum_betaling']));
			$mail_text = str_replace("{datum_betaling}", $datum_betaling, $mail_text);
			$mail_text = str_replace("{tebetalen}", $tebetalen, $mail_text);
			$mail_text = str_replace("{wensen}", stripslashes($inschr['wensen']), $mail_text);
			if (isset($inschr['donatie']) and  $inschr['donatie'] > 0)
				$mail_text = str_replace("{donatie}", $factuur['donatie'], $mail_text);
			else $mail_text = str_replace("{donatie}", '', $mail_text);
			d($mail_text);

			// stuur een mail
			$mail = new LPmailer();
			$mail->AddAddress(stripslashes($inschr['email']), stripslashes($inschr['naam']));
			if ($inschr['taal'] == "NL") $mail->Subject = "La Pellegrina rekening";
			else $mail->Subject = "La Pellegrina invoice";
			$mail->SetFrom('info@pellegrina.net', 'La Pellegrina');
			$mail->AddCC("info@pellegrina.net", "La Pellegrina PHP mailer");
			$mail->Body    = $mail_text;

			$nr = $totaal_rekeningen + 1;

			$mail->AltBody = strip_tags($mail_text);

			if (!($_POST['verzenden'])) {
				echo "De mail-tekst is: <br>{$mail_text}";
				echo '<hr>';
			} else {
				if (!$mail->Send()) {
					echo "Bericht nr. {$nr} aan {$inschr['naam']} kon niet verzonden worden.<br>";
					echo "Mailer Error: " . $mail->ErrorInfo;
					exit();
				}
				echo "Bericht nr. {$nr} aan {$inschr['naam']} verzonden.<br>";

				$update_inschrijving = sprintf(
					"UPDATE inschrijving SET rekening_verzonden=NOW() WHERE InschId=%s",
					GetSQLValueString($inschr['InschId'], "int")
				);
				exec_query($update_inschrijving);
				$totaal_rekeningen++;
			}
		} // als totaalbedrag > 0
	} // einde deze rekening

	echo 'Totaal verzonden rekeningen: ' . $totaal_rekeningen . '<br>';
} // einde verzend rekeningen

?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Update: maak rekening</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/pellegrina_stijlen.css" type="text/css">
</head>

<body>
	<table width="90%" border="0" align="left">
		<tr>
			<td colspan="2">
				<form id="zoek" name="zoek" method="get" action="<?php echo $editFormAction; ?>">
					Id:
					<input name="DlnmrId" type="text" value="<?php if (isset($_GET['DlnmrId']))
																	echo $_GET['DlnmrId']; ?>" size="5" />
					<input type="submit" name="Submit" value="Zoek">
					Rekening al verzonden:
					<input name="rekening_verzonden" type="checkbox" id="rekening_verzonden" <?php
																								if (isset($inschr['rekening_verzonden']) and $inschr['rekening_verzonden'] != '') echo 'checked'; ?> value="1">
				</form>
			</td>
		</tr>
		<?php
		if (isset($aantal_inschrijvingen) and $aantal_inschrijvingen > 1) {
			d($inschrijving);
			echo "<tr><td colspan=\"3\">";
			echo "<p><b>Kies één van de volgende inschrijvingen:</b></p>";
			echo "<form action=\"{$editFormAction}\" method=\"get\" name=\"inschrijving\" id=\"inschrijving\"> \n <select name=\"cursus\" size=\"{$aantal_inschrijvingen}\" >";
			foreach ($inschrijving as $in) {
				echo "<option value=\"{$in['CursusId_FK']}\"";
				if (!(strcmp($in['CursusId_FK'], $_GET['cursus']))) {
					echo "SELECTED";
				}
				echo '>' . $cursus[$in['CursusId_FK']]['NL'];
			}
			echo "</option>\n</select>";
			echo '<input name="DlnmrId" type="hidden" value="';
			if (isset($_GET['DlnmrId'])) echo $_GET['DlnmrId'] . '" />';
			echo '<input type="submit" name="Submit" value="Zoek">';
			echo '</form></td></tr>';

			foreach ($inschrijving as $key => $inschrijf)
				if (isset($_GET['cursus']) and $inschrijf['CursusId_FK'] != $_GET['cursus']) unset($inschrijving[$key]);
			$_SESSION['inschrijving'] = $inschrijving;
			d($inschrijving);
		}
		?>
		<tr>
			<td colspan="2">
				<h2>Naam:&nbsp;<?php if ($id != -1) echo $inschr['naam']; ?><br>
				</h2>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<form action="<?php echo $editFormAction; ?>" method="POST" name="update" id="update">
					<p>
						<input type="submit" name="verzend" value="Maak rekeningen" />
						&nbsp;&nbsp;
						<label>Daadwerkelijk verzenden:
							<input name="verzenden" type="checkbox" id="verzenden" value="1" <?php if (isset($_POST['verzenden'])) echo 'checked'; ?>>
						</label>
						<br>
					</p>
				</form>
			</td>
		</tr>
	</table>
</body>

</html>