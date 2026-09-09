<?php
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

require_once dirname(__DIR__) . '/includes/includes2027.php';

if (class_exists('Kint')) {
    Kint::$enabled_mode = false;
}

$eersteBeschikbareJaar = 2024;
$ingesteldeJaar = (int) $jaar;
$laatsteBeschikbareJaar = max($eersteBeschikbareJaar, $ingesteldeJaar);
$jaarOffsets = [];
for ($beschikbaarJaar = $eersteBeschikbareJaar;
    $beschikbaarJaar <= $laatsteBeschikbareJaar;
    $beschikbaarJaar++) {
    $jaarOffsets[$beschikbaarJaar] = 57 + (($beschikbaarJaar - 2024) * 2);
}
$gevraagdJaar = filter_input(
    INPUT_GET,
    'jaar',
    FILTER_VALIDATE_INT,
    ['options' => [
        'min_range' => $eersteBeschikbareJaar,
        'max_range' => $laatsteBeschikbareJaar,
    ]]
);
$jaar = array_key_exists($gevraagdJaar, $jaarOffsets)
    ? $gevraagdJaar
    : $ingesteldeJaar;
$cursus_offset = $jaarOffsets[$jaar];
$eerstecursus = $cursus_offset + 1;
$laatstecursus = $cursus_offset + (int) $aantal_cursussen;
$ACMP = true;
$deelnemers = ['totaal' => 0];
$aangenomen = ['totaal' => 0];
$student = ['totaal' => 0];
$oost = ['totaal' => 0];
$ooststudent = ['totaal' => 0];
$donator = ['totaal' => 0];
$reductor = ['totaal' => 0];
$reductor2 = ['totaal' => 0];
$cursus = ['totaal' => [
    'cursusgeld' => 0,
    'aanbet_bedrag' => 0,
    'donatie' => 0,
    'korting' => 0,
]];

function statistics_select_query($query, $index = 2)
{
    global $db;

    try {
        $result = [];
        foreach ($db->query($query, PDO::FETCH_ASSOC) as $row) {
            if (is_string($index) && $index !== '') {
                $result[$row[$index]] = $row;
            } else {
                $result[] = $row;
            }
        }

        if ($index === 0 && count($result) === 1) {
            return (int) array_values($result[0])[0];
        }

        return $result;
    } catch (Throwable $exception) {
        error_log($exception->getMessage());
        return [];
    }
}

function statistics_percentage($numerator, $denominator)
{
    return $denominator > 0 ? round($numerator / $denominator * 100, 1) : 0;
}

function statistics_average($amount, $count)
{
    return $count > 0 ? euro($amount / $count) : '-';
}

