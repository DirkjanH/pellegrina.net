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
    <title>Praktisch &amp; prijzen cursus
        "<?php echo $cursusdata['cursusnaam_nl']; ?>"</title>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.NL.php'; ?>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>

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
            <h2 class="begin">Praktische gegevens & prijzen
                "<?php echo $cursusdata['cursusnaam_nl']; ?>"</h2>
            <h3>Toelating</h3>
            <p> Omdat bij het samenstellen van de groep wordt gestreefd naar een
                evenwichtig geheel, wordt bij toelating in de eerste plaats gekeken naar
                niveau, in het belang van alle deelnemers. Vaak moeten we kiezen uit een
                te groot aanbod van belangstellenden voor een bepaald instrument, met
                name bij de blazers. We letten dan in de eerste plaats op muzikale
                opleiding, ervaring en inzicht. Het is daarom belangrijk om je muzikale
                niveau goed te omschrijven. Bij kandidaten voor een bepaald instrument
                of stemsoort met een gelijkwaardig niveau heeft uiteraard degene die
                zich het eerst heeft aangemeld voorrang. Wanneer je twijfelt over je
                niveau, neem dan <a href="contact.php">contact op</a> met <i>La
                    Pellegrina</i>. </p>
            <p>Om bovenstaande reden worden de aanmeldingen in eerste instantie
                verzameld. Op <?php echo $cursusdata['beslisdatum']; ?> wordt bekend
                gemaakt wie er geplaatst kan worden en wie niet. In verband met het
                beperkte aantal plaatsen is het dus aan te raden zo snel mogelijk in te
                schrijven. Inschrijving na <?php echo $cursusdata['beslisdatum']; ?> is
                nog mogelijk, maar uitsluitend voor de plaatsen die dan nog vacant zijn
                en vermeld op deze website.</p>
            <h3>Aanmelding en bevestiging</h3>
            <p>Je kunt je inschrijven met het aanmeldingsformulier op deze site (zie het
                betreffende project), dat <strong>volledig</strong> ingevuld moet
                worden. De aanbetaling van
                <strong><?php echo euro($cursusdata['inschrijfgeld']); ?></strong> kun
                je gelijk met de aanmelding betalen, of apart overmaken op rekening
                <strong>NL33 ASNB 0707 2500 72 </strong>t.n.v. <em>La Pellegrina</em> te
                Utrecht. Je ontvangt dan een voorlopige bevestiging van inschrijving.
                Als je niet geplaatst kunt worden, wordt de aanbetaling uiteraard
                teruggestort. Het volledige cursusgeld moet uiterlijk op
                <?php echo $cursusdata['betaaldatum']; ?> betaald zijn.
            </p>
            <h3>Prijzen</h3>
            <p>De prijs van het project,
                <strong><?php echo euro($cursusdata['prijs_volledig']); ?></strong>&nbsp;per
                persoon, is inclusief logies in tweepersoons kamers (met eigen
                sanitair), ontbijt, lunch en op de eerste en laatste dag ook het
                avondeten. De reis is niet inbegrepen, evenals eventuele verzekeringen.
                Alle eventuele bank en creditcardkosten zijn voor rekening van de
                deelnemer.
            </p>
            <h4>Aanzienlijke korting voor studenten en jongeren </h4>
            <p><em>Voltijds</em> studenten aan het wetenschappelijk en hoger
                beroepsonderwijs en deelnemers t/m 35 jaar (bij aanvang van de cursus
                waarvoor ze zich hebben aangemeld). krijgen een aanzienlijke korting en
                betalen
                <strong><?php echo euro($cursusdata['prijs_student']); ?></strong>
                cursusgeld per persoon, op basis van een tweepersoons kamer in het
                conservatorium. Stuur bij inschrijving een kopie of een scan van het
                inschrijvingsbewijs (of van je paspoort als bewijs van je leeftijd) mee.
            </p>
            <h4>Reductie voor tijdig inschrijven </h4>
            <p>Als je je <strong>v&oacute;&oacute;r
                    <?php echo $cursusdata['beslisdatum']; ?></strong> inschrijft, krijg
                je <strong><?php echo euro($cursusdata['korting_vroeg']); ?></strong>
                korting op de prijs van het project. Dit geldt zowel voor de volle
                cursusprijs als voor die voor studenten en deelnemers van 35 jaar en
                jonger (maar niet voor toehoorders). Na
                <?php echo $cursusdata['beslisdatum']; ?> kun je je ook nog inschrijven
                voor de plaatsen die op dat moment nog open zijn, maar dan geldt deze
                reductie niet meer. </p>
            <h4>Extra reductie voor muziekstudenten</h4>
            <p>Voltijds muziekstudenten aan een conservatorium kunnen beroep doen op een
                extra korting dankzij een fonds opgebouwd uit bijdragen van
                de ACMP en deelnemers: vraag svp om details.</p>
            <h4> Toehoorders en niet-deelnemende partners</h4>
            <p> Er is beperkt plaats voor toehoorders, zoals niet-deelnemende partners.
                De kosten voor deelname, inclusief logies in tweepersoons kamers en
                maaltijden, maar exclusief het project, de reis en verzekeringen,
                bedragen
                <strong><?php echo euro($cursusdata['toehoorder']); ?></strong>.
                Uiteraard hebben deelnemers vrije toegang tot alle concerten en andere
                cursusactiviteiten. Bud&#283;jovice is een aantrekkelijke, rustige stad.
                Er zijn volop mogelijkheden voor wandelen, fietsen, zwemmen,
                kano&euml;n, kastelen bezoeken en gewoon niets doen. Inlichtingen
                hierover zijn bij <a href="contact.php"><i>La Pellegrina</i></a> te
                verkrijgen.
            </p>
            <h4>Groot instrument? Huren in plaats van meenemen!</h4>
            <p>Soms is het handiger voor bespelers van grote instrumenten als celli,
                contrabassen en viola da gamba's er een ter plekke te huren dan een
                extra ticket te betalen. <em>La Pellegrina </em>kan hierin bemiddelen.
                Aan deze service zijn doorgaans wel kosten verbonden. Reken op een huur
                van ca. &#8364; 50 - 100 voor de duur van de cursus. Het verdient
                aanbeveling dit tijdig aan te vragen. Met wat geluk krijg je het
                reserveinstrument van een van onze docenten te bespelen. Voor strijkers
                is het wel goed in principe je eigen strijkstok mee te nemen.</p>
            <h4>Deelname aan meer dan een cursus</h4>
            <p>Wie meer dan &eacute;&eacute;n zomercursus van <i>La Pellegrina</i>
                (binnen &eacute;&eacute;n zomer) wil volgen, krijgt een<strong> korting
                    van <?php echo euro($cursusdata['korting_meer'] * 2); ?>.</strong>
                Vul dan SVP beide inschrijfformulieren in en klik de optie 'Ik wil voor
                meer dan &eacute;&eacute;n cursus inschrijven' aan.</p>
            <h3>Accommodatie</h3>
            <h4>Eenpersoons kamers</h4>
            <p>Er zijn ook eenpersoons kamers (uiteraard ook met eigen sanitair) in het
                conservatorium beschikbaar tegen een meerprijs van
                <strong><?php echo euro($cursusdata['eenpers']); ?></strong>. Vroege
                aanmelding is hiervoor aan te raden.
            </p>
            <h4>Eigen accommodatie</h4>
            <p>Daarnaast is er de mogelijkheid om zelf accommodatie in České Budějovice
                te boeken. Er is een ruime keus aan hotels, van klassiek
                in het centrum tot modern net erbuiten. Via <a
                    href="http://www.booking.com/city/cz/ceske-budejovice.nl.html"
                    target="_blank">booking.com</a> heb je snel een overzicht van de
                mogelijkheden. Ook via <a
                    href="https://www.airbnb.nl/s/%C4%8Cesk%C3%A9-Bud%C4%9Bjovice-?checkin=24%2F07%2F2016&amp;checkout=31%2F07%2F2016&amp;ss_id=qo8di0g9"
                    target="_blank">Airbnb</a> zijn er tal van mogelijkheden. Als je je
                eigen accommodatie en ontbijt regelt, krijg je een korting van
                <strong><?php echo euro($cursusdata['korting_eigen_acc']); ?></strong>
                op de cursusprijs. De lunch en op de eerste en laatste dag ook het
                avondeten zijn gemeenschappelijk met alle deelnemers en dus inbegrepen
                in de cursusprijs.
            </p>
            <h3>Alle prijzen in één oogopslag</h3>
            <table class="w3-table-all">
                <tr>
                    <th>Overzicht van alle prijzen en kortingen</th>
                    <th>Bij inschrijving <br>v&ograve;&ograve;r
                        <?php echo $cursusdata['beslisdatum']; ?>: </th>
                    <th>Bij inschrijving <br>op of na
                        <?php echo $cursusdata['beslisdatum']; ?>: </th>
                </tr>
                <tr>
                    <td>Deelname incl. tweepersoons kamer in het conservatorium </td>
                    <td class="geld">
                        <?php echo euro($cursusdata['prijs_volledig'] - $cursusdata['korting_vroeg']); ?>
                    </td>
                    <td class="geld"><?php echo euro($cursusdata['prijs_volledig']); ?>
                    </td>
                </tr>
                <tr>
                    <td>Deelname student c.q. deelnemer t/m 35 jaar incl. tweepersoons
                        kamer in het conservatorium</td>
                    <td class="geld">
                        <?php echo euro($cursusdata['prijs_student'] - $cursusdata['korting_vroeg']); ?>
                    </td>
                    <td class="geld"><?php echo euro($cursusdata['prijs_student']); ?>
                    </td>
                </tr>
                <tr>
                    <td>Deelname toehoorder incl. tweepersoons kamer in het
                        conservatorium</td>
                    <td class="geld"><?php echo euro($cursusdata['toehoorder']); ?></td>
                    <td class="geld"><?php echo euro($cursusdata['toehoorder']); ?></td>
                </tr>
                <tr>
                    <td>Meerprijs eenpersoons kamer in het conservatorium </td>
                    <td class="geld"><?php echo euro($cursusdata['eenpers']); ?></td>
                    <td class="geld"><?php echo euro($cursusdata['eenpers']); ?></td>
                </tr>
                <tr>
                    <td>Korting voor eigen accommodatie en ontbijt</td>
                    <td class="geld"><?php echo euro($cursusdata['korting_eigen_acc']);
                                        ?></td>
                    <td class="geld">
                        <?php echo euro($cursusdata['korting_eigen_acc']); ?>
                    </td>
                </tr>
                <tr>
                    <td>Korting voor deelname aan twee cursussen<span class="nadruk">
                            (in totaal, niet per cursus)</span></td>
                    <td class="geld">
                        <?php echo euro($cursusdata['korting_meer'] * 2); ?>
                    </td>
                    <td class="geld">
                        <?php echo euro($cursusdata['korting_meer'] * 2); ?>
                    </td>
                </tr>
            </table>
            <h3> Voertaal</h3>
            <p>De projecten van <i>La Pellegrina</i> worden internationaal aangeboden;
                de deelnemers komen hoofdzakelijk uit West- en Oost-Europa, maar soms
                ook uit Japan, Taiwan, Canada, Mexico en Amerika. Er wordt Nederlands,
                Duits en Engels gesproken. Omdat het Engels de taal is die bijna
                iedereen gemeenschappelijk heeft, zullen de lessen hoofdzakelijk in het
                Engels zijn.</p>
            <p class="citaat">Yo van Dijk: &quot;Een bijna magische mix van je
                thuisvoelen en nieuwe avonturen beleven. Zo fijn, al die verschillende
                talen met als bindmiddel de taal van de muziek.&quot;</p>
            <h3>Vakantie in Tsjechi&euml;</h3>
            <p>De projecten van <i>La Pellegrina</i> laten zich uitstekend combineren
                met een vakantie in Tsjechi&euml;, een om zijn rust en mooie natuur
                steeds meer geliefde vakantiebestemming. </p>
            <p class="citaat">Katy en Jan de Jongh: 'V&oacute;&oacute;r het project gaan
                we een paar dagen naar Praag, en erna uitrusten in de omgeving.
                Zuid-Bohemen is mooi en goedkoop, dan kun je nog eens wat langer
                blijven.'</p>
            <h3><a name="annul"></a>Annuleringsregeling</h3>
            <p>Als je onverhoopt niet geplaatst kunt worden voor een cursus, of als
                <i>La Pellegrina</i> het project zou moeten annuleren, ontvang je
                uiteraard het gehele betaalde bedrag terug. Annuleer je zelf
                v&oacute;&oacute;r of op <?php echo $cursusdata['betaaldatum']; ?>, dan
                is het niet mogelijk je aanbetaling te retourneren. Annuleer je na
                <?php echo $cursusdata['betaaldatum']; ?>, dan ben je het totale
                cursusgeld verschuldigd. Het is aan te raden tijdig een
                annuleringsverzekering af te sluiten.
            </p>
            <p><i>La Pellegrina</i> behoudt zich het recht voor om, indien noodzakelijk,
                docenten en programma te wijzigen.</p>
            <h2><a href="javascript: history.go(-1)">Terug</a></h2>
        </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html>