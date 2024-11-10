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
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
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
  <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=537749209897328&ev=PageView&noscript=1" /></noscript>
</head>

<body>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
  <div id="inhoud" class="w3-main">
    <?php
    echo $navigatie;
    echo '<span class="w3-opennav w3-xxlarge w3-hide-large" onclick="w3_open()">☰</span>';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.NL.php';
    ?>
    <div id="main">
      <div class="cols2">
        <h2>Programme details</h2>
        <h3>K.J. Erben - Zlatý kolovrat - The Golden Spinning-Wheel</h3>
        <p>In 1896, Antonín Dvořák composed four symphonic poems based on ballads from the collection <em>Kytice</em> (The Bouquet) by Karel Jaromír Erben: The Water Spirit, The Afternoon Witch, The Golden Spinning Wheel and The Wild Dove. These works mark an important phase in Dvořák's career, stemming from his long-standing fascination with Erben's poetry. Earlier, Dvořák incorporated Erben's texts into works such as The Spectre’s Bride (1884) and considered cantatas based on other ballads. Ultimately, he chose the genre of symphonic poems, in which he musically translated Erben's themes without direct text support.</p>
        <h4>Features</h4>
        <p>Dvořák integrated the rhythmic structure of Erben's verses into his thematic material, leading to a unique combination of musical inventiveness and textual reference. His detailed approach to Erben's stories, such as the repetitions in The Golden Spinning Wheel, was sometimes controversial, but demonstrated his focus on musical narrativity. In addition, his orchestration emphasized refined timbres, with influences from French Impressionism.</p>
        <h4>Premiere and reception</h4>
        <p>The first performance of The Golden Spinning Wheel took place in Prague in 1896, followed by a public premiere in London. The reception was mixed: admiration for its musical depth alternated with criticism from traditionalists such as Eduard Hanslick, who deplored Dvořák's ‘deviation’ from absolute music. Leoš Janáček, on the other hand, praised Dvořák's expressive musical 'speech' in these works.</p>
        <h4>Synopsis of The Golden Spinning Wheel</h4>
        <p>While out riding in the countryside, a king happens upon a beautiful village girl, Dornička, and falls in love with her. He asks her step-mother to bring her to his castle. The step-mother and Dornička's identically looking step-sister set off towards the king's castle with Dornička. On the way, they murder her, hack off her feet and hands, and cut out her eyes. They bury the body but keep the amputated parts, "lest someone fix them back". The step-sister then poses as Dornička and marries the king, after which he is called away to battle.</p>
        <p>Meanwhile, in the midst of the forest, a hermit skilled in magical arts finds Dornička's remains and decides to bring her back to life. He sends a page to the castle to persuade the step-sister to part with "two feet" in return for a golden spinning wheel, "two hands" for a golden distaff, and "two eyes" for a golden spindle. The body being complete again, the hermit brings Dornička back to life.</p>
        <p>The king returns from battle and bids his wife to spin for him on her new wheel. As she obliges, the magical spinning wheel sings a song betraying the two women's treacherous plot and relaying all the gruesome details of Dornička's murder. The king goes off into the forest to find his true betrothed. The two murderesses are thrown to the wolves, their bodies mutilated in the same way they had mutilated Dornička's. Having fulfilled its task, the golden spinning wheel magically disappears, never to be seen or heard again.</p>
        <p><a h<a href="\EN\romantic\text_zlaty_kolovrat.htm" target="_blank">The full text of Erben's poem with a parallel English translation can be found here.</a></p>
      </div>
      <div class="cols2">
        <hr style="border-top: 1px solid black;">
        <h3>Haydn - Missa in tempore belli (Paukenmesse)</h3>
        <p>
          Joseph Haydn componeerde de <i>Missa in tempore belli</i>&nbsp;(Hob. XXII:9), ook bekend als de Paukenmesse, in 1796, tijdens de turbulente tijd van de Eerste Coalitieoorlog.
          Haydn schreef de mis voor de priesterwijding van Joseph Franz von
          Hofmann, en ze werd voor het eerst uitgevoerd in de Piaristenkirche
          Maria Treu in Wenen. Later voerde Haydn de mis ook uit ter ere van de
          naamdag van prinses Maria Josepha Hermengilde Esterh&aacute;zy. De
          bijnaam Paukenmesse&nbsp;verwijst naar de prominente rol van de pauken, vooral in het Agnus Dei, waar een paukensolo de dreigende oorlogssfeer oproept. De mis combineert religieuze ernst met strijdlustige muzikale elementen,
          passend bij de angst voor een mogelijke invasie van Oostenrijk.
        </p>
        <p>
          Eind 1796, een jaar voor het eind van de Eerste Coalitieoorlog, het
          militair treffen tussen de coalitie van staten waar Oostenrijk deel van
          uitmaakte en Frankrijk, behaalde Napoleon Bonaparte overwinningen op de
          Oostenrijkers die hij uiteindelijk in november versloeg in de Slag bij
          de brug van Arcole bij Verona. In het westen vocht Oostenrijk met
          Frankrijk om de controle over Zuid-Duitsland. In deze bedreigende
          oorlogssfeer en tegen deze achtergrond ontstond de Paukenmis. Voor het
          eerst sinds 1683, toen een zeer groot Ottomaanse Rijk leger Wenen twee
          maanden belegerde maar uiteindelijk werd verslagen, was er sprake van
          re&euml;el gevaar van een invasie van het kerngebied van het
          Oostenrijkse rijk. De verdrijving van de Turken was voor de
          Oostenrijkers een belangrijke gebeurtenis die jaarlijks tijdens de
          Heilige Naam van Maria op 12 september werd herdacht. Met processies en
          speciale missen werd de overwinning levend gehouden en met kerkmuziek,
          met name missen en toonzettingen van het Te Deum met ongebruikelijk
          prominente partijen voor trompetten en pauken die de dreiging van en de
          overwinning in de oorlog moesten oproepen.
        </p>
        <h3>
          Structuur en kenmerken
        </h3>
        <p>
          De structuur van de mis volgt de traditionele misdelen:
        </p>
        <ul>
          <li>
            Het Kyrie begint met een plechtige inleiding waarbij de pauken eerst
            rustig en dan zeer luid roffelen, waarmee de aard van de mis wordt getoonzet.<&nbsp;Het Kyrie is een snel deel in sonatevorm. Het thema wordt door de sopraan ingezet, overgenomen door het koor in steeds dwingender
              toon, terwijl de solisten met korte partijen interveni&euml;ren.
              </li>
          <li>
            Het Gloria is in drie delen. Het middendeel is zeer langzaam,
            beginnend met een lieflijk duet voor bas en solocello in het <i>Qui tollis</i> in A, maar met het inzetten van het koor wordt een dreigende toon gezet. De twee buitendelen zijn thematisch verwant, met fanfares van
            koperblazers en pauken.
          </li>
          <li>
            Ook het Credo is driedelig met een eveneens langzaam middendeel met
            een klarinetsolo voor het <i>Et incarnatus est</i>. Het in twee&euml;n gedeelde laatste deel eindigt met een dubbelfuga
            op de woorden <i>Et vitam venturi saeculi, Amen</i>.
          </li>
          <li>
            Het Sanctus is in twee delen, een statig openingsdeel gevolgd door
            een donderend snel deel op de woorden <i>Pleni sunt coeli</i>, wederom begeleid door de trompetten en de pauken. Overeenkomstig
            het liturgisch gebruik is het Sanctus kort.
          </li>
          <li>
            Het Benedictus is een andante met een onheilspellend karakter dat
            begint in c-klein en langzaam naar C groot gaat op de woorden <i>Osanna in excelsis</i>.
          </li>
          <li>
            Het Agnus Dei bevat het deel dat de mis zijn bijnaam heeft gegeven:
            onverwachts komt na de eenvoudige melodie voor koor en strijkers in
            maat 10 de paukensolo, waar de triomfantelijke partij van de
            trompetten op aansluit. Syncopen op de violen en aangehouden noten op
            de hobo&#39;s begeleiden de pauken. Volgens Haydns biograaf Giuseppe
            Carpani moesten de pauken geslagen worden op de Franse manier,
            waardoor de dreiging wordt versterkt. De diplomaat Georg August
            Griesinger, bevriend met Haydn, schreef over de mis: &quot;1796, als
            die Franzosen in der Steyermark standen, setzte Haydn eine Messe,
            welcher er den Titel <i>in tempore belli</i> gab. In dieser Messe sind die Worte <i>Agnus Dei, qui tollis peccata mundi</i>&nbsp;auf eigene Art mit Begleitung von Pauken vorgetragen, als
            h&ouml;rte man den Feind schon in der Ferne kommen&quot;. De mis
            eindigt met een fanfare-achtig <i>Allegro con spirito</i> met een bijna dwingend gezongen <i>Dona nobis pacem</i>.
          </li>
        </ul>
        <h3>Bezetting</h3>
        <p>
          De Paukenmis is geschreven voor twee hobo&#39;s, twee klarinetten, twee
          fagotten, twee hoorns, twee trompetten, pauken, strijkers en orgel;
          later breidde Haydn de partijen voor de klarinetten uit voor alle delen,
          voegde een partij voor een fluit in het &#39;Qui tollis&#39; toe en
          versterkte de trompetten door hoorns. Voor de uitvoering in het kader
          van de zomercursus van La Pellegrina breiden wij de partijen van fluiten
          en klarinetten wat verder uit, zodat het volwaardige stemmen
          worden. Het koor heeft de normale bezetting SATB. Er zijn vier solisten satb.
        </p>
</body>
<h2><a href="javascript: history.go(-1)">Back</a></h2>
</div>
</div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

</html>