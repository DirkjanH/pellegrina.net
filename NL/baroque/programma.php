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
  <title>Programma "<?php echo $cursusdata['cursusnaam']; ?>"</title>
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
        <p>Het gezamenlijke programma voor alle deelnemers aan de
          zomerschool staat in het teken van barokmuziek uit Napels.
          Gedurende de zeventiende en achttiende eeuw was Napels het
          kloppende hart van het Europese muzikale leven. Aangedreven
          door de prestigieuze conservatoria en bruisende operahuizen
          trok de 'Napolitaanse School' musici uit het hele continent
          aan.</p>
        <p>In die tijd bestond er geen scherpe scheiding tussen kerk en
          theater: de stijlen van de geestelijke muziek en de opera
          leken sterk op elkaar en wisselden voortdurend muzikale
          ideeën, affecten en vocale virtuositeit uit. Deze zomer
          duiken we in dit rijke, expressieve en dramatische
          Napolitaanse repertoire. We verkennen zowel meeslepende
          instrumentale en geestelijke werken als concertant
          uitgevoerde delen uit opera's.</p>
        <p>Tijdens de dagelijkse middagsessies bundelen zangers en
          instrumentalisten hun krachten voor de uitvoering van deze
          vocaal-instrumentale meesterwerken, begeleid door een
          kleurrijk barokorkest dat naast strijkers, houtblazers en
          basso continuo ook koper omvat: natuurhoorns en
          baroktrompetten. Ons centrale repertoire omvat onder meer:
        </p>
        <ul>
          <li><strong>Giovanni Battista Pergolesi:</strong>
            geselecteerde instrumentale en operadelen, bijvoorbeeld
            uit <i>Il Flaminio</i> (1735) &mdash; een illustratie
            van de doorleefde, lyrische en intens dramatische stijl
            die Pergolesi door heel Europa legendarisch maakte.</li>
          <li><strong>Alessandro Scarlatti:</strong> representatieve
            geestelijke werken en operascènes, bv. uit <i>La
              Griselda</i> (1721) &mdash; met de nadruk op het
            ingenieuze contrapunt, de rijke blazersbezetting en het
            vocale meesterschap van de aartsvader van de
            Napolitaanse School.</li>
          <li><strong>Francesco Durante &amp; Leonardo Leo:</strong>
            geselecteerde geestelijke concerten, operadelen en
            dubbelkorige psalmzettingen &mdash; met een rijke
            strijkerspartij, kleurrijk koper en hout, expressieve
            solo's en bruisende koorfuga's.</li>
        </ul>
        <p>De definitieve keuze van werken wordt gemaakt zodra bekend is
          welke zangers en instrumentalisten aan de cursus deelnemen.
          Dit om het repertoire optimaal af te stemmen op de aanwezige
          musici.</p>
      </div>
    </div>
    <h2><a href="javascript: history.go(-1)">Terug</a></h2>
  </div>
  </div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

</html>