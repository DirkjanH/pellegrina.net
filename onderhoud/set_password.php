<?php
//Connection statement
require_once('../connections/inschrijf.php');

//Aditional Functions
require_once('../includes/functions.inc.php');

//Stel utf8 (uitgebreide character set) in:
mysql_query("SET NAMES UTF8");

// begin Recordset
$query_Recordset1 = "SELECT DlnmrId FROM dlnmr";
$Recordset1 = $t_inschrijf->SelectLimit($query_Recordset1) or die($t_inschrijf->ErrorMsg());
$totalRows_Recordset1 = $Recordset1->RecordCount();

echo $totalRows_Recordset1;
// end Recordset

/////////////////////////////////////////////////////////////////
// Random Password Generator  v1.0 - sebflipper Copyright 2004 //
//                http://www.sebflipper.com                    //
//                                                             //
//     This script is used to create a number of random        //
//            passwords based on the users input               //
/////////////////////////////////////////////////////////////////

/* string generatePassword(int)
 * - generates a random string based on the length passed as an argument
 * - maximum length: 32
 *
 * Usage:  To generate an 8 character random password, use this code:
 *
 *   var $password;
 *   $password = generatePassword(8);
 *   echo $password;
 */

    function generatePassword($plength,$include_letters,$include_capitals,$include_numbers,$include_punctuation)
    {

        // First we need to validate the argument that was given to this function
        // If need be, we will change it to a more appropriate value.
        if(!is_numeric($plength) || $plength <= 0)
        {
            $plength = 8;
        }
        if($plength > 32)
        {
            $plength = 32;
        }

        // This is the array of allowable characters.
                $chars = "";

                if ($include_letters == true) { $chars .= 'abcdefghijklmnopqrstuvwxyz'; }
                if ($include_capitals == true) { $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; }
                if ($include_numbers == true) { $chars .= '0123456789'; }
                if ($include_punctuation == true) { $chars .= '`��$%^&*()-_=+[{]};:@#~,<.>/?'; }

                // If nothing selected just display 0's
                if ($include_letters == false AND $include_capitals == false AND $include_numbers == false AND $include_punctuation == false) {
                    $chars .= '0';
                }

        // This is important:  we need to seed the random number generator
        mt_srand(microtime() * 1000000);

        // Now we simply generate a random string based on the length that was
        // requested in the function argument
        for($i = 0; $i < $plength; $i++)
        {
            $key = mt_rand(0,strlen($chars)-1);
            $pwd = $pwd . $chars{$key};
        }

        // Finally to make it a bit more random, we switch some characters around
        for($i = 0; $i < $plength; $i++)
        {
            $key1 = mt_rand(0,strlen($pwd)-1);
            $key2 = mt_rand(0,strlen($pwd)-1);

            $tmp = $pwd{$key1};
            $pwd{$key1} = $pwd{$key2};
            $pwd{$key2} = $tmp;
        }

        // Convert into HTML
        $pwd = htmlentities($pwd, ENT_QUOTES);

        return $pwd;
    }
?>
<?php //PHP ADODB document - made with PHAkt 3.7.1?>
<html>
<head>
<title>Password-generator</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
</head>
<body>
<p>Hier begint het!</p>
<?php
echo "<pre>";
  while (!$Recordset1->EOF) { 
  $pw = generatePassword(4,true,false,true,false);
  $id = $Recordset1->Fields('DlnmrId');
  $updateSQL = sprintf("UPDATE dlnmr SET password=%s WHERE DlnmrId=%s",
                       GetSQLValueString($pw, "text"),
                       GetSQLValueString($id,"int"));
  $Result1 = $t_inschrijf->Execute($updateSQL) or die($t_inschrijf->ErrorMsg());
  echo "Nummer: {$Recordset1->Fields('DlnmrId')}; password: {$pw}<br>";
  $Recordset1->MoveNext(); 
  }
echo "</pre>";
?>
<p>En nu zou het klaar moeten zijn...</p>
</body>
</html>
<?php
$Recordset1->Close();
?>
