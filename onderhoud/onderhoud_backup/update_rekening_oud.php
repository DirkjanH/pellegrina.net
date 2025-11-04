<?php //Connection statement
// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1 );

error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

Kint::$enabled_mode = false;

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2026.php');

d($_GET);
d($_POST);

require_once('../includes/LPmailer.inc.php');

require_once("tarieven.php");

function send_alert($msg)
{

  echo "<script language=\"javascript\">alert(\"{$msg}\");</script>";
}  //end function 

if (empty($_GET['DlnmrId']) or $_GET['DlnmrId'] == "") $id = -1;
else $id = $_GET['DlnmrId'];

// begin Recordset inschrijving

if ($id == -1) {
  $query_inschrijving = sprintf(
    "SELECT
  voornaam,
  naam,
  adres,
  postcode,
  plaats,
  land,
  taal,
  email,
  (YEAR(CURDATE())-YEAR(geboortedatum)) - (RIGHT(CURDATE(),5)<RIGHT(geboortedatum,5)) AS leeftijd,
  i.toehoorder,
  eenpersoons,
  i.hotel_2pp, 
  i.hotel_1pp,
  i.kamperen,
  i.meerpers,
  aangenomen,
  afgewezen,
  aanbet_bedrag,
  info_korting,
  voorl_bev,
  cursusgeld,
  storting_fonds,
  donatie,
  PayPal,
  korting,
  extra,
  DATEDIFF(datum_inschr, datum_korting) as tijdig,
  paypal,
  oost,
  student,
  meerdaneen,
  eigen_acc,
  rekening_verzonden,
  CursusId_FK,
  DlnmrId_FK,
  InschId
FROM inschrijving AS i,
  dlnmr AS d,
  adres AS a, 
  cursus AS c
WHERE DlnmrId = DlnmrId_FK
    AND AdresId = AdresId_FK
    AND CursusId = CursusId_FK
    AND aangenomen = 1
    AND achternaam NOT LIKE \"%%XXX%%\"
    AND achternaam NOT LIKE \"%%YYY%%\"
    AND achternaam NOT LIKE \"%%ZZZ%%\"
    AND geboortedatum != 0  
	AND NOT(afgewezen <=> 1)
    AND CursusId_FK BETWEEN %s AND %s
    AND rekening_verzonden Is Null
--	AND cursusgeld + donatie - korting - aanbet_bedrag != 0
ORDER BY CursusId_FK, achternaam ASC",
    GetSQLValueString($eerstecursus, "int"),
    GetSQLValueString($laatstecursus, "int")
  );

  d($query_inschrijving);

  $inschrijving = $inschrijf->SelectLimit($query_inschrijving) or die($inschrijf->ErrorMsg());
  echo 'Totaal te versturen rekeningen: ' . $inschrijving->RecordCount() . '<br>';
} else { // ook naar mensen die al een rekening ontvingen
  $query_inschrijving = sprintf(
    "SELECT
  voornaam,
  naam,
  adres,
  postcode,
  plaats,
  land,
  taal,
  email,
  (YEAR(CURDATE())-YEAR(geboortedatum)) - (RIGHT(CURDATE(),5)<RIGHT(geboortedatum,5)) AS leeftijd,
  i.toehoorder,
  eenpersoons,
  i.hotel_2pp, 
  i.hotel_1pp, 
  i.kamperen,
  i.meerpers,
  aangenomen,
  afgewezen,
  aanbet_bedrag,
  info_korting,
  voorl_bev,
  cursusgeld,
  storting_fonds,
  donatie,
  PayPal,
  korting,
  extra,
  DATEDIFF(datum_inschr, datum_korting) as tijdig,
  paypal,
  oost,
  student,
  meerdaneen,
  eigen_acc,
  aangebracht,
  rekening_verzonden,
  CursusId_FK,
  DlnmrId_FK,
  InschId
FROM inschrijving AS i,
  dlnmr AS d,
  adres AS a, 
  cursus AS c
WHERE DlnmrId = DlnmrId_FK
    AND AdresId = AdresId_FK
    AND CursusId = CursusId_FK
    AND aangenomen = 1
    AND achternaam NOT LIKE \"%%XXX%%\"
    AND achternaam NOT LIKE \"%%YYY%%\"
    AND achternaam NOT LIKE \"%%ZZZ%%\"
    AND geboortedatum != 0  
	AND NOT(afgewezen <=> 1)
    AND CursusId_FK BETWEEN %s AND %s
	AND DlnmrId_FK=%s 
ORDER BY CursusId_FK, achternaam ASC",
    GetSQLValueString($eerstecursus, "int"),
    GetSQLValueString($laatstecursus, "int"),
    GetSQLValueString($id, "int")
  );

  d($query_inschrijving);

  $inschrijving = $inschrijf->SelectLimit($query_inschrijving) or die($inschrijf->ErrorMsg());
  $aantal_inschrijvingen = $inschrijving->RecordCount();
}
// end Recordset inschrijving

