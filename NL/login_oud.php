<?php 
require_once('../includes/includes2014.php');
$password = array("a" => "czech", "b" => "pellegrina");
$username1 = 'classical';
$username2 = 'romantic';
$username3 = 'baroque';
$username4 = 'chamber';
$username5 = 'meridon';


if ($_POST['username'] != '' AND $_POST['password'] != '' AND array_search($_POST['password'], $password)) {
	switch ($_POST['username']) {

		case 1:
			KT_redir('/downloads/course_chamber.php');
			break;
		case 2:
			KT_redir('/downloads/course_baroque.php');
			break;
		case 3:
			KT_redir('/downloads/course_romantic.php');
			break;
		default:
			KT_redir('login_fout.php');
			break;
	}		
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //PHP ADODB document - made with PHAkt 3.7.1?>
<html><!-- InstanceBegin template="/Templates/LP_NL.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>login page</title>
<style type="text/css">
<!--
.inhoud table {
	border-collapse: collapse;
	background-color: #FFFFCC;
	border: medium double #CCCCCC;
}
-->
</style>
<!-- InstanceEndEditable -->
<meta name="Description" content="Overview of La Pellegrina Musical Summer Schools for advanced musical amateurs in the Czech Republic, containing chamber music and orchestra">
<meta name="Keywords" content="La Pellegrina, 415 Hz, Barokmuziek, Cursus, koor, klassiek, muziek, zingen, muziekmaken, Kamermuziek, Kleine ensembles, Koorzang, Mozart Mis, Mozart, , Muziekcursus, Muziekliefhebbers, Muziekvakantie, Purcell, Dioclesian, Solozang, Tsjechië muziek, Vocaal, Vocaal ensemble, Workshop, Zomercursus , Chamber Music , Choir, singing, classical, Course, Baroque, Czech music , Czech Republic, Dvorak, Mahler, music abroad, Music making, Orchestra chamber music, Romantic music, Singers, Solo singing, Students music, Summer school abroad, Amateur, Musik, klassisch, Junggesellen, Kammermusik, Laienmusik, Mahler, Musikliebhaber, Romantische Musik, Sologesang, Sommerkurs, Sommerkurs, Studenten, Tschechien, Tschechische Musik ">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="shortcut icon" href="http://www.pellegrina.net/Images/Logos/favicon.ico" type="image/x-icon" />
<link rel="icon" href="http://www.pellegrina.net/Images/Logos/favicon.ico" type="image/x-icon" />

<script type="text/javascript" src="http://www.pellegrina.net/javascript/cufon-yui.js"></script>
<script src="http://www.pellegrina.net/javascript/LithosPro_400-LithosPro_700.font.js" type="text/javascript"></script>
<script type="text/javascript">

	Cufon.replace('h1');
	Cufon.replace('h2');

</script>
<script src="http://www.pellegrina.net/Scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="http://www.pellegrina.net/Scripts/AC_RunActiveContent.js" type="text/javascript"></script>

<link rel="stylesheet" href="http://www.pellegrina.net/css/pellegrina_stijlen.css" type="text/css">
<link rel="stylesheet" href="http://www.pellegrina.net/css/pagina_stijlen.css" type="text/css">
<link rel="stylesheet" href="http://www.pellegrina.net/css/home.css" type="text/css">
<link rel="stylesheet" href="http://www.pellegrina.net/css/navigatie.css" type="text/css" />
<link rel="stylesheet" href="http://www.pellegrina.net/css/kleuren.css" type="text/css" />

<!-- InstanceBeginEditable name="head" -->

<!-- InstanceEndEditable -->

</head>
<body>
<div id="inhoud">
<div align="center" valign="top" id="top">
  <div align="center"> <a href="../index.php" target="_parent"><img src="../Images/Logos/Pellegrina.gif" alt="La Pellegrina logo" width="600" height="112" border="0" align="top" class="geenlijn" /></a>
    <h5 class="top-tekst"><!-- InstanceBeginEditable name="extra" --><!-- InstanceEndEditable -->muziekprojecten voor iedere muzikant met een professionele instelling</h5>
  </div>
</div>
<div id="navigatie"><!-- InstanceBeginEditable name="nav2" --><!-- InstanceEndEditable -->
    <div id="navcontainer">
      <ul id="navlist">
        <li><a href="index.htm" target="_parent">Cursussen</a></li>
        <li><a href="aanmelding.php" target="_parent">Aanmelding</a></li>
        <li><a href="over_pellegrina.htm" target="_parent">Over <em>La Pellegrina</em></a></li>
        <li><a href="bechyne.htm" target="_parent">Bechyně, de locatie</a></li>
        <li><a href="docenten.htm" target="_parent" >Docenten</a></li>
        <li><a href="praktisch.htm" target="_parent">Praktisch & prijzen</a></li>
        <li><a href="faq.htm" target="_parent">Vaak gestelde vragen</a></li>
        <li><a href="route_plek.htm" target="_parent">Reisinformatie</a></li>
        <li><a href="adres_toevoegen.php" target="_parent">Informatie ontvangen? Geef E-mail op!</a></li>
        <li><a href="vorigeprojecten.htm" target="_parent" >Vorige projecten</a></li>
        <li><a href="contact.htm" target="_parent" >Contact</a></li>
        <li><a href="links.htm" target="_parent" >Links</a></li>
        <li><a href="login.php" target="_parent" >Speciaal voor deelnemers</a></li>
      </ul>
    </div>
<div align="center">
  <table border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
        <td width="10"><a href="../EN/index.htm" target="_parent"><img 
				  src="../Images/Logos/Vlag_UK.jpg" alt="Ga naar de Engelstalige site" 
				  width="34" height="24" border="0" /></a></td>
        <td width="10"><div align="center"><a href="../DE/index.htm" target="_parent"><img 
				  src="../Images/Logos/Vlag_DU.jpg" alt="Ga naar de Duitstalige site" 
				  width="34" height="24" border="0" /></a></div></td>
      </tr>
    </table>
  </div>
</div>
<div id="main"><!-- InstanceBeginEditable name="EditRegion1" -->
<FORM METHOD="POST" ACTION="<?php echo $editFormAction; ?>">
<H2>Login pagina voor cursisten </H2>
<p>&nbsp;</p>
<table align="center" cellpadding="7">
  <tr>
    <td><div align="center">gebruikersnaam:</div></td>
    <td><div align="center">password: </div></td>
  </tr>
  <tr>
    <td><div align="center">
      <input type="TEXT" name="username" size="16">
    </div></td>
    <td><div align="center">
      <input type="PASSWORD" name="password" size="16">
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input name="SUBMIT" type="SUBMIT" value="Verzend">
    </div></td>
    </tr>
  <tr>
    <td colspan="2"><div align="center" class="nadruk">N.B.: Voor de cursus Franse Barok  op het Château de Méridon <a href="../FR/login.php" target="_self">klik hier</a> om in te loggen </div></td>
  </tr>
</table>
<p>&nbsp;</p>
</FORM>
<!-- InstanceEndEditable --></div>
</div>
<script type="text/javascript">Cufon.now();</script>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try{
var pageTracker = _gat._getTracker("UA-10148994-2");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
<!-- InstanceEnd --></html>
