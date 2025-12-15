<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2026.php');
require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

use Pelago\Emogrifier\CssInliner;

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/mailfuncties.inc.php';

Kint::$enabled_mode = false;

$locale = 'nl';

d($_REQUEST);

$deelnemer_query = "SELECT * FROM dlnmr d, adres a, inschrijving i WHERE i.random_id = '{$_GET['res']}' AND d.AdresId_FK = a.AdresId AND d.DlnmrId = i.DlnmrId_FK";
d($deelnemer_query);
$dlnmr = select_query($deelnemer_query, 1);
d($dlnmr);
if (isset($dlnmr) and str_contains($dlnmr['Mollie_ID'], 'tr_') and $dlnmr['betaalstatus'] == 'open') {
	sleep(3);
	$dlnmr = select_query($deelnemer_query, 1); // haal inschrijving na 3 seconden nog een keer op
}

$adres_query = "SELECT CONCAT(a.adres, ', ', a.postcode, ' ', a.plaats, ', ', a.land) as adres FROM dlnmr d, adres a, inschrijving i WHERE i.random_id = '{$_GET['res']}' AND d.AdresId_FK = a.AdresId AND d.DlnmrId = i.DlnmrId_FK";
$dlnmr['adres'] = select_query($adres_query, 0);
d($adres_query, $dlnmr['adres']);
$naam = $dlnmr['naam'];
$dlnmr['aanbetaling'] = euro($dlnmr['aanbet_bedrag']);

if (isset($dlnmr['CursusId_FK']) and $dlnmr['CursusId_FK'] != '') $cursus_query = "SELECT * FROM cursus WHERE CursusId = {$dlnmr['CursusId_FK']}";
else exit('Geen cursus geselecteerd');
$cursus = select_query($cursus_query, 1);

$cursus['datum_begin'] = format_datum_noyear($cursus['datum_begin'], $locale);
$cursus['datum_eind'] = format_datum($cursus['datum_eind'], $locale);
$cursus['datum_beslissing'] = format_datum_short($cursus['datum_beslissing'], $locale);
$cursus['datum_betaling'] = format_datum_short($cursus['datum_betaling'], $locale);
$cursus['inschrijfgeld'] = euro($cursus['inschrijfgeld']);

$instrumenten = select_query("SELECT * FROM instr ORDER BY id ASC");
foreach ($instrumenten as $row) {
	$instrumententabel[$row['id']] = $row['nl'];
}

$ins = explode(', ', trim($dlnmr['instr']));
$zangst = explode(', ', trim($dlnmr['zangstem']));
unset($instr);
unset($zangstem);
foreach ($ins as $in) if ($in >= 100) $instr[] = $instrumententabel[$in];
foreach ($zangst as $zangs) if ($zangs < 100) $zangstem[] = $instrumententabel[$zangs];
if (isset($instr)) $instrumentenlijst = implode(', ', $instr);
if (isset($zangstem)) $zangstem = implode(', ', $zangstem);

d($instrumenten, $instrumentenlijst, $deelnemer_query, $dlnmr, $cursus_query, $cursus, $instrumententabel, $ins, $zangstem);

// gegevens voor het mailtje:
$to = stripslashes($dlnmr['email']);
$subject = "Inschrijving voor La Pellegrina zomercursus '{$cursus['cursusnaam_nl']}'";

// maak de tekst van het emailbericht aan:
$message =
	<<<MESSAGE
	<p>Beste {$dlnmr['voornaam']},</p>
	<p>Bedankt voor je inschrijving voor de zomerschool <strong>{$cursus['cursusnaam_nl']}</strong>, die zal plaatsvinden op {$cursus['cursusplaats_nl']}, van {$cursus['datum_begin']} tot en met {$cursus['datum_eind']}. De volgende gegevens zijn geregistreerd:</p>\n
	<ul>
		<li>Naam: {$dlnmr['naam']}</li>
		<li>Inschrijving nr.: {$dlnmr['InschId']}</li>
		<li>Adres: {$dlnmr['adres']}</li>
		<li>Tel. {$dlnmr['telefoon']}
MESSAGE;
if ($dlnmr['mobiel'] != '') $message .= " | mobiel {$dlnmr['mobiel']}</li>";
else $message .= "</li>";

if (isset($dlnmr['instrumentalist']) and $dlnmr['instrumentalist'] > 0) {
	$message .= "<li>Je hebt je geregistreerd als instrumentalist, met instrument(en): {$instrumentenlijst}.</li>\n";
}

