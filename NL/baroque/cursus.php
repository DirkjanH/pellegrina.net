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
<title>Zomercursus "<?php echo $cursusdata['cursusnaam']; ?>"</title>
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
  <?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/cursustitel.php');?>
    <div class="container">
      <h2><a name="programma"></a>Het programma</h2>
      <p>Het voormalige klooster Nieuw Sion in de Sallandse bossen bij Deventer is de locatie voor de zevendaagse barokcursus van komende zomer. Deze cursus heeft twee aspecten: enerzijds een programma van kleine ensembles van zangers en bespelers van 'oude' instrumenten, zowel  vocaal en instrumentaal apart als gecombineerd. Daarnaast is er een gezamenlijk programma met cantates en instrumentale muziek van Vivaldi en tijdgenoten. Alle zangers en instrumentalisten nemen deel aan dit programma. </p>
      <p class="citaat">Jeroen van Bergeijk:	&quot;De ideale vakantiebesteding: hard werken in een klooster, ondergedompeld in muziek, met een fijne groep muziekminnaars&quot;</p>
      <h3>Kamermuziek</h3>
      <div class="fotorechts"><img src="/Images/Chamber Music-93.jpg" alt="" width="500" height="321"/><br>
	Kamermuziekensemble tijdens concert<br>
	foto: Cassandra Luckhardt</div>
      <p>Het belangrijkste onderdeel van de cursus is werken in kleine ensembles. Iedereen maakt deel uit van twee verschillende van tevoren ingedeelde ensembles, die beide in gelijke mate aan bod komen. De ensembles werken het grootste deel van de tijd onder intensieve begeleiding van de
      docenten. De ensembles presenteren zich aan het eind van de cursus aan de overige deelnemers;  in onderling overleg kan een aantal ensembles  deelnemen aan het afsluitende openbare concert. Dit jaar ligt de focus op Italiaanse muziek, maar voor de kamermuziek  is dit optioneel. Voel je vrij als je in het kleine ensemble programma liever  Engelse, Duitse of Franse muziek speelt of zingt.</p>
      <p class="citaat">Frederiek Muller: &quot;De formule van La Pellegrina werkt zó inspirerend!&quot;</p>
      <p>Alle formaties  vanaf kwartet zijn mogelijk. De ensembles worden tijdig ingedeeld,
      zodat je je thuis kunt voorbereiden. Daarom is snel aanmelden essentieel. Binnen de mogelijkheden van de cursus wordt met wensen voor stukken en bezettingen rekening gehouden. De cursus staat open  voor
      individuele deelnemers en vaste ensembles. Er is  in de avonden ook tijd voor gelegenheidscombinaties.</p>
      <p class="citaat">Lea Schuiling: &quot;Leuk natuurlijk, zo'n tuttistuk voor zangers en instrumentalisten. Maar wat   een aanwinst is ook het kamermuziekprogramma!   Zangers en instrumentalisten, enkel bezet, met coaching door alle   docenten ... Daar krijg je zelden de gelegenheid voor! En dat de docenten elkaar soms tegenspreken, .. tja, .. dat geeft ruimte&quot;</p>
      <h3>Programma <em>Vivaldi's Venetiaanse Vespers </em>voor alle zangers en instrumentalisten</h3>
		<p>Iedere middag werken alle zangers en instrumentalisten samen aan het programma 'Vivaldi's Venetiaanse Vespers ' voor iedereen, dat wordt uitgevoerd in het slotconcert van de cursus. Uiteraard zijn er eerst groepsrepetities voor het koor en het orkest, en correpetitie voor de solisten. Later in de week worden alle groepen bijeen gevoegd en ontstaat een kleurrijk en divers ensemble, waarin iedereen zijn eigen uitdagingen heeft. <a href="programma.php">Lees hier meer over de werken en hun muzikale en historische context</a>.</p>
 </div>
