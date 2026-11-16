<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/cursussen.php';
$cursusnr = 2 + $cursus_offset;
// Forceer een frisse CSS-lading telkens wanneer deze pagina wordt geopend, ook in een nieuw venster.
$cssVersion = '?v=' . time(); ?>
<!DOCTYPE HTML>
<html>

<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <link rel="stylesheet"
                href="/css/pellegrina_stijlen.css<?php echo $cssVersion; ?>"
                type="text/css">
        <title>Information & scores
                <?php echo $cursussen[$cursusnr]['cursusnaam_en'] ?></title>
        <meta name="robots" content="noindex, nofollow">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.EN.php'; ?>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
</head>

<body class="downloads-baroque">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
        <div id="inhoud">
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.EN.php'; ?>
                <div id="main">
                        <table width="100%" border="1">
                                <tr>
                                        <th>List of participants</th>
                                        <th>Chamber music formations</th>
                                        <th>Room divisions </th>
                                        <th>Accommodation near<br>Nieuw Sion</th>
                                        <th>Daily program</th>
                                        <th>Flyer concert</th>
                                </tr>
                                <tr>
                                        <td class="w3-center"><a class="grijs">List of
                                                        participants</a></td>
                                        <td class="w3-center"><a class="grijs">Chamber music
                                                        ensembles</a></td>
                                        <td class="w3-center"><a class="grijs">Overview of
                                                        accommodation</a></td>
                                        <td class="w3-center"><a
                                                        href="https://docs.google.com/document/d/1ODcgAmuTYIfNC9DKLaU0f6zed2uJvaJ6aoiIGp2Sb1A/edit?usp=sharing"
                                                        target="_blank">Accommodation near<br>Nieuw Sion</a>
                                        </td>
                                        <td class="w3-center"><a class="grijs">Daily program</a>
                                        </td>
                                        <td class="w3-center"><a class="grijs">Information &
                                                        reservation concert</a></td>
                                </tr>
                        </table>
                        <div class="onzichtbaar">
                                <h2 class="onzichtbaar">Some chamber music works</h2>
                                <p>Most chamber music works are available on the International
                                        Music Score Library Project (IMSLP) or the Choral Public
                                        Domain Library (CPDL). Only works that are not generally
                                        available are listed below.</p>
                                <h4 class="onzichtbaar">Domenico Scarlatti - Salve Regina (set 2
                                        nr. 2)</h4>
                                <li>Full score</li>
                                <li>Violin 1</li>
                                <li>Violin 2</li>
                                <li>Viola</li>
                                <li>Cello</li>
                                <h2 class="onzichtbaar">Tutti programme</h2>
                                <p>All works we are going to perform are now available here.
                                        Please print and study what you need. The string parts will
                                        soon have bowings; string players will be notified.</p>
                                <p>Singers, please print out the vocal scores and bring them
                                        with you. Study the choral parts as well as your solo parts.
                                </p>
                                <h4 class="onzichtbaar">Heinichen, Johann David - Concerto à 7
                                        S.215</h4>
                                <p class="nadruk">A new edition has been made by Lea, extending
                                        the recorder parts with the tutti sections and giving more
                                        common clefs in the 2nd violin. Please only use this new
                                        edition.</p>
                                <div class="cols3">
                                        <ul>
                                                <li>Full score <b>with bowings</b>
                                                </li>
                                                <li>Flute 1/2</li>
                                                <li>Oboe 1/2</li>
                                                <li>Violin 1</li>
                                                <li>Violin 2</li>
                                                <li>Viola</li>
                                                <li>Cello, double bass, bassoon </li>
                                        </ul>
                                </div>
                                <h4 class="onzichtbaar">Biber, Heinrich - De Profundis</h4>
                                <div class="cols3">
                                        <ul>
                                                <li>Biber, Heinrich - De Profundis <b>Full score with
                                                                bowings</b>
                                                </li>
                                                <li>Biber, Heinrich - De Profundis - Vocal score & BC
                                                </li>
                                                <li>Biber, Heinrich - De Profundis - Recorders, oboes
                                                </li>
                                                <li>Biber, Heinrich - De Profundis - Alto trombone </li>
                                                <li>Biber, Heinrich - De Profundis - Tenor trombone
                                                </li>
                                                <li>Biber, Heinrich - De Profundis - Bass trombone,
                                                        bassoon </li>
                                                <li>Biber, Heinrich - De Profundis - Violin 1 </li>
                                                <li>Biber, Heinrich - De Profundis - Violin 2 </li>
                                                <li>Biber, Heinrich - De Profundis - Viola 1 </li>
                                                <li>Biber, Heinrich - De Profundis - Viola 2 </li>
                                                <li>Biber, Heinrich - De Profundis - Cello, double bass,
                                                        BC </li>
                                                <li>Biber, Heinrich - De Profundis - BC part with empty
                                                        stave </li>
                                        </ul>
                                </div>
                                <h4 class="onzichtbaar">Zelenka, Jan Dismas - Ecce nunc
                                        benedicite, ZWV 99</h4>
                                <div class="cols3">
                                        <ul>
                                                <li>Zelenka - Ecce - Score <b>with bowings</b></li>
                                                <li>Zelenka - Ecce - Oboe 1</li>
                                                <li>Zelenka - Ecce - Oboe 2</li>
                                                <li>Zelenka - Ecce - Violin 1 </li>
                                                <li>Zelenka - Ecce - Violin 2 </li>
                                                <li>Zelenka - Ecce - Viola</li>
                                                <li>Zelenka - Ecce - Cello, double bass, bassoon</li>
                                                <li>Zelenka - Ecce - Organ BC </li>
                                        </ul>
                                </div>
                                <h4 class="onzichtbaar">Hasse, Johann Adolph - Miserere in c
                                        moll</h4>
                                <div class="w3-panel w3-border w3-light-grey">
                                        <p><b>N.B.</b> only the following sections of this Miserere
                                                will be performed:</p>
                                        <div class="cols2">
                                                <ul>
                                                        <li>I. Miserere mei Deus</li>
                                                        <li>II.Tibi soli peccavi</li>
                                                        <li>IV. Libera me de sanguinibus Deus</li>
                                                        <li>V. Quoniam si voluisses</li>
                                                </ul>
                                        </div>
                                </div>
                                </p>
                                <div class=" cols3">
                                        <ul class="cols3">
                                                <li>Hasse - Miserere in c moll - Full score <b>with
                                                                bowings in movements 1, 2, 4 and 5</b></li>
                                                <li>Hasse - Miserere in c moll - Violin I</li>
                                                <li>Hasse - Miserere in c moll - Violin II</li>
                                                <li>Hasse - Miserere in c moll - Viola I-II</li>
                                                <li>Hasse - Miserere in c moll - Viola III</li>
                                                <li>Hasse - Miserere in c moll - Cello, double bass</li>
                                        </ul>
                                </div>
                                <h4 class="onzichtbaar">Heinichen, Johann David - Confitebor
                                        S.32</h4>
                                <div class="cols3">
                                        <ul>
                                                <li>Heinichen - Confitebor S.32 - Full score <b>with
                                                                bowings</b></li>
                                                <li>Heinichen - Confitebor S.32 - Violin 1</li>
                                                <li>Heinichen - Confitebor S.32 - Violin 2</li>
                                                <li>Heinichen - Confitebor S.32 - Viola </li>
                                                <li>Heinichen - Confitebor S.32 - Cello, double bass
                                                </li>
                                        </ul>
                                </div>
                                <h4 class="onzichtbaar">Biber, Heinrich - Requiem in f</h4>
                                <div class="cols3">
                                        <ul>
                                                <li>Biber - Requiem in f - Full score <b>with
                                                                bowings</b></li>
                                                <li>Biber - Requiem in f - Vocal score</li>
                                                <li>Biber - Requiem in f - Violin I </li>
                                                <li>Biber - Requiem in f - Violin II </li>
                                                <li>Biber - Requiem in f - Viola I </li>
                                                <li>Biber - Requiem in f - Viola I (in vioolsleutel)
                                                </li>
                                                <li>Biber - Requiem in f - Viola II </li>
                                                <li>Biber - Requiem in f - Viola III </li>
                                                <li>Biber - Requiem in f - Violone </li>
                                                <li>Biber - Requiem in f - Alto trombone (also viola da
                                                        gamba)</li>
                                                <li>Biber - Requiem in f - Tenor trombone (also viola da
                                                        gamba)</li>
                                                <li>Biber - Requiem in f - Bass trombone (also viola da
                                                        gamba)</li>
                                                <li>Biber - Requiem in f - BC </li>
                                        </ul>
                                </div>
                        </div>
                        <h2> <a href="javascript:history.back()">Back</a></h2>
                        <p>&nbsp;</p>
                </div>
        </div>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html>