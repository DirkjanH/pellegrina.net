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
    ! function (f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function () {
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
        <h2>Programmadetails</h2>
        <h3>Dvořák - Zlatý kolovrat - <i>Het Gouden Spinnewiel</i></h3>
        <p>In 1896 componeerde Antonín Dvořák vier symfonische gedichten
          gebaseerd op ballades uit de bundel Kytice (Het Boeket) van Karel
          Jaromír Erben: <i>De Watergeest</i>, <i>De Middagheks</i>, <i>Het
            Gouden Spinnewiel</i> en <i>De Wilde Duif</i>. Deze werken markeren
          een belangrijke fase in Dvořáks carrière, die voortkomt uit zijn
          jarenlange fascinatie voor Erbens poëzie. Eerder verwerkte Dvořák
          Erbens teksten in werken als <i>Het bruidshemd</i> (1884) en overwoog
          hij cantates gebaseerd op andere ballades. Uiteindelijk koos hij voor
          het genre van de symfonische gedichten, waarin hij de thema's van
          Erben muzikaal vertaalde zonder directe ondersteuning van gezongen
          tekst. </p>
        <p>In de zomercursus van 2025 voeren we <i>Het Gouden Spinnewiel</i>
          uit. Ons oorspronkelijke idee om <i>Het bruidshemd</i> uit te voeren
          bleek niet mogelijk vanwege beperkingen bij onze concertlocatie, de
          kathedraal.</p>
        <h4><i>Het Gouden Spinnewiel</i></h4>
        <img src="\Images\spinnewiel.jpg" alt="Gouden Spinnewiel"
          class="fotocenter" style="clear: both;">
        <p>De eerste voorstelling van <i>Het Gouden Spinnewiel</i> vond plaats
          in Praag in 1896, gevolgd door een openbare première in Londen. De
          ontvangst was gemengd: er was bewondering voor de muzikale diepgang,
          maar ook kritiek van traditionalisten zoals Eduard Hanslick op Dvořáks
          'afwijking' van de absolute muziek. Leoš Janáček daarentegen prees
          Dvořáks expressieve muzikale 'spraak' in deze werken. </p>
        <p>Dvořák integreerde de ritmische structuur van Erbens verzen in zijn
          thematisch materiaal, wat leidde tot een unieke combinatie van
          muzikale inventiviteit en tekstuele referentie. Zijn gedetailleerde
          benadering van Erbens verhalen, zoals de muzikale herhalingen in
          <i>Het Gouden Spinnewiel</i> die de tekstherhalingen volgen, was soms
          controversieel, maar toonde zijn focus op het vertellen van een
          verhaal door middel van muziek. Daarentegen benadrukte Dvořák met zijn
          orkestratie verfijnde klankkleuren met invloeden van het Franse
          impressionisme. </p>
        <h4>Synopsis van <i>Het Gouden Spinnewiel</i></h4>
        <p>Tijdens een ritje op het platteland ziet een koning een mooi
          dorpsmeisje, Dornička, en wordt verliefd op haar. Hij vraagt haar
          stiefmoeder haar naar zijn kasteel te brengen. De stiefmoeder en
          Dornička's identiek uitziende stiefzus gaan met Dornička op weg naar
          het kasteel van de koning. Onderweg vermoorden ze haar, hakken haar
          voeten en handen af en snijden haar ogen uit. Ze begraven het lichaam
          maar bewaren de geamputeerde delen, “opdat iemand ze niet terugzet”.
          De stiefzus doet zich vervolgens voor als Dornička en trouwt met de
          koning, die vervolgens wordt weggeroepen om in een oorlog te gaan
          vechten. </p>
        <p>Ondertussen, midden in het bos, vindt een kluizenaar die bedreven is
          in magische kunsten Dornička's overblijfselen en besluit haar weer tot
          leven te wekken. Hij stuurt een page naar het kasteel om de stiefzus
          over te halen “twee voeten” af te staan in ruil voor een gouden
          spinnewiel, “twee handen” voor een gouden spinrokken en “twee ogen”
          voor een gouden spoel. Nu het lichaam weer compleet is, brengt de
          kluizenaar Dornička weer tot leven.</p>
        <p>De koning keert terug van de strijd en vraagt zijn vrouw voor hem te
          spinnen op haar nieuwe wiel. Terwijl ze dat doet, zingt het magische
          spinnewiel een lied waarin het verraderlijke complot van de twee
          vrouwen wordt verraden en waarin alle gruwelijke details van de moord
          op Dornička worden verteld. De koning gaat het bos in om zijn ware
          verloofde te zoeken. De twee moordenaressen worden voor de wolven
          gegooid, hun lichamen verminkt op dezelfde manier als ze Dornička
          hadden verminkt. Na zijn taak te hebben vervuld, verdwijnt <i>Het
            Gouden Spinnewiel</i> op magische wijze en wordt nooit meer gezien
          of gehoord.</p>
        <p><a href="\EN\romantic\text_zlaty_kolovrat.htm" target="_blank">De
            volledige tekst van het gedicht van Erben met een parallelle Engelse
            vertaling vind je hier.</a></p>
      </div>
      <div class="cols2">
        <hr style="border-top: 1px solid black;">
        <h3>Haydn - Missa in tempore belli (Paukenmesse)</h3>
        <img src="\Images\pauken.jpg" alt="classical timpani" class="fotocenter"
          style="clear: both;">
        <p> Joseph Haydn componeerde de <i>Missa in tempore belli</i>&nbsp;(Hob.
          XXII:9), ook bekend als de Paukenmesse, in 1796, tijdens de turbulente
          tijd van de Eerste Coalitieoorlog. Haydn schreef de mis voor de
          priesterwijding van Joseph Franz von Hofmann, en ze werd voor het
          eerst uitgevoerd in de Piaristenkirche Maria Treu in Wenen. Later
          voerde Haydn de mis ook uit ter ere van de naamdag van prinses Maria
          Josepha Hermengilde Esterh&aacute;zy. De bijnaam
          Paukenmesse&nbsp;verwijst naar de prominente rol van de pauken, vooral
          in het Agnus Dei, waar een paukensolo de dreigende oorlogssfeer
          oproept. De mis combineert religieuze ernst met strijdlustige muzikale
          elementen, passend bij de angst voor een mogelijke invasie van
          Oostenrijk. </p>
        <p> Eind 1796, een jaar voor het eind van de Eerste Coalitieoorlog,
          versloeg Napoleon Bonaparte uiteindelijk in november in de Slag bij
          Arcola. In het westen vocht Oostenrijk met Frankrijk om de controle
          over Zuid-Duitsland. In deze bedreigende oorlogssfeer en tegen deze
          achtergrond ontstond de Paukenmis. Voor het eerst sinds 1683, toen een
          zeer groot Ottomaanse Rijk leger Wenen twee maanden belegerde, was er
          sprake van reëel gevaar van een invasie van het kerngebied van het
          Oostenrijkse rijk. De verdrijving van de Turken was voor de
          Oostenrijkers een belangrijke gebeurtenis die jaarlijks tijdens het
          feest van de Heilige Naam van Maria op 12 september werd herdacht.
          Processies en speciale missen hielden de herinnering aan de
          overwinning levend, vooral door kerkmuziek met een ongewoon prominente
          plaats voor trompetten en pauken. Deze waren bedoeld om de dreiging
          van oorlog en de triomf van de overwinning op te roepen.</p>
        <p>Lange tijd is gedacht dat dit stuk een anti-oorlogsgevoel uitdrukt,
          ook al is er geen expliciete boodschap in de tekst zelf en geen
          duidelijke aanwijzing van Haydn dat dit zijn bedoeling was. Wat we wel
          terugvinden in de partituur is een zeer onrustig karakter van de
          muziek, dat normaal gesproken niet geassocieerd wordt met Haydn. Dit heeft
          geleerden tot de conclusie gebracht dat het anti-oorlog van aard
          is. Dit wordt vooral opgemerkt in het Benedictus en Agnus Dei. Ten
          tijde van de compositie van de mis had de Oostenrijkse regering in
          1796 een decreet uitgevaardigd dat “geen Oostenrijker van vrede mag
          spreken totdat de vijand is teruggedreven naar zijn gebruikelijke
          grenzen.” Of dit genoeg is om het anti-oorlogs van aard te noemen
          is zeker discutabel omdat het grootste deel van de mis een lyrisch
          vreugdevol karakter heeft.</p>
        <h4> Structuur en kenmerken </h4>
        <p> De structuur van de mis volgt de traditionele misdelen: </p>
        <ul>
          <li>Het Kyrie begint met een plechtige inleiding waarin de pauken
            eerst zachtjes en dan heel luid de toon zetten voor de mis. Het
            Kyrie is een snel deel in sonatevorm. vorm. Het thema wordt ingezet
            door de sopraan, overgenomen door het koor op steeds dwingender
            toon, terwijl de solisten tussenbeide komen met korte secties. </li>
          <li>Het Gloria is in drie delen. Het middendeel is zeer langzaam,
            beginnend met een lieflijk duet voor bas en solocello in het <i>Qui
              tollis</i> in A, maar met het inzetten van het koor wordt een
            dreigende toon gezet. De twee buitendelen zijn thematisch verwant,
            met fanfares van koperblazers en pauken. </li>
          <li>Ook het Credo is driedelig met een eveneens langzaam middendeel
            met een klarinetsolo voor het <i>Et incarnatus est</i>. Het in
            tweeën gedeelde laatste deel eindigt met een dubbelfuga op de
            woorden <i>Et vitam venturi saeculi, Amen</i>. </li>
          <li>Het Sanctus is in twee delen, een statig openingsdeel gevolgd door
            een donderend snel deel op de woorden <i>Pleni sunt coeli</i>,
            wederom begeleid door de trompetten en de pauken. Overeenkomstig het
            liturgisch gebruik is het Sanctus kort. </li>
          <li>Het Benedictus is een andante met een onheilspellend karakter dat
            begint in c-klein en langzaam naar C groot gaat op de woorden
            <i>Osanna in excelsis</i>. </li>
          <li>Het Agnus Dei bevat het deel dat de mis zijn bijnaam heeft
            gegeven: onverwachts komt na de eenvoudige melodie voor koor en
            strijkers in maat 10 de paukensolo, waar de triomfantelijke partij
            van de trompetten op aansluit. Syncopen in de violen en aangehouden
            noten op de hobo&#39;s begeleiden de pauken. Volgens Haydns biograaf
            Giuseppe Carpani moesten de pauken geslagen worden op de Franse
            manier (waarbij de stokken onderhands worden vastgehouden), waardoor
            de dreiging wordt versterkt. De diplomaat Georg August Griesinger,
            bevriend met Haydn, schreef over de mis: &quot;1796, als die
            Franzosen in der Steyermark standen, setzte Haydn eine Messe,
            welcher er den Titel <i>in tempore belli</i> gab. In dieser Messe
            sind die Worte <i>Agnus Dei, qui tollis peccata mundi</i>&nbsp;auf
            eigene Art mit Begleitung von Pauken vorgetragen, als hörte man den
            Feind schon in der Ferne kommen&quot;. De mis eindigt met een
            fanfare-achtig <i>Allegro con spirito</i> met een bijna dwingend
            gezongen <i>Dona nobis pacem</i>. </li>
        </ul>
        <h4>Bezetting</h4>
        <p> De Paukenmis is geschreven voor twee hobo&#39;s, twee klarinetten,
          twee fagotten, twee hoorns, twee trompetten, pauken, strijkers en
          orgel; later breidde Haydn de partijen voor de klarinetten uit voor
          alle delen, voegde een partij voor een fluit in het &#39;Qui
          tollis&#39; toe en versterkte de trompetten door hoorns. Voor de
          uitvoering in het kader van de zomercursus van La Pellegrina breiden
          wij de partijen van fluiten en klarinetten wat verder uit, zodat het
          volwaardige stemmen worden. Het koor heeft de normale bezetting SATB.
          Er zijn vier solisten satb. </p>
</body>
<h2><a href="javascript: history.go(-1)">Terug</a></h2>
</div>
</div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</html>