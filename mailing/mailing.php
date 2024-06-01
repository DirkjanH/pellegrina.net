<?php //Connection statement
// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1);
error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2024.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Pelago\Emogrifier\CssInliner;
use function \PHP81_BC\strftime;

Kint::$enabled_mode = true;

d($GLOBALS, $_POST, $_GET);

ob_start();

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

if (empty($_POST['message'])) $_POST['message'] = stripslashes((string) $_POST['message']);
if (empty($_POST['message'])) $_POST['subject'] = stripslashes((string) $_POST['subject']);
if (empty($_POST['subject'])) $_POST['subject'] = '[subject]';

d($_POST, $_SESSION);

// begin Recordset inschrijving

function sort_array($array, $sortby, $direction = 'asc')
{

	$sortedArr = array();
	$tmp_Array = array();

	foreach ($array as $k => $v) {
		$tmp_Array[] = strtolower($v[$sortby]);
	}

	if ($direction == 'asc') {
		asort($tmp_Array);
	} else {
		arsort($tmp_Array);
	}

	foreach ($tmp_Array as $k => $tmp) $sortedArr[] = $array[$k];
	return $sortedArr;
} //eind sort_array

function super_unique($array, $key)
{
	$temp_array = [];
	foreach ($array as &$v) {
		if (!isset($temp_array[$v[$key]]))
			$temp_array[$v[$key]] = &$v;
	}
	$array = array_values($temp_array);
	return $array;
}

function lees_gdata($groep = '')
{

	global $voorzetsels, $leeg;

	$adresbestand = '/var/www/vhosts/horringa.net/.local/share/contacts/contacts.csv'; // in map '.local/share/contacts'

	if ((file_exists($adresbestand)) !== FALSE) {
		$datastring_converted = file_get_contents($adresbestand);
		$reg_expr = '#Keywords,\d\d\d\d-\d\d-\d\d\n#';
		d($reg_expr, $datastring_converted);
		$datastring_converted = substr($datastring_converted, strpos($datastring_converted, 'Type,Jot 2 - Value' . PHP_EOL) + 19);
		$datastring_converted = preg_replace($reg_expr, '#$#', $datastring_converted);
		d($datastring_converted);
		$datastring_converted = str_replace(',,' . PHP_EOL, '#$#', $datastring_converted);
		$datastring_converted = str_replace(PHP_EOL, '|', $datastring_converted);
		$datastring_converted = str_replace('#$#', ',,' . PHP_EOL, $datastring_converted);
		d($datastring_converted);
		$lines = explode(PHP_EOL, $datastring_converted);
		$aantal_kommas = substr_count($lines[0], ',');

		$maxi = count($lines);
		//unset($lines[0]); // Kolom headers
		d($aantal_kommas, $maxi, $lines);

		foreach ($lines as $line) {
			$data = str_getcsv($line, ",", "\"");
			d($data);
			if (((isset($data[30]) and $data[30] !== '') or (isset($data[32]) and $data[32] !== '')) and (strstr($data[28], 'Geen folders') === false)) {
				unset($adres);
				$adres['naam'] = $data[0];
				$adres['voornaam'] = rtrim(str_replace($voorzetsels, $leeg, $data[1]));
				if ($data[30] != '') $adres['email'] = $data[30];
				else $adres['email'] = $data[32];
				if (strstr($adres['email'], ' ::: ')) $adres['email'] = substr($adres['email'], 0, strpos($adres['email'], ' ::: '));
				if ($data[49] != '') $adres['postcode'] = $data[49];
				else $adres['postcode'] = $data[58];
				//			if (strstr($adres['postcode'], ' ::: ')) $adres['postcode'] = substr($adres['postcode'], 0, strpos($adres['postcode'], ' ::: '));
				if (isset($adres['postcode']) and $adres['postcode'] != '' and preg_match('/[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}/i', $adres['postcode'])) $adres['land'] = 'NL';
				$adres['groep'] = $data[28];
				d($adres);
				if (isset($groep) and $groep != '') {
					if (strstr($adres['groep'], $groep)) {
						if (!(strstr($groep, 'LaPel') and strstr($data[28], 'LaPel niet')))
							$results[] = $adres;
					}
				} else $results[] = $adres;
			}
			//else echo('Pech!<br>');
		}
	} else echo ('Bestand contacts.csv staat niet hier<br>');

	$results = sort_array($results, 'postcode');

	d($results, $_SERVER);

	return $results;
}