$query_cursus = "SELECT
    CursusId
    , cursusnr
    , cursusnaam_nl
    , cursusplaats_nl
    , cursusdatum_nl
    , cursusnaam_en
    , cursusplaats_en
    , cursusdatum_en
    , cursusnaam_de
    , cursusplaats_de
    , cursusdatum_de
    , datum_begin
    , datum_eind
    , datum_korting
	, UNIX_TIMESTAMP(datum_korting) as u_datum_korting 
    , datum_beslissing
	, UNIX_TIMESTAMP(datum_beslissing) as u_datum_beslissing 
    , datum_betaling
	, UNIX_TIMESTAMP(datum_betaling) as u_datum_betaling 
    , max_dlnmrs
    , login_website
    , prijs_volledig
    , prijs_student
    , prijs_ce
    , prijs_ce_student
    , prijs_cr
    , prijs_cr_student
    , eenpers
    , hotel_2pp
    , hotel_1pp
    , meerpers
    , kamperen
    , toehoorder
    , korting_vroeg
    , korting_meer
	, korting_eigen_acc
FROM
    cursus 
WHERE cursusId BETWEEN {$eerstecursus} AND {$laatstecursus} 
ORDER BY datum_begin";
//echo "query_cursus = {$query_cursus}<br><br>";
$cursus = select_query($query_cursus, 'CursusId');
foreach ($cursus as &$cur) {
  $cur['NL'] = $cur['cursusnaam_nl'] . ' ' . $jaar;
  $cur['EN'] = $cur['cursusnaam_en'] . ' ' . $jaar;
}
d($cursus);
// end Recordset cursusgegevens

// Open de rekeningteksten
$mail_text_file_NL = "../bevestiging/rekening_NL.htm";
$mail_text_file_EN = "../bevestiging/rekening_EN.htm";

$fh = fopen($mail_text_file_NL, 'rb');
$rek_NL = fread($fh, filesize($mail_text_file_NL));
fclose($fh);

$fh = fopen($mail_text_file_EN, 'rb');
$rek_EN = fread($fh, filesize($mail_text_file_EN));
fclose($fh);

