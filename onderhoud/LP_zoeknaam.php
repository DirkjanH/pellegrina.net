<?php
Kint::$enabled_mode = true;

d($_REQUEST, $_POST, $_SESSION);

$i = $eerstecursus;
while ($i <= $laatstecursus) {
    $cur[] = $i;
    $i++;
}

if (isset($_POST['DlnmrId']) and $_POST['DlnmrId'] != '') $_SESSION['DlnmrId'] = $_POST['DlnmrId'];

if (empty($_POST['oude_dlnrs'])) $_POST['oude_dlnrs'] = '';
if (empty($_POST['cursus'])) {
    $_POST['cursus'] = 'alles';
    $_POST['zoek'] = 'zoek';
}

if ((isset($_POST["zoek"])) and ($_POST["zoek"] == "zoek") and ($_POST["oude_dlnrs"] == 1)) {

    // begin Recordset
    $zoeknaam = '-1';
    if (isset($_POST['zoeknaam'])) {
        $zoeknaam = $_POST['zoeknaam'];
    } // colname__Inschr
    $query_Inschr = sprintf("SELECT DISTINCT DlnmrId, naam FROM dlnmr WHERE naam LIKE \"%%%s%%\" 
		ORDER BY achternaam ASC", $zoeknaam);
    $Inschr = select_query($query_Inschr);
    if (is_array($Inschr))
        $aantal_ins = count($Inschr);
    else
        $aantal_ins = 0;

    foreach ($Inschr as $ins) {
        $query_Cursussen = sprintf(
            "SELECT CursusId_FK FROM dlnmr, inschrijving WHERE naam = \"%s\" 
			AND DlnmrId = DlnmrId_FK ORDER BY InschrId, CursusId_FK ASC",
            $ins['naam']
        );
        $Cursussen = select_query($query_Cursussen);
        $grijs[$ins['DlnmrId']] = TRUE;
        if (is_array($Cursussen))
            foreach ($Cursussen as $cursus) {
                $grijs[$ins['DlnmrId']] = !(in_array($cursus['CursusId_FK'], $cur));
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
        $query_Inschr = sprintf("SELECT DISTINCT DlnmrId, naam, voorl_bev FROM dlnmr, inschrijving WHERE naam LIKE \"%%%s%%\" 
			AND DlnmrId = DlnmrId_FK AND NOT (afgewezen <=> 1)
			AND CursusId_FK > {$cursus_offset} AND CursusId_FK <= ({$aantal_cursussen} + {$cursus_offset}) 
			ORDER BY achternaam ASC", $zoeknaam);
    } else {
        $query_Inschr = sprintf(
            "SELECT DISTINCT DlnmrId, naam, voorl_bev FROM dlnmr, inschrijving WHERE naam LIKE \"%%%s%%\" 
			AND DlnmrId = DlnmrId_FK AND CursusId_FK=%s AND NOT (afgewezen <=> 1) ORDER BY achternaam ASC",
            $zoeknaam,
            ((int) $_POST['cursus'] + $cursus_offset)
        );
    }
    if ($_POST['cursus'] == 'nieuw') {
        $query_Inschr = "SELECT DISTINCT DlnmrId, naam FROM dlnmr, inschrijving WHERE DlnmrId = DlnmrId_FK AND NOT (afgewezen <=> 1)
			AND CursusId_FK > {$cursus_offset} AND CursusId_FK <= ({$aantal_cursussen} + {$cursus_offset}) AND NOT(aangenomen <=> 1) ORDER BY achternaam ASC";
    }
    $Inschr = select_query($query_Inschr);
    if (isset($Inschr) and is_array($Inschr)) {
        $aantal_ins = count($Inschr);
        $_SESSION['Inschr'] = $Inschr;
    } else $aantal_ins = 0;
} // if zoek

function check($input)
{
    if (isset($_POST['cursus']) and $_POST['cursus'] == $input) echo 'checked';
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
    <div id="inhoud" class="w3-panel"> <?php if (empty($Inschr)) $Inschr = $_SESSION['Inschr'];
                                        d($_SESSION, $Inschr) ?> <form
            id="vinden" method="post"
            action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <p><label>Naam: </label><input name="zoeknaam" type="text"
                    id="zoeknaam" size="15"
                    value="<?php echo $_POST['zoeknaam']; ?>"> <a
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
            <?php if (empty($Inschr)) {
                $Inschr = $_SESSION['Inschr'];
            }
            d($aantal_ins, $Inschr); ?> <p>Kies een naam uit: <span
                    class="klein">(totaal:<?php echo $aantal_ins; ?>)</span></p>
            <div id="navcontainer">
                <ul id="navlist"> <?php foreach ($Inschr as $ins) { ?> <li
                            class="active">
                            <a href="javascript:ToonId(<?php echo $ins['DlnmrId']; ?>)"
                                ;> <?php
                                        if (isset($grijs[$ins['DlnmrId']]) and $grijs[$ins['DlnmrId']])
                                            echo ('<span class="grijs">');
                                        echo "{$ins['naam']} <span class=\"klein\">({$ins['DlnmrId']})</span>";
                                        if (is_null($ins['voorl_bev']))
                                            echo " <span class=\"NogNietBevestigd\">###</span>";
                                        if (isset($grijs[$ins['DlnmrId']]) and $grijs[$ins['DlnmrId']])
                                            echo '</span>'; ?></a>
                        </li> <?php } ?> </ul>
            </div>
            <input type="hidden" name="DlnmrId" id="DlnmrId"
                value="<?php echo isset($_SESSION['DlnmrId']) ? $_SESSION['DlnmrId'] : ''; ?>">
        </form>
    </div>
</body>

</html>