if (isset($dlnmr['zanger']) and $dlnmr['zanger'] > 0) {
	$message .= "<li>Je hebt je geregistreerd als zanger, met stemsoort {$zangstem}.</li>\n";
}

if (isset($dlnmr['solozanger']) and $dlnmr['solozanger'] > 0) {
	$message .= "<li>Je hebt je geregistreerd als solozanger, met stemsoort  {$zangstem}.</li>\n";
}

if (isset($dlnmr['toehoorder']) and $dlnmr['toehoorder'] > 0) {
	$message .= "<li>Je hebt je geregistreerd als toehoorder.</li>\n";
}

if (isset($dlnmr['eenpersoons']) and $dlnmr['eenpersoons'] > 0 && $dlnmr['CursusId_FK'] - $cursus_offset == 1) {
	$message .= "<li>Je hebt een eenpersoonskamer in het conservatorium gereserveerd. Het aantal is er beperkt. Ze zullen worden toegewezen na de definitieve toelating op {$cursus['datum_beslissing']}, in volgorde van inschrijving.</li>\n";
}

if (isset($dlnmr['eenpersoons']) and $dlnmr['eenpersoons'] > 0 && $dlnmr['CursusId_FK'] - $cursus_offset == 2) {
	$message .= "<li>Je hebt een eenpersoonskamer in het Gastenverblijf gereserveerd. Het aantal is er beperkt. Ze zullen worden toegewezen na de definitieve toelating op {$cursus['datum_beslissing']}, in volgorde van inschrijving.</li>\n";
}

if (isset($dlnmr['hotel_1pp']) and $dlnmr['hotel_1pp'] > 0) {
	$message .= "<li>Je hebt een eenpersoonskamer in het Poortgebouw gereserveerd. Het aantal is er beperkt. Ze zullen worden toegewezen na de definitieve toelating op {$cursus['datum_beslissing']}, in volgorde van inschrijving.</li>\n";
}

if (isset($dlnmr['hotel_2pp']) and $dlnmr['hotel_2pp'] > 0) {
	$message .= "<li>Je hebt een plaats in een tweepersoonskamer met eigen sanitair in het Poortgebouw gereserveerd. Het aantal kamers is er beperkt. Ze zullen worden toegewezen na de definitieve toelating op {$cursus['datum_beslissing']}, in volgorde van inschrijving.</li>\n";
}

if (isset($dlnmr['kamperen']) and $dlnmr['kamperen'] > 0) {
	$message .= "<li>Je wilt kamperen in de kloostertuin. Het aantal plekken is beperkt. Ze zullen worden toegewezen na de definitieve toelating op {$cursus['datum_beslissing']}, in volgorde van aanmelding.</li>\n";
}

if (isset($dlnmr['eigen_acc']) and $dlnmr['eigen_acc'] > 0) {
	$message .= "<li>Je hebt aangegeven dat je zelf je accommodatie wilt regelen. Neem hiervoor zelf contact op met een accommodatie. Het is raadzaam niet te lang te wachten.</li>\n";
}

if (isset($dlnmr['diner']) and $dlnmr['diner'] > 0) {
	$message .= "<li>Je hebt aangegeven dat je zelf je accommodatie regelt en gebruik wilt maken van het gezamenlijke avondeten.</li>\n";
}

if (isset($dlnmr['acc_wens']) and $dlnmr['acc_wens'] > 0) {
	$tmp = stripslashes($dlnmr['acc_wens']);
	$message .= "<li>Je speciale wensen voor accommodatie zijn: {$tmp}</li>\n";
}

if (isset($dlnmr['opmerkingen']) and $dlnmr['opmerkingen'] > 0) {
	$tmp = stripslashes($dlnmr['opmerkingen']);
	$message .= "<li>Je overige opmerkingen zijn: {$tmp}</li>\n";
}

$message .= "</ul>";

