<?php //Connection statement
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);

error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php');

Kint::$enabled_mode = false;

require_once('GeneratePassword.php');
require_once $_SERVER["DOCUMENT_ROOT"].'/includes/mailfuncties.inc.php';

setlocale(LC_ALL, 'nl_NL');

// begin Recordset
$instrumenten = select_query("SELECT * FROM instr ORDER BY id ASC");
foreach ($instrumenten as $row) {
	$instrumententabel[$row['id']]['en'] = $row['en'];
   $instrumentcodetabel[$row['en']] = $row['id'];
	$instrumententabel[$row['id']]['nl'] = $row['nl'];
   $instrumentcodetabel[$row['nl']] = $row['id'];
}
// end Recordset

//d($instrumententabel);
//d($instrumentcodetabel);

// build the form action
$editFormAction = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" .
    $_SERVER['QUERY_STRING'] : "");

if (isset($_GET['Zoek']) AND $_GET['pw'] != '' and empty($_POST))
{
    // begin Recordset
    $query_oude_gegevens = 
	"SELECT * FROM dlnmr AS d INNER JOIN adres AS a LEFT OUTER JOIN inschrijving AS i 
			ON (d.DlnmrId = i.DlnmrId_FK )
		WHERE d.password = \"{$_GET['pw']}\" 
		  AND d.AdresID_FK = a.AdresId 
		GROUP BY d.naam 
		ORDER BY d.achternaam ";
    $oude_gegevens = select_query($query_oude_gegevens, 1);
}
// end Recordset

if (isset($oude_gegevens) AND is_array($oude_gegevens))
    {
        $_POST = $oude_gegevens;
        $_POST['groot_ensemble1'] = null;
        $_POST['groot_ensemble2'] = null;
        unset($_POST['instrumentalist']);
        unset($_POST['zanger']);
        unset($_POST['solozanger']);
        unset($_POST['danser']);
        unset($_POST['toehoorder']);
        if ($_POST['instr'] != "")
            $instr = $_POST['instr'];
        else
        {
            $in = explode(', ', $_POST['instrumenten']);
            foreach ($in as $ins)
                $instr[] = $instrumentcodetabel[$ins];
            $_POST['instr'] = $instr;
            $instr = implode(', ', $_POST['instr']);
        }
		$geboortedatum = safestrtotime('Y-m-d', $_POST['geboortedatum']);
    } else $zoekresultaat = "<tr><td class=\"nadruk\">Dit is geen geldig password.</td></tr>";

