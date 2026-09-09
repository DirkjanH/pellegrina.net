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
  <title>Barok uit Centraal Europa</title>
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
        <h2>Barokmuziek uit Napels (1650 – 1750)</h2>
        <p>Het programma voor alle deelnemers aan de zomerschool staat
          in het teken van barokmuziek uit Napels. Gedurende de
          zeventiende en achttiende eeuw was Napels het kloppende hart
          van het Europese muzikale leven. Aangedreven door de
          prestigieuze conservatoria en bruisende operahuizen trok de
          'Napolitaanse School' musici uit het hele continent aan.
          Deze zomer duiken we in dit rijke, expressieve en virtuoze
          Napolitaanse repertoire, waarbij we zowel meeslepende
          orkestwerken als religieuze werken voor solisten, koor en
          orkest verkennen. </p>
        <p>Tijdens de dagelijkse middagsessies bundelen zangers en
          instrumentalisten hun krachten voor het uitvoeren van
          dramatische vocaal-instrumentale stukken uit de Napolitaanse
          barok. Ons centrale repertoire omvat onder meer:</p>
        <ul>
          <li><strong>Giovanni Battista Pergolesi:</strong>
            geselecteerde orkestdelen — een illustratie van de
            doorleefde, lyrische en intens dramatische stijl die
            Pergolesi door heel Europa legendarisch maakte.</li>
          <li><strong>Alessandro Scarlatti:</strong> representatieve
            geestelijke werken en koren — met de nadruk op het
            ingenieuze contrapunt en de vocale meesterschap van de
            aartsvader van de Napolitaanse School.</li>
          <li><strong>Francesco Durante & Leonardo Leo:</strong>
            geselecteerde geestelijke concerten en dubbelkorige
            psalmzettingen — met een rijke strijkerspartij,
            expressieve solo's en bruisende koorfuga's.</li>
        </ul>
      </div>
    </div>
    <h2><a href="javascript: history.go(-1)">Terug</a></h2>
  </div>
  </div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

</html>