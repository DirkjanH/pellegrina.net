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
    <title>Vaak gestelde vragen: romantische cursus</title>
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
            <!-- InstanceBeginEditable name="mainpage" -->
            <h2 class="begin">Vaak gestelde vragen: romantische cursus</h2>
            <div class="w3-card-2 w3-padding"><b>Hoe worden de
                    kamermuziekensembles samengesteld?</b> Als de bezetting van
                het project definitief is, meestal in de loop van april, dan
                worden er twee sets van kamermuziekensembles voor het
                ochtendprogramma samengesteld. Iedereen speelt namelijk in twee
                verschillende ensembles. Bij het samenstellen wordt rekening
                gehouden met wensen van deelnemers. Iedereen mag één ensemble
                zelf samenstellen; voor het andere ensemble mogen wensen worden
                doorgegeven. <i>La Pellegrina </i>streeft ernaar die te
                honoreren, maar kan dat niet garanderen.</div>
            <div class="w3-card-2 w3-padding"><b>De avonden zijn vrij. Wordt er
                    dan ook muziek gemaakt?</b> De echt fanatieke deelnemers
                gaan na het eten terug naar het conservatorium om in de vele
                repetitieruimtes te musiceren. Deze ensembles vormen zich
                meestal ter plekke. Het is aan te raden om je eigen bladmuziek
                mee te nemen.</div>
            <div class="w3-card-2 w3-padding"><b>Hoe kan ik betalen?</b> <i>La
                    Pellegrina</i> accepteert betalingen via rekening NL33 ASNB
                0707 2500 72 (voor buitenlandse betalingen: BIC BUNQ NL2A)
                t.n.v. La Pellegrina te Utrecht. Als dit niet praktisch is, is
                betaling in contanten ter plekke in overleg ook mogelijk.</div>
            <div class="w3-card-2 w3-padding"><strong>Hoe wordt er gereisd naar
                    České Budějovice?</strong> Vanuit Nederland en Duitsland
                gaan er inmiddels weer internationale treinen, naar Linz
                (Oostenrijk) of Praag. Vanuit beide plaatsen gaan er frequente
                treinen naar České Budějovice. Het is ook mogelijk te vliegen
                naar Praag en vanaf daar de trein te nemen. Vanaf het station
                van České Budějovice is het 800 meter lopen naar het
                conservatorium. Het is mogelijk om je bagage op te laten halen
                bij het station.</div>
            <div class="w3-card-2 w3-padding"><b>Hoe kan ik een
                    annuleringsverzekering afsluiten?</b> Het is aan te raden
                een annuleringsverzekering af te sluiten. Dit kan via de eigen
                verzekeringsagent of bank.</div>
            <div class="w3-card-2 w3-padding"><b>Is het mogelijk om samen te
                    reizen?</b>
                <i>La Pellegrina</i> organiseert de reis niet. Maar om mensen
                die graag samen willen reizen met elkaar in contact te brengen,
                wordt na het beslismoment over deelname,
                <strong><?php echo $cursusdata['beslisdatum']; ?></strong>, een
                deelnemerslijst gepubliceerd.
            </div>
            <!-- InstanceEndEditable -->
            <h2><a href="javascript: history.go(-1)">Terug</a></h2>
        </div>
    </div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
<!-- InstanceEnd -->
</html>