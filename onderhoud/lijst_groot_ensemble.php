<?php //Connection statement
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2025.php');
$cursus = 3; // alleen Romantische cursus

// begin Recordset
$query_groot_ensemble = "SELECT naam, groot_ensemble1, groot_ensemble2, instr, CursusId_FK FROM inschrijving, dlnmr WHERE dlnmrid = dlnmrid_fk AND CursusId_FK = ({$cursus} + {$cursus_offset}) 
AND naam NOT LIKE \"%XXX%\" AND naam NOT LIKE \"%YYY%\" AND naam NOT LIKE \"%ZZZ%\" AND NOT (afgewezen <=> 1) 
AND NOT (toehoorder <=> 1) 
order by groot_ensemble1, instr, achternaam";
$groot_ensemble = $inschrijf->SelectLimit($query_groot_ensemble) or die($inschrijf->ErrorMsg());
$totalRows_groot_ensemble = $groot_ensemble->RecordCount();
// end Recordset

// begin Recordset
$cursus = $eerstecursus;
$query_aantal_niet = "SELECT count(*) as aantal FROM inschrijving, dlnmr 
WHERE dlnmrid = dlnmrid_fk AND CursusId_FK = ({$cursus} + {$cursus_offset}) 
AND naam NOT LIKE \"%XXX%\" AND naam NOT LIKE \"%YYY%\" AND naam NOT LIKE \"%ZZZ%\" AND NOT (afgewezen <=> 1) 
AND NOT (toehoorder <=> 1) AND groot_ensemble1 > 0";
$result = $inschrijf->SelectLimit($query_aantal_niet) or die($inschrijf->ErrorMsg());
$aantal_niet[1] = $result->Fields('aantal');

$query_aantal_niet = "SELECT count(*) as aantal FROM inschrijving, dlnmr 
WHERE dlnmrid = dlnmrid_fk AND CursusId_FK = ({$cursus} + {$cursus_offset}) 
AND naam NOT LIKE \"%XXX%\" AND naam NOT LIKE \"%YYY%\" AND naam NOT LIKE \"%ZZZ%\" AND NOT (afgewezen <=> 1) 
AND NOT (toehoorder <=> 1) AND groot_ensemble2 = 1 ";
$result = $inschrijf->SelectLimit($query_aantal_niet) or die($inschrijf->ErrorMsg());
$aantal_niet[2] = $result->Fields('aantal');
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php //PHP ADODB document - made with PHAkt 3.7.1
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>groot_ensemble</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css" />
</head>

<body>

  <p>Aantal belangstellenden groot ensemble strijkers: <?php echo $aantal_niet[1]; ?>;
    &nbsp;&nbsp; belangstellenden groot ensemble blazers: <?php echo $aantal_niet[2]; ?></p>
  <table border="1" cellpadding="4">
    <tr>
      <th>Naam:</th>
      <th>Instr./stem:</th>
      <th>groot ensemble strijkers:</th>
      <th>groot ensemble blazers:</th>
    </tr>
    <?php
    while (!$groot_ensemble->EOF) {
      $ins = explode(', ', $groot_ensemble->Fields('instr'));
      unset($instr);
      foreach ($ins as $in) $instr[] = $instrumententabel[$in];
      $instr = implode(', ', $instr);
    ?>
      <tr>
        <td><?php echo $groot_ensemble->Fields('naam'); ?></td>
        <td><?php echo $instr; ?></td>
        <td><?php echo $groot_ensemble->Fields('groot_ensemble1'); ?></td>
        <td><?php echo $groot_ensemble->Fields('groot_ensemble2'); ?></td>
      </tr>
    <?php
      $groot_ensemble->MoveNext();
    }
    ?>
  </table>
</body>

</html>
<?php
$groot_ensemble->Close();
?>