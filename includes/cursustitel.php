<?php Kint::$enabled_mode = false; ?> <div
	class="<?php echo $filenaam[6] ?> w3-border w3-card-4" id="titel">
	<div id="teksten">
		<div class="cijfer"> <?php echo $cursusdata['nr']; ?> </div>
		<div class="tekst">
			<h3> <?php echo $cursusdata['cursusnaam']; ?> </h3>
			<p> <?php echo $cursusdata['ondertitel']; ?> </p>
		</div>
	</div>
	<div id="cursusplaatje" class="w3-border w3-card-4s">&nbsp;</div> <?php

																		d($filenaam, $opening_inschrijving, date('c'), ($opening_inschrijving >
																			date('c')));

																		$menu = '';

																		if (isset($filenaam[7]) and $filenaam[7] == 'cursus') {
																			if (isset($filenaam[5]) and $filenaam[5] == 'NL') {
																				$menu =	<<<EOD
			<div id="cursusmenu" class="w3-bar">
		<a class="w3-bar-item w3-button w3-mobile" href="#programma"
			target="_self"><span class="{$filenaam[6]}">De muziek</span></a>
EOD;

																				if (isset($filenaam[6]) and $filenaam[6] == 'romantic') $menu .= <<<EOD
		<a class="w3-bar-item w3-button w3-mobile" href="#kennismaking"
			target="_self">
			<span class="{$filenaam[6]}">Kennismakingsrepetitie</span></a> 
	 <a	class="w3-bar-item w3-button w3-mobile" href="#voorwie"
				target="_self"><span class="{$filenaam[6]}">Voor wie</span></a>
				<a class="w3-bar-item w3-button w3-mobile" href="#dagindeling"
					target="_self"><span class="{$filenaam[6]}">Week- en
						dagindeling</span></a>
				<a class="w3-bar-item w3-button w3-mobile" href="#waar"
					target="_self"><span class="{$filenaam[6]}">Waar</span></a>
				<a class="w3-bar-item w3-button w3-mobile" href="#metwie"
					target="_self"><span class="{$filenaam[6]}">Met
						wie</span></a>
</div> 
EOD;
																				else $menu .= <<<EOD
	 <a class="w3-bar-item w3-button w3-mobile"
	href="#voorwie" target="_self"><span class="{$filenaam[6]}">Voor
		wie</span></a>
	<a class="w3-bar-item w3-button w3-mobile" href="#dagindeling"
		target="_self"><span class="{$filenaam[6]}">Week- en
			dagindeling</span></a>
	<a class="w3-bar-item w3-button w3-mobile" href="#waar" target="_self"><span
			class="{$filenaam[6]}">Waar</span></a>
	<a class="w3-bar-item w3-button w3-mobile" href="#metwie"
		target="_self"><span class="{$filenaam[6]}">Met wie</span></a>
	<a class="w3-bar-item w3-button w3-mobile" href="aanmelding.php"
		target="_self"><span class="{$filenaam[6]}">Aanmelding</span></a>
	</div> 
EOD;
																			} else {
																				$menu = <<<EOD
	 <div id="cursusmenu" class="w3-bar w3-border w3-card-4">
		<a class="w3-bar-item w3-button w3-mobile" href="#programma"
			target="_self"><span class="{$filenaam[6]}">The music</span></a>
EOD;

																				if (isset($filenaam[6]) and $filenaam[6] == 'romantic')
																					$menu .= <<<EOD
 <a class="w3-bar-item w3-button w3-mobile" href="#kennismaking"
			target="_self"><span class="{$filenaam[6]}">Introductory
				rehearsal</span></a>' 
				 <a class="w3-bar-item w3-button w3-mobile" href="#voorwie"
				target="_self"><span class="{$filenaam[6]}">For whom</span></a>
				<a class="w3-bar-item w3-button w3-mobile" href="#dagindeling"
					target="_self"><span class="{$filenaam[6]}">Week and day
						programme</span></a>
				<a class="w3-bar-item w3-button w3-mobile" href="#waar"
					target="_self"><span class="{$filenaam[6]}">Where</span></a>
				<a class="w3-bar-item w3-button w3-mobile" href="#metwie"
					target="_self"><span class="{$filenaam[6]}">With
						whom</span></a>
				</div> 
EOD;
																				else
																					$menu .= <<<EOD
	 <a	class="w3-bar-item w3-button w3-mobile" href="#voorwie"
					target="_self"><span class="{$filenaam[6]}">For
						whom</span></a>
					<a class="w3-bar-item w3-button w3-mobile"
						href="#dagindeling" target="_self"><span
							class="{$filenaam[6]}">Week and day
							programme</span></a>
					<a class="w3-bar-item w3-button w3-mobile" href="#waar"
						target="_self"><span
							class="{$filenaam[6]}">Where</span></a>
					<a class="w3-bar-item w3-button w3-mobile" href="#metwie"
						target="_self"><span class="{$filenaam[6]}">With
							whom</span></a>
					<a class="w3-bar-item w3-button w3-mobile"
						href="aanmelding.php" target="_self"><span
							class="{$filenaam[6]}">Registration</span></a>
					</div> 				
EOD;
																			}
																		}
																		$menu .= '</div>';
																		echo $menu; ?>