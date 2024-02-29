<?php // stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);

error_reporting( E_ALL );

require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/includes/' );
require_once( $_SERVER[ "DOCUMENT_ROOT" ] . '/vendor/autoload.php' );

Kint::$enabled_mode = false;

d($_POST, $_GET);

/**
 * simple method to encrypt or decrypt a plain text string
 * initialization vector(IV) has to be the same<?php echo($dlnmr['geslacht']); ?> when encrypting and decrypting
 * 
 * @param string $action: can be 'encrypt' or 'decrypt'
 * @param string $string: string to encrypt or decrypt
 *
 * @return string
 */
function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'Mach a Šebestová';
    $secret_iv = 'Sudoměřice u Bechyně';
    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}

$id = encrypt_decrypt('decrypt', $_GET[ 'DlnmrId' ]);
$gdpr = 1;

if ( isset( $id )AND $id != ''){
	$query = "SELECT voornaam, tussenvoegsels, achternaam, naam, gdpr, eerste_inschrijving AS `eerste inschrijving`, password, geboortedatum, geslacht, taal, telefoon, mobiel, email, dieet, publiciteit, naam_aanbrenger AS `naam aanbrenger`, adres, postcode, plaats, land FROM dlnmr, adres WHERE AdresId = AdresId_FK AND DlnmrId = {$id}";
	d( $query );
	$dlnmr = select_query($query, 1); 
	$ja = array('1', 'ja', 'yes');
	if (array_search($dlnmr['gdpr'], $ja) !== NULL) $dlnmr['toestemming AVG'] = 'ja';
	else $dlnmr['toestemming AVG'] = 'nee';
	d($ja, $nee, $dlnmr);
	if (empty($dlnmr['gdpr']) OR $dlnmr['gdpr'] == '') $dlnmr['toestemming GDPR'] = 'onbekend';
	if (isset($_POST['bevestig']) AND $_POST['bevestig'] === 'ja') {
		$query = "UPDATE dlnmr SET gdpr = {$gdpr} WHERE DlnmrId = {$id}";
		d( $query );
		exec_query( $query );
		exec_query("INSERT INTO GDPR_log (timestamp, DlnmrId, Naam, GDPR) VALUES (NOW(), {$id}, '{$dlnmr['naam']}', 1)");
		redirect("dank_GDPR.php");
	}
	if (isset($_POST['bevestig']) AND $_POST['bevestig'] === 'wis') {
		$query = "DELETE FROM dlnmr WHERE DlnmrId = {$id}";
		d( $query );
		exec_query( $query );
		exec_query("INSERT INTO GDPR_log (timestamp, DlnmrId, Naam, GDPR) VALUES (NOW(), {$id}, '{$dlnmr['naam']}', 0)");
		$query = "SELECT voornaam, tussenvoegsels, achternaam, naam, gdpr, eerste_inschrijving, password, geboortedatum, geslacht, taal, telefoon, mobiel, email, dieet, publiciteit, naam_aanbrenger, adres, postcode, plaats, land FROM dlnmr, adres WHERE AdresId = AdresId_FK AND DlnmrId = {$id}";
		d( $query );
		$dlnmr = select_query($query, 1); 
		redirect("afscheid_GDPR.php");
	}
}
else exit('Deze deelnemer bestaat niet. Het programma wordt nu afgebroken.')
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/LP algemeen NL.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">

   <!-- CSS: -->
   <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">

<!-- InstanceBeginEditable name="doctitle" -->
	<title>Bevestig gegevens</title>
<!-- InstanceEndEditable -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.NL.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>
<link href="/css/pagina_stijlen_algemeen.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_tagmanager.php'; ?>
<div id="inhoud">
  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/header.NL.php'; ?>
  <div id="main"> <!-- InstanceBeginEditable name="mainpage" -->
<div class="w3-content">
   <p>Beste
      <?php echo($dlnmr['voornaam']); ?>, </p>
   <p>Voor de nieuwe privacywet AVG zijn openheid en transparantie essentieel bij het verkrijgen en opslaan van persoonlijke gegevens. We vatten onze belangrijkste afspraken rondom de bescherming van persoonsgegevens voor je samen: </p>
   <ul>
      <li>Wij zijn volledig transparant over welke gegevens we van je gebruiken. </li>
      <li>Wij delen je gegevens nooit met andere partijen. </li>
      <li>Je hebt het recht om je data in te zien en te zien hoe we je data gebruiken. </li>
      <li>Je hebt het recht op het volledig wissen van je persoonlijke gegevens. </li>
      <li>Je persoonlijke gegevens zijn bij <em>La Pellegrina</em> goed beschermd. </li>
      </ul>
	
   <p>Deze persoonlijke gegevens hebben we van je vastgelegd:</p>