//d($instrumentcodetabel);
//d($_POST);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "aanmelding"))
    {
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
        if (isset($_POST['danser'])) $_POST['instr'][] = 400;
        if (empty($_POST['niveau_d'])) $_POST['niveau_d'] = "";
        if (empty($_POST['ervaring_d'])) $_POST['ervaring_d'] = "";
        if (empty($_POST['vervoer'])) $_POST['vervoer'] = "";
        $naam = $_POST['voornaam'];
        if (isset($_POST['tussenvoegsels'])
            && $_POST['tussenvoegsels'] != "")$naam .= ' ' . $_POST['tussenvoegsels'];
        $naam .= ' ' . $_POST['achternaam'];
		  $naam = stripslashes($naam);

        if (isset($_POST['instr'])) {
			foreach ($_POST['instr'] as $in) $instrument[] = $instrumententabel[$in]['nl'];
	        $instrumentenlijst = implode(', ', $instrument);
		}
        //	echo 'Alle instrumenten: '.$instrumentenlijst.'<br>';

        if (isset($_POST['instr'])) $ins = $_POST['instr'];
		if (isset($_POST['toehoorder'])) $ins[] = 500;
       	$instrumenten = implode(', ', (array)$ins); // alleen instrumenten & toehoorders
        if (isset($_POST['zangstem'])) $ins[] = $_POST['zangstem'];
       	$instr = implode(', ', (array)$ins); // alle functies

        if (isset($_POST['rol_z'])) $rol_z = implode(', ', $_POST['rol_z']);
		else $rol_z = "";

//	echo 'Alle activiteiten: '.$instr.'<br>';

        $error = false;

        $fout = "<div id=\"aanmeldingsprobleem\"><h2>Het formulier is nog niet volledig ingevuld. De volgende gegevens ontbreken of de volgende fouten zijn opgetreden:</h2>\n<ul>\n";

		// check voornaam:
		if (empty($_POST['voornaam'])
		)
		{
		$error = true;
		$fout .= "   <li>Je voornaam is niet ingevuld</li>\n";
		}
		
		// check achternaam:
		if (empty($_POST['achternaam'])
		)
		{
		$error = true;
		$fout .= "   <li>Je achternaam is niet ingevuld</li>\n";
		}
		
		// check adres:
		if (empty($_POST['adres'])
		)
		{
		$error = true;
		$fout .= "   <li>Je adres is niet ingevuld</li>\n";
		}
		
		// check postcode:
		if (empty($_POST['postcode'])
		)
		{
		$error = true;
		$fout .= "   <li>Je postcode is niet ingevuld</li>\n";
		}
		
		// check plaatsnaam:
		if (empty($_POST['plaats'])
		)
		{
		$error = true;
		$fout .= "   <li>Je plaatsnaam is niet ingevuld</li>\n";
		}

		// check geboortedatum:
		if (empty($_POST['geboortedatum'])
			or (safestrtotime('Y-m-d', $_POST['geboortedatum']) == '1970-01-01') 
			or (safestrtotime('Y', $_POST['geboortedatum']) < (date('Y') - $maximumleeftijd)) 
			or (safestrtotime('Y', $_POST['geboortedatum']) > (date('Y') - $minimumleeftijd)))
			{
				$error = true;
				$fout .= "   <li>Je geboortedatum is niet of niet correct ingevuld. Graag invullen in cijfers: dag-maand-jaar</li>\n";
			}
		$geboortedatum = safestrtotime('Y-m-d',$_POST['geboortedatum']);

		// check geslacht:
        if (empty($_POST['geslacht']))
            {
                $error = true;
                $fout .= "   <li>Het geslacht is niet ingevuld</li>\n";
            }

		// check email:
		if (!(isset($_POST['email']) && validate($_POST['email'], 'email', 255)))
			{
				$error = true;
				$fout .= "   <li>Je emailadres is niet of niet correct ingevuld</li>\n";
			}
		else $_POST['email'] = strtolower($_POST['email']);
		
		// check inschrijving voor welke cursus:
		if (empty($_POST['CursusId_FK']))
		{
		$error = true;
		$fout .= "   <li>Geef SVP aan voor <strong>welke </strong>cursus(sen) je je wilt inschrijven </li>";
		}
		
		// check instr., zanger of toehoorder:
		if (isset($_POST['CursusId_FK'])
		and ($_POST['CursusId_FK'] == $eerstecursus + 2)  // kamermuziekcursus!!!
		and ((isset($_POST['zanger']) and $_POST['zanger'] != '') or (isset($_POST['solozanger'])) and $_POST['solozanger'] != '')) 
		{
		$_POST['zanger'] = NULL;
		$_POST['solozanger'] = NULL;
		}
		
/* 		// check danser:
		if (isset($_POST['CursusId_FK'])
		and ($_POST['CursusId_FK'] != $eerstecursus + 1))
		{
		$_POST['danser'] = NULL;
		}
 */		
		// zet instrumentalist aan als instrument of stemsoort zijn ingevuld
		if (isset($_POST['instrumenten']) and $_POST['instrumenten'] != "") $_POST['instrumentalist'] = true;

	  // check instr., zanger of toehoorder:
//	  d($_POST['instrumentalist'], $_POST['zanger'], $_POST['solozanger'], $_POST['toehoorder']);
//	  d(empty($_POST['instrumentalist']), empty($_POST['zanger']), empty($_POST['solozanger']), empty(_POST['toehoorder']));
//	  d((empty($_POST['instrumentalist']) && empty($_POST['zanger']) && empty($_POST['solozanger']) && empty($_POST['toehoorder'])));
	
	  if (empty($_POST['instrumentalist']) && empty($_POST['zanger']) && empty($_POST['solozanger']) && empty($_POST['toehoorder']))
			{
				 $error = true;
				 $fout .= "   <li>Geef SVP aan of je wilt deelnemen als instrumentalist, zanger of toehoorder</li>\n";
			}

		// check instrument voor instrumentalisten:
		if (isset($_POST['instrumentalist']) && empty($instrumentenlijst))
			{
				$error = true;
				$fout .= "<li>Je geeft aan als instrumentalist te willen deelnemen. Geef SVP ook <b>je instrument</b> aan</li>\n";
			}

		// check zangstem:
 		if ((isset($_POST['zanger']) OR isset($_POST['solozanger'])) AND empty($_POST['zangstem']))
			{
				$error = true;
				$fout .= "   <li>Je geeft aan zanger te willen deelnemen. Geef SVP ook <b>je stemsoort</b> aan</li>\n";
			}

		// check akkoord:
		if (empty($_POST['voorwaarden']))
			{
				$error = true;
				$fout .= "   <li>Onderaan het formulier kun je aangeven akkoord te gaan met de voorwaarden</li>\n";
			}

		// check aanbetaling:
		if (empty($_POST['aanbetaling']))
			{
				$error = true;
				$fout .= "   <li>Onderaan het formulier kun je aangeven het inschrijfgeld betaald te hebben</li>\n";
			}

		$fout .= "</ul>\n<p><b>Ga naar de desbetreffende velden op het formulier en vul de gegevens aan.
		Druk daarna nogmaals op 'Formulier verzenden'.</b></p>
		<p>Mocht het niet lukken het formulier te verzenden, dan kun je de gevraagde gegevens ook in een 
		normale email versturen aan <a href=\"mailto:aanmelding@pellegrina.net\">aanmelding@pellegrina.net
		</a>, of het formulier uitprinten, invullen en per post verzenden 
		aan <a href=\"contact.php\"><em>La Pellegrina</em></a>.</p></div>\n";

        if ($error)
        {
            echo $fout;
//            exit();
        } else
    {

d($_POST);
			  
        // begin Recordset
        $f_adres = '-1';
        if (isset($_POST['adres'])) $f_adres = $_POST['adres'];
        $f_postcode = '-1';
        if (isset($_POST['postcode'])) $f_postcode = $_POST['postcode'];

        if (empty($_POST['AdresId']) or $_POST['AdresId'] == "") {
                $_POST['AdresId'] = select_query(sprintf("SELECT AdresId FROM adres WHERE adres=%s AND postcode=%s", quote($f_adres), quote($f_postcode)), 0);
           }
            // end Recordset

			if (isset($_POST['AdresId']) and $_POST['AdresId'] > 0) 

				$adresSQL = sprintf("UPDATE adres SET adres=%s, postcode=%s, plaats=%s, land=%s WHERE AdresId=%s",
									  quote($_POST['adres']),
									  quote(strtoupper($_POST['postcode'])),
									  quote($_POST['plaats']),
									  quote($_POST['land']),
									  quote($_POST['AdresId']));
			else 				
				$adresSQL = sprintf("INSERT INTO adres (adres, postcode, plaats, land) VALUES (%s, %s, %s, %s)",
									  quote($_POST['adres']),
									  quote(strtoupper($_POST['postcode'])),
									  quote($_POST['plaats']),
									  quote($_POST['land']));

		  exec_query($adresSQL);
		  $ID = lastID();

d($adresSQL, $ID);

        if (isset($_POST['AdresId'])
            and $_POST['AdresId'] > 0) $_POST['AdresId_FK'] = $_POST['AdresId'];
        elseif ($ID > 0)
            $_POST['AdresId_FK'] = $ID;
		else exit ('Error: No valid address data!!!');

        if (isset($_POST['DlnmrId']) and $_POST['DlnmrId'] != "") $dlnmr = $_POST['DlnmrId'];
        else {
            // begin Recordset
            $f_naam = '-1';
            if (isset($naam)) $f_naam = $naam;
            $f_email = '-1';
            if (isset($_POST['email'])) $f_email = $_POST['email'];
            $dlnmr = select_query(sprintf("SELECT DlnmrId FROM dlnmr WHERE naam=%s AND email=%s", quote($f_naam), quote($f_email)), 0);
            // end Recordset
        }

        if (isset($dlnmr) and $dlnmr != "") 
			$dlnmrSQL = sprintf("UPDATE dlnmr SET voornaam=%s, tussenvoegsels=%s, achternaam=%s,
					naam=%s, geboortedatum=%s, geslacht=%s, taal=%s, telefoon=%s, mobiel=%s, email=%s, dieet=%s, 
					publiciteit=%s, naam_aanbrenger=%s, publiciteit_tx=%s, oost=%s, student=%s, 
					AdresId_FK=%s WHERE DlnmrId=%s", quote($_POST['voornaam']), quote($_POST['tussenvoegsels']), quote($_POST['achternaam']), quote($naam), quote($geboortedatum,
                "date"), quote($_POST['geslacht']), quote($_POST['taal']), quote($_POST['telefoon']), quote($_POST['mobiel']), quote($_POST['email']), quote($_POST['dieet']), quote($_POST['publiciteit']), quote($_POST['naam_aanbrenger']), quote($_POST['publiciteit_tx']), quote(isset
                ($_POST['oost']) ? "true" : "", "defined", "'1'", "'0'"), quote(isset
                ($_POST['student']) ? "true" : "", "defined", "1", "0"), quote($_POST['AdresId_FK']), quote($dlnmr));

        else
        {
            $password = generatePassword(4, true, false, true, false);
            $dlnmrSQL = sprintf("INSERT INTO dlnmr_test (voornaam, tussenvoegsels, achternaam, naam, password,
					geboortedatum, geslacht, taal, telefoon, mobiel, email, dieet, publiciteit, naam_aanbrenger, 
					publiciteit_tx, oost, student, AdresId_FK, 
					eerste_inschrijving) 
					VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, NOW())",
                quote($_POST['voornaam']), quote($_POST['tussenvoegsels']), quote($_POST['achternaam']), quote($naam), quote($password), quote($geboortedatum,
                "date"), quote($_POST['geslacht']), quote($_POST['taal']), quote($_POST['telefoon']), quote($_POST['mobiel']), quote($_POST['email']), quote($_POST['dieet']), quote($_POST['publiciteit']), quote($_POST['naam_aanbrenger']), quote($_POST['publiciteit_tx']), quote(isset
                ($_POST['oost']) ? "true" : "", "defined", "'1'", "'0'"), quote(isset
                ($_POST['student']) ? "true" : "", "defined", "1", "0"), quote($_POST['AdresId_FK']));
}

	  exec_query($dlnmrSQL);
	  $ID = lastID();
     if (empty($dlnmr)) $dlnmr = $ID;

 d($dlnmrSQL, $ID, $password);

		// begin Recordset
		$Inschrijvingbestaat = select_query(sprintf("SELECT InschId FROM inschrijving_test WHERE DlnmrId_FK=%s AND CursusId_FK=%s", quote($dlnmr), quote($_POST['CursusId_FK'])), 0);
		d($Inschrijvingbestaat);
		// end Recordset

        if (isset($Inschrijvingbestaat) and $Inschrijvingbestaat > 0)
            {
            $error = true;
				$fout = "<link rel=\"stylesheet\" href=\"/css/pellegrina_stijlen.css\" type=\"text/css\">";
				$fout .= "<link href=\"/css/aanmelding.css\" rel=\"stylesheet\" type=\"text/css\">";
            $fout .= "<div id=\"aanmeldingsprobleem\"><h2>Het formulier kon niet verzonden worden. ";
				$fout .= "De volgende fout is gevonden:</h2>\n<ul>\n";
			   $fout .= "<li>Je hebt je al ingeschreven voor deze cursus. Je kunt je maar één keer voor dezelfde cursus opgeven</li>\n";
			   $fout .= "</ul>\n<p>Mocht je iets willen wijzigen in je aanmelding of mocht het niet lukken het formulier te verzenden, dan kun je de gevraagde gegevens ook in een normale email versturen aan <a href=\"mailto:aanmelding@pellegrina.net\">aanmelding@pellegrina.net</a>
				.</p></div>\n";
}