function lees_outlook($input)
{
	global $voorzetsels, $leeg, $ctrlf, $enclosure;
	$witregel = $ctrlf . $ctrlf;
	$lijst = explode($witregel, $input);

	if (strpos($input, $witregel) === false)
		echo '<script language="javascript">confirm("Dit zijn geen Outlook-adressen. Wil je dit?")</script>;';

	d($lijst);

	//unset($lijst[0]);
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
	d($adressen);

	return $adressen;
}

function lees_distributielijst($input)
{
	global $voorzetsels, $leeg, $ctrlf, $enclosure;

	//d($input);

	if (strpos($input, ('Leden:' . "\t " . $ctrlf)) === false)
		echo '<script language="javascript">confirm("Dit is geen Outlook-distributielijst. Wil je dit?")</script>;';

	$lijst = explode($ctrlf, $input);

	//d($lijst);

	$i = 0;
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
	d($adressen);
	echo '</pre>';

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

	d($input, $delimiter, $enclosure);

	$fp = fopen('php://temp', 'r+');
	// ... write $input to the "file" using fwrite()...
	fwrite($fp, $input);
	// ... rewind the "file" so we can read what we just wrote...
	rewind($fp);
	// ... read the entire line into a variable...
	unset($adressen);
	$i = 0;
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

	//d($adressen);

	return $adressen;
}

