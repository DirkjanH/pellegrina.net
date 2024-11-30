<?php //Connection statement
// include_once ($_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/LPmailer.inc.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2025.php');
//include_once ($_SERVER['DOCUMENT_ROOT'].'/login/level3_check.php');

session_start();

ob_start();

/* echo '<pre>';
print_r($_POST);
echo '</pre>';*/
// voor het verzenden van attachments:
$attachments = array();

//---CheckSizeFunction ---\\
function checkSize()
{
	global $result, $MV, $errors, $BackLink;

	/* echo '<pre>';
print_r($_FILES);
echo '</pre>';
 */
	while (list($key, $value) = each($_FILES[files][size])) {
		$maxSize = 5000000;
		if (!empty($value) or $value != '') {
			if ($value > $maxSize) {
				echo "Sorry this is a very big file .. max file size is $maxSize Bytes = 5 MB";
				exit('gestopt...');
			} else {
				/* $result = */
				echo "File size is ok :)<br>";
			}
		}
	}
	uploadFile();
}
//-------END OF Check Size--------\\


//==============upload File Function============\\

function uploadFile()
{
	global $attachments;
	while (list($key, $value) = each($_FILES[files][name])) {
		echo "{$key} => '{$value}' <br>";
		if (!empty($value) or $value != '') {
			$filename = $value;
			array_push($attachments, $filename);
			$dir = "uploads/$filename";
			chmod("uploads", 0777);
			$success = copy($_FILES[files][tmp_name][$key], $dir);
			if ($success) {
				echo " Files Uploaded Successfully<BR>";
			} else {
				exit("Oops, Sorry the server was unable to upload the files...");
			}
		}
	}
}

$voorzetsels = array(' van', ' der', ' den', ' ten', ' de', ' \'t', 'Dr. ', 'Mr. ', 'Drs. ', ' Op', ' ter', ' le', ' von');
$leeg = '';
$ctrlf = "\r\n";
$enclosure = '"';

$taal[1] = 'LIKE "%XXX%"';
$taal[2] = 'LIKE "%NL%"';
$taal[3] = 'NOT LIKE "%NL%"';
$taal[4] = 'LIKE "%%"';

$instrzang[1] = '';
$instrzang[2] = 'AND instrumentalist <=> 1';
$instrzang[3] = 'AND zanger <=> 1';

$aantal_kolommen = 5;

if (empty($_SESSION['cursusId'])) $_SESSION['cursusId'] = $eerstecursus;
if (isset($_POST['cursusId']) and $_POST['cursusId'] === "0") {
	$_SESSION['cursusId'] = 0;
	$_POST['selectie'] = 'alles';
} elseif (isset($_POST['cursusId']) and $_POST['cursusId'] != "") $_SESSION['cursusId'] = $_POST['cursusId'];

if (empty($_SESSION['messageId'])) $_SESSION['messageId'] = 1;
if (isset($_POST['messageId']) and $_POST['messageId'] != "") $_SESSION['messageId'] = $_POST['messageId'];
if (empty($_SESSION['taal'])) $_SESSION['taal'] = 1;
if (isset($_POST['taal'])) $_SESSION['taal'] = $_POST['taal'];
if (empty($_SESSION['instrzang'])) $_SESSION['instrzang'] = 1;
if (isset($_POST['instrzang'])) $_SESSION['instrzang'] = $_POST['instrzang'];

$_POST['message'] = stripslashes($_POST['message']);
$_POST['subject'] = stripslashes($_POST['subject']);
if (empty($_POST['subject'])) $_POST['subject'] = '[subject]';

/* echo '<pre><br>Post:<br>';
print_r($_POST);
echo '</pre>';

echo '<pre><br>Session:<br>';
print_r($_SESSION);
echo '</pre>';
 */
// begin Recordset inschrijving

if (!function_exists('str_getcsv')) {
	function str_getcsv($input, $delimiter = ',', $enclosure = '"')
	{
		// Open a memory "file" for read/write...
		if (strpos($input, '","') === false)
			echo '<script language="javascript">confirm("Dit is geen CSV. Wil je dit?")</script>;';
		$fp = fopen('php://temp', 'r+');
		// ... write $input to the "file" using fwrite()...
		fwrite($fp, $input);
		// ... rewind the "file" so we can read what we just wrote...
		rewind($fp);
		// ... read the entire line into a variable...
		$tmp = fgetcsv($fp, 1000, $delimiter, $enclosure);

		$i = 1;
		while (!feof($fp)) {
			$tmp = fgetcsv($fp, 1000, $delimiter, $enclosure);
			$data[$i]['naam'] = $tmp[112];
			$data[$i]['voornaam'] = $tmp[113];
			$data[$i]['email'] = $tmp[26];
			$i++;
		}
		// ... close the "file"...
		fclose($fp);
		// ... and return the $data to the caller
		return $data;
	}
}

function lees_outlook($input)
{
	global $voorzetsels, $leeg, $ctrlf, $enclosure;
	$witregel = $ctrlf . $ctrlf;
	$lijst = explode($witregel, $input);

	if (strpos($input, $witregel) === false)
		echo '<script language="javascript">confirm("Dit zijn geen Outlook-adressen. Wil je dit?")</script>;';

	/* echo '<pre>';
print_r($lijst);
echo '</pre>';
 */
	//	unset($lijst[0]);
	$i = 1;
	foreach ($lijst as $adres) {
		$tmp = explode($ctrlf, $adres);
		foreach ($tmp as $t) {
			$t = rtrim($t);
			if ($t != '')
				$tmp[substr($t, 0, strcspn($t, ':'))] = substr(stristr($t, ':'), 2);
		}
		$a = stripslashes(substr($adres, 0, strcspn($adres, $ctrlf)));
		if (isset($tmp['E-mail']) and strpbrk($tmp['E-mail'], '@.') and strpbrk($a, ',')) {
			$tmp['achternaam'] = substr($a, 0, strpos($a, ','));
			$tmp['voornaam'] = substr(stristr($a, ','), 2);
			$adressen[$i]['voornaam'] = rtrim(str_replace($voorzetsels, $leeg, $tmp['voornaam']));
			$adressen[$i]['naam'] = rtrim($tmp['voornaam'] . ' ' . $tmp['achternaam']);
			$adressen[$i]['email'] = $tmp['E-mail'];
			$i++;
		}
	}
	/* echo '<pre>';
print_r($adressen);
echo '</pre>';
 */
	return $adressen;
}

