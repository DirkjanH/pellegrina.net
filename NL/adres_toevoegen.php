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
$adresformulierTaal = 'NL';

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "info-aanvraag"))
	{
		$error = false;
		$fout = "<h2>Het formulier is nog niet volledig ingevuld. De volgende gegevens 
		ontbreken:</h2> \n<ul>\n";

// corrigeer hoofdlettergebruik
				foreach (['actie', 'voornaam', 'tussenvoegsels', 'achternaam', 'email', 'instrstem', 'geboortedatum', 'geslacht', 'adres', 'postcode', 'plaats', 'land', 'telefoon', 'opmerkingen'] as $veld) {
					if (isset($_POST[$veld]) && !is_string($_POST[$veld])) {
						$error = true;
						$fout .= "<li>Een veld bevat een ongeldige waarde. Vul het formulier opnieuw in.</li>\n";
						$_POST[$veld] = '';
					}
					$_POST[$veld] = trim($_POST[$veld] ?? '');
				}
				if (isset($_POST['voornaam'])) $_POST['voornaam'] = stripslashes(rtrim(ucfirst($_POST['voornaam'])));
				if (isset($_POST['tussenvoegsels'])) $_POST['tussenvoegsels'] = stripslashes(rtrim($_POST['tussenvoegsels']));
				if (isset($_POST['achternaam'])) $_POST['achternaam'] = stripslashes(rtrim(ucfirst($_POST['achternaam'])));
				if (isset($_POST['adres'])) $_POST['adres'] = stripslashes(rtrim(ucfirst($_POST['adres'])));
				if (isset($_POST['plaats'])) $_POST['plaats'] = stripslashes(rtrim(ucfirst($_POST['plaats'])));

				if (empty($_POST['instrstem'])) $_POST['instrstem'] = "";
				
		// check actie:
		if (!in_array($_POST['actie'], ['email', 'alles', 'delete'], true))
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

		if ($_POST['actie'] !== 'delete') {
			foreach (['adres' => 'adres', 'postcode' => 'postcode', 'plaats' => 'plaats', 'land' => 'land', 'instrstem' => 'instrument/stemsoort', 'telefoon' => 'telefoonnummer', 'geboortedatum' => 'geboortedatum'] as $veld => $label) {
				if ($_POST[$veld] === '') {
					$error = true;
					$fout .= "<li>Vul je {$label} in.</li>\n";
				}
			}
		}

		if ($_POST['geboortedatum'] !== '') {
			$geboortedatum = preg_match('/^[0-9]{2}-[0-9]{2}-[0-9]{4}$/D', $_POST['geboortedatum'])
				? DateTimeImmutable::createFromFormat('!d-m-Y', $_POST['geboortedatum']) : false;
			if (!$geboortedatum || $geboortedatum->format('d-m-Y') !== $_POST['geboortedatum'] || $geboortedatum > new DateTimeImmutable('today')) {
				$error = true;
				$fout .= "<li>Vul een geldige geboortedatum in als dd-mm-jjjj, niet in de toekomst.</li>\n";
			}
		}

		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
			{
				$error = true;
				$fout	.= "   <li>Je emailadres is niet of niet correct ingevuld</li>\n";
			}

		$fout .= "</ul>\n<p>Ga naar de desbetreffende velden op het formulier en vul de gegevens aan. 
					Druk daarna nogmaals op 'Formulier verzenden'.</p>
					<p>Mocht het niet lukken het formulier te verzenden, dan kun je de gevraagde gegevens ook in een 
					normale email versturen aan <a href=\"mailto:info@pellegrina.net\">info@pellegrina.net</a>, 
					of het formulier uitprinten, invullen en per post verzenden 
					aan <a href=\"contact.php\"><em>La Pellegrina</em></a>.</p>\n";
		  
		if (!$error)
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
                       GetSQLValueString('', "text"),
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
<link href="/css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
<title>Adresgegevens en nieuwsbrief</title>
</head>
<body>
<?php require __DIR__ . '/../includes/adresformulier.php'; ?>
</body>
</html>