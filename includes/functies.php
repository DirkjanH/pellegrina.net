<?php
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
    if (isset($bedrag) AND is_numeric($bedrag)) return number_format($bedrag, 0, ',', '.').',&#8211;';
}

function bedrag($bedrag)
{
    if (isset($bedrag) AND is_numeric($bedrag)) return number_format($bedrag, 0, ',', '.');
}

function euro($bedrag)
{
    if (isset($bedrag) AND is_numeric($bedrag)) return '&euro;&nbsp;' . number_format($bedrag, 0, ',', '.');
}

function euro2($bedrag)
{
    if (isset($bedrag) AND is_numeric($bedrag)) $bedr = '&euro;&nbsp;' . number_format($bedrag, 2, ',', '.');
    return str_replace(',00', ',&#8212;', $bedr);
}

function euro_en($bedrag)
{
    if (isset($bedrag) AND is_numeric($bedrag)) return 'EUR&nbsp;' . number_format($bedrag, 0, ',', '.');
}

function euro_en2($bedrag)
{
    if (isset($bedrag) AND is_numeric($bedrag)) $bedr = 'EUR&nbsp;' . number_format($bedrag, 2, ',', '.');
    return str_replace(',00', ',&#8212;', $bedr);
}

function czk($bedrag)
{
    if (isset($bedrag) AND is_numeric($bedrag)) return 'CZK&nbsp;' . number_format($bedrag, 0, ',', '.');
}

?>