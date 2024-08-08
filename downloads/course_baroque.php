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
          <td class="w3-center"><a href="https://docs.google.com/spreadsheets/d/1JCygZZvuBPAWIkfGGGChLMXQSNA34EkRP9tYArxD5LI/edit?usp=sharing" target="_blank">Overview of accommodation</a></td>
          <td class="w3-center"><a href="https://docs.google.com/document/d/1ODcgAmuTYIfNC9DKLaU0f6zed2uJvaJ6aoiIGp2Sb1A/edit?usp=sharing" target="_blank">Accommodation near Nieuw Sion</a></td>
          <td class="w3-center"><a href="https://docs.google.com/document/d/1IpHquLhJ4NAdDyNHhrhLk_IQGsoXs4FEMSDAqoYFatc/pub" target="_blank">Daily program</a></td>
          <td class="w3-center"><a href="D:\Dropbox\GitHub\pellegrina.net\downloads\LP2024-2 Vivaldi FLYER.pdf" target="_blank">Flyer concert</a></td>
        </tr>
      </table>
      <h2><?php echo $cursussen[$cursusnr]['cursusnaam_en'] ?> (<?php echo $cursussen[$cursusnr]['datumkort'] ?>) - information & scores<br />
      </h2>
      <div class="">
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
      <p>All parts for the works we are going to perform are now available. Please print and study what you need. Singers, please print, study and bring the vocal score. The string parts have no bowings yet. They will be available soon.</p>
      <h3>Vivaldi - Domine ad adjuvandum me festina RV 593</h3>
      <ul>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Full Score.pdf" target="_blank">Vivaldi-Domine_ad_adjuvandum - Full Score with extra bars in Gloria Patri</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Full Score WITH BOWINGS.pdf" target="_blank">Vivaldi-Domine_ad_adjuvandum - Full Score with bowings</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Vocal score.pdf" target="_blank">Vivaldi-Domine_ad_adjuvandum - Vocal score</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Violin 1-I.pdf" target="_blank">Vivaldi-Domine_ad_adjuvandum - Violin 1-I</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Violin 1-II.pdf" target="_blank">Vivaldi-Domine_ad_adjuvandum - Violin 1-II</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Viola 1.pdf" target="_blank">Vivaldi-Domine_ad_adjuvandum - Viola + gamba 1</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Violin 2-I.pdf" target="_blank">Vivaldi-Domine_ad_adjuvandum - Violin 2-I</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Violin 2-II.pdf" target="_blank">Vivaldi-Domine_ad_adjuvandum - Violin 2-II</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Viola 2.pdf" target="_blank">Vivaldi-Domine_ad_adjuvandum - Viola + gamba 2</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Cello & double bass 1-2.pdf" target="_blank">Vivaldi-Domine_ad_adjuvandum - Cello, gamba & double bass 1-2</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - BC 1.pdf" target="_blank">Vivaldi-Domine_ad_adjuvandum - BC 1</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - BC 2.pdf" target="_blank">Vivaldi-Domine_ad_adjuvandum - BC 2</a></li>
      </ul>
      <h4>Division of the voices over choir 1 and 2 in movement 1:</h4>
      <table border="1" cellpadding="10px">
        <thead>
          <th class="s0" dir="ltr">Choir 1</th>
          <th class="s0" dir="ltr">Choir 2</th>
        </thead>
        <tbody>
          <tr style="height: 20px">
            <td class="s1">Tanja van der Brugge, soprano</td>
            <td class="s1">Angela Morsink, soprano</td>
          </tr>
          <tr style="height: 20px">
            <td class="s1">Anne Hodgkinson, soprano</td>
            <td class="s1">Joyce Vermeer, soprano</td>
          </tr>
          <tr style="height: 20px">
            <td class="s1">Anke Muusse, soprano</td>
            <td class="s1">Sandra Sjamaar, soprano</td>
          </tr>
          <tr style="height: 20px">
            <td class="s1">Patti Kimberly Cobb, mezzosoprano</td>
            <td class="s1">Vivian Stemerdink, mezzosoprano</td>
          </tr>
          <tr style="height: 20px">
            <td></td>
            <td class="s1">Birthe Rubehn, mezzosoprano</td>
          </tr>
          <tr style="height: 20px">
            <td class="s1">Marleen van Reenen, alto</td>
            <td class="s1">Tonnie Sedee - de Wit, alto</td>
          </tr>
          <tr style="height: 20px">
            <td class="s1">Joost Fransen, tenor</td>
            <td class="s1">René Jakobs, tenor</td>
          </tr>
          <tr style="height: 20px">
            <td class="s1">Piet Schipper, tenor</td>
            <td></td>
          </tr>
          <tr style="height: 20px">
            <td class="s1">Martin van Tulder, baritone</td>
            <td class="s1">Jurgen van der Ent, baritone</td>
          </tr>
          <tr style="height: 20px">
            <td class="s1">Frits Muusse, bass</td>
            <td class="s1">Mitchell Sandler, bass?</td>
          </tr>
        </tbody>
      </table>
      <h5>NB: in movement 3 both choir parts are identical, so choir 2 also sings what is indicated as 'koor 1'. So only the first movement is for double choir.</h5>
      <h4>Division of the string players over orchestra 1 and 2 in movement 1 and 3 (gambas play in the orchestra as well):</h4>
      <table border="1" cellpadding="10px">
        <tr>
          <td>
            <h5>Orchestra I:</h5>
            <p>Femke Huizinga, violin I<br>
              Lea Schuiling, violin I<br>
              Eliane Heldring, violin II<br>
              Ineke Huizinga, violin II<br>
              Corinne Britzel, viola<br>
              Stephanie Helfferich, viola da gamba (= viola)<br>
              Hannah Wapenaar, viola da gamba (= bas)</p>
          </td>
          <td>
            <h5>Orchestra II:</h5>
            <p>Jet Bensdorp, violin I<br>
              Julia (Sut Keng) Taylor, violin I<br>
              Birgit Apfelbaum, violin II<br>
              Hans-Joachim Bieber, violin II<br>
              Renske Ligtmans, viola<br>
              Tanja van de Ketterij, viola da gamba (= viola)<br>
              D&eacute;sir&eacute;e Staverman, viola da gamba (= bas)</p>
          </td>
        </tr>
      </table>
      <h3>Vivaldi - Confitebor RV 596</h3>
      <ul>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi - Confitebor RV 596/Vivaldi - Confitebor RV 596 - score WITH BOWINGS.pdf" target="_blank">Vivaldi - Confitebor RV 596 - Score with bowings</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi - Confitebor RV 596/Vivaldi - Confitebor RV 596 - vocal score.pdf" target="_blank">Vivaldi - Confitebor RV 596 - Vocal score</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi - Confitebor RV 596/Vivaldi - Confitebor RV 596 - oboe 1.pdf" target="_blank">Vivaldi - Confitebor RV 596 - Oboe 1</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi - Confitebor RV 596/Vivaldi - Confitebor RV 596 - oboe 2.pdf" target="_blank">Vivaldi - Confitebor RV 596 - Oboe 2</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi - Confitebor RV 596/Vivaldi - Confitebor RV 596 - violino 1.pdf" target="_blank">Vivaldi - Confitebor RV 596 - Violino 1 + flauto</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi - Confitebor RV 596/Vivaldi - Confitebor RV 596 - violino 2.pdf" target="_blank">Vivaldi - Confitebor RV 596 - Violino 2</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi - Confitebor RV 596/Vivaldi - Confitebor RV 596 - viola.pdf" target="_blank">Vivaldi - Confitebor RV 596 - Viola</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi - Confitebor RV 596/Vivaldi - Confitebor RV 596 - bass.pdf" target="_blank">Vivaldi - Confitebor RV 596 - Cello, double bass, bassoon</a></li>
      </ul>
      <h3>Monteverdi - Cantate Domino a 2</h3>
      <ul>
        <li><a href="https://pellegrina.net/pdf/2024-2/Monteverdi - Cantate Domino a 2/Monteverdi - Cantate Domino a 2.pdf" target="_blank">Monteverdi - Cantate Domino a 2 - Score</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Monteverdi - Cantate Domino a 2/Monteverdi_Cantate Domino à 2, SV 292_SS or TT+bc_02PV MS362.pdf" target="_blank">Monteverdi - Cantate Domino a 2 - SS + BC</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Monteverdi - Cantate Domino a 2/Monteverdi_Cantate Domino à 2, SV 292_SS or TT+bc_02PV MS362-Cello,_B.C._(+score).pdf" target="_blank">Monteverdi - Cantate Domino a 2 - cello + BC</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Monteverdi - Cantate Domino a 2/Monteverdi_Cantate Domino à 2, SV 292_SS or TT+bc_02PV MS362-Partituur_en_partijen.pdf" target="_blank">Monteverdi - Cantate Domino a 2 - score + parts</a></li>
      </ul>
      <h3>Galuppi - Laetatus sum</h3>
      <ul>
        <li><a href="https://pellegrina.net/pdf/2024-2/Galuppi - Laetatus sum/Galuppi-Laetatus_sum_in_A-partitura.pdf" target="_blank">Galuppi-Laetatus_sum_in_A - Full score with bowings</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Galuppi - Laetatus sum/Galuppi-Laetatus_sum_in_A-voci_e_bc.pdf" target="_blank">Galuppi-Laetatus_sum_in_A - Vocal score</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Galuppi - Laetatus sum/Galuppi-Laetatus_sum_in_A-violino_1.pdf" target="_blank">Galuppi-Laetatus_sum_in_A - Flauto/oboe/violini 1</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Galuppi - Laetatus sum/Galuppi-Laetatus_sum_in_A-violino_2.pdf" target="_blank">Galuppi-Laetatus_sum_in_A - Flauto/oboe/violini 2</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Galuppi - Laetatus sum/Galuppi-Laetatus_sum_in_A-viola.pdf" target="_blank">Galuppi-Laetatus_sum_in_A - Viola</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Galuppi - Laetatus sum/Galuppi-Laetatus_sum_in_A-bc.pdf" target="_blank">Galuppi-Laetatus_sum_in_A - Basso continuo</a></li>
      </ul>
      <h3>Caldara - Caro mea vere est cibus a 2</h3>
      <ul>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara_Caro_mea_vere/Caldara_Caro mea vere est cibus, à 2_SS+bc_02PV MS362.pdf" target="_blank">Caldara - Caro mea vere est cibus a 2 - soprani + BC</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara_Caro_mea_vere/Caldara_Caro mea vere est cibus, à 2_SS+bc_02PV MS362-Cello,_B.C..pdf" target="_blank">Caldara - Caro mea vere est cibus a 2 - Cello</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara_Caro_mea_vere/Caldara_Caro mea vere est cibus, à 2_SS+bc_02PV MS362-Cello,_B.C._(+score).pdf" target="_blank">Caldara - Caro mea vere est cibus a 2 - cello + score</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara_Caro_mea_vere/Caldara_Caro mea vere est cibus, à 2_SS+bc_02PV MS362-Cello,_B.C..pdf" target="_blank">Caldara - Caro mea vere est cibus a 2 - cello + BC</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara_Caro_mea_vere/Caldara_Caro mea vere est cibus, à 2_SS+bc_02PV MS362-Partituur_en_partijen.pdf" target="_blank">Caldara - Caro mea vere est cibus a 2 - score + parts</a></li>
      </ul>
      <h3>Vivaldi - Cum dederit from Nisi Dominus RV 608</h3>
      <ul>
        <li><a href="https://pellegrina.net/pdf/2024-2/Nisi Dominus RV 608/Vivaldi_Cum_dederit_from_Nisi_Dominus_RV_608_score WITH BOWINGS.pdf" target="_blank">Vivaldi - Cum dederit from Nisi Dominus - Score with bowings</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Nisi Dominus RV 608/VIVALDI_Cum_dederit_from_Nisi_Dominus_RV_608_(alto).pdf" target="_blank">Vivaldi - Cum dederit from Nisi Dominus - Alto part</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Nisi Dominus RV 608/VIVALDI_Cum_dederit_from_Nisi_Dominus_RV_608_(violons_1_&_2).pdf" target="_blank">Vivaldi - Cum dederit from Nisi Dominus - Flauto/oboe/violini 1 & 2</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Nisi Dominus RV 608/VIVALDI_Cum_dederit_from_Nisi_Dominus_RV_608_(vlc_&_b.c.).pdf" target="_blank">Vivaldi - Cum dederit from Nisi Dominus - Celli & BC</a></li>
      </ul>
      <h3>Vivaldi - Sinfonie avanti la Senna Festeggiante RV 693 (instruments only)</h3>
      <p>NB. we only play the Sinfonia (all 3 sections)</p>
      <ul>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi_Senna_RV693/Vivaldi_La_Senna_Festeggiante_parte_prima_score WITH BOWINGS.pdf" target="_blank">Score with bowings</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi_Senna_RV693/vivaldi_la_senna_festeggiante_parte_prima_violino1.pdf" target="_blank">Flauto/oboe/violini 1</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi_Senna_RV693/vivaldi_la_senna_festeggiante_parte_prima_violino2.pdf" target="_blank">Flauto/oboe/violini 2</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi_Senna_RV693/vivaldi_la_senna_festeggiante_parte_prima_viola.pdf" target="_blank">Viole</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi_Senna_RV693/vivaldi_la_senna_festeggiante_parte_prima_basso_continuo.pdf" target="_blank">Basso (celli, double bass, BC)</a></li>
      </ul>
      <h3>Caldara - Salve Regina</h3>
      <ul>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara - Salve Regina/Caldara - Salve Regina - score - Full Score.pdf" target="_blank">Caldara - Salve Regina - Full Score with bowings</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara - Salve Regina/Caldara - Salve Regina - Chorpartitur.pdf" target="_blank">Caldara - Salve Regina - Vocal score</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara - Salve Regina/Caldara - Salve Regina - score - Violin I.pdf" target="_blank">Caldara - Salve Regina - Flauto/oboe/violini I</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara - Salve Regina/Caldara - Salve Regina - score - Violin II.pdf" target="_blank">Caldara - Salve Regina - Flauto/oboe/violini II</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara - Salve Regina/Caldara - Salve Regina - score - Trombone I, Trombone II.pdf" target="_blank">Caldara - Salve Regina - Viola da gamba I-II</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara - Salve Regina/Caldara - Salve Regina - score - Violoncello.pdf" target="_blank">Caldara - Salve Regina - Violoncello</a></li>
      </ul>
      <h3>Vivaldi - Magnificat RV 610</h3>
      <ul>
        <li><a href="https://pellegrina.net/pdf/2024-2/Magnificat RV 610/IMSLP400491-PMLP329343-Vivaldi-Magnificat_-_partitura.pdf" target="_blank">Vivaldi - Magnificat - Score with bowings</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Magnificat RV 610/IMSLP400499-PMLP329343-Vivaldi-Magnificat_-_Coro&Continuo.pdf" target="_blank">Vivaldi - Magnificat - Coro&Continuo</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Magnificat RV 610/IMSLP400496-PMLP329343-Vivaldi-Magnificat_-_Oboe_1.pdf" target="_blank">Vivaldi - Magnificat - Oboe 1</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Magnificat RV 610/IMSLP400497-PMLP329343-Vivaldi-Magnificat_-_Oboe_2.pdf" target="_blank">Vivaldi - Magnificat - Oboe 2</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Magnificat RV 610/IMSLP400492-PMLP329343-Vivaldi-Magnificat_-_Violino_I.pdf" target="_blank">Vivaldi - Magnificat - Violino I</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Magnificat RV 610/IMSLP400493-PMLP329343-Vivaldi-Magnificat_-_Violino_II.pdf" target="_blank">Vivaldi - Magnificat - Violino II</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Magnificat RV 610/IMSLP400494-PMLP329343-Vivaldi-Magnificat_-_Viola.pdf" target="_blank">Vivaldi - Magnificat - Viola + gamba (same division as in Domine ad adiuvandum)</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Magnificat RV 610/IMSLP400495-PMLP329343-Vivaldi-Magnificat_-_Violoncello.pdf" target="_blank">Vivaldi - Magnificat - Violoncello, double bass + gamba (same division as in Domine ad adiuvandum)</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Magnificat RV 610/IMSLP400498-PMLP329343-Vivaldi-Magnificat_-_Organo.pdf" target="_blank">Vivaldi - Magnificat - Organo</a></li>
      </ul>
    </div>
    <!-- InstanceEndEditable -->
    <h2> <a href="javascript: history.go(-1)">Back</a></h2>
    <p>&nbsp;</p>
  </div>
  </div>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>
<!-- InstanceEnd -->

</html>