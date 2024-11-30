<?php //Connection statement
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2025.php');
// stel php in dat deze fouten weergeeft
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

use function PHP81_BC\strftime;

Kint::$enabled_mode = false;

d($_POST);

$aantal_kolommen = 5;

if (empty($_SESSION['cursusId'])) $_SESSION['cursusId'] = $eerstecursus;
if (isset($_POST['cursusId']) and $_POST['cursusId'] === "0") {
	$_SESSION['cursusId'] = 0;
	$_POST['selectie'] = 'alles';
} elseif (isset($_POST['cursusId']) and $_POST['cursusId'] != "") $_SESSION['cursusId'] = $_POST['cursusId'];

if (empty($_SESSION['DocId'])) $_SESSION['DocId'] = 1;
if (isset($_POST['DocId']) and $_POST['DocId'] != "") $_SESSION['DocId'] = $_POST['DocId'];

$_POST['bio_NL'] = stripslashes($_POST['bio_NL']);
$_POST['bio_EN'] = stripslashes($_POST['bio_EN']);

d($_POST);
d($_SESSION);

// begin Recordset cursusnamen
$query_cursussen = sprintf(
	"SELECT * FROM cursus WHERE cursusId BETWEEN %s AND %s ORDER BY cursusId ASC",
	$eerstecursus,
	$laatstecursus
);

$cursussen = select_query($query_cursussen);
$totaal_cursussen = count($cursussen);

foreach ($cursussen as $cur) {
	setlocale(LC_ALL, 'nl_NL');
	$begindatum = strftime('%A %e %B', strtotime($cur['datum_begin']));
	$einddatum = strftime('%A %e %B %Y', strtotime($cur['datum_eind']));
	$datum = $begindatum . ' - ' . $einddatum;
	$cursusnaam[$cur['CursusId']]['NL'] = $cur['cursusnaam_nl']
		. ' (' . $cur['cursusplaats_nl'] . ', ' . $datum . ']';
	setlocale(LC_ALL, 'en_GB'); // data e.d. in het Engels
	$begindatum = strftime('%A %e %B', strtotime($cur['datum_begin']));
	$einddatum = strftime('%A %e %B, %Y', strtotime($cur['datum_eind']));
	$datum = $begindatum . ' - ' . $einddatum;
	$cursusnaam[$cur['CursusId']]['EN'] = $cur['cursusnaam_en']
		. ' (' . $cur['cursusplaats_en'] . ', ' . $datum . ']';
}

d($totaal_cursussen);
d($cursusnaam);

// end Recordset cursusnamen

// Database-handelingen docenten:

if (empty($_POST["submitten"])) {
	$query_docenteninfo = "SELECT * FROM docenten";
	$docenteninfo = select_query($query_docenteninfo);
	$query_docent = "SELECT * FROM docenten WHERE DocId = {$_SESSION['DocId']}";
	$docent = select_query($query_docent, 1);
}

