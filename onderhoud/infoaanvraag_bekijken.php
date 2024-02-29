<?php
//Connection statement
require_once('../connections/aanvraag.php');

// begin Recordset
$maxRows_infoaanvraag = 20;
$pageNum_infoaanvraag = 0;
if (isset($_GET['pageNum_infoaanvraag'])) {
$pageNum_infoaanvraag = $_GET['pageNum_infoaanvraag'];
}
$startRow_infoaanvraag = $pageNum_infoaanvraag * $maxRows_infoaanvraag;
$query_infoaanvraag = "SELECT * FROM aanvragen ORDER BY datum_inschr ASC";
$infoaanvraag = $aanvraag->SelectLimit($query_infoaanvraag, $maxRows_infoaanvraag, $startRow_infoaanvraag) or die($aanvraag->ErrorMsg());
if (isset($_GET['totalRows_infoaanvraag'])) {
$totalRows_infoaanvraag = $_GET['totalRows_infoaanvraag'];
} else {
$all_infoaanvraag = $aanvraag->SelectLimit($query_infoaanvraag) or die($aanvraag->ErrorMsg());
$totalRows_infoaanvraag = $all_infoaanvraag->RecordCount();
}
$totalPages_infoaanvraag = (int)(($totalRows_infoaanvraag-1)/$maxRows_infoaanvraag);
// end Recordset
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php //PHP ADODB document - made with PHAkt 3.5.1?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Overzicht info-aanvragen</title>
<meta http-equiv="Content-Type" content="text/html; charset=us-ascii" />
<meta http-equiv="refresh" content="60" />
<link href="http://www.xs4all.nl/%7Ehorringa/Pellegrina/pellegrina_stijlen.css" rel="stylesheet" type="text/css" />
<style type="text/css">
/*<![CDATA[*/
div.c1 {text-align: left}
/*]]>*/
</style>
</head>

<body>
<?php $loc_nl = setlocale(LC_ALL, 'nl_NL@euro', 'nl_NL', 'du', 'DU');
?>

<h3>Overzicht aanmeldingen voor nieuwsbrief <em>La Pellegrina</em> d.d. <?php echo strftime("%c");?></h3>

<div class="c1">
<div class="c1">
<?php
while (!$infoaanvraag->EOF) {
?>
</div>

<div class="c1">
<?php if  ($infoaanvraag->Fields('datum_inschr') != "")
{
$tijd = strftime("%A %d-%m-%Y, %H:%M uur",(strtotime($infoaanvraag->Fields('datum_inschr'))));
}
else
{
$tijd = 'niet bekend';
}
?>
</div>

<div class="c1">
<?php
$infoaanvraag->MoveNext();
}
?>
</div>

<table width="95%">
<tr>
<td>
<div class="c1">
<strong>naam</strong>
</div>
</td>

<td>
<div class="c1">
<strong>taal</strong>
</div>
</td>

<td>
<div class="c1">
<strong>instr./stem</strong>
</div>
</td>

<td>
<div class="c1">
<strong>geslacht</strong>
</div>
</td>

<td>
<div class="c1">
<strong>adres</strong>
</div>
</td>

<td>
<div class="c1">
<strong>postcode</strong>
</div>
</td>

<td>
<div class="c1">
<strong>plaats</strong>
</div>
</td>

<td>
<div class="c1">
<strong>land</strong>
</div>
</td>

<td>
<div class="c1">
<strong>telefoon</strong>
</div>
</td>

<td>
<div class="c1">
<strong>mobiel</strong>
</div>
</td>

<td>
<div class="c1">
<strong>email</strong>
</div>
</td>

<td>
<div class="c1">
<strong>opmerkingen</strong>
</div>
</td>

<td>
<div class="c1">
<strong>geboortedatum</strong>
</div>
</td>

<td>
<div class="c1">
<strong>datum inschrijving</strong>
</div>
</td>
</tr>

<tr>
<td>
<div class="klein_c1">
<?php echo $infoaanvraag->Fields('voornaam');
if ($infoaanvraag->Fields('tussenvoegsel') != "")
{
echo ' ' . $infoaanvraag->Fields('tussenvoegsel');
}
echo ' ' . $infoaanvraag->Fields('achternaam'); ?>
</div>
</td>

<td>
<div class="klein_c1">
<?php echo $infoaanvraag->Fields('taal'); ?>
</div>
</td>

<td>
<div class="klein_c1">
<?php echo $infoaanvraag->Fields('instrstem'); ?>
</div>
</td>

<td>
<div class="klein_c1">
<?php echo $infoaanvraag->Fields('geslacht'); ?>
</div>
</td>

<td>
<div class="klein_c1">
<?php echo $infoaanvraag->Fields('adres'); ?>
</div>
</td>

<td>
<div class="klein_c1">
<?php echo $infoaanvraag->Fields('pc'); ?>
</div>
</td>

<td>
<div class="klein_c1">
<?php echo $infoaanvraag->Fields('plaats'); ?>
</div>
</td>

<td>
<div class="klein_c1">
<?php echo $infoaanvraag->Fields('land'); ?>
</div>
</td>

<td>
<div class="klein_c1">
<?php echo $infoaanvraag->Fields('telefoon'); ?>
</div>
</td>

<td>
<div class="klein_c1">
<?php echo $infoaanvraag->Fields('mobiel'); ?>
</div>
</td>

<td>
<div class="klein_c1">
<?php echo $infoaanvraag->Fields('email'); ?>
</div>
</td>

<td>
<div class="klein_c1">
<?php echo $infoaanvraag->Fields('opmerkingen'); ?>
</div>
</td>

<td>
<div class="klein_c1">
<?php echo $infoaanvraag->Fields('geboortedatum'); ?>
</div>
</td>

<td>
<div class="klein_c1">
<?php echo $tijd; ?>
</div>
</td>
</tr>
</table>
</div><?php
$infoaanvraag->Close();
?>
</body>
</html>