function lees_distributielijst($input)
{
	global $voorzetsels, $leeg, $ctrlf, $enclosure;

	/* echo '<pre>';
print_r($input);
echo '</pre>';
 */
	if (strpos($input, ('Leden:' . "\t " . $ctrlf)) === false)
		echo '<script language="javascript">confirm("Dit is geen Outlook-distributielijst. Wil je dit?")</script>;';

	$lijst = explode($ctrlf, $input);

	/* echo '<pre>';
print_r($lijst);
echo '</pre>';
 */
	$i = 1;
	foreach ($lijst as $adres) {
		if (strpos($adres, '@') !== false) {
			$tmp['E-mail'] = ltrim(substr($adres, strrpos($adres, "\t"), strlen($adres)));
			if (strpos($adres, ' (') !== false)
				$a = substr($adres, 0, strrpos($adres, " ("));
			else
				$a = substr($adres, 0, strrpos($adres, "\t"));
			$tmp['achternaam'] = trim(substr($a, strrpos($a, ' '), strlen($adres)));
			$tmp['voornaam'] = trim(substr($a, 0, strrpos($a, ' ')));
			$adressen[$i]['voornaam'] = rtrim(str_replace($voorzetsels, $leeg, $tmp['voornaam']));
			$adressen[$i]['naam'] = rtrim($tmp['voornaam'] . ' ' . $tmp['achternaam']);
			$adressen[$i]['email'] = $tmp['E-mail'];
			$i++;
		}
	}
	/* echo '<pre>';
print_r($adressen);
echo '</pre>';
 */
	return $adressen;
}

function lees_access($input)
{
	global $voorzetsels, $leeg, $ctrlf, $enclosure;
	if (strpos($input, '","'))
		$delimiter = ',';
	elseif (strpos($input, '";"'))
		$delimiter = ';';
	else
		echo '<script language="javascript">confirm("Dit is geen CSV. Wil je dit?")</script>;';

	/* echo '<pre>';
print_r($input);
echo "De delimiter is: {$delimiter}<br>";
echo "De enclosure is: {$enclosure}<br>";
echo '</pre>';
 */
	$fp = fopen('php://temp', 'r+');
	// ... write $input to the "file" using fwrite()...
	fwrite($fp, $input);
	// ... rewind the "file" so we can read what we just wrote...
	rewind($fp);
	// ... read the entire line into a variable...
	$i = 1;
	while (!feof($fp)) {
		$tmp = fgetcsv($fp, 1000, $delimiter, $enclosure);
		if (isset($tmp['0']) and strpbrk($tmp['0'], '@.')) {
			$adressen[$i]['email'] = $tmp[0];
			$adressen[$i]['naam'] = $tmp[1];
			$adressen[$i]['voornaam'] = rtrim(str_replace($voorzetsels, $leeg, $tmp['2']));
			$i++;
		}
	}
	// ... close the "file"...
	fclose($fp);
	/* echo '<pre>';
print_r($adressen);
echo '</pre>';
 */
	return $adressen;
}

function lees_google($input)
{
	global $voorzetsels, $leeg, $enclosure;
	$regelscheiding = ', ';
	$lijst = explode($regelscheiding, $input);

	if (strpos($input, $regelscheiding) === false)
		echo '<script language="javascript">confirm("Dit zijn geen Google-adressen. Wil je dit?")</script>;';

	/* echo '<pre>';
print_r($lijst);
echo '</pre>';
 */
	//	unset($lijst[0]);
	$i = 1;
	foreach ($lijst as $adres) {
		$tmp = explode('" <', $adres);
		$tmp[0] = trim($tmp[0], '"<> ');
		$tmp[1] = trim($tmp[1], '"<> ');
		$tmp['voornaam'] = substr($tmp[0], 0, strpos($tmp[0], ' '));
		$tmp['achternaam'] = substr(stristr($tmp[0], ' '), 1);
		if ($tmp[1] != '') {
			$adressen[$i]['voornaam'] = rtrim(str_replace($voorzetsels, $leeg, $tmp['voornaam']));
			$adressen[$i]['naam'] = rtrim($tmp['voornaam'] . ' ' . $tmp['achternaam']);
			$adressen[$i]['email'] = $tmp[1];
			$i++;
		}
	}
	/* echo '<pre>';
print_r($adressen);
echo '</pre>';
 */
	return $adressen;
}

// Reverse search of strrchr.
function strrrchr($haystack, $needle)
{
	// Returns everything before $needle.
	return substr($haystack, 0, strpos($haystack, $needle));
}

if (isset($_SESSION['taal']) and $_SESSION['taal'] == 1) { // test-adressen
	$adressen[1]['verzenden'] = 'on';
	$adressen[1]['naam'] =  "test-adres";
	$adressen[1]['voornaam'] =  "test";
	$adressen[1]['password'] =  "xxxx";
	$adressen[1]['email'] =  "dirkjan@pellegrina.net";
	$adressen[2]['verzenden'] = 'off';
	$adressen[2]['naam'] =  "LP assistent";
	$adressen[2]['voornaam'] =  "assistent";
	$adressen[2]['password'] =  "xxxx";
	$adressen[2]['email'] =  "assistent@pellegrina.net";
	$aantal = 2;
}