<p class="citaat">Andrew Fyson:	&#8220;Het bijwonen van La Pellegrina en het werken met prachtige en enthousiaste muzikanten is voor mij een levensveranderende ervaring geweest&#8221;</p>
      <p><em>La Pellegrina </em>levert de bladmuziek aan in de vorm van een link naar een PDF die de deelnemers zelf kunnen printen en meenemen.</p>
      <h3>Extra's: Barokdans en Tai Chi</h3>
			<div class="fotorechts"><img src="/Images/Feuillet-notation.jpg" alt="" width="400" height="597"/><br>
			  Feuillet-notation for a chaconne</div>
			<p>Barokmuziek is niet los te zien van de  barokdans zoals die aan het hof werd beoefend. Dankzij bronnen met dansnotatie uit die periode, zoals de geschriften van de  dansmeesters Feuillet en Lorin, kunnen we ons een goede voorstelling maken van hoe er gedanst werd. Dezelfde basistechniek werd zowel gebruikt bij sociale evenementen als in theatrale dans bij hofballetten en in openbare theaters. Kenmerkend is dat op wat musici de 'zware tellen' noemen dansers op de teen gaan, dus naar boven, wat de dans oneindig licht en gratieus maakt. Een muzikant die dat heeft ervaren speelt direct anders, lichter en met meer gratie. Onze docent voor de lage strijkers, Ricardo Rodríguez Miranda, is behalve gambist tevens danser en onderricht barokdans op het Koninklijk Conservatorium in Den Haag. Hij zal in de cursus een workshop geven en iedere ochtend een warming-up met elementen uit de barokdans verzorgen.</p>
			<p>Docent Mitchell Sandler is niet alleen zanger en all-round musicus, maar ook een gecertificeerde Tai-Chi-instructeur. Iedere ochtend vóór het ontbijt doet hij een Tai-Chi sessie met iedereen die maar wil aansluiten.</p>
			<p class="citaat">Franca Post: "Hele fijne sfeer, prachtige lokatie en heerlijk ontspannend."</p>
	<div class="container">
	  <h2><a name="voorwie"></a>Voor wie </h2>
			<div class="fotorechts"><img src="/Images/margarita.jpg" alt="rehearsal in the castle hall" width="400" height="533" class="w3-image" /><br>
				Sopraan in actie
				<br>
			</div>
			<h4>Zangers</h4>
			<p>Er is plaats voor maximaal 20 ervaren zangers. Om deel te kunnen nemen dien je te voldoen aan de volgende vereisten:</p>
			<ul>
				<li> Je zingt goed van blad en kunt zelfstandig je partij instuderen</li>
				<li> Je hebt ervaring in oude-muziekensembles in enkelvoudige bezetting</li>
				<li> Je hebt een ontwikkelde stem die zich leent voor solo- en ensemblezang</li>
				<li> Je bent ge&iuml;nteresseerd in de historische uitvoeringspraktijk</li>
			</ul>
			<h4>Instrumentalisten </h4>
			<p>Er is plaats voor maximaal 20 instrumentalisten, namelijk
			barokstrijkers, viola da gamba, blokfluit, traverso, barokhobo, barokfagot, clavecimbel/orgel, theorbe, uitsluitend 'oude' instrumenten, stemtoon 415 Hz.</p>
			<p>Om deel te kunnen nemen dien je te voldoen aan de volgende vereisten:</p>
			<ul>
				<li> Je speelt een 'oud' instrument. Strijkers: eventueel
					een modern instrument met darmsnaren en een barokstok. <i>La
				Pellegrina</i> kan bemiddelen bij het lenen van barokstokken. </li>
				<li> Je hebt ruime ervaring met het spelen in kleine bezettingen</li>
			</ul>
			<p class="citaat">Harry Kragt:	&quot;Ik smolt voor de muziek, niet door de extreme temperaturen. Dat smaakt naar meer&quot;</p>
		</div>
