<?php //Connection statement
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2024.php');

// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1 );

error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

Kint::$enabled_mode = false;

$CursusId = $eerstecursus;

if (isset($_GET['cursus']) and $_GET['cursus'] != "")
  $CursusId = $_GET['cursus'] + $cursus_offset; // cursusnummer

$sorteer = 'd.achternaam';
$selecteer = '1=1';


d($_GET);

// begin Recordset
$eerste_inschrijving = ($jaar - 1) . '-12-01';
$query_Cursus = "SELECT 
  d.naam,
  d.naam_aanbrenger,
  DATEDIFF(d.eerste_inschrijving, DATE('2012-12-01')) AS nieuw,
  i.datum_inschr,
  i.eenpersoons,
  i.kamperen,
  i.hotel_2pp,
  i.hotel_1pp,
  i.eigen_acc,
  i.acc_wens,
  a.postcode,
  i.opmerkingen 
FROM
  dlnmr d,
  inschrijving i,
  adres a 
WHERE NOT (
    d.achternaam LIKE \"%XXX%\" 
    OR d.achternaam LIKE \"%YYY%\" 
    OR d.achternaam LIKE \"%ZZZ%\"
  ) 
  AND i.CursusId_FK = {$CursusId} 
  AND d.dlnmrid = i.dlnmrid_fk 
  AND d.adresId_FK = a.adresId 
  AND {$selecteer}
  AND aangenomen = 1 
  AND NOT (afgewezen <=> 1) 
ORDER BY {$sorteer}";

d($query_Cursus);

$Cursus = select_query($query_Cursus, 1);
$totalRows_Cursus = count($Cursus);

$toehoorders_Cursus = "SELECT * FROM inschrijving WHERE CursusId_FK = {$CursusId} AND toehoorder = 1 and NOT (afgewezen <=> 1)";
$toe = select_query($toehoorders_Cursus);
if (is_array($toe)) $toehoorders_Cursus = count($toe);
else $toehoorders_Cursus = 0;

$Cursusnaam = select_query("SELECT cursusnaam_en, YEAR(datum_begin) as jaar FROM cursus WHERE CursusId = {$CursusId}", 1);

$query_Docenten = "SELECT naam, CONCAT(adres, \", \", PC, \" \", plaats, \", \", land) as adres, telefoon, mobiel, email, cd.vak FROM cursus as c, cursusdocenten AS cd, docenten AS d WHERE CursusId_FK = {$CursusId} AND cd.DocId_FK = d.DocId AND c.CursusId = cd.CursusID_FK ORDER BY d.achternaam";
$Docenten = select_query($query_Docenten);
$totalRows_Docenten = count($Docenten);
// end Recordset


// begin Recordset
$query_instrumenten = "SELECT * FROM instr ORDER BY id ASC";
$instrumenten = select_query($query_instrumenten);
$totalRows_instrumenten = count($instrumenten);
foreach ($instrumenten as $instr) {
  $instrumententabel[$instr['id']] = $instr['en'];
}
// end Recordset

d($instrumententabel);

?>
<!DOCTYPE HTML>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Chamber music wishes</title>
  <link href="css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
  <style type="text/css">
    <!--
    body {
      margin-left: 20px;
      margin-top: 20px;
      margin-right: 20px;
    }

    td.iks {
      text-align: center;
    }

    .nieuwe_deelnemer {
      background-color: #FFCC66;
    }

    .nadruk {
      color: rgba(0, 51, 153, 1);
    }
    -->
  </style>
  <SCRIPT TYPE="text/javascript">
    <!--
    function Ganaar(cursus) {
      document.formulier.cursus.value = cursus;
      document.formulier.submit();
    }
    -->
  </SCRIPT>
</head>

<body>


  <form action="<?php echo $editFormAction; ?>" method="get" name="formulier" id="formulier">
    Choose the course:
    <?php
    $i = 1;
    while ($i <= $aantal_cursussen) {
      echo "<input type=\"radio\" name=\"cursus\" value=\"{$i}\"";
      if (isset($_GET['cursus']) and ($_GET['cursus'] == $i)) echo 'checked';
      echo " OnClick=Ganaar($i)>course {$i} | \n";
      $i++;
    }
    ?>
    <br>

    <h2>Course <em><?php echo $Cursusnaam['cursusnaam_en'] . '</em>&nbsp;' . $Cursusnaam['jaar'] . '</h2><p>' . $totalRows_Cursus; ?> participants<?php if ($toehoorders_Cursus > 0) echo ", including {$toehoorders_Cursus} auditor(s)"; ?></p>
        <p class="nadruk">&nbsp;</p>
        <table class="w3-table-all">
          <tr>
            <th>Name:</th>
            <th width="140">Registration date:</th>
            <th>Wishes:</th>
          </tr>
          <?php
          foreach ($Cursus as $curs) {
          ?>
            <tr>
              <td><?php echo $curs['naam']; ?>&nbsp;</td>
              <td><?php echo $curs['datum_inschr']; ?>&nbsp;</td>
              <td><?php echo $curs['opmerkingen']; ?>&nbsp;</td>
            </tr>
          <?php
          }
          ?>
        </table>
  </form>
</body>

</html>