function lees_google($input)
{
	global $voorzetsels, $leeg, $enclosure;
	$regelscheiding = ', ';
	if (strpos($input, $regelscheiding) === false)
		echo '<script language="javascript">confirm("Dit zijn geen Google-adressen. Wil je dit?")</script>;';
	else $lijst = explode($regelscheiding, $input);

	d($lijst);

	//	unset($lijst[0]);
	$i = 0;
	foreach ($lijst as $adres) {
		$tmp = explode(' <', $adres);
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

	//d($adressen);

	return $adressen;
}

// Reverse search of strrchr.
function strrrchr($haystack, $needle)
{
	// Returns everything before $needle.
	return substr($haystack, 0, strpos($haystack, $needle));
}

if (isset($_SESSION['taal']) and $_SESSION['taal'] == 1) { // test-adressen
	$adressen[0]['verzenden'] = 'on';
	$adressen[0]['naam'] =  "test-adres Outlook";
	$adressen[0]['voornaam'] =  "...";
	$adressen[0]['password'] =  "xxxx";
	$adressen[0]['email'] =  "dirkjanhorringa@outlook.com";
	$adressen[0]['DlnmrId'] =  "737";
	$adressen[1]['verzenden'] = 'off';
	$adressen[1]['naam'] =  "test-adres Google";
	$adressen[1]['voornaam'] =  "....";
	$adressen[1]['password'] =  "xxxx";
	$adressen[1]['email'] =  "dhorringa@gmail.com";
	$adressen[1]['DlnmrId'] =  "737";
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
										  email,
										  DlnmrId
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

			$inschrijving = select_query($query_inschrijving);
			$aantal = count($inschrijving);
			d($inschrijving);
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
														   and CursusId_FK >= {string $eerstecursus})
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

			d($query_inschrijving);

			$inschrijving = select_query($query_inschrijving);
			$aantal = count($inschrijving);
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

		case 'lp-nl':
			$adressen = lees_gdata('LaPel NL');
			$aantal = count($adressen);
			//	echo "joehoe!<br>Aantal = {$aantal}<br>";
			break;

		case 'lp-eng':
			$adressen = lees_gdata('LaPel ENG');
			$aantal = count($adressen);
			//	echo "joehoe!<br>Aantal = {$aantal}<br>";
			break;

		case 'utrecht':

			unset($adressen);
			unset($_SESSION['adressen']);

			$results = lees_gdata();
			$aantal_r = count($results);
			$adressen = array();
			foreach ($results as $r) {
				if ((($r['postcode'] > '1000' and $r['postcode'] < '1400')
						or ($r['postcode'] > '2500' and $r['postcode'] < '4300'))
					and $r['land'] == 'NL'
				)
					$adressen[] = $r;
			}
			$aantal = count($adressen);
			d($aantal_r, $aantal);
			break;

		case 'culemborg':

			unset($adressen);
			unset($_SESSION['adressen']);

			$results = lees_gdata();
			$aantal_r = count($results);
			$adressen = array();
			foreach ($results as $r) {
				if ((($r['postcode'] > 3400 and $r['postcode'] < 4300))
					and $r['land'] == 'NL'
				)
					$adressen[] = $r;
			}
			$aantal = count($adressen);
			break;

		case 'arnhem':

			unset($adressen);
			unset($_SESSION['adressen']);

			$results = lees_gdata();
			$aantal_r = count($results);
			$adressen = array();
			foreach ($results as $r) {
				if ((($r['postcode'] > 6500 and $r['postcode'] < 8000))
					and $r['land'] == 'NL'
				)
					$adressen[] = $r;
			}
			$aantal = count($adressen);
			break;

		case 'afoort':

			unset($adressen);
			unset($_SESSION['adressen']);

			$results = lees_gdata();
			$aantal_r = count($results);
			$adressen = array();
			foreach ($results as $r) {
				if (($r['postcode'] >= 3700 and $r['postcode'] <= 4000)
					or ($r['postcode'] >= 1200 and $r['postcode'] <= 1400)
					and $r['land'] == 'NL'
				)
					$adressen[] = $r;
			}
			$aantal = count($adressen);
			d($adressen, $aantal);
			break;

		case 'postcodegebied':

			unset($adressen);
			unset($_SESSION['adressen']);

			d($_POST['postcodegebied']);
			function viercijfers($code)
			{
				$code = strval($code);
				if (!ctype_digit($code)) echo "Deze postcode $code bestaat niet geheel uit cijfers<br>";
				if (strlen($code) > 4) echo $code = substr($code, 0, 4);
				elseif (strlen($code) < 4) $code = str_pad($code, 4, '0');
				d($code);
				return $code;
			}

			if (isset($_POST['postcodegebied']) and $_POST['postcodegebied'] != '') {
				$pcg = str_replace(' ', '', $_POST['postcodegebied']);
				if (strpos($pcg, ';')) $gebieden = explode(';', $pcg);
				else $gebieden[0] = $pcg;
				// var_dump($gebieden);
				foreach ($gebieden as $gebied) {
					if (strpos($gebied, '-')) $pc = explode('-', $gebied);
					// var_dump($pc);
					$pc[0] = viercijfers($pc[0]);
					$pc[1] = viercijfers($pc[1]);
					if ($pc[0] < $pc[1]) {
						$geb['begin'] = $pc[0];
						$geb['eind'] = $pc[1];
					} else {
						$geb['begin'] = $pc[1];
						$geb['eind'] = $pc[0];
					}
					$pcgebieden[] = $geb;
				}
			}
			d($pcgebieden);
			$results = lees_gdata();
			d($results);
			$aantal_r = count($results);
			$adressen = array();
			foreach ($pcgebieden as $pcgebied) {
				foreach ($results as $r) {
					if ($r['land'] == 'NL' and $r['postcode'] >= $pcgebied['begin'] and $r['postcode'] <= $pcgebied['eind'])
						$adressen[] = $r;
				}
			}
			$adressen = super_unique($adressen, 'email');
			$aantal = count($adressen);
			break;

		case 'groep':
			d($_POST['groep']);
			if (isset($_POST['groep']) and $_POST['groep'] != '') $adressen = lees_gdata(stripslashes($_POST['groep']));
			$aantal = count($adressen);
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
			foreach ($adres as $a) {
				if ($a != '' and strpos($a, '@')) {
					$row['email'] = $a;
					$row['naam'] = $a;
					$adressen[] = $row;
				}
			}
			$aantal = count($adressen);

			d($adressen);

			break;

		case 'cursus':

			unset($adressen);

			$query_inschrijving = sprintf(
				"SELECT DISTINCT naam, voornaam, password, email, CursusId_FK 
		FROM inschrijving, dlnmr 
		WHERE DlnmrId = DlnmrId_FK 
		AND aangenomen = 1 
		AND NOT (toehoorder <=> 1) 
		AND NOT (afgewezen <=> 1) 
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

			d($query_inschrijving);

			$inschrijving = select_query($query_inschrijving);
			$aantal = count($inschrijving);
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

			d($query_inschrijving);

			$inschrijving = select_query($query_inschrijving);
			$aantal = count($inschrijving);
			break;
	} // einde switch
}

