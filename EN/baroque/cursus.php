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
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Summer School "<?php echo $cursusdata['cursusnaam']; ?>"</title>
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
            <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/cursustitel.php'); ?>
            <div class="container">
                <h2><a name="programma"></a>The programme</h2>
                <p>The former monastery of Nieuw Sion in the Salland forests
                    near Deventer in the Netherlands is the venue for this
                    year's seven-day baroque course. This course has two
                    aspects: each morning we work in small ensembles of
                    singers and players of 'early' instruments, both vocal and
                    instrumental separately or in combination. Each afternoon we work together on a joint
                    program with baroque music from Central Europe. All singers and instrumentalists participate in this program.</p>
                <p class="citaat">Jeroen van Bergeijk: &quot;The ideal holiday
                    spending: many days of hard work in a monastery, immersed in
                    music, with an inspiring group of music lovers&quot;</p>
                <h3>Chamber music</h3>
                <div class="fotocenter w3-center"><img src="/Images/kamermuziek_NS.png" width="800"
                        alt="Chamber music ensemble performing" /><br>Chamber music ensemble performing</div>
                <p>Each morning of the course we work in small
                    ensembles. Everyone is part of two different pre-arranged
                    ensembles. The ensembles work most of the time under the intensive supervision of the
                    teachers. The ensembles present themselves to the other
                    participants at the end of the course. This year the focus
                    is on German, Austrian, Polish and Czech baroque music, but this is optional for
                    chamber music. Feel free to play or sing Italian, English or
                    French music in the small ensemble program.</p>
                <p>All formations from quartet upward are possible. The
                    ensembles will be assigned in April or May, so you can prepare at
                    home. Wishes for pieces and instrumentation are taken into account, within
                    the possibilities and restrictions of the course. The course is open
                    to individual participants and permanent ensembles. </p>
                <p> In the evenings those who still feel like it can form occasional chamber music combinations.
                    A number of rooms and keyboard instruments are available for this.</p>
                <p class="citaat">Lea Schuiling: &quot;Nice of course, doing a
                    piece like this for choir, soloists and orchestra. But the
                    chamber music is really an asset! Singers and
                    instrumentalists, one to a part, with coaching by all
                    teachers ... Something you rarely get the opportunity to do!
                    And when the teachers sometimes contradict each other, ..
                    well, .. that gives space&quot;</p>
                <h3>Baroque from Central Europe, program for all singers and instrumentalists</h3>
                <p>
                <div class="fotocenter w3-center"><img class="w3-image" src="/Images/concert_kloosterkerk.png" width="800" alt="Concert in de kloosterkerk"><br>Concert in the monastery church</div>Every afternoon, all singers and instrumentalists work together on the programme 'Baroque from Central Europe' for all,
                which is performed in the monastery church on the last course day as the culmination of the course. The program includes Biber's Requiem in F minor and Zelenka's Miserere in C minor ZWV 57. Of course, at first sectional rehearsals for the choir and orchestra and correpetition for the soloists will be held. Later in
                the week, all groups join forces to create a colorful and diverse ensemble, in which everyone has their
                own challenges. <a href="programma.php">Read more about the works and their musical and historical context here</a>.
                </p>
            </div>
            <p class="citaat">Andrew Fyson: &quot;Attending La Pellegrina and
                working with wonderful and enthusiastic musicians has been a
                life-changing experience for me.&quot;</p>
            <p>La Pellegrina provides sheet music for the programme for all in
                the form of links to PDF files which the participants can print
                out and bring.</p>
            <h3>Extras: Baroque dance and Tai Chi </h3>
            <div class="fotorechts"><img src="/Images/barokdans.png" alt="Baroque dance class" width="400"><br>Baroque dance class with Ricardo</div>
            <p>Baroque music cannot be seen separated from Baroque dance as it was
                practised at court. Thanks to sources with dance notation from
                the period, such as the writings of the dance masters Feuillet
                and Lorin, we can get a good idea of how dance was practised.
                The same basic technique was used both in social events and in
                theatrical dance at court ballets and in public theatres.
                Characteristically, on what musicians call the 'heavy counts',
                dancers go on their toes, i.e. upwards, making the dance
                infinitely light and graceful. A musician who has experienced
                this immediately plays differently, lighter and with more grace.
                Our teacher for the low strings, Ricardo Rodríguez Miranda,
                besides being a gambist, is also a dancer and teaches baroque
                dance at the Royal Conservatoire in The Hague. He will teach a
                workshop in the course and provide a warm-up with elements of
                Baroque dance each morning.</p>
            <p>Teacher Mitchell Sandler is not only a singer and all-round
                musician, but also a certified Tai Chi instructor. Every morning
                before breakfast, he does a Tai-Chi session with anyone who
                wants to join in.</p>
            <p class="citaat">Franca Post: "Very nice atmosphere, beautiful
                venue and wonderfully relaxing."</p>
            <div class="container">
                <h2><a name="voorwie"></a>For whom</h2>
                <div class="fotorechts"><img src="/Images/margarita.jpg"
                        alt="rehearsal in the castle hall" width="400"
                        height="533" class="w3-image" /><br /> Soprano in action
                </div>
                <h4><strong>Singers</strong></h4>
                <p>There is room for up to 16 experienced singers. To qualify
                    you must meet the following requirements:</p>
                <ul>
                    <li>You are a good sight reader and able to study parts
                        independently</li>
                    <li>You are experienced with ensembles for early music in
                        small ensembles (quartet, quintet)</li>
                    <li>You have a trained voice suitable for ensemble and solo
                        singing</li>
                    <li>You are interested in historical performance practice,
                        tuning systems and ornamentation </li>
                </ul>
                <h4><strong>Instrumentalists</strong></h4>
                <p>The maximum instrumental group size is 24. For instruments we
                    can place baroque strings, viola da gamba,
                    traverso/recorder, baroque oboe, baroque bassoon, baroque trumpet & trombone
                    harpsichord/organ, theorbo; period instruments only, tuning
                    pitch 415 Hz. </p>
                <p>To qualify you must meet the following requirements: </p>
                <ul>
                    <li>You are used to playing period instruments. Modern
                        string players are welcome, but are required to fit
                        their instrument with gut strings and play with a
                        baroque bow. It is possible to borrow baroque bows via
                        <em>La Pellegrina</em>.
                    </li>
                    <li>You are experienced in playing in small ensembles.</li>
                </ul>
                <p class="citaat">Harry Kragt: &quot;I melted for the music, not
                    because of the extreme temperatures. I have got the taste
                    for more&quot;</p>
            </div>
            <div class="container">
                <div class="fotolinks"><img src="/Images/carina.jpg"
                        alt="ensemble at work" width="400" height="600"
                        class="w3-image" /><br /> Musical concentration</div>
                <p class="citaat">Staffan Rudner: &quot;I think it was great
                    that the tutors also took part in the music as players.
                    Marco Vitale in particular, who dared to play the baroque
                    oboe despite not being professional on that instrument&quot;
                </p>
                <h2><a name="dagindeling"></a>Week programme and daily schedule
                </h2>
                <h4>Week programme</h4>
                <ul>
                    <li>Thursday morning August 13: arrival at Nieuw Sion, 10:30
                        course opening and first rehearsal</li>
                    <li>Tuesday August 18: final internal presentation of the
                        chamber music ensembles</li>
                    <li>Wednesday afternoon August 19: public concert with the
                        programme 'Baroque from Central Europe' in the monastery church,
                        followed by drinks and departure</li>
                </ul>
                <p class="citaat">Annelies Jans: &quot;Each morning two
                    rehearsals, each afternoon two rehearsals, and what we do on
                    our free evenings? Right, make music as much as
                    possible...!&quot;</p>
            </div>
            <div class="fotocenter"><img src="/Images/duo.png" width="800"
                    alt="Preparing parts toegether" class="w3-image" /><br />Preparing parts toegether</div>
            <h4>Daily Schedule</h4>
            <ul>
                <li>from 7:30 breakfast</li>
                <li>8:45 warm-up for singers and instrumentalists</li>
                <li>9:00 1st session working on music in small ensembles</li>
                <li>10:30 coffee break</li>
                <li>11:00 2nd session working on music in small ensembles</li>
                <li>12:30 lunch</li>
                <li>13:30 working on tutti-programme in sectional rehearsals</li>
                <li>15:00 tea break</li>
                <li>15:30 joint rehearsal tutti-programme</li>
                <li>17:00 drinks and dinner</li>
                <li>evening: free to spend; ample opportunity for occasional chamber music</li>
            </ul>
            <p class="citaat">Staffan Rudner: &quot;The tutors were able to
                adapt to the potential of all of us. After the course a new
                energy has come to our practicing and playing at home.&quot;</p>
            <div class="fotocenter"><img src="/Images/lunch.png" width="800"
                    alt="Lunch at the edge of the forest" class="w3-image" /><br>Lunch at the edge of the forest</div>
            <h2><a name="waar" id="waar"></a>Where</h2>
            <p>Nieuw Sion Monastery has been in existence since 1890. Until 2015, it was a Trappist monastery. In that year, the last eight monks closed the door behind them and found a new home on the island of Schiermonnikoog. The monastery was transferred for one euro to a foundation whose aim is to preserve the spiritual significance of the monastic community.</p>
            <p>Since then, all kinds of spiritual, cultural, and musical activities have taken place there. A growing number of people are seeking a monastic life centered on silence and spirituality. Three times a day, silent prayers are held in the monastery church. In addition, they tend to the large vegetable garden, run the brewery and coffee house, and organize a large number of activities, such as retreats, youth weekends, and the like. The income from all these activities pays for small renovations to the monastery. For example, new single and double rooms with private bathrooms are now available in the renovated Poortgebouw. More information can be found here:</p>
            <ul>
                <li><a href="https://indebuurt.nl/deventer/woning-van-de-week/binnenkijken-bij-klooster-nieuw-sion-de-monniken-zijn-verhuisd-maar-er-wonen-nog-wel-mensen~108570/"
                        target="_blank">An impression of the monastery</a> (in Dutch)</li>
                <li><a href="https://www.nieuwsion.nl/" target="_blank">Monastery website</a> (in Dutch)</li>
            </ul>
            <p class="citaat">Roeland Gerritsen: &quot;To make music on a high
                level (with qualified teachers AND students) at a unique
                location in Europe in a fantastic atmosphere, I can heartily
                recommend this to anyone&quot;</p>
            <h2><a name="metwie" id="metwie"></a>With whom</h2>
            <p>The tutors of this course are passionate specialists in their fields:
                <a href="docenten.php#horringa">Dirkjan&nbsp;Horringa</a>,
                <a href="docenten.php#huizinga">Femke&nbsp;Huizinga</a>,
                <a href="docenten.php#lindeijer">Hanna&nbsp;Lindeijer</a>,
                <a href="docenten.php#rodriguez">Ricardo&nbsp;Rodríguez&nbsp;Miranda</a>,
                <a href="docenten.php#sandler">Mitchell&nbsp;Sandler</a> and
                <a href="docenten.php#valorz">Edoardo&nbsp;Valorz</a>.
            </p>
            <h2><a name="inschrijven"></a>How to register</h2>
            <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/inschrijven.php'); ?>
            <h2><a href="javascript: history.go(-1)">Back</a></h2>
        </div>
    </div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

</html>