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
    <title>Programme "<?php echo $cursusdata['cursusnaam']; ?>"</title>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.EN.php'; ?>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
    <link href="/css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
    <!-- Facebook Pixel Code -->
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
    <!-- End Facebook Pixel Code -->
</head>

<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
    <div id="inhoud" class="w3-main"> <?php
                                        echo $navigatie;
                                        echo '<span class="w3-opennav w3-xxlarge w3-hide-large" onclick="w3_open()">☰</span>';
                                        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.EN.php';
                                        ?> <div id="main">
            <div class="cols2">
                <h2>Baroque Music from Naples (1650 – 1750)</h2>
                <p>The joint programme for all participants in the summer school
                    is dedicated to Baroque music from Naples. Throughout the
                    seventeenth and eighteenth centuries, Naples was the beating
                    heart of European musical life. Driven by its prestigious
                    conservatories and vibrant opera houses, the 'Neapolitan
                    School' attracted musicians from across the continent.</p>
                <p>At that time, there was no sharp division between church and
                    theatre: the styles of sacred music and opera closely
                    resembled each other and constantly exchanged musical ideas,
                    affections, and vocal virtuosity. This summer, we immerse
                    ourselves in this rich, expressive, and dramatic Neapolitan
                    repertoire, exploring both compelling instrumental and
                    sacred works as well as concertante excerpts from operas.
                </p>
                <p>During the daily afternoon sessions, singers and
                    instrumentalists join forces to perform these
                    vocal-instrumental masterpieces, accompanied by a colourful
                    Baroque orchestra that, in addition to strings, woodwinds,
                    and basso continuo, also includes brass: natural horns and
                    Baroque trumpets. Our core repertoire includes: </p>
                <ul>
                    <li><strong>Giovanni Battista Pergolesi:</strong> selected
                        instrumental and operatic movements, for instance from
                        <i>Il Flaminio</i> (1735) &mdash; an illustration of the
                        heartfelt, lyrical, and intensely dramatic style that
                        made Pergolesi legendary throughout Europe.
                    </li>
                    <li><strong>Alessandro Scarlatti:</strong> representative
                        sacred works and operatic scenes, e.g. from <i>La
                            Griselda</i> (1721) &mdash; highlighting the
                        ingenious counterpoint, rich wind scoring, and vocal
                        mastery of the founding father of the Neapolitan School.
                    </li>
                    <li><strong>Francesco Durante &amp; Leonardo Leo:</strong>
                        selected sacred concertos, operatic excerpts, and
                        polychoral psalm settings &mdash; featuring rich string
                        writing, colourful brass and woodwinds, expressive
                        solos, and vibrant choral fugues.</li>
                </ul>
            </div>
        </div>
        <h2><a href="javascript: history.go(-1)">Back</a></h2>
    </div>
    </div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

</html>