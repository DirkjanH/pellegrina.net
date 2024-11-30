<?php // stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);

error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2025.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php');

Kint::$enabled_mode = false;
d($_POST, $_GET);

$id1 = $_POST['id1'];
$id2 = $_POST['id2'];

if (isset($_POST['submit']) and $_POST['submit'] === 'Zoek op') {

	if (isset($id1) and $id1 != '') {
		$query = "SELECT * FROM dlnmr, adres WHERE AdresId = AdresId_FK AND DlnmrId = {$id1}";
		d($query);
		$deelnemer = select_query($query, 1);
	}
	if (isset($id2) and $id2 != '') {
		$query = "SELECT * FROM dlnmr, adres WHERE AdresId = AdresId_FK AND DlnmrId = {$id2}";
		d($query);
		$deelnemer2 = select_query($query, 1);
	}
}
if (isset($_POST['submit']) and $_POST['submit'] === 'Delete') {

	$query = "DELETE FROM dlnmr WHERE DlnmrId = {$id1}";
	d($query);

	exec_query($query);
}

if (isset($_POST['submit']) and $_POST['submit'] === 'Vervang') {

	$query = "UPDATE inschrijving SET InschId = {$id2} WHERE InschId = {$id1}";
	d($query);

	exec_query($query);
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>deelnemersbestand opschonen</title>
	<link href="../css/w3.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="w3-content" style="width: 100%;max-width: 1200px;">
		<form method="post" action="<?php echo $editFormAction; ?>">
			<table class="w3-table-all">
				<tr>
					<td>
						<label>DlnmrId:&nbsp;<input name="id1" type="number" id="id1" value="<?php echo ($_POST['id1']); ?>"></label>
						<input type="submit" name="submit" id="submit" value="Zoek op">
						<?php d($deelnemer);
						echo '<table>' . PHP_EOL;
						foreach ($deelnemer as $x => $x_value) echo "<tr><td>" . $x . "</td><td>" . $x_value . "</td></tr>\n";
						echo ('</table>' . PHP_EOL);
						?>
						<input type="submit" name="submit" id="submit" value="Delete">
					</td>
					<td>
						DlnmrId 2:&nbsp;<input name="id2" type="number" id="id2" value="<?php echo ($_POST['id2']); ?>">
						</label>
						<?php d($deelnemer2);
						echo ('<br>');
						echo '<table>' . PHP_EOL;
						foreach ($deelnemer2 as $x => $x_value) echo "<tr><td>" . $x . "</td><td>" . $x_value . "</td></tr>\n";
						echo ('</table>' . PHP_EOL);
						?>
						<input type="submit" name="submit" id="submit" value="Vervang">
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>

</html>