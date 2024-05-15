<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/cursussen.php';
$cursusnr = 2 + $cursus_offset;
?>

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
          <th class="onzichtbaar">Flyer concert</th>
        </tr>
        <tr>
          <td class="w3-center"><a href="../part_list.php?cursus=2" target="_blank">List of participants</a></td>
          <td class="w3-center uit"><a xxxx="La Pellegrina Barok 2024 - Kamermuziek.pdf" target="_blank">Chamber music ensembles</a></td>
          <td class="w3-center uit"><a xxxx="2024-2_accommodation.pdf" target="_blank">Overview of accommodation</a></td>
          <td class="w3-center"><a href="https://docs.google.com/document/d/1ODcgAmuTYIfNC9DKLaU0f6zed2uJvaJ6aoiIGp2Sb1A/edit?usp=sharing" target="_blank">Accommodation near Nieuw Sion</a></td>
          <td class="w3-center uit"><a xxxx="2024-2 Baroque daily program.pdf" target="_blank">Daily program</a></td>
          <td class="w3-center uit onzichtbaar">Flyer concert</td>
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
          <ul>
            <li><a href="../pdf/2024-2/Reichenauer/Reichenauer_Quartett_Rk_18_bassoon.pdf">Bassoon</a></li>
            <li><a href="../pdf/2024-2/Reichenauer/Reichenauer_Quartett_Rk_18_violino.pdf">Violino</a></li>
            <li><a href="../pdf/2024-2/Reichenauer/Reichenauer_Quartett_Rk_18_violoncello.pdf">Cello</a></li>
            <li><a href="../pdf/2024-2/Reichenauer/Reichenauer_Quartett_Rk_18_basso.pdf">Basso</a></li>
            <li><a href="../pdf/2024-2/Reichenauer/Reichenauer_Quartett_Rk_18.pdf">Manuscript source</a></li>
          </ul>
        </ul>
      </div>
      <h2>Tutti programme</h2>
      <p>All parts for the works we are going to perform are now available. Please print and study what you need. Singers, please print, study and bring the vocal score. The string parts have no bowings yet. They will be available soon.</p>
      <h3>Vivaldi - Domine ad adjuvandum me festina RV 593</h3>
      <ul>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Full Score.pdf">Vivaldi-Domine_ad_adjuvandum - Full Score</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Vocal score.pdf">Vivaldi-Domine_ad_adjuvandum - Vocal score</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Violin 1-I.pdf">Vivaldi-Domine_ad_adjuvandum - Violin 1-I</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Violin 1-II.pdf">Vivaldi-Domine_ad_adjuvandum - Violin 1-II</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Viola 1.pdf">Vivaldi-Domine_ad_adjuvandum - Viola 1</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Violin 2-I.pdf">Vivaldi-Domine_ad_adjuvandum - Violin 2-I</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Violin 2-II.pdf">Vivaldi-Domine_ad_adjuvandum - Violin 2-II</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Viola 2.pdf">Vivaldi-Domine_ad_adjuvandum - Viola 2</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - Cello & double bass 1-2.pdf">Vivaldi-Domine_ad_adjuvandum - Cello & double bass 1-2</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - BC 1.pdf">Vivaldi-Domine_ad_adjuvandum - BC 1</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Domine ad adjuvandum me festina RV 593/Vivaldi-Domine_ad_adjuvandum - BC 2.pdf">Vivaldi-Domine_ad_adjuvandum - BC 2</a></li>
      </ul>
      <h3>Vivaldi - Confitebor RV 596</h3>
      <ul>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi%20-%20Confitebor%20RV%20596/Vivaldi%20-%20Confitebor%20RV%20596%20-%20score.pdf">Vivaldi - Confitebor RV 596 - Score</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi - Confitebor RV 596/Vivaldi - Confitebor RV 596 - vocal score.pdf">Vivaldi - Confitebor RV 596 - Vocal score</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi - Confitebor RV 596/Vivaldi - Confitebor RV 596 - oboe 1.pdf">Vivaldi - Confitebor RV 596 - Oboe 1</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi - Confitebor RV 596/Vivaldi - Confitebor RV 596 - oboe 2.pdf">Vivaldi - Confitebor RV 596 - Oboe 2</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi - Confitebor RV 596/Vivaldi - Confitebor RV 596 - violino 1.pdf">Vivaldi - Confitebor RV 596 - Violino 1</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi - Confitebor RV 596/Vivaldi - Confitebor RV 596 - violino 2.pdf">Vivaldi - Confitebor RV 596 - Violino 2</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi - Confitebor RV 596/Vivaldi - Confitebor RV 596 - viola.pdf">Vivaldi - Confitebor RV 596 - Viola</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi - Confitebor RV 596/Vivaldi - Confitebor RV 596 - bass.pdf">Vivaldi - Confitebor RV 596 - Cello, double bass, bassoon</a></li>
      </ul>
      <h3>Monteverdi - Cantate Domino a 2</h3>
      <ul>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara_Caro_mea_vere.pdf">Monteverdi - Cantate Domino a 2 - Score</a></li>
      </ul>
      <h3>Galuppi - Laetatus sum</h3>
      <ul>
        <li><a href="https://pellegrina.net/pdf/2024-2/Galuppi - Laetatus sum/Galuppi-Laetatus_sum_in_A-partitura.pdf">Galuppi-Laetatus_sum_in_A - Full score</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Galuppi - Laetatus sum/Galuppi-Laetatus_sum_in_A-voci_e_bc.pdf">Galuppi-Laetatus_sum_in_A - Vocal score</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Galuppi - Laetatus sum/Galuppi-Laetatus_sum_in_A-violino_1.pdf">Galuppi-Laetatus_sum_in_A - Violino 1</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Galuppi - Laetatus sum/Galuppi-Laetatus_sum_in_A-violino_2.pdf">Galuppi-Laetatus_sum_in_A - Violino 2</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Galuppi - Laetatus sum/Galuppi-Laetatus_sum_in_A-viola.pdf">Galuppi-Laetatus_sum_in_A - Viola</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Galuppi - Laetatus sum/Galuppi-Laetatus_sum_in_A-bc.pdf">Galuppi-Laetatus_sum_in_A - Basso continuo</a></li>
      </ul>
      <h3>Caldara - Caro mea vere est cibus a 2</h3>
      <ul>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara_Caro_mea_vere.pdf">Caldara - Caro mea vere est cibus a 2 - Score</a></li>
      </ul>
      <h3>Vivaldi - Cum dederit from Nisi Dominus RV 608</h3>
      <ul>
        <li><a href="https://pellegrina.net/pdf/2024-2/Nisi Dominus RV 608/VIVALDI_Cum_dederit_from_Nisi_Dominus_RV_608_(conducteur).pdf">Vivaldi - Cum dederit from Nisi Dominus - Score</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Nisi Dominus RV 608/VIVALDI_Cum_dederit_from_Nisi_Dominus_RV_608_(alto).pdf">Vivaldi - Cum dederit from Nisi Dominus - Alto part</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Nisi Dominus RV 608/VIVALDI_Cum_dederit_from_Nisi_Dominus_RV_608_(violons_1_&_2).pdf">Vivaldi - Cum dederit from Nisi Dominus - Violins 1 & 2</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Nisi Dominus RV 608/VIVALDI_Cum_dederit_from_Nisi_Dominus_RV_608_(vlc_&_b.c.).pdf">Vivaldi - Cum dederit from Nisi Dominus - Celli & BC</a></li>
      </ul>
      <h3>Vivaldi - Sinfonie avanti la Senna Festeggiante RV 693 (instruments only)</h3>
      <ul>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi_Senna_RV693/vivaldi_la_senna_festeggiante_parte_prima_violino1.pdf" target="_blank">Flauto/oboe/violini 1</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi_Senna_RV693/vivaldi_la_senna_festeggiante_parte_prima_violino2.pdf" target="_blank">Flauto/oboe/violini 2</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi_Senna_RV693/vivaldi_la_senna_festeggiante_parte_prima_viola.pdf" target="_blank">Viole</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Vivaldi_Senna_RV693/vivaldi_la_senna_festeggiante_parte_prima_basso_continuo.pdf" target="_blank">Basso (celli, double bass, BC)</a></li>
      </ul>
      <h3>Caldara - Salve Regina</h3>
      <ul>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara - Salve Regina/Caldara - Salve Regina - score - Full Score.pdf">Caldara - Salve Regina - Full Score</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara - Salve Regina/Caldara - Salve Regina - Chorpartitur.pdf">Caldara - Salve Regina - Vocal score</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara - Salve Regina/Caldara - Salve Regina - score - Violin I.pdf">Caldara - Salve Regina - Violin I</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara - Salve Regina/Caldara - Salve Regina - score - Violin II.pdf">Caldara - Salve Regina - Violin II</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara - Salve Regina/Caldara - Salve Regina - score - Trombone I, Trombone II.pdf">Caldara - Salve Regina - Viola da gamba or Trombone I-II</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Caldara - Salve Regina/Caldara - Salve Regina - score - Violoncello.pdf">Caldara - Salve Regina - Violoncello</a></li>
      </ul>
      <h3>Vivaldi - Magnificat RV 610</h3>
      <ul>
        <li><a href="https://pellegrina.net/pdf/2024-2/Magnificat RV 610/IMSLP400491-PMLP329343-Vivaldi-Magnificat_-_partitura.pdf">Vivaldi - Magnificat - Score</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Magnificat RV 610/IMSLP400499-PMLP329343-Vivaldi-Magnificat_-_Coro&Continuo.pdf">Vivaldi - Magnificat - Coro&Continuo</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Magnificat RV 610/IMSLP400496-PMLP329343-Vivaldi-Magnificat_-_Oboe_1.pdf">Vivaldi - Magnificat - Oboe 1</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Magnificat RV 610/IMSLP400497-PMLP329343-Vivaldi-Magnificat_-_Oboe_2.pdf">Vivaldi - Magnificat - Oboe 2</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Magnificat RV 610/IMSLP400492-PMLP329343-Vivaldi-Magnificat_-_Violino_I.pdf">Vivaldi - Magnificat - Violino I</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Magnificat RV 610/IMSLP400493-PMLP329343-Vivaldi-Magnificat_-_Violino_II.pdf">Vivaldi - Magnificat - Violino II</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Magnificat RV 610/IMSLP400494-PMLP329343-Vivaldi-Magnificat_-_Viola.pdf">Vivaldi - Magnificat - Viola</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Magnificat RV 610/IMSLP400495-PMLP329343-Vivaldi-Magnificat_-_Violoncello.pdf">Vivaldi - Magnificat - Violoncello</a></li>
        <li><a href="https://pellegrina.net/pdf/2024-2/Magnificat RV 610/IMSLP400498-PMLP329343-Vivaldi-Magnificat_-_Organo.pdf">Vivaldi - Magnificat - Organo</a></li>
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