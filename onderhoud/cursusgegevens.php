<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);

error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

Kint::$enabled_mode = false;

//Connection statement
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/includes2026.php';

// $eerstecursus -= 5;

d($_POST);

if (isset($_POST["submit"]) and $_POST["submit"] >= $eerstecursus and $_POST["submit"] <= $laatstecursus) {
  $c = $_POST['submit'] . '_';

  $prijzenSQL = sprintf(
    "UPDATE cursus SET datum_korting=%s, datum_betaling=%s, login_website=%s, max_dlnmrs=%s, prijs_volledig=%s, 
						  prijs_student=%s, prijs_ce=%s, prijs_ce_student=%s, prijs_cr=%s, prijs_cr_student=%s, korting_vroeg_cr=%s, eenpers=%s, 
						  diner=%s, meerpers=%s, hotel_1pp=%s, hotel_2pp=%s, hotel_1_2pp=%s, kamperen=%s, toehoorder=%s, korting_vroeg=%s, korting_eigen_acc=%s,
						  korting_meer=%s, inschrijfgeld=%s WHERE CursusId=%s",
    GetSQLValueString($_POST[$c . 'datum_korting'], "date"),
    GetSQLValueString($_POST[$c . 'datum_betaling'], "date"),
    GetSQLValueString($_POST[$c . 'login_website'], "text"),
    GetSQLValueString($_POST[$c . 'max_dlnmrs'], "int"),
    GetSQLValueString($_POST[$c . 'prijs_volledig'], "int"),
    GetSQLValueString($_POST[$c . 'prijs_student'], "int"),
    GetSQLValueString($_POST[$c . 'prijs_ce'], "int"),
    GetSQLValueString($_POST[$c . 'prijs_ce_student'], "int"),
    GetSQLValueString($_POST[$c . 'prijs_cr'], "int"),
    GetSQLValueString($_POST[$c . 'prijs_cr_student'], "int"),
    GetSQLValueString($_POST[$c . 'korting_vroeg_cr'], "int"),
    GetSQLValueString($_POST[$c . 'eenpers'], "int"),
    GetSQLValueString($_POST[$c . 'diner'], "int"),
    GetSQLValueString($_POST[$c . 'meerpers'], "int"),
    GetSQLValueString($_POST[$c . 'hotel_1pp'], "int"),
    GetSQLValueString($_POST[$c . 'hotel_2pp'], "int"),
    GetSQLValueString($_POST[$c . 'hotel_1_2pp'], "int"),
    GetSQLValueString($_POST[$c . 'kamperen'], "int"),
    GetSQLValueString($_POST[$c . 'toehoorder'], "int"),
    GetSQLValueString($_POST[$c . 'korting_vroeg'], "int"),
    GetSQLValueString($_POST[$c . 'korting_eigen_acc'], "int"),
    GetSQLValueString($_POST[$c . 'korting_meer'], "int"),
    GetSQLValueString($_POST[$c . 'inschrijfgeld'], "int"),
    GetSQLValueString($_POST['submit'], "int")
  );

  d($prijzenSQL);
  exec_query($prijzenSQL);
}

// begin Recordset cursusgegevens
$query_cursus = "SELECT * FROM cursus WHERE cursusId BETWEEN {$eerstecursus} AND {$laatstecursus} ORDER BY datum_begin";
d($query_cursus);
$cursustmp = select_query($query_cursus);
d($cursustmp);
foreach ($cursustmp as $c) $cursussen[$c['CursusId']] = $c;
d($cursussen);

foreach ($cursussen as &$cursus) {
  $cursus['begindatum'] = str_replace('  ', ' ', strftime(
    '%e/%m',
    strtotime($cursus['datum_begin'])
  ));
  $cursus['einddatum'] = str_replace('  ', ' ', strftime(
    '%e/%m %Y',
    strtotime($cursus['datum_eind'])
  ));
}
// end Recordset cursusgegevens

?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/LP algemeen NL.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">

  <!-- CSS: -->
  <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">

  <!-- InstanceBeginEditable name="doctitle" -->
  <title>Cursusgegevens <?php echo $jaar; ?></title>
  <style type="text/css">
    th {
      font-family: Verdana, Geneva, sans-serif;
      font-size: 12px;
      font-weight: bold;
      font-style: normal;
      text-align: center !important;
    }

    input {
      text-align: center;
    }
  </style>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.NL.php'; ?>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
  <link href="/css/pagina_stijlen_algemeen.css" rel="stylesheet" type="text/css">
</head>

