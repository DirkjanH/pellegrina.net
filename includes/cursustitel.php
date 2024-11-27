<?php Kint::$enabled_mode = false; ?> <div class="<?php echo $filenaam[6] ?>"
    id="titel">
    <div id="teksten">
        <div class="cijfer"> <?php echo $cursusdata['nr']; ?> </div>
        <div class="tekst">
            <h3> <?php echo $cursusdata['cursusnaam']; ?> </h3>
            <p> <?php echo $cursusdata['ondertitel']; ?> </p>
        </div>
    </div>
    <div id="cursusplaatje">&nbsp;</div>
</div> <?php
d($filenaam, $opening_inschrijving, date('c'), ($opening_inschrijving > date('c')));

$menu = '';

if (isset($filenaam[7]) and $filenaam[7] == 'cursus') {
	if (isset($filenaam[5]) and $filenaam[5] == 'NL') {
		$menu = <<<EOD
		   <ul id="cursusmenu" class="w3-bar">
			  <li><a class="w3-bar-item w3-button w3-mobile" href="#programma" target="_self">De muziek</a></li>
EOD;
		if (isset($filenaam[6]) and $filenaam[6] == 'romantic')
			$menu .= '<li><a class="w3-bar-item w3-button w3-mobile" href="#kennismaking" target="_self">Kennismakingsrepetitie</a></li>';
		if ($opening_inschrijving > date('c')) {
			$menu .= <<<EOD
				  <li><a class="w3-bar-item w3-button w3-mobile" href="#voorwie" target="_self">Voor wie</a></li>
				  <li><a class="w3-bar-item w3-button w3-mobile" href="#dagindeling" target="_self">Week- en dagindeling</a></li>
				  <li><a class="w3-bar-item w3-button w3-mobile" href="#waar" target="_self">Waar</a></li>
				  <li><a class="w3-bar-item w3-button w3-mobile" href="#metwie" target="_self">Met wie</a></li>
				</ul>
EOD;
		} else {
			$menu .= <<<EOD
				  <li><a class="w3-bar-item w3-button w3-mobile" href="#voorwie" target="_self">Voor wie</a></li>
				  <li><a class="w3-bar-item w3-button w3-mobile" href="#dagindeling" target="_self">Week- en dagindeling</a></li>
				  <li><a class="w3-bar-item w3-button w3-mobile" href="#waar" target="_self">Waar</a></li>
				  <li><a class="w3-bar-item w3-button w3-mobile" href="#metwie" target="_self">Met wie</a></li>
				  <li><a class="w3-bar-item w3-button w3-mobile" href="aanmelding.php" target="_self">Aanmelding</a></li>
				</ul>
EOD;
		}
	} else {
		$menu = <<<EOD
			<ul id="cursusmenu" class="w3-navbar">
			  <li><a class="w3-bar-item w3-button w3-mobile" href="#programma" target="_self">The music</a></li>
EOD;
		if (isset($filenaam[6]) and $filenaam[6] == 'romantic')
			$menu .= '<li><a class="w3-bar-item w3-button w3-mobile" href="#kennismaking" target="_self">Introductory rehearsal</a></li>';
		if ($opening_inschrijving > date('c')) {
			$menu .= <<<EOD
				  <li><a class="w3-bar-item w3-button w3-mobile" href="#voorwie" target="_self">For whom</a></li>
				  <li><a class="w3-bar-item w3-button w3-mobile" href="#dagindeling" target="_self">Week and day programme</a></li>
				  <li><a class="w3-bar-item w3-button w3-mobile" href="#waar" target="_self">Where</a></li>
				  <li><a class="w3-bar-item w3-button w3-mobile" href="#metwie" target="_self">With whom</a></li>
				</ul>
EOD;
		} else {
			$menu .= <<<EOD
				  <li><a class="w3-bar-item w3-button w3-mobile" href="#voorwie" target="_self">For whom</a></li>
				  <li><a class="w3-bar-item w3-button w3-mobile" href="#dagindeling" target="_self">Week and day programme</a></li>
				  <li><a class="w3-bar-item w3-button w3-mobile" href="#waar" target="_self">Where</a></li>
				  <li><a class="w3-bar-item w3-button w3-mobile" href="#metwie" target="_self">With whom</a></li>
				  <li><a class="w3-bar-item w3-button w3-mobile" href="aanmelding.php" target="_self">Registration</a></li>
				</ul>
EOD;
		}
	}
}
echo $menu;
?>