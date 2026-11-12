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
    <title>Mendelssohn's oratorio Elijah (Part I)</title>
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
                                                ?> <div id="main"
            class="programma-layout">
            <div class="programma-afbeelding"><img src="/Images/mendelssohn.jpg"
                    alt="Portrait of Felix Mendelssohn Bartholdy">
            </div>
            <div class="programma-tekst">
                <h1>The central work: Mendelssohn's Elijah, Op. 70 (Part I)</h1>
                <p>In the final concert, we will perform only Part I of
                    Mendelssohn's Romantic oratorio <em>Elijah</em>, with
                    soloists, orchestra and choir. The complete work is too long
                    to prepare during this course. Part I lasts approximately
                    65 to 70 minutes and therefore
                    makes a complete concert programme in its own right. The
                    story, too, forms a satisfying whole. </p>
                <p>Part I of Mendelssohn's <em>Elijah</em> reflects his admiration for
                    Bach and Handel, while at the same time giving the oratorio
                    a distinctly Romantic dramatic character. The choir plays an
                    important role: it represents the people of Israel, the
                    angels and the bystanders. The contrasts between the
                    people's desperate prayers, Elijah's powerful prophetic
                    proclamations and the lyrical arias make the first part a
                    varied and compelling musical experience.</p>
                <p>The music brings the events almost cinematically to life: the
                    threat of drought, the widow's despair, the confrontation on
                    Mount Carmel and, ultimately, the triumph of Elijah's God.
                </p>
                <h2>Introduction to Part One</h2>
                <h3>The story</h3>
                <p>The oratorio opens with Elijah's dramatic announcement: as
                    punishment for the people's worship of idols, there will be
                    no more rain. A prolonged drought and famine follow. Elijah
                    withdraws and is supplied with food by ravens. Later, he
                    finds shelter with a widow in Zarephath. When her son dies,
                    Elijah prays to God and brings him back to life.</p>
                <p>Meanwhile, the drought becomes increasingly severe. King Ahab
                    holds Elijah responsible for the people's suffering, but
                    Elijah argues that the real cause is their worship of idols.
                    He challenges the prophets of Baal to a decisive contest on
                    Mount Carmel.</p>
                <p>There, the prophets of Baal offer a sacrifice to their god,
                    but no fire comes. Elijah then builds an altar to the God of
                    Israel. After his prayer, fire descends from heaven and
                    consumes the offering. The people acknowledge the God of
                    Israel. Elijah orders the prophets of Baal to be put to
                    death and then prays for rain. After a long period of
                    drought, a small cloud finally appears in the sky: the rain
                    returns.</p>
                <h3>Performing forces</h3>
                <ul>
                    <li><strong>Soloists:</strong> soprano, alto, tenor and
                        bass.</li>
                    <li><strong>Choir:</strong> mixed four-part choir (SATB),
                        including a double quartet and smaller vocal ensembles.
                    </li>
                    <li><strong>Orchestra:</strong> strings, two flutes, two
                        oboes, two clarinets, two bassoons, four horns, two
                        trumpets, three trombones, ophicleide (represented in
                        our performance by a tuba), timpani and organ.</li>
                </ul>
                <p>The principal solo role is that of Elijah, usually sung by a
                    bass or bass-baritone. The other soloists portray several
                    characters, including King Ahab, the prophet Obadiah, the
                    widow, her son and various angels.</p>
                <h3>Duration</h3>
                <p>The first part lasts approximately <strong>65 to 70
                        minutes</strong>, depending on the tempo. The complete
                    oratorio lasts approximately 2 hours and 10 minutes.</p>
            </div>
        </div>
        <h2><a href="javascript: history.go(-1)">Back</a></h2>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>
</html>