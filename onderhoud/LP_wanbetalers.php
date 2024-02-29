<?php //Connection statement
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/includes2024.php');
require_once("../includes/LPmailer.inc.php");
			
// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1 );

error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';

Kint::$enabled_mode = false;

if ((isset($_POST["aanmanen"])) && ($_POST["aanmanen"] == "aanmanen")) {

	d($_POST);

	$i = 0;
	
	while ($i < $_POST['aantal']) {
	
		if (isset($_POST["C{$i}"]) AND $_POST["C{$i}"] != "") {
		
			// begin Recordset
			$query_aanmaning = sprintf("
			SELECT
			  *,
			  (cursusgeld + IFNULL(donatie, 0) - IFNULL(aanbet_bedrag, 0)) AS schuld
			FROM inschrijving,
			  dlnmr
			WHERE DlnmrId_FK = DlnmrId
				AND InschId =  %s",
				GetSQLValueString($_POST["C{$i}"], "int"));

			d($query_aanmaning);
 
			$aanmaning = select_query($query_aanmaning, 1);
			
			d($aanmaning);
			
			// end Recordset
		
			// lees de tekst-file
			
			if ($aanmaning['taal'] == "NL") $mail_text_file = "../bevestiging/restbedrag_NL.htm";
			else $mail_text_file = "../bevestiging/restbedrag_EN.htm";
			
			$fh = fopen($mail_text_file, 'r');
			$mail_text = fread($fh, filesize($mail_text_file));
			fclose($fh);
			$mail_text = str_replace("{voornaam}", $aanmaning['voornaam'], $mail_text);
			if ($aanmaning['dagen'] > 0) {
				if ($aanmaning['taal'] == 'NL')  {
					$mail_text = str_replace("{aanmaning}", 'aanmaning',
					$mail_text);
				}
				else {
					$mail_text = str_replace("{aanmaning}", '2nd reminder',
					$mail_text);
				}; 
			}
			else {
				if ($aanmaning['taal'] == 'NL')  {
					$mail_text = str_replace("{aanmaning}", 'herinnering',
					$mail_text);
				}
				else {
					$mail_text = str_replace("{aanmaning}", 'reminder',
					$mail_text);
				}; 
			}
			$mail_text = str_replace("{rekeningdatum}", 
				strftime("%d-%m-%Y", strtotime($aanmaning['rekening_verzonden'])), $mail_text);
			$mail_text = str_replace("{schuld}", euro2($aanmaning['schuld']), $mail_text);
			
			// echo "De mail-tekst is: {$mail_text}<br><br>";
			
			// stuur een mail
			$mail = new LPmailer();
			
			$mail->AddAddress($aanmaning['email'], stripslashes($aanmaning['naam']));
			if ($aanmaning['taal'] == "NL") 
				$mail->Subject = "La Pellegrina - restbedrag zomercursus";
			else 
				$mail->Subject = "La Pellegrina - balance summer school";
			$mail->From    = "info@pellegrina.net";
			$mail->AddCC("dhorringa@gmail.com", "La Pellegrina PHP mailer");
			$mail->Body    = $mail_text;
			
			$mail->AltBody = strip_tags($mail_text);
			if (!$mail->Send())
					{
						echo "Bericht kon niet verzonden worden.<br>";
						echo "Mailer Error: " . $mail->ErrorInfo;
						exit;
					}
					
					echo "Bericht verzonden.<br>";
		
			$updateSQL = sprintf("UPDATE inschrijving SET aanmaning=CURDATE() WHERE InschId=%s",
									  GetSQLValueString($_POST["C{$i}"], "int"));
		
			exec_query($updateSQL);

	} //	if (isset($_POST["C{$i}"])
	   
	$i++;
	
	} // while

} // if ((isset($_POST["aanmanen"]))

// begin Recordset
$query_wanbetalers = 
"SELECT
  naam,
  voornaam,
  email,
  taal,
  aanmaning,
  rekening_verzonden,
  DlnmrId,
  CursusId_FK,
  rekening_opmerking,
  aanbet_bedrag,
  cursusgeld,
  (cursusgeld + IFNULL(donatie, 0) - IFNULL(aanbet_bedrag, 0)) AS schuld,
  DATEDIFF(CURDATE(), rekening_verzonden) AS dagen,
  InschId
FROM inschrijving,
  dlnmr
WHERE DlnmrId_FK = DlnmrId
    AND achternaam NOT LIKE '%XXX%'
    AND achternaam NOT LIKE '%YYY%'
    AND achternaam NOT LIKE '%ZZZ%'
    AND (cursusgeld + IFNULL(donatie, 0) - IFNULL(aanbet_bedrag, 0)) > 0
    AND NOT(afgewezen <=> 1)
    AND CursusId_FK BETWEEN {$eerstecursus}
    AND {$laatstecursus}
