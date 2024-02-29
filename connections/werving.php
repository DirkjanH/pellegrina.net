<?php 
	# PHP ADODB document - made with PHAkt
	# FileName="Connection_php_adodb.htm"
	# Type="ADODB"
	# HTTP="true"
	# DBTYPE="mysql"
	
	$MM_werving_HOSTNAME = 'localhost';
	$MM_werving_DATABASE = 'mysql:LP_info';
	$MM_werving_DBTYPE   = preg_replace('/:.*$/', '', $MM_werving_DATABASE);
	$MM_werving_DATABASE = preg_replace('/^[^:]*?:/', '', $MM_werving_DATABASE);
	$MM_werving_USERNAME = 'pellegri';
	$MM_werving_PASSWORD = '12dirig.';
	$MM_werving_LOCALE = 'En';
	$MM_werving_MSGLOCALE = 'En';
	$MM_werving_CTYPE = 'C';
	$KT_locale = $MM_werving_MSGLOCALE;
	$KT_dlocale = $MM_werving_LOCALE;
	$KT_serverFormat = '%Y-%m-%d %H:%M:%S';
	$QUB_Caching = 'false';

	$KT_localFormat = $KT_serverFormat;
	
	if (!defined('CONN_DIR')) define('CONN_DIR',dirname(__FILE__));
	require_once(CONN_DIR.'/../adodb/adodb.inc.php');
	$werving=&KTNewConnection($MM_werving_DBTYPE);

	if($MM_werving_DBTYPE == 'access' || $MM_werving_DBTYPE == 'odbc'){
		if($MM_werving_CTYPE == 'P'){
			$werving->PConnect($MM_werving_DATABASE, $MM_werving_USERNAME,$MM_werving_PASSWORD);
		} else $werving->Connect($MM_werving_DATABASE, $MM_werving_USERNAME,$MM_werving_PASSWORD);
	} else if (($MM_werving_DBTYPE == 'ibase') or ($MM_werving_DBTYPE == 'firebird')) {
		if($MM_werving_CTYPE == 'P'){
			$werving->PConnect($MM_werving_HOSTNAME.':'.$MM_werving_DATABASE,$MM_werving_USERNAME,$MM_werving_PASSWORD);
		} else $werving->Connect($MM_werving_HOSTNAME.':'.$MM_werving_DATABASE,$MM_werving_USERNAME,$MM_werving_PASSWORD);
	}else {
		if($MM_werving_CTYPE == 'P'){
			$werving->PConnect($MM_werving_HOSTNAME,$MM_werving_USERNAME,$MM_werving_PASSWORD, $MM_werving_DATABASE);
		} else $werving->Connect($MM_werving_HOSTNAME,$MM_werving_USERNAME,$MM_werving_PASSWORD, $MM_werving_DATABASE);
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
$werving->Execute("SET NAMES UTF8;");
?>