<?php
// stel php in dat deze fouten weergeeft
ini_set('display_errors', 1);
error_reporting(E_ERROR);

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2026.php');

use Pelago\Emogrifier\CssInliner;
use PhpParser\Node\Expr\Isset_;

ob_start();

Kint::$enabled_mode = true;

d($_REQUEST, $_POST, $_SESSION);

if (isset($_POST['DlnmrId']) and $_POST['DlnmrId'] != '') $_SESSION['DlnmrId'] = $_POST['DlnmrId'];

// Kies tarievenmodule:
require_once("tarieven.php");

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/mailfuncties.inc.php';

$query_cursus = "SELECT
  CursusId,
  plaats_kort,
  cursusnr,
  cursusnaam_nl,
  cursusplaats_nl,
  cursusdatum_nl,
  cursusnaam_en,
  cursusplaats_en,
  cursusdatum_en,
  cursusnaam_de,
  cursusplaats_de,
  cursusdatum_de,
  datum_begin,
  datum_eind,
  datum_korting,
  UNIX_TIMESTAMP(datum_korting) AS u_datum_korting,
  datum_beslissing,
  UNIX_TIMESTAMP(datum_beslissing) AS u_datum_beslissing,
  datum_betaling,
  UNIX_TIMESTAMP(datum_betaling) AS u_datum_betaling,
  max_dlnmrs,
  login_website,
  prijs_volledig,
  prijs_student,
  prijs_ce,
  prijs_ce_student,
  prijs_cr,
  prijs_cr_student,
  eenpers,
  hotel_1pp,
  hotel_2pp,
  hotel_1_2pp,
  meerpers,
  kamperen,
  diner,
  toehoorder,
  korting_vroeg,
  korting_meer,
  korting_eigen_acc
FROM
  cursus
WHERE cursusId BETWEEN {$eerstecursus}
  AND {$laatstecursus}
ORDER BY datum_begin";

d($query_cursus);

$cursussen = select_query($query_cursus);

foreach ($cursussen as $cur) {
	$cursus[$cur['CursusId']] = $cur;
	$cursus[$cur['CursusId']]['NL'] = $cur['cursusnaam_nl'] . ' ' . $jaar . ' te ' . $cur['plaats_kort'];
	$cursus[$cur['CursusId']]['EN'] = $cur['cursusnaam_en'] . ' ' . $jaar . ' at ' . $cur['plaats_kort'];
}

d($cursus);

$_SESSION['cursus'] = $_POST['CursusId_FK'];

// end Recordset cursusgegevens

function LeesInschrijving($id, $cursusId)
{
	global $eerstecursus, $laatstecursus, $inschrijf, $inschrijving, $aantal_inschrijvingen;

	if (isset($cursusId) and $cursusId > 0)
		$cursuszoek = 'AND CursusId = ' . $cursusId;

	// begin Recordset 'zoek inschrijving'
	if (isset($id) and $id > 0) {
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
		  i.toehoorder,
		  i.eenpersoons,
		  i.hotel_1pp,
		  i.hotel_2pp,
		  i.hotel_1_2pp,
		  i.kamperen,
		  i.meerpers,
		  aangenomen,
		  afgewezen,
		  meerdaneen,
		  aangebracht,
		  aanbet_bedrag,
		  info_korting,
		  UNIX_TIMESTAMP(voorl_bev) AS voorl_bev,
		  storting_fonds,
		  donatie,
		  PayPal,
		  korting,
		  eigen_acc,
		  i.diner,
		  extra,
		  datum_inschr,
		  DATEDIFF(datum_inschr, datum_korting) as tijdig,
		  UNIX_TIMESTAMP(datum_inschr) AS u_datum_inschr,
		  CursusId_FK,
		  DlnmrId_FK,
		  InschId,
		  datum_inschr
		FROM inschrijving as i,
		  dlnmr,
		  adres, 
		  cursus
		WHERE DlnmrId = DlnmrId_FK
			AND AdresId = AdresId_FK
			AND CursusId = CursusId_FK
			AND CursusId_FK BETWEEN %s AND %s
			 {$cursuszoek}
			 AND DlnmrId_FK=%s 
		ORDER BY CursusId_FK, achternaam ASC",
			quote($eerstecursus),
			quote($laatstecursus),
			quote($id)
		);

		d($query_inschrijving);

		$inschrijving = select_query($query_inschrijving);
		if (is_array($inschrijving))
			$aantal_inschrijvingen = count($inschrijving);
		else
			$aantal_inschrijvingen = 0;

		d($inschrijving);
	}

	// end Recordset
}

