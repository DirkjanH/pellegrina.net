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
    <!-- CSS: -->
    <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
    <title>Baroque from Central Europe</title>
    <meta charset="UTF-8">
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

                <h2>Program details</h2>
                <p>The summer school focuses on Baroque music in Central Europe (ca. 1600 – 1750). The region comprising the east of Germany, Austria, the Czech Republic and Poland, played a central role in the development of Western classical music, with expression, virtuosity, and new forms taking center stage.
                <h4>Historical and social context</h4>
                <p>The Baroque period coincided with a time of political and religious tensions, such as the Thirty Years' War and the rise of absolute monarchs such as the Habsburgs in Vienna and the Hohenzollerns in Brandenburg. Much music was written in the service of the court and the church, where wealthy monarchs and bishops employed composers and musicians. At the same time, public concert life grew due to the increasing prosperity of the bourgeoisie, allowing music to flourish outside churches and courts.</p>
                <h4>Important composers</h4>
                <p>Central European composers such as Johann Sebastian Bach (Germany), Heinrich Schütz, Georg Philipp Telemann, and, for Austria, Johann Fux and Jan Dismas Zelenka (from what was then Bohemia, now the Czech Republic) left their mark on Baroque music. They developed various instrumental and vocal styles that strongly influenced the further history of Western music. Baroque music from Central Europe thus reflects the search for expression, splendor, and innovation that characterized this flourishing period in European music history.
                <h4>Musical characteristics</h4>
                <p>The transition from Renaissance to Baroque brought a shift from polyphony to a style in which a clear melody line above an accompanying bass (basso continuo) took center stage. Baroque music is characterized by exuberant ornamentation, affect theory (the expression of emotions), harmonic counterpoint, and the development of forms such as the concerto grosso and the suite. Instruments such as the harpsichord and the violin became important, and harmony became essential to the structure of pieces. Church music remained important, but faced competition from secular genres such as chamber music, dance forms, and the first public concerts. The rise of opera as a genre, particularly in Vienna and later also in Prague and Dresden, testifies to the theatrical side of Central European Baroque music.
                <div style="display:inline-block;">
                    <h4 style="margin-top: 0;">The role of the archive in Kroměříž</h4>
                    <div class="fotocenter w3-center"><img src="/Images/kromeriz.jpg" alt="Kroměříž" class="w3-image"><br>Impression of Baroque Kroměříž</div>
                    <p>The music archive of Kroměříž Castle in Moravia (Czech Republic) is one of the richest collections of Baroque church music in Central Europe. Built up by bishops such as Karl von Liechtenstein-Castelcorn in the 17th century, this archive contains thousands of manuscripts and prints, including works by international and local composers, both religious and instrumental repertoire. Kroměříž served as an important cultural center where composers from all over Europe, including Italian and German masters, worked or had their works performed. The archive provides insight into the high quality, international stylistic diversity, and social role of church music in the Baroque period, both during liturgy and for concert performances at court.
                    <h4>Influence and Heritage</h4>
                    <p>Thanks to the Kroměříž archive, much of Central Europe's church music heritage has been preserved that might otherwise have been lost. This makes it possible to bring the repertoire of composers such as Pavel Josef Vejvanovský, Heinrich Biber, and Giovanni Valentini back to life in contemporary performances. The archive symbolizes the exchange of styles and influences within Central Europe and shows how church music contributed to the cultural identity of the region.</p>
                </div>
                <h2><a href="javascript: history.go(-1)">Back</a></h2>
            </div>
        </div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

</html>