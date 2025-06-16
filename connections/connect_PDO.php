<?php
error_reporting( E_ALL ); 

	$HOSTNAME = 'localhost';
	$DATABASE = 'pellegrina_db';
	$USERNAME = 'pellegrina_lp';
	$PASSWORD = '12dirig.';

// echo "mysql:dbname=$DATABASE";

try {
    $db = new PDO("mysql:host=localhost;dbname=$DATABASE;charset=utf8", $USERNAME, $PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch(PDOException $e) 
{ 
    $sMsg = '<p> 
            Regelnummer: '.$e->getLine().'<br /> 
            Bestand: '.$e->getFile().'<br /> 
            Foutmelding: '.$e->getMessage().'</p>'; 
     
    trigger_error($sMsg); 
} 

// zet de localiteit op Nederland
setlocale(LC_ALL, 'nl_NL');
date_default_timezone_set('Europe/Amsterdam');

function select_query($query, $index = 2 ) {
	global $db;
	try {
		if (isset($query) AND $query != '') 
			foreach($db->query($query, PDO::FETCH_ASSOC) as $row) {
				if (is_string($index) AND $index != '') $result[$row[$index]] = $row;
				else $result[] = $row;
			}
		else echo 'Lege query<br>';

		if ($index == 1 and is_array($result) and count($result) == 1) {
			$result = $result[0];	// één rij
		}
		elseif ($index == 0 AND is_array($result) AND count($result, COUNT_RECURSIVE) == 2) {
			$result = current($result[0]);  // één waarde
		}
			
		if (isset($result)) return $result; else return false;
	}
	catch(PDOException $e) {
		echo "Fout: {$e}<br>";
	}
}

function exec_query($query) {
	global $db;
	// print_all($query);
	try {
		$db->exec($query);
		return true;
	} 
	catch(PDOException $e) {
		echo "Fout: {$e}<br>";
	}
}

function quote($value) {
	global $db;
	//d($value);
	if (!is_null($value)) return $db->quote($value);
}

function lastID() {
	global $db;
	return $db->lastInsertId();
}

function bedrag_streep($bedrag)
{
    if ($bedrag > 0) return number_format($bedrag, 0, ',', '.').',&#8211;';
}

function bedrag($bedrag)
{
    if (isset($bedrag) AND $bedrag != 0) return number_format($bedrag, 0, ',', '.');
}

function euro($bedrag)
{
    if ($bedrag > 0) return '&euro;&nbsp;' . number_format($bedrag, 0, ',', '.');
}

function euro2($bedrag)
{
    if ($bedrag > 0) $bedr = '&#8364;&nbsp;' . number_format($bedrag, 2, ',', '.');
    return str_replace(',00', ',&#8212;', $bedr);
}

function euro_en($bedrag)
{
    if ($bedrag > 0) return 'EUR&nbsp;' . number_format($bedrag, 0, ',', '.');
}

function euro_en2($bedrag)
{
    if ($bedrag > 0) $bedr = 'EUR&nbsp;' . number_format($bedrag, 2, ',', '.');
    return str_replace(',00', ',&#8212;', $bedr);
}

function czk($bedrag)
{
    if ($bedrag > 0) return 'CZK&nbsp;' . number_format($bedrag, 0, ',', '.');
}

?>