if (
	empty($_SESSION['DlnmrId']) or $_SESSION['DlnmrId'] == ""
	or $_POST['leegmaken'] == 'Leegmaken'
)
	$id = -1;
else
	$id = $_SESSION['DlnmrId'];

if ((isset($_POST["update"])) && ($_POST["update"] == "Update aanmelding")) {
	$updateSQL = sprintf(
		"UPDATE inschrijving SET storting_fonds=%s, donatie=%F, aangenomen=%s, aangebracht=%s, 
  afgewezen=%s, info_korting=%s, korting=%F, extra=%F, aanbet_bedrag=%F, PayPal=%s, meerdaneen=%s, cursusgeld=%F WHERE InschId=%s",
		quote(+isset($_POST['storting_fonds'])),
		str2num($_POST['donatie']),
		quote(+$_POST['aangenomen']),
		quote($_POST['aangebracht']),
		quote(+isset($_POST['afgewezen'])),
		quote(+$_POST['info_korting']),
		preg_replace("/,/", ".", $_POST['korting']),
		preg_replace("/,/", ".", $_POST['extra']),
		preg_replace("/,/", ".", $_POST['aanbet_bedrag']),
		quote(+isset($_POST['PayPal'])),
		quote(+isset($_POST['meerdaneen'])),
		str2num($_POST['cursusgeld']),
		quote($_POST['InschId'])
	);

	d($updateSQL);
	exec_query($updateSQL);
} // update 

