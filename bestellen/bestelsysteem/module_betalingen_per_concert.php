<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1 );
error_reporting( E_ALL );

require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';

Kint::$enabled_mode = false;

session_start();
require_once( 'bestelfuncties.php' );
$query_concert = "SELECT * FROM {$tabel_concerten} WHERE online = 1 ORDER BY datum";
$concerten = mysqli_query( $KAARTEN_DB, $query_concert )or die( mysqli_error( $KAARTEN_DB ) );
while ( $row = mysqli_fetch_assoc( $concerten ) ) {
	$datum = strftime( "%A %e %B %Y", strtotime( $row[ 'datum' ] ) );
	$tijd = strftime( "%H:%M", strtotime( $row[ 'tijd' ] ) );
	$row[ 'euro_vol' ] = money_format( '%n', $row[ 'prijs_vol' ] );
	$row[ 'euro_red' ] = money_format( '%n', $row[ 'prijs_red' ] );
	$row[ 'euro_kind' ] = money_format( '%n', $row[ 'prijs_kind' ] );
	$row[ 'concert' ] = stripslashes("<b>{$row['concerttitel']}</b>, te {$row['plaats']}, op {$datum}, {$tijd} uur");
	$row[ 'concert_kort' ] = stripslashes('<b>' . $row[ 'concerttitel' ] . '</b> (' . $row[ 'plaats' ] . ', op <b>' . strftime( "%e %B %Y", strtotime( $row[ 'datum' ] ) ) . '</b>)');
	if ( !( $row[ 'prijs_vol' ] > 0 or $row[ 'prijs_red' ] > 0 ) )
		$row[ 'entree' ] = "toegang gratis (collecte na afloop)";
	else {
		$row[ 'entree' ] = "entree {$row['euro_vol']}";
		if ( $row[ 'prijs_red' ] > 0 )$row[ 'entree' ] .= " | CJP/studenten {$row['euro_red']}";
		if ( $row[ 'prijs_kind' ] > 0 )$row[ 'entree' ] .= " | kinderen tot 12 jaar {$row['euro_kind']}";
	}
	$concert[ $row[ 'concertId' ] ] = $row;
}
if ( empty( $_SESSION[ 'sort' ] )OR $_SESSION[ 'sort' ] == '' )$_SESSION[ 'sort' ] = 'reserveringnr';
if ( isset( $_POST[ 'sort' ] )AND $_POST[ 'sort' ] == 'res' )$_SESSION[ 'sort' ] = 'reserveringnr';
if ( isset( $_POST[ 'sort' ] )AND $_POST[ 'sort' ] == 'naam' )$_SESSION[ 'sort' ] = 'achternaam';
if ( isset( $_POST[ 'sort' ] )AND $_POST[ 'sort' ] == 'via' )$_SESSION[ 'sort' ] = 'publiciteit, aanbrenger';
if ( empty( $_SESSION[ 'select' ] )OR $_SESSION[ 'select' ] == '' )$_SESSION[ 'select' ] = 'alles';
if ( isset( $_POST[ 'select' ] )AND $_POST[ 'select' ] == 'alles' )$_SESSION[ 'select' ] = 'alles';
if ( isset( $_POST[ 'select' ] )AND $_POST[ 'select' ] == 'betaald' )$_SESSION[ 'select' ] = 'betaald';
if ( isset( $_POST[ 'select' ] )AND $_POST[ 'select' ] == 'niet_betaald' )$_SESSION[ 'select' ] = 'niet_betaald';
d( $_POST );
d( $_SESSION );
// Databasehandelingen bestellingen
// Pas betalingsstatus aan:
if ( isset( $_POST[ 'toggle' ] )AND $_POST[ 'toggle' ] > 0 ) {
	d( $_POST[ 'toggle' ] );
	$query_betaald = "SELECT betaald FROM {$tabel_reserveringen} 
	WHERE reserveringnr = {$_POST['toggle']}";
	$result = mysqli_query( $KAARTEN_DB, $query_betaald) or die( mysqli_error($KAARTEN_DB) );
	$betaling = mysqli_fetch_assoc( $result );
	d( $betaling[ 'betaald' ] );
	d( $query_betaald );
	if ( $betaling[ 'betaald' ] == 1 )
		$betaalquery = "UPDATE {$tabel_reserveringen} SET `betaald` = NULL WHERE `reserveringnr` = {$_POST['toggle']}";
	else {
		$betaalquery = "UPDATE {$tabel_reserveringen} SET `betaald` = 1 WHERE `reserveringnr` = {$_POST['toggle']}";
		d( $betaalquery );
	}
	$betaling = mysqli_query( $KAARTEN_DB, $betaalquery )or die( mysqli_error( $KAARTEN_DB ) );
}
if ( ( isset( $_POST[ "bestelling_bewerken" ] ) ) && ( $_POST[ "bestelling_bewerken" ] == "update" ) ) {
	if ( ( isset( $_POST[ "aantal_vol_bewerken" ] ) ) && ( $_POST[ "aantal_vol_bewerken" ] != "" ) )
		$editSQL = sprintf( "UPDATE {$tabel_reserveringen} SET aantal_vol=%s WHERE bestelling=%s",
			GetSQLValueString( htmlspecialchars( $_POST[ 'aantal_vol' ] ), "text" ),
			GetSQLValueString( $_POST[ 'bestelling' ], "int" ) );

	if ( ( isset( $_POST[ "aantal_red_bewerken" ] ) ) && ( $_POST[ "aantal_red_bewerken" ] != "" ) )
		$editSQL = sprintf( "UPDATE {$tabel_reserveringen} SET aantal_red=%s WHERE bestelling=%s",
			GetSQLValueString( htmlspecialchars( $_POST[ 'aantal_red' ] ), "text" ),
			GetSQLValueString( $_POST[ 'bestelling' ], "int" ) );

	if ( ( isset( $_POST[ "aantal_kind_bewerken" ] ) ) && ( $_POST[ "aantal_kind_bewerken" ] != "" ) )
		$editSQL = sprintf( "UPDATE {$tabel_reserveringen} SET aantal_kind=%s WHERE bestelling=%s",
			GetSQLValueString( htmlspecialchars( $_POST[ 'aantal_kind' ] ), "text" ),
			GetSQLValueString( $_POST[ 'bestelling' ], "int" ) );

	//	echo $editSQL.'<br>';
	$betaling = mysqli_query( $KAARTEN_DB, $editSQL )or die( mysqli_error( $KAARTEN_DB ) );
}
if ( ( isset( $_POST[ "bestelling_bewerken" ] ) ) && ( $_POST[ "bestelling_bewerken" ] == "delete" ) ) {
	$deleteSQL = sprintf( "DELETE FROM {$tabel_reserveringen} WHERE Id=%s",
		GetSQLValueString( $_POST[ 'bestelnummer' ], "int" ) );

	$betaling = mysqli_query( $KAARTEN_DB, $editSQL )or die( mysqli_error( $KAARTEN_DB ) );
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<SCRIPT TYPE="text/javascript">
		<!--
		function toggleCheckbox( id ) {
			var Checkbox = document.getElementById( "bet_" + id );
			document.formulier.toggle.value = id;
			document.formulier.submit();
			if ( Checkbox.checked == true ) {
				Checkbox.checked = true;
			} else {
				Checkbox.checked = false;
			}
			//	alert("hiddennaam: "+hiddennaam+"\n)De HiddenField staat op: "+HiddenField.value);
		}

		function selecteer( waarde ) {
			document.formulier.select.value = waarde;
			document.formulier.submit();
		}

		function sorteer( waarde ) {
			document.formulier.sort.value = waarde;
			document.formulier.submit();
		}

		function UpdateBestelling( Nr ) {
			document.formulier.bestelnummer.value = Nr;
			if ( aantal_vol = document.getElementById( 'aantal_vol' + Nr ) ) {
				document.formulier.aantal_vol_bewerken.value = aantal_vol.value;
			}
			if ( aantal_red = document.getElementById( 'aantal_red' + Nr ) ) {
				document.formulier.aantal_red_bewerken.value = aantal_red.value;
			}
			if ( aantal_kind = document.getElementById( 'aantal_kind' + Nr ) ) {
				document.formulier.aantal_kind_bewerken.value = aantal_kind.value;
			}
			document.formulier.bestelling_bewerken.value = 'update';
			document.formulier.submit();
		}

		function DeleteBestelling( Nr ) {
			if ( confirm( "Moet bestelling nr. " + Nr + " werkelijk worden verwijderd?" ) ) {
				document.formulier.bestelnummer.value = Nr;
				document.formulier.bestelling_bewerken.value = 'delete';
				document.formulier.submit();
			}
		}
		-->
	</SCRIPT>
	<title>Betalingen per concert</title>
	<META HTTP-EQUIV=Refresh CONTENT="900; URL=<?php echo $_SERVER['PHP_SELF']; ?>">
	<link href="<?php echo $css; ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo $bestellijst_css; ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo $w3_css; ?>" rel="stylesheet" type="text/css">
</head>

<body>
<div class="w3-content w3-margin-top TekstpaginaAchtergrond">
	<div class="w3-white w3-panel">
		<form action="<?php echo $editFormAction; ?>" method="post" name="formulier" id="formulier">
			<input name="toggle" id="toggle" type="hidden" value="">
			<p>Sorteer op:
				<label>
        <input name="s" type="radio" id="res" OnClick="sorteer('res')" value="res" <?php if ($_SESSION['sort'] == 'reserveringnr') echo 'checked'; ?>>
        reserveringsnummer</label>
				&nbsp;&nbsp;|
				<label>
        <input OnClick="sorteer('naam')" type="radio" name="s" value="naam" id="naam" <?php if ($_SESSION['sort'] == 'achternaam') echo 'checked'; ?>>
        achternaam</label>
				&nbsp;&nbsp;|
				<label>
        <input OnClick="sorteer('via')" type="radio" name="s" value="via" id="via" <?php if ($_SESSION['sort'] == 'publiciteit, aanbrenger') echo 'checked'; ?>>
        aanbrenger</label>
			
			</p>
			<input name="sort" id="sort" type="hidden" value="">
			<p>Alles:&nbsp;
				<input name="b" OnClick="selecteer('alles')" type="radio" <?php if (isset($_SESSION[ 'select']) AND $_SESSION[ 'select']=='alles' ) echo 'checked' ?>> &nbsp;&nbsp;&nbsp;|&nbsp;Alleen betaald:&nbsp;
				<input name="b" OnClick="selecteer('betaald')" type="radio" <?php if (isset($_SESSION[ 'select']) AND $_SESSION[ 'select']=='betaald' ) echo 'checked' ?>> &nbsp;&nbsp;&nbsp;|&nbsp;Alleen niet betaald:&nbsp;
				<input name="b" OnClick="selecteer('niet_betaald')" type="radio" <?php if (isset($_SESSION[ 'select']) AND $_SESSION[ 'select']=='niet_betaald' ) echo 'checked' ?>>
				<input name="select" id="select" type="hidden" value="">
			</p>
			<p>
				<?php if (is_array($concert) AND count($concert) > 0) {
d($_POST);
foreach ($concert as $pl) {
	$query_aantal = "SELECT sum(aantal_vol) as aantal_vol, sum(aantal_red) as aantal_red, sum(aantal_kind) as aantal_kind FROM {$tabel_reserveringen} 
	WHERE concertId={$pl['concertId']} AND {$pl['online']} = 1";
	$tabel_aantal = mysqli_query($KAARTEN_DB, $query_aantal) or die(mysqli_error($KAARTEN_DB));
	$aantal = mysqli_fetch_assoc($tabel_aantal);
	$query_betaald = "SELECT sum(aantal_vol) as aantal_vol, sum(aantal_red) as aantal_red, sum(aantal_kind) as aantal_kind FROM {$tabel_reserveringen} 
	WHERE concertId={$pl['concertId']} AND {$pl['online']} = 1 AND betaald = 1";
	d($query_betaald);
	$result_betaald = mysqli_query($KAARTEN_DB, $query_betaald);
	$tabel_betaald = mysqli_fetch_assoc($result_betaald);
	// begin Recordset
	if (isset($_SESSION['select']))
		switch ($_SESSION['select']) {
			case 'alles':
				$select_betaald = ' ';
			break;
			case 'betaald':
				$select_betaald = 'AND betaald = 1 ';
			break;
			case 'niet_betaald':
				$select_betaald = 'AND (betaald IS NULL OR betaald != 1) ';
			break;
		}
	$query_reserveringen = "SELECT reserveringnr, CONCAT_WS(' ', voornaam, tussenvoegsel, achternaam) as naam, timestamp, plaats,
	telefoon, email, concertId, aantal_vol, aantal_red, aantal_kind, publiciteit, aanbrenger, opmerkingen, flyers, betaald FROM {$tabel_reserveringen} 
	WHERE concertId={$pl['concertId']} {$select_betaald} ORDER BY {$_SESSION['sort']} ASC";
d($query_reserveringen);
	$reserveringen = mysqli_query($KAARTEN_DB, $query_reserveringen) or die(mysqli_error($KAARTEN_DB));
	// end Recordset
	$vol = $aantal['aantal_vol']; 
	$bedrag_vol = $aantal['aantal_vol'] * $pl['prijs_vol']; 
	if ($pl['prijs_red'] > 0) {
		$red = $aantal['aantal_red']; 
		$bedrag_red = $aantal['aantal_red'] * $pl['prijs_red']; 
	}
	else {
		$red = 0;
		$bedrag_red = 0;
	}
	if ($pl['prijs_kind'] > 0) {
		$kind = $aantal['aantal_kind']; 
		$bedrag_kind = $aantal['aantal_kind'] * $pl['prijs_kind']; 
	}
	else {
		$kind = 0;
		$bedrag_kind = 0;
	}
	$som = $vol + $red + $kind;
	$totaal['vol'] += $vol;
	$totaal['red'] += $red;
	$totaal['kind'] += $kind;
	$totaal['totaal'] += $som;	
	$bedrag_som = $bedrag_vol + $bedrag_red + $bedrag_kind;
	$bedrag_totaal['vol'] += $bedrag_vol;
	$bedrag_totaal['red'] += $bedrag_red;
	$bedrag_totaal['kind'] += $bedrag_kind;
	$bedrag_totaal['totaal'] += $bedrag_som;	
	$euro_vol = euro2($bedrag_vol);
	$euro_red = euro2($bedrag_red);
	$euro_kind = euro2($bedrag_kind);
	$euro_som = euro2($bedrag_som);
	$euro_totaal['vol'] = euro2($bedrag_totaal['vol']);
	$euro_totaal['red'] = euro2($bedrag_totaal['red']);
	$euro_totaal['kind'] = euro2($bedrag_totaal['kind']);
	$euro_totaal['som'] = euro2($bedrag_totaal['totaal']);
	$betaald_vol = $tabel_betaald['aantal_vol']; 
	$betaaldbedrag_vol = $tabel_betaald['aantal_vol'] * $pl['prijs_vol']; 
	if ($pl['prijs_red'] > 0) {
		$betaald_red = $tabel_betaald['aantal_red']; 
		$betaaldbedrag_red = $tabel_betaald['aantal_red'] * $pl['prijs_red']; 
	}
	else {
		$betaald_red = 0;
		$betaaldbedrag_red = 0;
	}
	if ($pl['prijs_kind'] > 0) {
		$betaald_kind = $tabel_betaald['aantal_kind']; 
		$betaaldbedrag_kind = $tabel_betaald['aantal_kind'] * $pl['prijs_kind']; 
	}
	else {
		$betaald_kind = 0;
		$betaaldbedrag_kind = 0;
	}
	$betaald_som = $betaald_vol + $betaald_red + $betaald_kind;
	$betaald_totaal['vol'] += $betaald_vol;
	$betaald_totaal['red'] += $betaald_red;
	$betaald_totaal['kind'] += $betaald_kind;
	$betaald_totaal['totaal'] += $betaald_som;	
	$betaaldbedrag_som = $betaaldbedrag_vol + $betaaldbedrag_red + $betaaldbedrag_kind;
	$betaaldbedrag_totaal['vol'] += $betaaldbedrag_vol;
	$betaaldbedrag_totaal['red'] += $betaaldbedrag_red;
	$betaaldbedrag_totaal['kind'] += $betaaldbedrag_kind;
	$betaaldbedrag_totaal['totaal'] += $betaaldbedrag_som;	
	$betaald_euro_vol = euro2($betaaldbedrag_vol);
	$betaald_euro_red = euro2($betaaldbedrag_red);
	$betaald_euro_kind = euro2($betaaldbedrag_kind);
	$betaald_euro_som = euro2($betaaldbedrag_som);
	$betaald_euro_totaal['vol'] = euro2($betaaldbedrag_totaal['vol']);
	$betaald_euro_totaal['red'] = euro2($betaaldbedrag_totaal['red']);
	$betaald_euro_totaal['kind'] = euro2($betaaldbedrag_totaal['kind']);
	$betaald_euro_totaal['som'] = euro2($betaaldbedrag_totaal['totaal']);
	
	$openstaand_euro_vol = euro2($bedrag_totaal['vol'] - $betaaldbedrag_totaal['vol']);
	$openstaand_euro_red = euro2($bedrag_totaal['red'] - $betaaldbedrag_totaal['red']);
	$openstaand_euro_kind = euro2($bedrag_totaal['kind'] - $betaaldbedrag_totaal['kind']);
	$openstaand_euro_som = euro2($bedrag_totaal['totaal'] - $betaaldbedrag_totaal['totaal']);
// end Recordset
$output .= 	"<h3>{$pl['concert_kort']}</h3>";
$output .= "<p>Aantal volle kaarten: {$vol} ({$euro_vol}); aantal red. kaarten: {$red} ({$euro_red}); aantal kinderkaarten: {$kind} ({$euro_kind}); samen: {$som} ({$euro_som})<br>";
$output .= "<i>Al betaalde kaarten: {$betaald_vol} ({$betaald_euro_vol}); aantal red. kaarten: {$betaald_red} ({$betaald_euro_red}); aantal kinderkaarten: {$betaald_kind} ({$betaald_euro_kind}); samen: {$betaald_som} ({$betaald_euro_som})</i></p>";
$output .= "<p>Nog te betalen: vol: {$openstaand_euro_vol}; reductie: {$openstaand_euro_red}; kinderkaarten: {$openstaand_euro_kind}; samen: {$openstaand_euro_som}</p>";
$output .= "<table id=\"res\" class=\"w3-table-all\">
    <tr>
      <th width=\"2%\">Res. nr.:</th>
      <th width=\"8%\">Datum/tijd:</th>
      <th>Betaald:</th>
      <th>Naam:</th>
      <th>Plaats:</th>
      <th>Telefoon:</th>
      <th>Email:</th>
      <th width=\"1%\">Aantal kaarten vol:</th>"; 	  
		if ($pl['prijs_red'] > 0) $output .= "<th width=\"1%\">Aantal kaarten red.:</th>";
		if ($pl['prijs_kind'] > 0) $output .= "<th width=\"1%\">Aantal kaarten kind:</th>";
		$output .= "<th>Weet ervan via:</th>
      <th>Opmerkingen:</th>
      <th>Wil digiflyers:</th>
      <th>Wijzig/wis:</th>
    </tr>";
	while ($res = mysqli_fetch_assoc($reserveringen)) {
		$c = $res['concertId'];
		$concertnaam = $concert[$c]['concert_kort'];
		$Nr = $res['reserveringnr'];
		if ($res['aanbrenger'] != '') 
			$via = $res['aanbrenger'];
		else
			$via = $res['publiciteit'];
		if (isset($res['betaald']) and $res['betaald'] == 1) 
			$betaald = 'checked> ';		else $betaald = '> ';
$output .= "<tr>
        <td align=\"right\">{$Nr}</td>
        <td>{$res['timestamp']}&nbsp;</td>";
	$output .= '<td align="center"><input name="bet_'.$Nr.'" id="bet_'.$Nr.'" onClick="toggleCheckbox('.$Nr.')" type="checkbox" '.$betaald;
	
$output .= "<td>{$res['naam']}&nbsp;</td>
        <td>{$res['plaats']}&nbsp;</td>
        <td>{$res['telefoon']}&nbsp;</td>
        <td>{$res['email']}&nbsp;</td>
        <td width=\"1%\"><input type=\"text\" class=\"betaling\" name=\"aantal_vol{$Nr}\" size=\"3\" id=\"aantal_vol{$Nr}\" value=\"{$res['aantal_vol']}\"></td>";
if ($pl['prijs_red'] > 0) $output .= "<td width=\"1%\"><input type=\"text\" class=\"betaling\" name=\"aantal_red{$Nr}\" size=\"3\" id=\"aantal_red{$Nr}\" value=\"{$res['aantal_red']}\"></td>";
if ($pl['prijs_kind'] > 0) $output .= "<td width=\"1%\"><input class=\"betaling\" type=\"text\" name=\"aantal_kind{$Nr}\" size=\"3\" id=\"aantal_kind{$Nr}\" value=\"{$res['aantal_kind']}\"></td>";
$output .= '<td>'.$via.'&nbsp;</td>';
$output .= '<td>'.$res['opmerkingen'].'&nbsp;</td><td><div align=\"center\">';
if ($res['flyers'] == 1) $output .= 'ja';
$output .= '&nbsp;</div></td>
<td align="center"><img class="geenlijn" src="bestelsysteem/b_edit.png" alt="edit" width="16" height="16" 
		  onclick="UpdateBestelling(<?php echo $Nr ?>)"> &nbsp; <img class="geenlijn" src="bestelsysteem/b_drop.png" alt="delete" width="16" height="16" ] onclick="DeleteBestelling(<?php echo $Nr; ?>)">
				</td>
				</tr>'; } $output .= '</table>'; } echo "Totaal via de site verkochte kaarten: {$totaal['vol']} x vol ({$euro_totaal['vol']}); {$totaal['red']} x red. ({$euro_totaal['red']}); {$totaal['kind']} x kind ({$euro_totaal['kind']}); samen: {$totaal['totaal']} ({$euro_totaal['som']})<br><i>Totaal al betaalde kaarten: {$betaald_totaal['vol']} x vol ({$betaald_euro_totaal['vol']});  {$betaald_totaal['red']} x red. ({$betaald_euro_totaal['red']}); {$betaald_totaal['kind']} x kind ({$betaald_euro_totaal['kind']}); samen: {$betaald_totaal['totaal']} ({$betaald_euro_totaal['som']})</i>"; echo $output; } else echo 'Momenteel geen concerten in de verkoop.<br>' ?>
			</p>
			<p>laatste verversing:
				<?php echo strftime("%c"); ?>
			</p>
			<input name="bestelnummer" type="hidden" id="bestelnummer">
			<input name="bestelling_bewerken" type="hidden" id="bestelling_bewerken">
			<input name="aantal_vol_bewerken" type="hidden" id="aantal_vol_bewerken">
			<input name="aantal_red_bewerken" type="hidden" id="aantal_red_bewerken">
			<input name="aantal_kind_bewerken" type="hidden" id="aantal_kind_bewerken">
		</form>
	</div>
	</div>
</body>
</html>