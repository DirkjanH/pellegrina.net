<?php 
	# PHP ADODB document - made with PHAkt
	# FileName="Connection_php_adodb.htm"
	# Type="ADODB"
	# HTTP="true"
	# DBTYPE="mysql"
	
	$MM_t_inschrijf_HOSTNAME = 'localhost';
	$MM_t_inschrijf_DATABASE = 'mysql:pellegri-9';
	$MM_t_inschrijf_DBTYPE   = preg_replace('/:.*$/', '', $MM_t_inschrijf_DATABASE);
	$MM_t_inschrijf_DATABASE = preg_replace('/^[^:]*?:/', '', $MM_t_inschrijf_DATABASE);
	$MM_t_inschrijf_USERNAME = 'pellegri';
	$MM_t_inschrijf_PASSWORD = 'fbPdiJDk';
	$MM_t_inschrijf_LOCALE = 'En';
	$MM_t_inschrijf_MSGLOCALE = 'En';
	$MM_t_inschrijf_CTYPE = 'C';
	$KT_locale = $MM_t_inschrijf_MSGLOCALE;
	$KT_dlocale = $MM_t_inschrijf_LOCALE;
	$KT_serverFormat = '%Y-%m-%d %H:%M:%S';
	$QUB_Caching = 'false';

	$KT_localFormat = $KT_serverFormat;
	
	if (!defined('CONN_DIR')) define('CONN_DIR',dirname(__FILE__));
	require_once(CONN_DIR.'/../adodb/adodb.inc.php');
	$t_inschrijf=&KTNewConnection($MM_t_inschrijf_DBTYPE);

	if($MM_t_inschrijf_DBTYPE == 'access' || $MM_t_inschrijf_DBTYPE == 'odbc'){
		if($MM_t_inschrijf_CTYPE == 'P'){
			$t_inschrijf->PConnect($MM_t_inschrijf_DATABASE, $MM_t_inschrijf_USERNAME,$MM_t_inschrijf_PASSWORD);
		} else $t_inschrijf->Connect($MM_t_inschrijf_DATABASE, $MM_t_inschrijf_USERNAME,$MM_t_inschrijf_PASSWORD);
	} else if (($MM_t_inschrijf_DBTYPE == 'ibase') or ($MM_t_inschrijf_DBTYPE == 'firebird')) {
		if($MM_t_inschrijf_CTYPE == 'P'){
			$t_inschrijf->PConnect($MM_t_inschrijf_HOSTNAME.':'.$MM_t_inschrijf_DATABASE,$MM_t_inschrijf_USERNAME,$MM_t_inschrijf_PASSWORD);
		} else $t_inschrijf->Connect($MM_t_inschrijf_HOSTNAME.':'.$MM_t_inschrijf_DATABASE,$MM_t_inschrijf_USERNAME,$MM_t_inschrijf_PASSWORD);
	}else {
		if($MM_t_inschrijf_CTYPE == 'P'){
			$t_inschrijf->PConnect($MM_t_inschrijf_HOSTNAME,$MM_t_inschrijf_USERNAME,$MM_t_inschrijf_PASSWORD, $MM_t_inschrijf_DATABASE);
		} else $t_inschrijf->Connect($MM_t_inschrijf_HOSTNAME,$MM_t_inschrijf_USERNAME,$MM_t_inschrijf_PASSWORD, $MM_t_inschrijf_DATABASE);
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
?>