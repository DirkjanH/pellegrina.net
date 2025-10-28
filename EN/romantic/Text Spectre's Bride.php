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
    <style>
        td.nr {
            width: 30px;
            vertical-align: top;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
    <div id="inhoud" class="w3-main"> <?php
                                        echo $navigatie;
                                        echo '<span class="w3-opennav w3-xxlarge w3-hide-large" onclick="w3_open()">☰</span>';
                                        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.NL.php';
                                        ?>
        <div id="main">
            <h2>Karel Jaromír Erben - Svatební košile - Text & translation</h2>
            <table>
                <tbody>
                    <tr>
                        <td class="nr">1.
                        <td>
                        <td width="265">
                            <p>Už jedenáctá odbila,<br /> a lampa ještě svítila,<br /> a lampa ještě hořela,<br /> co nad klekadlem visela.<br /> Na stěně nízké světničky<br /> byl obraz boží rodičky,<br /> rodičky boží s děťátkem,<br /> tak jako růže s poupátkem.</p>
                            <p>A před tou mocnou světicí<br /> viděti pannu klečící:<br /> klečela, líce skloněné,<br /> ruce na prsa složené;<br /> slzy jí z očí padaly,<br /> čelem se ňádra zdvihaly.<br /> A když slzička upadla,<br /> v ty bílé ňádra zapadla.
                        <td>
                        <td width="293">
                            <p>The eleventh hour was past and gone, <br /> But still the lamp burnt on and on. <br /> The lamp that on the praying chair <br /> Cast an uneven, ghastly glare. <br /> On the low wall a picture hung, <br /> God's parents, praised by every tongue. <br /> The parents with the Holy Child, <br /> Hoses, with rosebud, saintly mild. </p>
                            <p>Before the heavenly three a maid <br /> Upon her knees her prayers said. <br /> Her face shone with a holy rest, <br /> Her arms were crossed upon her breast. <br /> And as her tears fell soft and slow, <br /> Her bosom swelled with hidden woe. <br /> Her tears they fell like diamonds bright <br /> Upon her bosom snowy white. </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="nr">2.
                        <td>
                        <td width="265">
                            <p>"Žel bohu, kde můj tatíček?<br /> Již na něm roste trávníček!<br /> Žel bohu, kde má matička?<br /> Tam leží - podle tatíčka!<br /> Sestra do roka nežila,<br /> bratra mi koule zabila.</p>
                            <p>Měla jsem, smutná, milého,<br /> život bych dala pro něho!<br /> Do ciziny se obrátil,<br /> potud se ještě nevrátil.<br /> Do ciziny se ubíral,<br /> těšil mě, slzy utíral:<br /> "Zasej, má milá, zasej len,<br /> vzpomínej na mne každý den,<br /> první rok přádla hledívej,<br /> druhý rok plátno polívej,<br /> třetí košile vyšívej:<br /> až ty košile ušiješ,<br /> věneček z routy poviješ."</p>
                            <p>Již jsem košile ušila,<br /> již jsem je v truhle složila,<br /> již moje routa v odkvětě,<br /> a milý ještě ve světě,<br /> ve světě šírém, širokém,<br /> co kámen v moři hlubokém.<br /> Tři léta o něm ani sluch<br /> živ-li a zdráv - zná milý bůh!</p>
                            <p>"Maria, panno přemocná,<br /> ach budiž ty mi pomocna:<br /> vrať mi milého z ciziny,<br /> květ blaha mého jediný;<br /> milého z ciziny mi vrať -<br /> aneb život můj náhle zkrať:<br /> u něho život jarý květ -<br /> bez něho však mě mrzí svět.<br /> Maria, matko milosti,<br /> buď pomocnicí v žalosti!"</p>
                        </td>
                        <td width="293">
                            <p>"Alas, my God! my father lies <br /> Beneath the grass, dust in his eyes." <br /> "Alas, my God! my mother sleeps <br /> Beside him — there where no one weeps." <br /> "My sister died within a year; <br /> In battle fell my brother dear." </p>
                            <p>"But though so lonely, still I loved <br /> Above myself a youth beloved." <br /> "He wandered far to earn his bread — <br /> And came no more — perhaps is dead." <br /> "Before he went away he said, <br /> Wiping my tears, 'We soon shall wed.'" <br /> "'Sow flax, my loved one, in your field; <br /> God give you have a bounteous yield." <br /> "'The first year spin the flaxen thread. <br /> Then bleach it white, we soon shall wed; <br /> The third year, sew thy shirt,' he said." <br /> "'And when the shirt is sewed, my fair, <br /> Then make a garland for thy hair.'" </p>
                            <p>"The shirt I finished, put away, <br /> And there it lies unto this day." <br /> "My wreath is faded, withered now — <br /> But where art thou? Oh, where art thou?" <br /> "In the wide world you went away. <br /> Wide as the sea, I heard them say." <br /> "Three years have passed — I do not know <br /> If still you live — perhaps lie low." </p>
                            <p>"Mary! Virgin of mighty strength! <br /> Give me, give me thy aid at length." <br /> "Bring, oh, bring, my loved again — <br /> Make an end of my lingering pain." <br /> "Bring my loved to me again, <br /> Or let me die — my life is vain." <br /> "I hoped indeed to be his wife — <br /> And without him — well, what is life!" <br /> "Mary! Mother of Mercy, hear, <br /> And grant my prayer even here." </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="nr">3.
                        <td>
                        <td width="265">
                            <p>Pohnul se obraz na stěně -<br /> i vzkřikla panna zděšeně;<br /> lampa, co temně hořela,<br /> prskla a zhasla docela.<br /> Možná, žeť větru tažení,<br /> možná i - zlé že znamení!</p>
                            <p>A slyš! na záspí kroků zvuk<br /> a na okénko: ťuk, ťuk, ťuk!<br /> "Spíš, má panenko, nebo bdíš?</p>
                        </td>
                        <td width="293">
                            <p>The pictured face bowed low her head — <br /> The maiden shrieked, and would have fled. <br /> The lamp that had been burning dim <br /> Went out. Was it the north — wind's whim?<br /> "Was it the wind — or can it be <br /> Some evil token unto me?" </p>
                            <p>"Hush! Did I hear a timid tap <br /> Upon the window, rap, rap, rap. <br /> "Art thou asleep, or dost thou wake? </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="nr">4.
                        <td>
                        <td width="265">
                            <p>Hoj, má panenko, tu jsem již!<br /> Hoj, má panenko, co děláš?<br /> A zdalipak mě ještě znáš,<br /> aneb jiného v srdci máš?"</p>
                            <p>"Ach můj milý, ach pro nebe,<br /> tu dobu myslím na tebe;<br /> na tě jsem vždycky myslila,<br /> za tě se právě modlila!"</p>
                            <p>"Ho, nech modlení - skoč a pojď,<br /> skoč a pojď a mě doprovoď;<br /> měsíček svítí na cestu:<br /> já přišel pro svou nevěstu."</p>
                            <p>"Ach proboha, ach co pravíš?<br /> Kam bychom šli - tak pozdě již!<br /> Vítr burácí, pustá noc,<br /> počkej jen do dne - není moc."</p>
                            <p>"Ho, den je noc, a noc je den -<br /> ve dne mé oči tlačí sen!<br /> Dřív než se vzbudí kohouti,<br /> musím tě za svou pojmouti.<br /> Jen neprodlévej, skoč a pojď,<br /> dnes ještě budeš moje choť!"</p>
                        </td>
                        <td width="293">
                            <p>Up, my beloved! Up, for my sake." <br /> "Up, my beloved, and look at me — <br /> If you still know me, I would see. <br /> And is thy hand and heart still free?" </p>
                            <p>"Oh I my beloved, and can it be! <br /> See I was thinking just of thee." <br /> "Praying indeed that we might meet, <br /> That God might lead thy wandering feet." </p>
                            <p>"Leave thy praying, and come with me — <br /> Bah on thy praying — come with me!" <br /> "The moon is shining far and wide. <br /> Come quick with me, come quick, my bride." </p>
                            <p>"For God's sake! Why, my love, 'tis night — <br /> 'Tis late — wait only for the light." <br /> "The wind howls, and the night is dark. <br /> Wait till the dawn, and then we start." </p>
                            <p>"Bah! Day is night and night is day — <br /> I dream in the daytime — come away." <br /> "Before the cock crows, thou must be <br /> My wife, so come along with me." <br /> "Don't talk, but come along with me. <br /> Ere the day dawn, my wife thou'lt be." </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="nr">5.
                        <td>
                        <td width="265">
                            <p>Byla noc, byla hluboká,<br /> měsíček svítil z vysoka<br /> a ticho, pusto v dědině,<br /> vítr burácel jedině.
                        <td>
                        <td width="293">
                            <p>It was deep midnight when they went, <br /> The moon far off watched, nearly spent. <br /> The landscape lay in silence deep, <br /> Only the wind it would not sleep. </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="nr">6.
                        <td>
                        <td width="265">
                            <p>A on tu napřed - skok a skok,<br /> a ona za ním, co jí krok.<br /> Psi houfem ve vsi zavyli,<br /> když ty pocestné zvětřili;<br /> a vyli, vyli divnou věc:<br /> žetě nablízku umrlec!</p>
                        </td>
                        <td width="293">
                            <p>And he went onward, striding fast, <br /> She, step for step, behind him passed. <br /> The dogs came out and howled in choir, <br /> When'er they passed a cottage door. <br /> And see, they saw a strange, strange sight, <br /> A corpse that walked about at night. </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="nr">7.
                        <td>
                        <td width="265">
                            <p>"Pěkná noc, jasná - v tu dobu<br /> vstávají mrtví ze hrobů,<br /> a nežli zvíš, jsou tobě blíž -<br /> má milá, nic se nebojíš?"</p>
                            <p>"Což bych se bála? Tys se mnou,<br /> a oko boží nade mnou. -<br /> Pověz, můj milý, řekni přec,<br /> živ-li a zdráv je tvůj otec?<br /> Tvůj otec a tvá milá máť,<br /> a ráda-li mě bude znáť?"</p>
                            <p>"Moc, má panenko, moc se ptáš,<br /> jen honem pojď - však uhlídáš.<br /> Jen honem pojď - čas nečeká,<br /> a cesta naše daleká.<br /> Co máš, má milá, v pravici?"</p>
                            <p>"Nesu si knížky modlicí."<br /> "Zahoď je pryč, to modlení<br /> je těžší nežli kamení!<br /> Zahoď je pryč, ať lehce jdeš,<br /> jestli mi postačiti chceš."</p>
                        </td>
                        <td width="293">
                            <p>"The night is fine — such nights the dead <br /> Rise from their graves, I've heard it said." <br /> "And ere one knows, stand by one's side — <br /> My love doth fear? Wouldst thou hide?" </p>
                            <p>"Why should I fear? Why should I hide? <br /> God is above — thou by my side." <br /> "But tell me, is your father well? <br /> And will he like with me to dwell?" <br /> "And is your mother satisfied. <br /> To have me always by her side?" </p>
                            <p>"Why, my beloved one, do you ask? <br /> Keep your health only for this task." <br /> "To reach our home — come quick, come quick — The way is long — thou art not quick." <br /> "What hast thou in thy hand, my bride?" <br /> "My mass book, that no ill betide." </p>
                            <p>"Throw it away, 'tis like a stone — <br /> I hate to hear thy praying tone." <br /> "Throw it away, thou'll lighter be. <br /> Throw it away, and come with me." </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="nr">8.
                        <td>
                        <td width="265">
                            <p>Knížky jí vzal a zahodil,<br /> a byli skokem deset mil.</p>
                            <p>A byla cesta výšinou,<br /> skalami, lesní pustinou;<br /> a v rokytí a v úskalí<br /> divoké feny štěkaly;</p>
                        </td>
                        <td width="293">
                            <p>He took the book, and tossed away — <br /> They gained ten miles upon the way. </p>
                            <p>And the path was rocky and lone, <br /> Amidst forests that made a moan. <br /> And behind the mountains and rocks <br /> Howled the wild dogs, in savage flocks. </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="nr">9.
                        <td>
                        <td width="265">
                            <p>a kulich hlásal pověsti:<br /> žetě nablízku neštěstí. -</p>
                            <p>A on vždy napřed - skok a skok,<br /> a ona za ním, co jí krok.<br /> Po šípkoví a po skalí<br /> ty bílé nohy šlapaly;<br /> a na hloží a křemení<br /> zůstalo krve znamení.
                        <td>
                        <td width="293">
                            <p>And the voice of the screech-owl told <br /> Of evil that threatened the bold. </p>
                            <p>And he went onward, striding fast, <br /> She, step for step, behind him passed. <br /> Across the stony, rocky way, <br /> Her white feet went that evil day. <br /> And e'en the weeds, and tangled grass, <br /> Were stained with blood as she did pass. </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="nr">10.
                        <td>
                        <td width="265">
                            <p>"Pěkná noc, jasná - v tento čas<br /> mrtví s živými chodí zas;<br /> a nežli zvíš, jsou tobě blíž -<br /> má milá, nic se nebojíš?"</p>
                            <p>"Což bych se bála? Tys se mnou,<br /> a ruka Páně nade mnou. -<br /> Pověz, můj milý, řekni jen,<br /> jak je tvůj domek upraven?<br /> Čistá světnička? Veselá?<br /> A zdali blízko kostela?"</p>
                            <p>"Moc, má panenko, moc se ptáš,<br /> však ještě dnes to uhlídáš.<br /> Jen honem pojď - čas utíká,<br /> a dálka ještě veliká.<br /> Co máš, má milá, za pasem?"</p>
                            <p>"Růženec s sebou vzala jsem."</p>
                            <p>"Ho, ten růženec z klokočí<br /> jako had tebe otočí!<br /> Zúží tě, stáhne tobě dech:<br /> zahoď jej pryč - neb máme spěch!"</p>
                            <p>Růženec popad, zahodil,<br /> a byli skokem dvacet mil.
                        <td>
                        <td width="293">
                            <p>"The night is fine — such nights the dead <br /> Walk with the living, I've heard said." <br /> "And ere one knows, stand by one's side — <br /> My love doth fear? Wouldst thou hide?" </p>
                            <p>"Why should I fear? Why should I hide? <br /> God is above — thou by my side." <br /> "But, tell me, is your cottage large? <br /> And who, my love, has it in charge?" <br /> "Is the room big? And is it bright? <br /> Is the church, loved one, within sight?" </p>
                            <p>"Much, my fair one, you question me; <br /> Come on, quick, then you soon will see." <br /> "Quicken thy pace, the way is long, <br /> Time flies, yes, quicker, then a song." <br /> "What hangs about thy waist, I pray?" </p>
                            <p>"My rosary I took on the way." </p>
                            <p>"Thy rosary! It winds like a snake — <br /> It makes me anxious for thy sake." <br /> "Throw it away, it stops thy speed. <br /> And follow quickly where I lead." </p>
                            <p>The rosary he threw away — <br /> Twenty miles they were on their way. </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="nr">11.
                        <td>
                        <td width="265">
                            <p>A byla cesta nížinou,<br /> přes vody, luka, bažinou;<br /> a po bažině, po sluji<br /> modrá světélka laškují:<br /> dvě řady, devět za sebou,<br /> jako když s tělem k hrobu jdou;<br /> a žabí havěť v potoce<br /> pohřební píseň skřehoce. -</p>
                            <p>A on vždy napřed - skok a skok,<br /> a jí za ním již slábne krok.<br /> Ostřice dívku ubohou<br /> břitvami řeže do nohou;<br /> a to kapradí zelené<br /> je krví její zbarvené.
                        <td>
                        <td width="293">
                            <p>And the road was swampy and bad. <br /> By morasses, desolate, sad. <br /> O'er the marshes the corpse-lights shone, <br /> Ghastly blue they glimmered alone. <br /> Nine on each side, they went ahead, <br /> As though they burned for some poor dead. <br /> The frogs they sang the burial hymn, <br /> The blue lights flickered and grew dim. </p>
                            <p>And he went onward, striding fast, <br /> She wearily behind him passed. <br /> Poor maiden, why your feet are sore, <br /> And blood runs where your feet you tore. <br /> The weeds are covered with your blood, <br /> But on he strides with heavy thud. </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="nr">12.
                        <td>
                        <td width="265">
                            <p>"Pěkná noc, jasná - v tu dobu<br /> spěchají živí ke hrobu;<br /> a nežli zvíš, jsi hrobu blíž -<br /> má milá, nic se nebojíš?"</p>
                            <p>"Ach nebojím, vždyť tys se mnou,<br /> a vůle Páně nade mnou!<br /> Jen ustaň málo v pospěchu,<br /> jen popřej málo oddechu.<br /> Duch slábne, nohy klesají,<br /> a k srdci nože bodají!"</p>
                            <p>"Jen pojď a pospěš, děvče mé,<br /> však brzo již tam budeme.<br /> Hosté čekají, čeká kvas,<br /> a jako střela letí čas. -<br /> Co to máš na té tkaničce<br /> na krku na té tkaničce?"</p>
                            <p>"To křížek po mé matičce."</p>
                            <p>"Hoho, to zlato proklaté<br /> má hrany ostře špičaté!<br /> Bodá tě - a mě nejinak,<br /> zahoď to, budeš jako pták!</p>
                            <p>Křížek jí vzal a zahodil,<br /> a byli skokem třicet mil.
                        <td>
                        <td width="293">
                            <p>"The night is fine — such nights the dead <br /> Seek out the living, I've heard said." <br /> "And ere one thinks, one's grave is near — <br /> Say, my beloved, dost thou fear?" </p>
                            <p>"I fear not; thou art by my side — <br /> And God's will — why it must betide." <br /> "But wait a moment, let me stay, <br /> And rest a while upon the way." <br /> Her soul was faint, her knees were weak. <br /> And swords seemed in her heart to meet. </p>
                            <p>"Come quick, come quick, oh maiden mine. <br /> Our home is near, make no repine." <br /> "The banquet's spread — the guests they wait <br /> Time flies, we surely will be late." <br /> "What hast thou on that ribbon fine <br /> Upon thy throat, oh loved one mine?" </p>
                            <p>"My mother's cross — the cross divine." </p>
                            <p>"Ha, ha, that golden cross it pricks — <br /> I see the blood it slowly tricks." <br /> "It wounds you — cast it from you now, <br /> Then you'll speed on, you know not how." </p>
                            <p>The cross he took, and cast away — <br /> Thirty miles they gained on their way. </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="nr">13.
                        <td>
                        <td width="265">
                            <p>Tu na planině široké<br /> stavení stojí vysoké;<br /> a úzká dlouhá okna jsou,<br /> a věž se zvonkem nad střechou.
                        <td>
                        <td width="293">
                            <p>Upon a wide and open plain <br /> She saw a building once again. <br /> The windows they were narrow, high, <br /> A bell hung in the turret nigh. </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="nr">14.
                        <td>
                        <td width="265">
                            <p>"Hoj, má panenko, tu jsme již!<br /> Nic, má panenko, nevidíš?"</p>
                            <p>"Ach proboha, ten kostel snad?<br /> Ten hřbitov - a těch křížů řad?"</p>
                            <p>"To není kostel, to můj hrad!"<br /> To nejsou kříže, to můj sad!<br /> Hoj, má panenko, na mě hleď<br /> a skoč vesele přes tu zeď!"</p>
                            <p>"Ó nech mne již, ó nech mne tak!<br /> Divý a hrozný je tvůj zrak;<br /> tvůj dech otravný jako jed,<br /> a tvoje srdce tvrdý led!"</p>
                            <p>"Nic se, má milá, nic neboj!<br /> Veselo u mne, všeho hoj:<br /> masa dost - ale bez krve,<br /> dnes bude jinak poprvé! -<br /> Co máš v uzlíku, má milá?"</p>
                            <p>"Košile, co jsem ušila."</p>
                            <p>"Netřeba jich víc nežli dvě:<br /> ta jedna tobě, druhá mně."</p>
                            <p>Uzlík jí vzal a s chechtotem<br /> jej hodil na hrob za plotem.<br /> „Nic ty se neboj, na mě hleď<br /> a skoč za uzlem přes tu zeď."</p>
                            <p>"Však jsi ty vždy byl přede mnou,<br /> a já za tebou cestou zlou;<br /> však jsi byl napřed po ten čas:<br /> skoč a ukaž mi cestu zas!"</p>
                        </td>
                        <td width="293">
                            <p>"Look, my beloved one, we are near. <br /> How does it please thee, let me hear" </p>
                            <p>"Ah God! It is a church I see" <br /> "Tis no church, but belongs to me!" </p>
                            <p>"That churchyard, and those crosses thine?" <br /> "No crosses — trees for which I pine!" <br /> "Look on me, loved one, over all, <br /> Then quickly jump over the wall." </p>
                            <p>"Oh, let me be, thy look is wild — <br /> Thou art no longer gentle, mild." <br /> "Thy breath is like a poison rare. <br /> Thy heart it is no longer there." </p>
                            <p>"Oh, fear me not! A happy life <br /> Is thine if thou wilt be my wife. <br /> "Meat thou'lt have — without blood I say. <br /> Except by hazard — just to-day." <br /> "What hast thou in thy bundle there?" </p>
                            <p>"The shirts I made of linen fair." </p>
                            <p>"Two are enough — throw them away. <br /> One for us each, enough I say." </p>
                            <p>He threw the bundle on the wall. <br /> It fell upon a gravestone tall. <br /> "Be not afraid, but look at me. <br /> And jump across the wall you see." </p>
                            <p>"You went before me all the way. <br /> Then lead across the wall, I pray." <br /> "I followed but the path you trod. <br /> Jump over first upon the sod." </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="nr">15.
                        <td>
                        <td width="265">
                            <p>Skokem přeskočil ohradu,<br /> nic nepomyslil na zradu;<br /> skočil do výše sáhů pět -<br /> jí však již venku nevidět:<br /> jenom po bílém obleku<br /> zablesklo se jest v útěku,<br /> a schrána její blízko dost -<br /> nenadál se zlý její host!</p>
                            <p>Stojíť tu, stojí komora:<br /> nizoučké dvéře - závora;<br /> zavrzly dvéře za pannou<br /> a závora jí ochranou.<br /> Stavení skrovné, bez oken,<br /> měsíc lištami šeřil jen;<br /> stavení pevné jako klec,<br /> a v něm na márách - umrlec.</p>
                            <p>Hoj, jak se venku vzmáhá hluk,<br /> hrobových oblud mocný pluk;<br /> šumí a kolem klapají<br /> a takto píseň skuhrají:</p>
                            <p>"Tělu do hrobu přísluší,<br /> běda, kdos nedbal o duši!"</p>
                        </td>
                        <td width="293">
                            <p>He jumped across the churchyard wall. <br /> He thought of treason not at all. <br /> Five feet he leaped into the air. <br /> Then he looked back, no maid was there. <br /> But like a flash he saw a form <br /> Glide by him, in the dark, forlorn. <br /> There stood indeed a chamber small. <br /> One heard the latchstring quickly fall. </p>
                            <p>A narrow room, with windows none — <br /> Through chinks the moonlight passage won. <br /> And in that cage-like room on bier, <br /> A corpse is laid with no one near. <br /> Ah, what is this — this nameless fear — <br /> The ghouls are stirring — they are here! <br /> One hears them — they are gliding on — <br /> And strange and weird their ghostly song. </p>
                            <p>"The body to the earth is told, <br /> Alas! for him who lost his soul." <br /> And on the door one heard them rap. <br /> And awful was their tap, tap, tap. </p>
                            <p>"Arise, oh dead one, from thy bier, <br /> Pull back the latch, we all are here." </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="nr">16.
                        <td>
                        <td width="265">
                            <p>A tu na dvéře: buch, buch, buch!<br /> burácí zvenčí její druh:<br /> "Vstávej, umrlče, nahoru,<br /> odstrč mi tam tu závoru!"</p>
                            <p>A mrtvý oči otvírá,<br /> a mrtvý oči protírá,<br /> sbírá se, hlavu pozvedá<br /> a půlkolem se ohlédá.</p>
                            <p>"Bože svatý, rač pomoci,<br /> nedej mne ďáblu do moci! -<br /> Ty mrtvý, lež a nevstávej,<br /> pánbůh ti pokoj věčný dej!"</p>
                            <p>A mrtvý hlavu položiv,<br /> zamhouřil oči jako dřív. -</p>
                            <p>A tu poznovu - buch, buch, buch!<br /> silněji tluče její druh:<br /> "Vstávej, umrlče, nahoru,<br /> otevři mi svou komoru!"</p>
                            <p>A na ten hřmot a na ten hlas<br /> Se mrtvý zdvihá z prkna zas<br /> a rámě ztuhlé naměří<br /> tam závora kde u dveří.</p>
                            <p>"Spas duši, Kriste Ježíši,<br /> smiluj se v bídě nejvyšší! -<br /> Ty mrtvý, nevstávej a lež;<br /> pánbůh tě potěš - a mne též!"</p>
                            <p>A mrtvý zas se položiv,<br /> natáhnul údy jako dřív. -</p>
                            <p>A znova venku: buch, buch, buch!<br /> a panně mizí zrak i sluch!<br /> Vstávej, umrlče, hola hou,<br /> a podej mi sem tu živou!</p>
                            <p>Ach běda, běda děvčeti!<br /> Umrlý vstává potřetí<br /> velké, kalné své oči<br /> na polomrtvou otočí.
                        <td>
                        <td width="293">
                            <p>The dead one opens wide his eyes, <br /> He makes as though he would arise. <br /> His head he raises from the bier, <br /> He looks about him, far and near. </p>
                            <p>"Great God! Thy mercy now I pray — <br /> Oh, keep me from the devil's sway!" <br /> "You dead one, lay you down to sleep — <br /> God in His mercy, thy soul keep." </p>
                            <p>The corpse lay down again in peace, <br /> Of sleep he took another lease. <br /> But listen! Once again the rap, <br /> And stronger now their tap, tap, tap. </p>
                            <p>"Arise, oh dead one, from thy bier. <br /> Open the room — the dead are here." </p>
                            <p>And at that knock, and at that song, <br /> The dead woke from his slumbers strong. <br /> He stretched his stiff arm to the door, <br /> And would perhaps have gained the floor. </p>
                            <p>"Christ save thy soul! And mercy give — <br /> He can and will, thy sins forgive!" <br /> "You dead one, lay you down to sleep, <br /> God give you joy, and slumber deep." </p>
                            <p>The corpse he stretched him out again, <br /> And stiffly lay as he had lain. <br /> And once again that awful rap — <br /> Her head reeled as she heard that tap. </p>
                            <p>"Arise, oh dead one, from thy bier, <br /> Give us the living — do you hear?" </p>
                            <p>Alas! alas! poor maiden mine, <br /> The dead are here, for the third time. <br /> The dead stares from his sunken eyes, <br /> He looks to where the maiden lies. </p>
                            <p>"Mary! Mother of God, be near! <br /> Pray to thy son, I fear, I fear!" <br /> "The prayer I prayed it was not right. <br /> Forgive me! Save me in thy might." </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="nr">17.
                        <td>
                        <td width="265">
                            <p>"Maria Panno, při mně stůj,<br /> u syna svého oroduj!<br /> Nehodně jsem tě prosila:<br /> ach odpusť, co jsem zhřešila!<br /> Maria, matko milosti,<br /> z té moci zlé mě vyprosti."</p>
                        </td>
                        <td width="293">
                            <p>"Mary! Mother of mercy hear! <br /> Save me, oh save me, even here." <br /> And see — just at that moment dread, <br /> The cock crows, and the dead falls dead. <br /> And all around the cocks crow clear, <br /> The night is past, the dawn is near. </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="nr">18.
                        <td>
                        <td width="265">
                            <p>A slyš, tu právě nablízce<br /> kokrhá kohout ve vísce;<br /> a za ním, co ta dědina,<br /> všecka kohoutí družina.</p>
                            <p>Tu mrtvý, jak se postavil,<br /> pádem se na zem povalil,<br /> a venku ticho - ani ruch:<br /> zmizel dav, i zlý její druh. -</p>
                            <p>Ráno když lidé na mši jdou,<br /> v úžasu státi zůstanou:<br /> hrob jeden dutý nahoře,<br /> panna v umrlčí komoře,<br /> a na každičké mohyle<br /> útržek z nové košile. -</p>
                            <p>Dobře ses, panno, radila,<br /> na boha že jsi myslila<br /> a druha zlého odbyla!<br /> Bys byla jinak jednala,<br /> zle bysi byla skonala:<br /> tvé tělo bílé, spanilé,<br /> bylo by co ty košile!</p>
                        </td>
                        <td width="293">
                            <p>The dead one lies upon the floor, <br /> Just as he went to open the door. <br /> Without the silence is profound, <br /> Unbroken by a single sound. </p>
                            <p>The sun rose high, the people came, <br /> To hear the mass and praise God's name. <br /> A new and open grave they found — <br /> The girl was in the dead-house round. </p>
                            <p>A wedding favor on each mound, <br /> Made from her shirts, they quickly found. <br /> Thev filled the grave, and burnt with care, <br /> Eacn rag that they found anywhere. <br /> The maiden from a foreign part, <br /> They kindly took unto their heart. </p>
                            <p>"Well for you, maiden, that you prayed, <br /> Of evil that you were afraid; <br /> And even in God's ways have strayed." <br /> "Or, like your shirts, you would have been <br /> Torn into bits, by ghouls, I ween." <br /> "Well for you that you knelt to pray, <br /> Or lost your soul had been this day." </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>