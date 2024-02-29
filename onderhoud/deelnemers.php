<?php //Connection statement
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/includes2024.php');
// begin Recordset
$query_lijst = "SELECT * FROM inschrijving, dlnmr, adres WHERE dlnmrid = dlnmrid_fk AND adresid_fk = adresid 
and cursusid_fk > {$cursus_offset} and NOT (afgewezen <=> 1) and NOT (toehoorder <=> 1) ORDER BY achternaam ASC";
$lijst = $inschrijf->SelectLimit($query_lijst) or die($inschrijf->ErrorMsg());
$totalRows_lijst = $lijst->RecordCount();
// end Recordset

// begin Recordset
$query_instrumenten = "SELECT * FROM instr ORDER BY id ASC";
$instrumenten = $inschrijf->SelectLimit($query_instrumenten) or die($inschrijf->ErrorMsg());
$totalRows_instrumenten = $instrumenten->RecordCount();
while (!$instrumenten->EOF) {
	$instrumententabel[$instrumenten->Fields('id')] = $instrumenten->Fields('nl');
	$instrumenten->MoveNext();
	}
// end Recordset

?><!DOCTYPE HTML>
<html>
<head>
<title>tabel deelnemers</title>
<meta charset="utf-8">
<style type="text/css">
<!--
body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: xx-small;
}
-->
</style>
</head>

<body>
<table  border="1" cellpadding="4">
  <tr>
    <td>naam</td>
    <td>voornaam</td>
    <td>tussenvoegsels</td>
    <td>achternaam</td>
    <td>adres</td>
    <td>postcode</td>
    <td>plaats</td>
    <td>land</td>
    <td>Cursus</td>
    <td>eerste_inschrijving</td>
    <td>password</td>
    <td>geboortedatum</td>
    <td>geslacht</td>
    <td>taal</td>
    <td>telefoon</td>
    <td>mobiel</td>
    <td>email</td>
    <td>dieet</td>
    <td>student</td>
    <td>oost</td>
    <td>publiciteit</td>
    <td>naam_aanbrenger</td>
    <td>publiciteit_tx</td>
    <td>aangenomen</td>
    <td>instrumenten</td>
    <td>instr</td>
    <td>instr_naam</td>
    <td>groot_ensemble1</td>
    <td>groot_ensemble2</td>
    <td>zangstem</td>
    <td>danser</td>
    <td>toehoorder</td>
    <td>vervoer</td>
    <td>info_korting</td>
    <td>acc_wens</td>
    <td>eenpersoons</td>
    <td>kamperen</td>
    <td>hotel eenpers.</td>
    <td>hotel tweepers.</td>
    <td>storting_fonds</td>
    <td>donatie</td>
    <td>opmerkingen</td>
    <td>voorwaarden</td>
    <td>aanbetaling</td>
    <td>aanbet_bedrag</td>
    <td>cursusgeld</td>
    <td>korting</td>
    <td>voorl_bev</td>
    <td>inzeepdag</td>
    <td>afgewezen</td>
    <td>datum_inschr</td>
    <td>aanmaning_inschr</td>
  </tr>
  <?php
  while (!$lijst->EOF) {
	$ins = explode(', ', $lijst->Fields('instr'));
	unset($instr);
	foreach ($ins as $in) if ($in >= 0) $instr[] = $instrumententabel[$in];
	$instr = implode(', ', $instr);
?>
    <tr>
      <td><?php echo $lijst->Fields('naam'); ?></td>
      <td><?php echo $lijst->Fields('voornaam'); ?></td>
      <td><?php echo $lijst->Fields('tussenvoegsels'); ?></td>
      <td><?php echo $lijst->Fields('achternaam'); ?></td>
      <td><?php echo $lijst->Fields('adres'); ?></td>
      <td><?php echo $lijst->Fields('postcode'); ?></td>
      <td><?php echo $lijst->Fields('plaats'); ?></td>
      <td><?php echo $lijst->Fields('land'); ?></td>
      <td><?php echo $lijst->Fields('CursusId_FK'); ?></td>
      <td><?php echo $lijst->Fields('eerste_inschrijving'); ?></td>
      <td><?php echo $lijst->Fields('password'); ?></td>
      <td><?php echo $lijst->Fields('geboortedatum'); ?></td>
      <td><?php echo $lijst->Fields('geslacht'); ?></td>
      <td><?php echo $lijst->Fields('taal'); ?></td>
      <td><?php echo $lijst->Fields('telefoon'); ?></td>
      <td><?php echo $lijst->Fields('mobiel'); ?></td>
      <td><?php echo $lijst->Fields('email'); ?></td>
      <td><?php echo $lijst->Fields('dieet'); ?></td>
      <td><?php echo $lijst->Fields('student'); ?></td>
      <td><?php echo $lijst->Fields('oost'); ?></td>
      <td><?php echo $lijst->Fields('publiciteit'); ?></td>
      <td><?php echo $lijst->Fields('naam_aanbrenger'); ?></td>
      <td><?php echo $lijst->Fields('publiciteit_tx'); ?></td>
      <td><?php echo $lijst->Fields('aangenomen'); ?></td>
      <td><?php echo $lijst->Fields('instrumenten'); ?></td>
      <td><?php echo $lijst->Fields('instr'); ?></td>
      <td><?php echo $instr; ?></td>
      <td><?php echo $lijst->Fields('groot_ensemble1'); ?></td>
      <td><?php echo $lijst->Fields('groot_ensemble2'); ?></td>
      <td><?php echo $lijst->Fields('zangstem'); ?></td>
      <td><?php echo $lijst->Fields('danser'); ?></td>
      <td><?php echo $lijst->Fields('toehoorder'); ?></td>
      <td><?php echo $lijst->Fields('vervoer'); ?></td>
      <td><?php echo $lijst->Fields('info_korting'); ?></td>
      <td><?php echo $lijst->Fields('acc_wens'); ?></td>
      <td><?php echo $lijst->Fields('eenpersoons'); ?></td>
      <td><?php echo $lijst->Fields('kamperen'); ?></td>
      <td><?php echo $lijst->Fields('hotel_1pp'); ?></td>
      <td><?php echo $lijst->Fields('hotel_2pp'); ?></td>
      <td><?php echo $lijst->Fields('storting_fonds'); ?></td>
      <td><?php echo $lijst->Fields('donatie'); ?></td>
      <td><?php echo $lijst->Fields('opmerkingen'); ?></td>
      <td><?php echo $lijst->Fields('voorwaarden'); ?></td>
      <td><?php echo $lijst->Fields('aanbetaling'); ?></td>
      <td><?php echo $lijst->Fields('aanbet_bedrag'); ?></td>
      <td><?php echo $lijst->Fields('cursusgeld'); ?></td>
      <td><?php echo $lijst->Fields('korting'); ?></td>
      <td><?php echo $lijst->Fields('voorl_bev'); ?></td>
      <td><?php echo $lijst->Fields('inzeepdag'); ?></td>
      <td><?php echo $lijst->Fields('afgewezen'); ?></td>
      <td><?php echo $lijst->Fields('datum_inschr'); ?></td>
      <td><?php echo $lijst->Fields('aanmaning_inschr'); ?></td>
    </tr>
    <?php
    $lijst->MoveNext(); 
  }
?>
</table>
</body>
</html>
<?php
$lijst->Close();
?>
