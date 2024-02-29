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
	if (array_search($dlnmr['gdpr'], $ja) !== NULL) $dlnmr['toestemming GDPR'] = 'yes';
	else $dlnmr['toestemming GDPR'] = 'no';
	d($ja, $nee, $dlnmr);
	if (empty($dlnmr['gdpr']) OR $dlnmr['gdpr'] == '') $dlnmr['toestemming GDPR'] = 'unknown';
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
else exit('This participant does not exist. The program is now being terminated.')
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/LP algemeen EN.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">

   <!-- CSS: -->
   <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">

<!-- InstanceBeginEditable name="doctitle" -->
	<title>Confirm data and permission</title>
<!-- InstanceEndEditable -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.EN.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>
<link href="/css/pagina_stijlen_algemeen.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_tagmanager.php'; ?>
<div id="inhoud">
  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/header.EN.php'; ?>
  <div id="main"> <!-- InstanceBeginEditable name="mainpage" -->
<div class="w3-content">
   <p>Dear
      <?php echo($dlnmr['voornaam']); ?>, </p>
   <p>For the new European privacy law GDPR, openness and transparency are essential in obtaining and storing personal data. We summarize our most important agreements regarding the protection of personal data for you:</p>
   <ul>
      <li>We are completely transparent about what information we use from you.</li>
      <li>We never share your information with other parties.</li>
      <li>You have the right to view your data and see how we use your data.</li>
      <li>You have the right to completely delete your personal data.</li>
      <li>Your personal information is well protected at <em>La Pellegrina</em>.</li>
   </ul>
   <p>We have recorded these personal data about you:</p>
<table class="w3-table w3-small w3-card-8 w3-border w3-bordered">
   <tbody>
		<tr>
			<td class="vraag">Name:</td>
			<td><?php echo($dlnmr['naam']); ?></td>
			<td class="vraag">Sex:</td>
			<td><?php echo($dlnmr['geslacht']); ?></td>
			<td class="vraag">Language:</td>
			<td><?php echo($dlnmr['taal']); ?></td>
		</tr>
		<tr>
			<td class="vraag">Date of birth:</td>
			<td><?php echo($dlnmr['geboortedatum']); ?></td>
			<td class="vraag">First registration:</td>
			<td><?php echo($dlnmr['eerste_inschrijving']); ?></td>
			<td class="vraag">Password for data:</td>
			<td><?php echo($dlnmr['password']); ?></td>
		</tr>
		<tr>
			<td class="vraag">Telephone:</td>
			<td><?php echo($dlnmr['telefoon']); ?></td>
			<td class="vraag">Mobile/Cell:</td>
			<td><?php echo($dlnmr['mobiel']); ?></td>
			<td class="vraag">E-mail:</td>
			<td><?php echo($dlnmr['email']); ?></td>
		</tr>
		<tr>
			<td class="vraag">Diet</td>
			<td><?php echo($dlnmr['dieet']); ?></td>
			<td class="vraag">Publicity:</td>
			<td><?php echo($dlnmr['publiciteit']); ?></td>
			<td class="vraag">Name of recommender:</td>
			<td><?php echo($dlnmr['naam_aanbrenger']); ?></td>
		</tr>
		<tr>
			<td class="vraag">Address:</td>
			<td><?php echo($dlnmr['adres']); ?></td>
			<td class="vraag">Postcode and town/city:</td>
			<td><?php echo($dlnmr['postcode'] . ' ' . $dlnmr['plaats']); ?></td>
			<td class="vraag">Country:</td>
			<td><?php echo($dlnmr['land']); ?></td>
		</tr>
		<tr>
			<td colspan="3" class="vraag">Permission for data storage according to the GDPR</td>
			<td colspan="3"><?php echo($dlnmr['toestemming GDPR']); ?></td>
		</tr>
		</tbody>
	</table>
	<br>

<div <?php if (empty($dlnmr) OR $dlnmr['naam'] == '') echo('class="onzichtbaar"'); ?>>
   <form method="post">
      <button id="bevestig" name="bevestig" value="ja" type="submit" class="w3-btn w3-green w3-block" style="width: 100%;">Yes, I agree with the stored data and want to continue receiving the <em>La Pellegrina</em> newsletter (about 2 x per year)</button>
      <button onClick="GP_popupConfirmMsg('Are you sure you want to delete your details?'); return document.MM_returnValue" id="bevestig" name="bevestig" value="wis" type="submit" class="w3-btn w3-red w3-block" style="width: 100%;">No, I want the stored data to be deleted and to stop receiving the <em>La Pellegrina</em> newsletter</button>
   </form>   
   <button id="bevestig" name="bevestig" value="ja" type="submit" class="w3-btn w3-blue w3-block" style="width: 100%;">If you want to change your details, please send an e-mail with your wish to <a class="w3-text-white w3-large" href="mailto:info@pellegrina.net">info@pellegrina.net</a></button>
</div>
<p>For a complete overview of how we deal with your personal data, we refer you to the <a href="privacy.php" target="_blank">privacy statement</a> of <em>La Pellegrina</em>. Thank you for your confidence! </p>
   <p>Musical greetings,</p>
   <p>Dirkjan Horringa</p>
</div>
<!-- InstanceEndEditable -->
    <h2> <a href="javascript: history.go(-1)">Back</a></h2>
    <p>&nbsp;</p>
  </div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
</body>
<!-- InstanceEnd --></html>