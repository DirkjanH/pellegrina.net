<?php //Connection statement
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);

error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2025.php');
require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

Kint::$enabled_mode = false;

if (!(isset($_SESSION['datum']) && $_SESSION['datum'] != "")) $_SESSION['datum'] = date("d-m-Y");
if (isset($_POST['datum']) && $_POST['datum'] != "") $_SESSION['datum'] = $_POST['datum'];

d($_POST);
d($_SESSION);

// begin Recordset Cursussen
$query_cursussen = "SELECT * FROM cursus WHERE CursusId > {$cursus_offset} ORDER BY CursusId ASC";

// echo 'query_cursussen : ' . $query_cursussen . "<br>\n";

$cursussen = select_query($query_cursussen);

foreach ($cursussen as $cur) {
	$cursusnaam[$cur['CursusId']]['NL'] = $cur['cursusnaam_nl'];
	$cursusnaam[$cur['CursusId']]['EN'] = $cur['cursusnaam_en'];
}
// end Recordset Cursussen

if (empty($_GET['DlnmrId']) or $_GET['DlnmrId'] == "") $id = -1;
else $id = $_GET['DlnmrId'];

if ((isset($_POST["Verwerk"])) && ($_POST["Verwerk"] == "Verwerk betaling") && $_POST['InschId'] != "") {

	if ($_POST['betaling'] != 0) $_POST['rekening_opmerking'] = $_POST['rekening_opmerking'] . "Betaling van &#8364;&nbsp;{$_POST['betaling']} d.d. {$_POST['datum']} per {$_POST['betaalwijze']}\n";
	if ($_POST['cash'] == 1) {
		$_POST['rekening_opmerking'] .= "Betaling ter plekke in cash afgesproken\n";
		$_POST['betaling'] = 0;
	}
	$updateSQL = sprintf(
		"UPDATE inschrijving SET aanbet_bedrag=%s, rekening_opmerking=%s WHERE InschId=%s",
		($_POST['aanbet_bedrag'] + $_POST['betaling']),
		quote($_POST['rekening_opmerking']),
		quote($_POST['InschId'])
	);

	d($updateSQL);

	exec_query($updateSQL);
} // update

// begin Recordset
$query_inschrijving = '';
if (empty($_GET['DlnmrId'])) $_GET['DlnmrId'] = '-1';
$query_inschrijving = "SELECT * FROM inschrijving, dlnmr WHERE DlnmrId_FK = DlnmrId 
AND DlnmrId_FK = {$_GET['DlnmrId']} AND CursusId_FK > {$cursus_offset} 
AND CursusId_FK <= ({$aantal_cursussen} + {$cursus_offset}) ORDER BY CursusId_FK ASC";

if (isset($_POST['InschId']) and $_POST['InschId'] != "") {
	$query_inschrijving = "SELECT * FROM inschrijving, dlnmr WHERE DlnmrId_FK = DlnmrId 
	AND InschId = {$_POST['InschId']} AND CursusId_FK > {$cursus_offset} 
	AND CursusId_FK <= ({$aantal_cursussen} + {$cursus_offset}) 
	AND achternaam NOT LIKE '%XXX%'
    AND achternaam NOT LIKE '%YYY%'
    AND achternaam NOT LIKE '%ZZZ%'
	ORDER BY CursusId_FK ASC";
}

d($query_inschrijving);

if ($query_inschrijving != '') {
	$inschrijving = select_query($query_inschrijving);
	$totalRows_inschrijving = count($inschrijving);
}
// end Recordset

// begin Recordset Openstaande rekeningen
$query_openstaand = "SELECT *
FROM inschrijving,
  dlnmr
WHERE DlnmrId_FK = DlnmrId
    AND CursusId_FK BETWEEN {$eerstecursus}
    AND {$laatstecursus}
    AND ((cursusgeld + IFNULL(donatie, 0) - IFNULL(aanbet_bedrag, 0)) != 0)
    AND aangenomen = 1
	AND NOT(afgewezen <=> 1)
    AND achternaam NOT LIKE '%XXX%'
    AND achternaam NOT LIKE '%YYY%'
    AND achternaam NOT LIKE '%ZZZ%'
	AND geboortedatum != 0  
