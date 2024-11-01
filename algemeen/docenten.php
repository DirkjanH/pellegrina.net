<?php //Connection statement
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);
error_reporting(E_ALL);

Kint::$enabled_mode = false;

if ($taal == 'NL') {
	$titel = 'Docenten \'';
	$titel .= $cursusdata['cursusnaam_nl'];
	$titel .= '\'';
}
else {
	$titel = 'Tutors \'';
	$titel .= $cursusdata['cursusnaam_en'];
	$titel .= '\'';
}

$query_docenten = "SELECT * FROM docenten, cursusdocenten WHERE DocId = DocId_FK AND CursusId_FK = {$cursus} AND code IS NOT NULL ORDER BY achternaam";
d($query_docenten);
$docenteninfo = select_query($query_docenten);
if (is_array($docenteninfo)) $totaal_docenten = count($docenteninfo);

d($totaal_docenten, $docenteninfo);
 
foreach ($docenteninfo as $i => $doc) {
	$docenten[$i]['naam'] = $doc['naam'];
	$docenten[$i]['bio_NL'] = $doc['bio_NL'];
	$docenten[$i]['bio_EN'] = $doc['bio_EN'];
	$docenten[$i]['foto'] = $doc['foto'];
	}
/* echo '<pre>';
print_r($docenten);
echo '</pre>';
 */ 
?>
<div class="w3-container w3-theme-l5">
  <h2 class="begin"><?php echo $titel; ?></h2>
  <h3><?php echo $cursusdata['ondertitel']; ?></h3>
</div>

    <?php foreach ($docenten as $docent) {?>
  <div class="w3-panel"><a id="<?php echo $docent['foto']; ?>"></a>
  <div class="w3-col w3-panel w3-padding-0 w3-margin-left w3-card-2 w3-right" style="width:150px"><img src="/Images/Docenten/<?php echo $docent['foto']; ?>.jpg" width="150" class="geenlijn" alt="<?php echo $docent['naam']; ?>"/>
    <div class="w3-container fotobijschrift w3-center" style="margin-top: 6px;"><?php echo $docent['naam']; ?></div>
  </div>
  <?php if ($taal == 'EN') echo $docent['bio_EN']; else echo $docent['bio_NL']; ?>
</div>
<?php } ?>
