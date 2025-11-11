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
        <h2>Programmadetails</h2>
        <p>Centraal in de cursus staat barokmuziek in Centraal-Europa (ca. 1600–1750). Het gebied van Oostenrijk, Tsjechië, Polen speelde een centrale rol in de ontwikkeling van westerse klassieke muziek, waarbij expressie, virtuositeit en nieuwe vormen centraal stonden.</p>
        <h4>Historische en sociale context</h4>
        <p>De barokperiode viel samen met een tijd van politieke en religieuze spanningen, zoals de Dertigjarige Oorlog en de opkomst van absolute vorsten als de Habsburgers in Wenen en de Hohenzollerns in Brandenburg. Veel muziek werd in dienst van hof en kerk geschreven, waar rijke vorsten en bisschoppen componisten en musici aan zich verbonden. Tegelijkertijd groeide het openbare concertleven door de toenemende welvaart van de burgerij, waardoor muziek ook buiten kerken en hoven tot bloei kwam.</p>
        <h4>Muzikale kenmerken</h4>
        <p>De overgang van renaissance naar barok bracht een verschuiving van polyfonie naar een stijl waarin een duidelijke melodielijn boven een begeleidende bas (basso continuo) centraal stond. Barokmuziek kenmerkt zich door uitbundige versieringen, affectenleer (het uitdrukken van emoties), harmonisch contrapunt en de ontwikkeling van vormen als het concerto grosso en de suite. Instrumenten als het clavecimbel en de viool groeiden uit tot belangrijke begeleidingsinstrumenten, en harmonie werd essentieel voor de opbouw van stukken.</p>
        <h4>Innovaties en genres</h4>
        <p>De opkomst van de opera als genre, met name in Wenen en later ook in Praag en Dresden, getuigt van de theatrale kant van Centraal-Europese barokmuziek. Kerkmuziek bleef belangrijk, maar kreeg concurrentie van seculiere genres als kamermuziek, dansvormen en de eerste openbare concerten.
        </p>
        <h4>De rol van het archief in Kroměříž</h4>

        <p>Het muziekarchief van het kasteel van Kroměříž in Moravië (Tsjechië) is een van de rijkste collecties barokke kerkmuziek van Centraal-Europa. Dit archief, opgebouwd door bisschoppen als Karl von Liechtenstein-Castelcorn in de 17e eeuw, bevat duizenden manuscripten en drukken, waaronder werken van internationale en lokale componisten, zowel religieus als instrumentaal repertoire. Kroměříž fungeerde als een belangrijk cultureel centrum waar componisten uit heel Europa, waaronder Italiaanse en Duitse meesters, werkzaam waren of hun werken lieten uitvoeren. Het archief biedt inzicht in de hoge kwaliteit, de internationale stijlvermenging en de maatschappelijke rol van kerkmuziek in de barok, zowel tijdens de liturgie als voor concertante uitvoering aan het hof.​</p>

        <h4>Invloed en Erfgoed</h4>
        <p>Dankzij het archief van Kroměříž is veel kerkmuzikaal erfgoed uit Centraal-Europa bewaard gebleven, dat anders wellicht verloren was gegaan. Dit maakt het mogelijk repertoire van componisten als Pavel Josef Vejvanovský, Heinrich Biber en Giovanni Valentini weer tot leven te wekken in hedendaagse uitvoeringen. Het archief staat symbool voor de uitwisseling van stijlen en invloeden binnen Centraal-Europa en toont hoe kerkmuziek bijdroeg aan de culturele identiteit van de regio.</p>
        <h4>Belangrijke componisten</h4>
        <p>Centraal-Europese componisten als Johann Sebastian Bach (Duitsland), Heinrich Schütz, Georg Philipp Telemann, en voor Oostenrijk Johann Fux en Jan Dismas Zelenka (uit het toenmalige Bohemen, nu Tsjechië) drukten een stempel op de barokmuziek. Zij ontwikkelden diverse instrumentale en vocale stijlen die de verdere geschiedenis van de westerse muziek sterk bepaalden. Barokmuziek uit Centraal-Europa weerspiegelt zo de zoektocht naar expressie, pracht en innovatie die kenmerkend was voor deze bloeiperiode in de Europese muziekgeschiedenis.</p>
      </div>
      <h2><a href="javascript: history.go(-1)">Terug</a></h2>
    </div>
  </div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

</html>