if ($error) echo $fout;
        else {
			$inschrijfSQL = sprintf("INSERT INTO inschrijving_test (instrumentalist, instrumenten, `instr`, niveau_i, ervaring_i, stukken_i, groot_ensemble1, groot_ensemble2, solozanger, zanger, zangstem, niveau_z, niveau_s, ervaring_z, stukken_z, stukken_s, rol_z, danser, niveau_d, ervaring_d, stukken_d, toehoorder, vervoer, info_korting, acc_wens, eenpersoons, kamperen, hotel_2pp, hotel_1pp, eigen_acc, maaltijdpas, storting_fonds, donatie, opmerkingen, aanbetaling, voorwaarden, ACMP, DlnmrId_FK, CursusId_FK, datum_inschr) 
		  VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
				  %s, %s, %s, %s, %s, %s, %s, %s, NOW());",
			quote(isset($_POST['instrumentalist'])),
			quote($instrumenten),
			quote($instr),
			quote($_POST['niveau_i']),
			quote($_POST['ervaring_i']),
			quote(rtrim($_POST['stukken_i'])),
			quote(isset($_POST['groot_ensemble1'])),
			quote(isset($_POST['groot_ensemble2'])),
			quote(isset($_POST['solozanger'])),
			quote(isset($_POST['zanger'])),
			quote($_POST['zangstem']),
			quote($_POST['niveau_z']),
			quote($_POST['niveau_s']),
			quote($_POST['ervaring_z']),
			quote(rtrim($_POST['stukken_z'])),
			quote(rtrim($_POST['stukken_s'])),
			quote($rol_z),
			quote(isset($_POST['danser'])), 
			quote($_POST['niveau_d']), 
			quote($_POST['ervaring_d']), 
			quote($_POST['stukken_d']), 
			quote(isset($_POST['toehoorder'])),
			quote($_POST['vervoer']),
			quote(isset($_POST['info_korting'])),
			quote(rtrim($_POST['acc_wens'])),
			quote(isset($_POST['eenpersoons'])),
			quote(isset($_POST['kamperen'])),
			quote(isset($_POST['hotel_2pp'])),
			quote(isset($_POST['hotel_1pp'])),
			quote(isset($_POST['eigen_acc'])),
			quote(isset($_POST['maaltijdpas'])),
			quote(isset($_POST['storting_fonds'])),
			quote($_POST['donatie']),
			quote(rtrim($_POST['opmerkingen'])),
			quote(isset($_POST['aanbetaling'])),
			quote(isset($_POST['voorwaarden'])),
			quote(isset($_POST['ACMP'])),
			quote($dlnmr),
			quote($_POST['CursusId_FK']));

