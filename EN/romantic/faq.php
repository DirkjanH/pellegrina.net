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
<!-- InstanceBegin template="/Templates/LP_EN.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <!-- CSS: -->
    <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
    <link rel="stylesheet" href="/css/faq.css" type="text/css">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Frequently Asked Questions: Romantic course</title>
    <!-- InstanceEndEditable -->
    <meta charset="UTF-8">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.EN.php'; ?>
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
    require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.EN.php';
    ?> <div id="main">
            <!-- InstanceBeginEditable name="mainpage" -->
            <h2 class="begin">Frequently Asked Questions: Romantic course</h2>
            <div class="w3-card-2 w3-padding faq-item"><B>How are chamber music ensembles
                    put together?</B> As soon as we know who is going to take
                part in the project, which is usually by April, we make two sets
                of chamber music ensembles for the morning program as every
                player takes part in two different ensembles. We try to take
                everyone's wishes into account putting these groups together. Of
                course, we cannot guarantee complete satisfaction. Every
                participant may put one of these ensembles themselves. For the
                other ensemble, let us know if you have any preferences.</div>
            <div class="w3-card-2 w3-padding faq-item"><B>The evenings are free. Is there
                    time to play together? </B>Oh yes. The fanatics return to
                the conservatoire after dinner to play in the numerous study
                rooms. These 'night ensembles' are usually formed on the spot,
                so don't forget to bring your favorite sheet music.</div>
            <div class="w3-card-2 w3-padding faq-item"><B>How should I pay?</B> <em>La
                    Pellegrina</em> offers two methods of payment. You may
                either transfer your payment into account NL60 BUNQ 2177 4957 25
                (BIC ASNB NL21) of <em>La Pellegrina</em>, Utrecht, the
                Netherlands. If this is not practical, payment in cash on the
                spot is also possible by mutual agreement. See the <a
                    href="praktisch.php" target="_self">Prices &amp; Practicals
                    page</a> for more information.</div>
            <div class="w3-card-2 w3-padding faq-item"><strong>How to travel to České
                    Budějovice?</strong> International trains now run again from
                the Netherlands and Germany, to Linz (Austria) or Prague. From
                both places, there are frequent trains to České Budějovice. It
                is also possible to fly to Prague and take the train from there.
                From České Budějovice railway station, it is an 800 meter walk
                to the conservatoire. It is possible to have luggage collected
                from the station.</div>
            <div class="w3-card-2 w3-padding faq-item"><B>How can I provide for a
                    cancellation insurance?</B> We advise you to carry a
                cancellation insurance through your own bank or insurance agent.
            </div>
            <div class="w3-card-2 w3-padding faq-item"><B>Is there any possibility of
                    travelling together? </B><I>La Pellegrina</I> only organizes
                the project, not the journey. But you may be able to find your
                travel partners as a list of participants will be available
                after the decision about participation,
                <strong><?php echo $cursusdata['beslisdatum']; ?></strong>.
            </div>
            <!-- InstanceEndEditable -->
            <h2><a href="javascript: history.go(-1)">Back</a></h2>
        </div>
    </div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
<!-- InstanceEnd -->
</html>