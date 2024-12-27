<?php
// build the form href
$editFormhref = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" . $_SERVER['QUERY_STRING'] : "");
?>
<!DOCTYPE HTML>
<html>

<head>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<style type="text/css">
		a.button {
			appearance: button;
			text-decoration: none;
			color: initial;
			width: 180px;
			text-align: center;
			font-size: small;
			background-color: lightgoldenrodyellow;
		}
	</style>
</head>

<body>
	<form name="form1" method="post" href="<?php echo $editFormhref; ?>">
		<div class="w3-bar">
			<div class="w3-bar-item w3-button w3-mobile w3-hover-yellow"><a class="button" href="LP_statistiek.php">Statistieken</a>
			</div>
			<div class="w3-bar-item w3-button w3-mobile w3-hover-yellow"><a class="button" href="LP_reminder.php">Aanmaning inschr.geld</a>
			</div>
			<div class="w3-bar-item w3-button w3-mobile w3-hover-yellow"><a class="button" href="LP_bezettingen.php">Bezettingen</a>
			</div>
			<div class="w3-bar-item w3-button w3-mobile w3-hover-yellow"><a class="button" href="LP_herhaling.php">Herhaling</a>
			</div>
			<div class="w3-bar-item w3-button w3-mobile w3-hover-yellow"><a class="button" href="LP_wanbetalers.php">Aanm. cursusgeld</a>
			</div>
			<div class="w3-bar-item w3-button w3-mobile w3-hover-yellow"><a class="button" href="LP_zwartelijst.php">Zwarte lijst</a>
			</div>
			<div class="w3-bar-item w3-button w3-mobile w3-hover-yellow"><a class="button" href="LP_persoonlijk.php">Persoonlijk</a>
			</div>
			<div class="w3-bar-item w3-button w3-mobile w3-hover-yellow"><a class="button" href="LP_inschrijving.php">Inschrijving</a>
			</div>
			<div class="w3-bar-item w3-button w3-mobile w3-hover-yellow"><a class="button" href="LP_financieel.php">Voorl. bevestiging</a>
			</div>
			<div class="w3-bar-item w3-button w3-mobile w3-hover-yellow"><a class="button" href="LP_rekening.php">Rekening</a>
			</div>
			<div class="w3-bar-item w3-button w3-mobile w3-hover-yellow"><a class="button" href="LP_betaling.php">Betaling</a>
			</div>
		</div>
	</form>
</body>

</html>