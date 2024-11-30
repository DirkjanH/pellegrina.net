<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1);
error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2025.php');
?>
<SCRIPT type="text/javascript">
	<!--
	function ZoekLijst(cursus) {
		url = '<?php echo "https://" . $_SERVER['HTTP_HOST'] ?>' + '/part_list.php?cursus=' + cursus;
		if (document.formulier.niet_aangenomen.checked == true) url += '&niet_aangenomen=1';
		if (document.formulier.gepostuleerd.checked == true) url += '&gepostuleerd=1';
		if (document.formulier.gecanceld.checked == true) url += '&gecanceld=1';
		document.getElementById('lijst_frame').src = url;
	}
	-->
</SCRIPT>
<html>

<head>
	<!DOCTYPE html>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Alle deelnemerslijsten 1</title>
	<link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
	<style type="text/css">
		iframe#lijst_frame {
			display: block;
		}
	</style>
</head>

<body>
	<div id="inhoud" class="w3-content" style="width: 100%; max-width: 1200px;">
		<form action="<?php echo $editFormAction; ?>" method="post" name="formulier" id="formulier">
			<div class="w3-panel w3-left"><strong>Lists of participants </strong>including not yet accepted:
				<input <?php if (!(strcmp($_POST['niet_aangenomen'], 1))) {
							echo "checked=\"checked\"";
						} ?> name="niet_aangenomen" type="checkbox" id="niet_aangenomen" value="1">
				including postulated: <input <?php if (!(strcmp($_POST['gepostuleerd'], 1))) {
													echo "checked=\"checked\"";
												} ?> name="gepostuleerd" type="checkbox" id="gepostuleerd" value="1">
				including refused or cancelled: <input <?php if (!(strcmp($_POST['gecanceld'], 1))) {
															echo "checked=\"checked\"";
														} ?> name="gecanceld" type="checkbox" id="gecanceld" value="1">
			</div>
			<?php
			$i = $eerstecursus;
			if (empty($_POST['niet_aangenomen'])) $_POST['niet_aangenomen'] = 0;
			if (empty($_POST['gepostuleerd'])) $_POST['gepostuleerd'] = 0;
			if (empty($_POST['gecanceld'])) $_POST['gecanceld'] = 0;
			while ($i <= $laatstecursus) {
				echo '<div align="center">';
				$c = $i - $cursus_offset;
				echo "<input type=\"button\" class=\"w3-btn w3-left w3-margin-right w3-margin-top w3-ripple w3-green\" value=\"Course {$c}\"";
				echo "onClick=\"ZoekLijst({$c})\"";
				echo "'\">\n</div>\n";
				$i++;
			}
			?>
		</form>
		<div class="w3-panel">
			<iframe id="lijst_frame" src="../part_list.php" style="border:none; width: 100%; height: 3000px;" class="w3-padding-0 w3-margin-top"></iframe>
		</div>
	</div>
</body>

</html>