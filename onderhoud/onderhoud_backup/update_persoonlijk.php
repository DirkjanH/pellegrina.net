<?php //Connection statement
// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1);

error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

Kint::$enabled_mode = false;

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2024.php');

d($_GET);
d($_POST);

// gegevens wissen
if (isset($_GET['DlnmrId'])and($_GET['DlnmrId'] != "")and isset($_POST["Wissen"])and($_POST['Wissen'] == "Wissen")) {

	// begin Recordset
	$colname__Adressen = '-1';
	if (isset($_GET['DlnmrId']))$colname__Adressen = $_GET['DlnmrId'];
	$query_Adressen = sprintf("SELECT COUNT(*) as aantal FROM dlnmr WHERE AdresId_FK = (SELECT AdresId_FK FROM dlnmr WHERE DlnmrId = %s)", quote($colname__Adressen));
	$aantal = select_query($query_Adressen, 0);
	// end Recordset

	if ($aantal == 1) {
		$deleteadresSQL = sprintf("DELETE FROM adres WHERE AdresId=%s",
			quote($_POST['AdresId']));
		exec_query($deleteadresSQL);
	} else echo "Er zijn meer personen met dit adres. Het adres kan niet gewist worden<br>";

	$deleteSQL = sprintf("DELETE FROM dlnmr WHERE DlnmrId=%s",
		quote($_GET['DlnmrId']));
	exec_query($deleteSQL);
}

// Update gegevens	
if (isset($_GET['DlnmrId'])and($_GET['DlnmrId'] != "")and isset($_POST["Wijzigdlnmr"])and($_POST['Wijzigdlnmr'] == "Wijzig dlnmr")) {
	$updateSQL = sprintf("UPDATE dlnmr SET voornaam=%s, tussenvoegsels=%s, achternaam=%s, naam=%s, geboortedatum=%s, geslacht=%s, student=%s, oost=%s, taal=%s, telefoon=%s, mobiel=%s, email=%s, dieet=%s, eerste_inschrijving=%s, AdresId_FK=%s, password=%s WHERE DlnmrId=%s",
		quote($_POST['voornaam']),
		quote($_POST['tussenvoegsels']),
		quote($_POST['achternaam']),
		quote($_POST['naam']),
		quote($_POST['geboortedatum']),
		quote($_POST['geslacht']),
		quote(isset($_POST['student']) ? "true" : "", "defined", "'1'", "'0'"),
		quote(isset($_POST['oost']) ? "true" : "", "defined", "'1'", "'0'"),
		quote($_POST['taal']),
		quote($_POST['telefoon']),
		quote($_POST['mobiel']),
		quote($_POST['email']),
		quote($_POST['dieet']),
		quote($_POST['eerste_inschrijving']),
		quote($_POST['AdresId']),
		quote($_POST['password']),
		quote($_GET['DlnmrId']));

	exec_query($updateSQL);
}

if (isset($_GET['DlnmrId'])and($_GET['DlnmrId'] != "")and isset($_POST["Wijzigadres"])and($_POST['Wijzigadres'] == "Wijzig adres")) {
	$updateSQL = sprintf("UPDATE adres SET adres=%s, postcode=%s, plaats=%s, land=%s WHERE AdresId=%s",
		quote($_POST['adres']),
		quote($_POST['postcode']),
		quote($_POST['plaats']),
		quote($_POST['land']),
		quote($_POST['AdresId']));

	exec_query($updateSQL);
}

// begin Recordset
$id = '-1';
if (isset($_GET['DlnmrId'])and!(isset($_POST["Leegmaken"])and($_POST['Leegmaken'] == "Leegmaken")))$id = $_GET['DlnmrId'];
$query_inschrijving = "SELECT * FROM dlnmr, adres WHERE DlnmrId = {$id} AND AdresId_FK = AdresId";
$inschrijving = select_query($query_inschrijving, 1);
// end Recordset

