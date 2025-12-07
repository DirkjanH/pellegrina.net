<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

use function PHP81_BC\strftime;

Kint::$enabled_mode = false; //($_SERVER['REMOTE_ADDR'] === '83.87.12.163');

session_start();

//Connection statement
require_once($_SERVER["DOCUMENT_ROOT"] . '/connections/connect_PDO.php');

//Connection statement
require_once($_SERVER["DOCUMENT_ROOT"] . '/connections/inschrijf.php');

//Functies
require_once($_SERVER["DOCUMENT_ROOT"] . '/includes/functies.php');

//Aditional Functions
require_once($_SERVER["DOCUMENT_ROOT"] . '/includes/functions.inc.php');

//datum & tijd functies
require_once($_SERVER["DOCUMENT_ROOT"] . '/includes/datetime.php');

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

// build the form action
$_SERVER['QUERY_STRING'] .= strip_tags('SID');
$editFormAction = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" .
    $_SERVER['QUERY_STRING'] : "");

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
