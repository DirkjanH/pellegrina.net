<?php

session_start();

// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);

error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

Kint::$enabled_mode = false;

//Connection statement
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2025.php');

if (empty($_SESSION['Set']) or $_SESSION['Set'] == '') $_SESSION['Set'] = 1;
if (empty($_SESSION['Cursus'])) $_SESSION['Cursus'] = 1;

if (isset($_POST['Cursus']) and $_POST['Cursus'] > 0) {
	$_SESSION['Cursus'] = $_POST['Cursus'];
}

// begin Recordset Docenten
$query_docenten = sprintf(
	"SELECT naam, DocId, code FROM docenten, cursusdocenten 
WHERE DocId_FK = DocId AND code IS NOT NULL AND CursusId_FK = %s ORDER BY achternaam ASC",
	GetSQLValueString(($_SESSION['Cursus'] + $cursus_offset), "int")
);
$docenten = select_query($query_docenten);

foreach ($docenten as $docent) $doc[$docent['code']] = $docent['naam'];
?>
<!DOCTYPE HTML>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Maak voetregel docenten</title>
	<style type="text/css">
		.toets {
			font-size: 70%;
			color: #FF0000;
		}
	</style>
	<SCRIPT language="JavaScript" type="text/javascript">
		<!--
		function CursusZoek(Nr) {
			document.cursus_set.Cursus.value = Nr;
			document.cursus_set.submit();
		}

		function GP_popupConfirmMsg(msg) { //v1.0
			document.MM_returnValue = confirm(msg);
		}
		-->
	</SCRIPT>
</head>

<body>
	<form name="cursus_set" id="cursus_set" method="post" action="<?php echo $editFormAction; ?>">
		<input type="hidden" name="Cursus" id="Cursus" value="<?php echo $_SESSION['Cursus']; ?>" />
		<button accesskey="c" name="cursus" type="button" onclick="CursusZoek(1)">Chamber Music<span class="toets"> </span><span class="toets">(Shift-Alt-C)</span></button>
		<button accesskey="b" name="cursus" type="button" onclick="CursusZoek(2)">Baroque<span class="toets"> (Shift-Alt-B)</span></button>
		<button accesskey="r" name="cursus" type="button" onclick="CursusZoek(3)">Beethoven <span class="toets">(Shift-Alt-R)</span></button>
	</form>

	<?php if (isset($_SESSION['Cursus']) and $_SESSION['Cursus'] > 0) {
		$voetregel = '<p>Tutor codes: ';
		foreach ($doc as $dcode => $dnaam) {
			$voetregel .= $dcode . '&nbsp;=&nbsp;' . $dnaam . '; ';
		}
		echo $voetregel . '</p>';
	}
	?>

</body>

</html>