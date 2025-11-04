<?php //Connection statement
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2026.php');
// begin Recordset
$query_lijst = "SELECT DISTINCT naam, voornaam, adres, postcode, plaats, land, taal, email FROM inschrijving, dlnmr, adres WHERE dlnmrid = dlnmrid_fk AND adresid_fk = adresid 
and NOT (afgewezen <=> 1) and naam NOT LIKE '%XXX%' AND NOT (toehoorder <=> 1) ORDER BY achternaam ASC";
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

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php //PHP ADODB document - made with PHAkt 3.5.1
?>
<html>

<head>
  <title>tabel deelnemers</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
  <table border="1" cellpadding="4">
    <tr>
      <td>naam</td>
      <td>voornaam</td>
      <td>adres</td>
      <td>postcode</td>
      <td>plaats</td>
      <td>land</td>
      <td>email</td>
      <td>taal</td>
    </tr>
    <?php
    while (!$lijst->EOF) {
      $ins = explode(', ', $lijst->Fields('instr'));
      unset($instr);
      foreach ($ins as $in) if ($in >= 100) $instr[] = $instrumententabel[$in];
      $instr = implode(', ', $instr);
    ?>
      <tr>
        <td><?php echo $lijst->Fields('naam'); ?></td>
        <td><?php echo $lijst->Fields('voornaam'); ?></td>
        <td><?php echo $lijst->Fields('adres'); ?></td>
        <td><?php echo $lijst->Fields('postcode'); ?></td>
        <td><?php echo $lijst->Fields('plaats'); ?></td>
        <td><?php echo $lijst->Fields('land'); ?></td>
        <td><?php echo $lijst->Fields('email'); ?></td>
        <td><?php echo $lijst->Fields('taal'); ?></td>
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