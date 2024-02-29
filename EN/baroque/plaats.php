<?php 
//	echo dirname(__FILE__);
	$filenaam = explode('/', str_replace('/var', '', dirname(__FILE__)));
//Add filename without file extension
	$filenaam[7] = basename(__FILE__,".php");	
//	print_r($filenaam);	
   switch ($filenaam[6])  {
		case 'romantic': $cursus = 1;
		break;
		case 'baroque':  $cursus = 2;
		break;
	}
//	echo 'Cursus is: '.$cursus.'<br>';
	$taal = $filenaam[5];
//	echo 'taal is: '.$taal.'<br>';
	
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/cursusdata.php'; ?>

<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/LP_EN.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">

   <!-- CSS: -->
   <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">

<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $cursusdata['plaats_kort'] ?>, place of action</title>
<!-- InstanceEndEditable -->
<meta charset="UTF-8">
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.EN.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
	  <?php //require_once $_SERVER['DOCUMENT_ROOT'].'/NL/budejovice.php'; ?>
	  <div class="fotocenter"><img src="/Images/Locaties/Nieuw Sion/Nieuw Sion.jpg" class="w3-image" alt="Klooster Nieuw Sion"/></div>
	  <p>Monastery Nieuw Sion has existed since 1890 and was a Trappist monastery until 2015. The last monks then closed the door behind them and found a new place on the island of Schiermonnikoog. Since then, a wide range of spiritual, as well as cultural and musical activities have taken place. More information can be found here:</p>
    <ul>
		  <li><a href="https://indebuurt.nl/deventer/woning-van-de-week/binnenkijken-bij-klooster-nieuw-sion-de-monniken-zijn-verhuisd-maar-er-wonen-nog-wel-mensen~108570/" target="_blank">An impression of the monastery atmosphere</a></li>
			<li><a href="https://www.nieuwsion.nl/" target="_blank">Monastery website (in Dutch)</a>
			</li>
	  </ul>
    <div class="fotocenter"> <img src="/Images/NS/refter.jpg" class="w3-image" alt="The monastery church, where the final concert possibly takes place"/><br>
  		The refectory, where rehearsals and concerts take place</div>
	  <div class="fotocenter"> <img src="/Images/NS/Hobo band.jpg" class="w3-image" alt="The refectory, where rehearsals and the chamber music concert takes place"/><br>
  		Oboe band at work</div>
	  <div class="fotocenter"> <img src="/Images/NS/dejeuner_dans_l'herbe.jpg" class="w3-image" alt="Dinner is taken outside, weather permitting"/>  		Dinner is usually taken outside</div>
		<div class="fotocenter"><img src="/Images/Locaties/Nieuw Sion/luchtfoto.jpg" class="w3-image" alt="Aerial view of the monastery Nieuw Sion"/>Aerial view of the monastery Nieuw Sion</div>
	<!-- InstanceEndEditable -->
    <h2><a href="javascript: history.go(-1)">Back</a></h2>
  </div>
</div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
<!-- InstanceEnd --></html>