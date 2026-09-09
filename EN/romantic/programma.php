<?php
//	echo dirname(__FILE__);
$filenaam = explode('/', str_replace('/var', '', dirname(__FILE__)));
//Add filename without file extension
$filenaam[7] = basename(__FILE__, ".php");
//	print_r($filenaam);	
switch ($filenaam[6]) {
    case 'romantic':
        $cursus = 1;
        break;
    case 'baroque':
        $cursus = 2;
        break;
}
//	echo 'Cursus is: '.$cursus.'<br>';
$taal = $filenaam[5];
//	echo 'taal is: '.$taal.'<br>';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/cursusdata.php'; ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
    <title>Mendelssohn's oratorio Elijah</title>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.NL.php'; ?>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(
                    arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '537749209897328');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=537749209897328&ev=PageView&noscript=1" /></noscript>
</head>

<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
    <div id="inhoud" class="w3-auto w3-main"> <?php
                                                echo $navigatie;
                                                echo '<span class="w3-opennav w3-xxlarge w3-hide-large" onclick="w3_open()">☰</span>';
                                                require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.EN.php';
                                                ?> <div id="main" class="programma-layout">
            <div class="programma-afbeelding"><img
                    src="/Images/mendelssohn.jpg"
                    alt="Portrait of Felix Mendelssohn Bartholdy">
            </div>
            <div class="programma-tekst">
                <h3>The central work: Mendelssohn's Elijah, Op. 70</h3>
                <p>In the closing concert, we will perform Mendelssohn's
                    Romantic oratorio <em>Elijah</em> with soloists, orchestra
                    and choir.</p>
                <p>Felix Mendelssohn completed his magnificent oratorio
                    <em>Elijah</em> in 1846 for the music festival in
                    Birmingham. The work tells the dramatic life story of the
                    Old Testament prophet Elijah. From the devastating drought
                    and the confrontation with the prophets of Baal on Mount
                    Carmel, to his lonely flight into the desert and his final
                    ascension in a chariot of fire, Mendelssohn captured this
                    biblical story in astonishingly theatrical and emotionally
                    charged music.
                </p>
                <p>In the structure of the oratorio, Mendelssohn combined the
                    Baroque contrapuntal tradition of Bach and Handel with the
                    compelling, lyrical expression of nineteenth-century
                    Romanticism. The choir has an impressive dual role: one
                    moment it represents the angry crowd or the pleading
                    prophets of Baal, and the next it provides omniscient
                    commentary, as in a classical Greek tragedy.</p>
            </div>
        </div>
        <h2><a href="javascript: history.go(-1)">Back</a></h2>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html>