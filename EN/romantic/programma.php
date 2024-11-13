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
  <title>Dvořáks Gouden Spinnewiel & Haydns Missa in tempore belli</title>
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
                                    ?> <div id="main">
      <div class="cols2">
        <h2>Programme details</h2>
        <h3>K.J. Erben - Zlatý kolovrat - The Golden Spinning Wheel</h3>
        <p>In 1896, Antonín Dvořák composed four symphonic poems based
          on ballads from the collection <em>Kytice</em> (The Bouquet)
          by Karel Jaromír Erben: The Water Spirit, The Afternoon
          Witch, The Golden Spinning Wheel and The Wild Dove. These
          works mark an important phase in Dvořák's career, stemming
          from his long-standing fascination with Erben's poetry.
          Earlier, Dvořák incorporated Erben's texts into works such
          as The Spectre’s Bride (1884) and considered cantatas based
          on other ballads. Ultimately, he chose the genre of
          symphonic poems, in which he musically translated Erben's
          themes without direct text support.</p>
        <p>In the 2025 summer school we will perform The Golden Spinning
          Wheel. The original idea to perform The Spectre’s Bride
          turned out ot be not possible due to restrictions at our
          concert venue, the cathedral.</p>
        <h4>The Golden Spinning Wheel/h4> <p><img
              src="\Images\spinnewiel.jpg"
              alt="Golden Spinning Wheel" class="fotocenter">The
            first performance of The Golden Spinning Wheel took
            place in Prague in 1896, followed by a public premiere
            in London. The reception was mixed: admiration for its
            musical depth alternated with criticism from
            traditionalists such as Eduard Hanslick, who deplored
            Dvořák's ‘deviation’ from absolute music. Leoš Janáček,
            on the other hand, praised Dvořák's expressive musical
            'speech' in these works.</p>
          <p>Dvořák integrated the rhythmic structure of Erben's
            verses into his thematic material, leading to a unique
            combination of musical inventiveness and textual
            reference. His detailed approach to Erben's stories,
            such as the repetitions in The Golden Spinning Wheel,
            was sometimes controversial, but demonstrated his focus
            on musical narrativity. In addition, his orchestration
            emphasized refined timbres, with influences from French
            Impressionism.</p>
          <h4>Synopsis of The Golden Spinning Wheel</h4>
          <p>While out riding in the countryside, a king happens upon
            a beautiful village girl, Dornička, and falls in love
            with her. He asks her step-mother to bring her to his
            castle. The step-mother and Dornička's identically
            looking step-sister set off towards the king's castle
            with Dornička. On the way, they murder her, hack off her
            feet and hands, and cut out her eyes. They bury the body
            but keep the amputated parts, "lest someone fix them
            back". The step-sister then poses as Dornička and
            marries the king, after which he is called away to
            battle.</p>
          <p>Meanwhile, in the midst of the forest, a hermit skilled
            in magical arts finds Dornička's remains and decides to
            bring her back to life. He sends a page to the castle to
            persuade the step-sister to part with "two feet" in
            return for a golden spinning wheel, "two hands" for a
            golden distaff, and "two eyes" for a golden spindle. The
            body being complete again, the hermit brings Dornička
            back to life.</p>
          <p>The king returns from battle and bids his wife to spin
            for him on her new wheel. As she obliges, the magical
            spinning wheel sings a song betraying the two women's
            treacherous plot and relaying all the gruesome details
            of Dornička's murder. The king goes off into the forest
            to find his true betrothed. The two murderesses are
            thrown to the wolves, their bodies mutilated in the same
            way they had mutilated Dornička's. Having fulfilled its
            task, the golden spinning wheel magically disappears,
            never to be seen or heard again. </p>
          <p><a h<a href="\EN\romantic\text_zlaty_kolovrat.htm"
              target="_blank">The full text of Erben's poem with a
              parallel English translation can be found here.</a>
          </p>
      </div>
      <div class="cols2">
        <hr style="border-top: 1px solid black;">
        <h3>Haydn - Missa in tempore belli (Paukenmesse)</h3>
        <p> Joseph Haydn composed the <i>Missa in tempore
            belli</i>&nbsp;(Hob. XXII:9), also known as the
          Paukenmesse, in 1796, during the turbulent time of the First
          Coalition War. Haydn wrote the mass for the ordination of
          Joseph Franz von Hofmann, and it was first performed in the
          Piaristenkirche Maria Treu in Vienna. Later, Haydn also
          performed the mass in honor of the name day of Princess
          Maria Josepha Hermengilde Esterh&aacute;zy. The nickname
          Paukenmesse&nbsp;refers to the prominent role of the
          timpani, especially in the Agnus Dei, where a timpani solo
          evokes the threatening atmosphere of war. The Mass combines
          religious seriousness with combative musical elements,
          appropriate to the fear of a possible invasion of Austria.
        </p>
        <p> In late 1796, a year before the end of the First Coalition
          War, the military encounter between the coalition of states
          to which Austria belonged and France, Napoleon Bonaparte
          scored victories over the Austrians whom he finally defeated
          in November in the Battle of Bridge of Arcole near Verona.
          To the west, Austria fought with France for control of
          southern Germany. In this threatening atmosphere of war and
          against this background the Pauken Mass was born. For the
          first time since 1683, when a very large Ottoman Empire army
          besieged Vienna for two months besieged but was finally
          defeated, there was a re&euml;el danger of an invasion of
          the core area of the Austrian Empire. The expulsion of the
          Turks was for the Austrians an important event that was
          celebrated annually during the Holy Name of Mary on Sept. 12
          was commemorated. With processions and special masses the
          victory was kept alive and with church music, especially
          masses and settings of the Te Deum with unusually prominent
          parts for trumpets and timpani that were intended to evoke
          the threat of and victory in the war were to evoke. </p>
        <h3> Structure and characteristics </h3>
        <p> The structure of the Mass follows the traditional parts of
          the Mass: </p>
        <ul>
          <li> The Kyrie begins with a solemn introduction in which
            the timpani first quietly and then very loudly, thus
            setting the tone for the nature of the Mass. The Kyrie
            is a fast movement in sonata form. The theme is begun by
            the soprano, taken over by the choir in increasingly
            compelling tone, while the soloists intervene with short
            parts. </li>
          <li> The Gloria is in three movements. The middle movement
            is very slow, beginning with a lovely duet for bass and
            solo cello in the <i>Qui tollis</i> in A, but a menacing
            tone is set with the entry of the chorus. The two outer
            movements are thematically related, with fanfares of
            brass and timpani. </li>
          <li> The Credo is also three-part with an equally slow
            middle section with a clarinet solo for the <i>Et
              incarnatus est</i>. The last movement, divided into
            two&euml;n, ends with a double fugue on the words <i>Et
              vitam venturi saeculi, Amen</i>. </li>
          <li> The Sanctus is in two parts, a stately opening section
            followed by a thundering fast movement on the words
            <i>Pleni sunt coeli</i>, again accompanied by the
            trumpets and timpani. In accordance with liturgical
            custom, the Sanctus is short.
          </li>
          <li> The Benedictus is an andante with an ominous character
            that begins in c minor and slowly moves to C major on
            the words <i>Osanna in excelsis</i>. </li>
          <li> The Agnus Dei contains the part that gave the Mass its
            nickname: unexpectedly, after the simple melody for
            choir and strings in bar 10 the timpani solo, to which
            the triumphant part of the trumpets follows.
            Syncopations on the violins and sustained notes on the
            oboes&#39;s accompany the timpani. According to Haydn's
            biographer Giuseppe Carpani, the timpani had to be
            struck in the French manner, thus reinforcing the
            threat. The diplomat Georg August Griesinger, a friend
            of Haydn, wrote of the mass: &quot;1796, when die
            Franzosen in der Steyermark standen, setzte Haydn eine
            Messe, welcher er den Titel <i>in tempore belli</i> gab.
            In dieser Messe sind die Worte <i>Agnus Dei, qui tollis
              peccata mundi</i>&nbsp;auf eigene Art mit Begleitung
            von Pauken vorgetragen, als h&ouml;rte man den Feind
            schon in der Ferne kommen&quot;. The mass ends with a
            fanfare-like <i>Allegro con spirito</i> with an almost
            compellingly sung <i>Dona nobis pacem</i>. </li>
        </ul>
        <h3>Ensemble formation</h3>
        <p> The Missa in tempore belli is written for two oboes&#39;s,
          two clarinets, two bassoons, two horns, two trumpets,
          timpani, strings and organ; later Haydn expanded the parts
          for the clarinets for all movements, added a part for a
          flute in the &#39;Qui tollis&#39; and amplified the trumpets
          by horns. For the performance as part of La Pellegrina's
          summer course, we extended the parts of flutes and clarinets
          a little further, so that they become full voices. The choir
          has the normal scoring SATB. There are four soloists satb.
        </p>
</body>
<h2><a href="javascript: history.go(-1)">Back</a></h2>
</div>
</div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

</html>