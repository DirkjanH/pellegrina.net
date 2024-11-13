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
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
    <title>Purcell & Handel</title>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.NL.php'; ?>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
    <link href="/css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
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
            <div class="cols2">
                <h2>Programmadetails</h2>
                <p>Dit jaar staat muziek op het programma met een relatie tot de
                    beschermvrouwe van de muziek, Sinte Cecilia: twee
                    Ceciliaanse odes van Purcell en twee werken van&nbsp;
                    Handel. Dit is veel muziek, te veel om in één concert uit te
                    voeren. Er zal een selectie van ongeveer een uur uit deze
                    werken worden gemaakt op basis van het aantal en de
                    capaciteiten van de zangers, zodat iedereen een substantiële
                    solo kan hebben. Het resulterende programma wordt uitgevoerd
                    als hoogtepunt en afsluiting van de cursus, dit jaar weer in
                    de kerk van klooster Nieuw Sion.</p>
                <h4>Sinte Cecilia</h4>
                <div class="fotocenter"><img src="/Images/cecilia.jpg"
                        alt="Sante Cecilia"><br>Sinte Cecilia - schilderij van
                    Guercino</div>
                <p>Sinte Cecilia staat bekend als beschermheilige van de muziek
                    in de christelijke traditie. De band van Sinte Cecilia met
                    muziek komt niet voort uit haar historische daden, maar uit
                    symbolische interpretaties van haar legende. Volgens de
                    <i>Passio Sanctae Caeciliae</i>, een gefictionaliseerd
                    verslag uit de 5e eeuw, draaide haar leven om standvastige
                    toewijding en martelaarschap. Het verhaal concentreert zich
                    op haar geloof, de wonderbaarlijke overleving in een heet
                    gestookt bad en haar uiteindelijke onthoofding - nauwelijks
                    een muzikaal verhaal. </p>
                <p>Dus blijft de vraag: wat heeft Cecilia met muziek te maken?
                    Het zit zo: in haar passio staat het volgende over haar
                    trouwdag: <i>Cantantibus organis illa in corde suo soli
                        Domino decantabat</i>: terwijl de instrumenten (van het
                    bruiloftsfeest) speelden, zong ze in haar hart alleen voor
                    de Heer. In de Middeleeuwen werd de Latijnse tekst als
                    antifoon iets ingekort en bovendien verkeerd vertaald:
                    Terwijl ze orgel speelde, zong ze voor de Heer. En zo werd
                    ze ook afgebeeld: Cecilia met haar orgel. Later kon het ook
                    een viool, een cello of een theorbe zijn. Deze afbeeldingen
                    speelden een belangrijke rol in het veranderen van haar in
                    de beschermvrouwe van de muziek.</p>
                <h4>Engels verzet en heropleving</h4>
                <p>Gedurende een groot deel van de geschiedenis van Engeland
                    bleef de verering van Cecilia sluimeren, onderdrukt door de
                    protestantse tegenzin om heiligen te eren. Aan het einde van
                    de 17e eeuw ontstond er echter een plotselinge golf van
                    interesse, gedreven door een nieuw cultureel fenomeen: de
                    Ceciliaanse ode.</p>
                <p>In 1683 startten componist Henry Purcell en dichter
                    Christopher Fishburn een traditie om Cecilia te vieren met
                    muzikale odes op haar feestdag. Hun werken prezen haar als
                    muze van de muziek en vermengden seculiere en sacrale
                    elementen. Deze beweging viel samen met de opkomst van
                    openbare concerten en de institutionalisering van
                    muziekverenigingen, zoals de Musical Society of London.</p>
                <p>De <i>Cecilian ode </i>werd een jaarlijkse traditie die
                    enkele van de grootste dichters en componisten uit die tijd
                    aantrok. John Drydens *A Song for St Cecilia's Day* (1687)
                    en *Alexander's Feast* (1697) behoren tot de beroemdste
                    bijdragen, met grootse muzikale zettingen door Purcell en
                    later door George Frideric&nbsp; Handel. Deze werken
                    verhieven Cecilia's feestdag tot een viering van de
                    goddelijke kracht van muziek en transformeerden het in een
                    duidelijk Engelse traditie.</p>
                <p>
                <div class="fotolinks"><img src="\Images\purcell.jpg"
                        alt="Henry Purcell" width="250"><br>Henry Purcell</div>
                Purcell droeg twee Odes bij aan St. Cecilia: Welcome to all the
                pleasures (Z.339) werd geschreven op tekst van Christopher
                Fishburn in 1683. De tweede, Hail! Bright Cecilia (Z.328), ook
                bekend als The Ode to St. Cecilia, werd gecomponeerd in 1692 op
                een tekst van de Ier Nicholas Brady. </p>
                <h4>Purcell - Welcome to all the pleasures</h4>
                <p>De eerste ode, Welcome to all the pleasures, is geschreven
                    voor vocale solisten, koor en een ensemble van vierstemmige
                    strijkers en basso continuo. De instrumenten begeleiden niet
                    alleen de zangers, maar spelen ook een rol in een ouverture
                    (de zogenaamde “symfony”) en ritornelli. De uitvoering van
                    het stuk duurt ongeveer 18 minuten.</p>
                <h5>Delen</h5>
                <ol>
                    <li>Symphony</li>
                    <li>Verse (alt, tenor, bas), koor &amp; ritornello:
                        &quot;Welcome to all the Pleasures&quot;</li>
                    <li>Song (alt) &amp; ritornello: &quot;Here the deities
                        approve&quot; (een van de bekendste delen)</li>
                    <li> Verse (twee sopranen en tenor) &amp; ritornello:
                        &quot;While joys celestial their bright souls
                        invade&quot;</li>
                    <li>Song (bas) &amp; koor: &quot;Then lift up your
                        voices&quot; </li>
                    <li>Verse (bas) &amp; koor: &quot;Then lift up your
                        voices&quot; </li>
                    <li>Instrumentaal tussenspel</li>
                    <li>Song (tenor) &amp; ritornello: &quot;Beauty, thou scene
                        of love&quot;</li>
                    <li>Song (tenor) &amp; chorus: &quot;In a consort of voices
                        while instruments play&quot;</li>
                </ol>
                <h4>Purcell - Hail! Bright Cecilia</h4>
                <p>De tweede ode, Hail! Bright Cecilia, is geschreven voor
                    vocale solisten, koor en een ensemble van twee blokfluiten,
                    basblokfluit, twee hobo's, twee trompetten, pauken,
                    vierstemmige strijkers en basso continuo. Met een tekst vol
                    verwijzingen naar muziekinstrumenten is het werk gescoord
                    voor een verscheidenheid aan vocale solisten en obbligato
                    instrumenten, samen met strijkers en basso continuo.
                    Bijvoorbeeld <i>Hark, each Tree </i>is een duet tussen,
                    vocaal, sopraan en bas, en instrumentaal, tussen blokfluiten
                    en violen. Deze instrumenten worden in de tekst genoemd
                    (“box and fir” zijn de houtsoorten waarvan ze gemaakt zijn).
                    Purcell volgde echter niet altijd precies Brady's
                    aanwijzingen. Hij noteerde de <i>Warlike Music</i> voor twee
                    trompetten en pauken in plaats van de fluit die Brady
                    noemde.</p>
                <h5>Delen</h5>
                <ol>
                    <li>Symphony (overture):
                        Introduction—Canzona—Adagio—Allegro—Grave—Allegro</li>
                    <li>Recitative (bas) en koor: &quot;Hail! Bright
                        Cecilia&quot;</li>
                    <li>Duet (sopraan [hoewel het bereik alt zou suggereren] en
                        bas): &quot;Hark! hark! each tree&quot;</li>
                    <li>Air (countertenor): &quot;'Tis nature's voice&quot;</li>
                    <li>Chorus: &quot;Soul of the world&quot;</li>
                    <li>Air (sopraan) en koor: &quot;Thou tun'st this
                        world&quot;</li>
                    <li>Trio (alt, tenor en bas): &quot;With that sublime
                        celestial lay&quot;</li>
                    <li>Air (bas): &quot;Wondrous machine!&quot;</li>
                    <li>Air (countertenor): &quot;The airy violin&quot;</li>
                    <li>Duet (countertenor en tenor): &quot;In vain the am'rous
                        flute&quot;</li>
                    <li>Air (countertenor): &quot;The fife and all the harmony
                        of war&quot;</li>
                    <li>Duet (twee bassen): &quot;Let these among themselves
                        contest&quot;</li>
                    <li>Chorus: &quot;Hail! Bright Cecilia, hail to thee&quot;
                    </li>
                </ol>
                <h4>Handel - Te Deum &amp; Jubilate</h4>
                <p>
                <div class="fotolinks"><img src="\Images\handel.jpg"
                        alt="George Frederick Handel" width="250"><br>George
                    Frederick Handel</div>Handels <i>Te Deum &amp; Jubilate
                </i>werden geschreven om de Vrede van Utrecht in 1713 te vieren.
                Het was zijn eerste grote geestelijke werk op Engelse
                teksten.&nbsp; Handel volgde het model van Henry Purcells Te
                Deum en Jubilate uit 1694 met strijkers en trompetten, dat zelfs
                na de dood van de componist regelmatig werd uitgevoerd bij
                officiële gelegenheden in St Paul's, en een zetting uit 1709 van
                William Croft. Net als in deze modellen componeerde&nbsp; Handel
                een combinatie van twee liturgische teksten, de Ambrosiaanse
                hymne <i>Te Deum</i> (We loven U, O God) en een zetting van
                Psalm 100, <i>O be joyful in the Lord, all ye lands</i>, wat een
                vaste lofzang is in het Anglicaanse ochtendgebed.&nbsp; Handels
                werk werd voor het eerst uitgevoerd tijdens een openbare
                repetitie op 5 maart 1713 in St Paul's Cathedral. De officiële
                première vond plaats nadat de moeizame vredesonderhandelingen
                waren afgerond, in een plechtige dankdienst op 7 juli
                1713.&nbsp;</p>
                <p>Het <i>Te Deum &amp; Jubilate </i>zijn feestelijk genoteerd
                    voor zes solisten (twee sopranen, twee alten, tenor en bas),
                    gemengd koor, twee trompetten, flauto traverso, twee hobo's,
                    fagot, strijkers en basso continuo. Het koor is voor de
                    meeste delen vijfstemmig (SSATB), maar af en toe zijn alt en
                    tenor als sopraan ingedeeld; de slotdoxologie begint
                    achtstemmig. Bijna alle delen zijn voor solozangers en koor;
                    er zijn geen echte aria's.</p>
                <h4>Te Deum</h4>
                <ol>
                    <li>We praise Thee, O God (Adagio, SATB)</li>
                    <li>To Thee all Angels cry aloud (Largo e staccato, 2 altos,
                        TB unison)</li>
                    <li>To Thee Cherubin and Seraphim (Andante, 2 sopranos,
                        SSATB)</li>
                    <li>The glorious Company of the Apostles (Andante – Adagio –
                        Allegro – adagio – Allegro, tenor, bass, two sopranos,
                        SSATB)</li>
                    <li>When thou took’st upon thee to deliver man (Adagio –
                        allegro – adagio – Allegro, SSATB)</li>
                    <li>We believe that thou shalt come to be our judge (Largo,
                        soprano, alto, tenor, bass, SATB)</li>
                    <li>Day by day we magnify thee (Allegro, double choir: SST
                        AATB)</li>
                    <li>And we worship thy name (SSATB)</li>
                    <li>Vouchsafe, O Lord (Adagio, SSAATB)</li>
                    <li>Lord, in thee have I trusted (Allegro, SSATB)</li>
                </ol>
                <h4>Jubilate</h4>
                <ol>
                    <li>Be joyful in the Lord, all ye lands (alto, SATB)</li>
                    <li>Serve the Lord with gladness (SSATB)</li>
                    <li>Be ye sure that the Lord he is God (duet: alto, bass,
                        violin, oboe)</li>
                    <li>Go your way into his gates (SATB, strings)</li>
                    <li>For the Lord is gracious (Adagio: 2 altos, bass, oboes,
                        violins)</li>
                    <li>Glory be to the Father (SSAATTBB)</li>
                    <li>As it was in the beginning (SSATB)</li>
                </ol>
                <p>Handel wist als componist een superieure synthese te bereiken
                    tussen solisten en koor, tussen solozang en tutti. De
                    grootschalige structuur doet nooit afbreuk aan de
                    delicatesse van melodie en harmonie, terwijl de muzikale
                    uitbeelding van de tekst altijd nauwkeurig is en grote
                    verfijning vertoont.&nbsp;</p>
                <p>Het succes van&nbsp; Handels Te Deum was zo groot dat het
                    werk jaarlijks werd uitgevoerd ter gelegenheid van St.
                    Cecilia's Day, op 22 november, waardoor Purcells tegenhanger
                    van de eerste plaats werd verdrongen.</p>
            </div>
            <h2><a href="javascript: history.go(-1)">Terug</a></h2>
        </div>
    </div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</html>