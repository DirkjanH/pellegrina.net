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
<title>La Pellegrina Summer Schools</title>
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
    <h2 class="begin">Thank you for sending in this form</h2>
    <p>Dear <?php echo $_GET['voornaam']; ?>,</p>
<p>Your address will be added to the <i>La Pellegrina </i>mailing list,
      so that you will receive information about future summer
      schools and related projects by email. If you have indicated
      not to want to receive information from <i>La Pellegrina</i>,
      then your entry in our database has been deleted. </p>
    <p>Nearly all information about this year's summer schools is on this web
      site; you will therefore not receive additional information. If you
      have any questions, please feel free to contact <em>La Pellegrina</em> by
      phone (+31 619 224 758) or <a href="mailto:info@pellegrina.net">email</a>.</p>
    <p>Musical greetings,</p>
    <p>Dirkjan Horringa <em><br>
      La Pellegrina</em>
    </p>
    <p class="facebook">P.S. Did you know <em>La Pellegrina</em> is now active on Facebook too? <a title="La Pellegrina on Facebook" href="http://www.facebook.com/pellegrina.net" target="_blank"><img src="http://www.pellegrina.net/Images/Logos/facebook_logo.png" alt="La Pellegrina on Facebook" width="25" height="25" class="w3-image"></a> <a title="La Pellegrina on facebook" href="http://www.facebook.com/pellegrina.net" target="_blank">www.facebook.com/pellegrina.net</a>. We are very pleased when you click the 'Like' button and share the course news with your musical friends</p>
    <!-- InstanceEndEditable -->
    <h2><a href="javascript: history.go(-1)">Back</a></h2>
  </div>
</div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
<!-- InstanceEnd --></html>
