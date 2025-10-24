<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2026.php');

Kint::$enabled_mode = false;

$cursus += $cursus_offset;

if (isset($_GET['test']) and $_GET['test'] == 'test') $_SESSION['test'] = 'test';
if ($_GET['test'] == 'geentest') unset($_SESSION['test']);

// begin Recordset cursusgegevens
$cursusdata = select_query("SELECT * FROM cursus WHERE cursusId = {$cursus}", 1);

d($cursusdata, $_GET, $_SESSION);

if (!is_array($cursusdata)) {
	echo "No rows found, nothing to print so am exiting";
	exit;
}
// einde Recordset cursusgegevens

if ($taal == 'NL') {
	setlocale(LC_ALL, 'nl_NL');
	$cursusdata['begindatum'] = strftime('%A %e %B', strtotime($cursusdata['datum_begin']));
	$cursusdata['einddatum'] = strftime('%A %e %B %Y', strtotime($cursusdata['datum_eind']));
	if (strftime('%B', strtotime($cursusdata['datum_begin'])) == strftime('%B', strtotime($cursusdata['datum_eind']))) {
		$cursusdata['datum'] = strftime('%A %e', strtotime($cursusdata['datum_begin'])) . ' - ' . $cursusdata['einddatum'];
		$cursusdata['datumkort'] = $cursusdata['cursusplaats_nl'] . ' - ' . strftime('%e', strtotime($cursusdata['datum_begin'])) . ' - ' . strftime('%e %B', strtotime($cursusdata['datum_eind']));
	} else {
		$cursusdata['datum'] = $cursusdata['begindatum'] . ' - ' . $cursusdata['einddatum'];
		$cursusdata['datumkort'] = $cursusdata['cursusplaats_nl'] . ' - ' . strftime('%e %B', strtotime($cursusdata['datum_begin'])) . ' - ' . strftime('%e %B', strtotime($cursusdata['datum_eind']));
	}
	$cursusdata['beslisdatum'] = strftime('%e %B', strtotime($cursusdata['datum_beslissing']));
	$cursusdata['betaaldatum'] = strftime('%e %B', strtotime($cursusdata['datum_betaling']));
	$cursusdata['cursusnaam'] = $cursusdata['cursusnaam_nl'];
	$cursusdata['ondertitel'] =	$cursusdata['cursusplaats_nl'] . ', ' . $cursusdata['datum'];
	$cursusdata['nr'] = $cursusdata['CursusId'] - $cursus_offset;
} elseif ($taal == 'EN') {
	setlocale(LC_ALL, 'en_GB.UTF-8'); // data e.d. in het Engels
	$cursusdata['begindatum'] = strftime('%A %e %B', strtotime($cursusdata['datum_begin']));
	$cursusdata['einddatum'] = strftime('%A %e %B %Y', strtotime($cursusdata['datum_eind']));
	if (strftime('%B', strtotime($cursusdata['datum_begin'])) == strftime('%B', strtotime($cursusdata['datum_eind']))) {
		$cursusdata['datum'] = strftime('%A %e', strtotime($cursusdata['datum_begin'])) . ' - ' . $cursusdata['einddatum'];
		$cursusdata['datumkort'] = $cursusdata['cursusplaats_en'] . ' - ' . strftime('%e', strtotime($cursusdata['datum_begin'])) . ' - ' . strftime('%e %B', strtotime($cursusdata['datum_eind']));
	} else {
		$cursusdata['datum'] = $cursusdata['begindatum'] . ' - ' . $cursusdata['einddatum'];
		$cursusdata['datumkort'] = $cursusdata['cursusplaats_en'] . ' - ' . strftime('%e %B', strtotime($cursusdata['datum_begin'])) . ' - ' . strftime('%e %B', strtotime($cursusdata['datum_eind']));
	}
	$cursusdata['beslisdatum'] = strftime('%e %B', strtotime($cursusdata['datum_beslissing']));
	$cursusdata['betaaldatum'] = strftime('%e %B', strtotime($cursusdata['datum_betaling']));
	$cursusdata['cursusnaam'] = $cursusdata['cursusnaam_en'];
	$cursusdata['ondertitel'] =	$cursusdata['cursusplaats_en'] . ', ' . $cursusdata['datum'];
	$cursusdata['nr'] = $cursusdata['CursusId'] - $cursus_offset;
} else exit('Deze taal bestaat niet!');

if (isset($_SESSION['test']) and $_SESSION['test'] == 'test') require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/navigatie_test.php');
else require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/navigatie.php');