d($inschrijfSQL);

			exec_query($inschrijfSQL);
			$inschr_id = lastID();			
			  
			//Betaling via mollie.nl:
			try
{
	 // Initialize the Mollie API library with your API key
	include($_SERVER["DOCUMENT_ROOT"].'/Mollie/initialize.php');

	// Determine the url parts to these example files.
	$protocol = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
	$hostname = $_SERVER['HTTP_HOST'];
	$path     = dirname(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);

	/*
	 * Payment parameters:
	 *   amount        Amount in EUROs
	 *   description   Description of the payment.
	 *   redirectUrl   Redirect location. The customer will be redirected there after the payment.
	 *   webhookUrl    Webhook location, used to report when the payment changes state.
	 *   metadata      Custom metadata that is stored with the payment.
	 */
	$payment = $mollie->payments->create(array(
		"amount"       => $cursusdata['inschrijfgeld'],
		"description"  => "La Pellegrina inschrijfgeld zomercursus",
		"redirectUrl"  => "{$protocol}://{$hostname}/NL/dank_test.php?inschId={$inschr_id}",
		"webhookUrl"   => "{$protocol}://{$hostname}/Mollie/webhook.php",
		"metadata"     => array("inschr_id" => $inschr_id, 'inschrijfgeld' => $cursusdata['inschrijfgeld'])
	));

	d($inschr_id, $payment);

	exec_query("UPDATE inschrijving_test SET mollie_payment_status = '{$payment->status}' WHERE inschId={$inschr_id}");

	header("Location: " . $payment->getPaymentUrl());
}
catch (Mollie_API_Exception $e)
{
	echo "API call failed  : " . htmlspecialchars($e->getMessage());
}
        // gegevens voor het mailtje:
        $to = stripslashes($_POST['email']);
        $message = "<p>Beste {$_POST['voornaam']},</p>\n";
		
        // begin Recordset
        $password = select_query(sprintf("SELECT password FROM dlnmr_test WHERE DlnmrId=%s", quote($dlnmr)), 0);

