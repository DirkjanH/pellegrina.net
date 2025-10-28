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
  <title>Dvořáks cantate Het Bruidshemd</title>
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
        <h2>Programmadetails</h2>
        <h3>Dvořáks cantate <i>Svatební košile</i> op. 69</h3>

        <p><div class="fotolinks w3-image"><img src="/Images/Dvorak.jpg" alt="Antonín Dvořák" width="250"><br>Antonín Dvořák</div>Antonín Dvořák componeerde de dramatische cantate <i>Svatební
            košile</i> (Het Bruidshemd) in 1883. Het Birminghamse Musical Festival had Dvořák
          namelijk, gezien het enthousiasme van het Engelse publiek voor grootschalige
          vocale werken, een opdracht voor een cantate voor solisten, koor en orkest voor
          het festival van 1885 gegeven. Dvořák zelf dirigeerde
          de eerste twee voorstellingen, op 28 en 29 maart 1885 in Plzeň.
          De Engelse première vond plaats op 27 augustus 1885, opnieuw onder Dvořáks
          leiding. Het nieuwe werk werd enthousiast ontvangen. In de vele recensies was
          de beoordeling van <i>The Spectre's Bride</i>, zoals het stuk in het Engels
          wordt genoemd, uiterst positief.</p>

        <p>Voor zijn werk koos Dvořák de ballade <i>Svatební
            košile</i> (letterlijk vertaald als Het Bruidshemd) van de Tsjechische dichter Karel
          Jaromír Erben (1811-1870). Erbens <i>Kytice</i> (De Ruiker), een verzameling
          van Tsjechische volkssprookjes geïnspireerde Dvořák wel vaker,
          bijvoorbeeld voor zijn cyclus van symfonische gedichten, De Waterman, De Middagheks,
          Het Gouden Spinnewiel en De Woudduif. In deze vier gedichten, evenals in Het
          Bruidshemd, gebruikt Dvořák specifieke muzikale thema's en zelfs
          instrumenten voor belangrijke personages en gebeurtenissen in het drama. De
          basklarinet bijvoorbeeld, een nieuwe uitvinding van die tijd, is altijd
          gereserveerd voor griezelige, spookachtige momenten in het verhaal.</p>

        <div class="fotocenter w3-image"><img src="/Images/svatebni_kosile.png" alt="Het Bruidshemd"><br>The Spectre's Bride</div>
        <p>De 'gothic' ballade <i>Svatební košile</i> is een storm van
          emoties: verlangen, vrees, hoop, twijfel en, op het einde, opluchting. Er wordt
          verteld van een wilde en woedende nachtelijke jacht door zompige moerassen, langs
          sombere wilgenbosjes en over kale rotsen, terwijl honden dreigend huilen. In de openingsmonoloog treurt het meisje (sopraan) om haar
          geliefde, die lang geleden is vertrokken naar een ver land. Ze bidt tot de
          Maagd Maria dat hij veilig mag terugkeren en zegt aan het einde van de scène
          dat, als hij niet terugkomt, ze liever zou sterven. Dan verschijnt er een
          levend lijk (tenor) bij het kamerraam en doet alsof hij de geliefde van het
          meisje is. Hij nodigt haar uit bij hem thuis. Het meisje gelooft hem en ze gaan
          op weg, een verschrikkelijke reis door de nachtelijk landschap, waarin de dode bruidegom
          het meisje dwingt om een voor een afstand te doen van de voorwerpen die ze heeft
          meegenomen: een kruisje, een rozenkrans en een gebedenboek. Het stel komt dan eindelijk
          aan op de plaats die het spook zijn huis noemt - een begraafplaats. Pas nu beseft
          het meisje haar fout. Ze wordt gered door het uitspreken van een smeekbede aan
          de Maagd Maria en door de aankondiging van de nieuwe dag met het verschijnen
          van de eerste zonnestralen.</p>

        <p>De aard van de tekst bepaalt de vorm van de cantate. De
          dialoog tussen het meisje en de levende dode wordt gezongen door solo sopraan
          en tenor; de solo bariton en het gemengde koor vervullen de rol van verteller. Het
          werk volgt nauwkeurig de volgorde van de scènes zoals in de ballade van Erben.</p>

        <p>De ballade is verdeeld in 18 delen, die vaak attacca in
          elkaar overgaan. Het orkest heeft een zeer belangrijke rol. Het verzorgt de
          episch-dramatische expressie van de muzikale voortgang, als aanvulling op de
          zangpartijen, en is de drager van de muzikale actie. Slechts in twee delen treedt
          een meer lyrische stijl op de voorgrond, beide keren in de twee aria's van het
          meisje (nr. 2 en nr. 17). Deze gebedsscènes markeren innerlijke keerpunten die
          de beweging even vertragen, maar tegelijkertijd doorslaggevend transformaties uitlokken.</p>

        <p>Erbens gedicht heeft een krachtige verhaallijn met tal van
          dramatische situaties die allerlei mogelijkheden bieden voor een sterk
          contrasterende muzikale uitbeelding van de afzonderlijke scènes en personages.
          Dvořák maakt hier gebruik van in een onuitputtelijke stroom van muzikale
          ideeën, zonder de totale structurele eenheid en beknoptheid uit het oog te
          verliezen. Hij vond grote inspiratie in de opwindende ritmes van Erbens verzen,
          die hij versterkte door middel van zijn muziek. Het werk behoudt zijn homogeniteit
          dankzij het motief van dalende kwinten, die zich een weg slingert door de
          verschillende delen. Dvořáks muziek toont een duidelijk begrip van de
          tekst en een vlekkeloze synthese van muziek en tekst. De cantate is uniek door
          zijn dramatische expressie, inventieve melodieën en ongewone ritmes. Kortom,
          een ultiem voorbeeld van het creatieve genie van de componist.</p>
        <h2><a href="javascript: history.go(-1)">Terug</a></h2>
      </div>
    </div>
  </div>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html>