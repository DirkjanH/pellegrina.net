<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/cursussen.php';
$cursusnr = 1 + $cursus_offset; ?>

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
          <td class="w3-center"><a href="../ensemblelijst_1.php" target="_blank">Chamber music formations</a></td>
          <td class="w3-center uit"><a xxxx="https://docs.google.com/spreadsheets/d/1bwy8fsIa1gLEtDzFGdV6C9t7NF1YT5km-Bift1fuRIU/edit?usp=sharing" target="_blank">Accommodation overview</a></td>
          <td class="w3-center uit"><a xxxx="2024-1 daily programme.pdf" target="_blank">Daily program</a></td>
        </tr>
      </table>
      <div>
        <h2>Chamber Choir Repertoire</h2>
        <ul>
          <li><a href="../pdf/2024-1/chamberchoir_2024.pdf" target="_blank">Chamber Choir Repertoire 2024</a> (46 pages)</li>
          <li class="onzichtbaar"><a href="https://midi.emjeka.nl/midifiles/kamerkoor2023.html" target="_blank">MIDI practice files</a> (mostly made by former participant Marrie Kardol)</li>
          <li class="onzichtbaar"><a href="https://drive.google.com/drive/folders/1mr8QYstPTyq3yMSyWDBAnjnJyImT8aTb?usp=sharing" target="_blank">MIDI files of the chamber choir repertoire</a>, made by Rob den Heijer</li>

        </ul>
      </div>
      <h2>Some chamber music works</h2>
      <h4>Jadassohn - Serenade for Flute and Strings op.80</h4>
      <div class="cols2">
        <ul>
          <li><a href="../pdf/2024-1/Jadassohn/Serenade for Flute and Strings op.80 - flute.pdf">Jadassohn - Serenade for Flute and Strings op.80 - flute</a></li>
          <li><a href="../pdf/2024-1/Jadassohn/Serenade for Flute and Strings op.80 - violino I.pdf">Jadassohn - Serenade for Flute and Strings op.80 - violino I</a></li>
          <li><a href="../pdf/2024-1/Jadassohn/Serenade for Flute and Strings op.80 - violino II.pdf">Jadassohn - Serenade for Flute and Strings op.80 - violino II</a></li>
          <li><a href="../pdf/2024-1/Jadassohn/Serenade for Flute and Strings op.80 - viola.pdf">Jadassohn - Serenade for Flute and Strings op.80 - viola</a></li>
          <li><a href="../pdf/2024-1/Jadassohn/Serenade for Flute and Strings op.80 - cello.pdf">Jadassohn - Serenade for Flute and Strings op.80 - cello</a></li>
          <li><a href="../pdf/2024-1/Jadassohn/Serenade for Flute and Strings op.80 - double bass.pdf">Jadassohn - Serenade for Flute and Strings op.80 - double bass</a></li>
        </ul>
      </div>
      <div class="onzichtbaar">
        <h4 class="onzichtbaar">Pergolesi - Stabat Mater</h4>
        <ul>
          <li><a href="../pdf/2022-2/Pergolesi/pergolesi_sm_vln.I.pdf" target="_blank">Violin I</a></li>
          <li><a href="../pdf/2022-2/Pergolesi/pergolesi_sm_vln.II.pdf" target="_blank">Violin II</a></li>
          <li><a href="../pdf/2022-2/Pergolesi/pergolesi_sm_vla.pdf" target="_blank">Viola</a></li>
          <li><a href="../pdf/2022-2/Pergolesi/pergolesi_sm_vc.pdf" target="_blank">Cello/double bass</a></li>
          <li><a href="../pdf/2022-2/Pergolesi/pergolesi_sm_BC.pdf" target="_blank">Basso continuo</a></li>
        </ul>
      </div>
      <h2>Works for the final concert</h2>
      <h3>Dvořák - Symphonic Variations op. 87</h3>
      <p><a href="../pdf/2024-1/sym-var/DVORAK_-_SYMPHONIC_VARIATIONS,_OP._78_(BARTOS)_-_Conductor_Score.pdf" target="_blank">Full score</a></p>
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
        </ul>
      </div>

      <h3>Anton Reicha - Messe des Morts (Requiem)</h3>
      <p>Singers can download and print the <a href="../pdf/2024-1/Reicha/Reicha-Requiem_vocal_score.pdf" target="_blank">vocal score</a></p>
      <p>Tenors can here download a recording of the fugues of the Requiem and Cum sanctis (from p. 146) with their part emphasized with piano, made by Anja Kwakkestein. There are two versions:</p>
      <ol>
        <li><a href="\MP3\Reicha deel Requiem en Cum Sanctis vanaf blz 146.mp3">Practice file tenor Requiem and Cum Sanctis from page 146, full tempo</a></li>
        <li><a href="\MP3\Reicha%20deel%20Requiem%20en%20Cum%20Sanctis%20vanaf%20blz%20146%2075%25.mp3">Practice file tenor Requiem and Cum Sanctis from page 146, slowed down to 75 % of the full tempo</li>
        <li><a href="\MP3\Quam Olim Abrahae, Reicha Requiem tenor.mp3">Practice file tenor Quam olim Abrahae, from page 89 and page 108, full tempo</a></li>
      </ol>
      <div class="cols3">
        <ul>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-flute_1.pdf" target="_blank">Flute I</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-flute_2.pdf" target="_blank">Flute II</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-oboe_1.pdf" target="_blank">Oboe I</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-oboe_2.pdf" target="_blank">Oboe II</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-clarinet_1.pdf" target="_blank">Clarinet I</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-clarinet_2.pdf" target="_blank">Clarinet II</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-bassoon_1.pdf" target="_blank">Bassoon I</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-bassoon_2.pdf" target="_blank">Bassoon II</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-horn_1.pdf" target="_blank">Horn I</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-horn_2.pdf" target="_blank">Horn II</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-trumpet_1-3.pdf" target="_blank">Trumpet I/II/III</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-trombone_1.pdf" target="_blank">Trombone I</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-trombone_2.pdf" target="_blank">Trombone II</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-trombone_3.pdf" target="_blank">Trombone III</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-timpani.pdf" target="_blank">Timpani</a></li>
          <br>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-violin_1.pdf" target="_blank">Violin I (with bowings)</a></li>
          <li><a href="../pdf/2024-1/Reicha/Reicha-Requiem-violin_2.pdf" target="_blank">Violin II (with bowings)</a></li>
          <li><a href="../pdf/2024-1/Reicha/A.Reicha - Requiem - viola.pdf" target="_blank">Viola (with bowings)</a></li>
          <li><a href="../pdf/2024-1/Reicha/A.Reicha - Requiem - violoncello.pdf" target="_blank">Cello (with bowings)</a></li>
          <li><a href="../pdf/2024-1/Reicha/A.Reicha - Requiem - doublebass.pdf" target="_blank">Double Bass (with bowings)</a></li>
        </ul>
      </div>
      <p>Excellent recordings to get an impression:</p>
      <ul>
        <li><a href="https://www.youtube.com/watch?v=_pjcxtPbXrc&list=PLyciOZYqFmnLUwQEHGiqrC7rVWTr9ZLhY" target="_blank">Reicha's Requiem on Youtube</a> (Dvorak Chamber Orchestra -
          Prague Philharmonic Choir - Lubomir Matl, cond.)</li>
        <li>Dvorak - Symphonic Variations op. 78 - BBC Symphony Orchestra conducted by Jiří Bělohlávek - with the full score:<br>
          <div class="cols3">
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=6s">Theme - 0:06</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=49s">Var. 1 - 0:49</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=84s">Var. 2 - 1:24</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=118s">Var. 3 - 1:58</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=148s">Var. 4 - 2:28</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=178s">Var. 5 - 2:58</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=198s">Var. 6 - 3:18</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=239s">Var. 7 - 3:59</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=270s">Var. 8 - 4:30</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=310s">Var. 9 - 5:10</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=348s">Var. 10 - 5:48</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=371s">Var. 11 - 6:11</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=430s">Var. 12 - 7:10</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=483s">Var. 13 - 8:03</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=512s">Var. 14 - 8:32</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=579s">Var. 15 - 9:39</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=647s">Var. 16 - 10:47</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=669s">Var. 17 - 11:09</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=709s">Var. 18 - 11:49</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=763s">Var. 19 - 12:43</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=809s">Var. 20 - 13:29</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=828s">Var. 21 - 13:48</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=850s">Var. 22 - 14:10</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=878s">Var. 23 - 14:38</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=916s">Var. 24 - 15:16</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=1025s">Var. 25 - 17:05</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=1061s">Var. 26 - 17:41</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=1106s">Var. 27 - 18:26</a></br>
            <a target="_blank" href="https://www.youtube.com/watch?v=gKKU65NvvCI&amp;t=1150s">Finale - 19:10</a>
          </div>
        </li>
      </ul>
      <h2> <a href="javascript: history.go(-1)">Back</a></h2>
      <p>&nbsp;</p>
    </div>
  </div>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html>