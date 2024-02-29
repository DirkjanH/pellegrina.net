<?php 
//	echo dirname(__FILE__);
	$filenaam = explode('/', str_replace('/var', '', dirname(__FILE__)));
//Add filename without file extension
	$filenaam[7] = basename(__FILE__,".php");	
//	print_r($filenaam);	
   switch ($filenaam[6])  {
		case 'romantic': $cursus = 1;
		break;
		case 'baroque':  $cursus = 2;
		break;
	}
//	echo 'Cursus is: '.$cursus.'<br>';
	$taal = $filenaam[5];
//	echo 'taal is: '.$taal.'<br>';
	
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/cursusdata.php'; ?>

<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/LP_EN.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">

   <!-- CSS: -->
   <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">

<!-- InstanceBeginEditable name="doctitle" -->
<title>Reicha's Requiem</title>
<!-- InstanceEndEditable -->
<meta charset="UTF-8">
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.EN.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '537749209897328');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=537749209897328&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
</head>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_tagmanager.php'; ?>
  <div id="inhoud" class="w3-main"> 
  <?php 
  echo $navigatie; 
  echo '<span class="w3-opennav w3-xxlarge w3-hide-large" onclick="w3_open()">☰</span>';
  require_once $_SERVER['DOCUMENT_ROOT'].'/includes/header.EN.php';
  ?>
  <div id="main"> 
  <!-- InstanceBeginEditable name="mainpage" -->
    <div class="cols2">
      <h2>Programme details</h2>
      <p>Each afternoon we work on a programme for soloists, choir and orchestra, which is performed publicly as the conclusion of the course. This year, this final concert will feature a programme in with Reicha's Requiem willmbe the central work. The orchestra will open the concert with Dvořák's Symphonic Variations. The concert, conducted by Dirkjan Horringa, will take place in České Budějovice cathedral.      </p>
      <h3>Anton Reicha - <em>Missa pro defunctis</em> (Requiem)</h3>
      <ul>
        <li>Instrumentation: 2 flutes, 2 oboes, 2 clarinets, 2 bassoons, 2 horns, 3 trumpets, 3 trombones, timpani, strings</li>
        <li>Duration: approx. 55 min.</li>
      </ul>
      <p><img src="../../Images/Anton_Reicha_01.png" alt="" width="300" class="fotorechts"/>Anton Reicha (Prague, 26 February 1770 - Paris, 28 May 1836) was a European. He was entered in the baptismal register in Prague in Latin as Antonius Josephus Reicha. In the Czech Republic he is called Antonín Rejcha, but he  called himself Anton Reicha, and after settling in Paris Antoine-Joseph Reicha.</p>
      <h4>Life history</h4>
      <p>He lost his father as a child and fled home at the age of 11, first to his grandfather in Klattau (Klatovy) and then to a childless uncle Josef Reicha, court chapel master in Wallerstein in Württemberg, who then adopted him as a child.</p>
      <p>He began his career as a musician in 1785, when he joined the Cologne Elector's orchestra in Bonn with his uncle. By 1790, he was listed as a violinist here. There he got to know Ludwig van Beethoven, who was also a member of the orchestra. During this time, Reicha went to study at the University of Bonn. In 1794, Reicha left for Hamburg, as the Elector's music ensemble had been disbanded due to the entanglements surrounding the French Revolution. In Hamburg, Reicha kept his head above water by giving private lessons. However, his compositions <em>L'Ermite </em>and <em>Obaldi </em>did not arouse public interest. In late 1799, he left for Paris, where he wrote and dedicated a dozen fugues to the directors of the Paris Conservatoire. His attempts to get an appointment failed. From 1802 to 1808, Reicha lived in Vienna, where he became an occasional composer for weddings and holidays. Here he came into contact with Joseph Haydn and studied with Johann Albrechtsberger and Antonio Salieri, with whom he honed his composition technique. He received several commissions for compositions, which were performed privately. In total, Reicha would compose more than 50 works during his Viennese period, mostly chamber music.</p>
      <p>Reicha left for Paris permanently in 1808 and achieved some success there in 1810 with his opera <em>Cagliostro</em>. Yet it was mainly his instrumental works, especially his wind quintets, that definitively established his name. Moreover, he was appreciated as a music pedagogue. In 1818, he got his desired position at the <em>École royale de Musique</em>, the Paris Conservatoire. Reicha married a Frenchwoman in 1819 and assumed French nationality ten years later. In 1831, he was appointed a Knight in the French Legion of Honour, and in 1835 he succeeded the director of the conservatoire in his membership of the Institut de France. Besides his compositions, his works on composition and piano playing are also significant. His pupils included the composers Franz Liszt, Charles Gounod, César Franck, Hector Berlioz, George Onslow and the musicologist Edmond de Coussemaker.</p>
      <h4><em>Missa pro defunctis</em> (Requiem)</h4>
      <p>Reicha's <em> Missa pro defunctis </em>is a unique work. In terms of time and style, it is situated between the monumental Requiem settings of Mozart and Berlioz. It establishes a new genre, that of the concertante Requiem. Indeed, it is intended more for performance in concert than as part of the liturgy, although it does follow the established liturgical text.</p>
      <p>Mitchell Sandler writes of Reicha's Requiem: &quot;When I listen to Reicha’s Requiem, I feel an irresistible urge to hear this with our own Pellegrina choir and orchestra, and to start molding these beautiful lines and harmonies. There’s such a fabulous palette of emotional colors - I want to see how extreme we can make these contrasts. And I certainly want to begin to feel this piece in my own voice. On the one hand there’s a tremendous feeling of joy at discovering this work, a piece I’d heard of but had never experienced first-hand. On the other, there’s a sense of sadness that this mighty work has laid hidden and unappreciated for so long. Part of me is listening to and looking through the piece, movement by movement, and asking myself ‘why?’. Why has this work been ignored? When Dirkjan and I listened together to a recording for the first time, it was like discovering a treasure. We could both immediately perceive the quality of the music and how much fun this would be to perform.</p>
      <p>Written in Vienna in the years 1802-1806, while Rejcha was studying counterpoint with Joseph Haydn, the structure of the piece shows clearly that he knew Mozart’s famous Requiem. Without copying the music, there’s still the alternation between the terror of the ‘end of days’, and the comfort of trust in God. Take the ‘scary’ movements: Dies irae, Rex tremendae and confutatis. It’s as though Rejcha wants to invoke the terror of the ‘Day of Wrath’ with the same intensity as Mozart, but with other music. And he always brings comfort after the terror. His Offertory, Domine Jesu, is wholly his own, but there are obvious parallels to Mozart. Such as assigning the ‘Sed signifer sanctus Michael’  to the soloists. And he also makes a brilliant fugue of ‘Quam olim Abrahae’. It sounds to me as if he acknowledges the greatness of Mozart, and yet can express himself in his own music. I think it important to keep in mind that the terror of the Requiem mass is not fear of death, but of the last judgement before the almighty judge. A great Requiem in music therefore holds the two extremes of terror and solace in balance. For me this Requiem ticks all the boxes: he knows how to create musical effects which stir us emotionally, in a musical language slightly more modern than Mozart’s&quot;. </p>
	  </div>
	  <hr style="border-top: 1px solid black;">
	  <h3>Antonín Dvořák - Symphonic Variations op. 78</h3>
      <div class="cols2">
	  <ul>
        <li>Date of composition: 6 August 1877 - 28 September 1877 (revision 1887 (?))</li>
        <li>Premiere: 2 December 1877, Prague by the Provisional Theatre Orchestra conducted by Ludevít Procházka</li>
        <li>Instrumentation: 1 piccolo, 2 flutes, 2 oboes, 2 clarinets, 2 bassoons, 4 horns, 2 trumpets, 3 trombones, timpani, triangle, strings</li>
        <li>Duration: approx. 22 min.</li>
      </ul>
      <h4>Composition history</h4>
      <p>The composition of the Symphonic Variations was initiated by Ludevít Procházka, who was to conduct a benefit concert to raise money for the construction of a new church in Prague's Smíchov district, and he asked Dvořák for a new work for the occasion. The composer decided to write a set of variations for the event. The work was originally given the opus number 38, but Dvořák changed it to 40 for the first performance. When Symphonic Variations appeared in print 11 years later, publisher Simrock changed the opus number to 78 to give the impression that this was a more recent work. </p>
      <h4>General features</h4>
      <p>For the main theme of his Symphonic Variations, Dvořák used the melody of his own song for male choir Huslař (the fiddler), on a verse by Adolf Heyduk, from the cycle Choral Songs for Male Choir. This was not an arbitrary decision. Apart from the unusual metrical structure of 7+6+7 bars, the melody is also unusual in its use of the Lydian fourth, both elements that allow the listener to orientate themselves as the music progresses. The presentation of the theme itself is followed by 28 variations that travel through a wide spectrum of different moods and undergo multiple instrumental transformations. Following the harmonic plan of the work, the first 17 variations remain in the basic key of C major; the next nine move to other keys (No 18 in D major, No 19 in B-flat major, Nos 20-24 in B-flat minor, No 25 in B-flat major, No 26 in D major); and the last two variations are back in C major. The work ends spectacularly with a fugue that suddenly changes into a Czech polka at the climax. The work is a brilliant display of musical ideas and a fine example of the composer's orchestral mastery.</p>
      <h4>Premiere and subsequent performances</h4>
      <p>Despite rave reviews after the premiere on 2 December 1877, the Symphonic Variations were sidelined for ten years. They were not performed again until 6 March 1887, when Dvořák himself conducted the National Theatre Orchestra. The new success of the work encouraged Dvořák to send the score to his great admirer, conductor Hans Richter, with a proposal to include it in the programme of his English tour. Richter accepted and performed the Variations in London to an enthusiastic audience. He wrote the following to Dvořák after the concert: &quot;My dear friend! I am delighted by the enormous success of your Symphonic Variations. When I look at all the hundreds of concerts I have conducted, I realise that I have never known a new work that aroused such unmistakable enthusiasm, on all sides. Everyone wanted to know when the work was written and why Dvořák had waited so long to bring it to the public's attention? I leave the parts here because I will probably perform it again. I say 'probably', although it is almost certain now. In any case, I have to present these variations next winter in Vienna&quot;.</p>
      <p>The Vienna premiere took place on 4 December 1887. Dvořák attended the concert and thus witnessed the huge ovations that followed. He wrote in a letter to his publisher Simrock: &quot;As Brahms said - and he knows the Viennese audience very well: none of my works has ever had such an impact as the 'Variations'. The work was superbly performed and the audience responded with thunderous applause. As thanks for my variations, Brahms gave me a beautiful cigarette holder.    </p>
    </div>
  <!-- InstanceEndEditable -->
    <h2><a href="javascript: history.go(-1)">Back</a></h2>
  </div>
</div>
</body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
<!-- InstanceEnd --></html>