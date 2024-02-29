<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>

<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/LP_NL.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">

   <!-- CSS: -->
   <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">


<!-- InstanceBeginEditable name="doctitle" -->
<title>La Pellegrina muziekprojecten</title>
<!-- InstanceEndEditable -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.NL.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '537749209897328');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=537749209897328&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
</head>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_tagmanager.php'; ?>
<div id="inhoud" class="w3-main">
<?php 	
	echo $navigatie;
	echo '<span class="w3-opennav w3-xxlarge w3-hide-large" onclick="w3_open()">☰</span>';
	require_once $_SERVER['DOCUMENT_ROOT'].'/includes/header.NL.php';
	 ?>
  <div id="main"> <!-- InstanceBeginEditable name="mainpage" -->
   <h2 class="begin">Formulier ontvangen</h2>
    <p>Beste <?php echo $_GET['voornaam']; ?>,</p>
    <p>Het formulier is succesvol verstuurd. Je email-adres en eventuele overige
      gegevens zijn toegevoegd aan de mailinglist van <i>La Pellegrina</i>,
      zodat je in de toekomst informatie over zomercursussen en aanverwante
      projecten ontvangt per post of per email. Als je hebt aangegeven
      je gegevens uit het bestand van La Pellegrina te willen
      verwijderen, is dat inmiddels gebeurd. </p>
    <p>Nagenoeg alle informatie over de projecten
      van dit jaar vind je op deze website; je ontvangt hierover dus geen informatie.
      Indien je nog vragen hebt, kun je het beste telefonisch contact opnemen
      met <em>La Pellegrina</em>, telefonisch (0619 224 758) of per <a href="mailto:info@pellegrina.net">email</a>.</p>
    <p>Met muzikale groet, </p>
    <p>Dirkjan Horringa <em><br>
      La Pellegrina</em> </p>

    <p class="facebook">P.S. Wist je dat <em>La Pellegrina</em> nu ook op <strong>facebook</strong> actief is? <a title="La Pellegrina on Facebook" href="http://www.facebook.com/pellegrina.net" target="_blank"><img alt="La Pellegrina on Facebook" src="http://www.pellegrina.net/Images/Logos/facebook_logo.png" width="25" height="25"></a> <a title="La Pellegrina nu ook op facebook" href="http://www.facebook.com/pellegrina.net" target="_blank">www.facebook.com/pellegrina.net</a>. Wij vinden het erg fijn als je ons 'like't en het cursusnieuws deelt met je muzikale vrienden!</p>
  <!-- InstanceEndEditable -->
    <h2><a href="javascript: history.go(-1)">Terug</a></h2>
  </div>
</div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
<!-- InstanceEnd --></html>