if ((isset($_POST["verzend"])) && ($_POST["verzend"] == "Maak rekeningen")) {

  $totaal_rekeningen = 0;
  $inschrijving->MoveFirst();

  while (!$inschrijving->EOF) {

    // kies de tekst-file
    if ($inschrijving->Fields('taal') == "NL") {
      $mail_text = $rek_NL;
    } else {
      $mail_text = $rek_EN;
    }

    $ins['oost'] = $inschrijving->Fields('oost');
    $ins['student'] = $inschrijving->Fields('student');
    $ins['leeftijd'] = $inschrijving->Fields('leeftijd');
    $ins['taal'] = $inschrijving->Fields('taal');
    $ins['toehoorder'] = $inschrijving->Fields('toehoorder');
    $ins['eenpersoons'] = $inschrijving->Fields('eenpersoons');
    $ins['hotel_2pp'] = $inschrijving->Fields('hotel_2pp');
    $ins['hotel_1pp'] = $inschrijving->Fields('hotel_1pp');
    $ins['kamperen'] = $inschrijving->Fields('kamperen');
    $ins['meerpers'] = $inschrijving->Fields('meerpers');
    $ins['storting_fonds'] = $inschrijving->Fields('storting_fonds');
    $ins['aangebracht'] = $inschrijving->Fields('aangebracht');
    $ins['tijdig'] = $inschrijving->Fields('tijdig');
    $ins['donatie'] = $inschrijving->Fields('donatie');
    $ins['PayPal'] = $inschrijving->Fields('paypal');
    $ins['meerdaneen'] = $inschrijving->Fields('meerdaneen');
    $ins['eigen_acc'] = $inschrijving->Fields('eigen_acc');
    $ins['korting'] = $inschrijving->Fields('korting');
    $ins['extra'] = $inschrijving->Fields('extra');
    $ins['CursusId'] = $inschrijving->Fields('CursusId_FK');

    d($ins);

    $factuur = cursusgeld($ins);

    $cursusgeld = intval($inschrijving->Fields('cursusgeld'));
    $factuurbedrag = intval($factuur['cursusgeld']);

    if ($factuurbedrag != $cursusgeld) {
      $boodschap = "{$inschrijving->Fields('naam')} heeft € {$factuurbedrag} berekend cursusgeld en € {$cursusgeld} cursusgeld volgens de database";
      send_alert($boodschap);
    }

    $totaal = $inschrijving->Fields('cursusgeld') + $inschrijving->Fields('donatie');

    if ($totaal > 0) {
      $adresblok = $inschrijving->Fields('naam') . '<br>' . $inschrijving->Fields('adres') . '<br>' .
        $inschrijving->Fields('postcode') . ' ' . $inschrijving->Fields('plaats') . '<br>';
      if ($inschrijving->Fields('land') != 'Netherlands' and $inschrijving->Fields('land') != 'Nederland')
        $adresblok .= $inschrijving->Fields('land') . '<br>';
      $mail_text = str_replace("{adresblok}", $adresblok, $mail_text);
      $mail_text = str_replace("{voornaam}", $inschrijving->Fields('voornaam'), $mail_text);
      $mail_text = str_replace("{cursus}", $cursus[$inschrijving->Fields('CursusId_FK')][$inschrijving->Fields('taal')], $mail_text);
      $mail_text = str_replace("{nr}", $inschrijving->Fields('InschId'), $mail_text);
      $mail_text = str_replace("{datum}", strftime('%D'), $mail_text);
      $mail_text = str_replace("{factuurregels}", $factuur['regels'], $mail_text);
      $mail_text = str_replace("{aanbet_bedrag}", bedrag($inschrijving->Fields('aanbet_bedrag') * -1), $mail_text);
      $mail_text = str_replace("{cursusgeld}", bedrag($totaal), $mail_text);
      $datum_betaling = strftime('%e %B %Y', strtotime($cursus[$inschrijving->Fields('CursusId_FK')]['datum_betaling']));
      $mail_text = str_replace("{datum_betaling}", $datum_betaling, $mail_text);
      $tebetalen = $totaal - $inschrijving->Fields('aanbet_bedrag');
      $mail_text = str_replace("{tebetalen}", bedrag($tebetalen), $mail_text);
      $mail_text = str_replace("{wensen}", stripslashes($inschrijving->Fields('wensen')), $mail_text);
      if ($factuur['donatie'] > 0)
        $mail_text = str_replace("{donatie}", bedrag($factuur['donatie']), $mail_text);
      else $mail_text = str_replace("{donatie}", '', $mail_text);

      // echo "De mail-tekst is: <br>{$mail_text}<br><br><hr>";

      // stuur een mail
      $mail = new LPmailer();
      $mail->AddAddress(stripslashes($inschrijving->Fields('email')), stripslashes($inschrijving->Fields('naam')));
      if ($inschrijving->Fields('taal') == "NL") $mail->Subject = "La Pellegrina rekening";
      else $mail->Subject = "La Pellegrina invoice";
      $mail->From    = "info@pellegrina.net";
      $mail->AddCC("info@pellegrina.net", "La Pellegrina PHP mailer");
      $mail->Body    = $mail_text;

      $nr = $totaal_rekeningen + 1;

      $mail->AltBody = strip_tags($mail_text);

      if (empty($_POST['verzenden']) or !($_POST['verzenden'])) {
        echo "De mail-tekst is: <br>{$mail_text}";
        echo '<br><hr><br>';
      } else {
        if (!$mail->Send()) {
          echo "Bericht nr. {$nr} aan {$inschrijving->Fields('naam')} kon niet verzonden worden.<br>";
          echo "Mailer Error: " . $mail->ErrorInfo;
          exit();
        }
        echo "Bericht nr. {$nr} aan {$inschrijving->Fields('naam')} verzonden.<br>";

        $update_inschrijving = sprintf(
          "UPDATE inschrijving SET rekening_verzonden=NOW() WHERE InschId=%s",
          GetSQLValueString($inschrijving->Fields('InschId'), "int")
        );
        $Result1 = $inschrijf->Execute($update_inschrijving) or die($inschrijf->ErrorMsg());
        $totaal_rekeningen += $Result1;
      }
    } // als totaalbedrag > 0
    $inschrijving->MoveNext();
  } // einde deze rekening

  echo 'Totaal verzonden rekeningen: ' . $totaal_rekeningen . '<br>';
} // einde verzend rekeningen

