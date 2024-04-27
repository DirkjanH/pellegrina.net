<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/cursussen.php';
$cursusnr = 1 + $cursus_offset;
?>

<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/LP algemeen EN.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">

  <!-- CSS: -->
  <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">

  <!-- InstanceBeginEditable name="doctitle" -->
  <title>Travel info <?php echo $cursussen[$cursusnr]['cursusnaam_en'] ?></title>
  <meta name="robots" content="noindex, nofollow">
  <!-- InstanceEndEditable -->
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.EN.php'; ?>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
  <link href="/css/pagina_stijlen_algemeen.css" rel="stylesheet" type="text/css">
  <!-- InstanceBeginEditable name="head" -->
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
  <!-- InstanceEndEditable -->
</head>

<body>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
  <div id="inhoud">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.EN.php'; ?>
    <div id="main"> <!-- InstanceBeginEditable name="mainpage" -->
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
          <td class="w3-center"><a href="../part_list.php?cursus=1" target="_blank">List of participants</a></td>
          <td class="w3-center uit"><a xxxx="../ensemblelijst_1.php" target="_blank">Chamber music formations</a></td>
          <td class="w3-center uit"><a xxxx="https://docs.google.com/spreadsheets/d/1bwy8fsIa1gLEtDzFGdV6C9t7NF1YT5km-Bift1fuRIU/edit?usp=sharing" target="_blank">Accommodation overview</a></td>
          <td class="w3-center uit"><a xxxx="2024-1 daily programme.pdf" target="_blank">Daily program</a></td>
        </tr>
      </table>
      <div class="onzichtbaar">
        <h2>Chamber Choir Repertoire</h2>
        <ul>
          <li><a href="../pdf/2024-1/2024_chamber_choir.pdf" target="_blank">Chamber Choir Repertoire 2023</a> (86 pages)</li>
          <li><a href="https://midi.emjeka.nl/midifiles/kamerkoor2023.html" target="_blank">MIDI practice files</a> (mostly made by former participant Marrie Kardol)</li>
          <li class="onzichtbaar"><a href="https://drive.google.com/drive/folders/1mr8QYstPTyq3yMSyWDBAnjnJyImT8aTb?usp=sharing" target="_blank">MIDI files of the chamber choir repertoire</a>, made by Rob den Heijer</li>

        </ul>
      </div>
      <div class="onzichtbaar">
        <h2>Some chamber music works</h2>
        <h4>Pergolesi - Stabat Mater</h4>
        <div class="cols3">
          <ul>
            <li><a href="../pdf/2022-2/Pergolesi/pergolesi_sm_vln.I.pdf" target="_blank">Violin I</a></li>
            <li><a href="../pdf/2022-2/Pergolesi/pergolesi_sm_vln.II.pdf" target="_blank">Violin II</a></li>
            <li><a href="../pdf/2022-2/Pergolesi/pergolesi_sm_vla.pdf" target="_blank">Viola</a></li>
            <li><a href="../pdf/2022-2/Pergolesi/pergolesi_sm_vc.pdf" target="_blank">Cello/double bass</a></li>
            <li><a href="../pdf/2022-2/Pergolesi/pergolesi_sm_BC.pdf" target="_blank">Basso continuo</a></li>
          </ul>
        </div>
      </div>
      <h2>Works for the final concert</h2>
      <h3>Dvořák - Symphonic Variations op. 87</h3>
      <div class="cols3">
        <ul>
          <li><a href="../pdf/2024-1/sym-var/DVORAK_-_SYMPHONIC_VARIATIONS,_OP._78_(BARTOS)_-_Flute_1-2.pdf" target="_blank">Flute I/II</a></li>
          <li><a href="../pdf/2024-1/sym-var/DVORAK_-_SYMPHONIC_VARIATIONS,_OP._78_(BARTOS)_-_Oboe_1-2.pdf" target="_blank">Oboe I/II</a></li>
          <li><a href="../pdf/2024-1/sym-var/DVORAK_-_SYMPHONIC_VARIATIONS,_OP._78_(BARTOS)_-_Clarinet_1-2.pdf" target="_blank">Clarinet I/II</a></li>
          <li><a href="../pdf/2024-1/sym-var/DVORAK_-_SYMPHONIC_VARIATIONS,_OP._78_(BARTOS)_-_Bassoon_1-2.pdf" target="_blank">Bassoon I/II</a></li>
          <li><a href="../pdf/2024-1/sym-var/DVORAK_-_SYMPHONIC_VARIATIONS,_OP._78_(BARTOS)_-_Horn_1-4.pdf" target="_blank">Horn I/II/III/IV</a></li>
          <li><a href="../pdf/2024-1/sym-var/DVORAK_-_SYMPHONIC_VARIATIONS,_OP._78_(BARTOS)_-_Trumpet_1-2.pdf" target="_blank">Trumpet I/II</a></li>
          <li><a href="../pdf/2024-1/sym-var/DVORAK_-_SYMPHONIC_VARIATIONS,_OP._78_(BARTOS)_-_Trombone_1-3.pdf" target="_blank">Trombones I/II/III</a></li>
          <li><a href="../pdf/2024-1/sym-var/DVORAK_-_SYMPHONIC_VARIATIONS,_OP._78_(BARTOS)_-_Timpani.pdf" target="_blank">Timpani</a></li>
          <br>
          <li><a href="../pdf/2024-1/sym-var/Dvorak - Symphonic variations vln I._betekend.pdf" target="_blank">Violin I</a></li>
          <li><a href="../pdf/2024-1/sym-var/Dvorak - Symphonic variations vln II._betekend.pdf" target="_blank">Violin II</a></li>
          <li><a href="../pdf/2024-1/sym-var/Dvorak - Symphonic variations vla._betekend.pdf" target="_blank">Viola</a></li>
          <li><a href="../pdf/2024-1/sym-var/Dvorak - Symphonic variations vlc._betekend.pdf" target="_blank">Cello</a></li>
          <li><a href="../pdf/2024-1/sym-var/Dvorak - Symphonic variations cbs._betekend.pdf" target="_blank">Double bass</a></li>
          <br>
          <li><a href="../pdf/2024-1/sym-var/DVORAK_-_SYMPHONIC_VARIATIONS,_OP._78_(BARTOS)_-_Conductor_Score.pdf" target="_blank">Full score</a></li>
        </ul>
      </div>

      <h3>Anton Reicha - Messe des Morts (Requiem) in d</h3>
      <p>Singers can download and print the <a href="../pdf/2024-1/Reicha/Reicha-Requiem_vocal_score.pdf" target="_blank">vocal score</a></p>
      <h4>Orchestral parts for Haydn's Spring</h4>
      <div class="cols3">
        <ul>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-flute_1.pdf.pdf" target="_blank">Flute I</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-flute_2.pdf.pdf" target="_blank">Flute II</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-oboe_1.pdf" target="_blank">Oboe I</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-oboe_2.pdf" target="_blank">Oboe II</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-clarinet_1.pdf" target="_blank">Clarinet I</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-clarinet_2.pdf" target="_blank">Clarinet II</a></li>
          <li><a href="../pdf/2024-1/Reicha/HReicha-Requiem-bassoon_1.pdf" target="_blank">Bassoon I</a></li>
          <li><a href="../pdf/2024-1/Reicha/HReicha-Requiem-bassoon_2.pdf" target="_blank">Bassoon II</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-horn_1.pdf" target="_blank">Horn I</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-horn_2.pdf" target="_blank">Horn II</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-trumpet_1-3.pdf" target="_blank">Trumpet I/II/III</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-trombone_1.pdf" target="_blank">Trombone I</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-trombone_2.pdf" target="_blank">Trombone II</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-trombone_3.pdf" target="_blank">Trombone III</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-timpani.pdf" target="_blank">Timpani</a></li>
          <br>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-violin_1.pdf" target="_blank">Violin I (for now without bowings)</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-violin_2.pdf" target="_blank">Violin II (for now without bowings)</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-viola.pdf" target="_blank">Viola (for now without bowings)</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-cello.pdf" target="_blank">Cello (for now without bowings)</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-contrabass.pdf" target="_blank">Double Bass (for now without bowings)</a></li>
        </ul>
      </div>
      <p>Excellent recordings to get an impression:</p>
      <ul>
        <li><a href="https://www.youtube.com/watch?v=_pjcxtPbXrc&list=PLyciOZYqFmnLUwQEHGiqrC7rVWTr9ZLhY" target="_blank">Reicha's Requiem on Youtube</a></li>
        <li>Dvorak - Symphonic Variations op. 78:<br>
          Sections:<br>
          Theme <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=6s">0:06</a>
          Var. 1 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=49s">0:49</a>
          Var. 2 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=84s">1:24</a>
          Var. 3 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=118s">1:58</a>
          Var. 4 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=148s">2:28</a>
          Var. 5 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=178s">2:58</a>
          Var. 6 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=198s">3:18</a>
          Var. 7 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=239s">3:59</a>
          Var. 8 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=270s">4:30</a>
          Var. 9 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=310s">5:10</a>
          Var. 10 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=348s">5:48</a>
          Var. 11 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=371s">6:11</a>
          Var. 12 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=430s">7:10</a>
          Var. 13 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=483s">8:03</a>
          Var. 14 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=512s">8:32</a>
          Var. 15 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=579s">9:39</a>
          Var. 16 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=647s">10:47</a>
          Var. 17 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=669s">11:09</a>
          Var. 18 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=709s">11:49</a>
          Var. 19 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=763s">12:43</a>
          Var. 20 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=809s">13:29</a>
          Var. 21 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=828s">13:48</a>
          Var. 22 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=850s">14:10</a>
          Var. 23 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=878s">14:38</a>
          Var. 24 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=916s">15:16</a>
          Var. 25 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=1025s">17:05</a>
          Var. 26 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=1061s">17:41</a>
          Var. 27 <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=1106s">18:26</a>
          Finale <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=1150s">19:10</a>
        </li>

      </ul>

      <!-- InstanceEndEditable -->
      <h2> <a href="javascript: history.go(-1)">Back</a></h2>
      <p>&nbsp;</p>
    </div>
  </div>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>
<!-- InstanceEnd -->

</html>