<body>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
  <div class="w3-panel w3-white">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.NL.php'; ?>
    <h2>Cursusgegevens <?php echo $jaar; ?></h2>
    <form id="form" method="post" action="<?php echo $editFormAction; ?>">
      <div class="w3-responsive">
        <table class="w3-table-all">
          <tr>
            <th width="10%">Naam:</th>
            <th width="20">Login:</th>
            <th width="7">Kortings-<br>
              datum:</th>
            <th width="7">Datum betaling:</th>
            <th>Korting<br>
              vroeg:</th>
            <th width="0">Max.<br>
              dlnmrs:</th>
            <th>Prijs vol:</th>
            <th width="0%">Prijs <br>
              student:</th>
            <th>Prijs CE:</th>
            <th width="0">Prijs CE <br>
              student:</th>
            <th>Prijs CR:</th>
            <th>Prijs CR <br>
              student:</th>
            <th>Korting vroeg<br>
              CR:</th>
            <th>Een-<br>
              pers.:</th>
            <th>Meer-<br>
              pers.:</th>
            <th>Kamperen:</th>
            <th>Toe-<br>
              hoorder:</th>
            <th>PB 1pp:</th>
            <th>PB 2pp:</th>
            <th>PB 1 in 2pp:</th>
            <th>diner:</th>
            <th width="0%">Korting<br>
              eigen<br>
              onderdak:</th>
            <th width="0%">Korting<br>
              meer<br>
              cursussen:</th>
            <th width="0%">Inschrijf<br>
              -geld:</th>
            <th>Wijzig:</th>
            <?php
            foreach ($cursussen as $i => $c) {
              $cursusnaam = "<b>{$c['cursusnaam_nl']}</b>"; // <br>({$c['begindatum']}-{$c['einddatum']})
            ?>
          <tr>
            <td class="w3-center"><?php echo $cursusnaam; ?></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>login_website" type="text" value="<?php echo $c['login_website']; ?>" size="7"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>datum_korting" type="text" value="<?php echo $c['datum_korting']; ?>" size="7"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>datum_betaling" type="text" value="<?php echo $c['datum_betaling']; ?>" size="7"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>korting_vroeg" type="text" value="<?php echo $c['korting_vroeg']; ?>" size="7"></td>
            <td width="0"><input name="<?php echo $i . '_' ?>max_dlnmrs" type="text" value="<?php echo $c['max_dlnmrs']; ?>" size="3"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>prijs_volledig" type="text" value="<?php echo $c['prijs_volledig']; ?>" size="3"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>prijs_student" type="text" value="<?php echo $c['prijs_student']; ?>" size="3"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>prijs_ce" type="text" value="<?php echo $c['prijs_ce']; ?>" size="3"></td>
            <td width="0"><input name="<?php echo $i . '_' ?>prijs_ce_student" type="text" value="<?php echo $c['prijs_ce_student']; ?>" size="3"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>prijs_cr" type="text" value="<?php echo $c['prijs_cr']; ?>" size="3"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>prijs_cr_student" type="text" value="<?php echo $c['prijs_cr_student']; ?>" size="3"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>korting_vroeg_cr" type="text" value="<?php echo $c['korting_vroeg_cr']; ?>" size="3"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>eenpers" type="text" value="<?php echo $c['eenpers']; ?>" size="3"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>meerpers" type="text" value="<?php echo $c['meerpers']; ?>" size="3"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>kamperen" type="text" value="<?php echo $c['kamperen']; ?>" size="3"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>toehoorder" type="text" value="<?php echo $c['toehoorder']; ?>" size="3"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>hotel_1pp" type="text" value="<?php echo $c['hotel_1pp']; ?>" size="3"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>hotel_2pp" type="text" value="<?php echo $c['hotel_2pp']; ?>" size="3"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>hotel_1_2pp" type="text" value="<?php echo $c['hotel_1_2pp']; ?>" size="3"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>diner" type="text" value="<?php echo $c['diner']; ?>" size="3"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>korting_eigen_acc" type="text" value="<?php echo $c['korting_eigen_acc']; ?>" size="3"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>korting_meer" type="text" value="<?php echo $c['korting_meer']; ?>" size="3"></td>
            <td class="w3-center"><input name="<?php echo $i . '_' ?>inschrijfgeld" type="text" value="<?php echo $c['inschrijfgeld']; ?>" size="3"></td>
            <td class="w3-center"><input name="submit" class="w3-button w3-green" type="submit" value="<?php echo $i; ?>"></td>
          <?php
            }
          ?>
        </table>
      </div>
    </form>
    <h2> <a href="javascript: history.go(-1)">Terug</a></h2>
    <p>&nbsp;</p>
  </div>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html>