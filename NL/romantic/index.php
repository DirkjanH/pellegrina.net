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
  <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=537749209897328&ev=PageView&noscript=1" /></noscript>
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
      <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/cursustitel.php'); ?>
      <ul>
        <li>Voor: ( koor)zangers (SATB), strijkers, blazers en pianisten; ook voor bestaande kamermuziekensembles</li>
        <li>Intensieve begeleiding door ervaren docenten: Martina Bernášková, Petr Bernášek, Pavel Hořejší, Dirkjan Horringa, Libor Nováček, Mitchell Sandler (coaching zangers), Rudolf Sternadel, Jitka Vlašánková en anderen</li>
        <li>Instrumentalisten: kamermuziek én groot symfonisch orkest<u></u><u></u></li>
        <li>Kamermuziek: iedereen speelt in twee, van tevoren gevormde ensembles<u></u><u></u></li>
        <li>Centraal werk voor iedereen: Haydns <em>Missa in Tempore Belli</em>. Het orkest speelt ook Dvořáks Symfonisch gedicht <i>Het gouden spinnewiel</i> op. 109</li>
        <li>Koor: naast de Missa in Tempore Belli met orkest ook werken uit het kamerkoorrepertoire, a capella en met piano</li>
        <li>In het conservatorium van České Budějovice, Zuid-Bohemen, Tsjechië</li>
        <li>Met <em>Mozart Concerto Event</em>: deelnemers spelen een (deel van een) soloconcert van Mozart of een tijdgenoot; de deelnemers vormen een ad hoc orkest dat de begeleiding van blad speelt<u></u><u></u></li>
      </ul>
      <p class="plaatsvoor onzichtbaar">Nog plaatsen beschikbaar voor piano, viool en altviool. Het koor heeft nog enkele plaatsen in alle groepen, met name voor bassen</p>
      <p class="onzichtbaar">Deze cursus is vol voor alle instrumenten en stemmen</p>
      <p><a href="cursus.php" class="onzichtbaar">Lees meer over deze cursus</a></p>
      <!-- InstanceEndEditable -->
      <h2><a href="javascript: history.go(-1)">Terug</a></h2>
    </div>
  </div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
<!-- InstanceEnd -->

</html>