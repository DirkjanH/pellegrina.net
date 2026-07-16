<?php
// LP_badges.php (verplaatst naar onderhoud)
// Maakt een array met namen, nationaliteiten en Engelse instrumentnamen
// van deelnemers en docenten voor een gegeven cursus. Ondersteunt extra
// handmatige invoer in het format: naam#nationaliteit#instrument

require_once($_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2026.php');

// Bepaal cursus-id (GET parameter 'cursus', anders eerste cursus)
$CursusId = $eerstecursus;
if (isset($_GET['cursus']) && is_numeric($_GET['cursus']) && $_GET['cursus'] > 0) {
    $CursusId = (int)$_GET['cursus'] + $cursus_offset;
}

// Opbouw instrument lookup tabel (id => Engelse naam)
$instrumententabel = [];
$instrumenten = select_query("SELECT id, en FROM instr ORDER BY id ASC");
if (is_array($instrumenten)) {
    foreach ($instrumenten as $rec) {
        $instrumententabel[(int)$rec['id']] = $rec['en'];
    }
}

// Helper: zet een landnaam om naar het internationale kenteken (car sign)
function get_car_sign($country)
{
    if (empty($country)) return '';
    $s = mb_strtolower(trim($country), 'UTF-8');
    // Verwijder enkele tekens en normaliseer accenten voor eenvoudige matching
    $s = str_replace(["'", "’", "."], ['', '', ''], $s);
    $s = strtr($s, [
        'á' => 'a',
        'à' => 'a',
        'ä' => 'a',
        'â' => 'a',
        'ã' => 'a',
        'å' => 'a',
        'ç' => 'c',
        'é' => 'e',
        'è' => 'e',
        'ë' => 'e',
        'ê' => 'e',
        'í' => 'i',
        'ì' => 'i',
        'ï' => 'i',
        'î' => 'i',
        'ñ' => 'n',
        'ó' => 'o',
        'ò' => 'o',
        'ö' => 'o',
        'ô' => 'o',
        'õ' => 'o',
        'ú' => 'u',
        'ù' => 'u',
        'ü' => 'u',
        'û' => 'u',
        'ý' => 'y',
        'ÿ' => 'y',
        'š' => 's',
        'ž' => 'z'
    ]);

    $map = [
        'nederland' => 'NL',
        'netherlands' => 'NL',
        'nl' => 'NL',
        'belgie' => 'B',
        'belgië' => 'B',
        'belgium' => 'B',
        'be' => 'B',
        'duitsland' => 'D',
        'germany' => 'D',
        'deutschland' => 'D',
        'd' => 'D',
        'oosterijk' => 'A',
        'osterreich' => 'A',
        'austria' => 'A',
        'a' => 'A',
        'frankrijk' => 'F',
        'france' => 'F',
        'f' => 'F',
        'spanje' => 'E',
        'espana' => 'E',
        'spain' => 'E',
        'e' => 'E',
        'italie' => 'I',
        'italia' => 'I',
        'italy' => 'I',
        'i' => 'I',
        'zwitserland' => 'CH',
        'switzerland' => 'CH',
        'suisse' => 'CH',
        'verenigd koninkrijk' => 'GB',
        'united kingdom' => 'GB',
        'uk' => 'GB',
        'gb' => 'GB',
        'verenigde staten' => 'USA',
        'united states' => 'USA',
        'usa' => 'USA',
        'noorwegen' => 'N',
        'norway' => 'N',
        'norge' => 'N',
        'zweden' => 'S',
        'sweden' => 'S',
        'denemarken' => 'DK',
        'denmark' => 'DK',
        'dk' => 'DK',
        'finland' => 'FIN',
        'suomi' => 'FIN',
        'polen' => 'PL',
        'poland' => 'PL',
        'portugal' => 'P',
        'hongarije' => 'H',
        'hungary' => 'H',
        'tsjechie' => 'CZ',
        'czech republic' => 'CZ',
        'czechia' => 'CZ',
        'česko' => 'CZ',
        'slowakije' => 'SK',
        'slovakia' => 'SK',
        'griekenland' => 'GR',
        'greece' => 'GR',
        'hellas' => 'GR',
        'ierland' => 'IRL',
        'ireland' => 'IRL',
        'rusland' => 'RUS',
        'russia' => 'RUS',
        'australie' => 'AUS',
        'australia' => 'AUS',
        'canada' => 'CDN',
        'can' => 'CDN'
    ];

    if (isset($map[$s])) return $map[$s];

    // Als de waarde zelf al een korte code is (2-3 letters), gebruik die
    $up = strtoupper($country);
    if (preg_match('/^[A-Z]{2,3}$/', $up)) return $up;

    // Fallback: geef de oorspronkelijke landtekst terug (niet ideal)
    return $country;
}

$result = [];

// Haal deelnemers op: naam en land + instrumentencodes
$deelnemers_q = "SELECT d.naam, d.achternaam, a.land, i.instr, i.zangstem
FROM dlnmr d
JOIN adres a ON d.adresid_FK = a.adresid
JOIN inschrijving i ON d.dlnmrid = i.dlnmrid_fk
WHERE i.CursusId_FK = {$CursusId} AND i.aangenomen = 1 AND NOT (i.afgewezen <=> 1)";
$deelnemers = select_query($deelnemers_q);
if (is_array($deelnemers)) {
    foreach ($deelnemers as $r) {
        // Volledige naam
        $naam = trim($r['naam'] ?? '');
        // Nationaliteit / land
        $nationaliteit = $r['land'] ?? '';
        // Combineer instrument- en zangstemcodes en map naar Engelse namen
        $codes = [];
        if (!empty($r['instr'])) {
            $codes = array_merge($codes, preg_split('/\s*,\s*/', trim($r['instr'])));
        }
        if (!empty($r['zangstem'])) {
            $codes = array_merge($codes, preg_split('/\s*,\s*/', trim($r['zangstem'])));
        }
        $instruments_en = [];
        foreach ($codes as $c) {
            if ($c === '' || !is_numeric($c)) continue;
            $ci = (int)$c;
            if (isset($instrumententabel[$ci])) $instruments_en[] = $instrumententabel[$ci];
        }
        $result[] = [
            'role' => 'participant',
            'name' => $naam,
            'country_code' => get_car_sign($nationaliteit),
            'instruments_en' => array_values(array_unique($instruments_en)),
        ];
    }
}

// Haal docenten op voor deze cursus
$docenten_q = "SELECT d.naam, d.achternaam, d.land, cd.vak
FROM cursusdocenten cd
JOIN docenten d ON cd.DocId_FK = d.DocId
WHERE cd.CursusID_FK = {$CursusId}";
$docenten = select_query($docenten_q);
if (is_array($docenten)) {
    foreach ($docenten as $r) {
        $naam = trim($r['naam'] ?? '');
        $nationaliteit = $r['land'] ?? '';
        // Voor docenten gebruiken we 'vak' als subject; het kan al een naam zijn
        $vak = trim($r['vak'] ?? '');
        $instruments_en = [];
        if ($vak !== '') $instruments_en[] = $vak . ' (faculty)';
        $result[] = [
            'role' => 'tutor',
            'name' => $naam,
            'country_code' => get_car_sign($nationaliteit),
            'instruments_en' => $instruments_en,
        ];
    }
}

// Verwerk extra handmatig ingevoerde regels (format: naam#nationaliteit#instrument)
if (!empty($_REQUEST['extra'])) {
    $extra_raw = trim($_REQUEST['extra']);
    // Regels scheiden op newlines
    $lines = preg_split('/\r?\n/', $extra_raw);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '') continue;
        $parts = explode('#', $line);
        // Verwacht ten minste 3 delen: naam#nationaliteit#instrument
        $naam = trim($parts[0] ?? '');
        $nationaliteit = trim($parts[1] ?? '');
        $instrument = trim($parts[2] ?? '');
        if ($naam === '') continue;
        $result[] = [
            'role' => 'extra',
            'name' => $naam,
            'country_code' => get_car_sign($nationaliteit),
            'instruments_en' => $instrument !== '' ? [$instrument] : [],
        ];
    }
}

