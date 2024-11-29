<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);
error_reporting(E_ALL);

Kint::$enabled_mode = false;

require_once('GeneratePassword.php');
require_once $_SERVER["DOCUMENT_ROOT"] . '/includes/mailfuncties.inc.php';

setlocale(LC_ALL, 'en_GB'); // data e.d. in het Engels

$inschrijfgeld = '300.00';

$instrumenten = select_query("SELECT * FROM instr ORDER BY id ASC");
foreach ($instrumenten as $row) {
	$instrumententabel[$row['id']]['en'] = $row['en'];
	$instrumentcodetabel[$row['en']] = $row['id'];
	$instrumententabel[$row['id']]['nl'] = $row['nl'];
	$instrumentcodetabel[$row['nl']] = $row['id'];
}

d($instrumententabel, $instrumentcodetabel, $_REQUEST, $mollie);

// build the form action
$editFormAction = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" .
	$_SERVER['QUERY_STRING'] : "");

if (isset($_GET['Zoek']) and $_GET['pw'] != '' and empty($_POST)) {
	// begin Recordset
	$query_oude_gegevens =
		"SELECT 
	  * 
	FROM
	  dlnmr AS d
	  INNER JOIN
	  adres AS a 
	  LEFT OUTER JOIN inschrijving AS i 
		ON (d.DlnmrId = i.DlnmrId_FK )
	WHERE d.password = \"{$_GET['pw']}\" 
	  AND d.AdresID_FK = a.AdresId 
	GROUP BY d.naam 
	ORDER BY d.achternaam ";
	$oude_gegevens = select_query($query_oude_gegevens, 1);
}
d($query_oude_gegevens, $oude_gegevens);
// end Recordset

if (isset($oude_gegevens) and is_array($oude_gegevens)) {
	$_POST = $oude_gegevens;
	if ($_POST['instr'] != "")
		$instr = $_POST['instr'];
	else {
		$in = explode(', ', $_POST['instrumenten']);
		foreach ($in as $ins) $instr[] = $instrumentcodetabel[$ins];
		$_POST['instr'] = $instr;
		$instr = implode(', ', $_POST['instr']);
	}
	$geboortedatum = safestrtotime('Y-m-d', $_POST['geboortedatum']);
} else $zoekresultaat = "<tr><td class=\"nadruk\">This is not a valid password.</td></tr>";

d($instrumentcodetabel, $_POST);

