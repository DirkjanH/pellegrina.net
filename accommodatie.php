<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1 );
error_reporting( E_ALL );

ob_start();

require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/includes/includes2024.php' );

require_once $_SERVER[ "DOCUMENT_ROOT" ] . '/vendor/autoload.php';

session_start();

Kint::$enabled_mode = true;

if ( isset( $_POST[ 'cursus' ] )and $_POST[ 'cursus' ] > 0 )
	$_SESSION[ 'welke_cursus' ] = $CursusId = $_POST[ 'cursus' ] + $cursus_offset; // cursusnummer
elseif ( isset( $_SESSION[ 'welke_cursus' ] )AND $_SESSION[ 'welke_cursus' ] > 0 )$CursusId = $_SESSION[ 'welke_cursus' ];
else $CursusId = $cursus_offset + 1;

if ( isset( $_POST[ 'sorteer' ] )and $_POST[ 'sorteer' ] != "" )
	$_SESSION[ 'sorteer' ] = $_POST[ 'sorteer' ];
elseif ( isset( $_SESSION[ 'sorteer' ] )AND $_SESSION[ 'sorteer' ] != '' )$_POST[ 'sorteer' ] = $_SESSION[ 'sorteer' ];
else $sorteer = 'd.achternaam';

if ( isset( $_POST[ 'selecteer' ] )and $_POST[ 'selecteer' ] != "" )
	$_SESSION[ 'selecteer' ] = $selecteer = $_POST[ 'selecteer' ];
elseif ( isset( $_SESSION[ 'selecteer' ] )AND $_SESSION[ 'selecteer' ] != '' )$selecteer = $_SESSION[ 'selecteer' ];
else $selecteer = '1=1';

if ( empty( $_POST[ 'niet_aangenomen' ] )or $_POST[ 'niet_aangenomen' ] != 1 )
	$ook_niet_aangenomen = 'AND i.aangenomen = 1'; // niet-aangenomen deelnemers uitsluiten
else
	$ook_niet_aangenomen = '';
if ( empty( $_POST[ 'gepostuleerd' ] )or $_POST[ 'gepostuleerd' ] != 1 )
	$ook_gepostuleerd = 'AND NOT (d.achternaam LIKE "%XXX%" OR d.achternaam LIKE "%YYY%" OR d.achternaam LIKE "%ZZZ%")'; // geen gepostuleerde deelnemers
else
	$ook_gepostuleerd = '';

if ( isset( $_POST[ 'sorteer' ] )and $_POST[ 'sorteer' ] != "" )
	switch ( $_POST[ 'sorteer' ] ) {
		case "Naam:":
			$sorteer = 'd.achternaam ASC';
			break;
		case "Postcode:":
			$sorteer = 'a.postcode ASC';
			break;
		case "Inschrijfdatum:":
			$sorteer = 'i.datum_inschr ASC';
			break;
		case "Aanbrenger:":
			$sorteer = 'd.naam_aanbrenger DESC';
			break;
		case "Eenpersoons:":
			$sorteer = 'i.eenpersoons DESC, i.datum_inschr ASC, d.achternaam';
			break;
		case "Meerpersoons:":
			$sorteer = 'i.meerpers DESC, i.datum_inschr ASC, d.achternaam';
			break;
		case "Tweepersoons:":
			{
				$selecteer = 'NOT (
			 i.eenpersoons <=> 1 
			 OR i.meerpers <=> 1 
			 OR i.hotel_1pp <=> 1 
			 OR i.hotel_2pp <=> 1 
			 OR i.kamperen <=> 1
			OR i.eigen_acc <=> 1
		  )';
				$sorteer = "i.datum_inschr, d.achternaam ASC";
			};
			break;
		case "Hotel 1-pp:":
			$sorteer = 'i.hotel_1pp DESC, i.datum_inschr, d.achternaam ASC';
			break;
		case "Hotel 2-pp:":
			$sorteer = 'i.hotel_2pp DESC, i.datum_inschr, d.achternaam ASC';
			break;
		case "Eigen acc.:":
			$sorteer = 'i.eigen_acc DESC, i.datum_inschr, d.achternaam ASC';
			break;
		case "Kamperen:":
			$sorteer = 'i.kamperen DESC, i.datum_inschr, d.achternaam ASC';
			break;
	}