if (isset($inschrijving)) {
	foreach ($inschrijving as $i => $insch) {
		$adressen[$i]['verzenden'] = 'on';
		$adressen[$i]['naam'] =  $insch['naam'];
		$adressen[$i]['voornaam'] =  $insch['voornaam'];
		$adressen[$i]['password'] =  $insch['password'];
		$adressen[$i]['cursus'] =  $insch['CursusId_FK'];
		$adressen[$i]['email'] =  $insch['email'];
		$adressen[$i]['DlnmrId'] =  $insch['DlnmrId'];
	}
}

if (isset($adressen) and count($adressen) > 0) {
	$_SESSION['adressen'] = $adressen;
}

if (empty($_POST['selectie']) or $_POST['selectie'] == '') {
	if (isset($_SESSION['adressen'])) foreach ($_SESSION['adressen'] as $key => &$adres) {
		if (empty($_POST["C{$key}"]) or $_POST["C{$key}"] != 'on') $adres['verzenden'] = 'off';
		else $adres['verzenden'] = 'on';
	}
}
// end Recordset inschrijving

d($_POST, $_SESSION, $adressen, $inschrijving);

// begin Recordset cursusnamen
$query_cursussen = sprintf(
	"SELECT * FROM cursus WHERE cursusId BETWEEN %s AND %s ORDER BY cursusId ASC",
	$eerstecursus,
	$laatstecursus
);

$cursussen = select_query($query_cursussen);
$totaal_cursussen = count($cursussen);

foreach ($cursussen as $cursus) {
	$begindatum = strftime('%A %e %B %Y', strtotime($cursus['datum_begin']), 'nl_NL');
	$einddatum = strftime('%A %e %B %Y', strtotime($cursus['datum_eind']), 'nl_NL');
	$datum = $begindatum . ' - ' . $einddatum;
	$cursusnaam[$cursus['CursusId']]['NL'] = $cursus['cursusnaam_nl']
		. ' (' . $cursus['cursusplaats_nl'] . ', ' . $datum . ')';
	$begindatum = strftime('%A %B %e, %Y', strtotime($cursus['datum_begin']), 'en_GB');
	$einddatum = strftime('%A %B %e, %Y', strtotime($cursus['datum_eind']), 'en_GB');
	$datum = $begindatum . ' - ' . $einddatum;
	$cursusnaam[$cursus['CursusId']]['EN'] = $cursus['cursusnaam_en']
		. ' (' . $cursus['cursusplaats_en'] . ', ' . $datum . ')';
}

d($totaal_cursussen);
d($cursusnaam);

// end Recordset cursusnamen

// Database-handelingen messages:

