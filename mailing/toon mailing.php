<?php // stel php in dat deze fouten weergeeft
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

Kint::$enabled_mode = false;

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2025.php');

?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <link href="/css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">

    <title>Toon mailing</title>
</head>
<?php
function printTable($tbl_name, $db_query)
{
    global $db;
    //Get column names
    $result = $db->query("select * from {$tbl_name} limit 1");
    $col_names = array_keys($result->fetch(PDO::FETCH_ASSOC));
    //Get number of columns
    $col_cnt = count($col_names);

    //Setup table
    echo "<table class='w3-table w3-striped w3-border'>";
    echo "<tr colspan='" . $col_cnt . "'>" . $tbl_name . "</tr>";
    echo "<tr>";

    //Give each table column same name is db column name
    for ($i = 0; $i < $col_cnt; $i++) {
        echo "<th>" . $col_names[$i] . "</th>";
    }

    echo "</tr>";

    //Get db table data
    $results = select_query($db_query);
    $res_cnt = count($results);

    //Print out db table data
    for ($i = 0; $i < $res_cnt; $i++) {
        echo "<tr>";
        for ($y = 0; $y < $col_cnt; $y++) {
            echo "<td>" . $results[$i][$col_names[$y]] . "</td>";
        }
        echo "</tr>";
    }
    echo '</table>';
}

?>

<body class="w3-margin w3-white">
    <?php
    $mailing_opdrachten = 'mailing_opdrachten';
    $mailing_adressen = 'mailing_adressen';
    $mailing_tekst = 'messages';

    if (isset($_GET['mailing'])) {
        $mailing_id = $_GET['mailing'];
    } else {
        echo 'Mailing bestaat niet<br><br>';
    }

    echo 'Mailing-nr: ' . $mailing_id . '<br>';

    $query = "SELECT * FROM {$mailing_opdrachten} WHERE mailingId = {$mailing_id}";
    $mailing = select_query($query, 1);
    $message = $mailing['message'];
    $query = "SELECT * FROM {$mailing_adressen} WHERE mailingId_FK = {$mailing_id}";
    echo 'Afzender: ' . $mailing['FromName'] . '<br>';
    echo 'Afzender-email: ' . $mailing['From'] . '<br>';
    echo 'Subject: ' . $mailing['subject'] . '<br>';
    echo 'Aangemaakt op: ' . $mailing['tijd_aanmaak'] . '<br>';
    echo 'Verzonden mails: ' . $mailing['verzonden_mails'] . '<br>';
    echo 'Mail-tekst: ' . stripslashes($message) . '<br>';
    echo '<hr>';
    printTable($mailing_adressen, $query);
    ?>
</body>

</html>