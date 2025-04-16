<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/cursussen.php';
$cursusnr = 2 + $cursus_offset; ?>

<!DOCTYPE HTML>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">

  <!-- CSS: -->
  <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">

  <!-- InstanceBeginEditable name="doctitle" -->
  <title>Information & scores <?php echo $cursussen[$cursusnr]['cursusnaam_en'] ?></title>
  <meta name="robots" content="noindex, nofollow">
  <!-- InstanceEndEditable -->
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.EN.php'; ?>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
  <link href="/css/pagina_stijlen_algemeen.css" rel="stylesheet" type="text/css">
  <!-- InstanceBeginEditable name="head" -->
  <link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
  <style type="text/css">
    h3 {
      margin: 25px 0px 15px;
      padding: 0px;
    }

    table#parts tr,
    td {
      margin: 10px 5px;
      padding: 5px;
    }
  </style>
  <!-- InstanceEndEditable -->
</head>

<body>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
  <div id="inhoud">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.EN.php'; ?>
    <div id="main"> <!-- InstanceBeginEditable name="mainpage" -->
      <table width="100%" border="1">
        <tr>
          <th>List of participants</th>
          <th>Chamber music formations</th>
          <th>Room divisions </th>
          <th>Accommodation near Nieuw Sion</th>
          <th>Daily program</th>
          <th>Flyer concert</th>
        </tr>
        <tr>
          <td class="w3-center"><a href="../part_list.php?cursus=2" target="_blank">List of participants</a></td>
          <td class="w3-center grijs"><a xxxx="https://pellegrina.net/ensemblelijst_2.php" target="_blank">Chamber music ensembles</a></td>
          <td class="w3-center grijs"><a xxxx="https://docs.google.com/spreadsheets/d/1JCygZZvuBPAWIkfGGGChLMXQSNA34EkRP9tYArxD5LI/edit?usp=sharing" target="_blank">Overview of accommodation</a></td>
          <td class="w3-center"><a href="https://docs.google.com/document/d/1ODcgAmuTYIfNC9DKLaU0f6zed2uJvaJ6aoiIGp2Sb1A/edit?usp=sharing" target="_blank">Accommodation near Nieuw Sion</a></td>
          <td class="w3-center grijs"><a xxxx="https://docs.google.com/document/d/1IpHquLhJ4NAdDyNHhrhLk_IQGsoXs4FEMSDAqoYFatc/pub" target="_blank">Daily program</a></td>
          <td class="w3-center grijs"><a xxxx="LP2024-2 Vivaldi FLYER.pdf" target="_blank">Flyer concert</a></td>
        </tr>
      </table>
      <div class="">
        <h2><?php echo $cursussen[$cursusnr]['cursusnaam_en'] ?> (<?php echo $cursussen[$cursusnr]['datumkort'] ?>) - information & scores<br />
        </h2>
        <div class="onzichtbaar">
          <h2 class="">Chamber music works</h2>
          <ul>
            <li>
              <h3>Giovanni Legrenzi, Prosa pro mortuis (set 1 nr. 1)</h3>
              <ul>
                <li><a href="../pdf/2024-2/Legrenzi/DIES IRAE - Score.pdf" target="_blank">Legrenzi, Prosa pro mortuis, score</a></li>
                <li><a href="../pdf/2024-2/Legrenzi/DIES IRAE - Instrumental parts.pdf" target="_blank">Legrenzi, Prosa pro mortuis, all instrumental parts</a></li>
                <li><a href="https://www.youtube.com/watch?v=1OVcwg1c7UM" target="_blank">Legrenzi, Prosa pro mortuis, recording by the Margaretha Consort with Jos van Velthoven</a> (set 1 nr. 1)</li>
              </ul>
            </li>
            <h3>Antonín Reichenauer - Quartet in g minor</h3>
            <div class="cols3">
              <ul>
                <li><a href="../pdf/2024-2/Reichenauer/Reichenauer_Quartett_Rk_18_bassoon.pdf" target="_blank">Bassoon</a></li>
                <li><a href="../pdf/2024-2/Reichenauer/Reichenauer_Quartett_Rk_18_violino.pdf" target="_blank">Violino</a></li>
                <li><a href="../pdf/2024-2/Reichenauer/Reichenauer_Quartett_Rk_18_violoncello.pdf" target="_blank">Cello</a></li>
                <li><a href="../pdf/2024-2/Reichenauer/Reichenauer_Quartett_Rk_18_basso.pdf" target="_blank">Basso</a></li>
                <li><a href="../pdf/2024-2/Reichenauer/Reichenauer_Quartett_Rk_18.pdf" target="_blank">Manuscript source</a></li>
              </ul>
            </div>
          </ul>
        </div>
        <h2>Tutti programme</h2>
        <p>All parts for the works we are going to perform are now available. Please print and study what you need. Singers, please print, study and bring the vocal score. The string parts have no bowings yet. They will be available soon. Some movement require trumpets, which we most likely will not have.</p>
        <h3>Purcell - Welcome to all the pleasures (Z.339)</h3>
        <p>We can and will perform this Cecilia Ode in its entirety. The instrumental parts still need to be scanned.</p>
        <ul>
          <li><a href="/pdf/2025-2/Purcell_Welcome_score.pdf" target="_blank">Purcell - Welcome to all the pleasures (Z.339) - Full score</a></li>
          <li><a href="/pdf/2025-2/Purcell - Welcome - Vocal score.pdf" target="_blank">Purcell - Welcome to all the pleasures (Z.339) - Vocal score</a></li>
        </ul>
        <h3>Purcell - Hail! Bright Cecilia (Z.328)</h3>
        <p>We will only perform a few movements of this Cecilia Ode. We will have to skip the overture and no. 11, the countertenor Air “The fife and all the harmony of war”, because they require trumpets.</p>
        <ul>
          <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia_score.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Score</a></li>
          <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Oboe_1.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Oboe 1</a></li>
          <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Oboe_2.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Oboe 2</a></li>
          <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Recorder_1.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Recorder 1</a></li>
          <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Recorder_2.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Recorder 2</a></li>
          <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Greatbass_Recorder.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Greatbass Recorder</a></li>
          <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Bassoon.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Bassoon</a></li>
          <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Violin_1.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Violin 1</a></li>
          <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Violin_2.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Violin 2</a></li>
          <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Viola.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Viola</a></li>
          <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Harpsichord.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Harpsichord</a></li>
          <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Continuo.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Cello, double bass</a></li>

        </ul>
        <h3>Handel - Utrecht Te Deum HMV 278</h3>
        <p>We will only perform a few movements of this Te Deum. We will for sure do the quartet with solo flute <i>We believe that thou shalt come to be our judge</i>. We will have to skip the opening chorus, the double choir <i>Day by day we magnify thee</i> and the final chorus <i>O Lord, in thee have I trusted</i>, because they require trumpets.</p>
        <ul>
          <li><a href="/pdf/2025-2/HANDEL_-_TE_DEUM_HWV_278_Score.pdf" target="_blank">Handel - Te Deum - Full score</a></li>
          <li><a href="/pdf/2025-2/Handel - Te Deum HMV 278 - Flute_1.pdf" target="_blank">Handel - Te Deum - Flute</a></li>
          <li><a href="/pdf/2025-2/Handel - Te Deum HMV 278 - Oboe_1-2.pdf" target="_blank">Handel - Te Deum - Oboes 1-2</a></li>
          <li><a href="/pdf/2025-2/Handel - Te Deum HMV 278 - Bassoon_1.pdf" target="_blank">Handel - Te Deum - Bassoon</a></li>
          <li><a href="/pdf/2025-2/Handel - Te Deum HMV 278 - Violins_I.pdf" target="_blank">Handel - Te Deum - Violin 1</a></li>
          <li><a href="/pdf/2025-2/Handel - Te Deum HMV 278 - Violins_II.pdf" target="_blank">Handel - Te Deum - Violin 2</a></li>
          <li><a href="/pdf/2025-2/Handel - Te Deum HMV 278 - Violas.pdf" target="_blank">Handel - Te Deum - Violas</a></li>
          <li><a href="/pdf/2025-2/Handel - Te Deum HMV 278 - Cellos.pdf" target="_blank">Handel - Te Deum - Cello, double bass</a></li>
          <li><a href="/pdf/2025-2/Handel - Te Deum HMV 278 - Vocal score.pdf" target="_blank">Handel - Te Deum - Vocal score</a></li>
        </ul>
        <h3>Handel - Utrecht Jubilate HMV 279</h3>
        <p>We will only perform a few movements of this Jubilate, among which the alto/bass duet <i>Be ye sure that the Lord he is God</i> and the trio for two altos and bass <i>For the Lord is gracious</i>.</p>
        <ul>
          <li><a href="/pdf/2025-2/HANDEL_-_JUBILATE_HWV_279_Score.pdf" target="_blank">Handel - Jubilate - Full score</a></li>
          <li><a href="/pdf/2025-2/Handel - Jubilate HMV 279 - Oboe_1-2.pdf" target="_blank">Handel - Jubilate - Oboes 1-2</a></li>
          <li><a href="/pdf/2025-2/Handel - Jubilate HMV 279 - Violins_I.pdf" target="_blank">Handel - Jubilate - Violin 1</a></li>
          <li><a href="/pdf/2025-2/Handel - Jubilate HMV 279 - Violins_II.pdf" target="_blank">Handel - Jubilate - Violin 2</a></li>
          <li><a href="/pdf/2025-2/Handel - Jubilate HMV 279 - Violins_III.pdf" target="_blank">Handel - Jubilate - Violin 3</a></li>
          <li><a href="/pdf/2025-2/Handel - Jubilate HMV 279 - Violas.pdf" target="_blank">Handel - Jubilate - Viola</a></li>
          <li><a href="/pdf/2025-2/Handel - Jubilate HMV 279 - Cellos-Basses.pdf" target="_blank">Handel - Jubilate - Cello, double bass</a></li>
        </ul>
        <h3>Handel - <i>The soft complaining flute</i> from Ode for St. Cecilia's Day HMV 76</h3>
        <p>We will for sure do the soprano aria with solo flute <i>The soft complaining flute</i>.</p>
        <ul>
          <li><a href="/pdf/2025-2/Handel-The_soft_complaining_flute.pdf">The soft complaining flute - Score</a></li>
        </ul>
             </div>
      <h2> <a href="javascript: history.go(-1)">Back</a></h2>
      <p>&nbsp;</p>
    </div>
  </div>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html>