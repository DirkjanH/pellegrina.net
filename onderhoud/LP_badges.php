<?php
// LP_badges.php (verplaatst naar onderhoud)
// Maakt een array met namen, nationaliteiten en Engelse instrumentnamen
// van deelnemers en docenten voor een gegeven cursus. Ondersteunt extra
// handmatige invoer in het format: naam#nationaliteit#instrument

require_once($_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2026.php');

// Bepaal cursus-index en cursus-id (GET parameter 'cursus', anders eerste cursus)
$cursusIndex = 1;
if (isset($_GET['cursus']) && is_numeric($_GET['cursus']) && $_GET['cursus'] > 0) {
    $cursusIndex = (int)$_GET['cursus'];
}
$CursusId = $eerstecursus;
if ($cursusIndex > 0) {
    $CursusId = $cursusIndex + $cursus_offset;
}

$cursusName = '';
$cursusRow = select_query("SELECT cursusnaam_en FROM cursus WHERE CursusId = {$CursusId}", 1);
if (is_array($cursusRow) && !empty($cursusRow['cursusnaam_en'])) {
    $cursusName = $cursusRow['cursusnaam_en'];
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
        'sverige' => 'S',
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

function build_print_pages_html($result)
{
    $per_page = 14; // 2 * 7
    $pages = array_chunk($result, $per_page);
    $html = '';
    foreach ($pages as $page) {
        $html .= '<div class="page">';
        foreach ($page as $item) {
            $name = htmlspecialchars($item['name'] ?? '', ENT_QUOTES);
            $country_code = $item['country_code'] ?? '';
            if ($country_code !== '') {
                $name .= ' ' . htmlspecialchars("({$country_code})", ENT_QUOTES);
            }
            $instrs = isset($item['instruments_en']) && is_array($item['instruments_en']) ? implode(', ', $item['instruments_en']) : '';
            $instrs = htmlspecialchars($instrs, ENT_QUOTES);
            $html .= "<div class=\"badge\">";
            $html .= "<div class=\"badge-row\">";
            $html .= "<img class=\"badge-logo\" src=\"https://pellegrina.net/Images/Logos/P-final.jpg\" alt=\"P logo\">";
            $html .= "<div class=\"badge-text\">";
            $html .= "<div class=\"name\">{$name}</div>";
            if ($instrs !== '') $html .= "<div class=\"instruments\">{$instrs}</div>";
            $html .= "</div>";
            $html .= "</div>";
            $html .= "</div>";
        }
        $html .= '</div>';
    }
    return $html;
}

// Bewerkbare printweergave
if (isset($_GET['editor']) && $_GET['editor'] == '1') {
    $printHtml = build_print_pages_html($result);
    header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>LP Badges - HTML-editor</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@0,500;1,500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/LP_badges.css">
    <style>
    #editorPreview {
        min-height: 800px;
    }
    </style>
</head>
<body class="w3-light-grey">
    <div class="w3-container w3-content w3-card-4 w3-padding-24"
        style="max-width:1200px; margin-top:24px;">
        <h2 class="w3-center">LP Badges - HTML-editor</h2>
        <div class="w3-row-padding">
            <div class="w3-half">
                <label class="w3-text"><b>HTML-editor</b></label>
                <textarea id="htmlEditor" class="w3-input w3-border"
                    rows="26"><?php echo htmlspecialchars($printHtml, ENT_QUOTES); ?></textarea>
                <button class="w3-button w3-blue w3-margin-top" type="button"
                    onclick="updatePreview()">Update preview</button>
                <button class="w3-button w3-green w3-margin-top" type="button"
                    onclick="printPreview()">Print</button>
                <button class="w3-button w3-black w3-margin-top" type="button"
                    onclick="saveHtml()">Opslaan als HTML</button>
            </div>
            <div class="w3-half">
                <label class="w3-text"><b>Preview</b></label>
                <iframe id="editorPreview" class="w3-white w3-border"
                    style="width:100%; min-height:800px; border:1px solid #ccc;"></iframe>
            </div>
        </div>
    </div>
    <script>
    function updatePreview() {
        const previewFrame = document.getElementById('editorPreview');
        const html = document.getElementById('htmlEditor').value;
        const fullDoc =
            `<!doctype html><html><head><meta charset="utf-8"><title>Preview</title><link rel="stylesheet" href="/css/LP_badges.css"></head><body>${html}</body></html>`;
        previewFrame.srcdoc = fullDoc;
    }

    function printPreview() {
        const html = document.getElementById('htmlEditor').value;
        const printWindow = window.open('', '_blank');
        if (!printWindow) {
            alert(
                'Kan het afdrukvenster niet openen. Controleer of pop-ups zijn toegestaan.');
            return;
        }
        printWindow.document.open();
        printWindow.document.write(
            `<!doctype html><html><head><meta charset="utf-8"><title>LP Badges - Print</title><link rel="stylesheet" href="/css/LP_badges.css"></head><body>${html}</body></html>`
            );
        printWindow.document.close();
        printWindow.focus();
        printWindow.onload = function() {
            printWindow.print();
        };
    }

    function saveHtml() {
        const html = document.getElementById('htmlEditor').value;
        const fullDoc = `<!doctype html><html><head><meta charset="utf-8"><title>LP Badges</title><link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@0,500;1,500&display=swap" rel="stylesheet"><link rel="stylesheet" href="/css/LP_badges.css"></head><body>${html}</body></html>`;
        const blob = new Blob([fullDoc], {
            type: 'text/html'
        });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download =
            '<?php echo preg_replace("/[^A-Za-z0-9_-]+/", "_", "LP_badges_" . ($cursusName ?: "Badges")); ?>.html';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
    }
    window.onload = updatePreview;
    </script>
</body>
</html> <?php
            exit;
        }

        // Drukweergave: 2 kolommen x 7 rijen per A4-pagina
        if (isset($_GET['print']) && $_GET['print'] == '1') {
            $printHtml = build_print_pages_html($result);
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
<body> <?php echo $printHtml; ?> </body>
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <div class="w3-container w3-content w3-card-4 w3-padding-32"
        style="max-width: 900px; margin-top: 32px;">
        <div class="w3-bar w3-margin-bottom">
            <a href="?cursus=1"
                class="w3-bar-item w3-button<?php if ($cursusIndex === 1) echo ' w3-blue'; ?>">Cursus
                1</a>
            <a href="?cursus=2"
                class="w3-bar-item w3-button<?php if ($cursusIndex === 2) echo ' w3-blue'; ?>">Cursus
                2</a>
        </div>
        <h2 class="w3-center">LP Badges - extra deelnemers toevoegen</h2>
        <form class="w3-container" method="get" target="_blank">
            <input type="hidden" name="cursus"
                value="<?php echo htmlspecialchars($cursusIndex, ENT_QUOTES); ?>">
            <label class="w3-text"><b>Invoer</b></label>
            <textarea class="w3-input w3-border" name="extra" id="extra"
                rows="6"
                cols="80"><?php echo htmlspecialchars($_REQUEST['extra'] ?? '', ENT_QUOTES); ?></textarea>
            <small>Voer regels in (één per regel):
                naam#nationaliteit#instrument</small>
            <br><br>
            <button class="w3-button w3-blue" type="submit" name="json"
                value="1">Toon JSON met extra regels</button>
            <button class="w3-button w3-green" type="submit" name="editor"
                value="1">Open bewerkbaar printbestand</button>
        </form>
        <hr>
        <h3 class="w3-center">Huidige resultaten (preview)</h3>
        <div class="w3-light-grey w3-padding">
            <pre><?php echo htmlspecialchars(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), ENT_QUOTES); ?></pre>
        </div>
    </div>
</body>
</html><?php
            exit;
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

            ?>