if ((isset($_POST["bevestig"])) && ($_POST["bevestig"] == "Bevestig aanmelding")) {
	$updateSQL = sprintf(
		"UPDATE inschrijving SET storting_fonds=%s, donatie=%F, aanbetaling=now(), aangebracht=%s, aangenomen=%s, 		
	afgewezen=%s, voorl_bev=CURDATE(), info_korting=%s,
	korting=%F, extra=%F, aanbet_bedrag=%F, PayPal=%s, meerdaneen=%s, cursusgeld=%F WHERE InschId=%s",
		quote(+isset($_POST['storting_fonds'])),
		str2num($_POST['donatie']),
		quote($_POST['aangebracht']),
		quote(+isset($_POST['aangenomen'])),
		quote(+isset($_POST['afgewezen'])),
		quote(+$_POST['info_korting']),
		preg_replace("/,/", ".", $_POST['korting']),
		preg_replace("/,/", ".", $_POST['extra']),
		preg_replace("/,/", ".", $_POST['aanbet_bedrag']),
		quote(+isset($_POST['PayPal'])),
		quote(+isset($_POST['meerdaneen'])),
		preg_replace("/,/", ".", $_POST['cursusgeld']),
		quote($_POST['InschId'])
	);

	d($updateSQL);
	exec_query($updateSQL);

	if (isset($_SESSION['DlnmrId']) && $_SESSION['DlnmrId'] != 0 && isset($_SESSION['cursus']) && $_SESSION['cursus'] != 0)
		LeesInschrijving($_SESSION['DlnmrId'], $_SESSION['cursus']);

	// lees de tekst-file
	$actiedatum = $cursus[$_POST['CursusId_FK']]['datum_korting'];
	$cursusnaam = $cursus[$_POST['CursusId_FK']]['login_website'];


	if ($_POST['taal'] == "NL")
		$info_per_cursus = file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/bevestiging/bev_' . $cursusnaam . '_NL.txt');
	else
		$info_per_cursus = file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/bevestiging/bev_' . $cursusnaam . '_EN.txt');

	d($actiedatum, $_POST['datum_inschr'], $_POST['taal'], $info_per_cursus, $cursusnaam);

	if ($actiedatum > date('c')) {

		//	echo 'voor of op actiedatum<br>';
		if ($_POST['taal'] == "NL")
			$mail_text = file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/bevestiging/voorl. bev. NL_voor_1-3.htm');
		else
			$mail_text = file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/bevestiging/voorl. bev. EN_voor_1-3.htm');
	} else {
		//	echo 'na actiedatum<br>';
		if ($_POST['taal'] == "NL")
			$mail_text = file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/bevestiging/voorl. bev. NL_na_1-3.htm');
		else
			$mail_text = file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/bevestiging/voorl. bev. EN_na_1-3.htm');
	}

	$mail_text = str_replace("{voornaam}", $_POST['voornaam'], $mail_text);
	if (
		$_POST['taal'] == "NL"
		or $_POST['taal'] == 'DE'
	) {
		setlocale(LC_ALL, 'nl_NL');
		$mail_text = str_replace("{aanbet_bedrag}", euro2($_POST['aanbet_bedrag']), $mail_text);
		$mail_text = str_replace("{cursusgeld}", euro2($_POST['cursusgeld']), $mail_text);
		$mail_text = str_replace("{datum_korting}", strftime('%e %B', $cursus[$_POST['CursusId_FK']]['u_datum_korting']), $mail_text);
		$mail_text = str_replace("{datum_beslissing}", strftime('%e %B', $cursus[$_POST['CursusId_FK']]['u_datum_beslissing']), $mail_text);
		$mail_text = str_replace("{datum_betaling}", strftime('%e %B', $cursus[$_POST['CursusId_FK']]['u_datum_betaling']), $mail_text);
	} else {
		setlocale(LC_ALL, 'en_US');
		$mail_text = str_replace("{cursusgeld}", euro_en2($_POST['cursusgeld']), $mail_text);
		$mail_text = str_replace("{aanbet_bedrag}", euro_en2($_POST['aanbet_bedrag']), $mail_text);
		$mail_text = str_replace("{datum_beslissing}", strftime('%B %e', $cursus[$_POST['CursusId_FK']]['u_datum_beslissing']), $mail_text);
		$mail_text = str_replace("{datum_betaling}", strftime('%B %e', $cursus[$_POST['CursusId_FK']]['u_datum_betaling']), $mail_text);
	}

	$mail_text = str_replace("{info_per_cursus}", $info_per_cursus, $mail_text);

	$mail_text = str_replace("{wensen}", stripslashes($_POST['wensen']), $mail_text);
	$mail_text = str_replace("{donatie}", stripslashes($_POST['donatietxt']), $mail_text);
	$mail_text = str_replace("{login_website}", $cursus[$_POST['CursusId_FK']]['login_website'], $mail_text);
	if (isset($_POST['opmerking']) and $_POST['opmerking'] != "") {
		$_POST['opmerking'] = stripslashes($_POST['opmerking']);
		$opmerking = "<p>{$_POST['opmerking']}</p>";
	} else
		$opmerking = "";
	$mail_text = str_replace("{opmerking}", $opmerking, $mail_text);

	d($mail_text);

	// stuur een mail
	$mail = new LPmailer();
	$mail->AddAddress($_POST['email'], stripslashes($_POST['naam']));
	if ($_POST['taal'] == "NL")
		$mail->Subject = "La Pellegrina bevestiging";
	else
		$mail->Subject = "La Pellegrina confirmation";
	$mail->From = "info@pellegrina.net";
	$mail->AddBCC("php@pellegrina.net", "La Pellegrina PHP mailer");

	$css = file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/css/mailing.css');

	$emogrifier = CssInliner::fromHtml($mail_text)->inlineCss($css)->render();

	d($emogrifier);

	$mail->Body = $emogrifier;

	$mail->AltBody = strip_tags($emogrifier);

	d($mail);

	if ($_POST['afgewezen'] != 'on' or $insch['afgewezen' != 1]) {
		if (!$mail->Send()) {
			echo "Bericht kon niet verzonden worden.<br>";
			echo "Mailer Error: " . $mail->ErrorInfo;
			exit;
		} else
			echo "<p class=\"w3-red w3-small\">Bericht verzonden</p>";
	}
} // update & verzend voorlopige bevestiging 

// begin Recordset 'dlnmr' voor deelnemersnaam
$query_dlnmr = "SELECT naam, voornaam, taal, email, oost, student, (YEAR(CURDATE())-YEAR(geboortedatum))
 - (RIGHT(CURDATE(),5)<RIGHT(geboortedatum,5)) AS leeftijd FROM dlnmr WHERE DlnmrId = {$id}";

d($query_dlnmr);

$dlnmr = select_query($query_dlnmr, 1);

LeesInschrijving($_SESSION['DlnmrId'], $_SESSION['cursus']);

