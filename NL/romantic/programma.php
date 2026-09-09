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
  <div id="inhoud" class="w3-main"> <?php
                                    echo $navigatie;
                                    echo '<span class="w3-opennav w3-xxlarge w3-hide-large" onclick="w3_open()">☰</span>';
                                    require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.NL.php';
                                    ?> <div id="main">
      <h2>Programmadetails</h2>
      <p><img src="/Images/mendelssohn.jpg"
          alt="Portret van Felix Mendelssohn Bartholdy"
          class="w3-left w3-margin-right" style="width:250px;">
      </p>
      <div class="w3-left">
        <h3>Het centrale werk: Mendelssohns Elias op. 70</h3>
        <p>In het afsluitende concert voeren we het romantische
          oratorium <em>Elias</em> van Mendelssohn uit met solisten,
          orkest en koor.</p>
        <p>Felix Mendelssohn voltooide zijn grootse oratorium
          <em>Elias</em> in 1846 voor het muziekfestival in
          Birmingham. Het werk vertelt het dramatische levensverhaal
          van de oude-testamentische profeet Elia. Van de verwoestende
          droogte en de confrontatie met de Baälpriesters op de berg
          Carmel, tot zijn eenzame vlucht in de woestijn en zijn
          uiteindelijke hemelvaart in een vurige wagen: Mendelssohn
          wist deze bijbelse vertelling te vangen in verbluffend
          theatraal en emotioneel geladen muziek.
        </p>
        <p>In de opbouw van het oratorium verweefde Mendelssohn de
          barokke contrapuntische traditie van Bach en Händel met de
          meeslepende, lyrische expressie van de negentiende-eeuwse
          romantiek. Het koor vervult daarbij een indrukwekkende
          dubbelrol: het ene moment verbeeldt het de woedende
          volksmassa of de smekende Baälpriesters, het volgende moment
          geeft het alwetend commentaar zoals in een klassieke Griekse
          tragedie.</p>
      </div>
      <h2><a href="javascript: history.go(-1)">Terug</a></h2>
    </div>
  </div>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html>