<table class="w3-table w3-small w3-card-8 w3-border w3-bordered">
	<tbody>
		<tr>
			<td class="vraag">Naam:</td>
			<td><?php echo($dlnmr['naam']); ?></td>
			<td class="vraag">Geslacht:</td>
			<td><?php echo($dlnmr['geslacht']); ?></td>
			<td class="vraag">Taal:</td>
			<td><?php echo($dlnmr['taal']); ?></td>
		</tr>
		<tr>
			<td class="vraag">Geboortedatum:</td>
			<td><?php echo($dlnmr['geboortedatum']); ?></td>
			<td class="vraag">Eerste inschrijving:</td>
			<td><?php echo($dlnmr['eerste_inschrijving']); ?></td>
			<td class="vraag">Password voor gegevens:</td>
			<td><?php echo($dlnmr['password']); ?></td>
		</tr>
		<tr>
			<td class="vraag">Telefoon:</td>
			<td><?php echo($dlnmr['telefoon']); ?></td>
			<td class="vraag">Mobiel:</td>
			<td><?php echo($dlnmr['mobiel']); ?></td>
			<td class="vraag">E-mail:</td>
			<td><?php echo($dlnmr['email']); ?></td>
		</tr>
		<tr>
			<td class="vraag">Dieet</td>
			<td><?php echo($dlnmr['dieet']); ?></td>
			<td class="vraag">Publiciteit:</td>
			<td><?php echo($dlnmr['publiciteit']); ?></td>
			<td class="vraag">Naam aanbrenger:</td>
			<td><?php echo($dlnmr['naam_aanbrenger']); ?></td>
		</tr>
		<tr>
			<td class="vraag">Adres:</td>
			<td><?php echo($dlnmr['adres']); ?></td>
			<td class="vraag">Postcode en plaats:</td>
			<td><?php echo($dlnmr['postcode'] . ' ' . $dlnmr['plaats']); ?></td>
			<td class="vraag">Land:</td>
			<td><?php echo($dlnmr['land']); ?></td>
		</tr>
		<tr>
			<td colspan="3" class="vraag">Toestemming voor gegevensopslag volgens de AVG</td>
			<td colspan="3"><?php echo($dlnmr['toestemming AVG']); ?></td>
		</tr>
		</tbody>
	</table>
	<br>

<div <?php if (empty($dlnmr) OR $dlnmr['naam'] == '') echo('class="onzichtbaar"'); ?>>
   <form method="post">
      <button id="bevestig" name="bevestig" value="ja" type="submit" class="w3-btn w3-green w3-block" style="width: 100%;">Ja, ik ga akkoord met de opgeslagen gegevens en wil de <em>La Pellegrina</em> nieuwsbrief (ca. 2 x per jaar) blijven ontvangen</button>
      <button onClick="GP_popupConfirmMsg('Weet je zeker dat je je gegevens werkelijk wilt wissen?'); return document.MM_returnValue" id="bevestig" name="bevestig" value="wis" type="submit" class="w3-btn w3-red w3-block" style="width: 100%;">Nee, ik wil dat de opgeslagen gegevens gewist worden en wil de <em>La Pellegrina</em> nieuwsbrief niet meer ontvangen</button>
   </form>   
   <button id="bevestig" name="bevestig" value="ja" type="submit" class="w3-btn w3-blue w3-block" style="width: 100%;">Mocht je je gegevens willen wijzigen, stuur dan even een mailtje met je wens naar <a class="w3-text-white w3-large" href="mailto:info@pellegrina.net">info@pellegrina.net</a></button>
</div>
<p>Voor een volledig overzicht van hoe wij met je persoonsgegevens omgaan verwijzen we je graag naar de <a href="privacy.php" target="_blank">privacyverklaring</a> van <em>La Pellegrina</em>. Bedankt voor je vertrouwen! </p>
   <p>Met muzikale groet</p>
   <p>Dirkjan Horringa</p>
</div>
<!-- InstanceEndEditable -->
    <h2> <a href="javascript: history.go(-1)">Terug</a></h2>
    <p>&nbsp;</p>
  </div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
</body>
<!-- InstanceEnd --></html>