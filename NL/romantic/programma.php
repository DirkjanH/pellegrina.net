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
    <title>Dvořáks cantate Het Bruidshemd</title>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.NL.php'; ?>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
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
</head>
<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
    <div id="inhoud" class="w3-auto w3-main"> <?php
                                                echo $navigatie;
                                                echo '<span class="w3-opennav w3-xxlarge w3-hide-large" onclick="w3_open()">☰</span>';
                                                require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.NL.php';
                                                ?> <div id="main"
            class="programma-layout">
            <div class="programma-afbeelding"><img src="/Images/mendelssohn.jpg"
                    alt="Portret van Felix Mendelssohn Bartholdy">
            </div>
            <div class="programma-tekst">
                <h1>Het centrale werk: Mendelssohns Elias op. 70</h1>
                <p>In het afsluitende concert voeren we het romantische
                    oratorium <em>Elias</em> van Mendelssohn uit met solisten,
                    orkest en koor. Omdat het hele stuk te lang is om in deze
                    cursus in te studeren, hebben we gekozen alleen het eerste
                    deel uit te voeren. Dat duurt 65 à 70 minuten en is dus een
                    volledig concertprogramma op zich. Ook qua verhaal kan het
                    goed op zichzelf staan.</p>
                <p> Mendelssohn laat in <em>Elias</em> zijn bewondering voor
                    Bach en Händel horen, maar geeft het oratorium
                    tegelijkertijd een uitgesproken romantische dramatiek. Het
                    koor speelt een belangrijke rol: het verbeeldt het volk
                    Israël, de engelen en de omstanders. Vooral de contrasten
                    tussen de wanhopige gebeden van het volk, de indrukwekkende
                    profetische uitspraken van Elias en de lyrische aria's maken
                    het eerste deel tot een afwisselend en meeslepend geheel.
                </p>
                <p> De muziek schildert de gebeurtenissen bijna filmisch: de
                    dreiging van de droogte, de wanhoop van de weduwe, de strijd
                    op de berg Karmel en uiteindelijk de overwinning van Elias'
                    God. </p>
                <h2>Toelichting bij het eerste deel</h2>
                <h2>Het verhaal</h2>
                <p> Het oratorium begint met een dramatische aankondiging van
                    Elia: als straf voor de afgodendienst van het volk zal er
                    geen regen meer vallen. Daarmee begint een langdurige
                    droogte en hongersnood. Elia trekt zich terug en wordt door
                    raven van voedsel voorzien. Later krijgt hij onderdak bij
                    een weduwe in Sarepta. Wanneer haar zoon sterft, bidt Elia
                    tot God en brengt hem weer tot leven. </p>
                <p> Ondertussen wordt de droogte steeds nijpender. Koning Achab
                    houdt Elia verantwoordelijk voor de ellende, maar Elia stelt
                    dat juist de afgodendienst van het volk de oorzaak is. Hij
                    daagt de profeten van Baäl uit tot een beslissende
                    krachtmeting op de berg Karmel. </p>
                <p> Daar brengen de profeten van Baäl hun god een offer, maar er
                    komt geen vuur. Elia bouwt vervolgens een altaar voor de God
                    van Israël. Na zijn gebed daalt vuur uit de hemel neer en
                    verteert het offer. Het volk erkent daarop de God van
                    Israël. Elia laat de profeten van Baäl doden en bidt
                    vervolgens om regen. Na een lange periode van droogte
                    verschijnt er eindelijk een wolkje aan de hemel: de regen
                    keert terug. </p>
                <h2>Bezetting</h2>
                <ul>
                    <li><strong>Solisten:</strong> sopraan, alt, tenor en bas.
                    </li>
                    <li><strong>Koor:</strong> gemengd vierstemmig koor (SATB),
                        met onder andere dubbelkwartet en kleinere vocale
                        ensembles.</li>
                    <li><strong>Orkest:</strong> strijkers, twee fluiten, twee
                        hobo's, twee klarinetten, twee fagotten, vier hoorns,
                        twee trompetten, drie trombones, ophicleïde (bij ons
                        tuba), pauken en orgel.</li>
                </ul>
                <p> De belangrijkste solistenrol is die van Elias, doorgaans
                    gezongen door een bas of bas-bariton. De overige solisten
                    vertolken meerdere personages, waaronder koning Achab, de
                    profeet Obadja, de weduwe, haar zoon en verschillende
                    engelen. </p>
                <h2>Duur</h2>
                <p> Het eerste deel duurt ongeveer <strong>65 à 70
                        minuten</strong>, afhankelijk van het tempo. Het
                    complete oratorium duurt ongeveer 2 uur en 10 minuten.</p>
            </div>
        </div>
        <h2><a href="javascript: history.go(-1)">Terug</a></h2>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>
</html>