if ((isset($_POST["bewerk"])) && ($_POST["bewerk"] == "bewerk")) {
	if (isset($_POST['telefoon'])and $_POST['telefoon'] !== '') {
		if (!stristr($_POST['telefoon'], "+"))$tel = '+31 (' . ltrim($_POST['telefoon'], '0');
		else $tel = $_POST['telefoon'];
		d($tel);
		$tel = str_replace(array("-", ".", "/"), '', $tel);
		d($tel);
		if (!strpos($tel, ") "))$tel = substr_replace($tel, ") ", strpos($tel, " ", 5), 1);
	}
	if (isset($_POST['mobiel'])and $_POST['mobiel'] !== '') {
		if (!stristr($_POST['mobiel'], "+"))$mobiel = '+31' . ltrim($_POST['mobiel'], '0');
		else $mobiel = $_POST['mobiel'];
		d($mobiel);
		$mobiel = str_replace(array("-", " ", ".", "/"), '', $mobiel);
		d($mobiel);
		$mobiel = chunk_split($mobiel, 3, ' ');
	}
}
d($inschrijving);
?>
<!DOCTYPE HTML>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
	<title>Update persoonlijke gegevens</title>
	<script type="text/javascript">
		//<!--
		function ToonId(Id) {
			parent.mainFrame.document.zoek.DlnmrId.value = Id;
			parent.mainFrame.document.zoek.Submit.click();
		}
		-->
	</script>
	<link rel="stylesheet" href="/css/w3.css">
	<link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
</head>

