<?php 
$naamfile = fopen ("naam.txt", "r");
if (!$naamfile) {
    echo "<p>Unable to open remote naamfile.\n";
    exit;
}
$emailfile = fopen ("email.txt", "r");
if (!$emailfile) {
    echo "<p>Unable to open remote emailfile.\n";
    exit;
}
$i = 1;
while (!(feof ($naamfile) OR feof ($emailfile))) {
    $adressen[$i]['naam'] = fgets ($naamfile, 1024);
    $adressen[$i]['email'] = fgets ($emailfile, 1024);
	$i++;
}
fclose($naamfile);
fclose($emailfile);

foreach ($adressen as $a) {
	$lijst .= "\"{$a['email']}\";\"{$a['naam']}\";\"XXX\"\n";
}

$outfile = "bestand.txt";

// Let's make sure the file exists and is writable first.
if (1) {

    // In our example we're opening $outfile in append mode.
    // The file pointer is at the bottom of the file hence
    // that's where $somecontent will go when we fwrite() it.
    if (!$handle = fopen($outfile, 'w')) {
         echo "Cannot open file ($outfile)";
         exit;
    }

    // Write $somecontent to our opened file.
    if (fwrite($handle, $lijst) === FALSE) {
        echo "Cannot write to file ($outfile)";
        exit;
    }

    echo "Success, wrote ($somecontent) to file ($outfile)";

    fclose($handle);

} else {
    echo "The file $outfile is not writable";
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>