<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/cursussen.php'; 
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
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.EN.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>
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
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_tagmanager.php'; ?>
<div id="inhoud">
  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/header.EN.php'; ?>
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
        <td class="w3-center uit"><a xxxx="2023-1 daily programme.pdf" target="_blank">Daily program</a></td>
      </tr>
    </table>
    <div class="onzichtbaar">
  <h2>Chamber Choir Repertoire</h2>
      <ul>
        <li><a href="../pdf/2023-1/2023_chamber_choir.pdf" target="_blank">Chamber Choir Repertoire 2023</a> (86 pages)</li>
        <li><a href="https://midi.emjeka.nl/midifiles/kamerkoor2023.html" target="_blank">MIDI practice files</a> (mostly made by former participant Marrie Kardol)</li>
        <li class="onzichtbaar"><a href="https://drive.google.com/drive/folders/1mr8QYstPTyq3yMSyWDBAnjnJyImT8aTb?usp=sharing" target="_blank">MIDI files of the chamber choir repertoire</a>, made by Rob den Heijer</li>
        
      </ul>
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
  <h3>Schubert - Overture in the Italian Style D 591</h3>
  <div class="cols3">
    <ul>
      <li><a href="../pdf/2023-1/Schubert - Overture/SCHUBERT-OVERTURE-Flute_1-2.pdf" target="_blank">Flute I/II</a></li>
      <li><a href="../pdf/2023-1/Schubert - Overture/SCHUBERT-OVERTURE-Oboe_1-2.pdf" target="_blank">Oboe I/II</a></li>
      <li><a href="../pdf/2023-1/Schubert - Overture/SCHUBERT-OVERTURE-Clarinet_1-2.pdf" target="_blank">Clarinet I/II</a></li>
      <li><a href="../pdf/2023-1/Schubert - Overture/SCHUBERT-OVERTURE-Bassoon_1-2.pdf" target="_blank">Bassoon I/II</a></li>
      <li><a href="../pdf/2023-1/Schubert - Overture/SCHUBERT-OVERTURE-Trumpet_1-2.pdf" target="_blank">Trumpet I/II</a></li>
      <li><a href="../pdf/2023-1/Schubert - Overture/SCHUBERT-OVERTURE-Horn_1-2.pdf" target="_blank">Horn I/II</a></li>
      <li><a href="../pdf/2023-1/Schubert - Overture/SCHUBERT-OVERTURE-Timpani.pdf" target="_blank">Timpani</a></li>
      <br>
      <li><a href="../pdf/2023-1/Schubert - Overture/SCHUBERT-OVERTURE-Violins_I.pdf" target="_blank">Violin I (for now without bowings)</a></li>
      <li><a href="../pdf/2023-1/Schubert - Overture/SCHUBERT-OVERTURE-Violins_II.pdf" target="_blank">Violin II (for now without bowings)</a></li>
      <li><a href="../pdf/2023-1/Schubert - Overture/SCHUBERT-OVERTURE-Violas.pdf" target="_blank">Viola (for now without bowings)</a></li>
      <li><a href="../pdf/2023-1/Schubert - Overture/SCHUBERT-OVERTURE-Cellos.pdf" target="_blank">Cello (for now without bowings)</a></li>
      <li><a href="../pdf/2023-1/Schubert - Overture/SCHUBERT-OVERTURE-Basses.pdf" target="_blank">Double bass (for now without bowings)</a></li>
      </ul>
  </div>
  <h3>Schubert - Stabat Mater in g minor</h3>
  <div class="cols3">
    <ul>
      <li><a href="../pdf/2023-1/Schubert - Stabat Mater/Schubert_F_-_Stabat_mater,_D_175_vocal_score.pdf" target="_blank">Vocal score</a> for the choir singers</li>
      <li><a href="../pdf/2023-1/Schubert - Stabat Mater/FS,_Stabat_Mater_-_Oboe_1.pdf" target="_blank">Oboe I</a></li>
      <li><a href="../pdf/2023-1/Schubert - Stabat Mater/FS,_Stabat_Mater_-_Oboe_2.pdf" target="_blank">Oboe II</a></li>
      <li><a href="../pdf/2023-1/Schubert - Stabat Mater/FS,_Stabat_Mater_-_Clarinete_en_Bb_1.pdf" target="_blank">Clarinet I</a></li>
      <li><a href="../pdf/2023-1/Schubert - Stabat Mater/FS,_Stabat_Mater_-_Clarinete_en_Bb_2.pdf" target="_blank">Clarinet II</a></li>
      <li><a href="../pdf/2023-1/Schubert - Stabat Mater/FS,_Stabat_Mater_-_Fagot_1.pdf" target="_blank">Bassoon I</a></li>
      <li><a href="../pdf/2023-1/Schubert - Stabat Mater/FS,_Stabat_Mater_-_Fagot_2.pdf" target="_blank">Bassoon II</a></li>
      <li><a href="../pdf/2023-1/Schubert - Stabat Mater/FS,_Stabat_Mater_-_Trombo-n_1.pdf" target="_blank">Trombone I</a></li>
      <li><a href="../pdf/2023-1/Schubert - Stabat Mater/FS,_Stabat_Mater_-_Trombo-n_2.pdf" target="_blank">Trombone II</a></li>
      <li><a href="../pdf/2023-1/Schubert - Stabat Mater/FS,_Stabat_Mater_-_Trombo-n_3.pdf" target="_blank">Trombone III</a></li>
      <br>
      <li><a href="../pdf/2023-1/Schubert - Stabat Mater/FS,_Stabat_Mater_-_Violi-n_I.pdf" target="_blank">Violin I (for now without bowings)</a></li>
      <li><a href="../pdf/2023-1/Schubert - Stabat Mater/FS,_Stabat_Mater_-_Violi-n_II.pdf" target="_blank">Violin II (for now without bowings)</a></li>
      <li><a href="../pdf/2023-1/Schubert - Stabat Mater/FS,_Stabat_Mater_-_Viola.pdf" target="_blank">Viola (for now without bowings)</a></li>
      <li><a href="../pdf/2023-1/Schubert - Stabat Mater/FS,_Stabat_Mater_-_Violoncello_&_Contrabajo.pdf" target="_blank">Cello/double bass (for now without bowings)</a></li>
      </ul>
  </div>
  <h3>Beethoven - Violin concerto, 1st movement</h3>
  <div class="cols3">
    <ul>
      <li><a href="../pdf/2023-1/Beethoven - Violin Concerto/Beethoven-Op061.Flute.pdf" target="_blank">Flute</a></li>
      <li><a href="../pdf/2023-1/Beethoven - Violin Concerto/Beethoven-Op061.Oboe.pdf" target="_blank">Oboe I/II</a></li>
      <li><a href="../pdf/2023-1/Beethoven - Violin Concerto/Beethoven_VlnConc_Cls.pdf" target="_blank">Clarinet I/II</a></li>
      <li><a href="../pdf/2023-1/Beethoven - Violin Concerto/Beethoven-Op061.Bassoon.pdf" target="_blank">Bassoon I/II</a></li>
      <li><a href="../pdf/2023-1/Beethoven - Violin Concerto/Beethoven-Op061.Trumpet.pdf" target="_blank">Trumpet I/II</a></li>
      <li><a href="../pdf/2023-1/Beethoven - Violin Concerto/Beethoven-Op061.Horn.pdf" target="_blank">Horn I/II</a></li>
      <li><a href="../pdf/2023-1/Beethoven - Violin Concerto/Beethoven-Op061.Timpani.pdf" target="_blank">Timpani</a></li>
      <br>
      <li><a href="../pdf/2023-1/Beethoven - Violin Concerto/Beethoven concerto vln1.pdf" target="_blank">Violin I (with bowings)</a></li>
      <li><a href="../pdf/2023-1/Beethoven - Violin Concerto/Beethoven concerto vln2.pdf" target="_blank">Violin II (with bowings)</a></li>
      <li><a href="../pdf/2023-1/Beethoven - Violin Concerto/Beethoven concerto vla.pdf" target="_blank">Viola (with bowings)</a></li>
      <li><a href="../pdf/2023-1/Beethoven - Violin Concerto/Beethoven concerto vlc.pdf" target="_blank">Cello (with bowings)</a></li>
      <li><a href="../pdf/2023-1/Beethoven - Violin Concerto/Beethoven concerto dbs.pdf" target="_blank">Double bass (with bowings)</a></li>
      </ul>
  </div>
  <h3>Joseph Haydn - 'Spring' from Die Jahreszeiten (The Seasons)</h3>
      <p>Singers can download and print the <a href="../pdf/2023-1/Haydn - Spring/Haydn-Seasons.Piano_reduction.pdf" target="_blank">vocal score</a>, or use any other piano reduction or vocal score they have, as long as they make sure the bar numbering and rehearsal marks corresponds to the Edition Peters numbering. <a href="https://www.cyberbass.org/Major_Works/Haydn_J/haydn_seasons.htm" target="_blank">Practice files for the choral parts can be found here on Cyberbass</a></p>
  <h4>Orchestral parts for Haydn's Spring</h4>
      <div class="cols3">
        <ul>
          <li><a href="../pdf/2023-1/Haydn - Spring/Haydn-Seasons.Flute.pdf" target="_blank">Flute I/II</a></li>
          <li><a href="../pdf/2023-1/Haydn - Spring/Haydn-Seasons.Oboe.pdf" target="_blank">Oboe I/II</a></li>
          <li><a href="../pdf/2023-1/Haydn - Spring/Haydn-Seasons.Clarinet.pdf" target="_blank">Clarinet I/II</a></li>
          <li><a href="../pdf/2023-1/Haydn - Spring/Haydn-Seasons.Bassoon.pdf" target="_blank">Bassoon I/II</a></li>
          <li><a href="../pdf/2023-1/Haydn - Spring/Haydn-Seasons.Trumpet.pdf" target="_blank">Trumpet I/II</a></li>
          <li><a href="../pdf/2023-1/Haydn - Spring/Haydn-Seasons.Horn.pdf" target="_blank">Horn I/II</a></li>
          <li><a href="../pdf/2023-1/Haydn - Spring/Haydn-Seasons.Trombone.pdf" target="_blank">Trombone I/II/III</a></li>
          <li><a href="../pdf/2023-1/Haydn - Spring/Haydn-Seasons.TimpPerc.pdf" target="_blank">Timpani</a></li>
          <br>
          <li><a href="../pdf/2023-1/Haydn - Spring/Haydn Spring vln1.pdf" target="_blank">Violin I (with bowings)</a></li>
          <li><a href="../pdf/2023-1/Haydn - Spring/Haydn Spring vln2.pdf" target="_blank">Violin II (with bowings)</a></li>
          <li><a href="../pdf/2023-1/Haydn - Spring/Haydn Spring vla.pdf" target="_blank">Viola (with bowings)</a></li>
          <li><a href="../pdf/2023-1/Haydn - Spring/Haydn Spring vlc.pdf" target="_blank">Cello &amp; Double Bass (with bowings)</a></li>
          </ul>
      </div>
      <div class="onzichtbaar">
        <p>Excellent recording of Svatá Ludmila (most of 'our' movements, sometimes different cuts) on Spotify to get an impression:</p>
        <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/7mLCuWT7iJQaHHdnrn6d0m?utm_source=generator" width="100%" height="380" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"></iframe>
      </div>
    </div>
  <!-- InstanceEndEditable -->
    <h2> <a href="javascript: history.go(-1)">Back</a></h2>
    <p>&nbsp;</p>
  </div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
</body>
<!-- InstanceEnd --></html>
