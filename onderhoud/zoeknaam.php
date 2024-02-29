<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1 );
error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/includes2024.php');

$editFormAction = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" . $_SERVER['QUERY_STRING'] : "");

Kint::$enabled_mode = false;

d($_GET, $_POST);

$i = $eerstecursus;
while ($i <= $laatstecursus) {
	$cur[] = $i;
	$i++;
	}

if (empty($_POST['oude_dlnrs'])) $_POST['oude_dlnrs'] = '';
if (empty($_POST['cursus'])) {
	$_POST['cursus'] = 'nieuw';
	$_POST['zoek'] = 'zoek';
}

if ((isset($_POST["zoek"])) AND ($_POST["zoek"] == "zoek") AND ($_POST["oude_dlnrs"] == 1)) {

		// begin Recordset
		$zoeknaam = '-1';
		if (isset($_POST['zoeknaam'])) {
		  	$zoeknaam = $_POST['zoeknaam'];
			} // colname__Inschr
		$query_Inschr = sprintf("SELECT DISTINCT DlnmrId, naam FROM dlnmr WHERE naam LIKE \"%%%s%%\" 
		ORDER BY achternaam ASC", $zoeknaam);
		$Inschr = select_query($query_Inschr);
		if (is_array($Inschr)) $aantal_ins = count($Inschr); else $aantal_ins = 0;

		foreach ($Inschr as $ins) {
			$query_Cursussen = sprintf("SELECT CursusId_FK FROM dlnmr, inschrijving WHERE naam = \"%s\" 
			AND DlnmrId = DlnmrId_FK ORDER BY InschrId, CursusId_FK ASC", 
				$ins['naam']);
			$Cursussen = select_query($query_Cursussen);
			$grijs[$ins['DlnmrId']] = TRUE;
			if (is_array($Cursussen)) foreach ($Cursussen as $cursus) {
				$grijs[$ins['DlnmrId']] = !(in_array($cursus['CursusId_FK'], $cur)); 
				} // foreach Cursussen
			else echo('Geen namen gevonden</br>');
			} // foreach Inschr
} // if zoek

if ((isset($_POST["zoek"])) && ($_POST["zoek"] == "zoek") AND ($_POST["oude_dlnrs"] != 1)) {

		// begin Recordset
		$zoeknaam = '-1';
		if (isset($_POST['zoeknaam'])) {
		  	$zoeknaam = $_POST['zoeknaam'];
			} // colname__Inschr
		if (empty($_POST['cursus']) OR $_POST['cursus'] == 'alles') {
			$query_Inschr = sprintf("SELECT DISTINCT DlnmrId, naam, voorl_bev FROM dlnmr, inschrijving WHERE naam LIKE \"%%%s%%\" 
			AND DlnmrId = DlnmrId_FK AND NOT (afgewezen <=> 1)
			AND CursusId_FK > {$cursus_offset} AND CursusId_FK <= ({$aantal_cursussen} + {$cursus_offset}) 
			ORDER BY achternaam ASC", $zoeknaam);
			}
		else {
			$query_Inschr = sprintf("SELECT DISTINCT DlnmrId, naam, voorl_bev FROM dlnmr, inschrijving WHERE naam LIKE \"%%%s%%\" 
			AND DlnmrId = DlnmrId_FK AND CursusId_FK=%s AND NOT (afgewezen <=> 1) ORDER BY achternaam ASC", 
			$zoeknaam, ((int)$_POST['cursus'] + $cursus_offset));
			}
		if ($_POST['cursus'] == 'nieuw') {
			$query_Inschr = "SELECT DISTINCT DlnmrId, naam FROM dlnmr, inschrijving WHERE DlnmrId = DlnmrId_FK AND NOT (afgewezen <=> 1)
			AND CursusId_FK > {$cursus_offset} AND CursusId_FK <= ({$aantal_cursussen} + {$cursus_offset}) AND NOT(aangenomen <=> 1) ORDER BY achternaam ASC";
			}
		$Inschr = select_query($query_Inschr);
		if (isset($Inschr) AND is_array($Inschr)) $aantal_ins = count($Inschr); else $aantal_ins = 0;
} // if zoek

function check($input) {
	if (isset($_POST['cursus']) AND $_POST['cursus'] == $input) echo 'checked'; 
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Aanbetaling bevestigen</title>
<script type="text/javascript">
//<!--
function ToonId(Id){
	parent.mainFrame.document.zoek.DlnmrId.value = Id;
	parent.mainFrame.document.zoek.Submit.click();
}
-->
</script>
<link rel="stylesheet" href="/css/pellegrina_stijlen.css">
<style type="text/css">
<!--
div#navigatie {
	display: block;
	position: fixed;
	float: left;
	width: 195px;
	font-size: 12px;
}
#navcontainer {
	width: 210px;
	background-color: white;
	display: block;
}
#navcontainer li {
	padding-bottom: 0;
	line-height: 1.3em;
	font-size: 13px;
}
#navlist a:link, #navlist a:visited {
	display: block;
	color: black;
}
#navlist a:hover, #navlist a:active {
	display: block;
	background-color: grey;
	color: white;
}
#navcontainer ul {
	padding: 10px;
	list-style-type: none;
}
#navcontainer li.active {
	border-bottom: thin solid rgba(0,0,0,1);
}
#navcontainer li.active a {
	text-decoration:none;
}
.NogNietBevestigd {
    background: Orange;
}
-->
</style>
</head>
<body>
<div id="inhoud" class="w3-panel">
 
  <form id="vinden" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	  <label>Naam: </label><input name="zoeknaam" type="text" id="zoeknaam" size="15" value="<?php echo $_POST['zoeknaam']; ?>"><br>
	  <label>Alle deelnemers van ooit: </label><input name="oude_dlnrs" type="checkbox" id="oude_dlnrs" value="1" <?php if (isset($_POST['oude_dlnrs']) AND $_POST['oude_dlnrs'] != '') echo 'checked'; ?>>
      <p>
      <label><input type="radio" name="cursus" value="alles" onclick="javascript: submit();" <?php check('alles'); ?>> Alles</label><br>
      <label><input type="radio" name="cursus" value="1" onclick="javascript: submit();" <?php check('1'); ?>> 1. Romantiek in CB</label><br>
      <label><input type="radio" name="cursus" value="2" onclick="javascript: submit();" <?php check('2'); ?>> 2. Barok in NS</label><br>
		<label><input type="radio" name="cursus" value="nieuw" onclick="javascript: submit();" <?php check('nieuw'); ?>> Nieuwe inschrijvingen</label>
         </p>
		<input name="zoek" type="hidden" id="zoek" value="zoek">   
  
  <?php if (isset($Inschr)) { 
	  d($aantal_ins, $Inschr);
	  ?>
 		<p>Kies een naam uit: <span class="klein">(totaal: <?php echo $aantal_ins; ?>)</span></p>
          <div id="navcontainer">
            <ul id="navlist">
              <?php 
					foreach ($Inschr as $ins) {?>
					  <li class="active"><a href="javascript:ToonId(<?php echo $ins['DlnmrId']; ?>)"; >
						 <?php 
						if (isset($grijs[$ins['DlnmrId']]) AND $grijs[$ins['DlnmrId']]) echo '<span class="grijs">';
						echo "{$ins['naam']} <span class=\"klein\">({$ins['DlnmrId']})</span>"; 
						if (is_null($ins['voorl_bev'])) echo " <span class=\"NogNietBevestigd\">###</span>"; 
						if (isset($grijs[$ins['DlnmrId']]) AND $grijs[$ins['DlnmrId']]) echo '</span>'; ?>
						 </a></li>
					<?php }?>
            </ul>
          </div>
      <?php }?>
   </form>
</div>
</body>
</html>