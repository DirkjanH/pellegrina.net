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
	<div id="cursusmenu" class="w3-bar w3-border w3-card-4 {$filenaam[6]}">
	<a class="w3-bar-item w3-button w3-mobile" href="#programma" target="_self">De
    muziek</a> EOD; if (isset($filenaam[6]) and $filenaam[6] == 'romantic')
	$menu .= '<a class="w3-bar-item w3-button w3-mobile" href="#kennismaking"
    target="_self">Kennismakingsrepetitie</a>
EOD;

	if ($opening_inschrijving > date('c')) { $menu .= <<<EOD
	<a class="w3-bar-item w3-button w3-mobile"
    href="#voorwie" target="_self">Voor wie</a>
    <a class="w3-bar-item w3-button w3-mobile" href="#dagindeling"
        target="_self">Week- en dagindeling</a>
    <a class="w3-bar-item w3-button w3-mobile" href="#waar"
        target="_self">Waar</a>
    <a class="w3-bar-item w3-button w3-mobile" href="#metwie" target="_self">Met
        wie</a>
    </div> 
EOD;
			} else {
				$menu .= <<<EOD
	<a class="w3-bar-item w3-button w3-mobile" href="#voorwie" 
		target="_self">Voor wie</a>
	<a class="w3-bar-item w3-button w3-mobile" href="#dagindeling"
		target="_self">Week- en dagindeling</a>
	<a class="w3-bar-item w3-button w3-mobile" href="#waar"
		target="_self">Waar</a>
	<a class="w3-bar-item w3-button w3-mobile" href="#metwie"
		target="_self">Met wie</a>
	<a class="w3-bar-item w3-button w3-mobile" href="aanmelding.php"
		target="_self">Aanmelding</a>
	</div> 
EOD;
			}
		} else {
			$menu = <<<EOD
	<div id="cursusmenu" class="w3-bar w3-border w3-card-4 {$filenaam[6]}">
	<a class="w3-bar-item w3-button w3-mobile" href="#programma"
	target="_self">The music</a> 
EOD;

			if (isset($filenaam[6]) and $filenaam[6] == 'romantic') $menu .= '<a
	class="w3-bar-item w3-button w3-mobile" href="#kennismaking"
	target="_self">Introductory rehearsal</a>';
			if ($opening_inschrijving > date('c')) {
				$menu .= <<<EOD
	<a class="w3-bar-item w3-button w3-mobile" href="#voorwie"
	target="_self">For whom</a>
	<a class="w3-bar-item w3-button w3-mobile" href="#dagindeling"
		target="_self">Week and day programme</a>
	<a class="w3-bar-item w3-button w3-mobile" href="#waar"
		target="_self">Where</a>
	<a class="w3-bar-item w3-button w3-mobile" href="#metwie"
		target="_self">With whom</a>
	</div> 
EOD;
			} else {
				$menu .= <<<EOD
	<a class="w3-bar-item w3-button w3-mobile" href="#voorwie"
	target="_self">For whom</a>
	<a class="w3-bar-item w3-button w3-mobile"
		href="#dagindeling" target="_self">Week and day
		programme</a>
	<a class="w3-bar-item w3-button w3-mobile" href="#waar"
		target="_self">Where</a>
	<a class="w3-bar-item w3-button w3-mobile" href="#metwie"
		target="_self">With whom</a>
	<a class="w3-bar-item w3-button w3-mobile"
		href="aanmelding.php" target="_self">Registration</a>
	</div> 
EOD;
			}
		}
		echo $menu; ?>