d( $_POST, $_SESSION, $sorteer, $selecteer, $CursusId );

// begin Recordset
$eerste_inschrijving = ( $jaar - 1 ) . '-12-01';
$query_Cursus = "SELECT 
  d.naam,
  d.naam_aanbrenger,
  DATEDIFF(d.eerste_inschrijving, DATE('$eerste_inschrijving')) AS nieuw,
  i.datum_inschr,
  i.eenpersoons,
  i.meerpers,
  i.kamperen,
  i.hotel_2pp,
  i.hotel_1pp,
  i.eigen_acc,
  i.acc_wens,
  a.postcode,
  i.opmerkingen 
FROM
  dlnmr d,
  inschrijving i,
  adres a 
WHERE 
  i.CursusId_FK = {$CursusId} 
  AND d.dlnmrid = i.dlnmrid_fk 
  AND d.adresId_FK = a.adresId 
  AND {$selecteer}
  AND NOT (afgewezen <=> 1) 
  {$ook_niet_aangenomen} {$ook_gepostuleerd}
  ORDER BY {$sorteer}";

d( $query_Cursus );

$cursisten = select_query( $query_Cursus );
if (is_array($cursisten)) $aantal_deelnemers = count( $cursisten );

$query_toehoorders = "SELECT COUNT(*) FROM inschrijving WHERE CursusId_FK = {$CursusId} AND toehoorder = 1 and NOT (afgewezen <=> 1)";
$aantal_toehoorders = select_query( $query_toehoorders, 0 );

$Cursusnaam = select_query( "SELECT cursusnaam_en, YEAR(datum_begin) as jaar FROM cursus WHERE CursusId = {$CursusId}", 1 );

$query_docenten = "SELECT COUNT(*) FROM cursus as c, cursusdocenten AS cd, docenten AS d WHERE CursusId_FK = {$CursusId} AND cd.DocId_FK = d.DocId AND c.CursusId = cd.CursusID_FK ORDER BY d.achternaam";
$aantal_docenten = select_query( $query_docenten, 0 );
// end Recordset

$aantal_aanwezigen = $aantal_deelnemers + $aantal_toehoorders + $aantal_docenten;

d( $aantal_aanwezigen, $aantal_deelnemers, $aantal_toehoorders, $aantal_docenten );

$query_acc = "SELECT count(*) FROM
  dlnmr d,
  inschrijving i
  WHERE i.CursusId_FK = {$CursusId} 
  AND d.dlnmrid = i.dlnmrid_fk 
  AND {$selecteer}
  {$ook_niet_aangenomen} {$ook_gepostuleerd}
  AND NOT (afgewezen <=> 1)
  AND eenpersoons = 1";

d( $query_acc );

$aantal_eenpersoons = select_query( $query_acc, 0 );

$query_acc = "SELECT count(*) FROM
  dlnmr d,
  inschrijving i
  WHERE i.CursusId_FK = {$CursusId} 
  AND d.dlnmrid = i.dlnmrid_fk 
  AND {$selecteer}
  {$ook_niet_aangenomen} {$ook_gepostuleerd}
  AND NOT (afgewezen <=> 1)
  AND meerpers = 1";

d( $query_acc );

$aantal_meerpersoons = select_query( $query_acc, 0 );

$query_acc = "SELECT count(*) FROM
  dlnmr d,
  inschrijving i
WHERE i.CursusId_FK = {$CursusId} 
  AND d.dlnmrid = i.dlnmrid_fk 
  AND {$selecteer}
  {$ook_niet_aangenomen} {$ook_gepostuleerd}
  AND NOT (afgewezen <=> 1)
  AND kamperen = 1";

d( $query_acc );

$aantal_kamperen = select_query( $query_acc, 0 );

$query_acc = "SELECT count(*) FROM
  dlnmr d,
  inschrijving i
WHERE i.CursusId_FK = {$CursusId} 
  AND d.dlnmrid = i.dlnmrid_fk 
  AND {$selecteer}
  {$ook_niet_aangenomen} {$ook_gepostuleerd}
  AND NOT (afgewezen <=> 1)
  AND eigen_acc = 1";

d( $query_acc );

$aantal_eigenacc = select_query( $query_acc, 0 );

