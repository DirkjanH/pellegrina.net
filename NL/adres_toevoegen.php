<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);

error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';

Kint::$enabled_mode = false;

// begin Recordset
$colname__Aanvraag = '-1';
if (isset($_POST['id'])) {
  $colname__Aanvraag = $_POST['id'];
}
$Aanvraag = select_query(sprintf("SELECT * FROM aanvragen WHERE id = %s", $colname__Aanvraag), 1);
// end Recordset

// build the form action
$editFormAction = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" . $_SERVER['QUERY_STRING'] : "");

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "info-aanvraag"))
	{
		$error = false;
		$fout = "<h2>Het formulier is nog niet volledig ingevuld. De volgende gegevens 
		ontbreken:</h2> \n<ul>\n";

// corrigeer hoofdlettergebruik
				if (empty($_POST['land'])) $_POST['land'] = "Netherlands";
				if (isset($_POST['voornaam'])) $_POST['voornaam'] = stripslashes(rtrim(ucfirst($_POST['voornaam'])));
				if (isset($_POST['tussenvoegsels'])) $_POST['tussenvoegsels'] = stripslashes(rtrim($_POST['tussenvoegsels']));
				if (isset($_POST['achternaam'])) $_POST['achternaam'] = stripslashes(rtrim(ucfirst($_POST['achternaam'])));
				if (isset($_POST['adres'])) $_POST['adres'] = stripslashes(rtrim(ucfirst($_POST['adres'])));
				if (isset($_POST['plaats'])) $_POST['plaats'] = stripslashes(rtrim(ucfirst($_POST['plaats'])));

				if (empty($_POST['instrstem'])) $_POST['instrstem'] = "";
				
		// check actie:
		if (empty($_POST['actie']))
			{
				$error = true;
				$fout	.= "   <li>Je hebt nog niet een keuze aangegeven wat je precies wilt opgeven, of dat je uit het bestand geschrapt wilt worden. Klik één van de keuzerondjes boven aan.</li>\n";
			}

		// check voornaam:
		if (empty($_POST['voornaam']))
			{
				$error = true;
				$fout	.= "   <li>Je voornaam is niet ingevuld</li>\n";
			}

		// check achternaam:
		if (empty($_POST['achternaam']))
			{
				$error = true;
				$fout	.= "   <li>Je achternaam is niet ingevuld</li>\n";
			}

/* 		// check adres:
		if (empty($_POST['adres']))
			{
				$error = true;
				$fout	.= "   <li>Je adres is niet ingevuld</li>\n";
			}

		// check postcode:
		if (empty($_POST['postcode']))
			{
				$error = true;
				$fout	.= "   <li>Je postcode is niet ingevuld</li>\n";
			}

		// check plaatsnaam:
		if (empty($_POST['plaats']))
			{
				$error = true;
				$fout	.= "   <li>Je plaatsnaam is niet ingevuld</li>\n";
			}

		// check geboortedatum:
		if (empty($_POST['geslacht']))
			{
				$error = true;
				$fout	.= "   <li>De hokjes man / vrouw zijn niet ingevuld</li>\n";
			}

 */		// check email:
		if (empty($_POST['email']) or !strstr($_POST['email'], "@") or !strstr($_POST['email'], ".") or strstr($_POST['email'], " "))
			{
				$error = true;
				$fout	.= "   <li>Je emailadres is niet of niet correct ingevuld</li>\n";
			}

		$fout .= "</ul>\n<p>Ga naar de desbetreffende velden op het formulier en vul de gegevens aan. 
					Druk daarna nogmaals op 'Formulier verzenden'.</p>
					<p>Mocht het niet lukken het formulier te verzenden, dan kun je de gevraagde gegevens ook in een 
					normale email versturen aan <a href=\"mailto:info@pellegrina.net\">info@pellegrina.net</a>, 
					of het formulier uitprinten, invullen en per post verzenden 
					aan <a href=\"contact.htm\"><em>La Pellegrina</em></a>.</p>\n";
		  
		if ($error)
			{
			echo $fout;
			}
		else
			{
  				$insertSQL = sprintf("INSERT INTO aanvragen (folder, voornaam, tussenvoegsels, achternaam, taal, instrstem, geslacht, adres, pc, plaats, land, telefoon, mobiel, email, opmerkingen, geboortedatum, datum_inschr) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, NOW())",
                       GetSQLValueString($_POST['actie'], "text"),
                       GetSQLValueString($_POST['voornaam'], "text"),
                       GetSQLValueString($_POST['tussenvoegsels'], "text"),
                       GetSQLValueString($_POST['achternaam'], "text"),
                       GetSQLValueString("NL", "text"),
                       GetSQLValueString($_POST['instrstem'], "text"),
                       GetSQLValueString($_POST['geslacht'], "text"),
                       GetSQLValueString($_POST['adres'], "text"),
                       GetSQLValueString($_POST['postcode'], "text"),
                       GetSQLValueString($_POST['plaats'], "text"),
                       GetSQLValueString($_POST['land'], "text"),
                       GetSQLValueString($_POST['telefoon'], "text"),
                       GetSQLValueString($_POST['mobiel'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['opmerkingen'], "text"),
                       GetSQLValueString($_POST['geboortedatum'], "text"));

	  exec_query($insertSQL);
	
		// gegevens voor het mailtje:
				$to = $_POST['email'];
				$from = "info@pellegrina.net";
				$message = "Beste {$_POST['voornaam']},\n\n";
				$naam = "{$_POST['voornaam']}";
				if (isset($_POST['tussenvoegsels']) && $_POST['tussenvoegsels'] != "") $naam .= " {$_POST['tussenvoegsels']}";
				$naam .= " {$_POST['achternaam']}";
				
				if ($_POST['actie'] == 'delete') {

				// maak een subject aan:
						$subject = "Gegevens uit bestand La Pellegrina verwijderd";
							
				// maak de tekst van het emailbericht aan:
						$message .= "Wij ontvingen je bericht met de wens je gegevens uit het bestand van La Pellegrina te verwijderen.\n
										De  gegevens zijn inmiddels gewist.";
						$message .= "\n\n";
										if (isset($_POST['opmerkingen']) and $_POST['opmerkingen'] != "")
							{
								$_POST['opmerkingen'] = stripslashes($_POST['opmerkingen']);
								$message .= "Je opmerkingen waren: {$_POST['opmerkingen']}\n";
							}
						$message .= "\r\nMet muzikale groet,\n\nLa Pellegrina";
						$message = stripslashes($message);
		
						$headers = "From: $from\r\n";
						$headers .= "Bcc: info@pellegrina.net\r\n";
						if (empty($subject)) $subject = " ";
						}
				else {
		// maak een subject aan:
						$subject = "Gegevens/email toegevoegd aan bestand La Pellegrina";
							
				// maak de tekst van het emailbericht aan:
						$message .= "Hartelijk dank voor het toevoegen van je gegevens c.q. emailadres aan het bestand van La Pellegrina. De volgende gegevens zijn geregistreerd:\n\n";
						$message .= "{$naam}\n";
						$message .= "{$_POST['email']}\n";
						if (isset($_POST['geboortedatum'])and ($_POST['geboortedatum'] != "")) $message .= "{$_POST['geboortedatum']}\n";
						if (isset($_POST['adres'])and ($_POST['adres'] != "")) $message .= "{$_POST['adres']}\n";
						if (isset($_POST['plaats'])and ($_POST['plaats'] != "")) $message .= "{$_POST['postcode']} {$_POST['plaats']}";
						if (isset($_POST['land'])and ($_POST['land'] != "")) $message .= ", {$_POST['land']}\n";
						if (isset($_POST['telefoon'])and ($_POST['telefoon'] != "")) $message .= "{$_POST['telefoon']}";
						if (isset($_POST['mobiel'])and ($_POST['mobiel'] != "")) $message .= " | {$_POST['mobiel']}\n";
						if (isset($_POST['instrstem'])and ($_POST['instrstem'] != "")) $message .= " | {$_POST['instrstem']}";
						$message .= "\n\n";
										if (isset($_POST['opmerkingen']) and $_POST['opmerkingen'] != "")
							{
								$_POST['opmerkingen'] = stripslashes($_POST['opmerkingen']);
								$message .= "Je opmerkingen waren: {$_POST['opmerkingen']}\n";
							}
						$message .= "\r\nMet muzikale groet,\n\n\nLa Pellegrina";
						$message = stripslashes($message);
		
						$headers = "From: $from\r\n";
						$headers .= "Bcc: info@pellegrina.net\r\n";
						$headers .= "Content-Type: text/plain; charset=utf-8\r\n";
						$headers .= "Content-Transfer-Encoding: 8bit\r\n";

						if (empty($subject)) $subject = " ";
					}
				

			// mail versturen:
				$mailOK = mail("$to", "$subject", "$message", "$headers");

			// bericht ter bevestiging:
 				if ($mailOK) 
					{
			// redirect naar de dank.php pagina's
					echo "Dank voor uw informatie. Er is zojuist een email ter bevestiging naar u verstuurd!<br>";
					$insertGoTo = "/NL/dank_info.php";
					$vn = urlencode($_POST['voornaam']);
					$insertGoTo .= "?voornaam=$vn";
					KT_redir($insertGoTo);
					}
				else echo "De mail is niet verstuurd!<br>";
			}
 	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
   function onSubmit(token) {
     document.getElementById("info-aanvraag").submit();
   }
 </script>
</head>
<body>
<form action="<?php echo $editFormAction; ?>" method="POST" id="info-aanvraag">
  <?php if ((empty($_POST["MM_insert"])) or ($_POST["MM_insert"] != "info-aanvraag")) 
	{
		echo '<h2 class="begin">Adresgegevens toevoegen aan het bestand</h2>
         <p> <i>La Pellegrina</i> verstuurt van tijd tot tijd een nieuwsbrief over de zomercursussen en andere projecten van het volgende seizoen. Wil je op de hoogte blijven, vul dan dit formulier in. Alle informatie over de cursussen van dit jaar
            vind je op deze website; je ontvangt hierover dus geen informatie. Je gegevens worden toegevoegd aan de mailinglist van <i>La
            Pellegrina</i>, zodat je in de toekomst informatie over zomercursussen
            en aanverwante project ontvangt per email.</p>
			<ul>
            <li>Voeg hieronder je email en adres toe aan het bestand van <i>La
                  Pellegrina</i>.</li>
            <li>Als je gegevens verder al bekend zijn kun je met dit formulier
               je e-mailadres toegevoegen aan het bestand. Ook kun je zo een
               adreswijziging doorgeven. </li>
            <li>Ook kun je hier aangeven geen informatie van <i>La Pellegrina </i>meer
               te willen ontvangen.</li>
         </ul>';
	}
?>
  <table>
    <tr valign="baseline">
      <td align="right" nowrap><div align="right">
          <input <?php if (!(strcmp($Aanvraag['folder'],"email"))) {echo "CHECKED";} ?> type="radio" name="actie" value="email">
        </div></td>
      <td><b>Ik ben al bekend bij <i>La Pellegrina. </i>Voeg
        mijn email toe aan het bestand </b><span class="nadruk">(tenminste
        je naam en emailadres invullen en op verzenden
        drukken)</span></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap><div align="right">
          <input <?php if (!(strcmp($Aanvraag['folder'],"alles"))) {echo "CHECKED";} ?> type="radio" name="actie" value="alles">
        </div></td>
      <td><b>Ik wil graag op de hoogte gehouden worden van
        de activiteiten van <i>La Pellegrina</i> <span class="nadruk">(alle
        velden invullen en op verzenden drukken)</span></b></td>
    </tr>
    <tr valign="baseline">
      <td width="209" align="right" nowrap><div align="right">
          <input <?php if (!(strcmp($Aanvraag['folder'],"delete"))) {echo "CHECKED";} ?> type="radio" name="actie" value="delete">
        </div></td>
      <td><b>Ik wil geen informatie van <i>La Pellegrina</i> meer
        ontvangen <span class="nadruk">(je naam en eventueel
        de reden van je opzegging onder 'opmerkingen'
        invullen en op verzenden drukken)</span></b></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><div align="right">Voornaam:</div></td>
      <td><input type="text" name="voornaam" value="<?php 
						if (isset($_POST['voornaam'])) echo $_POST['voornaam']; ?>" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><div align="right">Tussenvoegsels:</div></td>
      <td><input type="text" name="tussenvoegsels" value="<?php 
						if (isset($_POST['tussenvoegsels'])) echo $_POST['tussenvoegsels']; ?>" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><div align="right">Achternaam:</div></td>
      <td><input type="text" name="achternaam" value="<?php 
						if (isset($_POST['achternaam'])) echo $_POST['achternaam']; ?>" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><div align="right">E-mail:</div></td>
      <td><input type="text" name="email" value="<?php 
						if (isset($_POST['email'])) echo $_POST['email']; ?>" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><div align="right">Instr./stemsoort:</div></td>
      <td><input type="text" name="instrstem" value="<?php 
						if (isset($_POST['instrstem'])) echo $_POST['instrstem']; ?>" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right">Geboortedatum <span class="nadruk">(dd-mm-jjjj)</span>:</div></td>
      <td><input type="text" name="geboortedatum" value="<?php 
						if (isset($_POST['geboortedatum'])) echo $_POST['geboortedatum']; ?>" size="10" />
        <input type="radio" name="geslacht" value="M"  <?php if (isset($_POST['geslacht']) 
						and ($_POST['geslacht'] == "M")) echo 'checked'; ?> />
        Man
        <input type="radio" name="geslacht" value="V"   <?php if (isset($_POST['geslacht']) 
						and ($_POST['geslacht'] == "V")) echo 'checked'; ?> />
        Vrouw 
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><div align="right">Adres:</div></td>
      <td><input type="text" name="adres" value="<?php 
						if (isset($_POST['adres'])) echo $_POST['adres']; ?>" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><div align="right">Postcode:</div></td>
      <td><input type="text" name="postcode" value="<?php 
						if (isset($_POST['postcode'])) echo $_POST['postcode']; ?>" size="10" />
        Plaats:
        <input type="text" name="plaats" value="<?php 
						if (isset($_POST['plaats'])) echo $_POST['plaats']; ?>" size="25" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><div align="right">Land:</div></td>
      <td><span class="nadruk">(alleen invullen indien niet
        Nederland)</span><br>
        <input type="text" name="land" value="<?php 
						if (isset($_POST['land'])) echo $_POST['land']; ?>" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><div align="right">Telefoon:</div></td>
      <td><input type="text" name="telefoon" value="<?php 
						if (isset($_POST['telefoon'])) echo $_POST['telefoon']; ?>" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><div align="right">Mobiele
          telefoon:</div></td>
      <td><input type="text" name="mobiel" value="<?php 
						if (isset($_POST['mobiel'])) echo $_POST['mobiel']; ?>" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><div align="right">Opmerkingen:</div></td>
      <td><textarea name="opmerkingen" cols="50" rows="4"><?php 
						if (isset($_POST['opmerkingen'])) echo $_POST['opmerkingen']; ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><button data-sitekey="6LcMbAIkAAAAANkqG0D-L46IHFm8z2-8bRCT6tEg" 
						  data-callback="onSubmit" 
						  data-action="submit"
						  class="g-recaptcha w3-btn w3-green"/>Verzenden</button>
						<button name="reset" type="reset" class="w3-btn"/>Formulier leegmaken</button></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="info-aanvraag">
  <?php if (isset($_POST['opmerkingen']) && ($_POST['opmerkingen'] != "")) $_POST['opmerkingen'] = 
			stripslashes($_POST['opmerkingen']); ?>
</form>
</body>
</html>