// begin Recordset Cursusnamen
$query_cursussen = sprintf(
    "SELECT * FROM cursus WHERE CursusId BETWEEN %s AND %s ORDER BY CursusId ASC",
    $eerstecursus,
    $laatstecursus
);
$cursussen = statistics_select_query($query_cursussen);
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

    $tel = (int) statistics_select_query($tel_query, 0);
    $deelnemers[$i] = $tel;
    $deelnemers['totaal'] += $tel;

    $tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND CursusId_FK = {$i} AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND aangenomen = 1 AND NOT (afgewezen <=> 1)";
    $tel = (int) statistics_select_query($tel_query, 0);
    $aangenomen[$i] = $tel;
    $aangenomen['totaal'] += $tel;

    $tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND CursusId_FK = {$i} AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND NOT (afgewezen <=> 1) AND oost <=> 0 AND student = 1";
    $tel = (int) statistics_select_query($tel_query, 0);
    $student[$i] = $tel;
    $student['totaal'] += $tel;

    $tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND CursusId_FK = {$i} AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND NOT (afgewezen <=> 1) AND student <=> 0 AND oost = 1";
    $tel = (int) statistics_select_query($tel_query, 0);
    $oost[$i] = $tel;
    $oost['totaal'] += $tel;

    $tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND CursusId_FK = {$i} AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND NOT (afgewezen <=> 1) AND student = 1 AND oost = 1";
    $tel = (int) statistics_select_query($tel_query, 0);
    $ooststudent[$i] = $tel;
    $ooststudent['totaal'] += $tel;

    $tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND CursusId_FK = {$i} AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND NOT (afgewezen <=> 1) AND donatie > 0";
    $tel = (int) statistics_select_query($tel_query, 0);
    $donator[$i] = $tel;
    $donator['totaal'] += $tel;

    $tel_query = "SELECT COUNT(*) as aantal FROM inschrijving, dlnmr WHERE DlnmrId=DlnmrId_FK AND CursusId_FK = {$i} AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND NOT (afgewezen <=> 1) AND korting > 0";
    $tel = (int) statistics_select_query($tel_query, 0);
    $reductor[$i] = $tel;
    $reductor['totaal'] += $tel;
    if ($ACMP) {
        $reductor2[$i] += $student[$i] + $oost[$i] + $ooststudent[$i];
        $reductor2['totaal'] += $student[$i] + $oost[$i] + $ooststudent[$i];
    }

    $cursusgelden = statistics_select_query("select sum(cursusgeld) as cursusgeld, sum(aanbet_bedrag) as aanbet_bedrag,
	sum(donatie) as donatie, sum(korting) as korting from inschrijving where aangenomen = 1 AND cursusid_fk = {$i}");
    foreach ($cursusgelden ?: [] as $cursusgeld) {

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
if (class_exists('Kint') && function_exists('d')) {
    d($cursus, $cursussen, $korting, $cursusnaam);
}
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
    <title>Statistics Fund <?php echo $jaar; ?></title>
    <!-- InstanceEndEditable -->
    <?php require_once dirname(__DIR__) . '/includes/metatags+javascript.EN.php'; ?>
    <?php require_once dirname(__DIR__) . '/includes/GA_code.php'; ?>
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
<body> <?php require_once dirname(__DIR__) . '/includes/GA_tagmanager.php'; ?>
    <div id="inhoud">
        <?php require_once dirname(__DIR__) . '/includes/header.EN.php'; ?> <div
            id="main">
            <!-- InstanceBeginEditable name="mainpage" -->
            <h2>Statistics <?php echo $jaar; ?></h2>
            <form method="get"
                action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                <fieldset>
                    <legend>Select year</legend>
                    <?php foreach ($jaarOffsets as $beschikbaarJaar => $offset) { ?>
                    <label>
                        <input type="radio" name="jaar"
                            value="<?php echo $beschikbaarJaar; ?>"
                            <?php echo $beschikbaarJaar === $jaar ? 'checked' : ''; ?>
                            onchange="this.form.submit();">
                        <?php echo $beschikbaarJaar; ?> </label> <?php } ?>
                </fieldset>
            </form>
            <p>Fund for Music Students and Eastern European Participants&nbsp;
            </p>
            <table id="stat"> <?php
                                $i = $eerstecursus;
                                while ($i <= $laatstecursus) {
                                ?> <tr>
                    <td class="cursusnaam">
                        <?php echo htmlspecialchars($cursusnaam[$i] ?? '', ENT_QUOTES, 'UTF-8'); ?>:
                    </td>
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
                                donators:&nbsp;<?php echo $donator[$i] . ' (' . statistics_percentage($donator[$i], $aangenomen[$i]) . ' %)'; ?>
                            </li>
                            <li>Average donation per donator:
                                <?php echo statistics_average($cursus[$i]['donatie'], $donator[$i]); ?>
                            </li>
                            <li>Average donation per participant:
                                <?php echo statistics_average($cursus[$i]['donatie'], $aangenomen[$i]); ?><br><br>
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
                                <?php echo $reductor[$i] + $reductor2[$i] . ' (' . statistics_percentage($reductor[$i] + $reductor2[$i], $aangenomen[$i]) . ' %)'; ?>
                            </li>
                            <li>Average reduction:&nbsp;<?php if ($reductor[$i] + $reductor2[$i] > 0)  echo euro($cursus[$i]['korting'] / ($reductor[$i] + $reductor2[$i]));
                                                            else echo '-' ?>
                            </li>
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
                            <?php echo $donator['totaal'] . ' (' . statistics_percentage($donator['totaal'], $aangenomen['totaal']) . ' %)'; ?>
                            |
                            reductions:&nbsp;<?php echo euro($cursus['totaal']['korting']); ?>
                            | people benefitting from a reduction:
                            <?php echo ($reductor['totaal'] + $reductor2['totaal']) . ' (' . statistics_percentage($reductor['totaal'] + $reductor2['totaal'], $aangenomen['totaal']) . ' %)'; ?>
                        </p>
                    </td>
                </tr>
            </table>
            <!-- InstanceEndEditable -->
            <h2> <a href="javascript: history.go(-1)">Back</a></h2>
            <p>&nbsp;</p>
        </div>
    </div> <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
</body>
<!-- InstanceEnd -->
</html>