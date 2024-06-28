<?php // begin Recordset cursusgegevens

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
	$kamperen      		= $cursus[$ins['CursusId']]['kamperen'];
	$eigen_acc     		= $cursus[$ins['CursusId']]['korting_eigen_acc'];
	$korting_vroeg 		= $cursus[$ins['CursusId']]['korting_vroeg'];
	$diner		 		= $cursus[$ins['CursusId']]['diner'];
	$ACMP 				= 0;
	$korting2      		= 50; // korting PER CURSUS
	$paypal		   		= 15; // meerprijs PayPal

	$actiedatum = $cursus[$ins['CursusId']]['datum_korting'];

	d($ins);
	d($cursus, $cursusId, $cursus_offset);

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
		$wensenNL .= "deelname als toehoorder aan cursus ???";
		$wensenEN .= "participation as auditor in course ???";
		$regelNL .= "Deelname als toehoorder@@@{$toehoorder}";
		$regelEN .= "Participation as auditor@@@{$toehoorder}";
	} elseif ($ins['student'] or ((int)$ins['leeftijd'] < $jeugd_grens))
		if ($ins['oost']) {
			$cursusgeld = $ooststud;
			$wensenNL .= "deelname als Oost-Europese student/jongere aan cursus ???";
			$wensenEN .= "participation as Eastern European student/young participant in course ???";
			$regelNL .= "Deelname als Oost-Europese student@@@{$ooststud}";
			$regelEN .= "Participation as Eastern European student@@@{$ooststud}";
		} else {
			$cursusgeld = $student;
			$wensenNL .= "deelname als student/jongere aan cursus ???";
			$wensenEN .= "participation as student/young participant in course ???";
			$regelNL .= "Deelname als student@@@{$student}";
			$regelEN .= "Participation as student@@@{$student}";
		}
	else
		if ($ins['oost']) {
		$cursusgeld = $oost;
		$wensenNL .= "deelname als Oost-Europese deelnemer aan cursus ???";
		$wensenEN .= "participation as Eastern European participant in course ???";
		$regelNL .= "deelname als Oost-Europese deelnemer@@@{$oost}";
		$regelEN .= "participation as Eastern European participant@@@{$oost}";
	} else {
		$cursusgeld = $cursusprijs;
		$wensenNL .= "deelname aan cursus ???";
		$wensenEN .= "participation in course ???";
		$regelNL .= "Deelname aan de cursus@@@{$cursusprijs}";
		$regelEN .= "Participation summer school@@@{$cursusprijs}";
	}

	if ($ins['eenpersoons']) {
		$cursusgeld += $eenpers;
		$wensenNL .= ", plus supplement voor eenpersoons kamer";
		$wensenEN .= ", plus supplement for a single room";
		$regelNL .= "###Supplement voor eenpersoons kamer@@@{$eenpers}";
		$regelEN .= "###Supplement for single room@@@{$eenpers}";
	}

	if ($ins['meerpers']) {
		$cursusgeld += $meerpers;
		$wensenNL .= ", minus korting voor meerpersoons kamer";
		$wensenEN .= ", minus reduction for multi-person room";
		$regelNL .= "###Korting voor meerpersoons persoons kamer@@@-{$meerpers}";
		$regelEN .= "###Reduction for multi-person room@@@-{$meerpers}";
	}

	if ($ins['kamperen']) {
		$cursusgeld -= $kamperen;
		$wensenNL .= ", minus korting voor kamperen in de kloostertuin";
		$wensenEN .= ", minus reduction camping in the monastery garden";
		$regelNL .= "###Korting voor kamperen in de kloostertuin@@@- {$kamperen}";
		$regelEN .= "###Reduction for camping in the monastery garden@@@- {$kamperen}";
	}

	// supplement voor betaling met PayPal:
	if (isset($ins['PayPal']) and $ins['PayPal'] == '1') {
		$cursusgeld += $paypal;
		$wensenNL .= ", plus supplement voor betaling via PayPal";
		$wensenEN .= ", plus supplement for payment with PayPal";
		$regelNL .= "###Supplement voor betaling via PayPal@@@{$paypal}";
		$regelEN .= "###Supplement for payment with PayPal@@@{$paypal}";
	}

	// korting voor tijdig inschrijven:
	if ($ins['tijdig'] <= 0 and $ins['toehoorder'] != 1/*  AND $cursusId != 1 */) {
		$cursusgeld -= ($korting_vroeg);
		$wensenNL .= ", minus korting voor tijdige aanmelding";
		$wensenEN .= ", minus reduction for timely registration";
		$regelNL .= "###&nbsp;&nbsp;&nbsp;minus korting voor tijdige aanmelding@@@-{$korting_vroeg}";
		$regelEN .= "###&nbsp;&nbsp;&nbsp;minus reduction for timely registration@@@-{$korting_vroeg}";
	}

	// korting voor eigen accommodatie:
	if (isset($ins['eigen_acc']) and $ins['eigen_acc']) {
		$cursusgeld -= ($eigen_acc);
		$wensenNL .= ", minus korting voor eigen accommodatie";
		$wensenEN .= ", minus reduction for arranging your own accommodation";
		$regelNL .= "###Korting voor eigen accommodatie@@@{$eigen_acc}";
		$regelEN .= "###Reduction for arranging your own accommodation@@@{$eigen_acc}";
	}

	// supplement voor maaltijdpas:
	if (isset($ins['diner']) and $ins['diner'] == '1') {
		$cursusgeld += $diner;
		$wensenNL .= ", plus supplement voor diner bij eigen accommodatie";
		$wensenEN .= ", plus supplement for dinner when having own accommodation";
		$regelNL .= "###Supplement voor diner bij eigen accommodatie@@@{$diner}";
		$regelEN .= "###Supplement for dinner when having own accommodation@@@{$diner}";
	}

	// korting voor deelname aan meer dan een cursus:
	if ($ins['meerdaneen'] > 0) {
		$cursusgeld -= $korting2;
		$wensenNL .= ", minus korting voor deelname aan meer dan één cursus";
		$wensenEN .= ", minus reduction for participation in more than one course";
		$regelNL .= "###Korting voor deelname aan meer dan één cursus@@@-{$korting2}";
		$regelEN .= "###Reduction for participation in more than one course@@@-{$korting2}";
	}

	// extra toegekende korting:
	if (isset($ins['korting']) and $ins['korting'] > 0) {
		if (isset($ins['aangebracht']) and $ins['aangebracht'] != '') {
			$aangebrachtNL = ' wegens ' . $ins['aangebracht'];
			$aangebrachtEN = ' for ' . $ins['aangebracht'];
		}
		$cursusgeld -= ($ins['korting']);
		$wensenNL .= ", minus een extra toegekende korting van €&nbsp;{$ins['korting']}{$aangebrachtNL}";
		$wensenEN .= ", minus an additionally granted reduction of EUR&nbsp;{$ins['korting']}{$aangebrachtEN}";
		$regelNL .= "###Extra toegekende korting{$aangebrachtNL}@@@-{$ins['korting']}";
		$regelEN .= "###Additionally granted reduction{$aangebrachtEN}@@@-{$ins['korting']}";
	}

	// extra cursusgeld:
	if (isset($ins['extra']) and $ins['extra'] > 0) {
		$cursusgeld += ($ins['extra']);
		$wensenNL .= ", plus extra cursusgeld wegens speciale afspraak van €&nbsp;{$ins['extra']}";
		$wensenEN .= ", plus an additional fee for special requirements of EUR&nbsp;{$ins['extra']}";
		$regelNL .= "###Extra cursusgeld wegens speciale afspraak@@@{$ins['extra']}";
		$regelEN .= "###Additional fee for special requirements@@@{$ins['extra']}";
	}

	// bedankje donatie:
	if (isset($ins['storting_fonds']) and $ins['storting_fonds'] > 0) {
		if ($ins['donatie'] != "" and $ins['donatie'] > 0) {
			$ins['donatie'] = bedrag($ins['donatie']);
			$regelNL .= "###Donatie aan het kortingsfonds@@@{$ins['donatie']}";
			$regelEN .= "###Contribution to the reduction fund@@@{$ins['donatie']}";
			$donNL = euro2($ins['donatie']);
			$donEN = euro_en($ins['donatie']);
			$donatieNL = "Hartelijk dank voor je toegezegde donatie van {$donNL} voor het kortingsfonds.";
			$donatieEN = "Many thanks for your pledged contribution of {$donEN} into the reduction fund.";
		} else {
			$donatieNL = "Hartelijk dank voor je toegezegde donatie voor het kortingsfonds.";
			$donatieEN = "Many thanks for your pledged contribution into the reduction fund.";
		}
	} else {
		$donatieNL = "Mocht je alsnog hiervoor wat willen schenken, dan kan dat door overmaking op onze rekening NL33 ASNB 0707 2500 72 onder vermelding van 'kortingfonds'.";
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