<div class="container">
   <div class="fotolinks"><img src="/Images/carina.jpg" class="w3-image" alt="Jonge violiste" width="400" height="609" /><br>
   	Muzikale concentratie
   	<br>
   </div>
   <h2><a name="dagindeling"></a>Week- en dagindeling</h2>
   <h4> Weekindeling</h4>
   <ul>
      <li>Zondagochtend 11 augustus: aankomst op Nieuw Sion, 10:30 cursusopening en eerste repetitie</li>
      <li>Vrijdag 16 augustus: afsluitende interne presentatie van de kamermuziekensembles; </li>
      <li>Zaterdagmiddag 17 augustus: openbaar concert 'Vivaldi's Venetiaanse Vespers ' in de kloosterkerk (hopelijk), aansluitend  borrel en vertrek</li>
   </ul>
   <p class="citaat">Annelies Jans: &ldquo;Twee repetities 's morgens,  twee repetities 's middags, en wat doen we op onze vrije avonden? Juist, zoveel mogelijk muziekmaken....!!!&rdquo;</p>
</div>
     <h4>Dagindeling</h4>
    <ul>
      <li>8:00 ontbijt</li>
      <li>9:30 1e sessie werken aan muziek in kleine ensembles</li>
      <li>10:45 koffiepauze</li>
      <li>11:15 2e sessie werken aan muziek in kleine ensembles</li>
      <li>13:00 lunch</li>
      <li>14:15 3e sessie werken aan muziek in kleine ensembles of groepsrepetities Vespers</li>
      <li>15:30 theepauze</li>
	   <li>16:00 gezamenlijke repetitie Vespewrs</li>
      <li>17:30 borrelen en avondeten</li>
      <li>'s Avonds: vrij te besteden;  gelegenheid voor extra kamermuziek</li>
    </ul>
    <p class="citaat">Staffan Rudner: &quot;De docenten waren in staat zich aan te  passen aan de mogelijkheden van ons allemaal. Na de cursus is er een nieuwe  energie om thuis te oefenen en  te spelen over ons heen gekomen.&quot;</p>
    <h2><a name="waar" id="metwie2"></a>Waar</h2>
	  <p> Klooster Nieuw Sion bestaat sinds 1890 en was tot 2015 een trappistenklooster. De laatste monniken trokken toen de deur achter zich dicht en vonden een nieuwe plek op Schiermonnikoog. Sindsdien vindt er een breed scala van spirituele, maar ook culturele en muzikale activiteiten plaats. Meer informatie vind je hier:</p>
    <ul>
		  <li><a href="https://indebuurt.nl/deventer/woning-van-de-week/binnenkijken-bij-klooster-nieuw-sion-de-monniken-zijn-verhuisd-maar-er-wonen-nog-wel-mensen~108570/" target="_blank">Een sfeer-impressie van het klooster</a>
	  </li>
			<li><a href="https://www.nieuwsion.nl/" target="_blank">Website van het klooster</a></li>
    </ul>
    <div class="container">
	  <h2><a name="metwie" id="metwie"></a>Met wie</h2>
         <div class="fotorechts"> <img src="/Images/Docenten/Bechyne-334.jpg" class="w3-image" width="400" height="261" alt="docenten bij het slotfeest"/><br>
         De docenten proosten op het geslaagde concert</div>
         <p> Deze cursus wordt geleid door gedreven specialisten op hun vakgebied: <a href="docenten.php#horringa">Dirkjan&nbsp;Horringa</a>, <a href="docenten.php#huizinga">Femke&nbsp;Huizinga</a>, <a href="docenten.php#lindeijer">Hanna&nbsp;Lindeijer</a>, <a href="docenten.php#rodriguez">Ricardo&nbsp;Rodríguez&nbsp;Miranda</a>, <a href="docenten.php#sandler">Mitchell&nbsp;Sandler</a> en <a href="docenten.php#valorz">Edoardo&nbsp;Valorz</a>.</p>
         <h2><a name="inschrijven"></a>Inschrijven</h2>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inschrijven.php');?>
          <p class="citaat">Frederiek Muller:	&quot;Zo heerlijk dat het al bij het eerste samenspel muziek is!&quot;  </p>
   </div>
  <!-- InstanceEndEditable -->
    <h2><a href="javascript: history.go(-1)">Terug</a></h2>
  </div>
</div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
<!-- InstanceEnd --></html>