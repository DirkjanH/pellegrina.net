<?php
ob_start();
//	echo dirname(__FILE__);
$filenaam = explode('/', str_replace('/var', '', dirname(__FILE__)));
//Add filename without file extension
$filenaam[7] = basename(__FILE__, ".php");
//	print_r($filenaam);	
switch ($filenaam[6]) {
    case 'romantic':
        $cursus = 1;
        break;
    case 'baroque':
        $cursus = 2;
        break;
}
//	echo 'Cursus is: '.$cursus.'<br>';
$taal = $filenaam[5];
//	echo 'taal is: '.$taal.'<br>';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/cursusdata.php';
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/mollie.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/aanmelding.NL.php';
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/ToggleText.php');
?>
<!DOCTYPE HTML>
<html>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">

<link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
<link rel="stylesheet" href="/css/aanmelding.css" type="text/css">

<head>
    <title>Aanmeldingsformulier '<?php echo $cursusdata['cursusnaam_nl']; ?>'
    </title>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.NL.php'; ?>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>

    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(
                    arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '537749209897328');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=537749209897328&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->

</head>

<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
    <div id="inhoud" class="w3-main"> <?php
                                        echo $navigatie;
                                        echo '<span class="w3-opennav w3-xxlarge w3-hide-large" onclick="w3_open()">☰</span>';
                                        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.NL.php';
                                        ?> <div id="main">
            <?php // Haal de inleiding + het NAW formulier op
            require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/NAW_NL.php'; ?>
            <table class="formulier" id="instr_kop">
                <tr>
                    <td class="linkerkolom"><input name="instrumentalist"
                            id="instr_checkbox" type="checkbox"
                            onclick="ToggleText('instr');"
                            <?php if (isset($_POST['instrumentalist'])) echo 'checked'; ?>>
                    </td>
                    <td><b>Ik meld mij aan als instrumentalist.</b> <span
                            class="nadruk">Vul SVP de vragen die hieronder
                            verschijnen in als je klikt op het vinkje
                            rechts.</span></td>
                </tr>
            </table>
            <table class="formulier" id="instr_vragen">
                <tr>
                    <td class="linkerkolom">&nbsp;</td>
                    <td>
                        <p><strong>Ik bespeel het volgende instrument c.q.
                                instrumenten: <span class="nadruk">(a' = 415 Hz;
                                    meerdere keuzes zijn mogelijk door de
                                    Ctrl-toets ingedrukt te
                                    houden)</span></strong></p>
                        <SELECT NAME="instr[]" size="17" multiple>
                            <OPTGROUP LABEL="Blazers">
                                <OPTION VALUE="112"
                                    <?php
                                    if (isset($instr) and stristr($instr, '112') !== false) echo 'selected'; ?>>
                                    traverso </OPTION>
                                <OPTION VALUE="116"
                                    <?php
                                    if (isset($instr) and stristr($instr, '116') !== false) echo 'selected'; ?>>
                                    blokfluit </OPTION>
                                <OPTION VALUE="122"
                                    <?php
                                    if (isset($instr) and stristr($instr, '122') !== false) echo 'selected'; ?>>
                                    barokhobo </OPTION>
                                <OPTION VALUE="141"
                                    <?php
                                    if (isset($instr) and stristr($instr, '141') !== false) echo 'selected'; ?>>
                                    barokfagot </OPTION>
                                <OPTION VALUE="160"
                                    <?php
                                    if (isset($instr) and stristr($instr, '160') !== false) echo 'selected'; ?>>
                                    baroktrompet</OPTION>
                            </OPTGROUP>
                            <OPTGROUP
                                LABEL="Strijkers (barokinstrumenten of moderne instrumenten met darmsnaren en barokstok)">
                                <OPTION VALUE="210"
                                    <?php
                                    if (isset($instr) and stristr($instr, '210') !== false) echo 'selected'; ?>>
                                    viool</OPTION>
                                <OPTION VALUE="220"
                                    <?php
                                    if (isset($instr) and stristr($instr, '220') !== false) echo 'selected'; ?>>
                                    altviool </OPTION>
                                <OPTION VALUE="230"
                                    <?php
                                    if (isset($instr) and stristr($instr, '230') !== false) echo 'selected'; ?>>
                                    cello</OPTION>
                                <OPTION VALUE="240"
                                    <?php
                                    if (isset($instr) and stristr($instr, '240') !== false) echo 'selected'; ?>>
                                    contrabas </OPTION>
                                <OPTION VALUE="250"
                                    <?php
                                    if (isset($instr) and stristr($instr, '250') !== false) echo 'selected'; ?>>
                                    viola da gamba [SVP bij 'opmerkingen'
                                    aangeven welke instrumenten je bespeelt:
                                    diskant, alt/tenor en/of bas]</OPTION>
                            </OPTGROUP>
                            <OPTGROUP LABEL="Continuo-instrumenten">
                                <OPTION VALUE="320"
                                    <?php
                                    if (isset($instr) and stristr($instr, '320') !== false) echo 'selected'; ?>>
                                    clavecimbel </OPTION>
                                <OPTION VALUE="330"
                                    <?php
                                    if (isset($instr) and stristr($instr, '330') !== false) echo 'selected'; ?>>
                                    orgel</OPTION>
                                <OPTION VALUE="340"
                                    <?php
                                    if (isset($instr) and stristr($instr, '340') !== false) echo 'selected'; ?>>
                                    theorbe </OPTION>
                            </OPTGROUP>
                            <OPTION VALUE="000"
                                <?php
                                if (isset($instr) and stristr($instr, '000') !== false) echo 'selected'; ?>>
                                anders [SVP bij 'opmerkingen' beschrijven]
                            </OPTION>
                        </SELECT>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Niveau: <input name="niveau_i" type="radio"
                            value="redelijk"
                            <?php if (isset($_POST['niveau_i']) and ($_POST['niveau_i'] == "redelijk")) echo 'checked'; ?>>
                        redelijk gevorderd&#160; <input type="radio"
                            name="niveau_i" value="zeer"
                            <?php if (isset($_POST['niveau_i']) and ($_POST['niveau_i'] == "zeer")) echo 'checked'; ?>>
                        zeer gevorderd&#160; <input type="radio" name="niveau_i"
                            value="student"
                            <?php if (isset($_POST['niveau_i']) and ($_POST['niveau_i'] == "student")) echo 'checked'; ?>>
                        student <input type="radio" name="niveau_i"
                            value="beroeps"
                            <?php if (isset($_POST['niveau_i']) and ($_POST['niveau_i'] == "beroeps")) echo 'checked'; ?>>
                        beroepsniveau</td>
                </tr>
                <tr>
                    <td></td>
                    <td><br> Noem enkele stukken die je goed beheerst:</td>
                </tr>
                <tr>
                    <td></td>
                    <td><textarea name="stukken_i" rows="4"
                            cols="70"><?php
                                        if (isset($_POST['stukken_i'])) echo $_POST['stukken_i']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Ik heb&#160; <input name="ervaring_i" type="radio"
                            value="weinig"
                            <?php
                            if (isset($_POST['ervaring_i']) and ($_POST['ervaring_i'] == "weinig")) echo 'checked'; ?>>
                        weinig&#160; <input type="radio" name="ervaring_i"
                            value="enige"
                            <?php
                            if (isset($_POST['ervaring_i']) and ($_POST['ervaring_i'] == "enige")) echo 'checked'; ?>>
                        enige&#160; <input type="radio" name="ervaring_i"
                            value="veel"
                            <?php
                            if (isset($_POST['ervaring_i']) and ($_POST['ervaring_i'] == "veel")) echo 'checked'; ?>>
                        uitgebreide ervaring met kamermuziek</td>
                </tr>
            </table>
            <hr>
            <table class="formulier" id="zang_kop">
                <tr>
                    <td class="linkerkolom"><input name="zanger"
                            id="zang_checkbox" type="checkbox"
                            onclick="ToggleText('zang');"
                            <?php if (isset($_POST['zanger'])) echo 'checked'; ?>>
                    </td>
                    <td><b>Ik meld mij aan als zanger.</b> <span
                            class="nadruk">Vul SVP de vragen die hieronder
                            verschijnen in</span></td>
                </tr>
            </table>
            <table class="formulier" id="zang_vragen">
                <tr>
                    <td class="linkerkolom">&nbsp;</td>
                    <td><strong>
                            <p>Ik heb het volgende stemtype:</p>
                        </strong>
                        <input name="zangstem" type="radio" value="10"
                            <?php if (isset($_POST['zangstem']) and ($_POST['zangstem'] == "10")) echo 'checked'; ?>>
                        sopraan  <input type="radio" name="zangstem" value="20"
                            <?php if (isset($_POST['zangstem']) and ($_POST['zangstem'] == "20")) echo 'checked'; ?>>
                        mezzosopraan  <input type="radio" name="zangstem"
                            value="30"
                            <?php if (isset($_POST['zangstem']) and ($_POST['zangstem'] == "30")) echo 'checked'; ?>>
                        alt  <input type="radio" name="zangstem" value="40"
                            <?php if (isset($_POST['zangstem']) and ($_POST['zangstem'] == "40")) echo 'checked'; ?>>
                        countertenor  <input type="radio" name="zangstem"
                            value="50"
                            <?php if (isset($_POST['zangstem']) and ($_POST['zangstem'] == "50")) echo 'checked'; ?>>
                        tenor  <input type="radio" name="zangstem" value="60"
                            <?php if (isset($_POST['zangstem']) and ($_POST['zangstem'] == "60")) echo 'checked'; ?>>
                        bariton  <input type="radio" name="zangstem" value="70"
                            <?php if (isset($_POST['zangstem']) and ($_POST['zangstem'] == "70")) echo 'checked'; ?>>
                        bas
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Niveau:  <input name="niveau_z" type="radio"
                            value="redelijk"
                            <?php
                            if (isset($_POST['niveau_z']) and ($_POST['niveau_z'] == "redelijk")) echo 'checked'; ?>>
                        redelijk gevorderd <input type="radio" name="niveau_z"
                            value="zeer"
                            <?php if (isset($_POST['niveau_z']) and ($_POST['niveau_z'] == "zeer")) echo 'checked'; ?>>
                        zeer gevorderd <input type="radio" name="niveau_z"
                            value="zangstudent"
                            <?php if (isset($_POST['niveau_z']) and ($_POST['niveau_z'] == "zangstudent")) echo 'checked'; ?>>
                        zangstudent <input type="radio" name="niveau_z"
                            value="beroeps"
                            <?php if (isset($_POST['niveau_z']) and ($_POST['niveau_z'] == "beroeps")) echo 'checked'; ?>>
                        beroepsniveau</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Noem enkele stukken die je goed beheerst:</td>
                </tr>
                <tr>
                    <td></td>
                    <td><strong>
                            <textarea name="stukken_z" rows="4"
                                cols="70"><?php
                                            if (isset($_POST['stukken_z'])) echo $_POST['stukken_z']; ?></textarea>
                        </strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Ik heb<strong>&#160; <input name="ervaring_z"
                                type="radio" value="weinig" <?php if (isset($_POST['ervaring_z']) and ($_POST['ervaring_z'] == "weinig"))
                                                                echo 'checked'; ?>>
                        </strong>weinig<strong>&#160; <input type="radio"
                                name="ervaring_z" value="enige"
                                <?php if (isset($_POST['ervaring_z']) and ($_POST['ervaring_z'] == "enige")) echo 'checked'; ?>>
                        </strong>enige<strong>&#160; <input type="radio"
                                name="ervaring_z" value="veel"
                                <?php if (isset($_POST['ervaring_z']) and ($_POST['ervaring_z'] == "veel")) echo 'checked'; ?>>
                        </strong>uitgebreide ervaring met zingen in kleine
                        ensembles</td>
                </tr>
            </table>
            <hr>
            <table class="formulier">
                <tr>
                    <td class="linkerkolom"><input type="checkbox"
                            name="toehoorder" value="500"
                            <?php
                            if (isset($_POST['toehoorder']) and $_POST['toehoorder'] == 500) echo 'checked'; ?>></td>
                    <td><b>Ik meld me aan als toehoorder</b><span
                            class="nadruk"><b> </b>(prijs
                            <?php echo euro($cursusdata['toehoorder']); ?> incl.
                            een plaats in een tweepersoonskamer en
                            volpension)</span></td>
                </tr>
            </table>
            <hr>
            <p><strong> Geef SVP hieronder je voorkeur aan voor je
                    accommodatie.</strong><br>
                <span class="nadruk">De basisprijs is incl. een plaats in een
                    tweepersoonskamer en volpension. Als je dat wilt hoef je
                    niets aan te vinken.</span>
            </p>
            <table class="formulier">
                <tr>
                    <td class="linkerkolom"><input type="checkbox"
                            name="eenpersoons" id="eenpersoons" value="1"
                            <?php if (isset($_POST['eenpersoons']) and $_POST['eenpersoons'] == 1) echo 'checked'; ?>>
                    </td>
                    <td>Ik wil bij voorkeur een eenpersoonskamer <span
                            class="nadruk">(meerprijs
                            <?php echo euro($cursusdata['eenpers']) ?>; beperkt
                            beschikbaar)</span></td>
                </tr>
                <tr>
                    <td class="linkerkolom"><input name="kamperen"
                            type="checkbox" id="kamperen" value="1"
                            <?php if (isset($_POST['kamperen']) and $_POST['kamperen'] == 1) echo 'checked'; ?>>
                    </td>
                    <td>Ik wil graag kamperen op de kloostercamping <span
                            class="nadruk">(korting
                            <?php echo euro($cursusdata['kamperen']) ?> per
                            persoon; beperkt beschikbaar)</span></td>
                </tr>
                <tr>
                    <td class="linkerkolom"><input name="eigen_acc"
                            type="checkbox" id="eigen_acc" value="1"
                            <?php if (isset($_POST['eigen_acc']) and $_POST['eigen_acc'] == 1) echo 'checked'; ?>>
                    </td>
                    <td>
                        <p>Ik regel mijn eigen accommodatie en maak alleen
                            gebruik van de gezamenlijke lunch, diner en
                            koffie/thee <span class="nadruk">(korting
                                <?php echo euro($cursusdata['korting_eigen_acc']) ?>)</span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="linkerkolom">&nbsp;</td>
                    <td><input name="diner" type="checkbox" id="diner" value="1"
                            <?php if (isset($_POST['diner']) and $_POST['diner'] == 1) echo 'checked'; ?>><label>
                            Hoewel ik mijn eigen accommodatie regel (en daarvoor
                            de korting van
                            <?php echo euro($cursusdata['korting_eigen_acc']) ?>
                            krijg), maak ik graag ook gebruik van het
                            gezamenlijke diner <span class="nadruk">(meerprijs
                                <?php echo euro($cursusdata['diner']) ?>)</span></label>
                    </td>
                </tr>
            </table>
            <p>Andere wensen t.a.v. huisvesting <span class="nadruk">(b.v.
                    voorkeuren voor kamers delen)</span>: <br>
                <textarea name="acc_wens" cols="70"
                    rows="5"><?php if (isset($_POST['acc_wens'])) echo $_POST['acc_wens']; ?></textarea>
            </p>
            <hr>
            <p>Eventuele dieetwensen: <input name="dieet" type=text id="dieet"
                    value="<?php
                            if (isset($_POST['Dieet']) and $_POST['Dieet'] != "") echo $_POST['Dieet'];
                            else echo "[geen]"; ?>">
            </p>
            <hr>
            <table class="formulier">
                <tr>
                    <td>
                        <p><br> Ik reis naar de cursuslocatie op de volgende
                            wijze: <span class="nadruk">(graag een optie
                                aanklikken)</span><br>
                            <select name="vervoer" size="5" id="vervoer">
                                <option value="???" <?php
                                                    if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "???")) echo 'selected';
                                                    ?>>nog niet bekend</option>
                                <option value="car (0 pl.)" <?php
                                                            if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "car (0 pl.)"))
                                                                echo 'selected'; ?>>met eigen
                                    auto, geen plaats voor meerijders</option>
                                <option value="car (? pl.)" <?php
                                                            if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "car (? pl.)")) echo 'selected';
                                                            ?>>met eigen auto, mogelijk plaats
                                    voor meerijder(s)</option>
                                <option value="ride" <?php
                                                        if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "ride")) echo 'selected';
                                                        ?>>graag meerijden</option>
                                <option value="train" <?php
                                                        if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "train")) echo 'selected';
                                                        ?>>per openbaar vervoer</option>
                            </select>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td><br> Anders, n.l.<br>
                        <textarea name="reistype"
                            rows="3"><?php
                                        if (isset($_POST['reistype'])) echo $_POST['reistype']; ?></textarea>
                    </td>
                </tr>
            </table>
            <hr>
            <table class="formulier">
                <tr>
                    <td class="linkerkolom"><input name="storting_fonds"
                            type="checkbox" value="1" <?php if (
                                                            isset($_POST['storting_fonds'])
                                                            and $_POST['storting_fonds'] == 1
                                                        ) echo 'checked'; ?>></td>
                    <td>Ik ben bereid een bedrag van &euro; <input
                            name="donatie" type=text id="donatie" value="<?php
                                                                            if (isset($_POST['donatie']) and $_POST['donatie'] > 0) {
                                                                                $_POST['storting_fonds'] = 1;
                                                                                echo $_POST['donatie'];
                                                                            } ?>"> te storten
                        in het kortingenfonds&#160;ten behoeve van
                        muziekstudenten.&#160;</td>
                </tr>
                <tr>
                    <td class="linkerkolom"><input type="checkbox"
                            name="student" value="1" id="student"
                            <?php if (isset($_POST['student']) and $_POST['student'] == 1) echo 'checked'; ?>>
                        <label for="checkbox"></label>
                    </td>
                    <td>Ik ben student en/of jonger dan 36 jaar <span
                            class="nadruk">(cursusgeld
                            <?php echo euro($cursusdata['prijs_student']); ?>
                            incl. plaats in tweepersoonskamer en volpension; SVP
                            kopie bewijs van inschrijving of paspoort per mail
                            insturen)</span></td>
                </tr>
                <tr>
                    <td class="linkerkolom"><input name="info_korting"
                            type="checkbox" id="info_korting" value="1" <?php
                                                                        if (
                                                                            isset($_POST['info_korting'])
                                                                            and $_POST['info_korting'] == 1
                                                                        ) echo 'checked'; ?>>
                    </td>
                    <td>Ik ben muziekstudent en zou informatie over
                        kortingsmogelijkheden willen ontvangen.&#160;</td>
                </tr>
                <tr>
                    <td colspan="2"><br> Verdere opmerkingen en
                        aanvullingen:<br>
                        <textarea name="opmerkingen" cols="70"
                            rows="5"><?php if (isset($_POST['opmerkingen'])) echo $_POST['opmerkingen']; ?></textarea>
                    </td>
                </tr>
            </table>
            <hr>
            <h3>Betaling inschrijfgeld</h3>
            <table border="0" class="formulier">
                <tr>
                    <td class="linkerkolom"><input type="radio" name="betaling"
                            value="mollie" checked></td>
                    <td><label>Ik betaal het inschrijfgeld van
                            <?php echo euro($cursusdata['inschrijfgeld']); ?>
                            online, met elektronisch bankieren of creditcard.
                            <span class="nadruk">(N.B. Wanneer je dit formulier
                                verstuurt, word je doorgestuurd naar onze online
                                betalingsdienst. Indien je betaalt met een
                                creditcard houdt de creditcard-maatschappij
                                daarvan een commissie van ca. 3 % in. Dit
                                verrekenen wij met de volgende
                                betaling)</span></label></td>
                </tr>
                <tr>
                    <td><input type="radio" name="betaling" value="transfer">
                    </td>
                    <td><label>Ik betaal de aanbetaling per bankoverschrijving.
                            <span class="nadruk">(Gebruik deze optie als het
                                cursusgeld lager is dan
                                <?php echo euro($cursusdata['inschrijfgeld'] * 2); ?>,
                                bijvoorbeeld voor de Centraal-Europese of
                                Tsjechische prijzen. De aanbetaling is vereist
                                voor verdere verwerking)</span></label></td>
                </tr>
            </table>
            <p>Kijk op de pagina <a href="praktisch.php"
                    target="_blank">praktische zaken</a> voor handige manieren
                van internationaal betalen.</p>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/akkoord_voorwaarden_NL.php'; ?>
            <h2><a href="javascript: history.go(-1)">Terug</a></h2>
        </div>
    </div>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html> <?php ob_end_flush(); ?>