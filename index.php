<?php // stel php in dat deze fouten weergeeft //ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

use function PHP81_BC\strftime;

Kint::$enabled_mode = false;
require_once($_SERVER['DOCUMENT_ROOT']
    . '/includes/includes2027.php');
$jaar = 2027;
function getisp($ip = '')
{
    if ($ip == '')
        $ip = $_SERVER['REMOTE_ADDR'];
    $longisp = @gethostbyaddr($ip);
    $isp = explode(
        '.',
        $longisp
    );
    $isp = array_reverse($isp);
    $tmp = $isp[1];
    if (preg_match("/\<(org?|com?|net)\>/i", $tmp)) {
        $myisp = $isp[2] . '.' .
            $isp[1] . '.' . $isp[0];
    } else {
        $myisp = $isp[1] . '.' . $isp[0];
    }
    preg_match("/[0-9]{1,3}\.[0-9]{1,3}/", $myisp);
    return $myisp;
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>La Pellegrina Music Summer Schools</title>
    <meta name="Description"
        content="Musical Summer Schools for advanced musical amateurs, chamber music and orchestra">
    <meta name="Keywords"
        content="Barokmuziek, klassieke muziek, zingen, muziekmaken, Kamermuziek, Kleine ensembles, Koorzang, Muziekcursus, Muziekliefhebbers, Muziekvakantie, Solozang, Tsjechië muziek, Vocaal ensemble, Workshop, Zomercursus, 
        Chamber Music, Choir, singing, classical, Course, Baroque, Czech music, Czech Republic, music abroad, Music making, Orchestra chamber music, Romantic music, Singers, Solo singing, Students music, Summer school abroad, 
        klassische Musik, Junggesellen Musik, Kammermusik, Laienmusik, Barock, Musikliebhaber, Romantische Musik, Sologesang, Sommerkurs, Studenten Musik, Tschechien, Tschechische Musik ">
    <meta charset="utf-8">
    <meta name="verify-v1"
        content="CNpSvvR+TC1YnI2of9XUZf1olPLIrNYnXNIraar7VLI=" />
    <link rel="apple-touch-icon" sizes="180x180"
        href="https://pellegrina.net/Images/Logos/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32"
        href="https://pellegrina.net/Images/Logos/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16"
        href="https://pellegrina.net/Images/Logos/favicon-16x16.png">
    <link rel="manifest"
        href="https://www.pellegrina.net/Images/Logos/site.webmanifest">
    <link rel="shortcut icon"
        href="https://pellegrina.net/Images/Logos/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config"
        content="https://pellegrina.net/Images/Logos/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link href="css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
    <link href="/css/banner.css" rel="stylesheet" type="text/css">
    <link href="/css/openingspagina.css" rel="stylesheet" type="text/css">
    <script src="/javascript/slideshow.js" defer></script>
    <meta name="google-site-verification"
        content="BOrB5tEMjKF9O0X8Ow1Gjl2z7Q-Su6aCqce0dbJZeVE" />
    <meta name="verify-v1"
        content="vR6h4zMZYm0o19dhXiI5yeZrVu5fueMcCb/+Hsp+g4g=" />
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
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

<body class="landing-page">
    <main id="inhoud" class="landing-shell">
        <header class="landing-header">
            <img class="landing-logo" src="Images/Logos/LP_nieuw.png"
                alt="La Pellegrina" width="600" height="112">
            <div id="banner">
                <div id="bannerteksten" class="registration-notice bannergeel">
                    <span lang="nl">Inschrijving <?php echo $jaar ?> start 1 december!</span>
                    <span>Registration for <?php echo $jaar ?> starts December 1!</span>
                </div>
            </div>
        </header>
        <div id="home">
            <div id="fb-root"></div>
            <script>
                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/nl_NL/all.js#xfbml=1";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            </script>
            <div class="landing-grid">
                    <a class="course-card course-card-nl" href="NL" lang="nl">
                        <span class="course-language"><img
                                src="Images/Logos/Vlag_NL.jpg" alt=""
                                width="28" height="20">Nederlands</span>
                        <h2>Zomercursussen <?php echo $jaar ?></h2>
                        <p>Twee zomercursussen voor gevorderde amateurmusici
                            en professionals.</p>
                        <ul>
                            <li><strong>Mendelssohns Elias</strong>
                                <span>22 juli - 1 augustus 2027</span></li>
                            <li><strong>Napolitaanse Barok</strong>
                                <span>8 - 14 augustus 2027</span></li>
                        </ul>
                        <span class="course-cta">Bekijk de cursussen <span aria-hidden="true">&rarr;</span></span>
                    </a>
                    <div id="carroussel"
                        role="region" aria-roledescription="carousel"
                        aria-label="La Pellegrina in beeld / in pictures">
                        <div class="slideshow-images">
                        <img src="Images/slideshow/dvorak_tutors.jpg" alt=""
                            class="mySlides is-active" fetchpriority="high" />
                        <img src="Images/slideshow/oboeband.jpg" alt=""
                            class="mySlides" />
                        <img src="Images/slideshow/blazers_buiten.jpg" alt=""
                            class="mySlides" />
                        <img src="Images/slideshow/druivenkas.jpg" alt=""
                            class="mySlides" />
                        <img src="Images/slideshow/strijkkwartet.jpg" alt=""
                            class="mySlides" />
                        <img src="Images/slideshow/ensemble_NS.jpg" alt=""
                            class="mySlides" />
                        <img src="Images/slideshow/DJ_dirigerend2.jpg" alt=""
                            class="mySlides" />
                        <img src="Images/slideshow/koorzangers.jpg" alt=""
                            class="mySlides" />
                        <img src="Images/slideshow/docententrio.jpg" alt=""
                            class="mySlides" />
                        <img src="Images/slideshow/kamerkoor.jpg" alt=""
                            class="mySlides" />
                        <img src="Images/slideshow/kloosterkerk.jpg" alt=""
                            class="mySlides" />
                        <img src="Images/slideshow/orkestrepetitie.jpg" alt=""
                            class="mySlides" />
                        <img src="Images/slideshow/zingende_mannen.jpg" alt=""
                            class="mySlides" />
                        </div>
                        <div class="slideshow-controls" hidden>
                            <button type="button" class="slideshow-previous"
                                aria-label="Vorige foto / Previous photo">&#10094;</button>
                            <button type="button" class="slideshow-toggle"
                                aria-pressed="false" aria-label="Pauze / Pause"
                                title="Pauze / Pause"><span
                                    class="slideshow-toggle-icon" aria-hidden="true"></span></button>
                            <button type="button" class="slideshow-next"
                                aria-label="Volgende foto / Next photo">&#10095;</button>
                        </div>
                    </div>
                    <a class="course-card course-card-en" href="EN">
                        <span class="course-language"><img
                                src="Images/Logos/Vlag_UK.jpg" alt=""
                                width="28" height="20">English</span>
                        <h2>Summer Schools <?php echo $jaar ?></h2>
                        <p>Two summer schools for accomplished amateur
                            musicians and professionals.</p>
                        <ul>
                            <li><strong>Mendelssohn's Elijah</strong>
                                <span>22 July - 1 August 2027</span></li>
                            <li><strong>Neapolitan Baroque in 415 Hz</strong>
                                <span>8 - 14 August 2027</span></li>
                        </ul>
                        <span class="course-cta">Explore the courses <span aria-hidden="true">&rarr;</span></span>
                    </a>
            </div>
            <nav class="other-languages" aria-label="More languages">
                <a href="japan.php" lang="ja"><img
                        src="Images/Logos/Vlag_Japan.jpg" alt=""
                        width="28" height="20">コース案内（概要）</a>
                <a href="CZ_info.php" lang="cs"><img
                        src="Images/Logos/CZ-vlag.jpg" width="28" height="20"
                        alt="">Čeští účastníci vítáni</a>
            </nav>
            <footer class="landing-footer">
            <div class="landing-support">
                <p>This program has been made possible, in part, with support from</p>
                <a href="http://www.acmp.net" target="_blank"><img
                        src="/Images/Logos/ACMP_CMYK.jpg" width="200"
                        height="104" alt="ACMP" /></a>
            </div>
            <a class="landing-facebook"
                href="http://www.facebook.com/pages/La-Pellegrina/443675859011335"
                title="La Pellegrina on Facebook" target="_blank"><img
                    src="/Images/Logos/facebook_logo.png" alt="Facebook"
                    width="22" height="22" />La Pellegrina on Facebook</a>
            <div class="fb-like"
                data-href="http://www.facebook.com/pages/La-Pellegrina/443675859011335?ref=hl"
                data-send="true" data-layout="box_count" data-width="450"
                data-show-faces="true" data-font="verdana"></div>
            </footer>
        </div>
    </main>
    <!-- begin olark code -->
    <script data-cfasync="false" type='text/javascript'>
        /*<![CDATA[*/
        window.olark || (function(c) {
            var f = window,
                d = document,
                l = f.location.protocol == "https:" ? "https:" : "http:",
                z = c.name,
                r = "load";
            var nt = function() {
                f[z] = function() {
                    (a.s = a.s || []).push(arguments)
                };
                var a = f[z]._ = {},
                    q = c.methods.length;
                while (q--) {
                    (function(n) {
                        f[z][n] = function() {
                            f[z]("call", n, arguments)
                        }
                    })(c.methods[q])
                }
                a.l = c.loader;
                a.i = nt;
                a.p = {
                    0: +new Date
                };
                a.P = function(u) {
                    a.p[u] = new Date - a.p[0]
                };

                function s() {
                    a.P(r);
                    f[z](r)
                }
                f.addEventListener ? f.addEventListener(r, s, false) : f
                    .attachEvent("on" + r, s);
                var ld = function() {
                    function p(hd) {
                        hd = "head";
                        return ["<", hd, "></", hd, "><", i,
                            ' onl' + 'oad="var d=', g,
                            ";d.getElementsByTagName('head')[0].",
                            j, "(d.", h, "('script')).", k,
                            "='", l, "//", a.l, "'", '"', "></",
                            i, ">"
                        ].join("")
                    }
                    var i = "body",
                        m = d[i];
                    if (!m) {
                        return setTimeout(ld, 100)
                    }
                    a.P(1);
                    var j = "appendChild",
                        h = "createElement",
                        k = "src",
                        n = d[h]("div"),
                        v = n[j](d[h](z)),
                        b = d[h]("iframe"),
                        g = "document",
                        e = "domain",
                        o;
                    n.style.display = "none";
                    m.insertBefore(n, m.firstChild).id = z;
                    b.frameBorder = "0";
                    b.id = z + "-loader";
                    if (/MSIE[ ]+6/.test(navigator.userAgent)) {
                        b.src = "javascript:false"
                    }
                    b.allowTransparency = "true";
                    v[j](b);
                    try {
                        b.contentWindow[g].open()
                    } catch (w) {
                        c[e] = d[e];
                        o = "javascript:var d=" + g +
                            ".open();d.domain='" + d.domain + "';";
                        b[k] = o + "void(0);"
                    }
                    try {
                        var t = b.contentWindow[g];
                        t.write(p());
                        t.close()
                    } catch (x) {
                        b[k] = o + 'd.write("' + p().replace(/"/g,
                                String.fromCharCode(92) + '"') +
                            '");d.close();'
                    }
                    a.P(2)
                };
                ld()
            };
            nt()
        })({
            loader: "static.olark.com/jsclient/loader0.js",
            name: "olark",
            methods: ["configure", "extend", "declare", "identify"]
        });
        /* custom configuration goes here (www.olark.com/documentation) */
        olark.identify('5575-684-10-1480'); /*]]>*/
    </script>
    <noscript>
        <a href="https://www.olark.com/site/5575-684-10-1480/contact"
            title="Contact us" target="_blank">Questions? Feedback?</a> powered
        by <a href="http://www.olark.com?welcome"
            title="Olark live chat software">Olark live chat software</a>
    </noscript>
    <!-- end olark code -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html>