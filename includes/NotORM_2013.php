<?php
// session_start();

//Connection statement
require_once ($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/connections/connect_NotORM.php');

//Aditional Functions
require_once ($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/includes/functions.inc.php');

// zet de localiteit op Nederland
setlocale(LC_ALL, 'nl_NL');
date_default_timezone_set('Europe/Amsterdam');

function euro($bedrag)
{
    return '&euro;&nbsp;' . number_format($bedrag, 0, ',', '.');
}

function euro2($bedrag)
{
    $bedr = '&#8364;&nbsp;' . number_format($bedrag, 2, ',', '.');
    return str_replace(',00', ',&#8212;', $bedr);
}

function euro_en($bedrag)
{
    return 'EUR&nbsp;' . number_format($bedrag, 0, ',', '.');
}

function euro_en2($bedrag)
{
    $bedr = 'EUR&nbsp;' . number_format($bedrag, 2, ',', '.');
    return str_replace(',00', ',&#8212;', $bedr);
}

function czk($bedrag)
{
    return 'CZK&nbsp;' . number_format($bedrag, 0, ',', '.');
}

// constanten:
$aantal_cursussen = 3;
$cursus_offset = 27;
$eerstecursus = $cursus_offset + 1;
$laatstecursus = $cursus_offset + $aantal_cursussen;
$jaar = 2014;
$minimumleeftijd = 10;
$maximumleeftijd = 85;
$opening_inschrijving = date('2012-12-01');

// build the form action
$_SERVER['QUERY_STRING'] .= strip_tags('SID');
$editFormAction = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" .
    $_SERVER['QUERY_STRING'] : "");

function safestrtotime($szFormat, $szDate)
{
    if (!isset($szDate))
        $szDate = date("Y-m-d H:i:s");

    $szTemp = "00-00-0000";
    $arryMatch = array();
    if (preg_match('%(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])%',
        $szDate, $arryMatch))
    {
        // Date is in the format of Y-m-d
        $arryTemp = preg_split('%[- /.]%', $arryMatch[0]);
        $arryDate['m'] = $arryTemp[1];
        $arryDate['d'] = $arryTemp[2];
        $arryDate['Y'] = $arryTemp[0];
        //$szTemp = .'-'.$arryTemp[2].'-'.$arryTemp[0];
    } elseif (preg_match('%(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d%',
    $szDate, $arryMatch))
    {
        // Date is in the format of d-m-Y
        $arryTemp = preg_split('%[- /.]%', $arryMatch[0]);
        $arryDate['m'] = $arryTemp[1];
        $arryDate['d'] = $arryTemp[0];
        $arryDate['Y'] = $arryTemp[2];
        //$szTemp = $arryTemp[1].'-'.$arryTemp[2].'-'.$arryTemp[2];
    } elseif (preg_match('%(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d%',
    $szDate, $arryMatch))
    {
        // Date is in the format of m-d-Y
        $arryTemp = preg_split('%[- /.]%', $arryMatch[0]);
        $arryDate['m'] = $arryTemp[0];
        $arryDate['d'] = $arryTemp[1];
        $arryDate['Y'] = $arryTemp[2];
        //$szTemp = $arryTemp[0].'-'.$arryTemp[1].'-'.$arryTemp[2];
    }

    if (!checkdate($arryDate['m'], $arryDate['d'], $arryDate['Y']))
    {
        return - 1;
    }

    $nJD = gregoriantojd($arryDate['m'], $arryDate['d'], $arryDate['Y']);

    $szTemp = str_replace('Y', $arryDate['Y'], $szFormat);
    $szTemp = str_replace('m', $arryDate['m'], $szTemp);
    $szTemp = str_replace('d', $arryDate['d'], $szTemp);
    $szTemp = str_replace('D', jddayofweek($nJD, 2), $szTemp);
    $szTemp = str_replace('F', jdmonthname($nJD, 1), $szTemp);

    //echo $szTemp;
    return $szTemp;
}

// validate user input
// $input: variable to be validated
// $type: nofilter, alpha, numeric, alnum, email, url, ip
// $len: maximum length
// $chars: array of any non alpha-numeric characters to allow
function validate($input, $type, $len = null, $chars = null) {
    $tmp = str_replace(' ', '', $input);
    if(!empty($tmp)) {
        if(isset($len)) {
            if(strlen($input) > $len) {
                return FALSE;
            }
        }
        if(isset($chars)) {
            $input = str_replace($chars, '', $input);
        }
        $input = str_replace(' ', '', $input);

        switch($type) {
            case 'alpha':
                if(!ctype_alpha($input)) {
                    return FALSE;
                }
            break;

            case 'numeric':
                if(!ctype_digit($input)) {
                    return FALSE;
                }
            break;

            case 'alnum':
                if(!ctype_alnum($input)) {
                    return FALSE;
                }
            break;

            case 'email':
                if(!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                    return FALSE;
                }
            break;

            case 'url':
                if(!filter_var($input, FILTER_VALIDATE_URL)) {
                    return FALSE;
                }
            break;

            case 'ip':
                if(!filter_var($input, FILTER_VALIDATE_IP)) {
                    return FALSE;
                }
            break;

            case 'nofilter':
                return TRUE;
            break;
        }
        return TRUE;
    } else {
        return FALSE;
    }
}

function str2num($str){ 
  if(strpos($str, '.') < strpos($str,',')){ 
            $str = str_replace('.','',$str); 
            $str = strtr($str,',','.');            
        } 
        else{ 
            $str = str_replace(',','',$str);            
        } 
        return (float)$str; 
} 
?>