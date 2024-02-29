<?php 
	# PHP ADODB document - made with PHAkt
	# FileName="Connection_php_adodb.htm"
	# Type="ADODB"
	# HTTP="true"
	# DBTYPE="mysql"
	
	$MM_evaluatie_HOSTNAME = 'localhost';
	$MM_evaluatie_DATABASE = 'mysql:LP_evaluatie';
	$MM_evaluatie_DBTYPE   = preg_replace('/:.*$/', '', $MM_evaluatie_DATABASE);
	$MM_evaluatie_DATABASE = preg_replace('/^[^:]*?:/', '', $MM_evaluatie_DATABASE);
	$MM_evaluatie_USERNAME = 'evaluatie';
	$MM_evaluatie_PASSWORD = '12dirig.';
	$MM_evaluatie_LOCALE = 'En';
	$MM_evaluatie_MSGLOCALE = 'En';
	$MM_evaluatie_CTYPE = 'C';
	$KT_locale = $MM_evaluatie_MSGLOCALE;
	$KT_dlocale = $MM_evaluatie_LOCALE;
	$KT_serverFormat = '%Y-%m-%d %H:%M:%S';
	$QUB_Caching = 'false';

	$KT_localFormat = $KT_serverFormat;
	
	if (!defined('CONN_DIR')) define('CONN_DIR',dirname(__FILE__));
	require_once(CONN_DIR.'/../adodb/adodb.inc.php');
	$evaluatie=&KTNewConnection($MM_evaluatie_DBTYPE);

	if($MM_evaluatie_DBTYPE == 'access' || $MM_evaluatie_DBTYPE == 'odbc'){
		if($MM_evaluatie_CTYPE == 'P'){
			$evaluatie->PConnect($MM_evaluatie_DATABASE, $MM_evaluatie_USERNAME,$MM_evaluatie_PASSWORD);
		} else $evaluatie->Connect($MM_evaluatie_DATABASE, $MM_evaluatie_USERNAME,$MM_evaluatie_PASSWORD);
	} else if (($MM_evaluatie_DBTYPE == 'ibase') or ($MM_evaluatie_DBTYPE == 'firebird')) {
		if($MM_evaluatie_CTYPE == 'P'){
			$evaluatie->PConnect($MM_evaluatie_HOSTNAME.':'.$MM_evaluatie_DATABASE,$MM_evaluatie_USERNAME,$MM_evaluatie_PASSWORD);
		} else $evaluatie->Connect($MM_evaluatie_HOSTNAME.':'.$MM_evaluatie_DATABASE,$MM_evaluatie_USERNAME,$MM_evaluatie_PASSWORD);
	}else {
		if($MM_evaluatie_CTYPE == 'P'){
			$evaluatie->PConnect($MM_evaluatie_HOSTNAME,$MM_evaluatie_USERNAME,$MM_evaluatie_PASSWORD, $MM_evaluatie_DATABASE);
		} else $evaluatie->Connect($MM_evaluatie_HOSTNAME,$MM_evaluatie_USERNAME,$MM_evaluatie_PASSWORD, $MM_evaluatie_DATABASE);
   }

	if (!function_exists('updateMagicQuotes')) {
		function updateMagicQuotes($HTTP_VARS){
			if (is_array($HTTP_VARS)) {
				foreach ($HTTP_VARS as $name=>$value) {
					if (!is_array($value)) {
						$HTTP_VARS[$name] = addslashes($value);
					} else {
						foreach ($value as $name1=>$value1) {
							if (!is_array($value1)) {
								$HTTP_VARS[$name1][$value1] = addslashes($value1);
							}
						}
					}
				}
			}
			return $HTTP_VARS;
		}
		
		if (!get_magic_quotes_gpc()) {
			$_GET = updateMagicQuotes($_GET);
			$_POST = updateMagicQuotes($_POST);
			$_COOKIE = updateMagicQuotes($_COOKIE);
		}
	}
	if (!isset($_SERVER['REQUEST_URI']) && isset($_ENV['REQUEST_URI'])) {
		$_SERVER['REQUEST_URI'] = $_ENV['REQUEST_URI'];
	}
	if (!isset($_SERVER['REQUEST_URI'])) {
		$_SERVER['REQUEST_URI'] = $_SERVER['PHP_SELF'].(isset($_SERVER['QUERY_STRING'])?"?".$_SERVER['QUERY_STRING']:"");
	}

/* Stel de character set in */
$evaluatie->Execute("SET NAMES UTF8;");
?>