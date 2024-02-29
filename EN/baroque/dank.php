<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>

<!DOCTYPE HTML>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/css/w3.css">
<link href="../../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
<head>
<title>La Pellegrina Summer Schools in the Czech Republic</title>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.EN.php'; ?>
</head>
<body>
<div id="inhoud">
  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/header.EN.php';
//  echo $navigatie; ?>
  <div id="main" class="w3-container">
    <h2 class="begin">Form successfully sent </h2>
    <p>
      Dear <?php echo stripslashes($_GET['voornaam']); ?>,</p>
    <p> Thank you for sending in this form. You will receive a
      preliminary confirmation of you registration for the <em>La Pellegrina</em> project <strong><?php echo stripslashes($_GET['cursus']) ?></strong> on the email address <strong><?php echo $_GET['email'] 
							?></strong><span class="onzichtbaar">. As soon as we have received your
      deposit we wil also inform you by email. </span>You will receive a provisional confirmation of registration. The time required to form well-balanced ensembles, however,
      implies that final confirmation cannot be given until <strong><?php echo $_GET['beslisdatum']; ?></strong> at the latest. Deposits will of course be refunded to applicants who cannot
      be placed. The entire fee must be paid by <?php echo $_GET['betaaldatum']; ?>. </p>
    <p>In case you want to <b>register for more than one project </b> please fill out the form for each project. If you fill out your personal login code &quot;<strong><?php echo $_GET['inlogcode']; ?></strong>&quot; under &quot;find last year's data" and click the button, the form will be pre-filled with your personal information.</p>
    <p>Musical greetings,</p>
    <p>Dirkjan Horringa <em><br>
      La Pellegrina</em>
    </p>
    <p class="facebook">P.S. Did you know <em>La Pellegrina</em> is now active on Facebook too? <a title="La Pellegrina on Facebook" href="http://www.facebook.com/pellegrina.net" target="_blank"><img src="http://www.pellegrina.net/Images/Logos/facebook_logo.png" alt="La Pellegrina on Facebook" width="25" height="25" class="geenlijn w3-image"></a> <a title="La Pellegrina on facebook" href="http://www.facebook.com/pellegrina.net" target="_blank">www.facebook.com/pellegrina.net</a>. We are very pleased when you click the 'Like' button and share the course news with your musical friends</p>
    <h2><a href="javascript: history.go(-1)">Back</a></h2>
  </div>
</div>
<!-- Google Code for Conversie EN Conversion Page --> 
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1064387110;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "rn3lCO7IzwkQpoTF-wM";
var google_conversion_value = 0;
var google_remarketing_only = false;
/* ]]> */
</script> 
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;"> <img src="//www.googleadservices.com/pagead/conversion/1064387110/?value=0&amp;label=rn3lCO7IzwkQpoTF-wM&amp;guid=ON&amp;script=0" alt="" width="1" height="1" class="w3-image" style="border-style:none;"/> </div>
</noscript>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
</html>