if (isset($_POST['selectie']) and isset($_SESSION['taal']) and $_SESSION['taal'] > 1) {

	switch ($_POST['selectie']) {

		case 'alles':

			unset($adressen);

			$query_inschrijving = sprintf(
				"SELECT DISTINCT
										  naam,
										  voornaam,
										  `password`,
										  email
									FROM dlnmr d
									  join inschrijving i
										on d.DlnmrId = i.DlnmrId_FK
									  left join zwartelijst z
										on d.DlnmrId = z.DlnmrId_FK
									WHERE z.DlnmrId_FK is null
										AND NOT(toehoorder <=> 1)
										AND NOT(email <=> \"\")
											AND achternaam NOT LIKE \"%%XXX%%\"
											AND achternaam NOT LIKE \"%%YYY%%\"
											AND achternaam NOT LIKE \"%%ZZZ%%\"
											AND taal % s % s
										ORDER BY achternaam ASC",
				$taal[$_SESSION['taal']],
				$instrzang[$_SESSION['instrzang']]
			);

			// echo 'query_inschrijving: ' . $query_inschrijving . "<br>\n";

			$inschrijving = $inschrijf->SelectLimit($query_inschrijving) or die($inschrijf->ErrorMsg());
			$aantal = $inschrijving->RecordCount();
			break;

		case 'niet-ingeschreven':

			unset($adressen);

			$query_inschrijving = sprintf(
				"SELECT DISTINCT
									  naam,
									  voornaam,
									  `password`,
									  email
									FROM dlnmr d
									  join inschrijving i
										on d.DlnmrId = i.DlnmrId_FK
									  left join zwartelijst z
										on d.DlnmrId = z.DlnmrId_FK
									WHERE z.DlnmrId_FK is null
										And NOT EXISTS(select
														 d.DlnmrId
													   from inschrijving
													   where d.DlnmrId = DlnmrId_FK
														   and CursusId_FK >= 11)
										AND NOT(toehoorder <=> 1)
										AND NOT(email <=> \"\")
										AND achternaam NOT LIKE \"%%XXX%%\"
										AND achternaam NOT LIKE \"%%YYY%%\"
										AND achternaam NOT LIKE \"%%ZZZ%%\"
										AND taal %s %s
									ORDER BY achternaam ASC",
				$taal[$_SESSION['taal']],
				$instrzang[$_SESSION['instrzang']]
			);

			// echo 'query_inschrijving: ' . $query_inschrijving . "<br>\n";

			$inschrijving = $inschrijf->SelectLimit($query_inschrijving) or die($inschrijf->ErrorMsg());
			$aantal = $inschrijving->RecordCount();
			break;

		case 'outlook':
			$adressen = lees_outlook(stripslashes($_POST['outlook']));
			$aantal = count($adressen);
			// echo "joehoe!<br>Aantal = {$aantal}<br>";
			break;

		case 'google':
			$adressen = lees_google(stripslashes($_POST['outlook']));
			$aantal = count($adressen);
			// echo "joehoe!<br>Aantal = {$aantal}<br>";
			break;

		case 'distributielijst':
			// echo 'joehoe!<br>';
			$adressen = lees_distributielijst(stripslashes($_POST['outlook']));
			$aantal = count($adressen);
			break;

		case 'access':
			// echo 'joehoe!<br>';
			$adressen = lees_access(stripslashes($_POST['outlook']));
			$aantal = count($adressen);
			break;

		case 'csv':

			$adressen = str_getcsv(stripslashes($_POST['outlook']));
			$aantal = count($adressen);
			break;

		case 'emails':

			unset($adressen);

			$adr = explode("\n", stripslashes($_POST['outlook']));
			$adres = array_unique($adr);
			$n = 1;
			foreach ($adres as $i => $a) {
				if ($a != '' and strpos($a, '@')) {
					$adressen[$n]['email'] = $a;
					$adressen[$n]['naam'] = $a;
					$n++;
				}
			}
			$aantal = count($adressen);
			/* 	echo '<pre>';
	echo 'adressen: <br>';
	print_r($adressen);
	echo '</pre>';
 */
			break;

		case 'cursus':

			unset($adressen);

			$query_inschrijving = sprintf(
				"SELECT DISTINCT naam, voornaam, password, email, CursusId_FK 
		FROM inschrijving, dlnmr 
		WHERE DlnmrId = DlnmrId_FK 
		AND aangenomen = 1 AND NOT (toehoorder <=> 1) AND NOT (afgewezen <=> 1) 
		AND achternaam NOT LIKE \"%%XXX%%\" 
		AND achternaam NOT LIKE \"%%YYY%%\" 
		AND achternaam NOT LIKE \"%%ZZZ%%\" 
		AND NOT(email <=> \"\")
		AND cursusId_FK = %s 
		AND taal %s %s
		ORDER BY achternaam ASC",
				GetSQLValueString(($_SESSION['cursusId'] + $cursus_offset), "int"),
				$taal[$_SESSION['taal']],
				$instrzang[$_SESSION['instrzang']]
			);

			// echo 'query_inschrijving: ' . $query_inschrijving . "<br>\n";

			$inschrijving = $inschrijf->SelectLimit($query_inschrijving) or die($inschrijf->ErrorMsg());
			$aantal = $inschrijving->RecordCount();
			break;

		case 'project':

			unset($adressen);

			$query_inschrijving = sprintf(
				"SELECT naam, voornaam, password, email, CursusId_FK FROM project_aanmelding, dlnmr 
		WHERE DlnmrId = DlnmrId_FK AND NOT (afgewezen <=> 1) 
		AND cursusId_FK = %s AND taal %s %s ORDER BY achternaam ASC",
				GetSQLValueString($_SESSION['cursusId'], "int"),
				$taal[$_SESSION['taal']],
				$instrzang[$_SESSION['instrzang']]
			);

			// echo 'query_inschrijving: ' . $query_inschrijving . "<br>\n";

			$inschrijving = $inschrijf->SelectLimit($query_inschrijving) or die($inschrijf->ErrorMsg());
			$aantal = $inschrijving->RecordCount();
			break;
	} // einde switch
}

if (isset($inschrijving)) {
	$i = 1;
	while (!$inschrijving->EOF) {
		$adressen[$i]['verzenden'] = 'on';
		$adressen[$i]['naam'] =  $inschrijving->Fields('naam');
		$adressen[$i]['voornaam'] =  $inschrijving->Fields('voornaam');
		$adressen[$i]['password'] =  $inschrijving->Fields('password');
		$adressen[$i]['cursus'] =  $inschrijving->Fields('CursusId_FK');
		$adressen[$i]['email'] =  $inschrijving->Fields('email');
		$inschrijving->MoveNext();
		$i++;
	}
}

if (isset($adressen) and count($adressen) > 0) {
	unset($_SESSION['adressen']);
	$_SESSION['adressen'] = $adressen;

	// $echo .= '$adressen gevuld!<br>';

	/* echo '<pre>';
echo 'adressen: <br>';
print_r($adressen);
echo '$_SESSION[adressen]: <br>';
print_r($_SESSION['adressen']);
echo '</pre>';
 */
}

if (empty($_POST['selectie']) or $_POST['selectie'] == '') {

	// $echo .=  'Selectie leeg!<br>';

	/* echo '<pre>';
echo 'adressen: <br>';
print_r($adressen);
echo '$_SESSION[adressen]: <br>';
print_r($_SESSION['adressen']);
echo '</pre>';
 */
	if (isset($_SESSION['adressen'])) foreach ($_SESSION['adressen'] as $key => $adres) {
		if (empty($_POST["C{$key}"]) or $_POST["C{$key}"] != 'on') $adres['verzenden'] = 'off';
	}
}

// end Recordset inschrijving

// begin Recordset cursusnamen
$query_cursussen = sprintf(
	"SELECT * FROM cursus WHERE cursusId BETWEEN %s AND %s ORDER BY cursusId ASC",
	$eerstecursus,
	$laatstecursus
);

$cursussen = $inschrijf->SelectLimit($query_cursussen) or die($inschrijf->ErrorMsg());
$totaal_cursussen = $cursussen->RecordCount();

$cursussen->MoveFirst();
while (!$cursussen->EOF) {
	setlocale(LC_ALL, 'nl_NL');
	$begindatum = strftime('%A %e %B', strtotime($cursussen->fields('datum_begin')));
	$einddatum = strftime('%A %e %B %Y', strtotime($cursussen->fields('datum_eind')));
	$datum = $begindatum . ' - ' . $einddatum;
	$cursusnaam[$cursussen->Fields('CursusId')]['NL'] = $cursussen->Fields('cursusnaam_nl')
		. ' (' . $cursussen->Fields('cursusplaats_nl') . ', ' . $datum . ')';
	setlocale(LC_ALL, 'en_GB'); // data e.d. in het Engels
	$begindatum = strftime('%A %e %B', strtotime($cursussen->fields('datum_begin')));
	$einddatum = strftime('%A %e %B, %Y', strtotime($cursussen->fields('datum_eind')));
	$datum = $begindatum . ' - ' . $einddatum;
	$cursusnaam[$cursussen->Fields('CursusId')]['EN'] = $cursussen->Fields('cursusnaam_en')
		. ' (' . $cursussen->Fields('cursusplaats_en') . ', ' . $datum . ')';
	$cursussen->MoveNext();
}


/* echo '<pre>';
echo 'aantal cursussen: ' . $totaal_cursussen . '<br>';
print_r($cursusnaam);
echo '</pre>';
 */
// end Recordset cursusnamen

// Database-handelingen messages:

if (empty($_POST["submitten"])) {
	$query_messages = "SELECT * FROM messages WHERE messageId = {$_SESSION['messageId']}";
	$nieuwsbrief = $inschrijf->SelectLimit($query_messages) or die($inschrijf->ErrorMsg());

	$afz = explode('#', $nieuwsbrief->Fields('afzender'));
	$_POST['afzender'] = $afz[0];
	$_POST['afzendermail'] = $afz[1];
}

if ($_POST['afzender'] != ''  and $_POST['afzendermail'] != '') $afzender = $_POST['afzender'] . '#' . $_POST['afzendermail'];
else $afzender = '';

if (isset($_POST["submitten"])) switch ($_POST["submitten"]) {
	case "Voeg toe":
		$insertSQL = sprintf(
			"INSERT INTO messages (subject, message, afzender, datum, adressen, cursusId, taal) 
		VALUES (%s, %s, %s, now(), %s, %s, %s)",
			GetSQLValueString($_POST['subject'], "text"),
			GetSQLValueString($_POST['message'], "text"),
			GetSQLValueString($afzender, "text"),
			GetSQLValueString($_POST['adressen'], "text"),
			GetSQLValueString($_SESSION['cursusId'], "int"),
			GetSQLValueString($_SESSION['taal'], "int")
		);

		if (!mysql_query($insertSQL)) die(mysql_error());

		$_SESSION['messageId'] = mysql_insert_id($conn);
		$_POST['messageId'] = $_SESSION['messageId'];
		$query_messages = "SELECT * FROM messages WHERE messageId = {$_SESSION['messageId']}";
		// echo 'De query is: '.$query_messages.'; laatste info = '.mysql_info().'<br>';
		$nieuwsbrief = $inschrijf->SelectLimit($query_messages) or die($inschrijf->ErrorMsg());
		break;

	case "Update":
		$updateSQL = sprintf(
			"UPDATE messages SET subject=%s, message=%s, afzender=%s, cursusId=%s, taal=%s WHERE messageId=%s",
			GetSQLValueString($_POST['subject'], "text"),
			GetSQLValueString($_POST['message'], "text"),
			GetSQLValueString($afzender, "text"),
			GetSQLValueString($_SESSION['cursusId'], "int"),
			GetSQLValueString($_SESSION['taal'], "int"),
			GetSQLValueString($_SESSION['messageId'], "int")
		);

		$Result1 = $inschrijf->Execute($updateSQL) or die($inschrijf->ErrorMsg());

		$query_messages = "SELECT * FROM messages WHERE messageId = {$_SESSION['messageId']}";
		$nieuwsbrief = $inschrijf->SelectLimit($query_messages) or die($inschrijf->ErrorMsg());
		break;

	case "Bewerken":
		$query_messages = "SELECT * FROM messages WHERE Id = {$_SESSION['messageId']}";
		$nieuwsbrief = $inschrijf->SelectLimit($query_messages) or die($inschrijf->ErrorMsg());
		break;

	case "Maak leeg":
		$query_messages = "SELECT * FROM messages WHERE messageId = -1";
		$nieuwsbrief = $inschrijf->SelectLimit($query_messages) or die($inschrijf->ErrorMsg());
		break;

	case "Wis nieuwsbrief":
		$query_messages = "DELETE FROM messages WHERE messageId = {$_SESSION['messageId']}";
		$nieuwsbrief = $inschrijf->SelectLimit($query_messages) or die($inschrijf->ErrorMsg());

		$query_messages = "SELECT * FROM messages WHERE messageId = -1";
		$nieuwsbrief = $inschrijf->SelectLimit($query_messages) or die($inschrijf->ErrorMsg());
		break;

	case "Verzend":
		$mail_text = '';
		if (empty($_POST['header']) or $_POST['header'] != 'uit') {
			if ($_SESSION['taal'] == 2 or $_SESSION['taal'] == 1) {
				$mail_text_file = ($_SERVER['DOCUMENT_ROOT'] . '/bevestiging/briefhoofd_NL.htm');
				$taalinstelling = 'NL';
			} else {
				$mail_text_file = ($_SERVER['DOCUMENT_ROOT'] . '/bevestiging/briefhoofd_EN.htm');
				$taalinstelling = 'EN';
			}
		} else {
			$mail_text_file = ($_SERVER['DOCUMENT_ROOT'] . '/bevestiging/briefhoofd_leeg.htm');
		}

		//		echo 'De mailtekstfile is: '.$mail_text_file.'<br>';
		$fh = fopen($mail_text_file, 'r');
		$mail_text = fread($fh, filesize($mail_text_file));
		fclose($fh);

		//		echo 'De mailtekst is: '.$mail_text;
		$mail_text .= $_POST['message'];

		$totaal_mails = 0;
		// kies de tekst-file

		if (isset($_SESSION['adressen'])) {

			if (isset($_POST['test']) and $_POST['test'] == 'test') {
				$adr['verzenden'] = 'on';
				$adr['naam'] =  "test-kopie";
				$adr['voornaam'] =  "zelf";
				$adr['password'] =  "xxxx";
				$adr['email'] =  "dirkjan@pellegrina.net";

				$_SESSION['adressen'][] = $adr;
				end($_SESSION['adressen']);
				$index = key($_SESSION['adressen']);
				$_POST["C{$index}"] = 'on';
			}

			/* echo '<pre>';
echo '$index: ' . $index . '<br>';
echo '$_SESSION[adressen]: <br>';
print_r($_SESSION['adressen']);
print_r($_POST);
echo '</pre>';
 */
			foreach ($_SESSION['adressen'] as $key => $adres) {

				if ($_POST["C{$key}"] == 'on' and $adres['email'] != "") {

					set_time_limit(30); // sets (or resets) maximum  execution time to 30 seconds)

					$cursus = $cursusnaam[$adres['cursus']][$taalinstelling];

					/* echo '<pre>';
echo 'adres: ' . $adres['cursus'] . ', taal: ' . $taalinstelling;
print_r($cursus);
echo '</pre>';
 */
					$mail_body = str_replace("{voornaam}", $adres['voornaam'], $mail_text);
					$mail_body = str_replace("{naam}", $adres['naam'], $mail_body);
					$mail_body = str_replace("{cursus}", $cursus, $mail_body);
					$mail_body = str_replace("{password}", $adres['password'], $mail_body);
					$verzonden_emails .= stripslashes($adres['email']) . '; ';

					// echo "De mail-tekst is: <br>{$mail_body}<br><br><hr>";

					// stuur een mail
					$mail 				= new LPmailer();
					$mail->AddAddress(stripslashes($adres['email']), stripslashes($adres['naam']));
					$mail->Subject 		= $_POST['subject'];
					$mail->FromName    	= $_POST['afzender'];
					$mail->From    		= $_POST['afzendermail'];
					if (isset($_POST['CC']) and $_POST['CC'] == 'CC')
						$mail->AddCC("info@pellegrina.net", "LP PHP mailer");
					$mail->Body    		= $mail_body;

					checkSize(); // niet groter dan 5 Mb
					foreach ($attachments as $key => $value) {  //loop the Attachments to be added ...
						$mail->AddAttachment("uploads" . "/" . $value);
					}

					$nr = $totaal_mails + 1;

					$mail->AltBody = strip_tags($mail_body);

					if ($_POST['verzenden'] != 'Verzenden') {
						echo "De mail-tekst van {$_POST['afzender']} ({$_POST['afzendermail']}) naar {$adres['naam']} ({$adres['email']}) is: <br>{$mail_body}";
						echo '<br><hr><br>';
					} else {
						if (!$mail->Send()) {
							echo "Bericht nr. {$nr} aan {$adres['naam']} kon niet verzonden worden.<br>";
							echo "Mailer Error: " . $mail->ErrorInfo . '<br>';
							usleep(10000000); // tien seconden pauze
						} else {
							echo "Bericht nr. {$nr} aan {$adres['naam']} verzonden.<br>";
							$totaal_mails++;
							if ($totaal_mails % 60 == 0) usleep(10000000); // tien seconden pauze
						}
					}

					// after mail is sent with attachments , delete the images on server ...
					/* 			foreach ($attachments as $key => $value) {//remove the uploaded files ..
					unlink("uploads"."/".$value);
			}
 */
				} // einde deze mailing
			}

			$updateSQL = sprintf(
				"UPDATE messages SET subject=%s, message=%s, afzender=%s, datum=NOW(), adressen=%s, cursusId=%s, taal=%s 
	WHERE messageId=%s",
				GetSQLValueString($_POST['subject'], "text"),
				GetSQLValueString($_POST['message'], "text"),
				GetSQLValueString($afzender, "text"),
				GetSQLValueString($verzonden_emails, "text"),
				GetSQLValueString($_SESSION['cursusId'], "int"),
				GetSQLValueString($_SESSION['taal'], "int"),
				GetSQLValueString($_SESSION['messageId'], "int")
			);

			$Result1 = $inschrijf->Execute($updateSQL) or die($inschrijf->ErrorMsg());

			$query_messages = "SELECT * FROM messages WHERE messageId = {$_SESSION['messageId']}";
			$nieuwsbrief = $inschrijf->SelectLimit($query_messages) or die($inschrijf->ErrorMsg());
		}
		echo 'Totaal verzonden mails in deze mailing: ' . $totaal_mails . '<br>';
		break; // einde verzend mailing
}

// Haal nieuwsbrieven op:

$where = '';
if (isset($_POST['zoek_subject']) and $_POST['zoek_subject'] != '') $where = "WHERE subject LIKE '%{$_POST['zoek_subject']}%'";

$query_messages = "SELECT * FROM messages {$where} order by datum desc";
$nieuwsbrieven = $inschrijf->SelectLimit($query_messages) or die($inschrijf->ErrorMsg());

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php //PHP ADODB document - made with PHAkt 3.7.0
?>
<script language="javascript" type="text/javascript" src="/javascript/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		// General options
		mode: "exact",
		elements: "message",
		theme: "advanced",
		document_base_url: "http://www.pellegrina.net/Images/",
		convert_urls: false,
		relative_urls: false,
		plugins: "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1: "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl",
		theme_advanced_buttons4: "fullscreen,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak",
		theme_advanced_toolbar_location: "top",
		theme_advanced_toolbar_align: "left",
		theme_advanced_statusbar_location: "bottom",
		theme_advanced_resizing: true,

		// CSS

		content_css: "http://www.pellegrina.net/css/mailing.css"
	});

	function Selecteer(code, Nr) {
		switch (code) {
			case 'a':
				document.getElementById('selectie').value = 'alles';
				document.getElementById('formulier').submit();
				break;
			case 'n':
				document.getElementById('selectie').value = 'niet-ingeschreven';
				document.getElementById('formulier').submit();
				break;
			case 'g':
				document.getElementById('selectie').value = 'google';
				document.getElementById('outlook').class = '';
				document.getElementById('formulier').submit();
				break;
			case 'o':
				document.getElementById('selectie').value = 'outlook';
				document.getElementById('outlook').class = '';
				document.getElementById('formulier').submit();
				break;
			case 'v':
				document.getElementById('selectie').value = 'csv';
				document.getElementById('outlook').class = '';
				document.getElementById('formulier').submit();
				break;
			case 'l':
				document.getElementById('selectie').value = 'distributielijst';
				document.getElementById('outlook').class = '';
				document.getElementById('formulier').submit();
				break;
			case 'f':
				document.getElementById('selectie').value = 'emails';
				document.getElementById('outlook').class = '';
				document.getElementById('formulier').submit();
				break;
			case 'd':
				document.getElementById('selectie').value = 'access';
				document.getElementById('outlook').class = '';
				document.getElementById('formulier').submit();
				break;
			case 'p':
				document.getElementById('cursusId').value = Nr;
				document.getElementById('selectie').value = 'project';
				document.getElementById('formulier').submit();
				break;
			case 'c':
				document.getElementById('cursusId').value = Nr;
				document.getElementById('selectie').value = 'cursus';
				document.getElementById('formulier').submit();
				break;
		}
	}

	function messageZoek(Nr) {
		document.getElementById('messageId').value = Nr;
		document.getElementById('formulier').submit();
	}

	function switchAll() {
		for (var j = 1; j <= <?php echo ($aantal > 0 ? $aantal : 0); ?>; j++) {
			box = eval("document.formulier.C" + j);
			box.checked = !box.checked;
		}
	}

	function GP_popupConfirmMsg(msg) { //v1.0
		document.MM_returnValue = confirm(msg);
	}

	function klapdiensten(id) {
		if (document.getElementById(id)) {
			var cont = document.getElementById(id).style;
			if (cont.display == "block") {
				cont.display = "none";
			} else {
				cont.display = "block";
			}
			return false;
		} else {
			return true;
		}
	}
</script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700,400italic,700italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/jquery_opdrachten.php');
?>
<html>

<head>
	<title>Message mailer</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="/css/mailing.css" rel="stylesheet" type="text/css">
	<link href="/css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
	<style type="text/css">
		<!--
		body {
			padding: 0 10px;
		}

		#links {
			float: left;
			width: 50%;
			overflow: hidden;
		}

		.toets {
			font-size: 70%;
			color: #FF0000;
		}

		.kolom {
			float: left;
			margin-left: 2px;
			width: 19%;
			font-size: 65%;
		}

		div#outlookveld {
			display: none;
		}

		div#attachments {
			display: none;
		}

		table#berichten {
			width: 100%;
		}

		div#berichten_wrapper {
			width: 50%;
			float: left;
		}
		-->
	</style>
