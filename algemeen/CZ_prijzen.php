<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/cursussen.php'; 

$i = $eerstecursus; ?>

<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/LP algemeen CZ.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">

   <!-- CSS: -->
   <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
   <link rel="stylesheet" href="/css/pagina_stijlen.css" type="text/css">

<!-- InstanceBeginEditable name="doctitle" -->
<title>České ceny</title>
<!-- InstanceEndEditable -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.EN.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>
<link href="/css/pagina_stijlen_algemeen.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_tagmanager.php'; ?>
<div id="inhoud">
  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/header.EN.php'; ?>
  <div id="main"> <!-- InstanceBeginEditable name="mainpage" -->
  <h2>České ceny</h2>
  <p> Českým a&nbsp;slovenským účastníkům kursů pořádaných agenturou <i>La
    Pellegrina</i> nabízíme zvýhodněné podmínky, mimo jiné i&nbsp;snížené ceny:</p>
  <table border="1" cellpadding="5">
    <tr valign="TOP">
      <th><b>Kurs:</b></th>
      <th align="RIGHT"><b>Cena:</b></th>
      <th align="RIGHT"><b>Studentsk&aacute; cena:</b></th>
    </tr>
    <tr valign="TOP">
    	<td>1. REICHOVO REQUIEM<span class="titel"> pro orchestr, sbor a sólisty</span></td>
    	<td><?php echo czk($cursussen[$i]['prijs_cr']); ?> / <?php echo czk($cursussen[$i]['prijs_cr'] - $cursussen[$i]['korting_vroeg_cr']); ?> <span class="nadruk">*)</span></td>
    	<td><?php echo czk($cursussen[$i]['prijs_cr_student']); ?> / <?php echo czk($cursussen[$i]['prijs_cr_student'] - $cursussen[$i]['korting_vroeg_cr']); ?> <span class="nadruk">*)</span></td>
    	<?php $i = $eerstecursus + 0; ?>
    	</tr>
	  <tr valign="TOP">
    	<td>2. <span class="titel">BAROKO v 415 Hz: Vivaldiho Benátské nešpory</span></td>
    	<td><?php echo czk($cursussen[$i+1]['prijs_cr']); ?> / <?php echo czk($cursussen[$i+1]['prijs_cr'] - $cursussen[$i+1]['korting_vroeg_cr']); ?> <span class="nadruk">*)</span></td>
    	<td><?php echo czk($cursussen[$i+1]['prijs_cr_student']); ?> / <?php echo czk($cursussen[$i+1]['prijs_cr_student'] - $cursussen[$i+1]['korting_vroeg_cr']); ?> <span class="nadruk">*)</span></td>
    	<?php $i = $eerstecursus + 0; ?>
    	</tr>
    </table>
  <p><span class="nadruk">*) Nižší cena platí v případě přihlášení <strong>před 1. březnem. </strong>Prosím, přihlaste se včas!!! </span></p>
  <p>Počet účastníků, kterým je možné poskytnout snížené ceny kurzovného, je
    omezen a&nbsp;závisí na množství finančních prostředků ve fondu, z&nbsp;něhož jsou
    slevy dotovány. <i>La Pellegrina</i> má právo rozhodovat o&nbsp;tom, komu bude sleva
    přidělena, aniž by byla povinna své rozhodnutí zdůvodňovat.</p>
  <p>Studenti a <strong>všichni ve věku do 36 let </strong>mohou žádat o&nbsp;studentskou slevu.
    Musí však ke své přihlášce přiložit kopii potvrzení o&nbsp;studiu na universitě
    či jiné instituci poskytující
    vyšší vzdělání. Počet účastníků, kterým může být sleva přiznána, je limitován.
    V&nbsp;ceně je započ&iacute;t&aacute;no ubytov&aacute;n&iacute; v&nbsp;dvoj- nebo
    trojlů&#158;kov&yacute;ch pokoj&iacute;ch a&nbsp;strava.</p>
  <h2>Přihláška</h2>
  <p>Přihlášku odešlete prostřednictvím elektronického formuláře. Zároveň je třeba uhradit polovinu celkové
    ceny kursu jako zápisné na účet 538940301/0100 u&nbsp;Komerční Banky.
    Druhá polovina musí být zaplacena nejpozději do 15. června. Jako variabilní
    symbol uveďte datum svého narození ve formátu rok-měsíc-den. Při platbě
    na účet prostřednictvím poštovní poukázky či složením hotovosti přímo v
    bance je nutné zaslat fotokopii dokladu o&nbsp;zaplacení poštou.</p>
  <p> Je nutn&eacute;, aby z&aacute;jemci o&nbsp;&uacute;čast připsali něco o
    sv&yacute;ch
    hudebn&iacute;ch zku&#154;enostech a&nbsp;schopnostech, zda a&nbsp;u&nbsp;koho se
    uč&iacute; atd.
    Lze ps&aacute;t jak&yacute;mkoli jazykem, včetně če&#154;tiny.</p>
  <!-- InstanceEndEditable -->
    <h2> <a href="javascript: history.go(-1)">Zpět</a></h2>
    <p>&nbsp;</p>
  </div>
</div>

<a title="Web Analytics" href="http://clicky.com/101101981"><img alt="Web Analytics" src="//static.getclicky.com/media/links/badge.gif" border="0" /></a>
<script src="//static.getclicky.com/js" type="text/javascript"></script>
<script type="text/javascript">try{ clicky.init(101101981); }catch(e){}</script>
<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/101101981ns.gif" /></p></noscript>

</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
<!-- InstanceEnd --></html>
