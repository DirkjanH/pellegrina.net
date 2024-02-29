<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);

error_reporting(E_ALL);

ob_start();

require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';

Kint::$enabled_mode = false;

d($_POST);

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
		$fout = "<p class=\"kopje\">Het formulier is nog niet volledig ingevuld. De volgende gegevens 
		ontbreken:</p> \n<ul>\n";

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
				$fout	.= "   <li>You haven't indicated yet what you want us to do. Please select one of the options on the top of this form</li>\n";
			}

		// check voornaam:
		if (empty($_POST['voornaam']))
			{
				$error = true;
				$fout	.= "   <li>Your first name is not filled out</li>\n";
			}

		// check achternaam:
		if (empty($_POST['achternaam']))
			{
				$error = true;
				$fout	.= "   <li>Your surname is not filled out</li>\n";
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
				$fout	.= "   <li>Your email address is not or not correctly filled out</li>\n";
			}

		$fout .= "</ul>\n<p>Please return to the fields metioned and fill them out. Then press \"send\" again.</p>
					<p>In case you don't succeed to send this form please send a normal email containing the relevant information to <a href=\"mailto:info@pellegrina.net\">info@pellegrina.net</a>, 
					or print out the form, fill it out and send it by ordinary mail to <a href=\"contact.htm\"><em>La Pellegrina</em></a>.</p>\n";
		  
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
				$message = "Dear {$_POST['voornaam']},\n\n";
				$naam = "{$_POST['voornaam']}";
				if (isset($_POST['tussenvoegsels']) && $_POST['tussenvoegsels'] != "") $naam .= " {$_POST['tussenvoegsels']}";
				$naam .= " {$_POST['achternaam']}";
				
				if ($_POST['actie'] == 'delete') {

				// maak een subject aan:
						$subject = "Your entry in the La Pellegrina database deleted";
							
				// maak de tekst van het emailbericht aan:
						$message .= "We received your message, wishing to delete your entry from the La Pellegrina database.\nThe entry has been deleted.";
						$message .= "\n\n";
										if (isset($_POST['opmerkingen']) and $_POST['opmerkingen'] != "")
							{
								$_POST['opmerkingen'] = stripslashes($_POST['opmerkingen']);
								$message .= "Je opmerkingen waren: {$_POST['opmerkingen']}\n";
							}
						$message .= "\r\nWith musical greetings,\n\nLa Pellegrina";
						$message = stripslashes($message);
		
						$headers = "From: $from\r\n";
						$headers .= "Bcc: info@pellegrina.net\r\n";
						if (empty($subject)) $subject = " ";
						}
				else {
		// maak een subject aan:
						$subject = "Add data/email to the La Pellegrina database";
							
				// maak de tekst van het emailbericht aan:
						$message .= "Thank you very much for adding your entry to the La Pellegrina database. The following information has been registered:\n\n";
						$message .= "{$naam}\n";
						$message .= "{$_POST['email']}\n";
						if (isset($_POST['geboortedatum'])and ($_POST['geboortedatum'] != "")) $message .= "{$_POST['geboortedatum']}\n";
						if (isset($_POST['adres'])and ($_POST['adres'] != "")) $message .= "{$_POST['adres']}\n";
						if (isset($_POST['plaats'])and ($_POST['plaats'] != "")) $message .= "{$_POST['postcode']} {$_POST['plaats']}";
						if (isset($_POST['land'])and ($_POST['land'] != "")) $message .= ", {$_POST['land']}\n";
						if (isset($_POST['telefoon'])and ($_POST['telefoon'] != "")) $message .= "{$_POST['telefoon']}";
						if (isset($_POST['mobiel'])and ($_POST['mobiel'] != "")) $message .= " | {$_POST['mobiel']}\n";
						if (isset($_POST['instrstem'])and ($_POST['instrstem'] != "")) $message .= "\n{$_POST['instrstem']}";
						$message .= "\n\n";
										if (isset($_POST['opmerkingen']) and $_POST['opmerkingen'] != "")
							{
								$_POST['opmerkingen'] = stripslashes($_POST['opmerkingen']);
								$message .= "Your remarks were: {$_POST['opmerkingen']}\n";
							}
						$message .= "\r\nWith musical greetings,\n\nLa Pellegrina";
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
					echo "Thanks for your information. A confirmation email has just been sent to you.<br>";
					$insertGoTo = "../dank_info.php";
					$vn = urlencode($_POST['voornaam']);
					$insertGoTo .= "?voornaam=$vn";
					KT_redir($insertGoTo);
					}
				else echo "The mail has not been sent!<br>";
			}
 	}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
   function onSubmit(token) {
     document.getElementById("info-aanvraag").submit();
   }
 </script>