d($password);

        // end Recordset

        // check de cursusinschrijvingen en maak een subject aan:
        $subject = "Aanmelding zomercursus \"{$cursusdata['cursusnaam_nl']}\" van La Pellegrina";

        // maak de tekst van het emailbericht aan:
        $message .= "<p>Hartelijk dank voor je aanmelding voor de cursus <strong>\"{$cursusdata['cursusnaam_nl']}\"</strong>, die zal plaatsvinden te {$cursusdata['cursusplaats_nl']}, in de periode van {$cursusdata['begindatum']} tot {$cursusdata['einddatum']}. De volgende gegevens zijn geregistreerd:\n\n</p>";
        $message .= "{$naam}<br>\n";
        $message .= "{$_POST['adres']}<br>\n";
        $message .= "{$_POST['postcode']} {$_POST['plaats']}";
        if (isset($_POST['land']) and ($_POST['land'] != ""))$message .= ", {$_POST['land']}<br>";
        $message .= "<br>\n";
        $message .= "Tel. {$_POST['telefoon']}";
        if ($_POST['mobiel'] != '')$message .= " | mobiel {$_POST['mobiel']}<br>";
        $message .= "</p>\n\n";

        if (isset($_POST['instrumentalist']) and $_POST['instrumentalist'] != "")
            {
                $message .= "<p>Je hebt je aangemeld als instrumentalist, met als instrument(en): {$instrumentenlijst}.\n\n</p>";
            }

		if (isset($_POST['zanger']) and $_POST['zanger'] != "")
			{
				$message .= "<p>Je hebt je aangemeld als zanger, met zangstem: {$instrumententabel[$_POST['zangstem']]['nl']}.\n\n</p>";
			}

		if (isset($_POST['solozanger']) and $_POST['solozanger'] != "")
			{
				$message .= "<p>Je hebt je aangemeld als solozanger, met zangstem: {$instrumententabel[$_POST['zangstem']]['nl']}.\n\n</p>";
			}

