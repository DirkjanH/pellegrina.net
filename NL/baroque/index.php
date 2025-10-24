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
        <li>Voor: zangers (solisten en zeer ervaren koorzangers), instrumentalisten (barokstrijkers, viola da gamba, traverso, barokhobo, barokfagot, baroktrompet, clavecimbel/orgel, theorbe, uitsluitend ‘oude’ instrumenten, stemtoon 415 Hz)</li>
        <li>Olv Dirkjan Horringa (zangers en artistieke leiding), Femke Huizinga (orkest, viool), Hanna Lindeijer (barok-blazers), Ricardo Rodríguez Miranda (viola da gamba, celli en contrabas, barokdans), Mitchell Sandler (zangers) en Edoardo Valorz (basso continuo)</li>
        <li>Centrale werken voor iedereen: muziek uit Wenen/Praag/Dresden/Kroměříž van onder andere Fux, Caldara, Zelenka, Michna, Vejvanovský en Schmelzer. Centraal staat het Miserere in c klein ZWV 57 van Zelenka</li>
        <li>Barokke kamermuziek elke ochtend voor instrumentale, vocale of gecombineerde vocaal-instrumentale ensembles</li>
        <li>In klooster Nieuw Sion, Diepenveen bij Deventer, met accommodatie in een- en tweepersoonskamers</li>
        <li>Met <em>Concerto & Aria Event</em>: deelnemers kunnen een soloconcert spelen of een aria zingen; de overige deelnemers en docenten vormen een ad hoc orkest dat de begeleiding van blad speelt</li>
        <li>Met barokdansworkshop voor iedereen</li>
      </ul>
      <p class="onzichtbaar plaatsvoor">Plaats beschikbaar voor een barokhobo</p>
      <p class="onzichtbaar">Vol voor: alle instrumenten en zangers </p>

      <p><a href="cursus.php" class="onzichtbaar">Lees meer over deze cursus</a></p>
      <!-- InstanceEndEditable -->
      <h2><a href="javascript: history.go(-1)">Terug</a></h2>
    </div>
  </div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
<!-- InstanceEnd -->

</html>