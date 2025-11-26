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
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/aanmelding.EN.php';
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/ToggleText.php');
?>
<!DOCTYPE HTML>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">

<link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
<link rel="stylesheet" href="/css/aanmelding.css" type="text/css">

<head>
    <title>Aanmeldingsformulier '<?php echo $cursusdata['cursusnaam_en']; ?>'
    </title>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.EN.php'; ?>
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
            require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/NAW_EN.php'; ?>
            <table class="formulier" id="instr_kop">
                <tr>
                    <td class="linkerkolom"><input name="instrumentalist"
                            id="instr_checkbox" type="checkbox"
                            onclick="ToggleText('instr');"
                            <?php if (isset($_POST['instrumentalist'])) echo 'checked'; ?>>
                    </td>
                    <td><b>I register as instrumentalist.</b> <span
                            class="nadruk">Please fill out the questions
                            appearing below when you click on the
                            checkbox</span></td>
                </tr>
            </table>
            <table class="vraagtabel" id="instr_vragen">
                <tr>
                    <td class="linkerkolom">&nbsp;</td>
                    <td>
                        <p><b>I wish to play the following instrument(s): <span
                                    class="nadruk">(multiple choices are
                                    possible by keeping the Ctrl key pressed)
                                </span></b></p>
                        <SELECT NAME="instr[]" size="17" multiple>
                            <OPTGROUP LABEL="Winds">
                                <OPTION VALUE="112"
                                    <?php
                                    if (isset($instr) and stristr($instr, '112') !== false) echo 'selected'; ?>>
                                    traverso </OPTION>
                                <OPTION VALUE="116"
                                    <?php
                                    if (isset($instr) and stristr($instr, '116') !== false) echo 'selected'; ?>>
                                    recorder </OPTION>
                                <OPTION VALUE="122"
                                    <?php
                                    if (isset($instr) and stristr($instr, '122') !== false) echo 'selected'; ?>>
                                    baroque oboe </OPTION>
                                <OPTION VALUE="141"
                                    <?php
                                    if (isset($instr) and stristr($instr, '141') !== false) echo 'selected'; ?>>
                                    baroque bassoon</OPTION>
                                <OPTION VALUE="160"
                                    <?php
                                    if (isset($instr) and stristr($instr, '160') !== false) echo 'selected'; ?>>
                                    baroque trumpet</OPTION>
                                <OPTION VALUE="170"
                                    <?php
                                    if (isset($instr) and stristr($instr, '170') !== false) echo 'selected'; ?>>
                                    baroque trombone</OPTION>
                            </OPTGROUP>
                            <OPTGROUP LABEL="Strings">
                                <OPTION VALUE="210"
                                    <?php
                                    if (isset($instr) and stristr($instr, '210') !== false) echo 'selected'; ?>>
                                    violin </OPTION>
                                <OPTION VALUE="220"
                                    <?php
                                    if (isset($instr) and stristr($instr, '220') !== false) echo 'selected'; ?>>
                                    viola</OPTION>
                                <OPTION VALUE="230"
                                    <?php
                                    if (isset($instr) and stristr($instr, '230') !== false) echo 'selected'; ?>>
                                    cello</OPTION>
                                <OPTION VALUE="240"
                                    <?php
                                    if (isset($instr) and stristr($instr, '240') !== false) echo 'selected'; ?>>
                                    double bass </OPTION>
                                <OPTION VALUE="250"
                                    <?php
                                    if (isset($instr) and stristr($instr, '250') !== false) echo 'selected'; ?>>
                                    viola da gamba [please indicate under
                                    'remarks' which instruments you play:
                                    descant, alto/tenor and/or bass]</OPTION>
                            </OPTGROUP>
                            <OPTGROUP LABEL="Continuo instruments">
                                <OPTION VALUE="320"
                                    <?php
                                    if (isset($instr) and stristr($instr, '320') !== false) echo 'selected'; ?>>
                                    harpsichord </OPTION>
                                <OPTION VALUE="330"
                                    <?php
                                    if (isset($instr) and stristr($instr, '330') !== false) echo 'selected'; ?>>
                                    organ</OPTION>
                                <OPTION VALUE="340"
                                    <?php
                                    if (isset($instr) and stristr($instr, '340') !== false) echo 'selected'; ?>>
                                    theorbo </OPTION>
                            </OPTGROUP>
                            <OPTION VALUE="000"
                                <?php
                                if (isset($instr) and stristr($instr, '000') !== false) echo 'selected'; ?>>
                                other [please describe under 'remarks']</OPTION>
                        </SELECT>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Ability: <input name="niveau_i" type="radio"
                            value="redelijk"
                            <?php if (isset($_POST['niveau_i']) and ($_POST['niveau_i'] == "redelijk")) echo 'checked'; ?>>
                        fairly advanced&nbsp; <input type="radio"
                            name="niveau_i" value="zeer"
                            <?php if (isset($_POST['niveau_i']) and ($_POST['niveau_i'] == "zeer")) echo 'checked'; ?>>
                        well advanced&nbsp; <input type="radio" name="niveau_i"
                            value="student"
                            <?php if (isset($_POST['niveau_i']) and ($_POST['niveau_i'] == "student")) echo 'checked'; ?>>
                        student <input type="radio" name="niveau_i"
                            value="beroeps"
                            <?php if (isset($_POST['niveau_i']) and ($_POST['niveau_i'] == "beroeps")) echo 'checked'; ?>>
                        professional standard </td>
                </tr>
                <tr>
                    <td></td>
                    <td><br> Mention several pieces which you can play well:
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><strong>
                            <textarea name="stukken_i" rows="4"
                                cols="70"><?php
                                            if (isset($_POST['stukken_i'])) echo $_POST['stukken_i']; ?></textarea>
                        </strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td>I have&nbsp; <input name="ervaring_i" type="radio"
                            value="weinig"
                            <?php
                            if (isset($_POST['ervaring_i']) and ($_POST['ervaring_i'] == "weinig")) echo 'checked'; ?>>
                        little&nbsp; <input type="radio" name="ervaring_i"
                            value="enige"
                            <?php
                            if (isset($_POST['ervaring_i']) and ($_POST['ervaring_i'] == "enige")) echo 'checked'; ?>>
                        some&nbsp; <input type="radio" name="ervaring_i"
                            value="veel"
                            <?php
                            if (isset($_POST['ervaring_i']) and ($_POST['ervaring_i'] == "veel")) echo 'checked'; ?>>
                        extensive experience in chamber music.</td>
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
                    <td><b>I register as a singer.</b> <span
                            class="nadruk">Please fill out the questions
                            appearing below</span></td>
                </tr>
            </table>
            <table class="vraagtabel" id="zang_vragen">
                <tr>
                    <td class="linkerkolom">&nbsp;</td>
                    <td>
                        <p><strong>My voice type is:</strong></p>
                        <input name="zangstem" type="radio" value="10"
                            <?php
                            if (isset($_POST['zangstem']) and ($_POST['zangstem'] == "10")) echo 'checked'; ?>>soprano  <input
                            type="radio" name="zangstem" value="20"
                            <?php
                            if (isset($_POST['zangstem']) and ($_POST['zangstem'] == "20")) echo 'checked'; ?>>mezzosoprano  <input
                            type="radio" name="zangstem" value="30"
                            <?php
                            if (isset($_POST['zangstem']) and ($_POST['zangstem'] == "30")) echo 'checked'; ?>>alto  <input
                            type="radio" name="zangstem" value="40"
                            <?php
                            if (isset($_POST['zangstem']) and ($_POST['zangstem'] == "40")) echo 'checked'; ?>>countertenor  <input
                            type="radio" name="zangstem" value="50"
                            <?php
                            if (isset($_POST['zangstem']) and ($_POST['zangstem'] == "50")) echo 'checked'; ?>>tenor  <input
                            type="radio" name="zangstem" value="60"
                            <?php
                            if (isset($_POST['zangstem']) and ($_POST['zangstem'] == "60")) echo 'checked'; ?>>baritone  <input
                            type="radio" name="zangstem" value="70"
                            <?php
                            if (isset($_POST['zangstem']) and ($_POST['zangstem'] == "70")) echo 'checked'; ?>>bass
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Ability:  <input name="niveau_z" type="radio"
                            value="redelijk"
                            <?php
                            if (isset($_POST['niveau_z']) and ($_POST['niveau_z'] == "redelijk")) echo 'checked'; ?>>
                        fairly advanced  <input type="radio" name="niveau_z"
                            value="zeer"
                            <?php
                            if (isset($_POST['niveau_z']) and ($_POST['niveau_z'] == "zeer")) echo 'checked'; ?>>
                        well advanced  <input type="radio" name="niveau_z"
                            value="zangstudent"
                            <?php
                            if (isset($_POST['niveau_z']) and ($_POST['niveau_z'] == "zangstudent")) echo 'checked'; ?>>
                        singing student  <input type="radio" name="niveau_z"
                            value="beroeps"
                            <?php
                            if (isset($_POST['niveau_z']) and ($_POST['niveau_z'] == "beroeps")) echo 'checked'; ?>>
                        professional standard</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Please mention several pieces which you can sing well:
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><textarea name="stukken_z" rows="4"
                            cols="70"><?php
                                        if (isset($_POST['stukken_z'])) echo $_POST['stukken_z']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>I have&nbsp; <input name="ervaring_z" type="radio"
                            value="weinig"
                            <?php
                            if (isset($_POST['ervaring_z']) and ($_POST['ervaring_z'] == "weinig")) echo 'checked'; ?>>little&nbsp;
                        <input type="radio" name="ensemble_z" value="enige"
                            <?php
                            if (isset($_POST['ervaring_z']) and ($_POST['ervaring_z'] == "enige")) echo 'checked'; ?>>some&nbsp; <input
                            type="radio" name="ensemble_z" value="veel"
                            <?php
                            if (isset($_POST['ervaring_z']) and ($_POST['ervaring_z'] == "veel")) echo 'checked'; ?>> extensive
                        experience in solo ensembles.
                    </td>
                </tr>
            </table>
            <hr>
            <table class="formulier onzichtbaar">
                <tr>
                    <td class="linkerkolom"><input type="checkbox"
                            name="toehoorder" value="500"
                            <?php
                            if (isset($_POST['toehoorder']) and $_POST['toehoorder'] == 500) echo 'checked'; ?>></td>
                    <td><b>I wish to attend as auditor </b><span
                            class="nadruk">(fee
                            <?php echo euro_en($cursusdata['toehoorder']); ?>)</span>
                    </td>
                </tr>
            </table>
            <hr>
            <p><strong>Please indicate underneath your accommodation preferences</strong><br>
                <span class="nadruk">Standard accommodation is a place in a double room at the Guest House (Gastenverblijf) and full board. If that
                    is what you want you don't need to indicate other wishes here.</span>
            </p>
            <table class="formulier">
                <tr>
                    <td class="linkerkolom"><input type="checkbox" name="hotel_2pp" id="hotel_2pp" value="1"
                            <?php if (isset($_POST["hotel_2pp"]) and $_POST["hotel_2pp"] == 1) echo "checked"; ?>>
                    </td>
                    <td>I would prefer a place in a double room with private bathroom facilities in the Gatehouse (Poortgebouw) <span class="nadruk">(additional charge <?php echo euro($cursusdata["hotel_2pp"]) ?>; limited availability)</span></td>
                </tr>
                <tr>
                    <td class="linkerkolom"><input type="checkbox"
                            name="eenpersoons" id="eenpersoons" value="1"
                            <?php if (isset($_POST["eenpersoons"]) and $_POST["eenpersoons"] == 1) echo "checked"; ?>>
                    </td>
                    <td>I would prefer a single room in the Guest House (Gastenverblijf) <span class="nadruk">(additional charge <?php echo euro($cursusdata["eenpersoons"]) ?>; limited
                            availability)</span></td>
                </tr>
                <tr>
                    <td class="linkerkolom"><input type="checkbox" name="hotel_1pp" id="hotel_1pp" value="1"
                            <?php if (isset($_POST["hotel_1pp"]) and $_POST["hotel_1pp"] == 1) echo "checked"; ?>>
                    </td>
                    <td>I would prefer a single room in the Gatehouse (Poortgebouw) <span class="nadruk">(additional charge <?php echo euro($cursusdata["hotel_1pp"]) ?>; limited
                            availability)</span></td>
                </tr>
                <tr>
                    <td class="linkerkolom"><input name="kamperen" type="checkbox" id="kamperen" value="1" <?php if (isset($_POST["kamperen"]) and $_POST["kamperen"] == 1) echo "checked"; ?>>
                    </td>
                    <td>I would like to camp at the monastery campsite <span class="nadruk">(discount <?php echo euro($cursusdata["kamperen"]) ?> per
                            person; limited availability)</span></td>
                </tr>
                <tr>
                    <td class="linkerkolom"><input name="eigen_acc" type="checkbox" id="eigen_acc" value="1"
                            <?php if (isset($_POST["eigen_acc"]) and $_POST["eigen_acc"] == 1) echo "checked"; ?>>
                    </td>
                    <td>I will arrange my own accommodation and will only make use of the communal lunch, dinner and
                        coffee/tea <span class="nadruk">(discount <?php echo euro($cursusdata["kortng_eigen_acc"]) ?>)</span>
                    </td>
                </tr>
                <tr>
                    <td class="linkerkolom">&nbsp;</td>
                    <td><input name="dinner" type="checkbox" id="dinner" value="1"
                            <?php if (isset($_POST["dinner"]) and $_POST["dinner"] == 1) echo "checked"; ?>><label>
                            Although I arrange my own accommodation (and receive a discount of
                            <?php echo euro($cursusdata["korting_eigen_acc"]) ?> for this), I would also like to take part in the
                            communal dinner <span class="nadruk">(additional cost <?php echo euro($cursusdata["diner"]) ?>)</span></label>
                    </td>
                </tr>
            </table>
            <p>Other wishes concerning accommodation:<br>
                <textarea name="acc_wens" cols="70"
                    rows="5"><?php
                                if (isset($_POST['acc_wens'])) echo $_POST['acc_wens']; ?></textarea>
            </p>
            <hr>
            <p>Diet requirements: <input name="dieet" type=text id="dieet"
                    size="50" value="<?php
                                        if (isset($_POST['Dieet']) and $_POST['Dieet'] != "") echo $_POST['Dieet'];
                                        else echo "[none]"; ?>">
            </p>
            <hr>
            <table>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <p><br> I intend to travel to the summer school in the
                            following way: <span class="nadruk">(please select
                                an option)</span><br>
                            <select name="vervoer" size="7" id="vervoer">
                                <option value="???" <?php
                                                    if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "???")) echo 'selected';
                                                    ?>>not yet known</option>
                                <option value="car (0 pl.)" <?php
                                                            if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "car (0 pl.)"))
                                                                echo 'selected'; ?>>by car, no
                                    places for passengers</option>
                                <option value="car (? pl.)" <?php
                                                            if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "car (? pl.)")) echo 'selected';
                                                            ?>>by car, possibly place for one
                                    or more passengers</option>
                                <option value="ride" <?php
                                                        if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "ride")) echo 'selected';
                                                        ?>>I wish to join others travelling by
                                    car</option>
                                <option value="train"
                                    <?php
                                    if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "train")) echo 'selected'; ?>>
                                    by train</option>
                            </select>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><br> Different, i.e.:<br>
                        <textarea name="reistype" cols="70"
                            rows="3"><?php if (isset($_POST['reistype'])) echo $_POST['reistype']; ?></textarea>
                    </td>
                </tr>
            </table>
            <hr>
            <table>
                <tr>
                    <td width="33" class="linkerkolom"><input
                            name="storting_fonds" type="checkbox" value="1"
                            <?php if (
                                isset($_POST['storting_fonds'])
                                and $_POST['storting_fonds'] == 1
                            ) echo 'checked'; ?>></td>
                    <td width="555">I am willing to contribute EUR <input
                            name="donatie" type=text id="donatie" value="<?php
                                                                            if (isset($_POST['donatie']) and $_POST['donatie'] > 0) {
                                                                                $_POST['storting_fonds'] = 1;
                                                                                echo $_POST['donatie'];
                                                                            } ?>" size="5"> to
                        the reduction fund for participants from Eastern Europe
                        and students. </td>
                </tr>
                <tr>
                    <td class="linkerkolom"><input type="checkbox"
                            name="student" value="1" id="student"
                            <?php if (isset($_POST['student']) and $_POST['student'] == 1) echo 'checked'; ?>>
                        <label for="checkbox"></label>
                    </td>
                    <td>I am a full-time student or up to 35 years <span
                            class="nadruk">(fee
                            <?php echo euro_en($cursusdata['prijs_student']); ?>,
                            please <a href="contact.php">send in by e-mail</a> a
                            copy of proof of registration or passport as proof
                            of age) </span></td>
                </tr>
                <tr>
                    <td class="linkerkolom"><input name="info_korting"
                            type="checkbox" id="info_korting" value="1" <?php
                                                                        if (isset($_POST['info_korting']) and $_POST['info_korting'] == 1)
                                                                            echo 'checked'; ?>>
                    </td>
                    <td>I am a music student and wish to receive information
                        about reductions. </td>
                </tr>
                <tr>
                    <td colspan="2"><br> Remarks and additional information:<br>
                        <textarea name="opmerkingen" rows="5"
                            cols="70"><?php
                                        if (isset($_POST['opmerkingen'])) echo $_POST['opmerkingen']; ?></textarea>
                    </td>
                </tr>
            </table>
            <hr>
            <h3>Payment</h3>
            <table border="0">
                <tr>
                    <td class="linkerkolom"><input type="radio" name="betaling"
                            value="mollie" checked></td>
                    <td><label>I prefer to pay the deposit of
                            <?php echo euro_en($cursusdata['inschrijfgeld']); ?>
                            online, with electronic banking or credit card <span
                                class="nadruk">(N.B. When sending in this form
                                you will be directed to our online payment
                                service provider. If the payment is made by
                                credit card, the credit card company will deduct
                                a commission of about 3% from that. We will
                                offset this against the next
                                payment)</span></label></td>
                </tr>
                <tr>
                    <td><input type="radio" name="betaling" value="transfer">
                    </td>
                    <td><label>I will paid the deposit by bank transfer <span
                                class="nadruk">(Use this option when the course
                                fee is less than
                                <?php echo euro_en($cursusdata['inschrijfgeld'] * 2); ?>,
                                for example for the Central European or Czech
                                prices. Paying the deposit is required for
                                further processing)</span></label></td>
                </tr>
            </table>
            <p>Please see the <a href="praktisch.php" target="_blank">practical matters</a> page for convenient ways of international payment.</p>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/akkoord_voorwaarden_EN.php'; ?>
            <h2><a href="javascript: history.go(-1)">Back</a></h2>
        </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html> <?php ob_end_flush(); ?>