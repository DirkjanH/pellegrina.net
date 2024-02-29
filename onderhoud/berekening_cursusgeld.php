<?php 
$cursusgeld = 0;
$wensenNL = "";
$wensenEN = "";

// bereken het cursusgeld
if ($Aanbetaling->Fields('cursus1')) {
	if ($Aanbetaling->Fields('student'))
			if ($Aanbetaling->Fields('oost')) {
				$cursusgeld = $ooststud;
				$wensenNL .= "deelname als Oost-europese student";
				$wensenEN .= "participation as Eastern European student"; }
			else {
				$cursusgeld = $student;
				$wensenNL .= "deelname als student";
				$wensenEN .= "participation as student"; }
	elseif ($Aanbetaling->Fields('toehoorder')) {
			$cursusgeld = $toehoorder;
			$wensenNL .= "deelname als toehoorder";
			$wensenEN .= "participation as auditor"; }
	else		
		if ($Aanbetaling->Fields('oost')) {
				$cursusgeld = $oost;
				$wensenNL .= "deelname als Oost-europese deelnemer";
				$wensenEN .= "participation as Eastern European participant"; }
			else {
				$cursusgeld = $cursusprijs;
				$wensenNL .= "deelname aan cursus ???";
				$wensenEN .= "participation in course ???"; }
	if ($Aanbetaling->Fields('eenpersoons')) {
		$cursusgeld += $eenpers;
		$wensenNL .= ", eenpersoons kamer";
		$wensenEN .= ", single room"; }
	if ($Aanbetaling->Fields('kamperen')) {
		$cursusgeld -= $kamp;
		$wensenNL .= ", kamperen";
		$wensenEN .= ", camping"; }
		
}
if ($Aanbetaling->Fields('cursus1') and $Aanbetaling->Fields('cursus2')) { $wensenNL .= ", "; $wensenEN .= ", "; }

// korting voor het volgen van beide cursussen:
if ($Aanbetaling->Fields('cursus1') and $Aanbetaling->Fields('cursus2'))
	$cursusgeld -= $korting2;

if ($Aanbetaling->Fields('cursusgeld') !== NULL) $cursusgeld = $Aanbetaling->Fields('cursusgeld');
if (isset($_POST['cursusgeld'])) $cursusgeld = $_POST['cursusgeld'];
?>