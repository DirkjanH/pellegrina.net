<?php 
	// echo dirname(__FILE__).'<br>';
	$filenaam = explode('/', str_replace('/var', '', dirname(__FILE__)));
//Add filename without file extension
	$filenaam[7] = basename(__FILE__,".php");	
	// print_r($filenaam);	
   switch ($filenaam[6])  {
		case 'romantic': $cursus = 1;
		break;
		case 'baroque':  $cursus = 2;
		break;
	}
	// echo 'Cursus is: '.$cursus.'<br>';
	$taal = $filenaam[5];
	// echo 'taal is: '.$taal.'<br>';

require_once $_SERVER['DOCUMENT_ROOT'].'/includes/cursusdata.php'; ?>

<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/LP_EN.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">

   <!-- CSS: -->
   <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">

<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $cursusdata['cursusnaam_en']; ?></title>
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
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/cursustitel.php');?>
<ul>
	<li>For: singers (soloists and very experienced choral singers), instrumentalists (baroque strings, viola da gamba, recorder/traverso, baroque oboe, baroque bassoon,  harpsichord/organ, theorbo; period instruments only, tuning pitch 415 Hz)</li>
	<li>With  Dirkjan Horringa (singers and artistic direction), Femke Huizinga (orchestra, violin), Hanna Lindeijer (baroque winds), Ricardo Rodríguez Miranda (viola da gamba, cello, double bass, baroque dance), Mitchell Sandler (singers). and Edoardo Valorz (basso continuo)<br>
	</li>
	<li>Central works for all: a Venetian Vesper for the Virgin, composed of works by Vivaldi (including his Magnificat), Galuppi and Cavalli</li>
	<li>Baroque chamber music every morning for instrumental, vocal or combined vocal-instrumental ensembles</li>
    <li>In monastery Nieuw Sion, Diepenveen near Deventer (Netherlands), with accommodation in single and double rooms</li>
    <li>With baroque dance workshop for all</li>
</ul>
<p class="onzichtbaar plaatsvoor"> Place available for:  one more baroque oboe</p>

<p class="onzichtbaar">Full for: all instruments and singers </p>
	
<p><a href="cursus.php" class="onzichtbaar">Read more about this course</a></p>
    <!-- InstanceEndEditable -->
    <h2><a href="javascript: history.go(-1)">Back</a></h2>
  </div>
</div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
<!-- InstanceEnd --></html>