if ((isset($_POST['submit'])) && ($_POST['submit'] == 'send the form')) {
	// corrigeer
	if (empty($_POST['land'])) $_POST['land'] = "Netherlands";
	if (isset($_POST['voornaam'])) $_POST['voornaam'] = stripslashes(rtrim(ucfirst($_POST['voornaam'])));
	if (isset($_POST['tussenvoegsels'])) $_POST['tussenvoegsels'] = stripslashes(rtrim($_POST['tussenvoegsels']));
	if (isset($_POST['achternaam'])) $_POST['achternaam'] = stripslashes(rtrim(ucfirst($_POST['achternaam'])));
	if (isset($_POST['adres'])) $_POST['adres'] = stripslashes(rtrim(ucfirst($_POST['adres'])));
	if (isset($_POST['postcode'])) $_POST['postcode'] = stripslashes(rtrim(strtoupper($_POST['postcode'])));
	if (isset($_POST['plaats'])) $_POST['plaats'] = stripslashes(rtrim(ucfirst($_POST['plaats'])));
	if (empty($_POST['niveau_i'])) $_POST['niveau_i'] = "";
	if (empty($_POST['ervaring_i'])) $_POST['ervaring_i'] = "";
	if (empty($_POST['niveau_z'])) $_POST['niveau_z'] = "";
	if (empty($_POST['ervaring_z'])) $_POST['ervaring_z'] = "";
	if (empty($_POST['vervoer'])) $_POST['vervoer'] = "";
	if (empty($_POST['donatie'])) $_POST['donatie'] = 0;

	$naam = str_replace('  ', ' ', "{$_POST['voornaam']} {$_POST['tussenvoegsels']} {$_POST['achternaam']}");

	if (isset($_POST['instr'])) {
		foreach ($_POST['instr'] as $in) $instrument[] = $instrumententabel[$in]['en'];
		$instrumentenlijst = implode(', ', $instrument);
	}
	d($instrumentenlijst);

	if (isset($_POST['instr'])) $ins = $_POST['instr'];
	if (isset($_POST['toehoorder'])) $ins[] = 500;
	$instrumenten = implode(', ', (array)$ins); // alleen instrumenten & toehoorders
	if (isset($_POST['zangstem'])) $ins[] = $_POST['zangstem'];
	$instr = implode(', ', (array)$ins); // alle functies

	if (isset($_POST['rol_z'])) $rol_z = implode(', ', $_POST['rol_z']);
	else $rol_z = "";

	d($instr);

	$error = false;

	$fout = "<div id=\"aanmeldingsprobleem\"><h2>The form has not yet been filled out completely. The following is missing or the following error occurred:</h2>\n<ul>\n";

	// check voornaam:
	if (empty($_POST['voornaam'])) {
		$error = true;
		$fout .= "   <li>Your first name is not filled out</li>\n";
	}

	// check achternaam:
	if (empty($_POST['achternaam'])) {
		$error = true;
		$fout .= "   <li>Your last name is not filled out</li>\n";
	}

	// check adres:
	if (empty($_POST['adres'])) {
		$error = true;
		$fout .= "   <li>Your address is not filled out</li>\n";
	}

	// check postcode:
	if (empty($_POST['postcode'])) {
		$error = true;
		$fout .= "   <li>Your postal code is not filled out</li>\n";
	}

	// check plaatsnaam:
	if (empty($_POST['plaats'])) {
		$error = true;
		$fout .= "   <li>Your town or city is not filled out</li>\n";
	}

	// check geboortedatum:
	if (
		empty($_POST['geboortedatum'])
		or (safestrtotime('Y-m-d', $_POST['geboortedatum']) == '1970-01-01')
		or (safestrtotime('Y', $_POST['geboortedatum']) < (date('Y') - $maximumleeftijd))
		or (safestrtotime('Y', $_POST['geboortedatum']) > (date('Y') - $minimumleeftijd))
	) {
		$error = true;
		$fout .= "   <li>Your date of birth is not or not correctly filled out. Please fill out in numbers only in the format: day-month-year (dd-mm-yyyy)</li>\n";
	}
	$geboortedatum = safestrtotime('Y-m-d', $_POST['geboortedatum']);

	// check geslacht:
	if (empty($_POST['geslacht'])) {
		$error = true;
		$fout .= "   <li>Your gender is not filled out</li>\n";
	}

	// check email:
	if (!(isset($_POST['email']) && validate($_POST['email'], 'email', 255))) {
		$error = true;
		$fout .= "   <li>Your email address is not or not correctly filled out</li>\n";
	} else $_POST['email'] = strtolower($_POST['email']);

	// check inschrijving voor welke cursus:
	if (empty($_POST['CursusId_FK'])) {
		$error = true;
		$fout .= "   <li>Please indicate for <strong>which</strong> cours(es) you want to register</li>";
	}

	// zet instrumentalist aan als instrument of stemsoort zijn ingevuld
	if (isset($_POST['instrumenten']) and $_POST['instrumenten'] != "") $_POST['instrumentalist'] = true;

	// check instr., zanger of toehoorder:
	if (empty($_POST['instrumentalist']) && empty($_POST['zanger']) && empty($_POST['solozanger']) && empty($_POST['toehoorder'])) {
		$error = true;
		$fout .= "   <li>Please indicate whether you want to take part as instrumentalist, singer or auditor</li>\n";
	}

	// check instrument voor instrumentalisten:
	if (isset($_POST['instrumentalist']) && empty($instrumentenlijst)) {
		$error = true;
		$fout .= "<li>Please indicate <b>your instrument</b></li>\n";
	}

	// check zangstem:
	if ((isset($_POST['zanger']) or isset($_POST['solozanger'])) and empty($_POST['zangstem'])) {
		$error = true;
		$fout .= "   <li>You want to take part as singer. Please indicate <b>your voice type</b></li>\n";
	}

	// check akkoord:
	if (empty($_POST['voorwaarden'])) {
		$error = true;
		$fout .= "   <li>At the bottom of the form you can indicate to agree to the conditions</li>\n";
	}

	$fout .=
		<<<FOUT
	</ul>\n<p><b>Please go to the relevant fields in the form and add the missing data. 
	Then press the button 'Send' again.</b></p>
	<p>If you don't succeed in sending the form, you can send the relevant data by ordinary email 
	to <a href="mailto:aanmelding@pellegrina.net">aanmelding@pellegrina.net</a>, 
	or print the form, fill it out and send it by ordinary mail to 
	<a href="contact.php"><em>La Pellegrina</em></a>.</p></div>\n
FOUT;

	if ($error) echo $fout;
	else {

		d($_POST);

		$f_adres = '-1';
		if (isset($_POST['adres'])) $f_adres = $_POST['adres'];
		$f_postcode = '-1';
		if (isset($_POST['postcode'])) $f_postcode = $_POST['postcode'];

		if (empty($_POST['AdresId']) or $_POST['AdresId'] == "") {
			$_POST['AdresId'] = select_query(sprintf("SELECT AdresId FROM adres WHERE adres=%s AND postcode=%s", quote($f_adres), quote($f_postcode)), 0);
		}
		if (isset($_POST['AdresId']) and $_POST['AdresId'] > 0) {
			$adresSQL = sprintf(
				"UPDATE adres SET adres=%s, postcode=%s, plaats=%s, land=%s WHERE AdresId=%s",
				quote($_POST['adres']),
				quote(strtoupper($_POST['postcode'])),
				quote($_POST['plaats']),
				quote($_POST['land']),
				quote($_POST['AdresId'])
			);
			exec_query($adresSQL);
		} else {
			$adresSQL = sprintf(
				"INSERT INTO adres (adres, postcode, plaats, land) VALUES (%s, %s, %s, %s)",
				quote($_POST['adres']),
				quote(strtoupper($_POST['postcode'])),
				quote($_POST['plaats']),
				quote($_POST['land'])
			);
			exec_query($adresSQL);
			$ID = lastID();
		}

		d($adresSQL, $ID);

		if (
			isset($_POST['AdresId'])
			and $_POST['AdresId'] > 0
		) $_POST['AdresId_FK'] = $_POST['AdresId'];
		elseif ($ID > 0)
			$_POST['AdresId_FK'] = $ID;
		else exit('Error: No valid address data!!!');

		if (isset($_POST['DlnmrId']) and $_POST['DlnmrId'] != "") $dlnmr = $_POST['DlnmrId'];
		else {
			$f_naam = '-1';
			if (isset($naam)) $f_naam = $naam;
			$f_email = '-1';
			if (isset($_POST['email'])) $f_email = $_POST['email'];
			$dlnmr = select_query(sprintf("SELECT DlnmrId FROM dlnmr WHERE naam=%s AND email=%s", quote($f_naam), quote($f_email)), 0);
		}

		if (isset($dlnmr) and $dlnmr != "") {
			d($_POST['AdresId_FK']);
			$dlnmrSQL = sprintf("UPDATE dlnmr SET voornaam=%s, tussenvoegsels=%s, achternaam=%s,
					naam=%s, geboortedatum=%s, geslacht=%s, taal=%s, telefoon=%s, mobiel=%s, email=%s, dieet=%s, 
					publiciteit=%s, naam_aanbrenger=%s, publiciteit_tx=%s, oost=%s, student=%s, 
					AdresId_FK=%s WHERE DlnmrId=%s", quote($_POST['voornaam']), quote($_POST['tussenvoegsels']), quote($_POST['achternaam']), quote($naam), quote(
				$geboortedatum,
				"date"
			), quote($_POST['geslacht']), quote($_POST['taal']), quote($_POST['telefoon']), quote($_POST['mobiel']), quote($_POST['email']), quote($_POST['dieet']), quote($_POST['publiciteit']), quote($_POST['naam_aanbrenger']), quote($_POST['publiciteit_tx']), isset($_POST['oost']) ? 1 : 0, isset($_POST['student']) ? 1 : 0, quote($_POST['AdresId_FK']), quote($dlnmr));
		} else {
			$password = generatePassword(4, true, false, true, false);
			d($_POST['AdresId_FK']);
			$dlnmrSQL = sprintf(
				"INSERT INTO dlnmr (voornaam, tussenvoegsels, achternaam, naam, password,
					geboortedatum, geslacht, taal, telefoon, mobiel, email, dieet, publiciteit, naam_aanbrenger, 
					publiciteit_tx, oost, student, AdresId_FK, 
					eerste_inschrijving) 
					VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, NOW())",
				quote($_POST['voornaam']),
				quote($_POST['tussenvoegsels']),
				quote($_POST['achternaam']),
				quote($naam),
				quote($password),
				quote($geboortedatum),
				quote($_POST['geslacht']),
				quote($_POST['taal']),
				quote($_POST['telefoon']),
				quote($_POST['mobiel']),
				quote($_POST['email']),
				quote($_POST['dieet']),
				quote($_POST['publiciteit']),
				quote($_POST['naam_aanbrenger']),
				quote($_POST['publiciteit_tx']),
				isset($_POST['oost']) ? 1 : 0,
				isset($_POST['student']) ? 1 : 0,
				$_POST['AdresId_FK']
			);
		}

		exec_query($dlnmrSQL);
		if (empty($dlnmr)) $dlnmr = lastID(); // de nieuw gegenereerde deelnemer-entry

		d($dlnmrSQL, $password);

		$Inschrijvingbestaat = select_query(sprintf("SELECT InschId FROM inschrijving WHERE DlnmrId_FK=%s AND CursusId_FK=%s", quote($dlnmr), quote($_POST['CursusId_FK'])), 0);
		d($Inschrijvingbestaat);

		if (isset($Inschrijvingbestaat) and $Inschrijvingbestaat > 0) {
			$error = true;
			$fout =
				<<<FOUT
	<link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
	<link href="/css/aanmelding.css" rel="stylesheet" type="text/css">
	<div id="aanmeldingsprobleem"><h2>Your registration has failed. The following error occurred:</h2>\n<ul>\n
	<li>You have already registered for this course. You can only register once for the same course</li>\n</ul>\n
	<p>If you want to change something in your registration or you don't succeed in sending in the form, please send the required data in a normal email to <a 	href="mailto:aanmelding@pellegrina.net">aanmelding@pellegrina.net</a>.</p></div>\n
FOUT;
		}

		if ($error) echo $fout;
		else {
			if (isset($_POST['donatie']) and $_POST['donatie'] > 0) $_POST['storting_fonds'] = 1;


			$inschrijfSQL = sprintf(
				"INSERT INTO inschrijving (instrumentalist, instrumenten, `instr`, niveau_i, ervaring_i, stukken_i, solozanger, zanger, zangstem, niveau_z, ervaring_z, stukken_z, rol_z, toehoorder, vervoer, info_korting, acc_wens, eenpersoons, kamperen, hotel_2pp, hotel_1pp, eigen_acc, diner, storting_fonds, donatie, opmerkingen, aanbetaling, voorwaarden, DlnmrId_FK, CursusId_FK, datum_inschr) 
		  VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
				  %s, %s, %s, %s, %s, %s, %s, %s, NOW());",
				isset($_POST['instrumentalist']) ? 1 : 0,
				quote($instrumenten),
				quote($instr),
				quote($_POST['niveau_i']),
				quote($_POST['ervaring_i']),
				quote(rtrim($_POST['stukken_i'])),
				isset($_POST['solozanger']) ? 1 : 0,
				isset($_POST['zanger']) ? 1 : 0,
				quote($_POST['zangstem']),
				quote($_POST['niveau_z']),
				quote($_POST['ervaring_z']),
				quote(rtrim($_POST['stukken_z'])),
				quote($rol_z),
				isset($_POST['toehoorder']) ? 1 : 0,
				quote($_POST['vervoer']),
				isset($_POST['info_korting']) ? 1 : 0,
				quote(rtrim($_POST['acc_wens'])),
				isset($_POST['eenpersoons']) ? 1 : 0,
				isset($_POST['kamperen']) ? 1 : 0,
				isset($_POST['hotel_2pp']) ? 1 : 0,
				isset($_POST['hotel_1pp']) ? 1 : 0,
				isset($_POST['eigen_acc']) ? 1 : 0,
				isset($_POST['diner']) ? 1 : 0,
				isset($_POST['storting_fonds']) ? 1 : 0,
				$_POST['donatie'],
				quote(rtrim($_POST['opmerkingen'])),
				isset($_POST['aanbetaling']) ? 1 : 0,
				isset($_POST['voorwaarden']) ? 1 : 0,
				quote($dlnmr),
				quote($_POST['CursusId_FK'])
			);

			$inschrijving_opgeslagen = exec_query($inschrijfSQL);
			$InschId = select_query("SELECT MAX(InschId) FROM inschrijving", 0);
			d($inschrijfSQL, $inschrijving_opgeslagen);

			if ($inschrijving_opgeslagen) {
				$random_id = bin2hex(random_bytes(4));
				$url = 'https://pellegrina.net/';
				$taal = 'EN';

				if (isset($_POST['betaling']) and $_POST['betaling'] == 'mollie') {
					try {
						$payment = $mollie->payments->create([
							"amount" => ["currency" => "EUR", "value" => $inschrijfgeld],
							"description" => "La Pellegrina registration nr. {$InschId}",
							"redirectUrl" => $url . $taal . '/dank.php?res=' . $random_id,
							"webhookUrl" => $url . 'algemeen/webhook.php',
							"metadata" => ["Naam" => $naam, "order_id" => $InschId, "random_id" => $random_id]
						]);

						$payment = $payment->update();

						d($payment);
						$status = quote($payment->status);
						$Mollie_ID = quote($payment->id);

						$insertSQL = sprintf("UPDATE inschrijving SET betaalstatus = $status, random_id = '$random_id', Mollie_ID = $Mollie_ID WHERE InschId = '$InschId';");
						$succes = exec_query($insertSQL);
						d($insertSQL, $succes, $payment->getCheckoutUrl());
						if ($succes) header("Location: {$payment->getCheckoutUrl()}", true, 303);
					} catch (\Mollie\Api\Exceptions\ApiException $e) {
						echo "API call failed: " . htmlspecialchars($e->getMessage());
					}
				} elseif (isset($_POST['betaling']) and $_POST['betaling'] == 'transfer') {
					$insertSQL = sprintf("UPDATE inschrijving SET betaalstatus = 'transfer', random_id = '$random_id' WHERE InschId = $InschId;");
					$succes = exec_query($insertSQL);
					if ($succes) header('Location: ' . $url . $taal . '/dank.php?res=' . $random_id, true, 303);
				} else exit('Geen werkende betaaloptie');
			}
		}
	}
}