ORDER BY CursusId_FK, achternaam ASC";

d($query_openstaand);

$openstaand = select_query($query_openstaand);
$totalRows_openstaand = count($openstaand);
// end Recordset Openstaande rekeningen

// begin Recordset Openstaand bedrag
$query_bedrag = "SELECT
  SUM(cursusgeld + IFNULL(donatie, 0) - IFNULL(aanbet_bedrag, 0)) AS tebetalen
FROM inschrijving,
  dlnmr
WHERE DlnmrId_FK = DlnmrId
    AND CursusId_FK BETWEEN {$eerstecursus}
    AND {$laatstecursus}
    AND aangenomen = 1
	AND NOT(afgewezen <=> 1)
    AND achternaam NOT LIKE '%XXX%'
    AND achternaam NOT LIKE '%YYY%'
    AND achternaam NOT LIKE '%ZZZ%'
	AND geboortedatum != 0  
GROUP BY CursusId_FK";

$bedrag = select_query($query_bedrag);

$openstaand_bedrag['totaal'] = 0;
foreach ($bedrag as $i => $bedr) {
	$openstaand_bedrag[$i + 1] = $bedr['tebetalen'];
	$openstaand_bedrag['totaal'] += $openstaand_bedrag[$i + 1];
	$openstaand_bedrag[$i + 1] = euro2($openstaand_bedrag[$i + 1]);
}
$openstaand_bedrag['Etotaal'] = euro2($openstaand_bedrag['totaal']);

d($openstaand_bedrag);

// end Recordset Openstaand bedrag

// begin Recordset Cash te betalen
$query_bedrag = "SELECT
  SUM(cursusgeld + IFNULL(donatie, 0) - IFNULL(aanbet_bedrag, 0)) AS tebetalen
FROM inschrijving,
  dlnmr
WHERE DlnmrId_FK = DlnmrId
    AND CursusId_FK BETWEEN {$eerstecursus}
    AND {$laatstecursus}
    AND aangenomen = 1
	AND NOT(afgewezen <=> 1)
   AND achternaam NOT LIKE '%XXX%'
   AND achternaam NOT LIKE '%YYY%'
   AND achternaam NOT LIKE '%ZZZ%'
	AND geboortedatum != 0 
	AND rekening_opmerking LIKE '%cash%'
GROUP BY CursusId_FK";

$cashbedrag = select_query($query_bedrag);

$openstaand_cashbedrag['totaal'] = 0;
foreach ($cashbedrag as $i => $cashbedr) {
	$openstaand_cashbedrag[$i + 1] = $cashbedr['tebetalen'];
	$openstaand_cashbedrag['totaal'] += $openstaand_cashbedrag[$i + 1];
	$openstaand_cashbedrag[$i + 1] = euro2($openstaand_cashbedrag[$i + 1]);
}
$openstaand_cashbedrag['Etotaal'] = euro2($openstaand_cashbedrag['totaal']);
d($openstaand_cashbedrag);

// end Recordset Cash te betalen

$openstaand_giraal = euro2($openstaand_bedrag['totaal'] - $openstaand_cashbedrag['totaal']);

?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/onderhoud.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<META NAME="robots" CONTENT="noindex, nofollow">
	<link rel="apple-touch-icon" sizes="180x180" href="https://pellegrina.net/Images/Logos/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="https://pellegrina.net/Images/Logos/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="https://pellegrina.net/Images/Logos/favicon-16x16.png">
	<link rel="manifest" href="https://pellegrina.net/Images/Logos/site.webmanifest">

	<link rel="mask-icon" href="https://pellegrina.net/Images/Logos/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="https://pellegrina.net/Images/Logos/favicon.ico">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-config" content="https://pellegrina.net/Images/Logos/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>LP betalingen</title>
	<!-- InstanceEndEditable -->
	<link rel="stylesheet" href="/css/pellegrina_stijlen.css">
	<link rel="stylesheet" href="/css/onderhoud.css">
	<!-- InstanceBeginEditable name="head" -->

	<meta charset="utf-8">
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
		<!--
		function SetInschId(Id) {
			try {
				document.form.InschId.value = Id;
				document.form.Verwerk.value = '';
				document.form.submit();
			} catch (err) {
				alert('Dit werkt niet...;');
				for (var i in err) {
					alert(i + ': ' + err(i));
				}
			}
		}
		// 
		-->
	</SCRIPT>
	<!-- InstanceEndEditable -->
