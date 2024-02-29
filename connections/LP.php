<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_LP = "localhost";
$database_LP = "lp_inschrijving";
$username_LP = "LP";
$password_LP = "12dirig.";
$LP = mysql_pconnect($hostname_LP, $username_LP, $password_LP) or trigger_error(mysql_error(),E_USER_ERROR); 
?>