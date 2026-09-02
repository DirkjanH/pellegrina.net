<?php
error_reporting(E_ALL);

$HOSTNAME = 'localhost';
$DATABASE = 'pellegrina_db';
$USERNAME = 'pellegrina_lp';
$PASSWORD = '12dirig.';

// echo "mysql:dbname=$DATABASE";

try {
    $initCommandAttribute = defined('Pdo\\Mysql::ATTR_INIT_COMMAND')
        ? constant('Pdo\\Mysql::ATTR_INIT_COMMAND')
        : PDO::MYSQL_ATTR_INIT_COMMAND;
    $db = new PDO("mysql:host=localhost;dbname=$DATABASE;charset=utf8", $USERNAME, $PASSWORD, array($initCommandAttribute => "SET NAMES 'utf8'"));
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $sMsg = '<p> 
            Regelnummer: ' . $e->getLine() . '<br /> 
            Bestand: ' . $e->getFile() . '<br /> 
            Foutmelding: ' . $e->getMessage() . '</p>';

    trigger_error($sMsg);
}