switch ($dlnmr['betaalstatus']) {
	case 'paid':
		$message .= "<p>We hebben je aanbetaling ontvangen op onze rekening. Indien die betaling is gedaan met een bankrekening is het volledige bedrag van {$cursus['inschrijfgeld']} ontvangen. NB. indien de betaling is gedaan met een creditcard, heeft de creditcard-maatschappij daarvan een commissie van ca. 3&nbsp;%  afgetrokken. Dit verrekenen wij met de volgende betaling.</p>\n";
		break;
	case 'transfer':
		$message .= "<p>Je inschrijving wordt direct verwerkt als we de betaling van de aanbetaling hebben ontvangen op onze bankrekening <strong>NL33 ASNB 0707 2500 72</strong> ten name van La Pellegrina, Utrecht. Voor bankoverschrijvingen van buiten de EU: BIC ASNB NL21. De aanbetaling bedraagt {$cursus['inschrijfgeld']} of de helft van het totaal verschuldigde cursusbedrag als dat lager is dan {$cursus['inschrijfgeld']} </p>\n";
		break;
	default:
		$message .= "<p>Om een of andere reden hebben we je aanbetaling (nog) niet ontvangen. Het kan zijn dat de betaling niet is gelukt of door jezelf is afgebroken. Er is dan geen geld van je rekening afgeschreven.<br>
			Het kan ook zijn dat de betaling nog niet verwerkt is. Daarom is het zinvol om deze pagina even te verversen (Ctrl-R) en te zien of de betaling dan wel wordt gemeld.<br>
			Je inschrijving wordt direct verwerkt als we de betaling van de aanbetaling van {$cursus['inschrijfgeld']} hebben ontvangen op onze bankrekening <strong>NL33 ASNB 0707 2500 72</strong> ten name van La Pellegrina, Utrecht. Voor bankoverschrijvingen van buiten de EU: BIC ASNB NL21. Tsjechische deelnemers kunnen hun aanbetaling in CZK overmaken op <strong>rekening 538940301/0100 van Komerční Banka</strong>.</p>\n";
		break;
}

$message .=
	<<<MESSAGE
	<p>Omdat bij het samenstellen van de groep wordt gekeken naar een evenwichtig geheel qua bezetting en niveau, kan definitieve bevestiging van deelname pas later, uiterlijk op {$cursus['datum_beslissing']}, gegeven worden. Indien je niet geplaatst zou kunnen worden, ontvang je uiteraard je aanbetaling terug. Het volledige cursusgeld moet uiteindelijk betaald zijn uiterlijk op {$cursus['datum_betaling']}.</p>
	<p>Als je je wilt <b>inschrijven voor meer dan één project </b>, vul dan voor elk project het formulier in. Als u uw persoonlijke inlogcode &quot;<strong>{$dlnmr['password']}</strong>&quot; invult onder &quot;zoek de gegevens van vorig jaar&quot; en op de knop klikt, wordt het formulier vooraf gevuld met uw persoonlijke gegevens. <b>Gebruik het formulier niet met je persoonlijke inlogcode voor iemand anders,</b> want dan wordt de informatie beschadigd.</p>
	<p>Muzikale groeten,</p>
	<p>Dirkjan Horringa<br>
	<em>La Pellegrina</em>
	</p>
MESSAGE;

$message .= '<p class="facebook">P.S. Wist je dat <em>La Pellegrina</em> ook actief is op Facebook? <a title="La Pellegrina op Facebook" href="https://www.facebook.com/pellegrina.net" target="_blank"><img src="https://www.pellegrina.net/Images/Logos/facebook_logo.png" alt="La Pellegrina op Facebook" width="25" height="25" class="geenlijn w3-image"></a> <a title="La Pellegrina op facebook" href="http://www.facebook.com/pellegrina.net" target="_blank">www.facebook.com/pellegrina.net</a>. We zijn erg blij als je op de \'Vind ik leuk\' knop klikt en het cursusnieuws deelt met je muzikale vrienden</p>';


$mail_text_file = ($_SERVER['DOCUMENT_ROOT'] . '/bevestiging/briefhoofd_NL.htm');
$mail_text = file_get_contents($mail_text_file);

$mail_text = str_replace("</html>", stripslashes($message) . "</body></html>", $mail_text);

d($to, $naam, $subject, $mail_text);

// bericht ter bevestiging:

if (!LPmail($to, $naam, $subject, $mail_text, 'aanmelding@pellegrina.net', 'LP Aanmelding')) echo "De email is niet verzonden!<br>";
?>
<!DOCTYPE HTML>
<html>
<!-- InstanceBegin template="/Templates/LP algemeen NL.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<!-- CSS: -->
	<link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>Hartelijk dank voor je inschrijving!</title>
	<!-- InstanceEndEditable -->
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.NL.php'; ?>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
	<link href="/css/pagina_stijlen_algemeen.css" rel="stylesheet"
		type="text/css">
	<!-- InstanceBeginEditable name="head" -->
	<!-- InstanceEndEditable -->
</head>

<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
	<div id="inhoud">
		<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.NL.php'; ?>
		<div id="main">
			<!-- InstanceBeginEditable name="mainpage" -->
			<?php echo $message; ?>
			<!-- InstanceEndEditable -->
			<h2> <a href="javascript: history.go(-1)">Terug</a></h2>
			<p>&nbsp;</p>
		</div>
	</div>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>
<!-- InstanceEnd -->

</html>