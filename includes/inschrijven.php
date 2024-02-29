<?php
$inschrijfgeld = euro( $cursusdata[ 'inschrijfgeld' ] );
$inschrijfgeld_EN = euro_en( $cursusdata[ 'inschrijfgeld' ] );

if ( isset( $filenaam[ 7 ] )AND $filenaam[ 7 ] == 'cursus' ) {
	if ( isset( $filenaam[ 5 ] )AND $filenaam[ 5 ] == 'NL' ) {
		if ( $opening_inschrijving > date( 'c' ) ) {
			$inschrijven = <<<EOD
         <p>Zodra de inschrijving geopend is, dus vanaf 1 december, kun je je inschrijven middels het formulier en betaal je het inschrijfgeld van $inschrijfgeld (dat natuurlijk wordt terugbetaald, mocht je niet geplaatst kunnen worden).</p>
EOD;
		} else {
			$inschrijven = <<<EOD
         <p>Om je in te schrijven vul je <a href="aanmelding.php">dit
         formulier</a> in<span class="onzichtbaar"> en betaal je het inschrijfgeld van $inschrijfgeld (dat natuurlijk wordt terugbetaald, mocht je niet geplaatst kunnen worden)</span>.</p>
EOD;
		}
	} else {
		if ( $opening_inschrijving > date( 'c' ) ) {
			$inschrijven = <<<EOD
         <p>As soon as the registration is open, so from December 1, you can register by using the registration form and paying the deposit of $inschrijfgeld_EN (which of course will be refunded in case you cannot be placed).</p>
EOD;
		} else {
			$inschrijven = <<<EOD
         <p>In order to register, please fill out <a href="aanmelding.php">this form</a><span class="onzichtbaar"> and pay a deposit of $inschrijfgeld_EN (which of course will be refunded in case you cannot be placed)</span>.</p>
EOD;
		}
	}
}
echo $inschrijven;
?>