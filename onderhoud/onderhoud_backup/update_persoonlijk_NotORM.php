<?php //Connection statement
error_reporting( E_ALL ); 
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/NotORM_2014.php');
//include ($_SERVER['DOCUMENT_ROOT'].'/login/level3_check.php'];

echo '$_POST: <pre>';
print_r($_POST);
echo '</pre>';

echo '$_GET: <pre>';
print_r($_GET);
echo '</pre>';

// gegevens wissen
if (isset($_GET['DlnmrId']) and ($_GET['DlnmrId'] != "") and isset($_POST["Wissen"]) and ($_POST['Wissen'] == "Wissen")) {

	// begin Recordset
	$colname__Adressen = '-1';
	if (isset($_GET['DlnmrId'])) $colname__Adressen = $_GET['DlnmrId'];
	$aantal = count($Adressen = $lp->dlnmr()->where("DlnmrId = ?", $colname__Adressen))	;
	// end Recordset
	
	if ($aantal == 1) {
	  $Result1 = $lp->adres()->where("AdresId = ?", $_POST['AdresId'])->delete();
	}
	else echo "Er zijn meer personen met dit adres. Het adres kan niet gewist worden<br>";
	
	$Result1 = $lp->dlnmr()->where("DlnmrId = ?", $_GET['DlnmrId'])->delete();
}

// Update gegevens	
if (isset($_GET['DlnmrId']) and ($_GET['DlnmrId'] != "") and isset($_POST["Wijzigdlnmr"]) and ($_POST['Wijzigdlnmr'] == "Wijzig dlnmr")) {

	$deelnemers = $lp->dlnmr();
	$deelnemer = $deelnemers[array('DlnmrId = ?', $_GET['DlnmrId'])];
	$data = array(
                       'voornaam' => $_POST['voornaam'],
                       'tussenvoegsels' => $_POST['tussenvoegsels'],
                       'achternaam' => $_POST['achternaam'],
                       'naam' => $_POST['naam'],
                       'geboortedatum' => $_POST['geboortedatum'],
                       'geslacht' => $_POST['geslacht'],
					   'student' => $_POST['student'],
					   'oost' => $_POST['oost'],
                       'taal' => $_POST['taal'],
                       'telefoon' => $_POST['telefoon'],
                       'mobiel' => $_POST['mobiel'],
                       'email' => $_POST['email'],
                       'dieet' => $_POST['dieet'],
                       'eerste_inschrijving' => $_POST['eerste_inschrijving'],
                       'AdresId' => $_POST['AdresId'],
                       'password' => $_POST['password']);

echo '$data: <pre>';
// print_r($data);
echo '$deelnemer: ';
print_r($deelnemer);
echo '</pre>';

 	if ($deelnemer) { 
		echo 'Het resultaat van de UPDATE is: '.$deelnemer->update($data);
	}
	else echo 'Geen UPDATE, want geen $deelnemer';
}

if (isset($_GET['DlnmrId']) and ($_GET['DlnmrId'] != "") and isset($_POST["Wijzigadres"]) and ($_POST['Wijzigadres'] == "Wijzig adres")) {

	$data = array(
                       'adres' => $_POST['adres'],
                       'postcode' => $_POST['postcode'],
                       'plaats' => $_POST['plaats'],
                       'land' => $_POST['land']);

$ins_adres = $lp->adres[array('AdresId = ?', $inschrijving['AdresId_FK'])];
$ins_adres->update($data);
}

// begin Recordset
$id = '-1';
if (isset($_GET['DlnmrId']) and !(isset($_POST["Leegmaken"]) and ($_POST['Leegmaken'] == "Leegmaken"))) $id = $_GET['DlnmrId'];
$inschrijving = $lp->dlnmr()->where('DlnmrId = ?', $id)->fetch();
$ins_adres = $lp->adres()->where('AdresId = ?', $inschrijving['AdresId_FK'])->fetch();

/* echo '$inschrijving: <pre>';
print_r($inschrijving);
echo '</pre>';
 */// end Recordset