if (isset($_POST["submitten"])) switch ($_POST["submitten"]) {
	case "Voeg toe":
		$insertSQL = sprintf(
			"INSERT INTO docenten (code, naam, achternaam, adres, PC, plaats, land, telefoon, mobiel, email, vak, cursus, 
		bio_NL, bio_EN, foto) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
			GetSQLValueString($_POST['code'], "text"),
			GetSQLValueString($_POST['naam'], "text"),
			GetSQLValueString($_POST['achternaam'], "text"),
			GetSQLValueString($_POST['adres'], "text"),
			GetSQLValueString($_POST['PC'], "text"),
			GetSQLValueString($_POST['plaats'], "text"),
			GetSQLValueString($_POST['land'], "text"),
			GetSQLValueString($_POST['telefoon'], "text"),
			GetSQLValueString($_POST['mobiel'], "text"),
			GetSQLValueString($_POST['email'], "text"),
			GetSQLValueString($_POST['vak'], "text"),
			GetSQLValueString($_POST['cursus'], "text"),
			GetSQLValueString($_POST['bio_NL'], "text"),
			GetSQLValueString($_POST['bio_EN'], "text"),
			GetSQLValueString($_POST['foto'], "text")
		);

		exec_query($insertSQL);

		$_POST['DocId'] = $_SESSION['DocId'] = $db->lastInsertId();
		$query_docent = "SELECT * FROM docenten WHERE DocId = {$_SESSION['DocId']}";
		$docent = select_query($query_docent, 1);
		break;

	case "Update":
		$updateSQL = sprintf(
			"UPDATE docenten SET code=%s, naam=%s, achternaam=%s, adres=%s, PC=%s, plaats=%s, land=%s, telefoon=%s, mobiel=%s,
							email=%s, vak=%s, cursus=%s, bio_NL=%s, bio_EN=%s, foto=%s WHERE DocId=%s",
			GetSQLValueString($_POST['code'], "text"),
			GetSQLValueString($_POST['naam'], "text"),
			GetSQLValueString($_POST['achternaam'], "text"),
			GetSQLValueString($_POST['adres'], "text"),
			GetSQLValueString($_POST['PC'], "text"),
			GetSQLValueString($_POST['plaats'], "text"),
			GetSQLValueString($_POST['land'], "text"),
			GetSQLValueString($_POST['telefoon'], "text"),
			GetSQLValueString($_POST['mobiel'], "text"),
			GetSQLValueString($_POST['email'], "text"),
			GetSQLValueString($_POST['vak'], "text"),
			GetSQLValueString($_POST['cursus'], "text"),
			GetSQLValueString($_POST['bio_NL'], "text"),
			GetSQLValueString($_POST['bio_EN'], "text"),
			GetSQLValueString($_POST['foto'], "text"),
			GetSQLValueString($_SESSION['DocId'], "int")
		);

		exec_query($updateSQL);

		$query_docent = "SELECT * FROM docenten WHERE DocId = {$_SESSION['DocId']}";
		$docent = select_query($query_docent, 1);
		break;

	case "Bewerken":
		$query_docent = "SELECT * FROM docenten WHERE DocId = {$_SESSION['DocId']}";
		$docent = select_query($query_docent, 1);
		break;

	case "Maak leeg":
		$query_docent = "SELECT * FROM docenten WHERE DocId = -1";
		$docent = select_query($query_docent, 1);
		break;

	case "Wis docent":
		$query_docent = "DELETE FROM docenten WHERE DocId = {$_SESSION['DocId']}";
		exec_query($query_docent);

		$query_docenten = "SELECT * FROM docenten";
		$docenteninfo = select_query($query_docenten);
		break;
}

$where = '';
if (isset($_POST['docent']) and $_POST['docent'] != '') $where = "WHERE naam LIKE '%{$_POST['zoek_docent']}%'";

$query_docenten = "SELECT * FROM docenten {$where} order by achternaam";
$docenteninfo = select_query($query_docenten);
?>
<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <!-- CSS: -->
    <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
    <link rel="stylesheet" href="/css/pagina_stijlen.css" type="text/css">
    <link rel="apple-touch-icon" sizes="180x180"
        href="https://pellegrina.net/mailing/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32"
        href="https://pellegrina.net/mailing/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16"
        href="https://pellegrina.net/mailing/favicon-16x16.png">
    <link rel="manifest" href="https://pellegrina.net/mailing/site.webmanifest">
    <link rel="mask-icon"
        href="https://pellegrina.net/mailing/safari-pinned-tab.svg"
        color="#5bbad5">
    <link rel="shortcut icon"
        href="https://pellegrina.net/Images/Logos/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config"
        content="https://pellegrina.net/mailing/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <title>Onderhoud docenten</title>
    <script src="/vendor/tinymce/tinymce/tinymce.min.js"></script>
    <script language="javascript" type="text/javascript">
    tinyMCE.init({
        // General options
        mode: "textareas",
        theme: "modern",
        document_base_url: "http://www.pellegrina.net/Images/Docenten/",
        convert_urls: false,
        relative_urls: false,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
        ],
        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor fontsizeselect emoticons | codesample | table',
        toolbar3: 'hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | visualchars visualblocks nonbreaking template pagebreak restoredraft',
        fontsize_formats: '6pt 8pt 10pt 12pt 14pt 18pt 24pt 36pt',
        image_advtab: true
    });

    function DocentZoek(Nr) {
        document.getElementById('DocId').value = Nr;
        //	document.forms['formulier'].submit();
        document.getElementById('formulier').submit();
    }

    function GP_popupConfirmMsg(msg) { //v1.0
        document.MM_returnValue = confirm(msg);
    }

    function klapdiensten(id) {
        if (document.getElementById(id)) {
            var cont = document.getElementById(id).style;
            if (cont.display == "block") {
                cont.display = "none";
            } else {
                cont.display = "block";
            }
            return false;
        } else {
            return true;
        }
    }
    </script>
    <style type="text/css">
    .toets {
        font-size: 70%;
        color: #FF0000;
    }

    .kolom {
        float: left;
        margin-left: 3px;
        width: 200px;
        font-size: 70%;
    }

    div.inhoud {
        margin: 0 auto;
        width: 100%;
        max-width: 1600px;
    }

    -->
    </style>