</head>

<body>
	<div id="zoeknaam">
		<?php require_once('LP_zoeknaam.php'); ?>
	</div>
	<div id="inhoud">
		<header id="navigatiebalk">
			<?php require_once('LP_navigatie.php'); ?>
		</header>
		<div id="mainpage">
			<!-- InstanceBeginEditable name="Mainpage" -->
			<table width="100%" border="0" align="left">
				<tr>
					<td colspan="2">
						<form id="zoek" name="zoek" method="get" action="<?php echo $editFormAction; ?>">
							Id:
							<input name="DlnmrId" type="text" value="<?php if (isset($_GET['DlnmrId']))
																			echo $_GET['DlnmrId']; ?>" size="5" />
							<input type="submit" name="Submit" value="Zoek">
						</form>
					</td>
				</tr>
				<?php
				if ($totalRows_inschrijving > 1) {
					echo "<tr><td colspan=\"3\">";
					echo "<p><b>Kies één van de volgende inschrijvingen:</b></p>";
					echo "<form action=\"{$editFormAction}\" method=\"get\" name=\"inschrijving\" id=\"inschrijving\"> \n <select name=\"cursus\" size=\"{$totalRows_inschrijving}\" >";
					foreach ($inschrijving as $ins) {
						echo "<option value=\"{$ins['CursusId_FK']}\"";
						if (!(strcmp($ins['CursusId_FK'], $_GET['cursus']))) {
							echo "SELECTED";
						}
						echo '>' . $cursusnaam[$ins['CursusId_FK']][NL];
					}
					echo "</option>\n</select>";
					echo '<input name="DlnmrId" type="hidden" value="';
					if (isset($_GET['DlnmrId'])) echo $_GET['DlnmrId'] . '" />';
					echo '<input type="submit" name="Submit" value="Zoek">';
					echo '</form></td></tr>';
				} else $ins = $inschrijving[0];
				?>
				<form action="<?php echo $editFormAction; ?>" method="POST" name="form" id="form">
					<tr>
						<td height="50" colspan="2" valign="top">
							<h2>Naam:&nbsp;<?php echo $ins['naam']; ?></h2>
							<?php if ($ins['CursusId_FK'] != "") echo "<p>Inschrijving nr. 
			<input name=\"Id\" type=\"text\" DISABLED value=\"{$ins['InschId']}\"
			size=\"2\">&nbsp;voor cursus:&nbsp;<b>{$cursusnaam[$ins['CursusId_FK']][NL]}</b></p>"; ?>
							<input name="aanbet_bedrag" type="hidden" value="<?php
																				echo $ins['aanbet_bedrag']; ?>">
							<input name="InschId" id="InschId" type="hidden" value="<?php
																					echo $ins['InschId']; ?>">
							<input name="CursusId_FK" type="hidden" value="<?php
																			echo $ins['CursusId_FK']; ?>">
						</td>
					</tr>
					<tr valign="baseline">
						<td width="100" align="right" nowrap>
							<div align="right">Cursusgeld:</div>
						</td>
						<td><?php echo euro2($ins['cursusgeld']); ?></td>
					</tr>
					<tr valign="baseline">
						<td width="100">
							<div align="right">Gedoneerd bedrag: </div>
						</td>
						<td><?php echo euro2($ins['donatie']); ?></td>
					</tr>
					<tr valign="baseline">
						<td width="100" align="right" nowrap>
							<div align="right">Totaal te betalen: </div>
						</td>
						<td><?php echo euro2($ins['cursusgeld'] + $ins['donatie']); ?>&nbsp;</td>
					</tr>
					<tr valign="baseline">
						<td width="100" align="right" nowrap>
							<div align="right">Al betaald:</div>
						</td>
						<td><?php echo euro2($ins['aanbet_bedrag']); ?></td>
					</tr>
					<tr valign="middle">
						<td width="100" align="right" valign="top" nowrap>
							<div align="right">Nog openstaand </div>
						</td>
						<td valign="top" nowrap><?php echo euro2($ins['cursusgeld'] + $ins['donatie'] - $ins['aanbet_bedrag']); ?>&nbsp;</td>
					</tr>
					<tr valign="middle">
						<td colspan="2" valign="top" nowrap>Betaling d.d.
							<input name="datum" type="text" id="datum" size="10" value="<?php echo $_SESSION['datum'] ?>">
							per
							<label>
								<input name="betaalwijze" type="radio" value="Postbank" checked>
								Postbank</label>
							<label>
								<input type="radio" name="betaalwijze" value="KB">
								KB</label>
							<label>
								<input type="radio" name="betaalwijze" value="PayPal">
								PayPal</label>
							<label>
								<input type="radio" name="betaalwijze" value="kas">
								kas van &nbsp;&#8364;&nbsp;
								<input name="betaling" type="text" id="betaling" size="5" value="<?php echo ($ins['cursusgeld'] + $ins['donatie'] - $ins['aanbet_bedrag']); ?>">
								&nbsp;Betaling tijdens cursus in contanten afgesproken:
								<input name="cash" type="checkbox" value="1" <?php if (isset($_POST['cash'])) echo 'checked'; ?>>
							</label>
						</td>
					</tr>
					<tr valign="middle">
						<td colspan="2" valign="top" nowrap>
							<div align="left">Opmerkingen over de betaling:<br>
								<textarea name="rekening_opmerking" cols="80" rows="3" id="rekening_opmerking"><?php
																												if ($ins['rekening_opmerking'] != "") echo stripslashes($ins['rekening_opmerking']); ?></textarea>
							</div>
						</td>
					</tr>
					<tr valign="baseline">
						<td>&nbsp;</td>
						<td valign="baseline">
							<div class="links">
								<input name="Verwerk" type="submit" class="fotobijschrift" id="Verwerk" value="Verwerk betaling" />
							</div>
						</td>
					</tr>
					<tr valign="baseline">
						<td colspan="2">
							<p class="groot">Nog openstaande rekeningen:</p>
							<div id="navcontainer" style="width: 300px;">
								<ul id="navlist">
									<?php
									foreach ($openstaand as $open) {
										$grijs = TRUE;
										if (stripos($open['rekening_opmerking'], 'Betaling ter plekke in cash') === FALSE)
											$grijs =  FALSE;
										$bedrag = $open['cursusgeld'] + $open['donatie']
											- $open['aanbet_bedrag'];
										$opens = '<li id="active"><a href="javascript:SetInschId(';
										$opens .= $open['InschId'] . ')">';
										if ($grijs) $opens .= '<span class="grijs">';
										$opens .= $open['naam'] . ' (';
										$opens .= euro2($bedrag);
										$opens .= ")";
										if ($grijs) $opens .= '</span>';
										$opens .= "</a></li>\n";
										echo $opens;
									}
									echo '<p>Aantal nog openstaande rekeningen: ' . $totalRows_openstaand . "; Totaal nog openstaand bedrag: cash {$openstaand_cashbedrag['Etotaal']} + giraal {$openstaand_giraal} = {$openstaand_bedrag['Etotaal']}<br>";
									foreach ($openstaand_bedrag as $key => $value) {
										if (strpos($key, 'totaal') === false) {
											echo "Cursus {$key}: ";
											echo $value . " | ";
										}
									}
									echo '</p>';
									?>
								</ul>
							</div> 
						</td>
					</tr>
				</form>
			</table>
			</td>
			</tr>
			</table>
			<!-- InstanceEndEditable -->
		</div>
	</div>
</body>
<!-- InstanceEnd -->

</html>