if (empty($_POST["submitten"])) {
	$query_messages = "SELECT * FROM messages WHERE messageId = {$_SESSION['messageId']}";
	$nieuwsbrief = select_query($query_messages, 1);

	$afz = explode('#', $nieuwsbrief['afzender']);
	$_POST['afzender'] = $afz[0];
	if (isset($afz[1])) $_POST['afzendermail'] = $afz[1];
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

		exec_query($insertSQL);

		$_SESSION['messageId'] = $db->lastInsertId();
		$_POST['messageId'] = $_SESSION['messageId'];
		$query_messages = "SELECT * FROM messages WHERE messageId = {$_SESSION['messageId']}";
		d($query_messages);
		$nieuwsbrief = select_query($query_messages, 1);
		break;

	case "Update":
		$updateSQL = sprintf(
			"UPDATE messages SET subject=%s, message=%s, afzender=%s, cursusId=%s, taal=%s WHERE messageId=%s",
			GetSQLValueString(stripslashes($_POST['subject']), "text"),
			GetSQLValueString(stripslashes($_POST['message']), "text"),
			GetSQLValueString($afzender, "text"),
			GetSQLValueString($_SESSION['cursusId'], "int"),
			GetSQLValueString($_SESSION['taal'], "int"),
			GetSQLValueString($_SESSION['messageId'], "int")
		);

		d($updateSQL);
		exec_query($updateSQL);

		$query_messages = "SELECT * FROM messages WHERE messageId = {$_SESSION['messageId']}";
		$nieuwsbrief = select_query($query_messages, 1);
		break;

	case "Bewerken":
		$query_messages = "SELECT * FROM messages WHERE Id = {$_SESSION['messageId']}";
		$nieuwsbrief = select_query($query_messages, 1);
		break;

	case "Maak leeg":
		$query_messages = "SELECT * FROM messages WHERE messageId = -1";
		$nieuwsbrief = select_query($query_messages);
		break;

	case "Wis nieuwsbrief":
		$query_messages = "DELETE FROM messages WHERE messageId = {$_SESSION['messageId']}";
		exec_query($query_messages);

		$query_messages = "SELECT * FROM messages WHERE messageId = -1";
		$nieuwsbrief = select_query($query_messages, 1);
		break;

	case "Verzend":
		d($_POST, $_SESSION, $adressen);
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

		$mail_text = file_get_contents($mail_text_file);

		$mail_text = str_replace("</html>", $_POST['message'] . "</body></html>", $mail_text);

		$css = file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/css/w3.css') . PHP_EOL;
		$css .= file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/css/mailing.css');

		$mail_text = CssInliner::fromHtml(stripslashes($mail_text))->inlineCss($css)->render();

		d($mail_text);

		if (isset($_SESSION['adressen'])) {

			if (isset($_POST['test']) and $_POST['test'] == 'test') {
				$adr['verzenden'] = 'on';
				$adr['naam'] =  "test-kopie";
				$adr['voornaam'] =  "...";
				$adr['password'] =  "xxxx";
				$adr['email'] =  "dirkjanhorringa@outlook.com";

				$_SESSION['adressen'][] = $adr;
				/* 			end($_SESSION['adressen']);
			$index = key($_SESSION['adressen']);
			$_POST["C{$index}"] = 'on';
 */
			}

			d($_POST, $_SESSION, $adressen);

			// schrijf mail-opdracht naar 'mailing_opdrachten':
			$mail_text = $db->quote($mail_text);
			$subject = $db->quote($_POST['subject']);

			$Query = " 
				INSERT INTO mailing_opdrachten 
				( 
					`message`, 
					`subject`, 
					`From`, 
					`FromName`,
					`CC`, 
					`verzonden_mails`,
					`tijd_aanmaak`,
					`log`
				) 
				VALUES 
				( 
					{$mail_text},
					{$subject}, 
					'{$_POST['afzendermail']}', 
					'{$_POST['afzender']}',
					'{$_POST['CC']}', 
					0,
					NOW(),
					''
				)  
			";

			d($_POST, $_SESSION, $mail_text, $Query);

			exec_query($Query);

			// Haal de ID op:
			echo 'Mailing nr. ' . ($mailingId_FK = $db->lastInsertId()) . ' is klaargezet.<br>';

			// schrijf adressen naar 'mailing_adressen':
			$sQueryAdressen = " 
		INSERT INTO mailing_adressen 
		( 
			mailingId_FK, 
			naam, 
			voornaam, 
			email,
			cursus, 
			password,
			DlnmrId,
			kenmerk
		) 
		VALUES 
		( 
			:mailingId_FK, 
			:naam, 
			:voornaam, 
			:email, 
			:cursus, 
			:password,
			:DlnmrId,
			:kenmerk
		)  
	";

			$oStmt = $db->prepare($sQueryAdressen);
			$oStmt->bindParam(':mailingId_FK', $smailingId_FK, PDO::PARAM_INT);
			$oStmt->bindParam(':naam', $snaam, PDO::PARAM_STR);
			$oStmt->bindParam(':voornaam', $svoornaam, PDO::PARAM_STR);
			$oStmt->bindParam(':email', $semail, PDO::PARAM_STR);
			$oStmt->bindParam(':cursus', $scursus, PDO::PARAM_INT);
			$oStmt->bindParam(':password', $spassword, PDO::PARAM_STR);
			$oStmt->bindParam(':kenmerk', $skenmerk, PDO::PARAM_STR);
			$oStmt->bindParam(':DlnmrId', $sid, PDO::PARAM_INT);

			$mailing_aantal = 0;

			//d($_SESSION['adressen']);
			foreach ($_SESSION['adressen'] as $key => &$adres) {
				if ($adres['verzenden'] != 'off') {
					$nr = $key + 1;
					echo ("Naam nr. $nr: {$adres['naam']}<br>");
					$smailingId_FK = $mailingId_FK;
					$snaam = $adres['naam'];
					$svoornaam = $adres['voornaam'];
					$semail = $adres['email'];
					$scursus = $adres['cursus'];
					$spassword = $adres['password'];
					$sid = $adres['DlnmrId'];
					$skenmerk = bin2hex(random_bytes(8));
					//d($sid, $adres, $oStmt);
					$oStmt->execute();
					$mailing_aantal++;
				} else unset($adres);
			}
		} // if (isset($_SESSION['adressen']))

		$updateSQL = sprintf(
			"UPDATE messages SET subject=%s, message=%s, afzender=%s, datum=NOW() 
	WHERE messageId=%s",
			GetSQLValueString($_POST['subject'], "text"),
			GetSQLValueString($_POST['message'], "text"),
			GetSQLValueString($afzender, "text"),
			GetSQLValueString($_SESSION['messageId'], "int")
		);

		exec_query($updateSQL);

		$query_messages = "SELECT * FROM messages WHERE messageId = {$_SESSION['messageId']}";
		$nieuwsbrief = select_query($query_messages, 1);

		echo '<p>Totaal aantal adressen in deze mailing ' . $mailing_naam . ': ' . $mailing_aantal . '</p>';
		echo '<p>Toon de mailing via <a href="toon%20mailing.php?mailing=' . $mailingId_FK . '" target="_blank">Toon mailing</a></p>';
		echo '<p>Ga naar <a href="send%20mailing.php?mailing=' . $mailingId_FK . '" target="_blank">Send mailing</a> voor verzenden</p>';
		break; // einde verzend mailing
}

