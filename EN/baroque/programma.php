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
  <title>Purcell & Handel</title>
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
        <h2>Programme details</h2>
        <p>This year's programme for all focuses on music with a
          relation to the patroness of music, Saint Cecilia: two
          Cecilian Odes by Purcell and two works by&nbsp; Handel. This
          is a lot of music, too much to perform in one concert. A
          selection of about an hour will be made from these works
          according to the number and abilities of the singers, so
          that everybody can have a substantial solo. The resulting
          programme will be performed as the culmination of the
          course, this year again in the church of the Nieuw Sion
          monastery.</li>
        <h4>Saint Cecilia</h4>
        <div class="fotocenter"><img src="/Images/cecilia.jpg"
            alt="Saint Cecilia"><br>Saint Cecilia - painting by
          Guercino</div>
        <p>Saint Cecilia is known as patroness saint of music in the
          Christian tradition. Saint Cecilia’s connection to music
          stems not from her historical deeds but from symbolic
          interpretations of her legend. According to the *Passio
          Sanctae Caeciliae*, a fictionalized 5th-century account, her
          life revolved around steadfast devotion and martyrdom. The
          narrative focuses on her faith, miraculous survival in a
          heated bath, and eventual beheading—hardly a musical tale.
          </li>
        <p>So the question remains: what does Cecilia have to do with
          music? Here's the thing: in her passio it says the following
          about her wedding day: <i>Cantantibus organis illa in corde
            suo soli Domino decantabat</i>: while the instruments
          (of the wedding festivities) were playing, she sang in her
          heart only to the Lord. In the Middle Ages, the Latin as an
          antiphon text was slightly abbreviated and moreover
          mistranslated: While playing the organ, she sang to the
          Lord. And this is also how she was depicted: Cecilia with
          her organ. Later it could also be a violin, a cello or
          theorbo. These depictions played a key role in transforming
          her into the patroness of music.</li>
        <h4>English Resistance and Revival</h4>
        <p>For much of England’s history, Cecilia’s veneration remained
          dormant, suppressed by Protestant reluctance to honor
          saints. However, in the late 17th century, a sudden surge of
          interest emerged, driven by a new cultural phenomenon: the
          Cecilian ode.</li>
        <p>In 1683, composer Henry Purcell and poet Christopher Fishburn
          inaugurated a tradition of celebrating Cecilia with musical
          odes on her feast day. Their works praised her as a muse of
          music, blending secular and sacred elements. This movement
          coincided with the rise of public concerts and the
          institutionalization of music societies, such as the Musical
          Society of London.</li>
        <p>The Cecilian ode became an annual tradition, attracting some
          of the greatest poets and composers of the time. John
          Dryden’s *A Song for St Cecilia’s Day* (1687) and
          *Alexander’s Feast* (1697) are among the most famous
          contributions, with grand musical settings by Purcell and
          later by George Frideric&nbsp; Handel. These works elevated
          Cecilia’s feast day into a celebration of music’s divine
          power, transforming it into a distinctly English tradition.
          </li>
        <p>
        <div class="fotolinks"><img src="\Images\purcell.jpg"
            alt="Henry Purcell" width="250"><br>Henry Purcell</div>
        Purcell contributed two Odes to St. Cecilia: <i>Welcome to all
          the pleasures</i> (Z.339) was written by Purcell to a text
        by Christopher Fishburn in 1683. The second, <i>Hail! Bright
          Cecilia </i>(Z.328), also known as The Ode to St. Cecilia,
        was composed to a text by the Irishman Nicholas Brady in 1692.
        </li>
        <h4>Purcell - Welcome to all the pleasures</h4>
        <p>The first ode, <i>Welcome to all the pleasures, </i>is scored
          for vocal soloists, chorus and an ensemble of four-part
          strings and basso continuo. As well as accompanying the
          singers, the instruments feature in an overture (called
          &quot;symphony&quot;) and ritornelli. The piece takes about
          18 minutes to perform.</p>
        <h5>Movements</h5>
        <ol>
          <li>Symphony</li>
          <li>Verse (alto, tenor, bass), chorus &amp; ritornello:
            &quot;Welcome to all the Pleasures&quot;</li>
          <li>Song (alto) &amp; ritornello: &quot;Here the deities
            approve&quot; (one of the best-known numbers)</li>
          <li> Verse (two sopranos and tenor) &amp; ritornello:
            &quot;While joys celestial their bright souls
            invade&quot;</li>
          <li>Song (bass) &amp; chorus: &quot;Then lift up your
            voices&quot; </li>
          <li>Verse (bass) &amp; chorus: &quot;Then lift up your
            voices&quot; </li>
          <li> Instrumental interlude</li>
          <li>Song (tenor) &amp; ritornello: &quot;Beauty, thou scene
            of love&quot;</li>
          <li>Song (tenor) &amp; chorus: &quot;In a consort of voices
            while instruments play&quot;</li>
        </ol>
        <h4>Purcell - Hail! Bright Cecilia</h4>
        <p>The second ode, <i>Hail! Bright Cecilia, </i>is scored for
          vocal soloists, chorus and an ensemble of two recorders,
          bass recorder, two oboes, two trumpets, timpani, four-part
          strings and basso continuo. With a text full of references
          to musical instruments, the work is scored for a variety of
          vocal soloists and obbligato instruments, along with strings
          and basso continuo. For example, <i>Hark, each Tree</i> is a
          duet between, vocally, soprano and bass, and instrumentally,
          between recorders and violins. These instruments are called
          for in the text (&quot;box and fir&quot; being the woods
          from which they are made). However, Purcell did not always
          follow Brady's cues exactly. He scored the warlike music for
          two brass trumpets and copper kettle drums instead of the
          fife mentioned by Brady.</li>
        <h5>Movements</h5>
        <ol>
          <li>Symphony (overture):
            Introduction—Canzona—Adagio—Allegro—Grave—Allegro
            (repeat)</li>
          <li>Recitative (bass) and chorus: &quot;Hail! Bright
            Cecilia&quot;</li>
          <li>Duet (treble [though range would suggest alto] and
            bass): &quot;Hark! hark! each tree&quot;</li>
          <li>Air (countertenor): &quot;'Tis nature's voice&quot;</li>
          <li>Chorus: &quot;Soul of the world&quot;</li>
          <li>Air (soprano) and chorus: &quot;Thou tun'st this
            world&quot;</li>
          <li>Trio (alto, tenor and bass): &quot;With that sublime
            celestial lay&quot;</li>
          <li>Air (bass): &quot;Wondrous machine!&quot;</li>
          <li>Air (countertenor): &quot;The airy violin&quot;</li>
          <li>Duet (countertenor and tenor): &quot;In vain the am'rous
            flute&quot;</li>
          <li>Air (countertenor): &quot;The fife and all the harmony
            of war&quot;</li>
          <li>Duet (two basses): &quot;Let these among themselves
            contest&quot;</li>
          <li>Chorus: &quot;Hail! Bright Cecilia, hail to thee&quot;
          </li>
        </ol>
        <h4>Handel - Te Deum &amp; Jubilate</h4>
        <p>
        <div class="fotolinks"><img src="\Images\handel.jpg"
            alt="George Frederick Handel" width="250"><br>George
          Frederick Handel</div>Handel’s <i>Te Deum &amp; Jubilate
        </i>were written to celebrate the Treaty of Utrecht in 1713. It
        was his first major sacred work on English texts.&nbsp; Handel
        followed the models of Henry Purcell's 1694 Te Deum and Jubilate
        with strings and trumpets, which was regularly performed on
        official occasions at St Paul's even after the composer's death,
        and a 1709 setting by William Croft. As in these models,&nbsp;
        Handel composed a combination of two liturgical texts, the
        Ambrosian hymn Te Deum, We praise thee, O God, and a setting of
        Psalm 100, O be joyful in the Lord, all ye lands, which is a
        regular hymn of praise in Anglican morning prayer.&nbsp;
        Handel's work was first performed at a public rehearsal on March
        5, 1713, in St Paul's Cathedral. The official premiere took
        place after the difficult peace negotiations were completed, in
        a solemn thanksgiving service on July 7, 1713.&nbsp;</li>
        <p>The <i>Te Deum &amp; Jubilate</i> are festively scored for
          six soloists (two sopranos, two altos, tenor and bass),
          mixed choir, two trumpets, flauto traverso, two oboes,
          bassoon, strings and basso continuo. The choir is in five
          parts (SSATB) for most of the movements, but occasionally
          alto and tenor are divided as the soprano; the final
          doxology begins in eight parts. Almost all movements are set
          for solo singers and chorus; there are no real arias.</li>
        <h4>Te Deum</h4>
        <ol>
          <li>We praise Thee, O God (Adagio, SATB)</li>
          <li>To Thee all Angels cry aloud (Largo e staccato, 2 altos,
            TB unison)</li>
          <li>To Thee Cherubin and Seraphim (Andante, 2 sopranos,
            SSATB)</li>
          <li> The glorious Company of the Apostles (Andante – Adagio
            – Allegro – adagio – Allegro, tenor, bass, two sopranos,
            SSATB)</li>
          <li>When thou took’st upon thee to deliver man (Adagio –
            allegro – adagio – Allegro, SSATB)</li>
          <li>We believe that thou shalt come to be our judge (Largo,
            soprano, alto, tenor, bass, SATB)</li>
          <li>Day by day we magnify thee (Allegro, double choir: SST
            AATB)</li>
          <li>And we worship thy name (SSATB)</li>
          <li>Vouchsafe, O Lord (Adagio, SSAATB)</li>
          <li>Lord, in thee have I trusted (Allegro, SSATB)</li>
        </ol>
        <h4>Jubilate</h4>
        <ol>
          <li>Be joyful in the Lord, all ye lands (alto, SATB)</li>
          <li>Serve the Lord with gladness (SSATB)</li>
          <li>Be ye sure that the Lord he is God (duet: alto, bass,
            violin, oboe)</li>
          <li>Go your way into his gates (SATB, strings)</li>
          <li>For the Lord is gracious (Adagio: 2 altos, bass, oboes,
            violins)</li>
          <li>Glory be to the Father (SSAATTBB)</li>
          <li>As it was in the beginning (SSATB)</li>
        </ol>
        <p>Handel was able to achieve as a composer a superior synthesis
          between soloists and choir, between solo singing and tutti.
          The large-scale structure never detracts from the delicacy
          of melody and harmony, while the musical portrayal of the
          text is always accurate and displays great refinement.</li>
        <p>The success of Handel's Te Deum was such that the work was
          performed annually on the occasion of St. Cecilia's Day, on
          November 22, thus ousting Purcell's counterpart from first
          place.</p>
      </div>
      <h2><a href="javascript: history.go(-1)">Back</a></h2>
    </div>
  </div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

</html>