<?php 
function format_datum($timestamp, $locale) {
$skeleton = "EEEE, d MMMM YYYY";
 
$day = \DateTimeImmutable::createFromFormat('Y-m-d', $timestamp);
$datum = new \IntlDatePatternGenerator($locale);
$pattern = $datum->getBestPattern($skeleton);
return \IntlDateFormatter::formatObject($day, $pattern, $locale);
}

function format_datum_noyear($timestamp, $locale) {
$skeleton = "EEEE, d MMMM";
 
$day = \DateTimeImmutable::createFromFormat('Y-m-d', $timestamp);
$datum = new \IntlDatePatternGenerator($locale);
$pattern = $datum->getBestPattern($skeleton);
return \IntlDateFormatter::formatObject($day, $pattern, $locale);
}

function format_datum_short($timestamp, $locale) {
$skeleton = "d MMMM YYYY";
 
$day = \DateTimeImmutable::createFromFormat('Y-m-d', $timestamp);
$datum = new \IntlDatePatternGenerator($locale);
$pattern = $datum->getBestPattern($skeleton);
return \IntlDateFormatter::formatObject($day, $pattern, $locale);
}
?>