/* 		if (isset($_POST['danser']) and $_POST['danser'] != "")
			{
				$message .= "<p>Je hebt je aangemeld als danser.\n\n</p>";
			}
 */
		if (isset($_POST['toehoorder']) and $_POST['toehoorder'] != "")
			{
				$message .= "<p>Je hebt je aangemeld als toehoorder.\n\n</p>";
			}

		if (isset($_POST['eenpersoons']) and $_POST['eenpersoons'] != "")
			{
				$message .= "<p>Je hebt een eenpersoons kamer in het internaat gereserveerd. Het aantal eenpersoons kamers is daar enigszins beperkt. Toekenning hiervan geschiedt na definitieve toelating op {$cursusdata['beslisdatum']}, in volgorde van aanmelding.</p>\n\n";
			}

		if (isset($_POST['hotel_1pp']) and $_POST['hotel_1pp'] != "")
			{
				$message .= "<p>Je hebt een eenpersoons kamer in kamer in Penzion Elektra gereserveerd. Het aantal eenpersoons kamers is daar beperkt. Toekenning hiervan geschiedt na definitieve toelating op {$cursusdata['beslisdatum']}, in volgorde van aanmelding.</p>\n\n";
			}

		if (isset($_POST['hotel_2pp']) and $_POST['hotel_2pp'] != "")
			{
				$message .= "<p>Je hebt een tweepersoons kamer in Penzion Elektra gereserveerd. Het aantal kamers is er beperkt. Toekenning hiervan geschiedt na definitieve toelating op {$cursusdata['beslisdatum']}, in volgorde van aanmelding.</p>\n\n";
			}
		
		if (isset($_POST['kamperen']) and $_POST['kamperen'] != "")
			{
				$message .= "<p>Je hebt een kampeerplek in de kloostertuin gereserveerd. Het aantal plekken is er beperkt. Toekenning hiervan geschiedt na definitieve toelating op {$cursusdata['beslisdatum']}, in volgorde van aanmelding.</p>\n\n";
			}

		if (isset($_POST['eigen_acc']) and $_POST['eigen_acc'] != "")
			{
				$message .= "<p>Je hebt aangegeven eigen accommodatie te willen regelen. Neem daarvoor zelf contact op met een van de diverse accommodaties in Bechyně. Het is aan te raden er niet te lang mee te wachten.</p>\n\n";
			}

		if (isset($_POST['acc_wens']) and $_POST['acc_wens'] != "") {
			$tmp = stripslashes($_POST['acc_wens']);
			$message .= "<p>Je accommodatie-wensen zijn: {$tmp}</p>\n\n";
		}

		if (isset($_POST['opmerkingen']) and $_POST['opmerkingen'] != "") {
				$tmp = stripslashes($_POST['opmerkingen']);
				$message .= "<p>Je opmerkingen zijn: {$tmp}</p>\n\n";
		}

