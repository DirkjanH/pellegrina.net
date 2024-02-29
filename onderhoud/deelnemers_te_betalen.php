<?php
//Connection statement
require_once('../connections/inschrijf_oud.php');

// begin Recordset
$query_Recordset1 = "SELECT * FROM inschrijvingen WHERE aangenomen <> 0 ORDER BY achternaam ASC";
$Recordset1 = $inschrijf->SelectLimit($query_Recordset1) or die($inschrijf->ErrorMsg());
$totalRows_Recordset1 = $Recordset1->RecordCount();
// end Recordset
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php //PHP ADODB document - made with PHAkt 3.5.1?>
<html>
<head>
<title>basis voor rekening deelnemers</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<table border="1" align="center" cellpadding="2" cellspacing="0">
	<tr>
		<td>InschId</td>
		<td>cursus1</td>
		<td>cursus2</td>
		<td>naam</td>
		<td>toehoorder</td>
		<td>korting</td>
		<td>student</td>
		<td>oost</td>
		<td>eenpersoons</td>
		<td>kamperen</td>
		<td>particulier</td>
		<td>donatie</td>
		<td>aanbet_bedrag</td>
		<td>cursusgeld</td>
	</tr>
	<?php
	while (!$Recordset1->EOF) {
		?>
	<tr align="center">
		<td><?php echo $Recordset1->Fields('InschId'); ?></td>
		<td><?php if ($Recordset1->Fields('cursus1') != 0) echo $Recordset1->Fields('cursus1'); ?></td>
		<td><?php if ($Recordset1->Fields('cursus1') != 0) echo $Recordset1->Fields('cursus1'); ?></td>
		<td align="left"><?php echo $Recordset1->Fields('naam'); ?></td>
		<td><?php if ($Recordset1->Fields('toehoorder') != 0) echo $Recordset1->Fields('toehoorder'); ?></td>
		<td><?php if ($Recordset1->Fields('korting') != 0) echo $Recordset1->Fields('korting'); ?></td>
		<td><?php if ($Recordset1->Fields('student') != 0) echo $Recordset1->Fields('student'); ?></td>
		<td><?php if ($Recordset1->Fields('oost') != 0) echo $Recordset1->Fields('oost'); ?></td>
		<td><?php if ($Recordset1->Fields('eenpersoons') != 0) echo $Recordset1->Fields('eenpersoons'); ?></td>
		<td><?php if ($Recordset1->Fields('kamperen') != 0) echo $Recordset1->Fields('kamperen'); ?></td>
		<td><?php if ($Recordset1->Fields('hotel_2pp') != 0) echo $Recordset1->Fields('hotel_2pp'); ?></td>
		<td><?php if ($Recordset1->Fields('donatie') != 0) echo $Recordset1->Fields('donatie'); ?></td>
		<td align="right"><?php echo $Recordset1->Fields('aanbet_bedrag'); ?></td>
		<td align="right"><?php echo $Recordset1->Fields('cursusgeld'); ?></td>
	</tr>
	<?php
	$Recordset1->MoveNext();
}
?>
</table>
</body>
</html>
<?php
$Recordset1->Close();
?>