</head>
<body class="w3-grey">
    <div class="inhoud w3-panel w3-white">
        <form action="<?php echo $editFormAction; ?>" method="post"
            name="formulier" id="formulier">
            <div class="w3-panel">
                <table width="100%" border="1" cellpadding="0">
                    <tr>
                        <td colspan="2">Code:&nbsp;<input name="code"
                                type="text"
                                value="<?php echo $docent['code']; ?>"
                                size="3">&nbsp;Naam:&nbsp;<input name="naam"
                                type="text"
                                value="<?php echo $docent['naam']; ?>">&nbsp;Achternaam:&nbsp;<input
                                name="achternaam" type="text"
                                value="<?php echo $docent['achternaam']; ?>">&nbsp;Foto:&nbsp;<input
                                name="foto" type="text"
                                value="<?php echo $docent['foto']; ?>">&nbsp;Adres:&nbsp;<input
                                name="adres" type="text"
                                value="<?php echo $docent['adres']; ?>">&nbsp;Postcode:&nbsp;<input
                                name="PC" type="text"
                                value="<?php echo $docent['PC']; ?>">&nbsp;Plaats:&nbsp;<input
                                name="plaats" type="text" id="plaats"
                                value="<?php echo $docent['plaats']; ?>">
                            <br>Land:&nbsp;<input name="land" type="text"
                                value="<?php echo $docent['land']; ?>">&nbsp;Telefoon:&nbsp;<input
                                name="telefoon" type="text"
                                value="<?php echo $docent['telefoon']; ?>">&nbsp;Mobiel:&nbsp;<input
                                name="mobiel" type="text"
                                value="<?php echo $docent['mobiel']; ?>">&nbsp;Email:&nbsp;<input
                                name="email" type="text"
                                value="<?php echo $docent['email']; ?>">&nbsp;Vak:&nbsp;<input
                                name="vak" type="text"
                                value="<?php echo $docent['vak']; ?>">&nbsp;Cursus:&nbsp;<input
                                name="cursus" type="text"
                                value="<?php echo $docent['cursus']; ?>">&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <textarea name="bio_NL" cols="85" rows="20"
                                id="bio_NL"><?php echo $docent['bio_NL']; ?></textarea>
                        </td>
                        <td>
                            <textarea name="bio_EN" cols="85" rows="20"
                                id="bio_EN"><?php echo $docent['bio_EN']; ?></textarea>
                        </td>
                    </tr>
                </table>
                <p>
                    <input
                        onClick="GP_popupConfirmMsg('Moet deze docent werkelijk toegevoegd worden?']; return document.MM_returnValue"
                        type="submit" name="submitten" value="Voeg toe">
                    <input name="submitten" type="submit" id="submitten"
                        value="Update">
                    <input name="submitten" type="submit" id="submitten"
                        value="Maak leeg">
                    <input
                        onClick="GP_popupConfirmMsg('Kan deze docent werkelijk gewist worden?']; return document.MM_returnValue"
                        name="submitten" type="submit" id="submitten"
                        value="Wis docent">
                    <input type="hidden" name="DocId" id="DocId"
                        value="<?php echo $_POST['DocId']; ?>">
                </p>
                <table width="0%" border="1" cellpadding="4">
                    <tr>
                        <th width="30">DocId:</th>
                        <th width="0"><label>Docent (kies): <input type="text"
                                    name="zoek_docent" id="zoek_docent"
                                    value="<?php if (isset($_POST['zoek_docent']) and $_POST['zoek_docent'] != '') echo  $_POST['zoek_docent'] ?>">
                                <input name="docent" type="submit" id="docent"
                                    value="zoek">
                            </label>
                        </th>
                        <th>Code:</th>
                        <th>Cursus:</th>
                    </tr> <?php
					foreach ($docenteninfo as $doc) {
					?> <tr>
                        <td> <?php echo $doc['DocId']; ?>&nbsp;</td>
                        <td>
                            <a
                                onClick="DocentZoek(<?php echo $doc['DocId']; ?>)">
                                <?php echo $doc['naam']; ?> </a>&nbsp;
                        </td>
                        <td align="center"> <?php echo $doc['code']; ?>&nbsp;
                        </td>
                        <td> <?php echo $doc['cursus']; ?>&nbsp;</td>
                    </tr> <?php
					}
					?>
                </table>
            </div>
        </form>
    </div>
</body>
</html>