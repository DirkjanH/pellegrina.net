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
<html>
<!-- InstanceBegin template="/Templates/LP_NL.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <!-- CSS: -->
  <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
  <!-- InstanceBeginEditable name="doctitle" -->
  <title><?php echo $cursusdata['cursusnaam_nl']; ?></title>
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
        n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(
          arguments)
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
  <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=537749209897328&ev=PageView&noscript=1" /></noscript>
  <!-- End Facebook Pixel Code -->
</head>

<body>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
  <div id="inhoud" class="w3-main"> <?php
                                    echo $navigatie;
                                    echo '<span class="w3-opennav w3-xxlarge w3-hide-large" onclick="w3_open()">☰</span>';
                                    require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.NL.php';
                                    ?> <div id="main">
      <!-- InstanceBeginEditable name="mainpage" -->
      <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/cursustitel.php'); ?>
      <h2><a name="programma"></a>De muziek</h2>
      <p>Al 35 jaar organiseert La Pellegrina een jaarlijkse zomercursus
        voor instrumentalisten en (koor)zangers. Deze cursus heeft twee
        aspecten: kamermuziek c.q. kamerkoor, en een gezamenlijk
        programma voor solisten, orkest en koor. De cursus vindt plaats
        in het conservatorium van České Budějovice. České Budějovice,
        ook bekend onder de Duitse naam Budweis, is een gemoedelijke
        stad waar de nabijheid van Oostenrijk voelbaar is. Het
        conservatorium is niet lang geleden grondig verbouwd. De zaal
        heeft airconditioning , de entree is ruim en licht en de
        werkruimtes zijn opgeknapt. Er zijn uitstekende vleugels en
        prima voorzieningen om te musiceren. Zo kan iedereen die graag
        aan een conservatorium had gestudeerd toch nog gaan! Er is in
        hetzelfde gebouw accommodatie in het schoolinternaat, met
        simpele maar schone één- en tweepersoons kamers die ieder een
        eigen douche en toilet hebben. Daarnaast is er een keur van
        hotels in diverse prijsklassen in de omgeving. </p>
      <h3>De kamermuziek c.q. het kamerkoor</h3>
      <div class="fotorechts"><img src="/Images/fluittrio.jpg"
          alt="kamermuziek" width="500" height="334"
          class="w3-image" /><br />
      </div>
      <p>Iedere ochtend werkt men in kamermuziek- c.q. kamerkoorbezetting.
        Iedereen maakt deel uit van twee verschillende van tevoren
        ingedeelde ensembles, die per dag worden afgewisseld. De
        ensembles werken minimaal de helft van de tijd onder intensieve
        begeleiding van de docenten. De ensembles krijgen de kans om
        zichzelf te presenteren in een intern concert.</p>
      <p class="citaat" dir="ltr">Rob Klotz: Als ik dan een verslaving
        moet hebben, is naar La Pellegrina gaan mijn favoriete drug</p>
      <p>Instrumentalisten houden zich bezig met kamermuziek in
        bezettingen voor strijkers en/of blazers, al dan niet met piano.
        Alle bezettingen vanaf kwartet zijn mogelijk, met eventueel een
        paar trio's ertussen. De ensemble-indeling wordt tijdig bekend
        gemaakt, zodat je je thuis kunt voorbereiden. Zeer gevorderde
        zangers (<a href="#solozang">zie toelichting bij
          solozangers</a>) kunnen daarin eventueel ook participeren.
        Uniek is de mogelijkheid grotere en ingewikkelder combinaties,
        o.a. met blazers, te formeren, die 'thuis' niet gemakkelijk te
        organiseren zijn. Denk aan het Octet van Schubert, het Nonet van
        Spohr en het Allegro voor vier strijkkwartetten van Van Bree.
      </p>
      <p class="citaat">Yo van Dijk: &quot;Waar ik met enige
        koudwatervrees in sprong, bleek een aangenaam warm bad van
        enthousiaste musici. Je bent even in een andere wereld, een
        mooiere wereld zonder zorgen&quot;</p>
      <p>Elke ochtend vormen de koorzangers een kamerkoor en werken aan
        muziek voor kamerkoor, a cappella en met piano. Sommige zangers
        kunnen ook combinaties vormen met instrumenten. Een sopraan kan
        bijvoorbeeld met fluit en clavecimbel Haydns <i>Deutsche Arien
        </i> studeren, of de liederen van Spohr of Schubert met klarinet
        en piano. Een bariton zou <em>Dover Beach</em> van Barber kunnen
        instuderen met een strijkkwartet. Nog een paar suggesties:
        Pergolesi's <em>Stabat Mater</em> met strijkers, Mozart en Haydn
        liederen voor meer stemmen met piano, Telemanns <em>Harmonischer
          Gottesdienst</em>, Schuberts <em>Hochzeitsbraten</em> of
        andere Schubert voor meerdere stemmen met piano, enz., enz.</p>
      <p>De cursus staat open zowel voor individuele deelnemers als voor
        vaste ensembles. </p>
      <p>Er is in de cursus ook tijd voor gelegenheidscombinaties van
        kamermuziek. Een speciale avond wordt het <em>Mozart Concerto
          Event</em>, waar de pianisten en andere instrumentalisten
        worden uitgenodigd om een deel van een concert van Mozart of een
        tijdgenoot voor te bereiden en de andere instrumentalisten
        worden gevraagd om dat - van blad spelend - te begeleiden.</p>
      <p class="citaat">Henriëtte Hamer: La Pellegrina nodigt je uit om
        dingen doen waarvan je niet vermoedde dat je het kon of
        misschien zelfs durfde</p>
      <div class="container">
        <h3>Het programma voor solisten, koor en orkest: Dvořák & Haydn
        </h3>
        <div class="fotolinks"><img
            src="\Images\Locaties\Budejovice\black-tower-st-nicholas-cathedral-ceske-budejovice.jpg"
            alt="Kathedraal met de zwarte toren" width="400"
            class="w3-image"><br> kathedraal van České Budějovice
          met zwarte toren</div>
        <p>Elke middag werken we aan een programma voor koor en orkest,
          dat als afsluiting van de cursus openbaar wordt uitgevoerd.
          Dit jaar klinkt in dit slotconcert een programma met twee
          werken, namelijk de <em>Missa in tempore belli</em> van
          Joseph Haydn voor solisten, koor en orkest. Daarnaast werkt
          het orkest aan het symfonisch gedicht <em>Het Gouden
            Spinnewiel</em> van Dvořák. <a href="programma.php">Lees
            hier meer over de werken en hun muzikale en historische
            context</a>. Het slotconcert vindt plaats in de
          schitterende en magnifiek klinkende kathedraal van České
          Budějovice. Het programma wordt 'ingezeept' in een
          voorbereidende repetitie op zaterdag 14 juni in Den Dolder
          bij Utrecht.</p>
      </div>
      <p class="citaat">Anke Wolffes: &quot;De orkestrepetities verliepen
        erg prettig. Het lukt Dirkjan ieder jaar weer om ambitieus en
        motiverend, en toch ontspannen met ons te werken&quot;</p>
      <h2><a name="voorwie"></a>Voor wie</h2>
      <h4>Koor</h4>
      <div class="fotolinks"><img src="/Images/Mitchell en koor.jpg"
          alt="" width="500" height="334" /><br> Mitchell Sandler and
        his chamber choir</div>
      <p>De cursus staat open voor 32 ervaren koorzangers (SATB). Het koor
        heeft een grote en uitdagende partij in de <em></em>Missa in
        tempore belli</em>. Daarnaast vormen de koorleden elke ochtend
        een kamerkoor koor en werken ze aan muziek van Mendelssohn,
        Dvořák, Mozart en hun Tsjechische tijdgenoten. Mitchell Sandler
        zal dit koor leiden op zijn onnavolgbare manier, waarbij hij
        behulpzame vocale instructies en uitstekende pianobegeleiding
        combineert met duidelijke leiding. Tsjechische professionele
        zangers, met name tenoren en bassen, zullen zich bij het koor
        voegen koor als de balans tussen de verschillende stemgroepen
        daar om vraagt. </p>
      <p class="citaat">Marrie Kardol: &quot;Pellegrina is een van mijn
        leukste en gezondste verslavingen geworden!&quot;</p>
      <div class="container" style="clear: both;">
        <h4><a name="solozang"></a>Solozangers</h4>
        <div class="fotorechts"><img class="w3-image"
            src="/Images/zangcoaching.jpg"
            alt="singer being coached" width="400"
            height="300" /><br /> Zangcoaching in vol bedrijf</div>
        <p>Ben je een zangstudent of recent afgestudeerd, of een
          getalenteerde amateur op een gelijkwaardig niveau, en vind
          je het prettig om als solist te zingen? Heb je de
          onafhankelijkheid en het handigheid om een partij in te
          studeren en wil je graag zingen met een instrumentaal
          ensemble? In dat geval is het mogelijk dat je in de
          ochtendsessies deel uitmaakt van een van de
          kamermuziekensembles.</p>
        <p>We horen je graag. Dit geeft ons een idee van hoe je je in de
          cursus kunt plaatsen - om te weten welk stuk in de
          kamermuziek voor jou geschikt zou kunnen zijn. Maak een
          opname van je zang en stuur deze naar <em>La Pellegrina
          </em>als CD, MP3 of YouTube-clip.</p>
        <p class="citaat">Yolande Krooshof: &quot;ik heb drie mensen
          overgehaald mee te gaan, best griezelig, maar ze hebben alle
          drie genoten!</p>
      </div>
      <div class="container">
        <div class="fotolinks"> <img class="w3-image"
            src="/Images/tevreden_instrumentalist.jpg" width="400"
            height="332" alt="Chris"><br> Een tevreden hoornist
        </div>
        <h4>Instrumentalisten </h4>
        <p>Je hebt ruime kamermuziekervaring. Je bent bereid om
          kamermuziek- en orkestpartijen thuis voor te bereiden. Als
          pianist moet je een solistische partij aankunnen. De
          instrumentale bezetting van de cursus wordt bepaald door de
          orkestwerken: in principe is er plaats voor dubbel hout,
          twee hoorns, pauken en strijkers 8-8-6-6-3 (of een paar
          meer). In de kamermuziek is er plaats voor vier pianisten.
          Zij spelen in de kamermuziek-ensembles begeleiden zangers in
          hun aria's en kunnen zelfs pauken of ander slagwerk spelen
          in het orkest, of in het koor zingen. Voor de overige
          instrumenten in het orkest, zoals harp, trompetten,
          trombones en tuba, huren we Tsjechische professionals in.
        </p>
        <p class="citaat">Christine Achten: &quot;Een weekje alles
          loslaten en je onderdompelen in een bad van mooie muziek,
          hard werken, plezier maken, schoonheid ervaren , fijne
          sociale contacten, prachtige natuur... dat noem ik
          vakantie!&quot;</p>
      </div>
      <h2><a name="kennismaking"></a>Kennismakingsrepetitie</h2>
      <p> Op <strong>zaterdag 14 juni </strong>wordt overdag een
        voorbereidende repetitie gehouden in Den Dolder bij Utrecht,
        onder leiding van Mitchell Sandler en Dirkjan Horringa. Deze
        repetitie heeft als doel kennis te maken met de overige
        deelnemers en koor en orkest vast zo 'in te zepen', dat de
        deelnemers hun partijen daarna efficiënter en met meer plezier
        kunnen voorbereiden. Ook is het inspirerend om de overige
        deelnemers en met name je 'kamermuziekcollega's' vast te
        ontmoeten en te bespreken welk werk je gaat spelen of zingen.
      </p>
      <p class="citaat">Marieke van Dantzig: &quot;Een wonderlijke
        combinatie van mensen, stijlen en muzikale kwaliteiten in korte
        tijd tot een prachtig geheel smeden: dat is de kracht van
        inspirator Dirkjan&quot;</p>
      <h2><a name="dagindeling"></a>Week- en dagindeling</h2>
      <h4>Weekindeling</h4>
      <ul>
        <li>Donderdagavond 24 juli rond 18:00 opening cursus met het
          avondeten; 's avonds eerste<em> </em>repetitie van koor en
          orkest</li>
        <li>Vrijdagavond 25 juli kamermuziekconcert door de docenten
        </li>
        <li>Dinsdag 29 juli vrije dag</li>
        <li>Woensdagavond 30 juli <em>Mozart Concerto Event</em>:
          deelnemers spelen solo in delen uit Mozart concerten, a vue
          begeleid door het orkest</li>
        <li>Vrijdagmiddag en -avond 1 augustus kamermuziekconcerten voor
          en door deelnemers </li>
        <li>Zaterdagmiddag 2 augustus om 15:30 openbare uitvoering in de
          kathedraal van het programma met Dvořák en Haydn door
          solisten, koor en orkest </li>
        <li>Zondagochtend 3 augustus vertrek na het ontbijt</li>
      </ul>
      <div class="fotocenter"> <img
          src="/Images/Mozart Concerto Event 1.jpg" width="400"
          height="267" alt="" />&nbsp;&nbsp;&nbsp;<img
          src="/Images/Mozart Concerto Event 2.jpg" width="400"
          height="267" alt="" /><br> Mozart Concerto Event: orkest
        begeleidt van blad | tevreden solist</div>
      <p class="citaat">François Lanave: &quot;Ik was de enige Franstalige
        persoon bij het ontbijt te midden van muzikanten die een vreemde
        taal met raspende 'ch' klanken spraken. Maar zij schakelden
        meteen over naar Engels, zodat we konden communiceren&quot;</p>
      <div class="fotocenter"><img class="w3-image"
          src="/Images/pauze.jpg" alt="pauze" width="640" height="427"
          border="1" /><br /> Pauze in de kloosterhof</div>
      <h4>Dagindeling</h4>
      <ul>
        <li> 8:00 ontbijt</li>
        <li> 9:30-12:30 instrumentalisten en zangers werken in kleine
          ensembles aan kamermuziek en kamerkoor</li>
        <li> 13:00 lunch</li>
        <li> 14:30 het orkest werkt eerst in groepsrepetities, later in
          de cursus in de complete bezetting; het koor werkt in het
          begin apart aan Haydns <em>Missa in tempore belli</em>.
          Later in de week repeteren koor en orkest samen </li>
        <li> 17:30 borrelen en avondeten</li>
        <li> 's Avonds: vrij; ruime gelegenheid voor extra kamermuziek,
          en vergeet niet dat Tsjechië beroemd is om haar bier...</li>
      </ul>
      <p class="citaat">Robert Beverly: &quot;Pellegrina is een
        stimulerende en opwindende muzikale ervaring voor serieuze
        amateurmusici die bereid zijn hard te werken aan het doel van
        een gepolijste publieke uitvoering&quot;</p>
      <div class="fotocenter"><img
          src="/Images/2018-02-10-LPPO-Schöpfung-Utrecht.jpg"
          width="800" height="302" alt="" /><br> Haydns Schöpfung
        tijdens een herhalingsconcert in Utrecht in 2018 <br>
      </div>
      <h2><a name="waar" id="metwie2"></a>Waar</h2>
      <p>Meer over České Budějovice, de plek waar de cursus wordt
        gehouden, lees je hier:</p>
      <ul>
        <li><a href="plaats.php">České Budějovice, de stad</a></li>
        <li><a href="route_plek.php">Reismogelijkheden en route naar
            České Budějovice</a></li>
      </ul>
      <p class="citaat">Casper van Dongen: &quot;La Pellegrina is al bijna
        20 jaar 'mijn jaarlijkse therapie'... Waar musiceer je zo
        afwisselend en drink je zo lekker bier in zo'n mooie
        omgeving?&quot;</p>
      <div class="fotocenter"><img class="w3-image"
          src="/Images/bazooka.jpg" width="640" height="424"
          alt="Ensemble"><br> Vreugde na het kamermuziekconcert </div>
      <h2>Met wie</h2>
      <p><a name="metwie"></a>Deze cursus wordt geleid door een aantal
        gedreven vakmusici: <a href="docenten.php#bernaskova">Martina
          Bernášková</a>, <a href="docenten.php#Pbernasek">Petr
          Bernášek</a>, <a href="docenten.php#horejsi">Pavel
          Hořější</a>, <a href="docenten.php#horringa">Dirkjan
          Horringa</a>, <a href="docenten.php#novacek">Libor
          Nováček</a>, <a href="docenten.php#sandler">Mitchell
          Sandler</a>, <a href="docenten.php#sternadel">Rudolf
          Sternadel</a> en <a href="docenten.php#vlasankova">Jitka
          Vlašánková</a>.</p>
      <div class="fotocenter"><img src="/Images/maal_bij_Elektra.png"
          alt="maal bij Penzion Elektra" class="w3-image" width="400"
          height="300" /><br /> Na hard werken smaakt een dergelijk
        maal prima </div>
      <h2><a name="inschrijven"></a>Inschrijven</h2>
      <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/inschrijven.php'); ?>
      <!-- InstanceEndEditable -->
      <h2><a href="javascript: history.go(-1)">Terug</a></h2>
    </div>
  </div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
<!-- InstanceEnd -->

</html>