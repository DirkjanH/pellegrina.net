<?php 
        // gegevens voor het mailtje:
        $to = stripslashes($_POST['email']);
		$message = "<p>Dear {$_POST['voornaam']},</p>\n";
		
        // begin Recordset
        $password = select_query(sprintf("SELECT password FROM dlnmr WHERE DlnmrId=%s", quote($dlnmr)), 0);

d($password);

        // end Recordset

        // check de cursusinschrijvingen en maak een subject aan:
        $subject = "Application for La Pellegrina Summer School \"{$cursusdata['cursusnaam_en']}\"";
		 
        // maak de tekst van het emailbericht aan:
				$message .= "<p>Thank you for registering for the summer school <strong>{$cursusdata['cursusnaam_en']}</strong>, which will take place at {$cursusdata['cursusplaats_en']}, from {$cursusdata['datum']}. The following data have been registered:</p>\n\n";
				$message .= "<p>{$naam}<br />\n";
				$message .= "{$_POST['adres']}<br />\n";
				$message .= "{$_POST['postcode']} {$_POST['plaats']}";
				if (isset($_POST['land'])and ($_POST['land'] != "")) $message .= ", {$_POST['land']}";
				$message .= "<br>\n";
				$message .= "Tel. {$_POST['telefoon']}"; 
				if ($_POST['mobiel'] != '') $message .= " | mobile {$_POST['mobiel']}";
				$message .= "</p>\n\n";
		
				if (isset($_POST['instrumentalist']) and $_POST['instrumentalist'] != "")
					{
						$message .= "<p>You have registered as instrumentalist, with instrument(s): {$instrumentenlijst}.</p>\n\n";
					}
		
				if (isset($_POST['zanger']) and $_POST['zanger'] != "")
					{
						$message .= "<p>You have registered as singer, with voice type {$instrumententabel[$_POST['zangstem']]['en']}.</p>\n\n";
					}

				if (isset($_POST['solozanger']) and $_POST['solozanger'] != "")
					{
						$message .= "<p>You have registered as solo singer, with voice type {$instrumententabel[$_POST['zangstem']]['en']}.</p>\n\n";
					}

		if (isset($_POST['toehoorder']) and $_POST['toehoorder'] != "")
			{
				$message .= "<p>You have registered as auditor.</p>\n\n";
			}

		if (isset($_POST['eenpersoons']) and $_POST['eenpersoons'] != "")
			{
				$message .= wordwrap("You have reserved a single room in the hostel. The number of single rooms is somewhat limited. They will be allocated after the definitive admission on {$cursusdata['beslisdatum']}, in order of registration.\n\n");
			}

		if (isset($_POST['hotel_1pp']) and $_POST['hotel_1pp'] != "")
			{
				$message .= "<p>You have reserved a single room in Penzion Elektra. The number of single rooms is limited. They will be allocated after the definitive admission on {$cursusdata['beslisdatum']}, in order of registration.</p>\n\n";
			}

		if (isset($_POST['hotel_2pp']) and $_POST['hotel_2pp'] != "")
			{
				$message .= "<p>You have reserved a place in a double room in Penzion Elektra. The number of rooms is limited. They will be allocated after the definitive admission on {$cursusdata['beslisdatum']}, in order of registration.</p>\n\n";
			}

		if (isset($_POST['kamperen']) and $_POST['kamperen'] != "")
			{
				$message .= "<p>You have reserved a camping spot in the monastery garden. The number of rooms is limited. They will be allocated after the definitive admission on {$cursusdata['beslisdatum']}, in order of registration.</p>\n\n";
			}
		
		if (isset($_POST['eigen_acc']) and $_POST['eigen_acc'] != "")
			{
				$message .= "<p>You have indicated that you want to arrange your own accommodation. Please contact one of the various accommodations in Bechyně for this. It is advisable not to wait too long.</p>\n\n";
			}

		if (isset($_POST['acc_wens']) and $_POST['acc_wens'] != "") {
			$tmp = stripslashes($_POST['acc_wens']);
			$message .= "Your special wishes about accommodation are: {$tmp}\n\n";
		}

		if (isset($_POST['opmerkingen'])	and $_POST['opmerkingen'] != "") {
			$tmp = stripslashes($_POST['opmerkingen']);
			$message .= "Your other remarks are: {$tmp}\n\n";
		}

		$message .= "<p>Your registration will be processed immediately when we receive the payment of the deposit of EUR {$cursusdata['inschrijfgeld']} in our bank account <strong>NL33 ASNB 0707 2500 72</strong> in name of La Pellegrina, Utrecht, or in our PayPal account. For bank transfers from outside the EU: BIC ASNB NL21.</p>";
        
		$message .= "\r\n<p><br />With musical greetings,<br /><br />
		\n\n\nLa Pellegrina</p>";
		
		$message .= "<div class=\"w3-small w3-card-4 w3-margin-top\"><p class=\"facebook\">P.S. Did you know <em>La Pellegrina</em> is active on Facebook too? <a title=\"La Pellegrina on Facebook\" href=\"http://www.facebook.com/pellegrina.net\" target=\"_blank\"><img class=\"geenlijn\" src=\"http://www.pellegrina.net/Images/Logos/facebook_logo.png\" alt=\"La Pellegrina on Facebook\" width=\"25\" height=\"25\"></a> <a title=\"La Pellegrina on facebook\" href=\"http://www.facebook.com/pellegrina.net\" target=\"_blank\">www.facebook.com/pellegrina.net</a>. We are very pleased when you click the 'Like' button and share the course news with your musical friends</p></div>";
  		
      $mail_text_file = ($_SERVER['DOCUMENT_ROOT'].'/bevestiging/briefhoofd_EN.htm');
		$mail_text = file_get_contents($mail_text_file);
		
		$mail_text = str_replace("</html>", stripslashes($message)."</body></html>", $mail_text);
           
           d($to, $naam, $subject, $mail_text);
		
	     // bericht ter bevestiging:
    	if ($mail_verzonden) {
			if (LPmail($to, $naam, $subject, $mail_text, 'aanmelding@pellegrina.net', 'LP Aanmelding')) {
            // redirect naar de dank.php pagina
            $insertGoTo = "/EN/dank.php";
            $vn = urlencode($_POST['voornaam']);
            $cs = urlencode(stripslashes($cursusdata['cursusnaam_en']));
            $to = urlencode($to);
            $insertGoTo .= "?voornaam=$vn&cursus=$cs&email=$to&inlogcode=$password";
				$insertGoTo .= "&beslisdatum={$cursusdata['beslisdatum']}&betaaldatum={$cursusdata['betaaldatum']}";
            KT_redir($insertGoTo);
        } else echo "The email was not sent!<br>";
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Naamloos document</title>
</head>

<body>
</body>
</html>