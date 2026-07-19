<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/cursussen.php';
$cursusnr = 2 + $cursus_offset; ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <!-- CSS: -->
    <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Information & scores
        <?php echo $cursussen[$cursusnr]['cursusnaam_en'] ?></title>
    <meta name="robots" content="noindex, nofollow">
    <!-- InstanceEndEditable -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.EN.php'; ?>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
    <link href="/css/pagina_stijlen_algemeen.css" rel="stylesheet"
        type="text/css">
    <!-- InstanceBeginEditable name="head" -->
    <link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        h3 {
            margin: 25px 0px 15px;
            padding: 0px;
        }

        table#parts tr,
        td {
            margin: 10px 5px;
            padding: 5px;
        }
    </style>
    <!-- InstanceEndEditable -->
</head>

<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
    <div id="inhoud">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.EN.php'; ?>
        <div id="main">
            <!-- InstanceBeginEditable name="mainpage" -->
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
                    <td class="w3-center"><a href="../part_list.php?cursus=2"
                            target="_blank">List of participants</a></td>
                    <td class="w3-center"><a
                            href="https://pellegrina.net/ensemblelijst_2.php"
                            target="_blank">Chamber music ensembles</a></td>
                    <td class="w3-center"><a
                            href="https://docs.google.com/spreadsheets/d/e/2PACX-1vTU_T6ifuUO40FAMPOA-I_v5GOIo00yKUIFCEbkuEyQ9VCw05pTswkFi7Z1UiQCtne9X9GzTNMKx7sS/pubhtml?gid=0&single=true"
                            target="_blank">Overview of accommodation</a></td>
                    <td class="w3-center"><a
                            href="https://docs.google.com/document/d/1ODcgAmuTYIfNC9DKLaU0f6zed2uJvaJ6aoiIGp2Sb1A/edit?usp=sharing"
                            target="_blank">Accommodation near<br>Nieuw Sion</a>
                    </td>
                    <td class="w3-center"><a
                            href="https://docs.google.com/document/d/e/2PACX-1vSXywNgXj36DpMyjGpYuh20GpRdJugAzvmj8zXUthx0mOB2Lx9zzAeSFcepXTpQTveO17gRBWNCZ5Of/pub"
                            target="_blank">Daily program</a></td>
                    <td class="w3-center"><a
                            href="https://www.pellegrina.net/barok2026/"
                            target="_blank">Information & reservation
                            concert</a></td>
                </tr>
            </table>
            <div class="onzichtbaar">
                <h2>Some chamber music works</h2>
                <p>Most chamber music works are available on the <a
                        href="https://imslp.org/" target="_blank">International
                        Music Score Library Project (IMSLP)</a> or the <a
                        href="https://www.cpdl.org/" target="_blank">Choral
                        Public Domain Library (CPDL)</a>. Only works that are
                    not generally available are listed below.</p>
                <h4>Domenico Scarlatti - Salve Regina (set 2 nr. 2)</h4>
                <li><a href="/pdf/2025-2/Scarlatti D. - Salve Regina/ScarlattiD-SalveRegina-(S,A,Streicher,Orgel).pdf"
                        target="_blank">Full score</a></li>
                <li><a href="/pdf/2025-2/Scarlatti D. - Salve Regina/ScarlattiD-SalveRegina-Violine1.pdf"
                        target="_blank">Violin 1</a></li>
                <li><a href="/pdf/2025-2/Scarlatti D. - Salve Regina/ScarlattiD-SalveRegina-Violine2.pdf"
                        target="_blank">Violin 2</a></li>
                <li><a href="/pdf/2025-2/Scarlatti D. - Salve Regina/ScarlattiD-SalveRegina-Viola.pdf"
                        target="_blank">Viola</a></li>
                <li><a href="/pdf/2025-2/Scarlatti D. - Salve Regina/ScarlattiD-SalveRegina-Cello-B<br></p>ss.pdf"
                        target="_blank">Cello</a></li>
            </div>
            <h2>Tutti programme</h2>
            <p>All works we are going to perform are now available here. Please
                print and study what you need. The string parts will soon have
                bowings; string players will be notified.</p>
            <p>Singers, please print out the vocal scores and bring them with
                you. Study the choral parts as well as your solo parts.</p>
            <p>The singers will be divided as follows in the choral sections:
            </p>
            <div class="w3-panel w3-border w3-light-grey w3-clear">
                <div class="w3-left w3-margin-right">
                    <p><i>Soprano:</i><br>Rhona Lonergan<br>Anke Muusse<br>Joyce
                        Vermeer<br>Anne Hodgkinson<br>Birthe Rubehn</p>
                </div>
                <div class="w3-left w3-margin-right">
                    <p><i>Alto:</i><br>Hilda Houtkoop<br>Vivian
                        Stemerdink<br>Marie Brummelhuis<br>Jana
                        Dvořáčková<br>Marleen van Reenen</p>
                </div>
                <div class="w3-left w3-margin-right">
                    <p><i>Tenor:</i><br>Joost Fransen<br>Jonathan Greene</p>
                </div>
                <div class="w3-left w3-margin-right">
                    <p><i>Bass:</i><br>Jurgen van der Ent<br>Jan
                        Dvořáček<br>Frits Muusse<br>Peter van Zaanen<br>Pierre
                        Eijgenraam<br>Stefan Op de Beek</p>
                </div>
            </div>
            <p>In Hasse's Miserere only the women sing, in this division: </p>
            <div class="w3-panel w3-border w3-light-grey w3-clear">
                <div class="w3-left w3-margin-right">
                    <p><i>Soprano 1:</i><br>Rhona Lonergan<br>Anne Hodgkinson
                    </p>
                </div>
                <div class="w3-left w3-margin-right">
                    <p><i>Soprano 2:</i><br>Joyce Vermeer<br>Anke
                        Muusse<br>Birthe Rubehn</p>
                </div>
                <div class="w3-left w3-margin-right">
                    <p><i>Alto 1:</i><br>Hilda Houtkoop<br>Vivian
                        Stemerdink<br>Marie Brummelhuis</p>
                </div>
                <div class="w3-left w3-margin-right">
                    <p><i>Alto 2:</i><br>Jana Dvořáčková<br>Marleen van Reenen
                    </p>
                </div>
            </div>
            <p>In Biber's Requiem, the sopranos and altos will be divided as
                follows in the choral sections:</p>
            <div class="w3-panel w3-border w3-light-grey w3-clear">
                <div class="w3-left w3-margin-right">
                    <p><i>Soprano 1:</i><br>Rhona Lonergan<br>Joyce
                        Vermeer<br>Anne Hodgkinson</p>
                </div>
                <div class="w3-left w3-margin-right">
                    <p><i>Soprano 2:</i><br>Anke Muusse<br>Birthe
                        Rubehn<br>Vivian Stemerdink<br>Marie Brummelhuis</p>
                </div>
                <div class="w3-left w3-margin-right">
                    <p><i>Alto:</i><br>Hilda Houtkoop<br>Jana
                        Dvořáčková<br>Marleen van Reenen</p>
                </div>
            </div>
            <h4>Heinichen, Johann David - Concerto à 7 S.215</h4>
            <p class="nadruk">A new edition has been made by Lea, extending the
                recorder parts with the tutti sections and giving more common
                clefs in the 2nd violin. Please only use this new edition.</p>
            <div class="cols3">
                <ul>
                    <li><a href="/pdf/2026-2/Heinichen/Heinichen, Johann David - Concerto à 7 S.215 Full score -met streken.pdf"
                            target="_blank">Full score <b>with bowings</b></a>
                    </li>
                    <li><a href="/pdf/2026-2/Heinichen/hein 215 recorders 1 and 2.pdf"
                            target="_blank">Flute 1/2</a></li>
                    <li><a href="/pdf/2026-2/Heinichen/hein 215-1 test _oboe 1_oboe 2 geheel.pdf"
                            target="_blank">Oboe 1/2</a></li>
                    <li><a href="/pdf/2026-2/Heinichen/hein 215 vi 1.pdf"
                            target="_blank">Violin 1</a></li>
                    <li><a href="/pdf/2026-2/Heinichen/Hein 215 vi 2.pdf"
                            target="_blank">Violin 2</a></li>
                    <li><a href="/pdf/2026-2/Heinichen/hein 215-viola.pdf"
                            target="_blank">Viola</a></li>
                    <li><a href="/pdf/2026-2/Heinichen/Heinichen 215 bassi.pdf"
                            target="_blank">Cello, double bass, bassoon</a>
                    </li>
                </ul>
            </div>
            <h4>Biber, Heinrich - De Profundis</h4>
            <div class="w3-panel w3-border w3-light-grey w3-clear"> Division of
                the strings: violin 1: Femke, Birgit, Corinne, Maille, Barbara;
                violin 2: Louis, Eliane, Karin, Lea; viola 1: Peter, Renske;
                viola 2: Baukje; cello: Karel, Sanne, Franca, Patrick; double
                bass: Hendrik </div>
            <div class="cols3">
                <ul>
                    <li><a href="/pdf/2026-2/Biber_DP/Biber - De profundis - Full Score met streken.pdf"
                            target="_blank">Biber, Heinrich - De Profundis
                            <b>Full score with bowings</b></a>
                    </li>
                    <li><a href="/pdf/2026-2/Biber_DP/Biber - De profundis - Voices & BC.pdf"
                            target="_blank">Biber, Heinrich - De Profundis -
                            Vocal score & BC</a>
                    </li>
                    <li><a href="/pdf/2026-2/Biber_DP/Biber - De profundis - Cornetto ripieno.pdf"
                            target="_blank">Biber, Heinrich - De Profundis -
                            Recorders, oboes</a>
                    </li>
                    <li><a href="/pdf/2026-2/Biber_DP/Biber - De profundis - Alto Trombone ripieno.pdf"
                            target="_blank">Biber, Heinrich - De Profundis -
                            Alto trombone</a>
                    </li>
                    <li><a href="/pdf/2026-2/Biber_DP/Biber - De profundis - Tenor Trombone ripieno.pdf"
                            target="_blank">Biber, Heinrich - De Profundis -
                            Tenor trombone</a>
                    </li>
                    <li><a href="/pdf/2026-2/Biber_DP/Biber - De profundis - Bass Trombone ripieno.pdf"
                            target="_blank">Biber, Heinrich - De Profundis -
                            Bass trombone, bassoon</a>
                    </li>
                    <li><a href="/pdf/2026-2/Biber_DP/Biber - De profundis - Violino primo.pdf"
                            target="_blank">Biber, Heinrich - De Profundis -
                            Violin 1</a>
                    </li>
                    <li><a href="/pdf/2026-2/Biber_DP/Biber - De profundis - Violino secundo.pdf"
                            target="_blank">Biber, Heinrich - De Profundis -
                            Violin 2</a>
                    </li>
                    <li><a href="/pdf/2026-2/Biber_DP/Biber - De profundis - Viola prima.pdf"
                            target="_blank">Biber, Heinrich - De Profundis -
                            Viola 1</a>
                    </li>
                    <li><a href="/pdf/2026-2/Biber_DP/Biber - De profundis - Viola secunda.pdf"
                            target="_blank">Biber, Heinrich - De Profundis -
                            Viola 2</a>
                    </li>
                    <li><a href="/pdf/2026-2/Biber_DP/Biber - De profundis - Cello, double bass.pdf"
                            target="_blank">Biber, Heinrich - De Profundis -
                            Cello, double bass, BC</a>
                    </li>
                    <li><a href="/pdf/2026-2/Biber_DP/Biber - De profundis - Organo.pdf"
                            target="_blank">Biber, Heinrich - De Profundis - BC
                            part with empty stave</a>
                    </li>
                </ul>
            </div>
            <h4>Zelenka, Jan Dismas - Ecce nunc benedicite, ZWV 99</h4>
            <div class="cols3">
                <ul>
                    <li><a href="/pdf/2026-2/Zelenka_Ecce/Zelenka - Ecce - Partitur MET STREKEN.pdf"
                            target="_blank">Zelenka - Ecce - Score <b>with
                                bowings</b></a></li>
                    <li><a href="/pdf/2026-2/Zelenka_Ecce/Zelenka - Ecce - Oboe1.pdf"
                            target="_blank">Zelenka - Ecce - Oboe 1</a></li>
                    <li><a href="/pdf/2026-2/Zelenka_Ecce/Zelenka - Ecce - Oboe2.pdf"
                            target="_blank">Zelenka - Ecce - Oboe 2</a></li>
                    <li><a href="/pdf/2026-2/Zelenka_Ecce/Zelenka - Ecce - Violino1.pdf"
                            target="_blank">Zelenka - Ecce - Violin 1</a>
                    </li>
                    <li><a href="/pdf/2026-2/Zelenka_Ecce/Zelenka - Ecce - Violino2.pdf"
                            target="_blank">Zelenka - Ecce - Violin 2</a>
                    </li>
                    <li><a href="/pdf/2026-2/Zelenka_Ecce/Zelenka - Ecce - Viola.pdf"
                            target="_blank">Zelenka - Ecce - Viola</a></li>
                    <li><a href="/pdf/2026-2/Zelenka_Ecce/Zelenka - Ecce - Bassi.pdf"
                            target="_blank">Zelenka - Ecce - Cello, double bass,
                            bassoon</a></li>
                    <li><a href="/pdf/2026-2/Zelenka_Ecce/Zelenka - Ecce - Organo.pdf"
                            target="_blank">Zelenka - Ecce - Organ BC</a>
                    </li>
                </ul>
            </div>
            <h4>Hasse, Johann Adolph - Miserere in c moll</h4>
            <div class="w3-panel w3-border w3-light-grey">
                <p><b>N.B.</b> only the following sections of this Miserere will
                    be performed:</p>
                <div class="cols2">
                    <ul>
                        <li>I. Miserere mei Deus</li>
                        <li>II.Tibi soli peccavi</li>
                        <li>IV. Libera me de sanguinibus Deus</li>
                        <li>V. Quoniam si voluisses</li>
                    </ul>
                </div>
                <p>Division of the strings: violin 1: Femke, Birgit, Corinne,
                    Maille, Barbara; violin 2: Louis, Eliane, Karin, Lea; viola:
                    Baukje (I), Renske (II), Peter (III, only the bottom notes
                    when two-part); cello: Karel, Sanne, Franca, Patrick; double
                    bass: Hendrik.</p>
            </div>
            </p>
            <div class=" cols3">
                <ul class="cols3">
                    <li><a href="/pdf/2026-2/Hasse/Miserere-Hasse_score met ALLE streken deel 1, 2 4 en 5.pdf"
                            target="_blank">Hasse - Miserere in c moll - Full
                            score <b>with bowings in movements 1, 2, 4 and
                                5</b></a></li>
                    <li><a href="/pdf/2026-2/Hasse/Miserere-Hasse_Violino I.pdf"
                            target="_blank">Hasse - Miserere in c moll - Violin
                            I</a></li>
                    <li><a href="/pdf/2026-2/Hasse/Miserere-Hasse_Violino II.pdf"
                            target="_blank">Hasse - Miserere in c moll - Violin
                            II</a></li>
                    <li><a href="/pdf/2026-2/Hasse/Miserere-Hasse_Viola I-II.pdf"
                            target="_blank">Hasse - Miserere in c moll - Viola
                            I-II</a></li>
                    <li><a href="/pdf/2026-2/Hasse/Miserere-Hasse_Viola III.pdf"
                            target="_blank">Hasse - Miserere in c moll - Viola
                            III</a></li>
                    <li><a href="/pdf/2026-2/Hasse/Miserere-Hasse_Violoncello-Contrabbasso.pdf"
                            target="_blank">Hasse - Miserere in c moll - Cello,
                            double bass</a></li>
                </ul>
            </div>
            <h4>Heinichen, Johann David - Confitebor S.32</h4>
            <div class="cols3">
                <ul>
                    <li><a href="/pdf/2026-2/Heinichen_CTD/Heinichen Confitebor - Full Score - met STREKEN.pdf"
                            target="_blank">Heinichen - Confitebor S.32 - Full
                            score <b>with bowings</b></a></li>
                    <li><a href="/pdf/2026-2/Heinichen_CTD/Heinichen Confitebor - Violin 1.pdf"
                            target="_blank">Heinichen - Confitebor S.32 - Violin
                            1</a></li>
                    <li><a href="/pdf/2026-2/Heinichen_CTD/Heinichen Confitebor - Violin 2.pdf"
                            target="_blank">Heinichen - Confitebor S.32 - Violin
                            2</a></li>
                    <li><a href="/pdf/2026-2/Heinichen_CTD/Heinichen Confitebor - Viola.pdf"
                            target="_blank">Heinichen - Confitebor S.32 -
                            Viola</a>
                    </li>
                    <li><a href="/pdf/2026-2/Heinichen_CTD/Heinichen Confitebor - Violoncello.pdf"
                            target="_blank">Heinichen - Confitebor S.32 - Cello,
                            double bass</a></li>
                </ul>
            </div>
            <h4>Biber, Heinrich - Requiem in f</h4>
            <div class="w3-panel w3-border w3-light-grey w3-clear"> Division of
                the strings: violin 1: Femke, Birgit, Maille, Barbara; violin 2:
                Louis, Eliane, Karin; viola I (on violin?): Corinne, Lea; viola
                II: Peter, Renske; viola III: Baukje; cello: Karel, Sanne,
                Franca, Patrick; double bass: Hendrik. The gambas double the
                trombone parts: Stephanie, alto; Eugenia, tenor; Désirée, bass.
            </div>
            <div class="cols3">
                <ul>
                    <li><a href="/pdf/2026-2/Biber/Biber_Requiem_in_f_Full score with bowings.pdf"
                            target="_blank">Biber - Requiem in f - Full score
                            <b>with bowings</b></a></li>
                    <li><a href="/pdf/2026-2/Biber/Biber_Requiem_in_f_VS_PML.pdf"
                            target="_blank">Biber - Requiem in f - Vocal
                            score</a></li>
                    <li><a href="/pdf/2026-2/Biber/Biber - Requiem f - Violin I.pdf"
                            target="_blank">Biber - Requiem in f - Violin I</a>
                    </li>
                    <li><a href="/pdf/2026-2/Biber/Biber - Requiem f - Violin II.pdf"
                            target="_blank">Biber - Requiem in f - Violin II</a>
                    </li>
                    <li><a href="/pdf/2026-2/Biber/Biber - Requiem f - Viola I.pdf"
                            target="_blank">Biber - Requiem in f - Viola I</a>
                    </li>
                    <li><a href="/pdf/2026-2/Biber/Biber - Requiem f - Viola I (violino).pdf"
                            target="_blank">Biber - Requiem in f - Viola I (in
                            vioolsleutel)</a>
                    </li>
                    <li><a href="/pdf/2026-2/Biber/Biber - Requiem f - Viola II.pdf"
                            target="_blank">Biber - Requiem in f - Viola II</a>
                    </li>
                    <li><a href="/pdf/2026-2/Biber/Biber - Requiem f - Viola III.pdf"
                            target="_blank">Biber - Requiem in f - Viola III</a>
                    </li>
                    <li><a href="/pdf/2026-2/Biber/Biber - Requiem f - Violone.pdf"
                            target="_blank">Biber - Requiem in f - Violone</a>
                    </li>
                    <li><a href="/pdf/2026-2/Biber/Biber - Requiem f - Alto trombone.pdf"
                            target="_blank">Biber - Requiem in f - Alto trombone
                            (also viola da gamba)</a></li>
                    <li><a href="/pdf/2026-2/Biber/Biber - Requiem f - Tenor trombone.pdf"
                            target="_blank">Biber - Requiem in f - Tenor
                            trombone (also viola da gamba)</a></li>
                    <li><a href="/pdf/2026-2/Biber/Biber - Requiem f - Bass trombone.pdf"
                            target="_blank">Biber - Requiem in f - Bass trombone
                            (also viola da gamba)</a></li>
                    <li><a href="/pdf/2026-2/Biber/Biber - Requiem f - BC.pdf"
                            target="_blank">Biber - Requiem in f - BC</a>
                    </li>
                </ul>
            </div>
            <h4>Division of the solo sections for singers in the afternoon
                programme</h4>
            <table class="w3-table w3-bordered w3-striped">
                <tbody>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;">
                            <strong>Composer</strong>
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;">
                            <strong>Work</strong>
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;">
                            <strong>Movement</strong>
                        </td>
                        <td style="width: 19.1494%; height: 20.6182px;">
                            <strong>Soli</strong>
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;">
                            <strong>Choir</strong>
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;">
                            <strong>Cast</strong>
                        </td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;">
                            Heinichen, Johann David</td>
                        <td style="width: 14.0228%; height: 20.6182px;">
                            <div>
                                <div>Concerto &agrave; 7 S.215</div>
                            </div>
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 19.1494%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;">
                            instruments only</td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> Biber,
                            Heinrich</td>
                        <td style="width: 14.0228%; height: 20.6182px;">De
                            Profundis</td>
                        <td style="width: 15.7568%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 19.1494%; height: 20.6182px;">satb
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;">SATB
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> Birthe,
                            Marleen, Jonathan, Stefan</td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;">
                            Zelenka, Jan Dismas</td>
                        <td style="width: 14.0228%; height: 20.6182px;">
                            <div>
                                <div>Ecce nunc benedicite, ZWV 99</div>
                            </div>
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 19.1494%; height: 20.6182px;">satb
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;">SATB
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> Vivian,
                            Hilda, Jan, Frits</td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> Hasse,
                            Johann Adolph</td>
                        <td style="width: 14.0228%; height: 20.6182px;">
                            <div>
                                <div>Miserere in c moll</div>
                            </div>
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 19.1494%; height: 20.6182px;">ssaa
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;">SSAA
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> &nbsp;
                        </td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;">I.
                            Miserere mei Deus</td>
                        <td style="width: 19.1494%; height: 20.6182px;">ssaa
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;">SSAA
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> Irma,
                            Anne, Marie, Jana</td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;"> II.Tibi
                            soli peccavi</td>
                        <td style="width: 19.1494%; height: 20.6182px;">s </td>
                        <td style="width: 3.61879%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> Joyce
                        </td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;">
                            <s>III. Ecce enim iniquitatibus</s>
                        </td>
                        <td style="width: 19.1494%; height: 20.6182px;">
                            <s>ssaa</s>
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;">
                            <s>SSAA</s>
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> &nbsp;
                        </td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;">IV.
                            Libera me de sanguinibus Deus</td>
                        <td style="width: 19.1494%; height: 20.6182px;">aa </td>
                        <td style="width: 3.61879%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> Marie,
                            Jana</td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;">V.
                            Quoniam si voluisses</td>
                        <td style="width: 19.1494%; height: 20.6182px;">s </td>
                        <td style="width: 3.61879%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;">Anne
                        </td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;">
                            <s>VI. Benigne fac</s>
                        </td>
                        <td style="width: 19.1494%; height: 20.6182px;">
                            <s>ssaa</s>
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;">
                            <s>SSAA</s>
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> &nbsp;
                        </td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;">
                            <s>VII. Gloria Patri</s>
                        </td>
                        <td style="width: 19.1494%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;">
                            <s>SSAA</s>
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> &nbsp;
                        </td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;">
                            <s>VIII. Sicut erat - Amen</s>
                        </td>
                        <td style="width: 19.1494%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;">
                            <s>SSAA</s>
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> &nbsp;
                        </td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;">
                            Heinichen, Johann David</td>
                        <td style="width: 14.0228%; height: 20.6182px;">
                            <div>
                                <div>Confitebor S.32</div>
                            </div>
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 19.1494%; height: 20.6182px;">satb
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;">SATB
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> Birthe,
                            Vivian, Joost, Peter</td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> Biber,
                            Heinrich</td>
                        <td style="width: 14.0228%; height: 20.6182px;"> Requiem
                            in f</td>
                        <td style="width: 15.7568%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 19.1494%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;"> SSATB
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> &nbsp;
                        </td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;">Te decet
                            hymnus</td>
                        <td style="width: 19.1494%; height: 20.6182px;">
                            <div>
                                <div>bar then SSATB</div>
                            </div>
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> Jurgen,
                            then Rhona, Anke, Marleen, Jonathan</td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;"> Kyrie
                        </td>
                        <td style="width: 19.1494%; height: 20.6182px;">
                            <div>
                                <div>SSATB soli until m76</div>
                            </div>
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> Rhona,
                            Anke, Marleen, Jonathan, Jurgen</td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;"> Quantus
                            tremor - Tuba mirum</td>
                        <td style="width: 19.1494%; height: 20.6182px;">
                            <div>
                                <div>SSATB soli until m 52</div>
                            </div>
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> Vivian
                            &amp; Hilda, later Jan &amp; Frits, then Jana as A
                        </td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;"> Judex
                            ergo</td>
                        <td style="width: 19.1494%; height: 20.6182px;">
                            <div>
                                <div>B then SSA until m.84</div>
                            </div>
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> Jurgen,
                            then Vivian, Hilda, Jana, Jan, Frits </td>
                    </tr>
                    <tr style="height: 25.6545px;">
                        <td style="width: 11.7611%; height: 25.6545px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 25.6545px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 25.6545px;">
                            Recordare</td>
                        <td style="width: 19.1494%; height: 25.6545px;">
                            <div>
                                <div>S1, AT, ripieno from m.109</div>
                            </div>
                        </td>
                        <td style="width: 3.61879%; height: 25.6545px;"> &nbsp;
                        </td>
                        <td style="width: 35.6602%; height: 25.6545px;"> Rhona,
                            Irma, Marleen, Joost, then m.121 Vivian, Hilda,
                            Marleen, Jonathan, Stefan</td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;"> Inter
                            oves</td>
                        <td style="width: 19.1494%; height: 20.6182px;">
                            <div>
                                <div>SSATB until m.135, short T solo m.160-162
                                </div>
                            </div>
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;">m.
                            159-162 Joost, then ripieno</td>
                    </tr>
                    <tr style="height: 23.2545px;">
                        <td style="width: 11.7611%; height: 23.2545px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 23.2545px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 23.2545px;">
                            Offertorium Domine Jesu</td>
                        <td style="width: 19.1494%; height: 23.2545px;">
                            <div>
                                <div>B until m.10</div>
                            </div>
                        </td>
                        <td style="width: 3.61879%; height: 23.2545px;"> &nbsp;
                        </td>
                        <td style="width: 35.6602%; height: 23.2545px;"> Jurgen,
                            then m.19 Rhona, Anke, Marleen, Jonathan, Frits</td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;"> Libera
                            eas</td>
                        <td style="width: 19.1494%; height: 20.6182px;">
                            <div>
                                <div>SSATB -rip from m.47</div>
                            </div>
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> &nbsp;
                        </td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;"> Hostias
                        </td>
                        <td style="width: 19.1494%; height: 20.6182px;">
                            <div>
                                <div>S1, AT, then B</div>
                            </div>
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> Joyce,
                            Marleen, Joost, Peter</td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;"> Osanna
                        </td>
                        <td style="width: 19.1494%; height: 20.6182px;">
                            <div>
                                <div>SSATB until m.44</div>
                            </div>
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> Rhona,
                            Anke, Marleen, Jan, Frits</td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;">
                            Benedictus</td>
                        <td style="width: 19.1494%; height: 20.6182px;">S1, A, B
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> Rhona,
                            Jana, Jurgen</td>
                    </tr>
                    <tr style="height: 26.2727px;">
                        <td style="width: 11.7611%; height: 26.2727px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 26.2727px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 26.2727px;"> Agnus
                        </td>
                        <td style="width: 19.1494%; height: 26.2727px;">
                            <div>
                                <div>SSATB - rip from m.29</div>
                            </div>
                        </td>
                        <td style="width: 3.61879%; height: 26.2727px;"> &nbsp;
                        </td>
                        <td style="width: 35.6602%; height: 26.2727px;"> Birthe,
                            Anne, Marleen, Joost, Jurgen, from 25 Anne S1,
                            Birthe S2</td>
                    </tr>
                    <tr style="height: 20.6182px;">
                        <td style="width: 11.7611%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 14.0228%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 15.7568%; height: 20.6182px;">
                            Communio Lux Aeterna</td>
                        <td style="width: 19.1494%; height: 20.6182px;">
                            <div>
                                <div>SSATB for only 7 measures</div>
                            </div>
                        </td>
                        <td style="width: 3.61879%; height: 20.6182px;"> &nbsp;
                        </td>
                        <td style="width: 35.6602%; height: 20.6182px;"> Anne,
                            Birthe, Marleen, Joost, Jurgen</td>
                    </tr>
                </tbody>
            </table>
            <h2> <a href="javascript: history.go(-1)">Back</a></h2>
            <p>&nbsp;</p>
        </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html>