</head>

<body>
	<?php // echo 'De buffer is '.ob_get_length().' tekens lang<br>';
	while (@ob_end_flush()); ?>
	<div id="links">
		<form action="<?php echo $editFormAction; ?>" method="post" name="formulier" id="formulier" enctype='multipart/form-data'>
			<strong>Subject:</strong>
			<input name="subject" type="text" id="subject" size="70" value="<?php echo $nieuwsbrief->Fields('subject'); ?>">
			<br>
			<textarea name="message" id="message"><?php echo $nieuwsbrief->Fields('message'); ?></textarea>
			<p>
				<input type="submit" name="submitten" value="Voeg toe">
				<input name="submitten" type="submit" id="submitten" value="Update">
				<input onClick="GP_popupConfirmMsg('Kan deze nieuwsbrief werkelijk verzonden worden?'); return document.MM_returnValue"
					name="submitten" type="submit" id="submitten" value="Verzend">
				<input name="submitten" type="submit" id="submitten" value="Maak leeg">
				<input onClick="GP_popupConfirmMsg('Kan deze nieuwsbrief werkelijk gewist worden?'); return document.MM_returnValue"
					name="submitten" type="submit" id="submitten" value="Wis nieuwsbrief">
				<input type="hidden" name="messageId" id="messageId" value="<?php echo $_POST['messageId']; ?>">
				<br>
				<input name="verzenden" type="checkbox" id="verzenden" value="Verzenden">
				Daadwerkelijk verzenden
				<input name="CC" type="checkbox" id="CC" value="CC" <?php
																	if (isset($_POST['CC']) and $_POST['CC'] == 'CC') echo 'checked'; ?>>
				met CC
				<input name="test" type="checkbox" id="test" value="test" <?php
																			if (isset($_POST['test']) and $_POST['test'] == 'test') echo 'checked'; ?>>
				kopie naar "test"
				<input name="header" type="checkbox" id="header" value="uit" <?php
																				if (isset($_POST['header']) and $_POST['header'] == 'uit') echo 'checked'; ?>>
				zonder header
				<label><br>
					Afzender:
					<input name="afzender" type="text" id="afzender" value="<?php if (isset($_POST['afzender']) and $_POST['afzender'] != '') echo $_POST['afzender'];
																			else echo 'La Pellegrina'; ?>">
				</label>
				;
				<label>Mail-adres afzender:
					<input name="afzendermail" type="text" id="afzendermail" value="<?php if (isset($_POST['afzendermail']) and $_POST['afzendermail'] != '') echo $_POST['afzendermail'];
																					else echo 'info@pellegrina.net'; ?>">
				</label>
			</p>
			<hr>
			<h2>Verzend mailing aan deelnemers </h2>
			<br>
			<table width="100%">
				<tr>
					<td><strong>taalkeuze:</strong></td>
					<td><input name="taal" type="radio" value="1" <?php if (isset($_POST['taal']) and ($_POST['taal'] == "1"))
																		echo 'checked';
																	elseif (empty($_POST['taal'])) echo 'checked'; ?>>
						test</td>
					<td><input type="radio" name="taal" value="2" <?php if (isset($_POST['taal']) and ($_POST['taal'] == "2"))
																		echo 'checked'; ?>>
						NL</td>
					<td><input type="radio" name="taal" value="3" <?php if (isset($_POST['taal']) and ($_POST['taal'] == "3"))
																		echo 'checked'; ?>>
						niet NL</td>
					<td><input type="radio" name="taal" value="4" <?php if (isset($_POST['taal']) and ($_POST['taal'] == "4"))
																		echo 'checked'; ?>>
						alles</td>
					<td rowspan="2"><button ACCESSKEY="a" name="cursusNr" type="button"
							onClick="Selecteer('a')">alle deelnemers</button>
						<button ACCESSKEY="k" name="cursusNr" type="button"
							onClick="Selecteer('c', 1)">Cursus 1</button>
						<button name="cursusNr" type="button"
							onClick="Selecteer('c', 2)">Cursus 2</button>
						<button name="cursusNr" type="button"
							onClick="Selecteer('c', 3)">Cursus 3</button>
						<button name="cursusNr" type="button"
							onClick="Selecteer('c', 4)">Cursus 4</button>
						<button name="cursusNr" type="button"
							onClick="Selecteer('c', 5)">Cursus 5</button>
						<button name="cursusNr" type="button"
							onClick="Selecteer('p', 2)">Boheemse kerst</button>
						<button ACCESSKEY="i" name="cursusNr" type="button"
							onClick="Selecteer('n')">nog niet ingeschreven </button>
						<button ACCESSKEY="s" name="cursusNr" type="button"
							onclick="klapdiensten('outlookveld');">andere bestanden</button>
						<br>
					</td>
					<input type="hidden" name="cursusId" id="cursusId" value="<?php echo $_POST['cursusId']; ?>">
					<input type="hidden" name="selectie" id="selectie">
				</tr>
				<tr>
					<td><strong>instr./zang</strong></td>
					<td><input name="instrzang" type="radio" value="1" <?php if (isset($_POST['instrzang']) and ($_POST['instrzang'] == "1"))
																			echo 'checked';
																		elseif (empty($_POST['instrzang'])) echo 'checked'; ?>>
						alles</td>
					<td><input type="radio" name="instrzang" value="2" <?php if (isset($_POST['instrzang']) and ($_POST['instrzang'] == "2"))
																			echo 'checked'; ?>>
						instr.</td>
					<td><input type="radio" name="instrzang" value="3" <?php if (isset($_POST['instrzang']) and ($_POST['instrzang'] == "3"))
																			echo 'checked'; ?>>
						zang</td>
					<td>&nbsp;</td>
				</tr>
			</table>
			<div id="outlookveld">
				<table width="50%" border="0" cellpadding="0">
					<tr>
						<td>plak hier de selectie uit Outlook:<br>
							<textarea name="outlook" id="outlook" cols="100" rows="6"><?php echo stripslashes($_POST['outlook']); ?></textarea>
						</td>
					</tr>
					<tr>
						<td><button ACCESSKEY="g" name="cursusNr" type="button" onClick="Selecteer('g')">selectie uit Google "Aan-veld"</button>
							<br>
							<button ACCESSKEY="o" name="cursusNr" type="button" onClick="Selecteer('o')">selectie uit Outlook rechtstreeks </button>
							<br>
							<button ACCESSKEY="v" name="cursusNr" type="button" onClick="Selecteer('v')">selectie uit Outlook CSV</button>
							<br>
							<button ACCESSKEY="l" name="cursusNr" type="button" onClick="Selecteer('l')">distributielijst uit Outlook</button>
							<br>
							<button ACCESSKEY="d" name="cursusNr" type="button" onClick="Selecteer('d')">CSV Email, naam, voornaam (Access)</button>
							<br>
							<button ACCESSKEY="f" name="cursusNr" type="button" onClick="Selecteer('f')">file met emails</button>
						</td>
					</tr>
				</table>
			</div>
			<p>In totaal <?php echo $aantal; ?> mail-adressen</p>
			<?php
			if (isset($aantal) and $aantal > 0) {
				$kolomlengte = floor($aantal / $aantal_kolommen);
				if (fmod($aantal, $aantal_kolommen) > 0) $kolomlengte += 1;
				$key = 1;
				//	echo 'Kolomlengte: '.$kolomlengte.'<br>';
				echo '<div class="kolom">';
				while ($key <= $aantal) {
					$i = 1;
					while ($i <= $kolomlengte and $key <= $aantal) {
						echo '<input name="C' . $key . '" type="checkbox" ';
						if ($adressen[$key]['verzenden'] != 'off') echo 'checked';
						echo ' >&nbsp;' . $adressen[$key]['naam'] . '<br>';
						$i++;
						$key++;
					}
					if ($key <= $aantal) echo "</div>{$ctrlf}<div class=\"kolom\">";
					else {
						while ($i <= $kolomlengte - 1) {
							echo '<br>';
							$i++;
						}
						echo "</div>{$ctrlf}<p STYLE=\"clear: both\">&nbsp;</p>";
					}
				}
			}
			?>
			<p>
				<label>
					<input name="alle" type="checkbox" id="alle" value="1" OnClick="switchAll()">
					(de)selecteer alle namen</label>
			</p>
			<h2>
				<input type="checkbox" OnClick="klapdiensten('attachments')" name="attach_switch" id="attach_switch">
				Attachments versturen
			</h2>
			<p>&nbsp;</p>
			<div id="attachments">
				<table border="1" cellpadding="4">
					<tr>
						<th scope="col">Naam:</th>
						<th scope="col">Bestand:</th>
					</tr>
					<?php $max_no_files = 5; // Maximum number of images value to be set here
					for ($i = 1; $i <= $max_no_files; $i++) {
						echo "<tr><td>File $i: </td><td>
<input type=file name='files[]' class='bginput'></td></tr>";
					}
					?>
				</table>
			</div>
	</div>
	<div id="berichten_wrapper">
		<table border="1" cellpadding="4" class="tablesorter" id="berichten">
			<thead>
				<tr>
					<th><label>Subject <span class="nadruk">(kies = Sh-Alt F)</span>:
							<input type="text" name="zoek_subject" id="zoek_subject" accesskey="F" value="<?php
																											if (isset($_POST['zoek_subject']) and $_POST['zoek_subject'] != '') echo $_POST['zoek_subject'] ?>">
							<input name="subject" type="submit" id="subject" value="zoek">
						</label>
					</th>
					<th width="13%">Datum:</th>
					<th width="22%">Afzender:</th>
				</tr>
			</thead>
			<tbody>
				<?php
				while (!$nieuwsbrieven->EOF) {
					$afzender = strrrchr($nieuwsbrieven->Fields('afzender'), '#');
					$datum = strrrchr($nieuwsbrieven->Fields('datum'), ' ');
				?>
					<tr>
						<td><a onClick="messageZoek(<?php echo $nieuwsbrieven->Fields('messageId'); ?>)"> <?php echo $nieuwsbrieven->Fields('subject'); ?></a>&nbsp;</td>
						<td><?php echo $datum; ?>&nbsp;</td>
						<td><?php echo $afzender; ?>&nbsp;</td>
					</tr>
				<?php
					$nieuwsbrieven->MoveNext();
				}
				?>
			</tbody>
		</table>
	</div>
	</form>
</body>

</html><?php
		if (isset($inschrijving)) $inschrijving->Close();
		if (isset($cursussen)) $cursussen->Close();
		?>