ORDER BY CursusId_FK, achternaam ASC";
$wanbetalers = select_query($query_wanbetalers);
$totalRows_wanbetalers = count($wanbetalers);
// end Recordset

d($query_wanbetalers);

?>

<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/onderhoud.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
   <META NAME="robots" CONTENT="noindex, nofollow">
   <link rel="apple-touch-icon" sizes="180x180" href="https://pellegrina.net/Images/Logos/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="https://pellegrina.net/Images/Logos/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="https://pellegrina.net/Images/Logos/favicon-16x16.png">
   <link rel="manifest" href="https://pellegrina.net/Images/Logos/site.webmanifest">

   <link rel="mask-icon" href="https://pellegrina.net/Images/Logos/safari-pinned-tab.svg" color="#5bbad5">
   <link rel="shortcut icon" href="https://pellegrina.net/Images/Logos/favicon.ico">
   <meta name="msapplication-TileColor" content="#da532c">
   <meta name="msapplication-config" content="https://pellegrina.net/Images/Logos/browserconfig.xml">
   <meta name="theme-color" content="#ffffff">
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>LP aanmaning cursusgeld</title>
<!-- InstanceEndEditable -->
	<link rel="stylesheet" href="/css/pellegrina_stijlen.css">
	<link rel="stylesheet" href="/css/onderhoud.css">
	<!-- InstanceBeginEditable name="head" -->
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

<!-- Begin
function switchAll() {
	for (var j = 1; j <= <?php echo $totalRows_wanbetalers; ?>; j++) {
	box = eval("self.document.zoek.C" + j); 
	if (!(box.disabled)) box.checked = !box.checked;
   }
}
// End -->
</script>
<!-- InstanceEndEditable -->
</head>

<body>
	<div id="zoeknaam">
		<?php require_once('LP_zoeknaam.php');?>
	</div>
	<div id="inhoud">
		<header id="navigatiebalk">
			<?php require_once('LP_navigatie.php');?>
		</header>
		<div id="mainpage">
			<!-- InstanceBeginEditable name="Mainpage" -->
<h2>Verzend reminder aan deelnemers die hun cursusgeld nog niet hebben voldaan </h2>
<br>

<p>In totaal <?php echo $totalRows_wanbetalers; ?> deelnemers hebben nog openstaand cursusgeld</p>

<form action="" method="post" name="zoek" id="zoek">
<table  border="1" cellpadding="2" cellspacing="0">
   <tr>
      <th>Aanmanen:&nbsp;</th>
      <th>Naam:&nbsp;</th>
      <th>Cursus:&nbsp;</th>
      <th>Openstaand cursusgeld</th>
      <th>Rekening verzonden d.d.:&nbsp;</th>
      <th>Dagen sinds rekening:&nbsp;</th>
      <th>Aanmaning reeds verzonden:&nbsp;</th>
      <th>Opmerkingen:&nbsp;</th>
   </tr>
   <?php foreach ($wanbetalers as $i => $wanbetaler) {
				$a = '';
				if (isset($wanbetaler['aanmaning']) AND $wanbetaler['aanmaning'] != '') $a = $wanbetaler['aanmaning'];
	?>
   <tr>
      <td><input name="C<?php echo $i; ?>" type="checkbox" value="<?php echo $wanbetaler['InschId'].'" '; 
			if (isset($wanbetaler['rekening_opmerking']) AND stripos($wanbetaler['rekening_opmerking'], 'cash')) echo(' disabled ');
			?>"</td>
      <td><?php echo $wanbetaler['naam']; ?>&nbsp;</td>
      <td><div align="center"><?php echo $wanbetaler['CursusId_FK']; ?>&nbsp;</div></td>
      <td><div align="right"><?php echo euro2($wanbetaler['schuld']); ?>&nbsp;</div></td>
      <td><?php echo $wanbetaler['rekening_verzonden']; ?>&nbsp;</td>
      <td><div align="right"><?php echo $wanbetaler['dagen']; ?>&nbsp;</div></td>
      <td><div align="center"><?php echo $a; ?>&nbsp;</div></td>
      <td><?php echo $wanbetaler['rekening_opmerking']; ?>&nbsp;</td>
   </tr>
   <?php  } ?>
</table>
<p>
   <label>
   <input name="alle" type="checkbox" id="alle" value="1" OnClick="switchAll()">
   Selecteer alle namen</label>
   <input name="aanmanen" type="submit" id="aanmanen" value="aanmanen">
</p>
<input name="aantal" type="hidden" value="<?php echo $totalRows_wanbetalers; ?>">
</form>
<!-- InstanceEndEditable -->
		</div>
	</div>
</body>
<!-- InstanceEnd --></html>