$message .= "<p>Je aanmelding wordt verwerkt zodra de betaling van € {$cursusdata['inschrijfgeld']} inschrijfgeld is ontvangen op onze bankrekening <strong>NL33 ASNB 0707 2500 72</strong> t.n.v. La Pellegrina te Utrecht. Voor betaling van buiten de EU: BIC ASNB NL21.</p>";
        
		$message .= "<p>\r\nMet muzikale groet,<br><br>\n\n\nLa Pellegrina</p>";
		$message .= "<div class=\"w3-small w3-card-4 w3-margin-top\">\r\n<p class=\"facebook\">P.S. Wist je dat <em>La Pellegrina</em> ook op <strong>facebook</strong> actief is? <a title=\"La Pellegrina on Facebook\" href=\"http://www.facebook.com/pellegrina.net\" target=\"_blank\"><img class=\"geenlijn\" alt=\"La Pellegrina op Facebook\" src=\"http://www.pellegrina.net/Images/Logos/facebook_logo.png\" width=\"25\" height=\"25\"></a> <a title=\"La Pellegrina ook op Facebook\" href=\"http://www.facebook.com/pellegrina.net\" target=\"_blank\">www.facebook.com/pellegrina.net</a>. Wij vinden het erg fijn als je ons 'like't en het cursusnieuws deelt met je muzikale vrienden!</p></div>";
 
      $mail_text_file = ($_SERVER['DOCUMENT_ROOT'].'/bevestiging/briefhoofd_NL.htm');
		$mail_text = file_get_contents($mail_text_file);
		
		$mail_text = str_replace("</html>", stripslashes($message)."</body></html>", $mail_text);
		
        // bericht ter bevestiging:
        if (LPmail('aanmelding@pellegrina.net', $naam, $subject, $mail_text)) {
//			echo 'Gelukt!<br>';
            // redirect naar de dank.php pagina
            $insertGoTo = "/NL/dank.php";
            $vn = urlencode($_POST['voornaam']);
            $cs = urlencode(stripslashes($cursusdata['cursusnaam_nl']));
            $to = urlencode($to);
            $insertGoTo .= "?voornaam=$vn&cursus=$cs&email=$to&inlogcode=$password";
				$insertGoTo .= "&beslisdatum={$cursusdata['beslisdatum']}&betaaldatum={$cursusdata['betaaldatum']}";
  //          KT_redir($insertGoTo);
        } else
        echo "De mail is niet verstuurd!<br>";
        }
	}
}
?>