</head>
<body>
<?php

	 if ((empty($_POST["MM_insert"])) or ($_POST["MM_insert"] != "info-aanvraag")) 
	{
		echo '<h2 class="begin">Add Email address <b>to the <i>La
            Pellegrina</i> mailing list</b></h2>
      <p><i>La Pellegrina</i> will add your email address to the mailing list in order to inform you about future summer schools
        and related projects. All information about coming summer you find on this web site; you will therefore not receive any additional information. Your entry will be added to the La Pellegrina database, so that you will receive information about future summer schools and related projects.
		  <ul>
		   <li>Add your address etc. to the <i>La
                  Pellegrina</i> database using the form underneath.</li>
            <li>If you are known by La Pellegrina you can change you address or add your email address by sending this form.</li>
            <li>You can also remove your entry form the <i>La Pellegrina </i> database.</li>
         </ul>';
	}
?>
 <form action="<?php echo $editFormAction; ?>" method="POST" id="info-aanvraag">
          <table align="center">
		<tr valign="baseline">
					<td align="right" nowrap><div align="right">
							<input <?php if (!(strcmp($Aanvraag['folder'],"email"))) {echo "CHECKED";} ?> type="radio" name="actie" value="email">
						</div></td>
					<td><b>I am already know by <i>La Pellegrina. </i>Please
						add my email address to the database </b><span class="nadruk">(please
						fill out your name and email and press &quot;send&quot;) </span></td>
				</tr>
		<tr valign="baseline">
					<td align="right" nowrap><div align="right">
							<input <?php if (!(strcmp($Aanvraag['folder'],"alles"))) {echo "CHECKED";} ?> type="radio" name="actie" value="alles">
						</div></td>
					<td><b>I would like to stay informed about the activities
						of <i>La Pellegrina</i> <span class="nadruk">(please
					fill out all fields and press &quot;send&quot;)</span></b></td>
				</tr>
		<tr valign="baseline">
					<td width="209" align="right" nowrap><div align="right">
							<input <?php if (!(strcmp($Aanvraag['folder'],"delete"))) {echo "CHECKED";} ?> type="radio" name="actie" value="delete">
						</div></td>
					<td><b>I don't want to receive information from <i>La
					Pellegrina</i> anymore <span class="nadruk">(please
					fill out your name and possibly the reason
					for quitting and press &quot;send&quot;)</span></b></td>
				</tr>
		<tr valign="baseline">
					<td nowrap align="right"><div align="right">First
							name:</div></td>
					<td><input type="text" name="voornaam" value="<?php 
						if (isset($_POST['voornaam'])) echo $_POST['voornaam']; ?>" size="50" /></td>
				</tr>
		<tr valign="baseline">
					<td nowrap align="right"><div align="right">Middle
							name:</div></td>
					<td><input type="text" name="tussenvoegsels" value="<?php 
						if (isset($_POST['tussenvoegsels'])) echo $_POST['tussenvoegsels']; ?>" size="50" /></td>
				</tr>
		<tr valign="baseline">
					<td nowrap align="right"><div align="right">Surname:</div></td>
					<td><input type="text" name="achternaam" value="<?php 
						if (isset($_POST['achternaam'])) echo $_POST['achternaam']; ?>" size="50" /></td>
				</tr>
		<tr valign="baseline">
					<td nowrap align="right"><div align="right">E-mail:</div></td>
					<td><input type="text" name="email" value="<?php 
						if (isset($_POST['email'])) echo $_POST['email']; ?>" size="50" /></td>
				</tr>
		<tr valign="baseline">
					<td nowrap align="right"><div align="right">Instr./voice
							type:</div></td>
					<td><input type="text" name="instrstem" value="<?php 
						if (isset($_POST['instrstem'])) echo $_POST['instrstem']; ?>" size="50" /></td>
				</tr>
		<tr valign="baseline">
					<td nowrap="nowrap" align="right"><div align="right">Date
							of birth<span class="nadruk"> (dd-mm-yyyy)</span>:</div></td>
					<td><input type="text" name="geboortedatum" value="<?php 
						if (isset($_POST['geboortedatum'])) echo $_POST['geboortedatum']; ?>" size="10" />
				<input type="radio" name="geslacht" value="M"  <?php if (isset($_POST['geslacht']) 
						and ($_POST['geslacht'] == "M")) echo 'checked'; ?> />
				Male
				<input type="radio" name="geslacht" value="V"   <?php if (isset($_POST['geslacht']) 
						and ($_POST['geslacht'] == "V")) echo 'checked'; ?> />
				Female 
				</tr>
		<tr valign="baseline">
					<td nowrap align="right"><div align="right">Address:</div></td>
					<td><input type="text" name="adres" value="<?php 
						if (isset($_POST['adres'])) echo $_POST['adres']; ?>" size="50" /></td>
				</tr>
		<tr valign="baseline">
					<td nowrap align="right"><div align="right">Postal
							Code:</div></td>
					<td><input type="text" name="postcode" value="<?php 
						if (isset($_POST['postcode'])) echo $_POST['postcode']; ?>" size="10" />
				Place:
				<input type="text" name="plaats" value="<?php 
						if (isset($_POST['plaats'])) echo $_POST['plaats']; ?>" size="25" /></td>
				</tr>
		<tr valign="baseline">
					<td align="right" valign="middle" nowrap><div align="right">Country:</div></td>
					<td><input type="text" name="land" value="<?php 
						if (isset($_POST['land'])) echo $_POST['land']; ?>" size="50" /></td>
				</tr>
		<tr valign="baseline">
					<td nowrap align="right"><div align="right">Telephone:</div></td>
					<td><input type="text" name="telefoon" value="<?php 
						if (isset($_POST['telefoon'])) echo $_POST['telefoon']; ?>" size="50" /></td>
				</tr>
		<tr valign="baseline">
					<td nowrap align="right"><div align="right">Mobile
							telephone:</div></td>
					<td><input type="text" name="mobiel" value="<?php 
						if (isset($_POST['mobiel'])) echo $_POST['mobiel']; ?>" size="50" /></td>
				</tr>
		<tr valign="baseline">
					<td nowrap align="right" valign="top"><div align="right">Remarks:</div></td>
					<td><textarea name="opmerkingen" cols="50" rows="4"><?php 
						if (isset($_POST['opmerkingen'])) echo $_POST['opmerkingen']; ?>
</textarea></td>
				</tr>
		<tr valign="baseline">
					<td nowrap align="right">&nbsp;</td>
					<td><button data-sitekey="6LcMbAIkAAAAANkqG0D-L46IHFm8z2-8bRCT6tEg" 
						  data-callback="onSubmit" 
						  data-action="submit"
						  class="g-recaptcha w3-btn w3-green"/>Send</button>
						<button name="reset" type="reset" class="w3-btn"/>Reset form</button></td>
				</tr>
	</table>
          <input type="hidden" name="MM_insert" value="info-aanvraag">
        </form>
        <?php if (isset($_POST['opmerkingen']) && ($_POST['opmerkingen'] != "")) $_POST['opmerkingen'] = 
			stripslashes($_POST['opmerkingen']); ?>
</body>
</html>
<?php ob_flush(); ?>