?>
<!DOCTYPE HTML>
<html>

<head>
  <title>Update: maak rekening</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/pellegrina_stijlen.css" type="text/css">
</head>

<body>
  <table width="600" border="0" align="left">
    <tr>
      <td colspan="2">
        <form id="zoek" name="zoek" method="get" action="<?php echo $editFormAction; ?>">
          Id:
          <input name="DlnmrId" type="text" value="<?php if (isset($_GET['DlnmrId']))
                                                      echo $_GET['DlnmrId']; ?>" size="5" />
          <input type="submit" name="Submit" value="Zoek">
          Rekening al verzonden:
          <input name="rekening_verzonden" type="checkbox" id="rekening_verzonden" <?php
                                                                                    if ($inschrijving->Fields('rekening_verzonden') != '') echo 'checked'; ?> value="1">
        </form>
      </td>
    </tr>
    <?php
    if (isset($aantal_inschrijvingen) and $aantal_inschrijvingen > 1) {
      echo "<tr><td colspan=\"3\">";
      echo "<p><b>Kies één van de volgende inschrijvingen:</b></p>";
      echo "<form action=\"{$editFormAction}\" method=\"get\" name=\"inschrijving\" id=\"inschrijving\"> \n <select name=\"cursus\" size=\"{$aantal_inschrijvingen}\" >";
      while (!$inschrijving->EOF) {
        echo "<option value=\"{$inschrijving->Fields('CursusId_FK')}\"";
        if (!(strcmp($inschrijving->Fields('CursusId_FK'), $_GET['cursus']))) {
          echo "SELECTED";
        }
        echo '>' . $cursus[$inschrijving->Fields('CursusId_FK')][NL];
        $inschrijving->MoveNext();
      }
      echo "</option>\n</select>";
      echo '<input name="DlnmrId" type="hidden" value="';
      if (isset($_GET['DlnmrId'])) echo $_GET['DlnmrId'] . '" />';
      echo '<input type="submit" name="Submit" value="Zoek">';
      echo '</form></td></tr>';

      $inschrijving->MoveFirst();
      while (!$inschrijving->EOF and ($inschrijving->Fields('CursusId_FK') != $_GET['cursus']))
        $inschrijving->MoveNext();
    }
    ?>
    <tr>
      <td colspan="2">
        <h2>Naam:&nbsp;<?php if ($id != -1) echo $inschrijving->Fields('naam'); ?><br>
        </h2>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <form action="<?php echo $editFormAction; ?>" method="POST" name="update" id="update">
          <p>
            <input type="submit" name="verzend" value="Maak rekeningen" />
            &nbsp;&nbsp;
            <label>Daadwerkelijk verzenden:
              <input name="verzenden" type="checkbox" id="verzenden" value="1" <?php if (isset($_POST['verzenden'])) echo 'checked'; ?>>
            </label>
            <br>
          </p>
        </form>
      </td>
    </tr>
  </table>
</body>

</html>
<?php
if (isset($inschrijving)) $inschrijving->Close();
if (isset($cursussen)) $cursussen->Close();
?>