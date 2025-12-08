<?php //Connection statement
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2026.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/LPmailer.inc.php');

Kint::$enabled_mode = false;


d($_SESSION, $_POST);

// begin Recordset
$query_wanbetalers = "SELECT
  naam,
  voornaam,
  email,
  taal,
  DATEDIFF(CURDATE(), datum_inschr) AS dagen,
  aanmaning_inschr,
  rekening_verzonden,
  DlnmrId,
  InschId,
  aangenomen,
  CursusId_FK,
  rekening_opmerking
FROM inschrijving,
  dlnmr
WHERE voorl_bev IS NULL
	AND DlnmrId_FK = DlnmrId
	AND achternaam NOT LIKE '%XXX%'
	AND achternaam NOT LIKE '%YYY%'
	AND achternaam NOT LIKE '%ZZZ%'
	AND geboortedatum != 0
	and aanbet_bedrag = 0 or aanbet_bedrag IS NULL
	AND (rekening_opmerking IS NULL OR rekening_opmerking NOT LIKE '%cash%')
	AND NOT(afgewezen <=> 1)
	AND CursusId_FK BETWEEN {$eerstecursus} AND {$laatstecursus}
ORDER BY dagen DESC";

d($query_wanbetalers);
d($wanbetalers = select_query($query_wanbetalers));
if (isset($wanbetalers) and is_array($wanbetalers)) $totalRows_wanbetalers = count($wanbetalers);
else $totalRows_wanbetalers = 0;
// end Recordset

if ((isset($_POST["aanmanen"])) && ($_POST["aanmanen"] == "aanmanen")) {

	foreach ($wanbetalers as $i => $wanbetaler) {

		if (isset($_POST["C{$i}"]) and $_POST["C{$i}"] != "") {

			// begin Recordset
			$query_aanmaning = sprintf(
				"SELECT naam, voornaam, email, taal FROM dlnmr WHERE DlnmrId=%s",
				quote($_POST["C{$i}"])
			);
			$aanmaning = select_query($query_aanmaning, 1);
			// end Recordset

			// lees de tekst-file
			d($aanmaning);
			if ($aanmaning['taal'] == "NL") $mail_text_file = "../bevestiging/inschr._niet_betaald_NL.htm";
			else $mail_text_file = "../bevestiging/inschr._niet_betaald_EN.htm";

			$fh = fopen($mail_text_file, 'r');
			$mail_text = fread($fh, filesize($mail_text_file));
			fclose($fh);
			$mail_text = str_replace("{voornaam}", $aanmaning['voornaam'], $mail_text);

			//echo "De mail-tekst is: {$mail_text}<br><br>";

			// stuur een mail
			$mail = new LPmailer();

			$mail->AddAddress($aanmaning['email'], stripslashes($aanmaning['naam']));
			if ($aanmaning['taal'] == "NL")
				$mail->Subject = "La Pellegrina - inschrijfgeld zomercursus niet ontvangen";
			else
				$mail->Subject = "La Pellegrina - deposit summer school not received";
			$mail->From    = "info@pellegrina.net";
			$mail->AddCC("info@pellegrina.net", "La Pellegrina PHP mailer");
			$mail->Body    = $mail_text;

			$mail->AltBody = strip_tags($mail_text);
			if (!$mail->Send()) {
				echo "Bericht kon niet verzonden worden.<br>";
				echo "Mailer Error: " . $mail->ErrorInfo;
				exit;
			}

			echo "Bericht verzonden.<br>";
			$dln = $_POST["C{$i}"];
			exec_query(sprintf("UPDATE inschrijving SET aanmaning_inschr=CURDATE() WHERE DlnmrId_FK=$dln"));
		} //	if (isset($_POST["C{$i}"])


	} // foreach

} // if ((isset($_POST["aanmanen"]))

?>
<!DOCTYPE HTML>
<html>

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
	<title>LP aanmaning inschrijfgeld</title>
	<link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
	<link rel="stylesheet" href="/css/LP_onderhoud.css" type="text/css">
	<script LANGUAGE="JavaScript" TYPE="text/javascript">
		function switchAll() {
			for (var j = 0; j < <?php echo $totalRows_wanbetalers; ?>; j++) {
				box = eval("self.document.zoek.C" + j);
				box.checked = !box.checked;
			}
		}
	</script>
</head>

<body>
	<div id="zoeknaam"> <?php require_once('LP_zoeknaam.php'); ?> </div>
	<div id="mainframe">
		<header id="navigatiebalk"> <?php require_once('LP_navigatie.php'); ?>
		</header>
		<div id="mainpage">
			<h3>Verzend reminder aan deelnemers die nog niet hun inschrijfgeld
				hebben overgemaakt</h3><br>
			<p>In totaal <?php echo $totalRows_wanbetalers; ?> deelnemers hebben
				nog geen inschrijfgeld betaald</p>
			<form action="" method="post" name="zoek" id="zoek">
				<table border="1" cellpadding="2" cellspacing="0">
					<tr>
						<th>Aanmanen:&nbsp;</th>
						<th>Inschrijving:&nbsp;</th>
						<th>Naam:&nbsp;</th>
						<th>Cursus:&nbsp;</th>
						<th>Dagen sinds inschrijving:&nbsp;</th>
						<th>Aanmaning reeds verzonden:&nbsp;</th>
						<th>Rekening verzonden d.d.:&nbsp;</th>
						<th>Opmerkingen:&nbsp;</th>
						<th>Aangenomen:&nbsp;</th>
					</tr> <?php
							if (isset($wanbetalers) and is_array($wanbetalers)) {
								foreach ($wanbetalers as $i => $wanbetaler) {
									if ($wanbetaler['aanmaning_inschr'] != 0)
										$a = date('d-m-Y', strtotime($wanbetaler['aanmaning_inschr']));
									else
										$a = "";
							?> <tr>
								<td><input name="C<?php echo $i; ?>" type="checkbox"
										value="<?php echo $wanbetaler['DlnmrId']; ?>"
										<?php if ($a != "") echo ' DISABLED '; ?>>&nbsp;
								</td>
								<td><?php echo $wanbetaler['InschId']; ?>&nbsp;</td>
								<td><?php echo $wanbetaler['naam']; ?>&nbsp;</td>
								<td class="w3-right-align">
									<?php echo $wanbetaler['CursusId_FK']; ?>&nbsp;</td>
								<td class="w3-right-align">
									<?php echo $wanbetaler['dagen']; ?>&nbsp;</td>
								<td class="w3-right-align"><?php echo $a; ?>&nbsp;</td>
								<td><?php echo $wanbetaler['rekening_verzonden']; ?>&nbsp;
								</td>
								<td><?php echo $wanbetaler['rekening_opmerking']; ?>&nbsp;
								</td>
								<td class="w3-right-align">
									<?php echo $wanbetaler['aangenomen']; ?>&nbsp;</td>
							</tr> <?php
								}
							}
									?>
				</table>
				<p>
					<label>
						<input name="alle" type="checkbox" id="alle" value="1"
							OnClick="switchAll()"> Selecteer alle namen</label>
					<input name="aanmanen" type="submit" id="aanmanen"
						value="aanmanen">
				</p>
				<input name="aantal" type="hidden"
					value="<?php echo $totalRows_wanbetalers; ?>">
			</form>
		</div>
	</div>
</body>

</html>