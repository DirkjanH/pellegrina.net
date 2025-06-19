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
          <td class="w3-center"><a href="https://pellegrina.net/ensemblelijst_2.php" target="_blank">Chamber music ensembles</a></td>
          <td class="w3-center grijs"><a xxxx="https://docs.google.com/spreadsheets/d/1JCygZZvuBPAWIkfGGGChLMXQSNA34EkRP9tYArxD5LI/edit?usp=sharing" target="_blank">Overview of accommodation</a></td>
          <td class="w3-center"><a href="https://docs.google.com/document/d/1ODcgAmuTYIfNC9DKLaU0f6zed2uJvaJ6aoiIGp2Sb1A/edit?usp=sharing" target="_blank">Accommodation near Nieuw Sion</a></td>
          <td class="w3-center"><a href="https://docs.google.com/document/d/e/2PACX-1vR0BKIajpm4-nOAroibUrQvxcH3--ygr9AV_fK2kCJnBLBMadigy9w5p-DBcYMNZQjJKQyZ0Nf9Jo-S/pub" target="_blank">Daily program</a></td>
          <td class="w3-center grijs"><a xxxx="LP2024-2 Vivaldi FLYER.pdf" target="_blank">Flyer concert</a></td>
        </tr>
      </table>
      <div class="onzichtbaar">
        <h2>Some chamber music works</h2>
        <p>Most chamber music works are available on the <a href="https://imslp.org/" target="_blank">International Music Score Library Project (IMSLP)</a> or the <a href="https://www.cpdl.org/" target="_blank">Choral Public Domain Library (CPDL)</a>. Only works that are not generally available are listed below.</p>
        <h4>Domenico Scarlatti - Salve Regina (set 2 nr. 2)</h4>
        <li><a href="/pdf/2025-2/Scarlatti D. - Salve Regina/ScarlattiD-SalveRegina-(S,A,Streicher,Orgel).pdf" target="_blank">Full score</a></li>
        <li><a href="/pdf/2025-2/Scarlatti D. - Salve Regina/ScarlattiD-SalveRegina-Violine1.pdf" target="_blank">Violin 1</a></li>
        <li><a href="/pdf/2025-2/Scarlatti D. - Salve Regina/ScarlattiD-SalveRegina-Violine2.pdf" target="_blank">Violin 2</a></li>
        <li><a href="/pdf/2025-2/Scarlatti D. - Salve Regina/ScarlattiD-SalveRegina-Viola.pdf" target="_blank">Viola</a></li>
        <li><a href="/pdf/2025-2/Scarlatti D. - Salve Regina/ScarlattiD-SalveRegina-Cello-Bass.pdf" target="_blank">Cello</a></li>
      </div>
      <h2>Tutti programme</h2>
      <p>All works we are going to perform are now available here. Please print and study what you need. The string parts will soon have bowings; string players will be notified.</p>
      <p>Singers, please print out the vocal scores and bring them with you. Study the choral parts as well as your solo parts.</p>
      <h4>Purcell - Welcome to all the pleasures (Z.339)</h4>
      <p>We will perform this Cecilia Ode in its entirety.</p>
      <ul>
        <li><a href="/pdf/2025-2/Purcell - Welcome - score.pdf" target="_blank">Purcell - Welcome to all the pleasures (Z.339) - Full score</a></li>
        <li><a href="/pdf/2025-2/Purcell - Welcome - Vocal score.pdf" target="_blank">Purcell - Welcome to all the pleasures (Z.339) - Vocal score</a></li>
        <li><a href="/pdf/2025-2/Purcell - Welcome - Violin 1.pdf" target="_blank">Purcell - Welcome to all the pleasures (Z.339) - Violin 1</a></li>
        <li><a href="/pdf/2025-2/Purcell - Welcome - Violin 2.pdf" target="_blank">Purcell - Welcome to all the pleasures (Z.339) - Violin 2</a></li>
        <li><a href="/pdf/2025-2/Purcell - Welcome - Viola.pdf" target="_blank">Purcell - Welcome to all the pleasures (Z.339) - Viola</a></li>
        <li><a href="/pdf/2025-2/Purcell - Welcome - Cello-Bass.pdf" target="_blank">Purcell - Welcome to all the pleasures (Z.339) - Cello, bass, bassoon</a></li>
        <li><a href="/pdf/2025-2/Purcell - Welcome - Figured Bass.pdf" target="_blank">Purcell - Welcome to all the pleasures (Z.339) - Figured bass</a></li>
        <li><a href="/pdf/2025-2/Purcell - Welcome - BC realisation.pdf" target="_blank">Purcell - Welcome to all the pleasures (Z.339) - BC realisation</a></li>
      </ul>
      <h4>Handel - Pastiche of movements from Handel's Utrecht Te Deum & Jubilate and Ode for St. Cecilia's Day</h4>
      <p>We have made a pastiche of movements from the Utrecht Te Deum and Jubilate and the Ode for St. Cecilia's Day, whch is adapted to the instruments and voices we have during the summer school. At this moment only the score is available. Soon we will add the vocal score and all instrumental parts needed.</p>
      <ul>
        <li><a href="/pdf/2025-2/Handel - Pastiche - score.pdf" target="_blank">Handel - Pastiche - Full score</a></li>
        <li><a href="/pdf/2025-2/Handel - Pastiche - vocal score.pdf" target="_blank">Handel - Pastiche - Vocal score (in modern clefs)</a></li>
        <li><a href="/pdf/2025-2/Handel - Pastiche - flute.pdf" target="_blank">Handel - Pastiche - Flute</a></li>
        <li><a href="/pdf/2025-2/Handel - Pastiche - oboe 1.pdf" target="_blank">Handel - Pastiche - Oboe 1</a></li>
        <li><a href="/pdf/2025-2/Handel - Pastiche - oboe 2.pdf" target="_blank">Handel - Pastiche - Oboe 2</a></li>
        <li><a href="/pdf/2025-2/Handel - Pastiche - bassoon.pdf" target="_blank">Handel - Pastiche - Bassoon</a></li>
        <li><a href="/pdf/2025-2/Handel - Pastiche - violin 1.pdf" target="_blank">Handel - Pastiche - Violin 1</a></li>
        <li><a href="/pdf/2025-2/Handel - Pastiche - violin 2.pdf" target="_blank">Handel - Pastiche - Violin 2</a></li>
        <li><a href="/pdf/2025-2/Handel - Pastiche - viola.pdf" target="_blank">Handel - Pastiche - Viola</a></li>
        <li><a href="/pdf/2025-2/Handel - Pastiche - cello-bass.pdf" target="_blank">Handel - Pastiche - Cello & Double bass</a></li>
      </ul>
      <h4>Purcell - selection from Hail, bright Cecilia (Z.328)</h4>
      <p>We will perform only a few movements of this Cecilia Ode. The score and the parts only contain those movements.</p>
      <ul>
        <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia_score.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Score</a></li>
        <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Vocal_score.pdf" _blank">Purcell - Hail! Bright Cecilia - Vocal score</a></li>
        <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Oboe_1.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Oboe 1</a></li>
        <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Oboe_2.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Oboe 2</a></li>
        <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Recorder_1.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Recorder 1</a></li>
        <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Recorder_2.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Recorder 2</a></li>
        <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Bassoon.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Bassoon</a></li>
        <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Violin_1.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Violin 1</a></li>
        <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Violin_2.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Violin 2</a></li>
        <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Viola.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Viola</a></li>
        <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Harpsichord.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Harpsichord</a></li>
        <li><a href="/pdf/2025-2/Purcell_Hail!_Bright_Cecilia-Continuo.pdf" target="_blank">Purcell - Hail! Bright Cecilia - Cello, double bass</a></li>

      </ul>
    </div>
    <h2> <a href="javascript: history.go(-1)">Back</a></h2>
    <p>&nbsp;</p>
  </div>
  </div>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html>