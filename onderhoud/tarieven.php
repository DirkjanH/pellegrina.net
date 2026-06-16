<?php

function cursusgeld($ins)
{
	$jeugd_grens = 36; // korting onder deze leeftijd

	global $cursus, $cursus_offset, $ins;

	// tarievenlijst
	$cursusId   		= $ins['CursusId'] - $cursus_offset;
	$cursusprijs   		= $cursus[$ins['CursusId']]['prijs_volledig'];
	$student       		= $cursus[$ins['CursusId']]['prijs_student'];
	$oost	       		= $cursus[$ins['CursusId']]['prijs_ce'];
	$ooststud      		= $cursus[$ins['CursusId']]['prijs_ce_student'];
	$toehoorder    		= $cursus[$ins['CursusId']]['toehoorder'];
	$eenpers       		= $cursus[$ins['CursusId']]['eenpers'];
	$meerpers      		= $cursus[$ins['CursusId']]['meerpers'];
	$hotel_1pp      	= $cursus[$ins['CursusId']]['hotel_1pp'];
	$hotel_2pp      	= $cursus[$ins['CursusId']]['hotel_2pp'];
	$hotel_1_2pp      	= $cursus[$ins['CursusId']]['hotel_1_2pp'];
	$kamperen      		= $cursus[$ins['CursusId']]['kamperen'];
	$eigen_acc     		= $cursus[$ins['CursusId']]['korting_eigen_acc'];
	$korting_vroeg 		= $cursus[$ins['CursusId']]['korting_vroeg'];
	$diner		 		= $cursus[$ins['CursusId']]['diner'];
	$ACMP 				= 0;
	$korting2      		= 50; // korting PER CURSUS

	$actiedatum = $cursus[$ins['CursusId']]['datum_korting'];

	d($ins, $cursus, $cursusId, $cursus_offset);

	// bereken het cursusgeld

	$cursusgeld = 0;
	$wensenNL = "";
	$wensenEN = "";
	$regelNL = '<tr><td>';
	$regelEN = '<tr><td>';
	$donatieNL = '';
	$donatieEN = '';

	// echo 'De studentenkorting geldt: ' . ((integer)$ins['leeftijd'] < $jeugd_grens);

	if ($ins['toehoorder']) {
		$cursusgeld = $toehoorder;
		$b_toehoorder = bedrag($toehoorder);
		$wensenNL .= "deelname als toehoorder aan cursus ???";
		$wensenEN .= "participation as auditor in course ???";
		$regelNL .= "Deelname als toehoorder@@@{$b_toehoorder}";
		$regelEN .= "Participation as auditor@@@{$b_toehoorder}";
	} elseif ($ins['student'] or ((int)$ins['leeftijd'] < $jeugd_grens))
		if ($ins['oost']) {
			$cursusgeld = $ooststud;
			$b_ooststud = bedrag($ooststud);
			$wensenNL .= "deelname als Oost-Europese student/jongere aan cursus ???";
			$wensenEN .= "participation as Eastern European student/young participant in course ???";
			$regelNL .= "Deelname als Oost-Europese student@@@{$b_ooststud}";
			$regelEN .= "Participation as Eastern European student@@@{$b_ooststud}";
		} else {
			$cursusgeld = $student;
			$b_student = bedrag($student);
			$wensenNL .= "deelname als student/jongere aan cursus ???";
			$wensenEN .= "participation as student/young participant in course ???";
			$regelNL .= "Deelname als student@@@{$b_student}";
			$regelEN .= "Participation as student@@@{$b_student}";
		}
	else
		if ($ins['oost']) {
		$cursusgeld = $oost;
		$b_oost = bedrag($oost);
		$wensenNL .= "deelname als Oost-Europese deelnemer aan cursus ???";
		$wensenEN .= "participation as Eastern European participant in course ???";
		$regelNL .= "deelname als Oost-Europese deelnemer@@@{$b_oost}";
		$regelEN .= "participation as Eastern European participant@@@{$b_oost}";
	} else {
		$cursusgeld = $cursusprijs;
		$b_cursusprijs = bedrag($cursusprijs);
		$wensenNL .= "deelname aan cursus ???";
		$wensenEN .= "participation in course ???";
		$regelNL .= "Deelname aan de cursus@@@{$b_cursusprijs}";
		$regelEN .= "Participation summer school@@@{$b_cursusprijs}";
	}

	if ($ins['eenpersoons'] && $cursusId == 1) {
		$cursusgeld += $eenpers;
		$b_eenpers = bedrag($eenpers);
		$wensenNL .= ", plus supplement voor eenpersoons kamer";
		$wensenEN .= ", plus supplement for a single room";
		$regelNL .= "###Supplement voor eenpersoons kamer@@@{$b_eenpers}";
		$regelEN .= "###Supplement for single room@@@{$b_eenpers}";
	}

	if ($ins['eenpersoons'] && $cursusId == 2) {
		$cursusgeld += $eenpers;
		$b_eenpers = bedrag($eenpers);
		$wensenNL .= ", plus supplement voor eenpersoons kamer in het Gastenverblijf";
		$wensenEN .= ", plus supplement for a single room in the Guest House (Gastenverblijf)";
		$regelNL .= "###Supplement voor eenpersoons kamer@@@{$b_eenpers}";
		$regelEN .= "###Supplement for single room@@@{$b_eenpers}";
	}

	if ($ins['hotel_1pp']) {
		$cursusgeld += $hotel_1pp;
		$b_hotel_1pp = bedrag($hotel_1pp);
		$wensenNL .= ", plus supplement voor eenpersoons kamer in het Poortgebouw";
		$wensenEN .= ", plus supplement for a single room in the Gate House (Poortgebouw)";
		$regelNL .= "###Supplement voor eenpersoons kamer@@@{$b_hotel_1pp}";
		$regelEN .= "###Supplement for single room@@@{$b_hotel_1pp}";
	}

	if ($ins['hotel_2pp']) {
		$cursusgeld += $hotel_2pp;
		$b_hotel_2pp = bedrag($hotel_2pp);
		$wensenNL .= ", plus supplement voor plaats in een tweepersoons kamer met eigen sanitair in het Poortgebouw";
		$wensenEN .= ", plus supplement for a place in a double room with private bathroom facilities in the Gate House (Poortgebouw)";
		$regelNL .= "###Supplement voor eenpersoons kamer@@@{$b_hotel_2pp}";
		$regelEN .= "###Supplement for single room@@@{$b_hotel_2pp}";
	}

	if ($ins['hotel_1_2pp']) {
		$cursusgeld += $hotel_1_2pp;
		$b_hotel_1_2pp = bedrag($hotel_1_2pp);
		$wensenNL .= ", plus supplement voor een eenpersoons kamer met eigen sanitair in het Poortgebouw";
		$wensenEN .= ", plus supplement for a single room with private bathroom facilities in the Gate House (Poortgebouw)";
		$regelNL .= "###Supplement voor eenpersoons kamer@@@{$b_hotel_1_2pp}";
		$regelEN .= "###Supplement for single room@@@{$b_hotel_1_2pp}";
	}

	if ($ins['meerpers']) {
		$cursusgeld += $meerpers;
		$b_meerpers = bedrag($meerpers);
		$wensenNL .= ", minus korting voor meerpersoons kamer";
		$wensenEN .= ", minus reduction for multi-person room";
		$regelNL .= "###Korting voor meerpersoons persoons kamer@@@-{$b_meerpers}";
		$regelEN .= "###Reduction for multi-person room@@@-{$b_meerpers}";
	}

	if ($ins['kamperen']) {
		$cursusgeld -= $kamperen;
		$b_kamperen = bedrag($kamperen);
		$wensenNL .= ", minus korting voor kamperen in de kloostertuin";
		$wensenEN .= ", minus reduction camping in the monastery garden";
		$regelNL .= "###Korting voor kamperen in de kloostertuin@@@-{$b_kamperen}";
		$regelEN .= "###Reduction for camping in the monastery garden@@@-{$b_kamperen}";
	}

	// korting voor tijdig inschrijven:
	if ($ins['tijdig'] <= 0 and $ins['toehoorder'] != 1/*  AND $cursusId != 1 */) {
		$cursusgeld -= ($korting_vroeg);
		$b_korting_vroeg = bedrag($korting_vroeg);
		$wensenNL .= ", minus korting voor tijdige aanmelding";
		$wensenEN .= ", minus reduction for timely registration";
		$regelNL .= "###&nbsp;&nbsp;&nbsp;minus korting voor tijdige aanmelding@@@-{$b_korting_vroeg}";
		$regelEN .= "###&nbsp;&nbsp;&nbsp;minus reduction for timely registration@@@-{$b_korting_vroeg}";
	}

	// korting voor eigen accommodatie:
	if (isset($ins['eigen_acc']) and $ins['eigen_acc']) {
		$cursusgeld -= ($eigen_acc);
		$b_eigen_acc = bedrag($eigen_acc);
		$wensenNL .= ", minus korting voor eigen accommodatie";
		$wensenEN .= ", minus reduction for arranging your own accommodation";
		$regelNL .= "###Korting voor eigen accommodatie@@@{$b_eigen_acc}";
		$regelEN .= "###Reduction for arranging your own accommodation@@@{$b_eigen_acc}";
	}

	// supplement voor maaltijdpas:
	if (isset($ins['diner']) and $ins['diner'] == '1') {
		$cursusgeld += $diner;
		$b_diner = bedrag($diner);
		$wensenNL .= ", plus supplement voor diner bij eigen accommodatie";
		$wensenEN .= ", plus supplement for dinner when having own accommodation";
		$regelNL .= "###Supplement voor diner bij eigen accommodatie@@@{$b_diner}";
		$regelEN .= "###Supplement for dinner when having own accommodation@@@{$b_diner}";
	}

	// korting voor deelname aan meer dan een cursus:
	if ($ins['meerdaneen'] > 0) {
		$cursusgeld -= $korting2;
		$b_korting2 = bedrag($korting2);
		$wensenNL .= ", minus korting voor deelname aan meer dan één cursus";
		$wensenEN .= ", minus reduction for participation in more than one course";
		$regelNL .= "###Korting voor deelname aan meer dan één cursus@@@-{$b_korting2}";
		$regelEN .= "###Reduction for participation in more than one course@@@-{$b_korting2}";
	}

	// extra toegekende korting:
	if (isset($ins['korting']) and $ins['korting'] > 0) {
		if (isset($ins['aangebracht']) and $ins['aangebracht'] != '') {
			$aangebrachtNL = ' wegens ' . $ins['aangebracht'];
			$aangebrachtEN = ' for ' . $ins['aangebracht'];
		}
		$cursusgeld -= ($ins['korting']);
		$b_korting = bedrag($ins['korting']);
		$wensenNL .= ", minus een extra toegekende korting van €&nbsp;{$ins['korting']}{$aangebrachtNL}";
		$wensenEN .= ", minus an additionally granted reduction of EUR&nbsp;{$ins['korting']}{$aangebrachtEN}";
		$regelNL .= "###Extra toegekende korting{$aangebrachtNL}@@@-{$b_korting}";
		$regelEN .= "###Additionally granted reduction{$aangebrachtEN}@@@-{$b_korting}";
	}

	// extra cursusgeld:
	if (isset($ins['extra']) and $ins['extra'] > 0) {
		$cursusgeld += ($ins['extra']);
		$b_extra = bedrag($ins['extra']);
		$wensenNL .= ", plus extra cursusgeld wegens speciale afspraak van €&nbsp;{$ins['extra']}";
		$wensenEN .= ", plus an additional fee for special requirements of EUR&nbsp;{$ins['extra']}";
		$regelNL .= "###Extra cursusgeld wegens speciale afspraak@@@{$b_extra}";
		$regelEN .= "###Additional fee for special requirements@@@{$b_extra}";
	}

	// bedankje donatie:
	if (isset($ins['storting_fonds']) and $ins['storting_fonds'] > 0) {
		if ($ins['donatie'] != "" and $ins['donatie'] > 0) {
			$b_donatie = bedrag($ins['donatie']);
			$regelNL .= "###Donatie aan het kortingsfonds@@@{$b_donatie}";
			$regelEN .= "###Contribution to the reduction fund@@@{$b_donatie}";
			$donNL = euro2($ins['donatie']);
			$donEN = euro_en($ins['donatie']);
			$donatieNL = "Hartelijk dank voor je toegezegde donatie van {$donNL} voor het kortingsfonds.";
			$donatieEN = "Many thanks for your pledged contribution of {$donEN} into the reduction fund.";
		} else {
			$donatieNL = "Hartelijk dank voor je toegezegde donatie voor het kortingsfonds.";
			$donatieEN = "Many thanks for your pledged contribution into the reduction fund.";
		}
	} else {
		$donatieNL = "Mocht je alsnog hiervoor wat willen schenken, dan kan dat door overmaking op onze rekening NL60 BUNQ 2177 4957 25 onder vermelding van 'kortingfonds'.";
		$donatieEN = "If you feel like donating to this fund, please include it in your next payment, mentioning 'reduction fund'.";
	}

	$wensenNL = str_replace('???', "<b>{$cursus[$ins['CursusId']]['NL']}</b>", $wensenNL);
	$wensenEN = str_replace('???', "<b>{$cursus[$ins['CursusId']]['EN']}</b>", $wensenEN);
	$regelNL = str_replace('@@@', "</td><td width=\"10\">€</td><td><div align=\"right\">", $regelNL);
	$regelEN = str_replace('@@@', "</td><td width=\"10\">EUR</td><td><div align=\"right\">", $regelEN);
	$regelNL = str_replace('###', "</div></td></tr>\n<tr><td>", $regelNL);
	$regelEN = str_replace('###', "</div></td></tr>\n<tr><td>", $regelEN);

	$regelNL .= '</div></td></tr>';
	$regelEN .= '</div></td></tr>';

	d($wensenNL, $wensenEN);

	$factuur['cursusgeld'] = $cursusgeld;

	if ($ins['taal'] == 'NL') {
		$factuur['wensen'] = $wensenNL;
		$factuur['donatie'] = $donatieNL;
		$factuur['regels'] = $regelNL;
	} else {
		$factuur['wensen'] = $wensenEN;
		$factuur['donatie'] = $donatieEN;
		$factuur['regels'] = $regelEN;
	}

	return $factuur;
} // function cursusgeld