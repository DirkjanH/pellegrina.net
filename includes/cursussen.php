<?php // begin Recordset cursusgegevens
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);

error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

Kint::$enabled_mode = false;

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2025.php');

$query_cursussen = "SELECT * FROM cursus WHERE cursusId BETWEEN $eerstecursus AND $laatstecursus";

$result = select_query($query_cursussen);

if (!is_array($result)) {
	echo "Could not successfully run query ($query_cursussen)";
	exit;
}

if (count($result) == 0) {
	echo "No rows found, nothing to print so am exiting";
	exit;
}

setlocale(LC_ALL, 'en_GB'); // data e.d. in het Engels
foreach ($result as $cursusdata) {
	$cursussen[$cursusdata['CursusId']] = $cursusdata;
	$cursussen[$cursusdata['CursusId']]['begindatum'] = strftime('%A %e %B', strtotime($cursusdata['datum_begin']));
	$cursussen[$cursusdata['CursusId']]['einddatum'] = strftime('%A %e %B %Y', strtotime($cursusdata['datum_eind']));
	if (strftime('%B', strtotime($cursusdata['datum_begin'])) == strftime('%B', strtotime($cursusdata['datum_eind']))) {
		$cursussen[$cursusdata['CursusId']]['datum'] =
			strftime('%A %e', strtotime($cursusdata['datum_begin'])) . ' - ' . $cursusdata['datum_eind'];
		$cursussen[$cursusdata['CursusId']]['datumkort'] =
			strftime('%e', strtotime($cursusdata['datum_begin'])) . ' - ' . strftime('%e %B', strtotime($cursusdata['datum_eind']));
	} else {
		$cursussen[$cursusdata['CursusId']]['datum'] = $cursusdata['datum_begin'] . ' - ' . $cursusdata['datum_eind'];
		$cursussen[$cursusdata['CursusId']]['datumkort'] =
			strftime('%e %B', strtotime($cursusdata['datum_begin'])) . ' - ' . strftime('%e %B', strtotime($cursusdata['datum_eind']));
	}
	$cursussen[$cursusdata['CursusId']]['beslisdatum'] = strftime('%A %e %B %Y', strtotime($cursusdata['datum_beslissing']));
	$cursussen[$cursusdata['CursusId']]['betaaldatum'] = strftime('%A %e %B %Y', strtotime($cursusdata['datum_betaling']));
	$cursussen[$cursusdata['CursusId']]['cursusnaam'] = $cursusdata['cursusnaam_en']
		. '<BR>(' . $cursusdata['cursusplaats_en'] . ', ' . $cursussen[$cursusdata['CursusId']]['datumkort'] . ')';
}

d($cursusdata);
