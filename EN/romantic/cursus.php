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
    <title>Summer School "<?php echo $cursusdata['cursusnaam']; ?>"</title>
    <meta charset="UTF-8">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.EN.php'; ?>
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

<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
    <div id="inhoud" class="w3-main"> <?php
                                        echo $navigatie;
                                        echo '<span class="w3-opennav w3-xxlarge w3-hide-large" onclick="w3_open()">☰</span>';
                                        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.EN.php';
                                        ?> <div id="main">
            <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/cursustitel.php'); ?>
            <div class="onzichtbaar" id="nog_plaats">
                <p>&nbsp;</p>
                <p>Places available for:</p>
                <ul>
                    <li>singers in all vocal groups, in particular tenors </li>
                    <li>a clarinet</li>
                    <li>a violin</li>
                    <li>a viola</li>
                </ul>
                <p class="nadruk">Last minute reduction possible. Call +31 619
                    224 758 for information </p>
                <p>&nbsp;</p>
            </div>
            <h2><a name="programma"></a>The music</h2>
            <p>For 36 years, <em>La Pellegrina </em>has annually organised a
                summer course for instrumentalists and (choral) singers in
                Czechia. This course has two aspects: chamber music or chamber
                choir, and a joint programme for soloists, orchestra and choir.
                The summer school takes place in the conservatoire of České
                Budějovice. České Budějovice, also known by its German name
                Budweis, is a friendly town where the proximity to Austria is
                palpable. The conservatory has recently undergone extensive
                renovation, with air condition in the concert hall. There are excellent grand pianos in the classrooms
                and fine facilities for making music. So anyone who always dreamt of studying at a
                conservatoire can still do so!</p>
            <p> In the same building there is accommodation in the school hostel, with simple but clean single
                and double rooms, each with its own shower and toilet. In addition, there is a choice of hotels in various price ranges in
                the area. </p>
            <h3>Chamber music &amp; chamber choir</h3>
            <div class="fotorechts"><img src="/Images/fluittrio.jpg"
                    alt="instrumentalists" width="500" height="334"
                    class="w3-image" /><br />
            </div>
            <p>The mornings are devoted to small ensembles. Every participant
                will be assigned to two different ensembles, alternating per
                day. At least half of the time the ensembles receive intensive
                coaching by the tutors. The ensembles will have an opportunity
                to present themselves in an internal concert.</p>
            <p class="citaat" dir="ltr">Rob Klotz: If I have to have an
                addiction, going to La Pellegrina is my drug of choice</p>
            <p>Instrumentalists take part in chamber music in all possible
                combinations of string and winds, with or without piano. All
                formations from quartet upward are possible, with perhaps a few
                incidental trios. Ensembles will be formed well in advance, so
                you can prepare your parts thoroughly at home. Very advanced
                singers (<a href="#solozang">see the description here</a>) may
                also participate in this. There is also the unique possibility
                to form larger and more complex combinations, also with winds,
                that are not easy to organize 'at home'. Think of Schubert's
                Octet, the Spohr Nonet and the Allegro for four string quartets
                by the Dutch romantic composer Van Bree.</p>
            <p class="citaat">Yo van Dijk: &quot;What I jumped into with some
                cold feet turned out to be a pleasant warm bath of enthusiastic
                musicians. For a moment you are in another world, a more
                beautiful one without worries&quot; </p>
            <p>Each morning the singers form a chamber choir and work on music
                for chamber choir, a cappella and with piano. Some singers can
                form combinations with instruments. For instance, a soprano
                could do Schubert's <em>Hirt auf dem Felsen </em>or Spohr's
                <em>Lieder </em>for voice, clarinet and piano. A baritone could
                work on Barber's <em>Dover Beach</em> with a string quartet. A
                few more suggestions: Pergolesi's <em>Stabat Mater</em> with
                strings, Mozart and Haydn <em>Lieder </em>for several voices and
                piano, Telemann's <em>Harmonischer Gottesdienst</em>, Schubert's
                <em>Hochzeitsbraten</em> or other Schubert works for several
                voices and piano, etc., etc.
            </p>
            <p>The course is open to individual participants as well as existing
                ensembles. </p>
            <p>There will be time for occasional combinations and musical
                get-togethers. A special evening will be the <em>Mozart Concerto
                    Event</em>, where pianists and other instrumentalists are
                invited to prepare a movement from a concerto by Mozart or a
                contemporary and the other instrumentalists are asked to
                accompany, sight-reading the orchestral parts.</p>
            <p class="citaat">Anke Muusse: “I really enjoyed my first musical
                pellegrina week because of the level of the course, the variety
                of chamber music and tutti program, the guidance by good coaches
                and the wonderful music!”</p>
            <div class="container">
                <h3>The programme for soloists, choir and orchestra: Dvořák &
                    Haydn </h3>
                <div class="fotolinks"><img
                        src="\Images\Locaties\Budejovice\black-tower-st-nicholas-cathedral-ceske-budejovice.jpg"
                        alt="Cathedral with Black Tower" width="400"
                        class="w3-image"><br> České Budějovice cathedral</div>
                <p>Each afternoon we work on a programme for choir and
                    orchestra, which is performed publicly as the conclusion of
                    the course. This year, this final concert will feature a
                    program of two works, namely the <em>Missa in tempore
                        belli</em> by Joseph Haydn for soloists, choir and
                    orchestra. In addition the orchestra is working on the
                    symphonic poem <em>The Golden Spinning Wheel</em> by Dvořák.
                    <a href="programma.php">Read more about the works and their
                        musical and historical context here</a>. The concert
                    will take place in the magnificent and magnificently
                    sounding České Budějovice monastery church. On the 14st of
                    June we'll slap a first coat of paint on the music, as
                    preparation for the summer, in Den Dolder near Utrecht. Of
                    course this rehearsal is not mandatory for people not living
                    in the Netherlands, but some foreign participants tend to
                    show up, combining the rehearsal with a trip or visiting
                    friends. They are of course most welcome.
                </p>
            </div>
            <p class="citaat">Anke Wolffes: &quot;The rehearsals were very
                pleasant. Dirkjan manages every year to be ambitious and
                motivating, yet relaxed in his way of working with us&quot; </p>
            <h2><a name="voorwie"></a>For whom</h2>
            <h4>Choir</h4>
            <div class="fotolinks"><img src="/Images/Mitchell en koor.jpg"
                    alt="" width="500" height="334" /><br> Mitchell Sandler and
                his chamber choir</div>
            <p>The course is open to 32 experienced chamber choir singers
                (SATB). The choir has a big and challenging part in de <em>Missa
                    in tempore belli</em>. In addition, the choristers form a
                chamber choir every morning and work on music by Mendelssohn,
                Dvořák, Mozart and their Czech contemporaries. Mitchell Sandler
                will lead this choir in his inimitable way, combining helpful
                vocal instructions and excellent piano accompaniment with clear
                direction. Czech professional singers, in particular tenors and
                basses, will join the choir if the balance between the various
                voice groups needs it.</p>
            <p class="citaat">Marrie Kardol &quot;Pellegrina has become one of
                my best and healthiest addictions!&quot;</p>
            <div class="container" style="clear: both">
                <h4><a name="solozang"></a>Solo singers</h4>
                <div class="fotorechts"><img src="/Images/zangcoaching.jpg"
                        alt="singer being coached" width="400"
                        class="w3-image" /><br /> A singer being coached</div>
                <p>Are you a vocal student or recent graduate, or a talented
                    amateur at an equivalent level, and enjoy singing as a
                    soloist? Do you have the independence and dexterity to study
                    a part and would like to sing with an instrumental ensemble?
                    If so, it is possible that you will be part of one of the
                    chamber music ensembles in the morning sessions.</p>
                <p> We would like to hear you. This will give us an idea of how
                    to place you within the course – to know which part might be
                    appropriate for you in the chamber music. Please make a
                    recording of your singing and send it to <em>La Pellegrina
                    </em>as CD, MP3 or YouTube clip.</p>
            </div>
            <p class="citaat">Yolande Krooshof: &quot;I have persuaded three
                people to join the course, eerie, but they all have enjoyed
                it!&quot;</p>
            <div class="container">
                <div class="fotolinks"> <img
                        src="/Images/tevreden_instrumentalist.jpg" alt="Chris"
                        width="400" height="332" class="w3-image"><br> A happy
                    horn player</div>
                <h4>Instrumentalists</h4>
                <p>The course in intended for experienced chamber music players,
                    willing to prepare their parts at home. Pianists are able to
                    play solo parts. The number of participants in this course
                    is determined by the orchestral works: there is room for
                    double woodwinds, two horns, timpani and strings 8-8-6-6-3
                    or a few more. In the chamber music, there is room for four
                    pianists. They play in the chamber music ensembles,
                    accompany singers in their arias and may even play timpani
                    or other percussion in the orchestra, or sing in the choir.
                    For the other instruments in the orchestra, such as harp,
                    trumpets, trombones and tuba, we hire Czech professionals.
                </p>
                <p class="citaat">Christine Achten: &quot;A week of letting go
                    of everything and immersing yourself in a bath of beautiful
                    music, hard work, having fun, experiencing beauty , fine
                    social contacts, beautiful nature...that's what I call a
                    holiday!&quot;</p>
                <a href="cursus.php" target="_self"></a>
            </div>
            <h2><a name="kennismaking"></a>Introductory rehearsal</h2>
            <p> On Saturday, 1 June, a preliminary rehearsal day will be held in
                Den Dolder near Utrecht. Of course this rehearsal is not
                obligatory for participants from outside the Netherlands. Still,
                quite often a few participants not living in the Netherlands
                turn up, combining it with a weekend sightseeing or visiting
                friends. Mitchell Sandler and Dirkjan Horringa will lead this
                rehearsal day. Its aim is to get to know the other participants,
                and to have a first go at the choral and orchestral programme,
                so you can then prepare your part more efficiently. More
                information on the venue and times will follow. Beside that, it
                is inspiring to meet your 'chamber music colleagues' and to
                discuss the work your are going to play or sing.
            <p class="citaat">Marieke van Dantzig: &quot;forging a beautiful
                whole out of a weird combination of people, styles and musical
                skills in a short time: that is the magic of inspirator
                Dirkjan&quot;</p>
            <h2><a name="dagindeling"></a>Week programme and daily schedule</h2>
            <h4>Week programme</h4>
            <ul>
                <li>Thursday 30 July: arrival in České Budějovice, course
                    opening with dinner at 18:00 h, first rehearsal for
                    soloists, choir and orchestra in the evening</li>
                <li>Friday evening 31 July: tutors' chamber music concert</li>
                <li>Tuesday 4 August: 'free day'</li>
                <li>Wednesday evening 5 August <em>Mozart Concerto Event</em>:
                    participants play solo in movements from Mozart concertos, a
                    vue accompanied by the orchestra</li>
                <li>Friday afternoon and evening 7 August: participants' chamber
                    music concerts</li>
                <li>Saturday 8 August: final, public concert of choir and
                    orchestra at the cathedral</li>
                <li>Sunday morning 9 August: departure after breakfast</li>
            </ul>
            <div class="fotocenter"> <img
                    src="/Images/Mozart Concerto Event 1.jpg" width="400"
                    height="267" alt="" />&nbsp;&nbsp;&nbsp;<img
                    src="/Images/Mozart Concerto Event 2.jpg" width="400"
                    height="267" alt="" /><br> Mozart Concerto Event: orchestra
                sightreads accompaniment | content soloist</div>
            <p class="citaat">François Lanave: &quot;I was the only
                French-speaking person at breakfast among musicians speaking a
                strange language with raspy 'g' sounds. But they immediately
                turned nicely into English, so that we could communicate&quot;
            </p>
            <div class="fotocenter"><img src="/Images/pauze.jpg" alt="interval"
                    width="640" height="427" border="1"
                    class="w3-image" /><br /> Interval in the monastery
                courtyard</div>
            <h4>Daily schedule</h4>
            <ul>
                <li> 8:00 breakfast</li>
                <li> 9:30-12:30 Instrumentalists and singers rehearse chamber
                    music in small ensembles and chamber choir</li>
                <li> 13:00 lunch</li>
                <li>14:30 the orchestra first works in sectional rehearsals,
                    later also in full ensemble; the choir works at first
                    separately on Haydn's <i>Missa in tempore belli</i>. Later
                    in the week, choir and orchestra rehearse together </li>
                <li>17:30 drinks and dinner</li>
                <li> Evening off, plenty of time for playing more chamber music,
                    and don’t forget that Czechia is famous for its beer...</li>
            </ul>
            <p class="citaat"><span tabindex="-1" id="result_box3"
                    lang="en"></span>Robert Beverly: &quot;Pellegrina is a
                supportive and exhilarating musical experience for serious
                amateur musicians who are willing to work hard toward the goal
                of a polished public performance&quot;</p>
            <div class="fotocenter"> <img
                    src="../../Images/2018-02-10-LPPO-Schöpfung-Utrecht.jpg"
                    width="800" height="302" alt="" /><br> Performing Haydn's
                Creation during a repeat concert in Utrecht in 2018 <br>
            </div>
            <h2><a name="waar"></a>Where </h2>
            <p>Read more about České Budějovice, the place where the course will
                be held:</p>
            <ul>
                <ul>
                    <li><a href="plaats.php">České Budějovice, the town</a></li>
                    <li><a href="route_plek.php">Travel options and initerary to
                            České Budějovice</a></li>
                </ul>
            </ul>
            <p class="citaat">Casper van Dongen: “Beautiful music at Czech high
                level for amateurs in the conservatoire of a beautiful Bohemian
                city: an annual feast! <i>La Pellegrina</i> has been my annual
                'therapy' for almost 20 years now... Where do you make music
                with such variety and where do you drink your beer in such a
                beautiful setting?”</p>
            <div class="fotocenter"><img src="/Images/bazooka.jpg"
                    alt="Ensemble" width="640" height="424"
                    class="w3-image"><br> Joy after the chamber music concert
            </div>
            <h2><a name="metwie"></a>With whom</h2>
            <p>The tutors of this course are passionate specialists in their
                musical fields: <a href="docenten.php#bernaskova">Martina
                    Bernášková</a>, <a href="docenten.php#Pbernasek">Petr
                    Bernášek</a>, <a href="docenten.php#horejsi">Pavel
                    Hořější</a>, <a href="docenten.php#horringa">Dirkjan
                    Horringa</a>, <a href="docenten.php#novacek">Libor
                    Nováček</a>, <a href="docenten.php#sandler">Mitchell
                    Sandler, </a><a href="docenten.php#sternadel">Rudolf
                    Sternadel</a> and <a href="docenten.php#vlasankova">Jitka
                    Vlašánková</a>.</p>
            <h2><a name="inschrijven"></a>How to register</h2>
            <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/inschrijven.php'); ?>
            <!-- InstanceEndEditable -->
            <h2><a href="javascript: history.go(-1)">Back</a></h2>
        </div>
    </div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
<!-- InstanceEnd -->

</html>