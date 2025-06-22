<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/cursussen.php';
$cursusnr = 1 + $cursus_offset; ?>

<!DOCTYPE HTML>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">

  <!-- CSS: -->
  <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">

  <title>Travel info <?php echo $cursussen[$cursusnr]['cursusnaam_en'] ?></title>
  <meta name="robots" content="noindex, nofollow">
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.EN.php'; ?>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
  <link href="/css/pagina_stijlen_algemeen.css" rel="stylesheet" type="text/css">
  <link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
  <style type="text/css">
    h4.nadrukkelijk {
      color: #F03;
    }

    .blok {
      clear: none;
      float: left;
      width: 500px;
    }

    #inhoud #main ul .alles {
      clear: both;
      height: 240px;
    }
  </style>
</head>

<body>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
  <div id="inhoud">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.EN.php'; ?>
    <div id="main">
      <h2><strong><?php echo $cursussen[$cursusnr]['cursusnaam_en'] ?></strong> (<?php echo $cursussen[$cursusnr]['datumkort'] ?>) - all <?php echo $jaar ?> travel information </h2>
      <table width="100%" border="1">
        <tr>
          <th>Travel information</th>
          <th>List of participants</th>
          <th>Chamber music formations</th>
          <th>Room allocation </th>
          <th>Daily program</th>
        </tr>
        <tr>
          <td class="w3-center"><a href="https://www.google.com/maps/d/u/0/edit?mid=1zv5-hN4rGS_fZVT6gYvyPTuxC86MaC0&usp=sharing" target="_blank">Map of České Budějovice, with all venues</a></td>
          <td class="w3-center "><a <a href="../part_list.php?cursus=1" target="_blank">List of participants</a></td>
          <td class="w3-center"><a <a href="../ensemblelijst_1.php" target="_blank">Chamber music formations</a></td>
          <td class="w3-center grijs"><a xxx="https://docs.google.com/spreadsheets/d/e/2PACX-1vT5slBMsznmH15Vxn-ATvg2NtpwgS5Z54GyZ-CMHx9u0GIxOA5NhP5C7yukByBY-aiGbZSIYIrQRwvW/pubhtml?gid=0&single=true" target="_blank">Accommodation overview</a></td>
          <td class="w3-center"><a href="2025-1 daily programme.pdf" target="_blank">Daily program</a></td>
        </tr>
      </table>
      <div class="">
        <h2>Chamber Choir Repertoire</h2>
        <ul>
          <li><a href="../pdf/2025-1/chamberchoir_2025.pdf" target="_blank">Chamber Choir Repertoire 2025</a> (55 pages)</li>
        </ul>
      </div>
      <h2 class="onzichtbaar">Some chamber music works</h2>
      <div>
        <h2>Works for the final concert</h2>
        <h3>Dvořák - Symphonic poem 'The Golden Spinning Wheel' op. 109</h3>
        <p><a href="../pdf/2025-1/Dvorak_op.109_Das_goldene_Spinnrad.pdf" target="_blank">Full score</a></p>
        <div class="cols3">
          <ul>
            <li><a href="../pdf/2025-1/Zlatý_kolovrat_-_Flute_1-2.pdf" target="_blank">Flute I/II</a></li>
            <li><a href="../pdf/2025-1/Zlatý_kolovrat_-_Oboe_1-2,_English_Horn.pdf" target="_blank">Oboe I/II, Cor anglais</a></li>
            <li><a href="../pdf/2025-1/Zlatý_kolovrat_-_Clarinet_1-2.pdf" target="_blank">Clarinet I/II</a></li>
            <li><a href="../pdf/2025-1/Zlatý_kolovrat_-_Bassoon_1-2,_Contrabassoon.pdf" target="_blank">Bassoon I/II, Contrabassoon</a></li>
            <li><a href="../pdf/2025-1/Zlatý_kolovrat_-_Horn_1-4.pdf" target="_blank">Horn I/II/III/IV</a></li>
            <li><a href="../pdf/2025-1/Zlatý_kolovrat_-_Trumpet_1-2.pdf" target="_blank">Trumpet I/II</a></li>
            <li><a href="../pdf/2025-1/Zlatý_kolovrat_-_Trombone_1-3,_Tuba.pdf" target="_blank">Trombones I/II/III, Tuba</a></li>
            <li><a href="../pdf/2025-1/Zlatý_kolovrat_-_Timpani,_Bass_Drum,_Cymbals,_Triangle.pdf" target="_blank">Timpani & other percussion</a></li>
            <li style="break-before: column;"><a href="../pdf/2025-1/Zlatý kolovrat - Violins I - With bowings.pdf" target="_blank">Violin I <b>(with bowings)</b></a></li>
            <li><a href="../pdf/2025-1/Zlatý kolovrat - Violins II - With bowings.pdf" target="_blank">Violin II <b>(with bowings)</b></a></li>
            <li><a href="../pdf/2025-1/Zlaty Kolovrat, viola (with bowings).pdf" target="_blank">Viola <b>(with bowings)</b></a></li>
            <li><a href="../pdf/2025-1/Zlaty Kolovrat, violoncello (with bowings).pdf" target="_blank">Cello <b>(with bowings)</b></a></li>
            <li><a href="../pdf/2025-1/Zlaty Kolovrat, contrabasso (with bowings).pdf" target="_blank">Double bass <b>(with bowings)</b></a></li>
          </ul>
        </div>

        <h3>Joseph Haydn - Missa in Tempore Belli (Paukenmesse)</h3>
        <p><a href="../pdf/2025-1/Haydn_Paukenmesse_-_Conductor_Score.pdf" target="_blank">Full score</a></p>
        <p>Singers can download and print the <a href="../pdf/2025-1/Haydn_Paukenmesse_-_vocal score.pdf" target="_blank">vocal score</a></p>
        <div class="cols3">
          <ul>
            <li><a href="../pdf/2025-1/Haydn_Paukenmesse_-_Flute_solo.pdf" target="_blank">Flute</a></li>
            <li><a href="../pdf/2025-1/Haydn_Paukenmesse_-_Oboe_1-2_(obbligato).pdf" target="_blank">Oboe I/II</a></li>
            <li><a href="../pdf/2025-1/Haydn_Paukenmesse_-_cl 1.pdf" target="_blank">Clarinet I</a></li>
            <li><a href="../pdf/2025-1/Haydn_Paukenmesse_-_cl 2.pdf" target="_blank">Clarinet II</a></li>
            <li><a href="../pdf/2025-1/Haydn_Paukenmesse_-_Bassoon_1-2_(obbligato).pdf" target="_blank">Bassoon I/II</a></li>
            <li><a href="../pdf/2025-1/Haydn_Paukenmesse_-_Horn_1-2_(C).pdf" target="_blank">Horn I/II</a></li>
            <li><a href="../pdf/2025-1/Haydn_Paukenmesse_-_Trumpet-Horn_1-2_(ad_lib.)_(C).pdf" target="_blank">Trumpet I/II</a></li>
            <li><a href="../pdf/2025-1/Haydn_Paukenmesse_-_Timpani.pdf" target="_blank">Timpani</a></li>
            <br>
            <li><a href="../pdf/2025-1/Haydn_Paukenmesse_-_Violins_I_bowings.pdf" target="_blank">Violin I <b>(with bowings)</b></a></li>
            <li><a href="../pdf/2025-1/Haydn_Paukenmesse_-_Violins_II_with_bowings.pdf" target="_blank">Violin II <b>(with bowings)</b></a></li>
            <li><a href="../pdf/2025-1/Haydn - Paukenmesse - viola.pdf" target="_blank">Viola <b>(with bowings)</b></a></li>
            <li><a href="../pdf/2025-1/Haydn Missa in tempore belli HOB XXII.9 cello with bowings.pdf" target="_blank">Cello <b>(with bowings)</b></a></li>
            <li><a href="../pdf/2025-1/Haydn_Paukenmesse_-_Basses.pdf" target="_blank">Double Bass (without bowings, please copy the cello bowings in)</a></li>
            <li><a href="../pdf/2025-1/Haydn_Paukenmesse_-_Conductor_Score.pdf" target="_blank">Full score</a></li>
          </ul>
        </div>
        <p><a href="https://open.spotify.com/playlist/6Q0jeTv8wp11eJyxItIBCB?si=3446d002e0fe45ce" target="_blank">Excellent recordings on Spotify to get an impression of the music</a></p>
        <h2> <a href="javascript: history.go(-1)">Back</a></h2>
        <p>&nbsp;</p>
      </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html>