$query_acc = "SELECT count(*) FROM
  dlnmr d,
  inschrijving i
  WHERE i.CursusId_FK = {$CursusId} 
  AND d.dlnmrid = i.dlnmrid_fk 
  AND {$selecteer}
  {$ook_niet_aangenomen} {$ook_gepostuleerd}
  AND NOT (afgewezen <=> 1)
  AND hotel_1pp = 1";

d( $query_acc );

$aantal_hotel_1pp = select_query( $query_acc, 0 );

$query_acc = "SELECT count(*) FROM
  dlnmr d,
  inschrijving i
WHERE i.CursusId_FK = {$CursusId} 
  AND d.dlnmrid = i.dlnmrid_fk 
  AND {$selecteer}
  {$ook_niet_aangenomen} {$ook_gepostuleerd}
  AND NOT (afgewezen <=> 1)
  AND hotel_2pp = 1";

d( $query_acc );

$aantal_hotel_2pp = select_query( $query_acc, 0 );

$aantal_tweepersoons = $aantal_deelnemers - $aantal_eenpersoons - $aantal_meerpersoons - $aantal_eigenacc - $aantal_kamperen - $aantal_hotel_1pp - $aantal_hotel_2pp;

// begin Recordset
$query_instrumenten = "SELECT * FROM instr ORDER BY id ASC";
$instrumenten = select_query( $query_instrumenten );
$totalRows_instrumenten = count( $instrumenten );
foreach ( $instrumenten as $instr ) {
	$instrumententabel[ $instr[ 'id' ] ] = $instr[ 'en' ];
}
// end Recordset

d( $instrumententabel );

?>
<!DOCTYPE HTML>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Accommodatie</title>
	<link href="css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
	<style type="text/css">
		<!-- body {
			margin: 20px;
		}
		
		table {
			table-layout: auto;
			width: 100%;
			border: 3px double #000000;
			border-collapse: collapse;
		}
		
		td {
			border: 1px solid #000000;
			padding: 0.4em;
		}
		
		td.iks {
			text-align: center;
		}
		
		.nieuwe_deelnemer {
			background-color: #FFCC66;
		}
		
		.nadruk {
			color: rgba(0, 51, 153, 1);
		}
		
		-->
	</style>
	<SCRIPT TYPE="text/javascript">
		<!--
		function Ganaar( cursus ) {
			document.getElementById( "cursus" ).value = cursus;
			document.formulier.submit();
		}
		-->
	</SCRIPT>
</head>

<body>
	<div class="w3-white">
		<form action="<?php echo $editFormAction; ?>" method="post" name="formulier" id="formulier">
			<div class="w3-panel w3-left">
				<p><strong>Lists of participants </strong>including not yet accepted:
					<input <?php if (!(strcmp($_POST[ 'niet_aangenomen'],1))) {echo "checked=\"checked\"";}?> name="niet_aangenomen" type="checkbox" id="niet_aangenomen" value="1">
					<strong></strong>including postulated:
					<input <?php if (!(strcmp($_POST[ 'gepostuleerd'],1))) {echo "checked=\"checked\"";}?> name="gepostuleerd" type="checkbox" id="gepostuleerd" value="1">
					<?php 
		$i = $eerstecursus;
		if (empty($_POST['niet_aangenomen'])) $_POST['niet_aangenomen'] = 0;
		if (empty($_POST['gepostuleerd'])) $_POST['gepostuleerd'] = 0;
