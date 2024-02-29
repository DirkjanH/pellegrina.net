<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>

<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/LP_EN.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">

   <!-- CSS: -->
   <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">

<!-- InstanceBeginEditable name="doctitle" -->
<title>La Pellegrina muziekprojecten</title>
<!-- InstanceEndEditable -->
<meta charset="UTF-8">
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.EN.php'; ?>
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
  require_once $_SERVER['DOCUMENT_ROOT'].'/includes/header.EN.php';
  ?>
  <div id="main"> 
  <!-- InstanceBeginEditable name="mainpage" -->
   <h2 class="begin">Choice received</h2>
    <p>Dear participant,</p>
    <p>We have received your choice to be removed from the <em>La Pellegrina</em> mailing list. Your data has now been completely removed.</p>
    <p>With musical greetings,</p>
    <p>Dirkjan Horringa <em><br>
      La Pellegrina</em></p>
  <!-- InstanceEndEditable -->
    <h2><a href="javascript: history.go(-1)">Back</a></h2>
  </div>
</div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
<!-- InstanceEnd --></html>