<body>
	<table width="600" border="0" align="left">
		<td>
			<form id="zoek" name="zoek" method="get" action="<?php echo $editFormAction; ?>">
				<input name="DlnmrId" type="hidden" value="<?php if (isset($_GET['DlnmrId'])) echo $_GET['DlnmrId']; ?>" size="5"/>
				<input type="submit" name="Submit" value="Zoek" style="display: none;">
			</form>
			<form name="inschrijvingsform" method="POST" id="inschrijvingsform" action="<?php echo $editFormAction; ?>">
				<table border="1" align="left">
					<tr valign="baseline">
						<td nowrap align="right">Voornaam:</td>
						<td colspan="3"><input type="text" name="voornaam" value="<?php echo $inschrijving['voornaam']; ?>" size="45"/>
						</td>
					</tr>
					<tr valign="baseline">
						<td nowrap align="right">Tussenvoegsels:</td>
						<td colspan="3"><input type="text" name="tussenvoegsels" value="<?php echo $inschrijving['tussenvoegsels']; ?>" size="45"/>
						</td>
					</tr>
					<tr valign="baseline">
						<td nowrap align="right">Achternaam:</td>
						<td colspan="3"><input type="text" name="achternaam" value="<?php echo $inschrijving['achternaam']; ?>" size="45"/>
						</td>
					</tr>
					<tr valign="baseline">
						<td nowrap align="right">Naam:</td>
						<td colspan="3"><input type="text" name="naam" value="<?php echo $inschrijving['naam']; ?>" size="45"/>
						</td>
					</tr>
					<tr valign="baseline">
						<td nowrap align="right">Geboortedatum:</td>
						<td colspan="3"><input type="text" name="geboortedatum" value="<?php echo $inschrijving['geboortedatum']; ?>" size="10"/> &nbsp;Password:&nbsp;
							<input name="password" type="text" id="password" size="4" value="<?php 
						echo $inschrijving['password']; ?>" maxlength="4"> &nbsp;student:&nbsp;
							<input name="student" type="checkbox" id="student" value="1" <?php if (!(strcmp($inschrijving['student'], "1"))) {echo "checked";} ?>> &nbsp;oost:&nbsp;
							<input name="oost" type="checkbox" id="student" value="1" <?php if (!(strcmp($inschrijving['oost'], "1"))) {echo "checked";} ?>></td>
					</tr>
					<tr valign="baseline">
						<td align="right" valign="bottom" nowrap>Geslacht:</td>
						<td valign="bottom">
							<table>
								<tr>
									<td><input type="radio" name="geslacht" value="M" <?php if (!(strcmp($inschrijving['geslacht'], "M"))) {echo "CHECKED";} ?> /> Man
									</td>
									<td><input type="radio" name="geslacht" value="V" <?php if (!(strcmp($inschrijving['geslacht'], "V"))) {echo "CHECKED";} ?> /> Vrouw
									</td>
								</tr>
							</table>
							<td align="right" valign="bottom" nowrap>Taal:</td>
							<td valign="bottom"><input type="text" name="taal" value="<?php echo $inschrijving['taal']; ?>" size="4"/>
							</td>
					</tr>
					<tr valign="baseline">
						<td nowrap align="right">Kent cursus via: </td>
						<td colspan="3">
						<?php echo $inschrijving['publiciteit']; ?>&nbsp;</td>
					</tr>
					<tr valign="baseline">
						<td nowrap align="right">Aanbrenger:&nbsp;</td>
						<td colspan="3">
							<?php echo $inschrijving['naam_aanbrenger']; ?>&nbsp;</td>
					</tr>
					<tr valign="baseline">
						<td nowrap align="right">Opm. over publ. </td>
						<td colspan="3">
							<textarea name="publiciteit" cols="45" rows="2" id="publiciteit"><?php echo $inschrijving['publiciteit_tx']; ?>&nbsp;</textarea></td>
					</tr>
					<tr valign="baseline">
						<td nowrap align="right">Telefoon:</td>
						<td colspan="2"><input type="text" name="telefoon" value="<?php if (empty($tel) OR $tel == '') echo $inschrijving['telefoon']; else echo $tel; ?>" size="45"/>
						</td>
						<td rowspan="2" valign="middle"><input name="bewerk" type="submit" id="bewerk" value="bewerk"/>
						</td>
					</tr>
					<tr valign="baseline">
						<td nowrap align="right">Mobiel:</td>
						<td colspan="2"><input type="text" name="mobiel" value="<?php if (empty($mobiel) OR $mobiel == " ") echo $inschrijving['mobiel']; else echo $mobiel; ?>" size="45"/>
						</td>
					</tr>
					<tr valign="baseline">
						<td nowrap align="right">Email:</td>
						<td colspan="3"><input type="text" name="email" value="<?php if (!isset($email)) echo $inschrijving['email']; else echo $email; ?>" size="45"/>
						</td>
					</tr>
					<tr valign="baseline">
						<td nowrap align="right">Dieet:</td>
						<td colspan="3"><input type="text" name="dieet" value="<?php echo $inschrijving['dieet']; ?>" size="45"/>
						</td>
					</tr>
					<tr valign="baseline">
						<td nowrap align="right">1e inschrijving :</td>
						<td colspan="3"><input type="text" name="eerste_inschrijving" value="<?php 
			  echo $inschrijving['eerste_inschrijving']; ?>" size="45"/>
						</td>
					</tr>
					<tr valign="baseline">
						<td nowrap align="right">AdresId:</td>
						<td colspan="3"><input type="text" name="AdresId" value="<?php echo $inschrijving['AdresId']; ?>" size="45"/>
						</td>
					</tr>
					<tr valign="baseline">
						<td colspan="4" align="right" nowrap class="nadruk">De gegevens hieronder veranderen met &quot;Wijzig adres&quot;</td>
					</tr>
					<tr valign="baseline">
						<td align="right" nowrap>Adres:</td>
						<td colspan="3"><input name="adres" type="text" id="adres" value="<?php echo $inschrijving['adres']; ?>" size="45"/>
						</td>
					</tr>
					<tr valign="baseline">
						<td align="right" nowrap>Postcode:</td>
						<td colspan="3"><input name="postcode" type="text" value="<?php echo $inschrijving['postcode']; ?>" size="45"/>
						</td>
					</tr>
					<tr valign="baseline">
						<td align="right" nowrap>Plaats:</td>
						<td colspan="3"><input name="plaats" type="text" value="<?php echo $inschrijving['plaats']; ?>" size="45"/>
						</td>
					</tr>
					<tr valign="baseline">
						<td align="right" nowrap>Land:</td>
						<td colspan="3"><input name="land" type="text" value="<?php echo $inschrijving['land']; ?>" size="45"/>
						</td>
					</tr>
					<tr valign="baseline">
						<td nowrap align="right"><input name="Wijzigdlnmr" type="submit" id="Wijzigdlnmr" value="Wijzig dlnmr"/>
						</td>
						<td><input name="Wijzigadres" type="submit" id="Wijzigadres" value="Wijzig adres"/>
						</td>
						<td onClick="GP_popupConfirmMsg('Moeten deze gegevens werkelijk gewist worden?'];return document.MM_returnValue"><input name="Wissen" type="submit" id="Wissen" value="Wissen">
						</td>
						<td><input name="Leegmaken" type="submit" id="Leegmaken" value="Leegmaken"/>
						</td>
					</tr>
				</table>
			</form>
			</tr>
	</table>
</body>
</html>