<?php //Connection statement
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2026.php');

// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);

error_reporting(E_ALL);

session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

Kint::$enabled_mode = false;

$jaar -= 0; // Gegevens dit jaar
$eerstecursus -= 0;
$laatstecursus -= 0;
$ACMP = true;

// begin Recordset Cursusnamen
$query_cursussen = sprintf(
   "SELECT * FROM cursus WHERE CursusId BETWEEN %s AND %s ORDER BY CursusId ASC",
   $eerstecursus,
   $laatstecursus
);
$cursussen = select_query($query_cursussen);
$totaal_cursussen = count($cursussen);

foreach ($cursussen as $c) {
   $cursusnaam[$c['CursusId']] = $c['cursusnaam_en'];
   $korting[$c['CursusId']]['student'] = $c['prijs_volledig'] - $c['prijs_student'];
   $korting[$c['CursusId']]['oost'] = $c['prijs_volledig'] - $c['prijs_ce'];
   $korting[$c['CursusId']]['ooststudent'] = $c['prijs_volledig'] - $c['prijs_ce_student'];
}
// end Recordset Cursusnamen

$i = $eerstecursus;

while ($i <= $laatstecursus) {


   $tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND CursusId_FK = {$i} AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND aangenomen = 1 AND NOT (afgewezen <=> 1)";

   $tel = select_query($tel_query, 0);
   $deelnemers[$i] = $tel;
   $deelnemers['totaal'] += $tel;

   $tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND CursusId_FK = {$i} AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND aangenomen = 1 AND NOT (afgewezen <=> 1)";
   $tel = select_query($tel_query, 0);
   $aangenomen[$i] = $tel;
   $aangenomen['totaal'] += $tel;

   $tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND CursusId_FK = {$i} AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND NOT (afgewezen <=> 1) AND oost <=> 0 AND student = 1";
   $tel = select_query($tel_query, 0);
   $student[$i] = $tel;
   $student['totaal'] += $tel;

   $tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND CursusId_FK = {$i} AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND NOT (afgewezen <=> 1) AND student <=> 0 AND oost = 1";
   $tel = select_query($tel_query, 0);
   $oost[$i] = $tel;
   $oost['totaal'] += $tel;

   $tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND CursusId_FK = {$i} AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND NOT (afgewezen <=> 1) AND student = 1 AND oost = 1";
   $tel = select_query($tel_query, 0);
   $ooststudent[$i] = $tel;
   $ooststudent['totaal'] += $tel;

   $tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND CursusId_FK = {$i} AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND NOT (afgewezen <=> 1) AND donatie > 0";
   $tel = select_query($tel_query, 0);
   $donator[$i] = $tel;
   $donator['totaal'] += $tel;

   $tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND CursusId_FK = {$i} AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND NOT (afgewezen <=> 1) AND korting > 0";
   $tel = select_query($tel_query, 0);
   $reductor[$i] = $tel;
   $reductor['totaal'] += $tel;
   if ($ACMP) {
      $reductor2[$i] += $student[$i] + $oost[$i] + $ooststudent[$i];
      $reductor2['totaal'] += $student[$i] + $oost[$i] + $ooststudent[$i];
   }

   $cursusgelden = select_query("select sum(cursusgeld) as cursusgeld, sum(aanbet_bedrag) as aanbet_bedrag, 
	sum(donatie) as donatie, sum(korting) as korting from inschrijving where aangenomen = 1 AND cursusid_fk = {$i}");
   foreach ($cursusgelden as $cursusgeld) {

      $cursus[$i] = $cursusgeld;
      $cursus['totaal']['cursusgeld'] += $cursusgeld['cursusgeld'];
      $cursus['totaal']['aanbet_bedrag'] += $cursusgeld['aanbet_bedrag'];
      $cursus['totaal']['donatie'] += $cursusgeld['donatie'];
      $cursus['totaal']['korting'] += $cursusgeld['korting'];
      if ($ACMP) {
         $cursus[$i]['student'] = $student[$i] * $korting[$i]['student'];
         $cursus[$i]['oost'] = $oost[$i] * $korting[$i]['oost'];
         $cursus[$i]['ooststudent'] = $ooststudent[$i] * $korting[$i]['ooststudent'];
         $cursus['totaal']['korting'] += $student[$i] * $korting[$i]['student'];
         $cursus['totaal']['korting'] += $oost[$i] * $korting[$i]['oost'];
         $cursus['totaal']['korting'] += $ooststudent[$i] * $korting[$i]['ooststudent'];
      }
   }

   $i++;
}
d($cursus, $cursussen, $korting, $cursusnaam);
?>
<!DOCTYPE HTML>
<html>
<!-- InstanceBegin template="/Templates/LP algemeen EN.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <!-- CSS: -->
    <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Statistics Fund <?php echo $jaar ?></title>
    <!-- InstanceEndEditable -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.EN.php'; ?>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
    <link href="/css/pagina_stijlen_algemeen.css" rel="stylesheet"
        type="text/css">
    <!-- InstanceBeginEditable name="head" -->
    <link rel="stylesheet" href="../css/pellegrina_stijlen.css" type="text/css">
    <style type="text/css">
    <!--
    table#stat {
        width: 100%;
        left: 11px;
        top: 89px;
    }

    p {
        width: auto;
    }

    td {
        width: 25%;
    }

    .cursusnaam {
        vertical-align: top;
        background-color: #BE9495;
        font-weight: bold;
        padding-left: 25px;
    }
    -->
    </style>
    <!-- InstanceEndEditable -->