// end Recordset

?>
<!DOCTYPE HTML>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<META NAME="robots" CONTENT="noindex, nofollow">
	<link rel="apple-touch-icon" sizes="180x180"
		href="https://pellegrina.net/Images/Logos/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32"
		href="https://pellegrina.net/Images/Logos/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16"
		href="https://pellegrina.net/Images/Logos/favicon-16x16.png">
	<link rel="manifest"
		href="https://pellegrina.net/Images/Logos/site.webmanifest">
	<link rel="mask-icon"
		href="https://pellegrina.net/Images/Logos/safari-pinned-tab.svg"
		color="#5bbad5">
	<link rel="shortcut icon"
		href="https://pellegrina.net/Images/Logos/favicon.ico">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-config"
		content="https://pellegrina.net/Images/Logos/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	<title>LP voorlopige bevestiging</title>
	<link rel="stylesheet" href="/css/pellegrina_stijlen.css">
	<link rel="stylesheet" href="/css/LP_onderhoud.css">
	<style type="text/css">
		textarea {
			width: 100%;
			height: auto;
			overflow: auto;
		}
	</style>
	<SCRIPT TYPE="text/javascript">
		function ConfirmMsg() {
			if (self.document.update.voorl_bev.checked) {
				document.MM_returnValue = confirm(
					'Deze gegevens zijn al bevestigd. Wil je nog een bevestiging sturen?'
				);
			} else if (self.document.update.aanbet_bedrag.value < 90) {
				document.MM_returnValue = confirm(
					'Heb je het inschrijfgeld correct ingevuld? Het lijkt te laag'
				);
			}
		}

		function GP_popupConfirmMsg(msg) { //v1.0
			document.MM_returnValue = confirm(msg);
		}
	</SCRIPT>
</head>