// Haal nieuwsbrieven op:

$where = 'DATE(datum) > SUBDATE(CURDATE(), INTERVAL 2 YEAR)';
if (isset($_POST['zoek_subject']) and $_POST['zoek_subject'] != '') $where = "subject LIKE '%{$_POST['zoek_subject']}%'";

?>
<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="apple-touch-icon" sizes="180x180" href="https://pellegrina.net/mailing/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="https://pellegrina.net/mailing/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="https://pellegrina.net/mailing/favicon-16x16.png">
	<link rel="mask-icon" href="https://pellegrina.net/mailing/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="https://pellegrina.net/mailing/favicon.ico">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-config" content="https://pellegrina.net/mailing/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">

	<title>LP message mailer</title>

	<!-- CSS: -->
	<link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
	<link rel="stylesheet" href="/css/pagina_stijlen.css" type="text/css">

	<script src="/vendor/tinymce/tinymce/tinymce.min.js?apiKey=qe1ss57qvki0ff97cxn83w9ip261wi2tkee1b76opnd2kc8j"></script>
	<script type="text/javascript">
		tinymce.init({
			selector: 'textarea#message',
			language: 'nl',
			language_url: '/taal_voor_tinymce/langs/nl.js', // site absolute URL
			browser_spellcheck: true,
			height: '1500px',
			width: '100%',
			menubar: 'tools view',
			plugins: 'image imagetools emoticons fullscreen print code preview fullpage searchreplace autolink autoresize directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime lists wordcount imagetools textpattern help spellchecker',
			toolbar: 'formatselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | link image media pageembed code | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment link fullscreen emoticons image',
			default_link_target: "_blank",
			link_assume_external_targets: true,
			link_context_toolbar: true,
			relative_urls: false,
			remove_script_host: false,
			document_base_url: "https://www.pellegrina.net/",
			convert_urls: false,
			relative_urls: false,
			contextmenu: true,
			content_css: [
				'/css/mailing.css'
			]
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
				case 'lp-nl':
					document.getElementById('selectie').value = 'lp-nl';
					document.getElementById('formulier').submit();
					break;
				case 'lp-eng':
					document.getElementById('selectie').value = 'lp-eng';
					document.getElementById('formulier').submit();
					break;
				case 'utrecht':
					document.getElementById('selectie').value = 'utrecht';
					document.getElementById('formulier').submit();
					break;
				case 'culemborg':
					document.getElementById('selectie').value = 'culemborg';
					document.getElementById('formulier').submit();
					break;
				case 'arnhem':
					document.getElementById('selectie').value = 'arnhem';
					document.getElementById('formulier').submit();
					break;
				case 'afoort':
					document.getElementById('selectie').value = 'afoort';
					document.getElementById('formulier').submit();
					break;
				case 'postcodegebied':
					document.getElementById('selectie').value = 'postcodegebied';
					document.getElementById('formulier').submit();
					break;
				case 'groep':
					document.getElementById('selectie').value = 'groep';
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
			for (var j = 0; j < <?php echo ($aantal > 0 ? $aantal : 0); ?>; j++) {
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
	<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700,400italic,700italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/jquery_opdrachten.php');
	?>
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
			width: 100%;
			clear: all;
			z-index: 1;
			position: relative;
			top: 0px;
			right: 0px;
		}

		div#message_area {
			z-index: 1;
			display: inline-block;
			width: 100%;
			overflow: hidden;
		}
		-->
	</style>
</head>

<body>
	<form action="<?php echo $editFormAction; ?>" method="post" name="formulier" id="formulier" enctype='multipart/form-data'>
		<div id="message_area"> <strong>Subject:</strong>
			<input name="subject" type="text" id="subject" size="70" value="<?php echo stripslashes($nieuwsbrief['subject']); ?>">
			<br>
			<textarea name="message" id="message"><?php echo stripslashes($nieuwsbrief['message']); ?></textarea>
			<p>
				<input type="submit" name="submitten" value="Voeg toe">
				<input name="submitten" type="submit" id="submitten" value="Update">
				<input onClick="GP_popupConfirmMsg('Kan deze nieuwsbrief werkelijk verzonden worden?'); return document.MM_returnValue" name="submitten" type="submit" id="submitten" value="Verzend">
				<input name="submitten" type="submit" id="submitten" value="Maak leeg">
				<input onClick="GP_popupConfirmMsg('Kan deze nieuwsbrief werkelijk gewist worden?'); return document.MM_returnValue" name="submitten" type="submit" id="submitten" value="Wis nieuwsbrief">
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
			<table width="100%" class="w3-table-all" border=1>
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
					<td><button ACCESSKEY="a" name="cursusNr" type="button" onClick="Selecteer('a')">alle deelnemers</button>
						<button ACCESSKEY="k" name="cursusNr" type="button" onClick="Selecteer('c', 1)">Cursus 1</button>
						<button name="cursusNr" type="button" onClick="Selecteer('c', 2)">Cursus 2</button>
						<button name="cursusNr" type="button" onClick="Selecteer('c', 3)">Cursus 3</button>
						<button ACCESSKEY="i" name="cursusNr" type="button" onClick="Selecteer('n')">nog niet ingeschreven </button>
						<button ACCESSKEY="s" name="cursusNr" type="button" onClick="Selecteer('lp-nl')">LaPel NL</button>
						<button name="cursusNr" type="button" onClick="Selecteer('lp-eng')">LaPel ENG</button>
						<button name="cursusNr" type="button" onClick="Selecteer('utrecht')">Utrecht e.o.</button>
						<button name="cursusNr" type="button" onClick="Selecteer('culemborg')">Culemborg e.o.</button>
						<button name="cursusNr" type="button" onClick="Selecteer('arnhem')">Arnhem e.o.</button>
						<button name="cursusNr" type="button" onClick="Selecteer('afoort')">A'foort e.o.</button>
					</td>
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
					<td> </td>
					<td><button name="cursusNr" type="button" onClick="Selecteer('postcodegebied')">Postcodegebied</button>, n.l. <input name="postcodegebied" type="text" id="postcodegebied" value="<?php echo $_POST['postcodegebied']; ?>" size="10">
						<span class="nadruk">*)</span>
						<button name="cursusNr" type="button" onClick="Selecteer('groep')">Contacts groep</button>, n.l. <input name="groep" type="text" id="groep" value="<?php echo $_POST['groep']; ?>" size="10">
						<button name="cursusNr" type="button" onclick="klapdiensten('outlookveld');">andere bestanden</button>
						<span class="nadruk">*) = gebied = xx-yy; xx2-yy2</span><br>
						<input type="hidden" name="cursusId" id="cursusId" value="<?php echo $_POST['cursusId']; ?>">
						<input type="hidden" name="selectie" id="selectie">
					</td>
				</tr>
			</table>
			<div id="outlookveld">
				<table width="50%" border="0" cellpadding="0">
					<tr>
						<td>plak hier de selectie:<br>
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
			<p>In totaal <?php if (isset($aantal)) echo $aantal; ?> mail-adressen</p>
			<?php
			if (isset($aantal) and $aantal > 0) {
				$kolomlengte = intval(ceil($aantal / $aantal_kolommen));
				$key = 0;
				d($aantal, $aantal_kolommen, $kolomlengte);
				echo '<div class="kolom">';
				while ($key < $aantal) {
					$i = 0;
					while ($i < $kolomlengte and $key < $aantal) {
						echo '<input name="C' . $key . '" type="checkbox" ';
						if ($adressen[$key]['verzenden'] != 'off') echo 'checked';
						echo ' >&nbsp;' . $adressen[$key]['naam'] . '&nbsp;(' . $adressen[$key]['postcode'] . ' ' . $key . ')<br>';
						$i++;
						$key++;
						//d($i,$key);
					}
					if ($key < $aantal) echo "</div>{$ctrlf}<div class=\"kolom\">";
					else echo "</div>{$ctrlf}<p STYLE=\"clear: both\">&nbsp;</p>";
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
					$query_messages = "SELECT * FROM messages WHERE {$where} order by datum desc";
					$nieuwsbrieven = $db->Query($query_messages);
					foreach ($nieuwsbrieven as $nieuwsbrief_x) {
						$afzender = strrrchr($nieuwsbrief_x['afzender'], '#');
						$datum = strrrchr($nieuwsbrief_x['datum'], ' ');
					?>
						<tr>
							<td><a onClick="messageZoek(<?php echo $nieuwsbrief_x['messageId']; ?>)"> <?php echo stripslashes($nieuwsbrief_x['subject']); ?></a>&nbsp;</td>
							<td><?php echo $datum; ?>&nbsp;</td>
							<td><?php echo $afzender; ?>&nbsp;</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</form>
</body>

</html>
<?php ob_end_flush(); ?>