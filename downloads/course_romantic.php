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
        <li>Dvorak - Symphonic Variations op. 78:</li>
        <span class="yt-core-attributed-string yt-core-attributed-string--white-space-pre-wrap" dir="auto">Timestamps:
          Theme <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=6s" rel="nofollow" target="" force-new-state="true" dir="auto">0:06</a></span>
          Var. 1 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=49s" rel="nofollow" target="" force-new-state="true" dir="auto">0:49</a></span>
          Var. 2 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=84s" rel="nofollow" target="" force-new-state="true" dir="auto">1:24</a></span>
          Var. 3 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=118s" rel="nofollow" target="" force-new-state="true" dir="auto">1:58</a></span>
          Var. 4 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=148s" rel="nofollow" target="" force-new-state="true" dir="auto">2:28</a></span>
          Var. 5 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=178s" rel="nofollow" target="" force-new-state="true" dir="auto">2:58</a></span>
          Var. 6 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=198s" rel="nofollow" target="" force-new-state="true" dir="auto">3:18</a></span>
          Var. 7 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=239s" rel="nofollow" target="" force-new-state="true" dir="auto">3:59</a></span>
          Var. 8 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=270s" rel="nofollow" target="" force-new-state="true" dir="auto">4:30</a></span>
          Var. 9 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=310s" rel="nofollow" target="" force-new-state="true" dir="auto">5:10</a></span>
          Var. 10 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=348s" rel="nofollow" target="" force-new-state="true" dir="auto">5:48</a></span>
          Var. 11 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=371s" rel="nofollow" target="" force-new-state="true" dir="auto">6:11</a></span>
          Var. 12 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=430s" rel="nofollow" target="" force-new-state="true" dir="auto">7:10</a></span>
          Var. 13 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=483s" rel="nofollow" target="" force-new-state="true" dir="auto">8:03</a></span>
          Var. 14 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=512s" rel="nofollow" target="" force-new-state="true" dir="auto">8:32</a></span>
          Var. 15 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=579s" rel="nofollow" target="" force-new-state="true" dir="auto">9:39</a></span>
          Var. 16 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=647s" rel="nofollow" target="" force-new-state="true" dir="auto">10:47</a></span>
          Var. 17 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=669s" rel="nofollow" target="" force-new-state="true" dir="auto">11:09</a></span>
          Var. 18 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=709s" rel="nofollow" target="" force-new-state="true" dir="auto">11:49</a></span>
          Var. 19 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=763s" rel="nofollow" target="" force-new-state="true" dir="auto">12:43</a></span>
          Var. 20 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=809s" rel="nofollow" target="" force-new-state="true" dir="auto">13:29</a></span>
          Var. 21 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=828s" rel="nofollow" target="" force-new-state="true" dir="auto">13:48</a></span>
          Var. 22 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=850s" rel="nofollow" target="" force-new-state="true" dir="auto">14:10</a></span>
          Var. 23 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=878s" rel="nofollow" target="" force-new-state="true" dir="auto">14:38</a></span>
          Var. 24 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=916s" rel="nofollow" target="" force-new-state="true" dir="auto">15:16</a></span>
          Var. 25 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=1025s" rel="nofollow" target="" force-new-state="true" dir="auto">17:05</a></span>
          Var. 26 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=1061s" rel="nofollow" target="" force-new-state="true" dir="auto">17:41</a></span>
          Var. 27 <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=1106s" rel="nofollow" target="" force-new-state="true" dir="auto">18:26</a></span>
          Finale <span class="" dir="auto" style="font-weight: 400;"><a class="yt-core-attributed-string__link yt-core-attributed-string__link--display-type yt-core-attributed-string__link--call-to-action-color" tabindex="0" href="/watch?v=gKKU65NvvCI&amp;t=1150s" rel="nofollow" target="" force-new-state="true" dir="auto">19:10</a></span></span>

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