<?php
//	echo dirname(__FILE__);
$filenaam = explode('/', str_replace('/var', '', dirname(__FILE__)));
//Add filename without file extension
$filenaam[7] = basename(__FILE__, ".php");
//	print_r($filenaam);	
switch ($filenaam[6]) {
  case 'romantic':
    $cursus = 1;
    break;
  case 'baroque':
    $cursus = 2;
    break;
}
//	echo 'Cursus is: '.$cursus.'<br>';
$taal = $filenaam[5];
//	echo 'taal is: '.$taal.'<br>';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/cursusdata.php'; ?>

<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/LP_NL.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">

  <!-- CSS: -->
  <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">


  <!-- InstanceBeginEditable name="doctitle" -->
  <title>Reicha's Requiem</title>
  <!-- InstanceEndEditable -->
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.NL.php'; ?>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
  <!-- InstanceBeginEditable name="head" -->
  <!-- InstanceEndEditable -->
  <!-- Facebook Pixel Code -->
  <script>
    ! function(f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function() {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '537749209897328');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=537749209897328&ev=PageView&noscript=1" /></noscript>
  <!-- End Facebook Pixel Code -->
</head>

<body>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
  <div id="inhoud" class="w3-main">
    <?php
    echo $navigatie;
    echo '<span class="w3-opennav w3-xxlarge w3-hide-large" onclick="w3_open()">☰</span>';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.NL.php';
    ?>
    <div id="main"> <!-- InstanceBeginEditable name="mainpage" -->
      <div class="cols2">
        <h2>Programmadetails</h2>
        <p>Elke middag werken we aan een programma voor solisten, koor en orkest, dat als afsluiting van de cursus openbaar wordt uitgevoerd. Dit jaar staat tijdens dit slotconcert het Requiem van Reicha centraal. Het orkest opent het concert met de Symfonische Variaties van Dvořák. Het slotconcert gedirigeerd door Dirkjan Horringa vindt plaats in de kloosterkerk van het Dominicaanse klooster in České Budějovice. </p>
        <h3>Anton Reicha - <em>Missa pro defunctis</em> (Requiem)</h3>
        <ul>
          <li>Instrumentatie: solisten SATB, koor SATB, 2 fluiten, 2 hobo's, 2 klarinetten, 2 fagotten, 2 hoorns, 3 trompetten, 3 trombones, pauken, strijkers</li>
          <li>Duur: ca. 55 min.</li>
        </ul>
        <p><img src="../../Images/Anton_Reicha_01.png" alt="" width="300" class="fotorechts" />Anton Reicha (Praag, 26 februari 1770 - Parijs, 28 mei 1836) was een Europeaan. Hij werd in Praag in het doopregister in het Latijn ingeschreven als Antonius Josephus Reicha. In Tsjechië wordt hij Antonín Rejcha genoemd, maar zelf noemde hij zich Anton Reicha, en na zijn vestiging in Parijs Antoine-Joseph Reicha.</p>
        <h4>Levensloop</h4>
        <p> Als kind verloor hij zijn vader en vluchtte op 11-jarige leeftijd van huis, eerst naar zijn grootvader in Klattau (Klatovy) en daarna naar een kinderloze oom Josef Reicha, hofkapelmeester in Wallerstein in Württemberg, die hem vervolgens als kind adopteerde.</p>
        <p>Hij begon zijn carrière als musicus in 1785, toen hij samen met zijn oom toetrad tot het orkest van de Keulse keurvorst in Bonn. In 1790 stond hij hier te boek als violist. Daar leerde hij Ludwig van Beethoven kennen, die ook lid was van het orkest. In deze tijd ging Reicha studeren aan de universiteit van Bonn. In 1794 vertrok Reicha naar Hamburg, omdat het muziekensemble van de keurvorst was opgeheven vanwege de verwikkelingen rond de Franse Revolutie. In Hamburg hield Reicha het hoofd boven water door privélessen te geven. Zijn composities <em>L'Ermite </em>en <em>Obaldi </em>wekten echter geen publieke belangstelling. Eind 1799 vertrok hij naar Parijs, waar hij een dozijn fuga's schreef en opdroeg aan de directeurs van het Parijse Conservatorium. Zijn pogingen om een aanstelling te krijgen mislukten. Van 1802 tot 1808 woonde Reicha in Wenen, waar hij een gelegenheidscomponist werd voor bruiloften en vakanties. Hier kwam hij in contact met Joseph Haydn en studeerde hij bij Johann Albrechtsberger en Antonio Salieri, bij wie hij zijn compositietechniek aanscherpte. Hij kreeg enkele opdrachten voor composities, die privé werden uitgevoerd. In totaal zou Reicha meer dan 50 werken componeren tijdens zijn Weense periode, voornamelijk kamermuziek.</p>
        <p>Reicha vertrok in 1808 definitief naar Parijs en behaalde daar in 1810 enig succes met zijn opera <em>Cagliostro</em>. Toch waren het vooral zijn instrumentale werken, vooral zijn blaaskwintetten, die zijn naam definitief vestigden. Bovendien werd hij gewaardeerd als muziekpedagoog. In 1818 kreeg hij zijn gewenste positie aan de <em>École royale de Musique</em>, het Parijse Conservatorium. Reicha trouwde in 1819 met een Française en nam tien jaar later de Franse nationaliteit aan. In 1831 werd hij benoemd tot Ridder in het Franse Legioen van Eer en in 1835 volgde hij de directeur van het conservatorium op in zijn lidmaatschap van het Institut de France. Naast zijn composities zijn ook zijn werken over compositie en pianospel van belang. Tot zijn leerlingen behoorden de componisten Franz Liszt, Charles Gounod, César Franck, Hector Berlioz, George Onslow en de musicoloog Edmond de Coussemaker.</p>
        <h4><em>Missa pro defunctis</em> (Requiem)</h4>
        <p>De <em>Missa pro defunctis </em> van Reicha is een uniek werk. Qua tijd en stijl is het gelegen tussen de monumentale Requiemzettingen van Mozart en Berlioz. Het vestigt een nieuw genre, dat van het concertante Requiem. Het is namelijk meer bedoeld voor uitvoering in een concert dan als onderdeel van de liturgie, hoewel het wel de vaststaande liturgische tekst volgt.</p>
        <p>Mitchell Sandler schrijft over Reicha's Requiem: &quot;Als ik naar Reicha's Requiem luister, voel ik een onweerstaanbare drang om dit met ons eigen Pellegrina koor en orkest te horen en deze geweldige lijnen en harmonieën te gaan vormen. Er is zo'n prachtig palet aan emotionele kleuren - ik wil zien hoe extreem we deze contrasten kunnen maken. En ik wil zeker beginnen dit stuk in mijn eigen stem te voelen. Aan de ene kant is er een enorm gevoel van vreugde over het ontdekken van dit werk, een stuk waar ik wel van gehoord had maar nog nooit zelf had ervaren. Aan de andere kant is er een gevoel van verdriet over het feit dat dit machtige werk zo lang verborgen en ondergewaardeerd is gebleven. Een deel van mij luistert en kijkt door het stuk, beweging voor beweging, en vraagt zich af 'waarom? Waarom is dit werk genegeerd? Toen Dirkjan en ik voor het eerst samen naar een opname luisterden, was het alsof we een schat ontdekten. We merkten allebei meteen de kwaliteit van de muziek en hoe geweldig het zou zijn om deze muziek uit te voeren in České Budějovice. </p>
        <p>Reicha schreef zijn Requiem in Wenen in de jaren 1802-1806, toen hij contrapunt studeerde bij Joseph Haydn. De structuur van het stuk laat duidelijk zien dat hij Mozarts beroemde Requiem kende. Zonder de muziek te kopiëren, is er toch de afwisseling tussen de vrees van het 'einde der dagen' en de troost van het vertrouwen in God. Neem de 'enge' delen: Dies irae, Rex tremendae en Confutatis. Het is alsof Reicha de angst van de 'Dag van toorn' wil oproepen met dezelfde intensiteit als Mozart, maar dan met andere muziek. En hij brengt altijd troost na vrees. Zijn Offertorium, het Domine Jesu, is helemaal van hemzelf, maar er zijn duidelijke parallellen met Mozart. Zoals het toewijzen van het 'Sed signifer sanctus Michael' aan de solisten. En hij maakt ook een briljante fuga van 'Quam olim Abrahae'. Het klinkt voor mij alsof hij de grootsheid van Mozart erkent, en zich toch kan uitdrukken in zijn eigen muziek. Ik denk dat het belangrijk is om in gedachten te houden dat de vrees van de Requiemmis niet de angst voor de dood is, maar voor het laatste oordeel voor de almachtige rechter. Een groots Requiem in muziek houdt daarom de twee uitersten van vrees en troost in balans. Voor mij voldoet dit Requiem aan alle voorwaarden: hij weet muzikale effecten te creëren die ons emotioneel raken, in een muzikale taal die iets moderner is dan die van Mozart&quot;. </p>
      </div>
      <hr style="border-top: 1px solid black;">
      <h3>Antonín Dvořák - Symfonische variaties op. 78</h3>
      <div class="cols2">
        <ul>
          <li>Datum van compositie: 6 augustus 1877 - 28 september 1877 (revisie 1887 (?))</li>
          <li>Première: 2 december 1877, Praag door het Voorlopig Theaterorkest o.l.v. Ludevít Procházka</li>
          <li>Instrumentatie: 1 piccolo, 2 fluiten, 2 hobo's, 2 klarinetten, 2 fagotten, 4 hoorns, 2 trompetten, 3 trombones, pauken, triangel, strijkers</li>
          <li>Duur: ca. 22 min.</li>
        </ul>
        <h4>Compositie geschiedenis</h4>
        <p> De compositie van de Symfonische Variaties werd geïnitieerd door Ludevít Procházka, die een benefietconcert zou dirigeren om geld in te zamelen voor de bouw van een nieuwe kerk in de Praagse wijk Smíchov, en hij vroeg Dvořák om een nieuw werk voor de gelegenheid. De componist besloot een set variaties te schrijven voor het evenement. Het werk kreeg oorspronkelijk het opusnummer 38, maar Dvořák veranderde dit in 40 voor de eerste uitvoering. Toen Symfonische Variaties elf jaar later in druk verscheen, veranderde uitgever Simrock het opusnummer in 78 om de indruk te wekken dat dit een recenter werk was. </p>
        <h4>Algemene kenmerken</h4>
        <p> Voor het hoofdthema van zijn Symfonische Variaties gebruikte Dvořák de melodie van zijn eigen lied voor mannenkoor <em>Huslař</em> (de vedelaar), op een vers van Adolf Heyduk, uit de cyclus <em>Koorliederen voor mannenkoor</em>. Dit was geen willekeurige beslissing. Afgezien van de ongebruikelijke metrische structuur van 7+6+7 maten, is de melodie ook ongebruikelijk door het gebruik van de Lydische kwart, beide elementen die de luisteraar in staat stellen zich te oriënteren naarmate de muziek vordert. De presentatie van het thema zelf wordt gevolgd door 28 variaties die door een breed spectrum van verschillende stemmingen reizen en meerdere instrumentale transformaties ondergaan. Volgens het harmonische plan van het werk blijven de eerste 17 variaties in de basistoonsoort C-groot; de volgende negen gaan naar andere toonsoorten (nr. 18 in D-groot, nr. 19 in Bes-groot, nrs. 20-24 in Bes-klein, nr. 25 in Bes-groot, nr. 26 in D-groot); en de laatste twee variaties zijn terug in C-groot. Het werk eindigt spectaculair met een fuga die op het hoogtepunt plotseling overgaat in een Tsjechische polka. Het werk is een briljante weergave van muzikale ideeën en een mooi voorbeeld van het orkestraal meesterschap van de componist.</p>
        <h4>Première en latere uitvoeringen</h4>
        <p>Ondanks de lovende kritieken na de première op 2 december 1877 werden de Symfonische Variaties tien jaar lang op een zijspoor gezet. Ze werden pas weer uitgevoerd op 6 maart 1887, toen Dvořák zelf het Nationaal Theaterorkest dirigeerde. Het nieuwe succes van het werk moedigde Dvořák aan om de partituur op te sturen naar zijn grote bewonderaar, dirigent Hans Richter, met het voorstel om het op te nemen in het programma van zijn Engelse tournee. Richter accepteerde de Variaties en voerde ze uit in Londen voor een enthousiast publiek. Hij schreef het volgende aan Dvořák na het concert: &quot;Mijn lieve vriend! Ik ben zeer verheugd over het enorme succes van uw Symfonische Variaties. Als ik kijk naar alle honderden concerten die ik heb geleid, realiseer ik me dat ik nog nooit een nieuw werk heb gekend dat zo'n onmiskenbaar enthousiasme opwekte, van alle kanten. Iedereen wilde weten wanneer het werk was geschreven en waarom Dvořák zo lang had gewacht om het onder de aandacht van het publiek te brengen? Ik laat de delen hier, omdat ik het waarschijnlijk nog een keer ga uitvoeren. Ik zeg 'waarschijnlijk', hoewel het nu bijna zeker is. In ieder geval moet ik deze variaties volgende winter in Wenen presenteren&quot;.</p>
        <p>De Weense première vond plaats op 4 december 1887. Dvořák woonde het concert bij en was dus getuige van de enorme ovaties die volgden. Hij schreef in een brief aan zijn uitgever Simrock: &quot;Zoals Brahms zei - en hij kent het Weense publiek heel goed: geen van mijn werken heeft ooit zo'n impact gehad als de 'Variaties'. Het werk werd voortreffelijk uitgevoerd en de zaal reageerde met een daverend applaus. Als dank voor mijn variaties kreeg ik van Brahms een prachtige sigarettenhouder.</p>
      </div>
      <!-- InstanceEndEditable -->
      <h2><a href="javascript: history.go(-1)">Terug</a></h2>
    </div>
  </div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
<!-- InstanceEnd -->

</html>