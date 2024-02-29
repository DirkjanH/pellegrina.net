<?php 
//	echo dirname(__FILE__);
	$filenaam = explode('/', str_replace('/home/pellegrina', '', dirname(__FILE__)));
//	print_r($filenaam);	
   switch ($filenaam[6])  {
		case 'chamber':  $cursus = 1;
		break;
		case 'romantic': $cursus = 3;
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
   <link rel="stylesheet" href="/css/pagina_stijlen.css" type="text/css">

<!-- InstanceBeginEditable name="doctitle" -->
<title>2011 Video recordings on DVD</title>
<!-- InstanceEndEditable -->
<meta charset="UTF-8">
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.EN.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>
<!-- InstanceBeginEditable name="head" -->
<link href="css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
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
  <div id="inhoud" class="w3-main"> 
  <?php 
  echo $navigatie; 
  echo '<span class="w3-opennav w3-xxlarge w3-hide-large" onclick="w3_open()">☰</span>';
  require_once $_SERVER['DOCUMENT_ROOT'].'/includes/header.EN.php';
  ?>
  <div id="main"> 
  <!-- InstanceBeginEditable name="mainpage" -->
<h1>Video recordings  2011 </h1>
<p>All concerts of all courses have been recorded on video with good quality sound. From this excellent footage a box per course with two well-edited DVD's was made. You can order it from Dirkjan Horringa for EUR 18 per box (course 2 EUR 10). Please find the instructions for ordering underneath.</p>
<hr>
<h2>Course 1: Baroque in 415 Hz: Telemann's Don Quichotte (14 - 24 July)
</h2>
<ul>
  <li>Tutor´s concert Baroque part in the church and Chamber Music part in the hall (partly) &amp; Chamber music (DVD 1) </li>
  <li>Telemann's Don Quichotte &amp; Burlesque de Don Quichotte (DVD 2) </li>
</ul>
<hr>
<h2><span class="cursus">Course 2: Play chamber Music with the Martinů Quartet (16 - 24 July</span>) <span class="nadruk"><br>
  only EUR 10, because some recordings are not complete</span></h2>
<ul>
  <li>Tutor´s concert Baroque part in the church and Chamber Music part in the hall (partly)
  </li>
  <li>Chamber music concert in Bechyně (DVD 2) </li>
</ul>
<hr>
<h2>Course 3: Orchestra & Chamber Music from the Romantic Era (28 July - 7 August)</h2>
<ul>
  <li>Tutor´s concert in Český Krumlov &amp; Participants' Chamber music concert (DVD 1) </li>
  <li>Final orchestral concert (DVD 2) </li>
  </ul>
<hr>
  <h2> Course 4: <span class="cursus">Mozart's Zauberflöte (11 - 21 August</span>) </h2>
<ul>
  <li>Tutor´s concert in Český Krumlov &amp; Participants' Chamber music concert (DVD 1)</li>
  <li>First performance of Die Zauberflöte (DVD 2) </li>
</ul>
<hr>
<h2>How to order and pay:</h2>
Please transfer your payment  (see underneath) to bank account 70.75.02.462 in name of D.J. Horringa, Utrecht  (for international bank transfers: IBAN  	 NL96 SNSB 0707 5024 62  and BIC SNSBNL2A). Please mention with your transfer which DVD box (which course) you want. If transferring the money is too complicated or expensive you can also send the amount due in Euros in an envelope  to Dirkjan Horringa, Merwedeplantsoen 73, NL-3522 JZ Utrecht, the Netherlands.
<h2>Prices:</h2>
The DVD's are sold in a box with two DVD's per course. Each box costs EUR 18,- (course 2 EUR 10,-). If you want the box sent to your home, please add  postage:
<ul>
  <li>EUR 4,- within the Netherlands</li>
  <li>EUR 5,- within Europe</li>
  <li>EUR 8,- outside Europe  </li>
  </ul>
<h2>CD recordings</h2>
<p>If you ordered  a CD recording from Karel Dvořáček, please contact him about delivery directly  via email:&nbsp;<a href="mailto:karel.dvoracek@gmail.com">karel.dvoracek@gmail.com</a>.&nbsp;</p>
<!-- InstanceEndEditable -->
    <h2><a href="javascript: history.go(-1)">Back</a></h2>
  </div>
</div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
<!-- InstanceEnd --></html>
