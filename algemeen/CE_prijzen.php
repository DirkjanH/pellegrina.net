<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/cursussen.php'; ?>

<!DOCTYPE HTML>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
  <title>CE prices</title>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.EN.php'; ?>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
  <link href="/css/pagina_stijlen_algemeen.css" rel="stylesheet" type="text/css">
</head>

<body>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
  <div id="inhoud">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.EN.php'; ?>
    <div id="main">
      <h2>Special offer for Central
        and Eastern European citizens</h2>
      <p>For participants from Central European (former socialist) countries and countries of the
        former Soviet Union the
        following specially reduced
        course fees are available:</p>
      <table border="1" cellpadding="5">
        <tr valign="TOP">
          <th><b>Course:</b></th>
          <th align="RIGHT"><b>Fee:</b></th>
          <th align="RIGHT"><b>Students' fee:</b></th>
        </tr>
        <?php
        foreach ($cursussen as $i => $cursus) {
        ?> <tr valign="TOP">
            <td><?php echo ($i - $cursus_offset) . '. ' . $cursus['cursusnaam_en'] ?></td>
            <td align="RIGHT"><?php echo euro_en($cursus['prijs_ce']); ?> / <?php echo euro_en($cursus['prijs_ce'] - $cursus['korting_vroeg']); ?> <span class="nadruk">*)</span></td>
            <td align="RIGHT"><?php echo euro_en($cursus['prijs_ce_student']); ?> / <?php echo euro_en($cursus['prijs_ce_student'] - $cursus['korting_vroeg']); ?> <span class="nadruk">*)</span></td>
          </tr>
        <?php } ?>
      </table>
      <p class="nadruk"> *) the lower price applies when registering <strong>before March 1st. </strong>Please register early!!! </p>
      <p>Students and <strong>anyone up to 36 years of age</strong> can apply for the students'
        fee. They should include with their enrolment a copy of their proof
        of registration with an university or other institution of higher education. </p>
      <p>The number of participants who can be accepted against
        these reduced fees is limited, depending on the resources of the
        funds from which these reductions are drawn. <i>La Pellegrina</i> retains the right to decide who receives what reduction. It is
        not possible to correspond about it.
      </p>
      <p>The fee for each course includes meals and accommodation
        in double or triple rooms, but excludes travel and insurance expenses.
      </p>
      <h2>Application </h2>
      <p>Application can be made by filling out the registration
        form (see above) <b>completely</b> and transferring a deposit of 50 %
        of this special reduced course fee to <i>La Pellegrina</i>. Applicants
        will then receive provisional confirmation of registration.
      </p>
      <p>Information can be obtained from <a href="../EN/contact.php"><i>La
            Pellegrina.</i></a> Payments can be made by bank transfer, credit
        card or postal money order made out to <i>La Pellegrina</i>, Utrecht.
        All bank costs should be paid by the applicant. Please note that
        credit cards
        or direct
        money transfers tend to involve bank costs. Deposits will naturally
        be refunded to applicants who cannot be placed. The entire fee must
        be paid
        by 15 June.
      </p>
      <h2> <a href="javascript: history.go(-1)">Back</a></h2>
      <p>&nbsp;</p>
    </div>
  </div>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html>