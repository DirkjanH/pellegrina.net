<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>

<!DOCTYPE HTML>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/css/w3.css">
<head>
<title>La Pellegrina: formulier succesvol verstuurd!</title>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.NL.php'; ?>
</head>
<body>
<div id="inhoud">
  <?php 	
	require_once $_SERVER['DOCUMENT_ROOT'].'/includes/header.NL.php';
//  	echo $navigatie; ?>
  <div id="main" class="w3-container">
    <h2 class="begin">Formulier succesvol verstuurd!<br>
    </h2>
    <p>Beste <?php echo stripslashes($_GET['voornaam']); ?>,</p>
    <p>Dank voor het versturen van dit formulier. Je ontvangt een voorlopige bevestiging
      van je inschrijving voor het project <b><?php echo stripslashes($_GET['cursus']) ?></b> op het emailadres <strong><?php echo $_GET['email'] ?></strong>. 
      Zodra wij je inschrijfgeld hebben ontvangen laten we je dat - eveneens per email - weten. </p>
    <p>Omdat bij het samenstellen van de groep
      wordt gekeken naar een evenwichtig geheel qua bezetting en niveau, kan
      definitieve bevestiging van deelname pas later, namelijk <strong>uiterlijk op <?php echo $_GET['beslisdatum']; ?></strong>, verstrekt worden. Indien je niet geplaatst zou kunnen worden, ontvang je uiteraard je aanbetaling terug. Het volledige cursusgeld moet uiterlijk op <?php echo $_GET['betaaldatum']; ?> betaald zijn. </p>
    <p>Wil je je voor <b>meer dan één</b> project  opgeven, vul dan het formulier voor ieder project apart in. Als je je persoonlijke inlogcode "<strong><?php echo $_GET['inlogcode']; ?></strong>" invult onder "zoek oude gegevens" en de knop aanklikt, worden je persoonlijke gegevens weer ingevuld.</p>
    <p>Met muzikale groet, </p>
    <p>Dirkjan Horringa <em><br>
      La Pellegrina</em> </p>
      
    <p class="facebook">P.S. Wist je dat <em>La Pellegrina</em> ook op <strong>facebook</strong> actief is? <a title="La Pellegrina on Facebook" href="http://www.facebook.com/pellegrina.net" target="_blank"><img alt="La Pellegrina on Facebook" src="http://www.pellegrina.net/Images/Logos/facebook_logo.png" width="25" height="25" class="geenlijn w3-image"></a> <a title="La Pellegrina ook op facebook" href="http://www.facebook.com/pellegrina.net" target="_blank">www.facebook.com/pellegrina.net</a>. Wij vinden het erg fijn als je ons 'like't en het cursusnieuws deelt met je muzikale vrienden!</p>
    <h2><a href="javascript: history.go(-1)">Terug</a></h2>
  </div>
</div>
<!-- Google Code for Aanmelding NL Conversion Page --> 
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1064387110;
var google_conversion_language = "nl";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "VmJ7CJahigIQpoTF-wM";
var google_conversion_value = 0;
var google_remarketing_only = false;
/* ]]> */
</script> 
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;"> <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1064387110/?value=0&amp;label=VmJ7CJahigIQpoTF-wM&amp;guid=ON&amp;script=0"/> </div>
</noscript>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
</html>