</head>
<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
    <div id="inhoud">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.EN.php'; ?>
        <div id="main">
            <!-- InstanceBeginEditable name="mainpage" -->
            <h2>Statistics <?php echo $jaar; ?></h2>
            <p>Fund for Music Students and Eastern European Participants&nbsp;
            </p>
            <table id="stat"> <?php
            $i = $eerstecursus;
            while ($i <= $laatstecursus) {
            ?> <tr>
                    <td class="cursusnaam"><?php echo $cursusnaam[$i]; ?>:</td>
                </tr>
                <tr>
                    <td valign="top">
                        <ul>
                            <li>Participants: <?php echo $aangenomen[$i]; ?>
                                <ul>
                                    <li>Of whom students:
                                        <?php echo $student[$i]; ?></li>
                                    <li>Of whom Eastern Europeans:
                                        <?php echo $oost[$i]; ?></li>
                                    <li>Of whom Eastern European students:
                                        <?php echo $ooststudent[$i]; ?></li>
                                    <li>Of whom other participants applying for
                                        a reduction:
                                        <?php echo $reductor[$i]; ?></li>
                                </ul>
                            </li>
                            <li>Donations by
                                participants:&nbsp;<?php echo euro($cursus[$i]['donatie']); ?>
                            </li>
                            <li>Number of
                                donators:&nbsp;<?php echo $donator[$i] . ' (' . round($donator[$i] / $aangenomen[$i] * 100, 1) . ' %)'; ?>
                            </li>
                            <li>Average donation per donator:
                                <?php echo euro($cursus[$i]['donatie'] / $donator[$i]); ?>
                            </li>
                            <li>Average donation per participant:
                                <?php echo euro($cursus[$i]['donatie'] / $aangenomen[$i]); ?><br><br>
                                <ul>
                                    <li>Reductions
                                        applicants:&nbsp;<?php echo euro($cursus[$i]['korting']); ?>
                                    </li> <?php if ($ACMP) { ?> <li>Reductions
                                        students:&nbsp;<?php echo euro($cursus[$i]['student']); ?>
                                    </li>
                                    <li>Reductions Eastern
                                        Europeans:&nbsp;<?php echo euro($cursus[$i]['oost']); ?>
                                    </li>
                                    <li>Reductions Eastern European
                                        students:&nbsp;<?php echo euro($cursus[$i]['ooststudent']); ?>
                                    </li> <?php $cursus[$i]['korting'] += $cursus[$i]['student'] + $cursus[$i]['oost'] + $cursus[$i]['ooststudent'];
                              } ?>
                                </ul>
                            <li>Reductions
                                total:&nbsp;<?php echo euro($cursus[$i]['korting']); ?>
                            </li>
                            <li>People benefitting from a reduction:
                                <?php echo $reductor[$i] + $reductor2[$i] . ' (' . round(($reductor[$i] + $reductor2[$i]) / $aangenomen[$i] * 100, 1) . ' %)'; ?>
                            </li>
                            <li>Average reduction:&nbsp;<?php if ($reductor[$i] + $reductor2[$i] > 0)  echo euro($cursus[$i]['korting'] / ($reductor[$i] + $reductor2[$i]));
                                                      else echo '-' ?></li>
                        </ul>
                    </td> <?php
               $i++;
            }
               ?>
                </tr>
                <tr>
                    <td colspan="<?php echo $aantal_cursussen; ?>" valign="top">
                        <p>Total
                            participants:&nbsp;<?php echo $aangenomen['totaal']; ?>
                            |
                            donations:&nbsp;<?php echo euro($cursus['totaal']['donatie']); ?>
                            | donators:
                            <?php echo $donator['totaal'] . ' (' . round($donator['totaal'] / $aangenomen['totaal'] * 100, 1) . ' %)'; ?>
                            |
                            reductions:&nbsp;<?php echo euro($cursus['totaal']['korting']); ?>
                            | people benefitting from a reduction:
                            <?php echo ($reductor['totaal'] + $reductor2['totaal']) . ' (' . round(($reductor['totaal'] + $reductor2['totaal']) / $aangenomen['totaal'] * 100, 1) . ' %)'; ?>
                        </p>
                    </td>
                </tr>
            </table>
            <!-- InstanceEndEditable -->
            <h2> <a href="javascript: history.go(-1)">Back</a></h2>
            <p>&nbsp;</p>
        </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>
<!-- InstanceEnd -->
</html>