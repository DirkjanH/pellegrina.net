<?php //Connection statement
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);
error_reporting(E_ALL);

Kint::$enabled_mode = false;

if ($taal == 'NL') {
    $titel = 'Docenten \'';
    $titel .= $cursusdata['cursusnaam_nl'];
    $titel .= '\'';
} else {
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
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
    <title>Tutors</title>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.EN.php'; ?>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
</head>
<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
    <div id="inhoud" class="w3-main">
        <div class="w3-container w3-theme-l5">
            <h2 class="begin"><?php echo $titel; ?></h2>
            <h3><?php echo $cursusdata['ondertitel']; ?></h3>
        </div> <?php foreach ($docenten as $docent) { ?> <div
            class="w3-panel style=" padding-top:20px;">
            <a id="<?php echo $docent['foto']; ?>"></a>
            <div class="w3-col w3-panel w3-margin-left w3-card-2 w3-right"
                style="width:162px; padding: 6px 6px 0px 6px;"><img
                    src="/Images/Docenten/<?php echo $docent['foto']; ?>.jpg"
                    width="150" class="geenlijn"
                    alt="<?php echo $docent['naam']; ?>" />
                <div class="w3-container klein w3-center"
                    style="padding: 4px 0px;"><?php echo $docent['naam']; ?>
                </div>
            </div> <?php if ($taal == 'EN') echo $docent['bio_EN'];
                        else echo $docent['bio_NL']; ?>
        </div> <?php } ?> </body>
</html>