?> | Kies het project:
					<?php
					$i = 1;
					while ( $i <= $aantal_cursussen ) {
						echo "<input type=\"radio\" name=\"cursus\" value=\"{$i}\"";
						if ( isset( $_POST[ 'cursus' ] )and( $_POST[ 'cursus' ] == $i ) )echo 'checked';
						echo " OnClick=Ganaar($i)>cursus {$i} | \n";
						$i++;
					}
					?>
					<input type="hidden" id="cursus" name="cursus" value="">
					<br>
				</p>
				<h2>Course <em><?php echo $Cursusnaam['cursusnaam_en'] . '</em>&nbsp;'.$Cursusnaam['jaar'].'</h2>
				<p>'. $aantal_deelnemers;?> participants
					<?php if ($aantal_toehoorders > 0) echo ", including {$aantal_toehoorders} auditor(s)"; ?>
				</p>
				<p class="nadruk">You can sort this list on name, address, instruments, singing voice or transportation method by pressing the buttons in the heading</p>
			</div>
			<table>
				<tr>
					<th><input type="submit" name="sorteer" value="Naam:" accesskey="N"><br>
						<span class="nadruk">Aantal: <?php echo $aantal_aanwezigen; ?></span>
					</th>
					<th><input type="submit" name="sorteer" value="Postcode:" accesskey="P">
					</th>
					<th width="140"><input type="submit" name="sorteer" value="Inschrijfdatum:" accesskey="D">
					</th>
					<th><input type="submit" name="sorteer" value="Eenpersoons:" accesskey="E"><br>
						<span class="nadruk">Aantal: <?php echo $aantal_eenpersoons; ?> + docenten</span>
					</th>
					<th><input type="submit" name="sorteer" value="Tweepersoons:" accesskey="I"><br>
						<span class="nadruk">Aantal: <?php echo $aantal_tweepersoons; ?> + docenten</span>
					</th>
					<th><input type="submit" name="sorteer" value="Meerpersoons:" accesskey="M"><br>
						<span class="nadruk">Aantal: <?php echo $aantal_meerpersoons; ?> + docenten</span>
					</th>
					<th><input type="submit" name="sorteer" value="Hotel 1-pp:" accesskey="R"><br>
						<span class="nadruk">Aantal: <?php echo $aantal_hotel_1pp; ?></span>
					</th>
					<th><input type="submit" name="sorteer" value="Hotel 2-pp:" accesskey="T"><br>
						<span class="nadruk">Aantal: <?php echo $aantal_hotel_2pp; ?></span>
					</th>
					<th><input type="submit" name="sorteer" value="Eigen acc.:" accesskey="A">
						<br>
						<span class="nadruk">Aantal: <?php echo $aantal_eigenacc; ?></span>
					</th>
					<th><input type="submit" name="sorteer" value="Kamperen:" accesskey="K"><br>
						<span class="nadruk">Aantal: <?php echo $aantal_kamperen; ?></span>
					</th>
					<th><input type="submit" name="sorteer" value="Aanbrenger:" accesskey="A">
					</th>
					<th>Accommodatie-wensen</th>
					<th class="niet-printen">Opmerkingen</th>
				</tr>
				<?php
				foreach ( $cursisten as $curs ) {
					?>
				<tr>
					<td>
						<?php echo $curs['naam']; ?>&nbsp;</td>
					<td>
						<?php echo $curs['postcode']; ?>&nbsp;</td>
					<td>
						<?php echo $curs['datum_inschr']; ?>&nbsp;</td>
					<td class="iks">
						<?php if ($curs['eenpersoons'] == 1) echo 'X'; ?>&nbsp;</td>
					<td class="iks">
						<?php if ($curs['eenpersoons'] != 1 AND $curs['hotel_1pp'] != 1 AND $curs['meerpers'] != 1 AND $curs['hotel_2pp'] != 1 AND $curs['eigen_acc'] != 1 AND $curs['kamperen'] != 1) echo 'X'; ?> &nbsp;
					</td>
					<td class="iks">
						<?php if ($curs['meerpers'] == 1) echo 'X'; ?>
					</td>
					<td class="iks">
						<?php if ($curs['hotel_1pp'] == 1) echo 'X'; ?>&nbsp;</td>
					<td class="iks">
						<?php if ($curs['hotel_2pp'] == 1) echo 'X'; ?>&nbsp;</td>
					<td class="iks">
						<?php if ($curs['eigen_acc'] == 1) echo 'X'; ?> &nbsp;
					</td>
					<td class="iks">
						<?php if ($curs['kamperen'] == 1) echo 'X'; ?>&nbsp;</td>
					<td<?php if ($curs[ 'nieuw']>= 0) echo ' class="nieuwe_deelnemer"'; ?>>
						<?php echo $curs['naam_aanbrenger']; ?>&nbsp;</td>
						<td>
							<?php echo $curs['acc_wens']; ?>&nbsp;</td>
						<td class="niet-printen">
							<?php echo $curs['opmerkingen']; ?>&nbsp;</td>
				</tr>
				<?php
				}
				?>
			</table>
		</form>
	</div>
</body>
</html>
<?php ob_end_flush(); ?>