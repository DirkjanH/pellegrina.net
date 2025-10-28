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
    <title>Dvořák's cantata The Spectre's Bride</title>
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
    <div id="inhoud" class="w3-main"> <?php
                                        echo $navigatie;
                                        echo '<span class="w3-opennav w3-xxlarge w3-hide-large" onclick="w3_open()">☰</span>';
                                        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.NL.php';
                                        ?>
        <div id="main">
            <div class="cols2">
                <h2>Programme details</h2>
                <h3>Dvořák - The Spectre's Bride</h3>

                <p><div class="fotolinks w3-image"><img src="/Images/Dvorak.jpg" alt="Antonín Dvořák" width="250"><br>Antonín Dvořák</div>Antonín Dvořák's dramatic ballad <i>The Spectre's Bride</i> composed in 1883 is a work with a powerful musical impact.

                    The enthusiasm of English audiences for large-scale vocal works led to
                    Dvořák being commissioned in November 1883 to write a cantata for
                    soloists, chorus and orchestra for the 1885 Birmingham Musical Festival. He
                    himself conducted the first two performances on 28 and 29 March 1885 in
                    Plze&#328;. The English premiere took place on 27 August 1885, again under
                    Dvořák's direction. The new work was enthusiastically received. In the
                    many reviews the assessment of <i>The Spectre's Bride</i> was extremely
                    positive.</p>

                <p>For his work, Dvořák chose the ballad <i>Svatební
                        košile</i> (which literally translates as The Bride's Nightgown) by the Czech
                    poet Karel Jaromír Erben (1811 - 1870). Erben's <i>Kytice</i> (Bouquet)
                    collection of fairy tales inspired Dvořák more often, for example for his
                    cycle of symphonic poems, <i>The Water Goblin</i>, <i>The Noon Witch</i>, <i>The
                        Golden Spinning Wheel</i> and <i>The Wild Dove</i>. In these four poems, as in <i>The
                        Spectre's Bride</i>, Dvořák assigns specific musical themes and even
                    instruments for important characters and events in the drama. For example the
                    bass clarinet, a new invention at the time, is always reserved for spooky,
                    ghastly moments in the story.</p>

                <div class="fotocenter"><img src="/Images/svatebni_kosile.png" alt="The Spectre's Bride"><br>The Spectre's Bride</div>
                <p>The ghostly ballad <i>Svatební košile</i> is
                    a turmoil of emotions encompassing longing, horror, hope, doubt and, at the
                    end, relief. The tale told is one of a wild and furious nocturnal hunt, through
                    sludgy swamps and over bare rocks, passing by gloomy, glimmering will o' the
                    wisps and dogs howling threateningly. In the opening soprano monologue the girl
                    thinks of her beloved who left to travel abroad. She prays to the Virgin Mary
                    that he return safely and, at the end of the scene, expresses the blasphemous
                    thought that, if he did not return, she would rather die. Then a living corpse
                    appears at the parlour window, pretending to be the girls beloved, and he
                    invites her to his home. She then sets out with him on a terrible journey
                    through the night landscape, during which the dead man gradually throws away
                    the objects the girl has taken with her: a little cross, a rosary and a prayer
                    book. The couple finally arrive at the place the corpse calls his home - a
                    cemetery. It is only now that the girl realises her mistake and she is saved by
                    uttering a prayer of apology to the Virgin Mary and by the appearance of the
                    first rays of the sun announcing the new day.</p>

                <p>The form of the cantata was determined by
                    the nature of the text: the dialogue between the girl and the corpse is sung by
                    solo soprano and tenor; the role of the narrator is entrusted to the solo
                    baritone and mixed choir. The extensive work precisely follows the sequence of
                    scenes as they appear in the ballad.</p>

                <p>The ballad is divided into 18 numbers
                    (mainly linked in the composition through attacca transitions) which are
                    grouped according to the various scenarios in the story into three parts
                    (Introduction up to no. 4, nos. 5-12 and nos. 13-18). Diverging from the
                    literary model, which envisaged a single narrator to recite the whole text,
                    Dvořák assigned most of the text passages in which the protagonists
                    'speak' to the solo roles of the girl (soprano) and the dead bridegroom
                    (tenor). In addition, the function of the narrator is taken jointly by a solo
                    part (bass or baritone) and the chorus. The orchestra also has a very important
                    role. It conveys the epic-dramatic expression of the musical progress,
                    complementing the vocal parts, and is the bearer of the musical action. Only in
                    two numbers does a lyrical style come to the fore, both times in the two arias
                    of the girl (no. 2 and no. 17). These are conceived as prayer scenes and mark
                    inner turning points which slow down the forward movement, at the same time
                    eliciting decisive transformations.</p>

                <p>Erben's poem has a powerful plot with
                    numerous dramatic situations which offer all kinds of opportunities for a
                    highly contrastive musical depiction of the individual scenes and characters. Dvořák
                    makes use of this, employing his inexhaustible source of imagery without losing
                    sight of the requirement for overall structural unity and conciseness. He found
                    great inspiration in the stirring rhythms of Erben's verse, whose impact he was
                    able to reinforce through his music. The work retains its homogeneity throughout
                    thanks to the motif of descending fifths which winds its way through the
                    individual sections. Dvořák's musical setting demonstrates a clear
                    understanding of the text and a flawless synthesis of music and verse. The
                    cantata is typical for its dramatic expression, inventive melodies and unusual
                    rhythms, all told, a supreme example of the composer's creative genius.</p>

                <h2><a href="javascript: history.go(-1)">Back</a></h2>
            </div>
        </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html>