if ((isset($_POST["bewerk"])) && ($_POST["bewerk"] == "bewerk")) {
	if (isset($_POST['telefoon']) and stristr($_POST['telefoon'], "+") === false) $tel = '+31 (' . ltrim($_POST['telefoon'], '0');
	$oud = array("-", " ", ".", "/");
	$tel = str_replace("-", ") ", $tel);
	if (!strpos($tel, ") ")) $tel = substr_replace($tel, ") ", strpos($tel, " ", 5), 1);
	if (isset($_POST['mobiel']) and $_POST['mobiel'] !== "" and stristr($_POST['mobiel'], "+") === false) {
		$mobiel = '+31' . ltrim($_POST['mobiel'], '0');
		$mobiel = str_replace($oud, "", $mobiel);
		$mobiel = chunk_split($mobiel, 3, " ");
		}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //PHP ADODB document - made with PHAkt 3.5.1?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
function GP_popupConfirmMsg(msg) { //v1.0
  document.MM_returnValue = confirm(msg);
}
// -->
</SCRIPT>
<html>
<head>
<title>Update persoonlijke gegevens</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
</head>
<body>
<table width="600">
   <td><form id="zoek" name="zoek" method="get" action="<?php echo $editFormAction; ?>">
         <input name="DlnmrId" type="hidden" value="<?php if (isset($_GET['DlnmrId'])) echo $_GET['DlnmrId']; ?>" size="5" />
         <div class="onzichtbaar">
  <input type="submit" name="Submit" value="Zoek">
         </div>
   </form>
      <form name="inschrijvingsform" method="POST" id="inschrijvingsform" action="<?php echo $editFormAction; ?>">
         <table border="1" align="left">
            <tr valign="baseline">
               <td nowrap align="right">Voornaam:</td>
               <td colspan="3"><input type="text" name="voornaam" value="<?php echo $inschrijving['voornaam']; ?>" size="45" /></td>
            </tr>
            <tr valign="baseline">
               <td nowrap align="right">Tussenvoegsels:</td>
               <td colspan="3"><input type="text" name="tussenvoegsels" value="<?php echo $inschrijving['tussenvoegsels']; ?>" size="45" /></td>
            </tr>
            <tr valign="baseline">
               <td nowrap align="right">Achternaam:</td>
               <td colspan="3"><input type="text" name="achternaam" value="<?php echo $inschrijving['achternaam']; ?>" size="45" /></td>
            </tr>
            <tr valign="baseline">
               <td nowrap align="right">Naam:</td>
               <td colspan="3"><input type="text" name="naam" value="<?php echo $inschrijving['naam']; ?>" size="45" /></td>
            </tr>
            <tr valign="baseline">
               <td nowrap align="right">Geboortedatum:</td>
              <td colspan="3"><input type="text" name="geboortedatum" value="<?php echo $inschrijving['geboortedatum']; ?>" size="10" />
                  &nbsp;Password:&nbsp;
                  <input name="password" type="text" id="password" size="4" value="<?php 
						echo $inschrijving['password']; ?>" maxlength="4"> 
                 &nbsp;student:&nbsp;<input name="student" type="checkbox" id="student" value="1" 
				  <?php if (!(strcmp($inschrijving['student'],"1"))) {echo "checked";} ?>>
                 &nbsp;oost:&nbsp;<input name="oost" type="checkbox" id="student" value="1" 
				  <?php if (!(strcmp($inschrijving['oost'],"1"))) {echo "checked";} ?>></td>
            </tr>
            <tr valign="baseline">
               <td align="right" nowrap>Geslacht:</td>
               <td><table>
                     <tr>
                        <td><input type="radio" name="geslacht" value="M" <?php if (!(strcmp($inschrijving['geslacht'],"M"))) {echo "CHECKED";} ?> />
                           Man</td>
                        <td><input type="radio" name="geslacht" value="V" <?php if (!(strcmp($inschrijving['geslacht'],"V"))) {echo "CHECKED";} ?> />
                           Vrouw</td>
                     </tr>
               </table>                           
              <td align="right" nowrap>Taal:</td>
              <td><input type="text" name="taal" value="<?php echo $inschrijving['taal']; ?>" size="4" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Kent cursus via: </td>
              <td colspan="3"><?php echo $inschrijving['publiciteit']; ?>&nbsp;</td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Aanbrenger:&nbsp;</td>
              <td colspan="3"><?php echo $inschrijving['naam_aanbrenger']; ?>&nbsp;</td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Opm. over publ. </td>
              <td colspan="3"><?php echo $inschrijving['publiciteit_tx']; ?>&nbsp;</td>
            </tr>
            <tr valign="baseline">
               <td nowrap align="right">Telefoon:</td>
               <td colspan="2"><input type="text" name="telefoon" value="<?php if (!isset($tel)) echo $inschrijving['telefoon']; else echo $tel;
?>" size="45" /></td>
               <td rowspan="2" valign="middle"><input name="bewerk" type="submit" id="bewerk" value="bewerk" /></td>
            </tr>
            <tr valign="baseline">
               <td nowrap align="right">Mobiel:</td>
               <td colspan="2"><input type="text" name="mobiel" value="<?php if (!isset($mobiel)) echo $inschrijving['mobiel']; else echo $mobiel; ?>" size="45" /></td>
               </tr>
            <tr valign="baseline">
               <td nowrap align="right">Email:</td>
               <td colspan="3"><input type="text" name="email" value="<?php if (!isset($email)) echo $inschrijving['email']; else echo $email; ?>" size="45" /></td>
               </tr>
            <tr valign="baseline">
              <td nowrap align="right">Dieet:</td>
              <td colspan="3"><input type="text" name="dieet" value="<?php echo $inschrijving['dieet']; ?>" size="45" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">1e inschrijving :</td>
              <td colspan="3"><input type="text" name="eerste_inschrijving" value="<?php 
			  echo $inschrijving['eerste_inschrijving']; ?>" size="45" /></td>
            </tr>
            <tr valign="baseline">
               <td nowrap align="right">AdresId:</td>
               <td colspan="3"><input type="text" name="AdresId" value="<?php echo $inschrijving['AdresId_FK']; ?>" size="45" /></td>
            </tr>
            <tr valign="baseline">
               <td colspan="4" align="right" nowrap class="nadruk">De gegevens
                  hieronder veranderen met &quot;Wijzig adres&quot;</td>
            </tr>
            <tr valign="baseline">
               <td align="right" nowrap>Adres:</td>
               <td colspan="3"><input name="adres" type="text" id="adres" value="<?php echo $ins_adres['adres']; ?>" size="45" /></td>
            </tr>
            <tr valign="baseline">
               <td align="right" nowrap>Postcode:</td>
               <td colspan="3"><input name="postcode" type="text" value="<?php echo $ins_adres['postcode']; ?>" size="45" /></td>
            </tr>
            <tr valign="baseline">
               <td align="right" nowrap>Plaats:</td>
               <td colspan="3"><input name="plaats" type="text" value="<?php echo $ins_adres['plaats']; ?>" size="45" /></td>
            </tr>
            <tr valign="baseline">
               <td align="right" nowrap>Land:</td>
               <td colspan="3"><input name="land" type="text" value="<?php echo $ins_adres['land']; ?>" size="45" /></td>
            </tr>
            <tr valign="baseline">
               <td nowrap align="right"><input name="Wijzigdlnmr" type="submit" id="Wijzigdlnmr" value="Wijzig dlnmr" /></td>
               <td><input name="Wijzigadres" type="submit" id="Wijzigadres" value="Wijzig adres" /></td>
               <td onClick="GP_popupConfirmMsg('Moeten deze gegevens werkelijk gewist worden?'];return document.MM_returnValue"><input name="Wissen" type="submit" id="Wissen" value="Wissen"></td>
               <td><input name="Leegmaken" type="submit" id="Leegmaken" value="Leegmaken" /></td>
            </tr>
         </table>
      </form>
	</td>
   </tr>
</table>
<p><br>
  <br>
  <br>
  <br>
  <br>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp; </p>
</body>
</html>