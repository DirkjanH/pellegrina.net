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
<html><!-- InstanceBegin template="/Templates/LP_NL.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">

   <!-- CSS: -->
   <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">


<!-- InstanceBeginEditable name="doctitle" -->
<title>Vivaldi's Venetiaanse Vespers</title>
<!-- InstanceEndEditable -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.NL.php'; ?>
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
	require_once $_SERVER['DOCUMENT_ROOT'].'/includes/header.NL.php';
	 ?>
  <div id="main"> <!-- InstanceBeginEditable name="mainpage" -->
    <div class="cols2">
      <h2>Programmadetails</h2>
      <p>Tijdens deze zomerschool toveren we het klooster van Nieuw Sion om tot een moderne versie van Vivaldi's <em>Ospedale della Pietà</em>. Elke ochtend spelen en zingen alle deelnemers in twee kamermuziekensembles. Elke middag neemt iedereen deel aan een aantal centrale werken voor iedereen. </p>
      <h3>Vivaldi's Venetiaanse Vespers</h3>
      <p>In dit deel van het programma reconstrueren we een  vesper zoals die geklonken zou kunnen hebben in Vivaldi's Venetië, samengesteld uit werken van Vivaldi, Galuppi en Cavalli. De vespers of het avondgebed behoren tot de getijden in de katholieke kerk en werden oorspronkelijk gevierd rond 5 uur 's middags. De  vespers bestonden qua muziek uit een openingsvers 'Deus in adiutorium', vijf psalmen, een hymne, een vers, een Magnificat met antifoon en slotformules, o.a. het Benedicamus Domino. In onze hypothetische reconstructie staat Vivaldi's Magnificat RV 610 centraal. Daarnaast selecteren we vijf van zijn vesperpsalmen, al naar gelang de beschikbare zangers en instrumentalisten. Naast zijn Domine ad adiuvandum         	RV 593 valt bijvoorbeeld te denken aan het Dixit Dominus in D RV 807, het Confitebor tibi RV 596, het Beatus vir	RV 598, Laudate pueri	RV 601 en In exitu Israel	RV 604. Keus genoeg, dus.</p>
      <h3><strong>Ospedale della Pietà </strong></h3>
      <div class="fotolinks"><img src="../../Images/chiesa_della_pieta_venice.jpg" alt="Ospedale della Pietà " width="350"/></div>
      <p>Het <strong>Ospedale della Pietà</strong> ("Gasthuis van Liefdadigheid") was een klooster, weeshuis en muziekschool ineen in Venetië. Net als andere Venetiaanse <em>ospedali</em> werd de Pietà gesticht als opvanghuis voor behoeftigen. Een groep Venetiaanse nonnen, de <em>Consorelle di Santa Maria dell'Umiltà</em> ("Zusters van de heilige Maria van de Eenvoud"), vestigden de Pietà in 1346 het als liefdadig instituut voor weeskinderen en verlaten moeders met kinderen.<a href="https://nl.wikipedia.org/wiki/Ospedale_della_Piet%C3%A0#cite_note-1"> </a>Aanvankelijk werden zuigelingen via de <em>scaffetta</em> ('plank'), een vrij kleine nis in de muur, aan de instelling afgegeven. Grotere kinderen werden daar al gauw, in geval van nood, soms zelfs met enig geweld doorheen geduwd. Het is vandaag de dag niet meer bekend waar deze nis zich bevond. Rond 1800 werd deze plank vervangen door de <em>ruota</em> ('wiel'), een houten cilinder, hol van binnen en roterend om een verticale as. Omdat deze groter was, maakte het de overdracht van grotere kinderen dan pasgeborenen mogelijk. </p>
		<div class="fotorechts"><img src="../../Images/puttepie.jpg" alt="" width="350"/></div>
        <p>In de zeventiende eeuw kregen alle vier overgebleven <em>ospedali</em> toenemende belangstelling met de uitvoering van gewijde muziek door hun koren en orkesten, bekend als <em>figli di coro</em> (kinderen van het koor). Tegen de zeventiende en achttiende eeuw waren de <em>ospedali</em> zeer bekend om hun volledig vrouwelijke muziekgezelschappen die toeristen en begunstigers uit heel Europa aantrokken. De regels voor de opleiding van de <em>figlie</em> (dochters) werden gewetensvol en nauwkeurig opgesteld en periodiek herzien. Veel concerten werden gegeven voor een select publiek. Dit publiek werd door een metalen rooster van de uitvoerders gescheiden, waardoor men de laatsten slechts als een soort schaduwen kon waarnemen. Het was meisjes namelijk verboden muziek te maken. Opvallend was dat dit nadeel (waarschijnlijk mede veroorzaakt door de opvattingen van de katholieke kerk over de rol van mannen en vrouwen) door een katholieke vrouwelijke congregatie juist in een pre kon worden omgebogen. Toen het instituut steeds meer gewaardeerd werd, ontving het soms ook (niet altijd gelegitimeerd) kinderen van de adel. In latere jaren van de Venetiaanse republiek, die in 1797 instortte, accepteerde het ook adolescente musici. Deze werden <em>figli di spese</em> (kostgangers) genoemd, wier verblijf door buitenlandse hoven en hoogwaardigheidsbekleders werd voldaan.</p>
      <p>Componist <a href="https://nl.wikipedia.org/wiki/Antonio_Vivaldi" title="Antonio Vivaldi">Antonio Vivaldi</a> werd in 1703 tot vioolleraar benoemd en diende in diverse functies tot 1715 en later weer van 1723 tot 1740. Veel van zijn gewijde en vocale muziek schreef hij om in de Pietà te worden uitgevoerd. Het conservatorium ervan bleef actief tot 1830. Andere ospedali stopten al eerder in de 19e eeuw.</p>
      <p><a href="https://nl.wikipedia.org/wiki/Jean-Jacques_Rousseau" title="Jean-Jacques Rousseau">Jean-Jacques Rousseau</a> bezocht het instituut in 1770. Zijn verslag bevat zijn impressies van dat moment. Na beschreven te hebben hoe de uitvoerders achter roosters plaatshadden, schrijft hij in zijn <em>Belijdenissen</em>: "Ik heb niet het idee van iets zo zinnelijks en aangrijpends als deze muziek; de rijkdom van kunst, de verfijnde smaak van het vocale deel, de uitmuntende stemmen, de nauwkeurigheid van uitvoering, alles in deze betoverend mooie concerten klopt om een indruk te geven die zeker niet overeenkomt met de huidige smaakopvattingen, maar waarvoor naar mijn mening geen hart gesloten is."</p>
    </div>
  <!-- InstanceEndEditable -->
    <h2><a href="javascript: history.go(-1)">Terug</a></h2>
  </div>
</div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
<!-- InstanceEnd --></html>