<body>
	<div id="zoeknaam"> <?php require_once('LP_zoeknaam.php'); ?> </div>
	<div id="mainframe">
		<header id="navigatiebalk"> <?php require_once('LP_navigatie.php'); ?>
		</header>
		<div id="mainpage" class="w3-panel w3-white" style="max-width: 900px;">
			<table border="0" align="left" width="100%" class="w3-table">
				<tr>
					<td colspan="5">
						<form id="zoek" name="zoek" method="get"
							action="<?php echo $editFormAction; ?>"> Id: <input
								name="DlnmrId" type="text"
								value="<?php if (isset($_SESSION['DlnmrId'])) echo $_SESSION['DlnmrId']; ?>"
								size="5" />
							<input type="submit" name="Submit" value="Zoek">
						</form>
					</td>
				</tr> <?php
						if ($aantal_inschrijvingen > 1) {
							echo "<tr><td colspan=\"3\">";
							echo "<p><b>Kies één van de volgende inschrijvingen:</b></p>";
							echo "<form action=\"{$editFormAction}\" method=\"get\" name=\"inschrijving\" id=\"inschrijving\"> \n <select name=\"cursus\" size=\"{$aantal_inschrijvingen}\" >";
							foreach ($inschrijving as $i => $inschr) {
								echo "<option value=\"{$inschr['CursusId_FK']}\"";
								if (!(strcmp($inschr['CursusId_FK'], $_SESSION['cursus']))) echo "SELECTED";
								echo '>' . $cursus[$inschr['CursusId_FK']]['NL'];
							}
							echo "</option>\n</select>";
							echo '<input name="DlnmrId" type="hidden" value="';
							if (isset($_SESSION['DlnmrId'])) echo $_SESSION['DlnmrId'] . '" />';
							echo '<input type="submit" name="Submit" value="Zoek">';
							echo '</form></td></tr>';
						} else
							$insch = $inschrijving[0];
						d($insch);
						?> <tr>
					<td colspan="5">
						<h2>Naam: <?php echo $dlnmr['naam']; ?> - Taal:
							<?php echo $dlnmr['taal']; ?> </h2>
					</td>
				</tr>
				<form action="<?php echo $editFormAction; ?>" method="POST"
					name="update" id="update">
					<tr>
						<td height="0" colspan="5"> <?php if ($insch['CursusId_FK'] != "")
														echo "Inschrijving nr. 
			<input name=\"InschId\" type=\"text\" DISABLED value=\"{$insch['InschId']}\"
			size=\"2\">&nbsp;voor cursus:&nbsp;<b>{$cursus[$insch['CursusId_FK']]['NL']}</b>
			d.d. {$insch['datum_inschr']}"; ?>&nbsp; <input name="CursusId_FK"
								type="hidden" value="<?php
														echo $insch['CursusId_FK']; ?>">
							<input name="InschId" type="hidden" value="<?php
																		echo $insch['InschId']; ?>">
						</td>
					</tr>
					<tr valign="baseline">
						<td nowrap align="right">
							<div align="right">Storting fonds:</div>
						</td>
						<td><input type="checkbox" name="storting_fonds"
								value="1" <?php if ($insch['storting_fonds'] == 1 or $insch['donatie'] > 0) {
												echo "checked";
											} ?> />
						</td>
						<td>Gedoneerd bedrag: </td>
						<td>&#8364;&nbsp; <input name="donatie" type="text"
								id="donatie" value="<?php
													echo $insch['donatie']; ?>" size="6" />
						</td>
						<td>&nbsp;</td>
					</tr>
					<tr valign="middle">
						<td align="right" valign="top" nowrap>
							<div align="right">Info kortingen: </div>
						</td>
						<td><input name="info_korting" type="checkbox"
								id="info_korting" value="1" <?php if (!(strcmp($insch['info_korting'], 1))) {
																echo "checked";
															} ?> />
						</td>
						<td>Toegekende korting:</td>
						<td>&#8364;&nbsp; <input name="korting" type="text"
								id="korting" value="<?php
													echo $insch['korting']; ?>" size="6" />
						</td>
						<td>Voor: <span class="nadruk">[aanbrengen van apart
								vermelden]</span> <input name="aangebracht"
								type="text" id="aangebracht" value="<?php
																	echo $insch['aangebracht']; ?>" size="20" />
						</td>
					</tr>
					<tr valign="middle">
						<td align="right" valign="top" nowrap>Meer dan één
							cursus:</td>
						<td><input name="meerdaneen" type="checkbox"
								id="meerdaneen" value="1" <?php if (!(strcmp($insch['meerdaneen'], 1))) {
																echo "checked";
															} ?> />
						</td>
						<td>Extra cursusgeld:</td>
						<td>&#8364;&nbsp; <input name="extra" type="text"
								id="extra" value="<?php
													echo $insch['extra']; ?>" size="6" />
						</td>
						<td>&nbsp;</td>
					</tr>
					<tr valign="baseline">
						<td nowrap align="right">
							<div align="right">Aangenomen:</div>
						</td>
						<td><input name="aangenomen" type="checkbox"
								id="aangenomen" value="1" <?php if (!(strcmp($insch['aangenomen'], 1))) {
																echo "checked";
															} ?> />
							<label>Leeftijd:&nbsp; <input name="geb_datum"
									type="text" id="geb_datum" size="2"
									value="<?php echo $dlnmr['leeftijd']; ?>">
							</label>
						</td>
						<td height="30">Afgewezen:</td>
						<td height="30"><input name="afgewezen" type="checkbox"
								id="afgewezen" <?php if (!(strcmp($insch['afgewezen'], 1))) {
													echo "checked";
												} ?> />
						</td>
						<td>&nbsp;</td>
					</tr>
					<tr valign="baseline">
						<td nowrap align="right"> <?php // bereken cursusgeld

													$ins['oost'] = $dlnmr['oost'];
													$ins['student'] = $dlnmr['student'];
													$ins['leeftijd'] = $dlnmr['leeftijd'];
													$ins['taal'] = $dlnmr['taal'];
													$ins['toehoorder'] = intval($insch['toehoorder']);
													$ins['kamperen'] = $insch['kamperen'];
													$ins['meerpers'] = $insch['meerpers'];
													$ins['eenpersoons'] = $insch['eenpersoons'];
													$ins['hotel_1pp'] = $insch['hotel_1pp'];
													$ins['hotel_2pp'] = $insch['hotel_2pp'];
													$ins['hotel_1_2pp'] = $insch['hotel_1_2pp'];
													$ins['storting_fonds'] = $insch['storting_fonds'];
													$ins['donatie'] = $insch['donatie'];
													$ins['PayPal'] = $insch['PayPal'];
													$ins['meerdaneen'] = $insch['meerdaneen'];
													$ins['korting'] = $insch['korting'];
													$ins['eigen_acc'] = $insch['eigen_acc'];
													$ins['diner'] = $insch['diner'];
													$ins['aangebracht'] = $insch['aangebracht'];
													$ins['extra'] = $insch['extra'];
													$ins['tijdig'] = intval($insch['tijdig']);
													$ins['CursusId'] = $insch['CursusId_FK'];
													$factuur = cursusgeld($ins);

													d($ins);
													d($factuur);

													?> <div align="right">Cursusgeld:</div>
						</td>
						<td>&#8364;&nbsp; <input type="text" name="cursusgeld"
								value="<?php if (
											isset($_SESSION['DlnmrId'])
											and $_SESSION['DlnmrId'] > 0
										)
											echo (float) $factuur['cursusgeld']; ?>" size="6" />
						</td>
						<td align="right" nowrap>Betaald inschrijfgeld:</td>
						<td>&#8364;&nbsp; <input type="text"
								name="aanbet_bedrag" id="aanbet_bedrag" value="<?php
																				echo (float) $insch['aanbet_bedrag']; ?>" size="6" />
							<INPUT TYPE="button" NAME="inschr" VALUE="€ 300"
								onClick="self.document.update.aanbet_bedrag.value='300'">
						</td>
						<td>&nbsp;</td>
					</tr>
					<tr valign="baseline">
						<td>
							<div align="right">Voorlopige bevestiging:
								<?php d($insch['voorl_bev']); ?> </div>
						</td>
						<td><input type="checkbox" name="voorl_bev" <?php if ($insch['voorl_bev'] != NUll and $insch['voorl_bev'] > 0) {
																		echo "checked";
																		$voorl_bev = TRUE;
																	} ?> />&nbsp; </td>
						<td>PayPal-betaling:</td>
						<td><input name="PayPal" type="checkbox" id="PayPal" <?php if ($insch['PayPal'] == 1)
																					echo "checked"; ?> value="1" />&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr valign="baseline">
						<td align="right" valign="top" nowrap>
							<div align="right">Wensen</div>
						</td>
						<td colspan="4"><textarea name="wensen"><?php
																if (isset($_SESSION['DlnmrId']) and $_SESSION['DlnmrId'] > 0)
																	echo $factuur['wensen']; ?></textarea>
						</td>
					</tr>
					<tr valign="baseline">
						<td align="right" valign="top" nowrap>
							<div align="right">Donatie </div>
						</td>
						<td colspan="4"><textarea name="donatietxt"><?php
																	if (isset($_SESSION['DlnmrId']) and $_SESSION['DlnmrId'] > 0)
																		echo $factuur['donatie']; ?></textarea>
						</td>
					</tr>
					<tr valign="middle">
						<td align="right" valign="top" nowrap>
							<div align="right">Opmerkingen:</div>
						</td>
						<td colspan="4"><textarea name="opmerking"
								id="opmerking"><?php
												if (isset($_POST['opmerking']))
													echo stripslashes($_POST['opmerking']); ?></textarea>
						</td>
					</tr>
					<tr valign="baseline">
						<td>&nbsp;</td>
						<td valign="baseline">
							<div class="rechts">
								<input name="update" type="submit"
									value="Update aanmelding" />
							</div>
						</td>
						<td valign="baseline">&nbsp;</td>
						<td valign="baseline"
							onClick="ConfirmMsg();return self.document.MM_returnValue">
							<input type="submit" name="bevestig"
								value="Bevestig aanmelding" />
						</td>
						<td valign="baseline"
							onClick="ConfirmMsg();return self.document.MM_returnValue">
							&nbsp;</td>
					</tr>
					<input type="hidden" name="voornaam"
						value="<?php echo $dlnmr['voornaam']; ?>" />
					<input type="hidden" name="email"
						value="<?php echo $dlnmr['email']; ?>" />
					<input type="hidden" name="naam"
						value="<?php echo $dlnmr['naam']; ?>" />
					<input type="hidden" name="taal"
						value="<?php echo $dlnmr['taal']; ?>" />
					<input type="hidden" name="datum_inschr"
						value="<?php echo $insch['datum_inschr']; ?>" />
				</form>
			</table>
			</td>
			</tr>
			</table>
		</div>
	</div> <?php ob_end_flush(); ?>
</body>

</html>