// Drukweergave: 2 kolommen x 7 rijen per A4-pagina
if (isset($_GET['print']) && $_GET['print'] == '1') {
    $per_page = 14; // 2 * 7
    $pages = array_chunk($result, $per_page);
    header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>LP Badges - Print</title>
    <!-- Verbinding maken met Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- De specifieke link voor Alegreya (Medium / 500) -->
    <link
        href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@0,500;1,500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/LP_badges.css">
</head>
<body> <?php
            foreach ($pages as $page) {
                echo '<div class="page">';
                foreach ($page as $item) {
                    $name = htmlspecialchars($item['name'] ?? '', ENT_QUOTES);
                    $country_code = $item['country_code'] ?? '';
                    if ($country_code !== '') {
                        $name .= ' ' . htmlspecialchars("({$country_code})", ENT_QUOTES);
                    }
                    $instrs = isset($item['instruments_en']) && is_array($item['instruments_en']) ? implode(', ', $item['instruments_en']) : '';
                    $instrs = htmlspecialchars($instrs, ENT_QUOTES);
                    echo "<div class=\"badge\">";
                    echo "<div class=\"name\">{$name}</div>";
                    if ($instrs !== '') echo "<div class=\"instruments\">{$instrs}</div>";
                    echo "</div>";
                }
                echo '</div>';
            }
            ?> </body>
</html> <?php
            exit;
        }

        // Als de caller geen JSON wil (geen json=1), toon een eenvoudige HTML-formulier
        if (empty($_GET['json']) || $_GET['json'] != '1') {
            // Toon formulier om extra regels toe te voegen en knop om JSON te tonen
            ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>LP Badges - invoer (onderhoud)</title>
</head>
<body>
    <h2>LP Badges - extra deelnemers toevoegen</h2>
    <form method="get">
        <input type="hidden" name="cursus"
            value="<?php echo htmlspecialchars($_GET['cursus'] ?? '', ENT_QUOTES); ?>">
        <label for="extra">Voer regels in (één per
            regel):<br>naam#nationaliteit#instrument</label><br>
        <textarea name="extra" id="extra" rows="6"
            cols="80"><?php echo htmlspecialchars($_REQUEST['extra'] ?? '', ENT_QUOTES); ?></textarea><br>
        <button type="submit" name="json" value="1">Toon JSON met extra
            regels</button>
    </form>
    <h3>Huidige resultaten (preview)</h3>
    <pre><?php echo htmlspecialchars(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), ENT_QUOTES); ?></pre>
</body>
</html><?php
            exit;
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

            ?>