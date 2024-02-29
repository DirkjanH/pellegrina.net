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
<title>Vivaldi's Venetian Vespers</title>
<!-- InstanceEndEditable -->
<meta charset="UTF-8">
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.EN.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>
<!-- InstanceBeginEditable name="head" -->
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
  <div class="cols2">
    <h2>Programme details</h2>
    <p>During this summer school, we will transform the monastery of New Sion into a modern version of Vivaldi's Ospedale della Pietà. Each morning, all participants play and sing in two chamber music ensembles. Each afternoon, everyone participates in a number of central works for all.</p>
    <h3>Vivaldi's Venetian Vespers</h3>
    <p>In the afternoon part of the programme, we reconstruct a vesper service as it might have sounded in Vivaldi's Venice, composed of works by Vivaldi, Galuppi and Cavalli. Vespers or Evensong belong to the tides in the Catholic Church and were originally celebrated around 5pm. In terms of music, the vespers consist of an opening verse 'Deus in adiutorium', five psalms, a hymn, a verse, a Magnificat with antiphon and closing formulas, including a Benedicamus Domino. Our hypothetical reconstruction focuses on Vivaldi's Magnificat RV 610. In addition, we select five of his vesper psalms, according to the available singers and instrumentalists. In addition to his Domine ad ad adiuvandum RV 593, one can think, for instance, of the Dixit Dominus in D RV 807, the Confitebor tibi RV 596, the Beatus vir RV 598, Laudate pueri RV 601 and In exitu Israel RV 604. So, there's plenty to choose from.</p>
    <h3>Ospedale della Pietà </h3>
    <p><span class="fotolinks"><img src="../../Images/chiesa_della_pieta_venice.jpg" alt="Ospedale della Pietà " width="350"/></span>The <strong>Ospedale della Pietà </strong>(&quot;Hospice of Charity&quot;) was a convent, orphanage and music school in one in Venice. Like other Venetian ospedali, the Pietà was founded as a shelter for the needy. A group of Venetian nuns, the <em>Consorelle di Santa Maria dell'Umiltà </em>(&quot;Sisters of Saint Mary of Simplicity&quot;), established the Pietà in 1346 it as a charitable institution for orphans and abandoned mothers with children. Initially, infants were delivered to the institution via the <em>scaffetta</em> (&quot;plank&quot;), a rather small niche in the wall. Larger children were soon pushed through there, in case of emergency, sometimes even with some force. It is not known today where this niche was located. Around 1800, this plank was replaced by the <em>ruota</em> ('wheel'), a wooden cylinder, hollow inside and rotating around a vertical axis. Because it was larger, it allowed the transfer of larger children than newborns.</p>
    <p><span class="fotorechts"><img src="../../Images/puttepie.jpg" alt="" width="350"/></span>In the seventeenth century, all four remaining ospedali gained increasing interest with the performance of sacred music by their choirs and orchestras, known as <em>figli di coro </em>(children of the choir). By the seventeenth and eighteenth centuries, the ospedali were well known for their all-female music societies, which attracted tourists and patrons from all over Europe. The rules for training the <em>figlie</em> (daughters) were conscientiously and meticulously drawn up and periodically revised. Many concerts were given to select audiences. This audience was separated from the performers by a metal grid, allowing one to perceive the latter only as shadows. Indeed, girls were forbidden to make music. Remarkably, this disadvantage (probably partly caused by the Catholic Church's views on the roles of men and women) could actually be turned into a plus by a Catholic female congregation. As the institution became increasingly valued, it sometimes received (not always legitimised) children of the nobility. In later years of the Venetian republic, which collapsed in 1797, it also accepted adolescent musicians. These were called <em>figli di spese </em>(boarders), whose stay was paid for by foreign courts and dignitaries.</p>
    <p>Composer <a href="https://en.wikipedia.org/wiki/Antonio_Vivaldi" target="_blank">Antonio Vivaldi </a>was appointed violin teacher in 1703 and served in various positions until 1715 and later again from 1723 to 1740. He wrote much of his sacred and vocal music to be performed at the Pietà. Its conservatory remained active until 1830. Other ospedali stopped earlier in the 19th century.</p>
    <p><a href="https://en.wikipedia.org/wiki/Jean-Jacques_Rousseau" target="_blank">Jean-Jacques Rousseau</a> visited the institute in 1770. His report contains his impressions of that time. After describing how the performers took their places behind grilles, he writes in his Confessions, &quot;I have not the idea of anything so sensuous and moving as this music; the richness of art, the refined taste of the vocal part, the exquisite voices, the precision of execution, everything in these enchantingly beautiful concerts is right to give an impression that certainly does not correspond to present-day conceptions of taste, but for which, in my opinion, no heart is closed.&quot;</p>
  </div>
  <!-- InstanceEndEditable -->
    <h2><a href="javascript: history.go(-1)">Back</a></h2>
  </div>
</div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
<!-- InstanceEnd --></html>