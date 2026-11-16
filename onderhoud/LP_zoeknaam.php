<?php
Kint::$enabled_mode = false;

d($_REQUEST, $_POST, $_SESSION);

$i = $eerstecursus;
while ($i <= $laatstecursus) {
    $cur[] = $i;
    $i++;
}

if (isset($_POST['DlnmrId']) && $_POST['DlnmrId'] !== '') {
    $deelnemerId = filter_var($_POST['DlnmrId'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if ($deelnemerId === false) {
        http_response_code(400);
        exit('Ongeldig deelnemersnummer.');
    }
    $_SESSION['DlnmrId'] = (string) $deelnemerId;
}

if (isset($_POST['zoek']) && $_POST['zoek'] === 'zoek') {
    if (!is_string($_POST['zoeknaam'] ?? '') ||
        !is_string($_POST['cursus'] ?? 'alles') ||
        !in_array($_POST['cursus'] ?? 'alles', ['alles', '1', '2', 'nieuw'], true) ||
        (isset($_POST['oude_dlnrs']) && $_POST['oude_dlnrs'] !== '1')) {
        http_response_code(400);
        exit('Ongeldige zoekopdracht.');
    }
    $_SESSION['LP_zoeknaam'] = [
        'zoeknaam' => $_POST['zoeknaam'] ?? '',
        'oude_dlnrs' => isset($_POST['oude_dlnrs']) && $_POST['oude_dlnrs'] == '1' ? '1' : '',
        'cursus' => !empty($_POST['cursus']) ? $_POST['cursus'] : 'alles',
    ];
}

$zoekinstellingen = $_SESSION['LP_zoeknaam'] ?? [
    'zoeknaam' => '',
    'oude_dlnrs' => '',
    'cursus' => !empty($_SESSION['cursuskeuze']) ? $_SESSION['cursuskeuze'] : 'alles',
];
$_POST['zoeknaam'] = $zoekinstellingen['zoeknaam'];
$_POST['oude_dlnrs'] = $zoekinstellingen['oude_dlnrs'];
$_POST['cursus'] = $zoekinstellingen['cursus'];
$_POST['zoek'] = 'zoek';
$_SESSION['cursuskeuze'] = $_POST['cursus'];

if ((isset($_POST["zoek"])) and ($_POST["zoek"] == "zoek") and ($_POST["oude_dlnrs"] == 1)) {

    // begin Recordset
    $zoeknaam = '-1';
    if (isset($_POST['zoeknaam'])) {
        $zoeknaam = $_POST['zoeknaam'];
    } // colname__Inschr
    $query_Inschr = "SELECT DISTINCT DlnmrId, naam FROM dlnmr WHERE naam LIKE ? ORDER BY achternaam ASC";
    $Inschr = lp_zoek_query($query_Inschr, ['%' . $zoeknaam . '%']);

    foreach ($Inschr as $ins) {
        $query_Cursussen = "SELECT CursusId_FK FROM dlnmr, inschrijving WHERE naam = ?
            AND DlnmrId = DlnmrId_FK ORDER BY InschrId, CursusId_FK ASC";
        $Cursussen = lp_zoek_query($query_Cursussen, [$ins['naam']]);
        $grijs[$ins['DlnmrId']] = TRUE;
        if ($Cursussen)
            foreach ($Cursussen as $cursusdeelname) {
                $grijs[$ins['DlnmrId']] = !(in_array($cursusdeelname['CursusId_FK'], $cur));
            } // foreach Cursussen
        else
            echo ('Geen namen gevonden</br>');
    } // foreach Inschr
} // if zoek

if ((isset($_POST["zoek"])) && ($_POST["zoek"] == "zoek") and ($_POST["oude_dlnrs"] != 1)) {

    // begin Recordset
    $zoeknaam = '-1';
    if (isset($_POST['zoeknaam'])) {
        $zoeknaam = $_POST['zoeknaam'];
    } // colname__Inschr
    if (empty($_POST['cursus']) or $_POST['cursus'] == 'alles') {
        $query_Inschr = "SELECT DISTINCT DlnmrId, naam, voorl_bev FROM dlnmr, inschrijving WHERE naam LIKE ?
			AND DlnmrId = DlnmrId_FK AND NOT (afgewezen <=> 1)
			AND CursusId_FK > {$cursus_offset} AND CursusId_FK <= ({$aantal_cursussen} + {$cursus_offset}) 
			ORDER BY achternaam ASC";
        $zoekparameters = ['%' . $zoeknaam . '%'];
    } else {
        $query_Inschr = "SELECT DISTINCT DlnmrId, naam, voorl_bev FROM dlnmr, inschrijving WHERE naam LIKE ?
			AND DlnmrId = DlnmrId_FK AND CursusId_FK=? AND NOT (afgewezen <=> 1) ORDER BY achternaam ASC";
        $zoekparameters = [
            '%' . $zoeknaam . '%',
            ((int) $_POST['cursus'] + $cursus_offset)
        ];
    }
    if ($_POST['cursus'] == 'nieuw') {
        $query_Inschr = "SELECT DISTINCT DlnmrId, naam FROM dlnmr, inschrijving WHERE DlnmrId = DlnmrId_FK AND NOT (afgewezen <=> 1)
			AND CursusId_FK > {$cursus_offset} AND CursusId_FK <= ({$aantal_cursussen} + {$cursus_offset}) AND NOT(aangenomen <=> 1) ORDER BY achternaam ASC";
        $zoekparameters = [];
    }
    $Inschr = lp_zoek_query($query_Inschr, $zoekparameters);
} // if zoek

$aantal_ins = count($Inschr);
$_SESSION['Inschr'] = $Inschr;

function check($input)
{
    if (isset($_POST['cursus']) and $_POST['cursus'] == $input) echo 'checked';
}

function lp_zoek_query($query, $parameters)
{
    global $db;
    try {
        $statement = $db->prepare($query);
        $statement->execute($parameters);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log('LP_zoeknaam: databasefout: ' . $exception->getMessage());
        if (!headers_sent()) http_response_code(500);
        exit('De deelnemers konden niet worden geladen.');
    }
}

?>
<!DOCTYPE HTML>
<html>

<head>
    <script type="text/javascript">
        function ToonId(Id) {
            document.getElementById('DlnmrId').value = Id;
            document.getElementById('vinden').submit();
        }

        function wis() {
            document.getElementById("zoeknaam").value = "";
        }
    </script>
</head>

<body>
    <div id="inhoud"> <?php d($_SESSION, $Inschr) ?> <form
            id="vinden" method="post"
            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>">
            <p><label>Naam: </label><input name="zoeknaam" type="text"
                    id="zoeknaam" size="15"
                    value="<?php echo htmlspecialchars($_POST['zoeknaam'], ENT_QUOTES, 'UTF-8'); ?>"> <a
                    href="javascript:wis()" class="w3-text-red w3-hover-white"
                    style="text-decoration: none; padding: 10px;"><b>X</b></a><br>
                <label>Alle deelnemers van ooit: </label><input
                    name="oude_dlnrs" type="checkbox" id="oude_dlnrs" value="1"
                    <?php if (isset($_POST['oude_dlnrs']) and $_POST['oude_dlnrs'] != '')
                        echo 'checked'; ?>><br>
                <input type="radio" name="cursus" value="alles"
                    onclick="javascript: submit();"
                    <?php check('alles'); ?>><label> Alles</label><br>
                <input type="radio" name="cursus" value="1"
                    onclick="javascript: submit();" <?php check('1'); ?>><label>
                    1. Romantiek in CB</label><br>
                <input type="radio" name="cursus" value="2"
                    onclick="javascript: submit();" <?php check('2'); ?>><label>
                    2. Barok in NS</label><br>
                <input type="radio" name="cursus" value="nieuw"
                    onclick="javascript: submit();"
                    <?php check('nieuw'); ?>><label> Nieuwe
                    inschrijvingen</label>
            </p>
            <input name="zoek" type="hidden" id="zoek" value="zoek">
            <?php d($aantal_ins, $Inschr); ?> <p>Kies een naam uit: <span
                    class="klein">(totaal:<?php echo $aantal_ins; ?>)</span></p>
            <div id="navcontainer">
                <ul id="navlist"> <?php foreach ($Inschr as $ins) { ?> <li
                            class="active">
                            <a href="javascript:ToonId(<?php echo (int) $ins['DlnmrId']; ?>)"
                                ;> <?php
                                        if (isset($grijs[$ins['DlnmrId']]) and $grijs[$ins['DlnmrId']])
                                            echo ('<span class="grijs">');
                                        echo htmlspecialchars($ins['naam'], ENT_QUOTES, 'UTF-8') . ' <span class="klein">(' . (int) $ins['DlnmrId'] . ')</span>';
                                        if (is_null($ins['voorl_bev'] ?? null))
                                            echo " <span class=\"NogNietBevestigd\">###</span>";
                                        if (isset($grijs[$ins['DlnmrId']]) and $grijs[$ins['DlnmrId']])
                                            echo '</span>'; ?></a>
                        </li> <?php } ?> </ul>
            </div>
            <input type="hidden" name="DlnmrId" id="DlnmrId"
                value="<?php echo isset($_SESSION['DlnmrId']) ? (int) $_SESSION['DlnmrId'] : ''; ?>">
        </form>
    </div>
</body>

</html>