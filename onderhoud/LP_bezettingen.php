<?php //Connection statement
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2027.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/LP_security.php';
// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1 );

error_reporting(E_ALL);

try {
    $instrumenten = $db->query("SELECT id, nl, en FROM instr ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
    $streefquery = $db->prepare("SELECT InstrId, Aantal FROM instr_aantallen WHERE CursusId_FK = ?");
    $bezettingsquery = $db->prepare("SELECT COUNT(*) FROM inschrijving, dlnmr WHERE DlnmrId = DlnmrId_FK AND
        achternaam NOT LIKE '%XXX%' AND achternaam NOT LIKE '%YYY%' AND achternaam NOT LIKE '%ZZZ%' AND aangenomen = 1
        AND SUBSTRING_INDEX(instr, ', ', 1) = ? AND NOT (afgewezen <=> 1) AND cursusid_FK = ?");
    $streven = $bezetting = $totaal = [];
    for ($cursus = $cursus_offset + 1; $cursus <= $aantal_cursussen + $cursus_offset; $cursus++) {
        $streven[$cursus]['totaal'] = 0;
        $totaal[$cursus] = 0;
        $streefquery->execute([$cursus]);
        foreach ($streefquery->fetchAll(PDO::FETCH_ASSOC) as $streefgetal) {
            $streefaantal = (int) $streefgetal['Aantal'];
            $streven[$cursus][$streefgetal['InstrId']] = $streefaantal;
            $streven[$cursus]['totaal'] += $streefaantal;
        }
        foreach ($instrumenten as $instr) {
            $bezettingsquery->execute([$instr['id'], $cursus]);
            $bezetting[$cursus][$instr['id']] = (int) $bezettingsquery->fetchColumn();
            $totaal[$cursus] += $bezetting[$cursus][$instr['id']];
        }
    }
} catch (PDOException $exception) {
    error_log('LP_bezettingen: databasefout: ' . $exception->getMessage());
    http_response_code(500);
    exit('De bezettingen konden niet worden geladen.');
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <META NAME="robots" CONTENT="noindex, nofollow">
    <link rel="apple-touch-icon" sizes="180x180"
        href="https://pellegrina.net/Images/Logos/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32"
        href="https://pellegrina.net/Images/Logos/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16"
        href="https://pellegrina.net/Images/Logos/favicon-16x16.png">
    <link rel="manifest"
        href="https://pellegrina.net/Images/Logos/site.webmanifest">
    <link rel="mask-icon"
        href="https://pellegrina.net/Images/Logos/safari-pinned-tab.svg"
        color="#5bbad5">
    <link rel="shortcut icon"
        href="https://pellegrina.net/Images/Logos/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config"
        content="https://pellegrina.net/Images/Logos/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <title>LP bezettingen</title>
    <link rel="stylesheet" href="/css/pellegrina_stijlen.css">
    <link rel="stylesheet" href="/css/LP_onderhoud.css">
    <style type="text/css">
    <!--
    .klein {
        font-size: 75%;
        color: #CC0000;
    }
    -->
    </style>
</head>
<body>
    <div id="zoeknaam"> <?php require_once('LP_zoeknaam.php'); ?> </div>
    <div id="mainframe">
        <header id="navigatiebalk"> <?php require_once('LP_navigatie.php'); ?>
        </header>
        <div id="mainpage">
            <div class="w3-content w3-white">
                <table class="w3-table w3-striped w3-border-blue-gray">
                    <tr>
                        <th>Id:</th>
                        <th>Naam:</th> <?php
										$cursus = $cursus_offset + 1;
										while ($cursus <= $aantal_cursussen + $cursus_offset) {
											echo '<th>Cursus ' . $cursus . ':</th>';
											$cursus++;
										}
										echo "</tr>\n";

										$aantal = [];
										foreach ($instrumenten as $instr) {
											$cursus = $cursus_offset + 1;
											while ($cursus <= $aantal_cursussen + $cursus_offset) {
												$aantal[$cursus] = $bezetting[$cursus][$instr['id']] ?: '';
												if (($streven[$cursus][$instr['id']] ?? 0) > 0)
													$aantal[$cursus] .= " <span class=\"klein\">({$streven[$cursus][$instr['id']]})</span>";
												$cursus++;
											}

										?>
                    <tr>
                        <td><?php echo lp_html($instr['id']); ?></td>
                        <td><?php echo lp_html($instr['nl']); ?></td> <?php
																$cursus = $cursus_offset + 1;
																while ($cursus <= $aantal_cursussen + $cursus_offset) {
																	echo '<td>' . $aantal[$cursus] . '</td>';
																	$cursus++;
																}
																echo "</tr>\n";
															}
																?>
                    <tr>
                        <td>&nbsp;</td>
                        <td><strong>TOTAAL:</strong></td> <?php
															$cursus = $cursus_offset + 1;
															while ($cursus <= $aantal_cursussen + $cursus_offset) {
																echo '<td><strong>' . $totaal[$cursus] . ' <span class="klein">(' . $streven[$cursus]['totaal'] . ')</span></strong></td>';
																$cursus++;
															}
															echo "</tr>\n";
															?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>