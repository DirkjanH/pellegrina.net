<?php
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use function PHP81_BC\strftime;

if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.use_strict_mode', '1');
    session_set_cookie_params([
        'httponly' => true,
        'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'samesite' => 'Lax',
    ]);
    session_start();
}

//Connection statement
require_once dirname(__DIR__) . '/connections/connect_PDO.php';

//Connection statement
require_once dirname(__DIR__) . '/connections/inschrijf.php';

//Functies
require_once __DIR__ . '/functies.php';

//Aditional Functions
require_once __DIR__ . '/functions.inc.php';

//datum & tijd functies
require_once __DIR__ . '/datetime.php';

// zet de localiteit op Nederland
setlocale(LC_ALL, 'nl_NL');
date_default_timezone_set('Europe/Amsterdam');

// constanten:
$aantal_cursussen = 2;
$cursus_offset = 61;
$eerstecursus = $cursus_offset + 1;
$laatstecursus = $cursus_offset + $aantal_cursussen;
$jaar = 2026;
$minimumleeftijd = 10;
$maximumleeftijd = 88;
$opening_inschrijving = date('2025-12-01');

$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$queryString = $_SERVER['QUERY_STRING'] ?? '';
$editFormAction = htmlspecialchars(
    $requestPath . ($queryString !== '' ? '?' . $queryString : ''),
    ENT_QUOTES,
    'UTF-8'
);

function safestrtotime($szFormat, $szDate)
{
    if (!isset($szDate) || $szDate === '')
        $szDate = date("Y-m-d H:i:s");

    if (!is_string($szDate) || !is_string($szFormat)) {
        return -1;
    }

    $szTemp = "00-00-0000";
    $arryMatch = array();
    $arryDate = array();
    if (preg_match(
        '%(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])%',
        $szDate,
        $arryMatch
    )) {
        // Date is in the format of Y-m-d
        $arryTemp = preg_split('%[- /.]%', $arryMatch[0]);
        $arryDate['m'] = $arryTemp[1];
        $arryDate['d'] = $arryTemp[2];
        $arryDate['Y'] = $arryTemp[0];
        //$szTemp = .'-'.$arryTemp[2].'-'.$arryTemp[0];
    } elseif (preg_match(
        '%(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d%',
        $szDate,
        $arryMatch
    )) {
        // Date is in the format of d-m-Y
        $arryTemp = preg_split('%[- /.]%', $arryMatch[0]);
        $arryDate['m'] = $arryTemp[1];
        $arryDate['d'] = $arryTemp[0];
        $arryDate['Y'] = $arryTemp[2];
        //$szTemp = $arryTemp[1].'-'.$arryTemp[2].'-'.$arryTemp[2];
    } elseif (preg_match(
        '%(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d%',
        $szDate,
        $arryMatch
    )) {
        // Date is in the format of m-d-Y
        $arryTemp = preg_split('%[- /.]%', $arryMatch[0]);
        $arryDate['m'] = $arryTemp[0];
        $arryDate['d'] = $arryTemp[1];
        $arryDate['Y'] = $arryTemp[2];
        //$szTemp = $arryTemp[0].'-'.$arryTemp[1].'-'.$arryTemp[2];
    }

    if (
        !isset($arryDate['m'], $arryDate['d'], $arryDate['Y']) ||
        !checkdate($arryDate['m'], $arryDate['d'], $arryDate['Y'])
    ) {
        return -1;
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
function validate($input, $type, $len = null, $chars = null)
{
    $tmp = str_replace(' ', '', $input);
    if (!empty($tmp)) {
        if (isset($len)) {
            if (strlen($input) > $len) {
                return FALSE;
            }
        }
        if (isset($chars)) {
            $input = str_replace($chars, '', $input);
        }
        $input = str_replace(' ', '', $input);

        switch ($type) {
            case 'alpha':
                if (!ctype_alpha($input)) {
                    return FALSE;
                }
                break;

            case 'numeric':
                if (!ctype_digit($input)) {
                    return FALSE;
                }
                break;

            case 'alnum':
                if (!ctype_alnum($input)) {
                    return FALSE;
                }
                break;

            case 'email':
                if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                    return FALSE;
                }
                break;

            case 'url':
                if (!filter_var($input, FILTER_VALIDATE_URL)) {
                    return FALSE;
                }
                break;

            case 'ip':
                if (!filter_var($input, FILTER_VALIDATE_IP)) {
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

function str2num($str)
{
    if (strpos($str, '.') < strpos($str, ',')) {
        $str = str_replace('.', '', $str);
        $str = strtr($str, ',', '.');
    } else {
        $str = str_replace(',', '', $str);
    }
    return (float)$str;
}
