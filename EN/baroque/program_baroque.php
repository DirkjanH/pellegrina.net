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
<title>Buxtehude & his potential son-in-law Bach</title>
<!-- InstanceEndEditable -->
<meta charset="UTF-8">
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.EN.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>
<!-- InstanceBeginEditable name="head" -->
<link href="/css/w3.css" rel="stylesheet" type="text/css">
<link href="/css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
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
  	<h2>Buxtehude &amp; his potential son-in-law Bach</h2>
  	<p><strong>It is autumn 1705 in northern Germany. A young composer departs from the city of Arnstadt to go for a   journey on foot to Lübeck, almost 400 km to the north, to hear some music from a 68-year-old organist approaching the end of his career. But this is not just any organist, and the steadfast walker is not just any young composer.<br>
  		</strong></p>
  	<div class="fotolinks"> <img src="../../Images/buxtehude.jpg" width="270" height="340" alt=""/><br>
  		Painting of Dietrich Buxtehude by Johannes Voorhout </div>
  	<p>Dietrich Buxtehude is perhaps not the most famous name in baroque music nowadays, but in the late 17<sup>th</sup> and early 18<sup>th</sup> century it was known throughout Germany. As an organist in the Marienkirche in Lübeck, he held one of the most coveted musical positions in the country. Moreover, because of the culturally liberal atmosphere of Lübeck - at the time a free imperial city with a certain degree of autonomy - Buxtehude was granted a number of liberties that court composers did not have. He traveled, taught and had time to develop his skills as a keyboard virtuoso, in addition to his official duties as a city organist. With this artistic freedom, his reputation grew and Handel and Telemann traveled to Lübeck with the express purpose of visiting Buxtehude. His compositional output is dominated by choral works and organ music. He also composed a smaller number of chamber music works.</p>
  	<p>At the beginning of the 18<sup>th</sup> century, Johann Sebastian Bach was a young composer and musician with an enormous hunger to learn from the masters and to improve his craft. At the age of 15 he already travelled - probably on foot - from Ohrdruf to Lüneburg to study at the St. Michael school. At Lüneburg, with its lively musical scene, the young Bach was spoiled for choice. He could regularly hear the music of virtuosos, such as his organ teacher Georg Böhm. However, when he took up his first professional position as a church organist in Arnstadt in 1703, Bach got into an impasse: he was the most talented musician in the city. From whom could he still learn?</p>
  	<p>In October 1705, he asked his superiors for a month's leave to hear the music of Dietrich Buxtehude (&quot;to understand a few things about his art,&quot; as Bach put it). The older composer would give a series of Sunday concerts throughout the Advent season, under the title 'Abendmusiken'. That must have been a delightful prospect. Large ensembles were needed to play Buxtehude's music, with several organs, different choirs, percussion, trumpets and other brass instruments and a 25-member string section. It was a chance not to be missed. Later that month, Bach left his duties in the hands of his assistant and left on the long journey to Lübeck.<br>
  	</p>
  	<div class="fotorechts"> <img src="../../Images/arnstadt-to-lubeck.png" width="510" height="340" alt=""/><br>
  		The route from Arnstadt to Lübeck, similar to the one that Bach may have walked</div>
  	<p>Historians believe that Bach probably took the Old Salt Route, a worn trade route through northern Germany that has been in use since the Middle Ages. It was then much more common for people to make long journeys on foot than now, but the dedication of the 20-year-old composer is striking. Not much is known about what exactly happened when Bach arrived in Lübeck, but it is certain that it was well worth the trip. He met Buxtehude and possibly played the organ or violin in the <em>Abendmusik</em> concerts. Some historians speculate that Buxtehude may even have offered his daughter's hand to Bach, a deal that was a prerequisite for taking over his position as a Lübeck organist (Händel was offered the same deal but had refused). We also know that Bach made several handwritten copies of the music of Buxtehude and brought them all back to Arnstadt. It was certainly a fruitful journey for Bach, so fruitful in fact, that he forgot to come back in time. It was well into February by the time he got back to his post in Arnstadt, which meant that he had extended his leave by almost four months. The subsequent disciplinary meeting with the ecclesiastical authorities was only one factor that contributed to Bach's departure to fill a new position in Mühlhausen the following year.</p>
  	<p>Buxtehude died only a year after Bach's visit. It is partly thanks to Bach that his music was saved and distributed. It is now certain that Buxtehude occupies a unique place in the history of music: living in the time of Heinrich Schütz - the precursor of Protestant baroque music - but also in the time of Bach, the most popular exponent.  </p>
  <!-- InstanceEndEditable -->
    <h2><a href="javascript: history.go(-1)">Back</a></h2>
  </div>
</div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
<!-- InstanceEnd --></html>