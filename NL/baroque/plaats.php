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
<!-- InstanceBegin template="/Templates/LP_NL.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <!-- CSS: -->
    <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title><?php echo $cursusdata['plaats_kort'] ?>, plaats van handeling
    </title>
    <!-- InstanceEndEditable -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.NL.php'; ?>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
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
                                        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.NL.php';
                                        ?> <div id="main">
            <!-- InstanceBeginEditable name="mainpage" --> <?php //require_once $_SERVER['DOCUMENT_ROOT'].'/NL/budejovice.php'; 
                                                            ?> <div class="fotocenter"><img
                    src="/Images/Locaties/Nieuw Sion/Nieuw Sion.jpg"
                    class="w3-image" alt="Klooster Nieuw Sion" /></div>
            <p>Klooster Nieuw Sion bestaat sinds 1890 en was tot 2015 een
                trappistenklooster. De laatste monniken trokken toen de deur
                achter zich dicht en vonden een nieuwe plek op Schiermonnikoog.
                Sindsdien vindt er een breed scala van spirituele, maar ook
                culturele en muzikale activiteiten plaats. </p>
            <p> Een groeiend aantal mensen streeft naar een kloosterleven waarin stilte en spiritualiteit
                centraal staan. Driemaal daags zijn er stiltegebeden in de
                kloosterkerk. Daarnaast verzorgen ze de grote groentetuin,
                houden de brouwerij en het koffiehuis draaiende en organiseren
                een groot aantal activiteiten, zoals retraites, jeugdweekenden
                weekenden en dergelijke. </p>
            <p>De inkomsten van al deze activiteiten
                jaar betalen kleine reconstructies van het klooster. Er zijn nu bijvoorbeeld nieuwe een- en tweepersoonskamers met eigen badkamer beschikbaar in het gerenoveerde Poortgebouw.Meer informatie vind
                je hier:</p>
            <ul>
                <li><a href="https://indebuurt.nl/deventer/woning-van-de-week/binnenkijken-bij-klooster-nieuw-sion-de-monniken-zijn-verhuisd-maar-er-wonen-nog-wel-mensen~108570/"
                        target="_blank">Een sfeer-impressie van het klooster</a>
                </li>
                <li><a href="https://www.nieuwsion.nl/" target="_blank">Website
                        van het klooster</a>
                </li>
            </ul>
            <div class="fotocenter"><img
                    src="/Images\Locaties\Nieuw Sion\Kerk NS.jpg"
                    class="w3-image"
                    alt="De kloosterkerk, waar het slotconcert plaatsvindt" /><br>
                De kloosterkerk, waar het slotconcert plaatsvindt<div
                    class="fotocenter"><img src="/Images/NS/refter.jpg"
                        class="w3-image"
                        alt="De refter, waar repetities en het kamermuziekconcert plaatsvinden" /><br>
                    De refter, waar repetities en het kamermuziekconcert
                    plaatsvinden <div class="fotocenter"> <img
                            src="/Images/NS/Hobo band.jpg" class="w3-image"
                            alt="Oboe band aan het werk" /><br> Oboe band aan
                        het werk</div>
                    <div class="fotocenter"> <img
                            src="/Images/NS/dejeuner_dans_l'herbe.jpg"
                            alt="Lunch en diner vinden buiten plaats, als het weer het toelaat"
                            width="950" height="633" class="w3-image" /><br> De
                        lunch en het diner vinden doorgaans buiten plaats</div>
                    <div class="fotocenter"><img
                            src="/Images/Locaties/Nieuw Sion/luchtfoto.jpg"
                            class="w3-image"
                            alt="Luchtfoto van het klooster Nieuw Sion" />Luchtfoto
                        van het klooster Nieuw Sion</div>
                </div>
                <!-- InstanceEndEditable -->
                <h2><a href="javascript: history.go(-1)">Terug</a></h2>
            </div>
        </div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
<!-- InstanceEnd -->

</html>