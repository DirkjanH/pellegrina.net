<?php 
	# PHP ADODB document - made with PHAkt
	# FileName="Connection_php_adodb.htm"
	# Type="ADODB"
	# HTTP="true"
	# DBTYPE="mysql"
	
	$MM_aanvraag_HOSTNAME = 'localhost';
	$MM_aanvraag_DATABASE = 'mysql:LP_info';
	$MM_aanvraag_DBTYPE   = preg_replace('/:.*$/', '', $MM_aanvraag_DATABASE);
	$MM_aanvraag_DATABASE = preg_replace('/^[^:]*?:/', '', $MM_aanvraag_DATABASE);
	$MM_aanvraag_USERNAME = 'pellegri';
	$MM_aanvraag_PASSWORD = '12dirig.';
	$MM_aanvraag_LOCALE = 'En';
	$MM_aanvraag_MSGLOCALE = 'En';
	$MM_aanvraag_CTYPE = 'C';
	$KT_locale = $MM_aanvraag_MSGLOCALE;
	$KT_dlocale = $MM_aanvraag_LOCALE;
	$KT_serverFormat = '%Y-%m-%d %H:%M:%S';
	$QUB_Caching = 'false';

	$KT_localFormat = $KT_serverFormat;
	
	if (!defined('CONN_DIR')) define('CONN_DIR',dirname(__FILE__));
	require_once(CONN_DIR.'/../adodb/adodb.inc.php');
	$aanvraag=&ADONewConnection($MM_aanvraag_DBTYPE);

	if($MM_aanvraag_DBTYPE == 'access' || $MM_aanvraag_DBTYPE == 'odbc'){
		if($MM_aanvraag_CTYPE == 'P'){
			$aanvraag->PConnect($MM_aanvraag_DATABASE, $MM_aanvraag_USERNAME,$MM_aanvraag_PASSWORD);
		} else $aanvraag->Connect($MM_aanvraag_DATABASE, $MM_aanvraag_USERNAME,$MM_aanvraag_PASSWORD);
	} else if (($MM_aanvraag_DBTYPE == 'ibase') or ($MM_aanvraag_DBTYPE == 'firebird')) {
		if($MM_aanvraag_CTYPE == 'P'){
			$aanvraag->PConnect($MM_aanvraag_HOSTNAME.':'.$MM_aanvraag_DATABASE,$MM_aanvraag_USERNAME,$MM_aanvraag_PASSWORD);
		} else $aanvraag->Connect($MM_aanvraag_HOSTNAME.':'.$MM_aanvraag_DATABASE,$MM_aanvraag_USERNAME,$MM_aanvraag_PASSWORD);
	}else {
		if($MM_aanvraag_CTYPE == 'P'){
			$aanvraag->PConnect($MM_aanvraag_HOSTNAME,$MM_aanvraag_USERNAME,$MM_aanvraag_PASSWORD, $MM_aanvraag_DATABASE);
		} else $aanvraag->Connect($MM_aanvraag_HOSTNAME,$MM_aanvraag_USERNAME,$MM_aanvraag_PASSWORD, $MM_aanvraag_DATABASE);
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
$aanvraag->Execute("SET NAMES UTF8;");
?>