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
  <title>Praktisch &amp; prijzen cursus
    "<?php echo $cursusdata['cursusnaam_nl']; ?>"</title>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.NL.php'; ?>
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
                                    require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.NL.php';
                                    ?> <div id="main">
      <h2 class="begin">Praktische gegevens & prijzen
        "<?php echo $cursusdata['cursusnaam_nl']; ?>"</h2>
      <h3>Toelating</h3>
      <p> Omdat bij het samenstellen van de groep wordt gestreefd naar een
        evenwichtig geheel, wordt bij toelating in de eerste plaats
        gekeken naar niveau, in het belang van alle deelnemers. Vaak
        moeten we kiezen uit een te groot aanbod van belangstellenden
        voor een bepaald instrument, met name bij blazers en bepaalde
        stemtypen. We letten dan in de eerste plaats op muzikale
        opleiding, ervaring en inzicht. Het is daarom belangrijk om je
        muzikale niveau goed te omschrijven. Bij kandidaten voor een
        bepaald instrument of stemsoort met een gelijkwaardig niveau
        heeft uiteraard degene die zich het eerst heeft aangemeld
        voorrang. Wanneer je twijfelt over je niveau, neem dan <a
          href="contact.php">contact op</a> met <i>La Pellegrina</i>.
      </p>
      <p>Om bovenstaande reden worden de aanmeldingen in eerste instantie
        verzameld. Op <?php echo $cursusdata['beslisdatum']; ?> wordt
        bekend gemaakt wie er geplaatst kan worden en wie niet. In
        verband met het beperkte aantal plaatsen is het dus aan te raden
        zo snel mogelijk in te schrijven. Inschrijving na
        <?php echo $cursusdata['beslisdatum']; ?> is nog mogelijk, maar
        uitsluitend voor de plaatsen die dan nog vacant zijn en vermeld
        op deze website.</p>
      <p class="citaat">Robert Klotz: &ldquo;Ik vloog een oceaan over om
        La Pellegrina bij te wonen. Zou zwemmen om er volgend jaar weer
        heen te kunnen.&rdquo;</p>
      <h3>Aanmelding en bevestiging</h3>
      <p>Je kunt je inschrijven met het aanmeldingsformulier op deze site
        (zie het betreffende project), dat <strong>volledig</strong>
        ingevuld moet worden. De aanbetaling van
        <strong><?php echo euro($cursusdata['inschrijfgeld']); ?></strong>
        kun je gelijk met de aanmelding betalen, of apart overmaken op
        rekening <strong>NL33 ASNB 0707 2500 72 </strong>t.n.v. <em>La
          Pellegrina</em> te Utrecht. Je ontvangt dan een voorlopige
        bevestiging van inschrijving. Als je niet geplaatst kunt worden,
        wordt de aanbetaling uiteraard teruggestort. Het volledige
        cursusgeld moet uiterlijk op
        <?php echo $cursusdata['betaaldatum']; ?> betaald zijn. Alle
        eventuele bank en creditcardkosten zijn voor rekening van de
        deelnemer.
      </p>
      <p class="citaat">Marrie Kardol: &ldquo;De prachtige inspirerende
        omgeving, het ordelijke verloop van het programma, de goede
        voorbereiding en de vriendelijke en prettige manier waarop de
        tutors omgaan met de deelnemers, dit alles maakt Pellegrina tot
        een aanrader voor elke muziekliefhebber!&rdquo;</p>
      <h3>Prijzen</h3>
      <p>De prijs van het project is
        <strong><?php echo euro($cursusdata['prijs_volledig']); ?></strong>&nbsp;per
        persoon, inclusief accommodatie in een tweepersoons kamer en
        alle maaltijden. Studenten en iedereen tot 36 jaar betalen
        <strong><?php echo euro($cursusdata['prijs_student']); ?></strong>.
        Als je je tijdig inschrijft krijg je
        <strong><?php echo euro($cursusdata['korting_vroeg']); ?>
          korting</strong>. Als je kampeert of zelf je accommodatie
        regelt krijg je korting; eenpersoons kamers zijn mogelijk tegen
        een meerprijs.
      </p>
      <h4>Aanzienlijke korting voor studenten en jongeren </h4>
      <p><em>Voltijds</em> studenten aan het wetenschappelijk en hoger
        beroepsonderwijs en deelnemers t/m 35 jaar (bij aanvang van de
        cursus waarvoor ze zich hebben aangemeld), krijgen een
        aanzienlijke korting en betalen
        <strong><?php echo euro($cursusdata['prijs_student']); ?></strong>
        cursusgeld per persoon, op basis van een tweepersoons kamer.
        Stuur bij inschrijving een kopie of een scan van het
        inschrijvingsbewijs (of van je paspoort als bewijs van je
        leeftijd) mee.
      <h4>Extra reductie voor muziekstudenten</h4>
      <p>Voltijds muziekstudenten aan een conservatorium kunnen beroep
        doen op een extra korting dankzij een fonds opgebouwd uit
        bijdragen van de ACMP en deelnemers: vraag svp om details.</p>
      <p class="citaat">Anke Muusse: &quot;Geweldige uitdagende en
        muzikale week waar je als zanger helemaal tot je recht komt,
        zowel bij de kamermuziek als het tutti programma, mede dank zij
        de prima coaches!&quot;</p>
      <h3>Accommodatie</h3>
      <h4>Een- en tweepersoons kamers in Klooster Nieuw Sion</h4>
      <p>De meeste deelnemers verblijven in klooster Nieuw Sion. Er zijn
        twee plekken waar mensen kunnen verblijven, het Gastenverblijf
        en het Poortgebouw. </p>
      <p>Het Gastenverblijf heeft één tweepersoons en dertien eenpersoons
        kamers. De voorzieningen zijn er simpel maar schoon, met een
        gemeenschappelijke sanitaire ruimte. </p>
      <p>Daarnaast is er sinds kort het geheel gerenoveerde en
        comfortabele Poortgebouw, met drie eenpersoonskamers met gedeeld
        sanitair en vijf tweepersoonskamers met eigen sanitair. Die
        tweepersoonskamers kunnen eventueel ook worden geboekt als een
        eenpersoonskamer met eigen sanitair.</p>
      <h4>Kamperen in de kloostertuin</h4>
      <p>Er zijn een paar kampeerplekken in de notenboomgaard van het
        klooster beschikbaar. Tenten, campers en caravans zijn welkom;
        elektriciteit is NIET beschikbaar. Het aantal plaatsen is
        beperkt, er zijn eenvoudige gedeelde sanitaire voorzieningen in
        het klooster.</p>
      <h4>Eigen accommodatie</h4>
      <p>Het is mogelijk aan de cursus deel te nemen op basis van eigen
        accommodatie, bijvoorbeeld voor diegenen die in de buurt wonen
        of zelf accommodatie kunnen regelen. In dat geval betaal je
        naast het cursusgeld alleen een bijdrage voor koffie en thee en
        de gezamenlijke lunch. Er zijn diverse hotels en Bed & Breakfast
        gelegenheden in de buurt. Het mogelijk om tegen een meerprijs
        ook het avondeten in het Klooster te krijgen.</p>
      <h3>Maaltijden</h3>
      <p>Tijdens de cursus beschikken we over een aparte eetzaal, waar
        koffie en thee voor ons klaarstaan. Er is een uitgebreid
        ontbijtbuffet. De lunch en de avondmaaltijd worden als het weer
        het toestaat op het terras buiten geserveerd.</p>
      <h3>Alle prijzen in één oogopslag</h3>
      <table class="w3-table-all">
        <tr>
          <th>Overzicht van alle prijzen en kortingen</th>
          <th class="w3-right-align">Bij inschrijving <br />vòòr
            <?php echo $cursusdata['beslisdatum']; ?>:</th>
          <th class="w3-right-align">Bij inschrijving <br />op of na
            <?php echo $cursusdata['beslisdatum']; ?>:</th>
        </tr>
        <tr>
          <td>Deelname incl. tweepersoonskamer in het Gastenverblijf,
            met gedeeld sanitair</td>
          <td class="geld">
            <?php echo euro($cursusdata['prijs_volledig'] - $cursusdata['korting_vroeg']); ?>
          </td>
          <td class="geld">
            <?php echo euro($cursusdata['prijs_volledig']); ?></td>
        </tr>
        <tr>
          <td>Deelname student c.q. deelnemer t/m 35 jaar incl.
            tweepersoonskamer in het Gastenverblijf, met gedeeld
            sanitair</td>
          <td class="geld">
            <?php echo euro($cursusdata['prijs_student'] - $cursusdata['korting_vroeg']); ?>
          </td>
          <td class="geld">
            <?php echo euro($cursusdata['prijs_student']); ?></td>
        </tr>
        <tr class="onzichtbaar">
          <td>Deelname toehoorder incl. tweepersoonskamer in het
            Gastenverblijf, met gedeeld sanitair</td>
          <td class="geld">
            <?php echo euro($cursusdata['toehoorder']); ?></td>
          <td class="geld">
            <?php echo euro($cursusdata['toehoorder']); ?></td>
        </tr>
        <tr>
          <td>Meerprijs eenpersoonskamer in het Gastenverblijf, met
            gedeeld sanitair</td>
          <td class="geld"><?php echo euro($cursusdata['eenpers']); ?>
          </td>
          <td class="geld"><?php echo euro($cursusdata['eenpers']); ?>
          </td>
        </tr>
        <tr>
          <td>Meerprijs eenpersoonskamer in het Poortgebouw, met
            gedeeld sanitair</td>
          <td class="geld">
            <?php echo euro($cursusdata['hotel_1pp']); ?></td>
          <td class="geld">
            <?php echo euro($cursusdata['hotel_1pp']); ?></td>
        </tr>
        <tr>
          <td>Meerprijs plaats in tweepersoonskamer in het
            Poortgebouw, met eigen sanitair</td>
          <td class="geld">
            <?php echo euro($cursusdata['hotel_2pp']); ?></td>
          <td class="geld">
            <?php echo euro($cursusdata['hotel_2pp']); ?></td>
        </tr>
        <tr>
          <td>Meerprijs tweepersoonskamer in het Poortgebouw met eigen
            sanitair als eenpersoonskamer</td>
          <td class="geld">
            <?php echo euro($cursusdata['hotel_2pp']); ?></td>
          <td class="geld">
            <?php echo euro($cursusdata['hotel_2pp']); ?></td>
        </tr>
        <tr>
          <td>Korting voor kamperen in de kloostertuin <span
              class="nadruk">(per persoon, incl. alle
              maaltijden)</span></td>
          <td class="geld">
            <?php echo euro($cursusdata['kamperen']); ?></td>
          <td class="geld">
            <?php echo euro($cursusdata['kamperen']); ?></td>
        </tr>
        <tr>
          <td>Korting voor eigen accommodatie <span class="nadruk">(de
              lunch en koffie/thee is wel inbegrepen, ontbijt en
              avondeten niet)</span></td>
          <td class="geld">
            <?php echo euro($cursusdata['korting_eigen_acc']); ?>
          </td>
          <td class="geld">
            <?php echo euro($cursusdata['korting_eigen_acc']); ?>
          </td>
        </tr>
        <tr>
          <td>Toeslag voor het gezamenlijke avondeten <span
              class="nadruk">(alleen nodig bij eigen accommodatie;
              voor andere deelnemers is het avondeten standaard
              inbegrepen)</span></td>
          <td class="geld"><?php echo euro($cursusdata['diner']); ?>
          </td>
          <td class="geld"><?php echo euro($cursusdata['diner']); ?>
          </td>
        </tr>
        <tr>
          <td>Korting voor deelname aan meer dan één cursus van <em>La
              Pellegrina</em> <span class="nadruk">(binnen één
              zomer)</span></td>
          <td class="geld">
            <?php echo euro($cursusdata['korting_meer'] * 2); ?>
          </td>
          <td class="geld">
            <?php echo euro($cursusdata['korting_meer'] * 2); ?>
          </td>
        </tr>
      </table>
      <h3> Voertaal</h3>
      <p>De projecten van <i>La Pellegrina</i> worden internationaal
        aangeboden. Er wordt Nederlands, Duits en Engels gesproken. De
        coaching zal gedeeltelijk in het Engels zijn.</p>
      <p class="citaat">Peter Klusener: &quot;Ik heb een geweldige barok
        muziekweek in het klooster Sion in Diepenveen gehad. Ik kan het
        iedereen aanraden. Het is heel laagdrempelig en de sfeer van
        saamhorigheid om samen een mooi resultaat te bereiken is
        hartverwarmend.&quot;</p>
      <h3><a name="annul"></a>Annuleringsregeling</h3>
      <p>Als je onverhoopt niet geplaatst kunt worden voor een cursus, of
        als <i>La Pellegrina</i> het project zou moeten annuleren,
        ontvang je uiteraard het gehele betaalde bedrag terug. Annuleer
        je zelf vóór of op <?php echo $cursusdata['betaaldatum']; ?>,
        dan is het niet mogelijk je aanbetaling te retourneren. Annuleer
        je na <?php echo $cursusdata['betaaldatum']; ?>, dan ben je het
        totale cursusgeld verschuldigd. Het is aan te raden tijdig een
        annuleringsverzekering af te sluiten. </p>
      <p class="citaat">Jean Walker: &quot;Ik denk elk jaar dat het bij
        terugkomst niet zo goed kan zijn als het jaar ervoor... en dan
        is het dat toch!!!&quot;</p>
      <p><i>La Pellegrina</i> behoudt zich het recht voor om, indien
        noodzakelijk, docenten en programma te wijzigen.</p>
      <h2><a href="javascript: history.go(-1)">Terug</a></h2>
    </div>
  </div>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html>