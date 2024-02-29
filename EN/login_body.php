<!doctype html>
<html><!-- InstanceBegin template="/Templates/leeg_EN.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">

   <!-- CSS: -->
   <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">

<!-- InstanceBeginEditable name="doctitle" -->
<title>Naamloos document</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<!-- InstanceBeginEditable name="mainpage" -->
<FORM METHOD="POST" ACTION="<?php echo "/login_pagina.php"; ?>">
<H2>Login page for course participants </H2>
<p>&nbsp;</p>
<table align="center" cellpadding="7">
  <tr>
    <td><div align="center">username:</div></td>
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
      <input name="SUBMIT" type="SUBMIT" value="Send">
    </div></td>
    </tr>
</table>
<input name="taal" type="hidden" value="<?php echo $taal; ?>">
<input name="cursusnaam" type="hidden" value="<?php echo $cursusnaam; ?>">
</FORM>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
