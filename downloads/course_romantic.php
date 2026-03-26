<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/cursussen.php';
$cursusnr = 1 + $cursus_offset; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <!-- CSS: -->
    <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
    <title>Travel info <?php echo $cursussen[$cursusnr]['cursusnaam_en'] ?>
    </title>
    <meta name="robots" content="noindex, nofollow">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.EN.php'; ?>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
    <link href="/css/pagina_stijlen_algemeen.css" rel="stylesheet"
        type="text/css">
    <link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
    <style type="text/css">
    h4.nadrukkelijk {
        color: #F03;
    }

    .blok {
        clear: none;
        float: left;
        width: 500px;
    }

    #inhoud #main ul .alles {
        clear: both;
        height: 240px;
    }
    </style>
</head>
<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
    <div id="inhoud">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.EN.php'; ?>
        <div id="main">
            <h2><strong><?php echo $cursussen[$cursusnr]['cursusnaam_en'] ?></strong>
                (<?php echo $cursussen[$cursusnr]['datumkort'] ?>) - all
                <?php echo $jaar ?> travel information </h2>
            <table width="100%" border="1">
                <tr>
                    <th>Travel information</th>
                    <th>List of participants</th>
                    <th>Chamber music formations</th>
                    <th>Room allocation</th>
                    <th>Daily program</th>
                    <th>Concert info</th>
                </tr>
                <tr>
                    <td class="w3-center"><a
                            href="https://www.google.com/maps/d/u/0/edit?mid=1zv5-hN4rGS_fZVT6gYvyPTuxC86MaC0&usp=sharing"
                            target="_blank">Map of České Budějovice, with all
                            venues</a></td>
                    <td class="w3-center "><a <a
                            href="../part_list.php?cursus=1"
                            target="_blank">List of participants</a></td>
                    <td class="w3-center grijs"><a <a
                            xxxx="../ensemblelijst_1.php"
                            target="_blank">Chamber music formations</a></td>
                    <td class="w3-center grijs"><a
                            xxxx="https://docs.google.com/spreadsheets/d/e/2PACX-1vQ9ZgCzJD_eApDVSvp_h8V96-q9pyA9jerBBeaCdVVWXek3HPJ4ngrlGfL-WihiCUphxWCpl7JyplG6/pubhtml?gid=701953541&single=true"
                            target="_blank">Accommodation overview</a></td>
                    <td class="w3-center grijs"><a
                            xxxx="2026-1 daily programme.pdf"
                            target="_blank">Daily program</a></td>
                    <td class="w3-center grijs"><a
                            xxxx="https://www.horringa.net/"
                            target="_blank">Concert info (in English)</a><br>
                        <a xxxx="/dvorak-haydn/" target="_blank">Concert info
                            (in Czech)</a>
                    </td>
                </tr>
            </table>
            <h2>Chamber Choir Repertoire</h2>
            <ul>
                <li><a href="../pdf/2026-1/chamberchoir_2026.pdf"
                        target="_blank">Chamber Choir Repertoire 2026</a> (105
                    pages)</li>
            </ul>
            <div class="onzichtbaar">
                <p>Some MIDI files of the chamber choir repertoire</p>
                <ul>
                    <li>Sandler - O Mistress Mine: <a
                            href="../MIDI/Mistress - Sop.mid"
                            target="_blank">soprano</a> | <a
                            href="../MIDI/Mistress - Alt.mid"
                            target="_blank">alto</a> | <a
                            href="../MIDI/Mistress - Ten.mid"
                            target="_blank">tenor</a> | <a
                            href="../MIDI/Mistress - Bas.mid"
                            target="_blank">bass</a></li>
                    <li>Elgar - Dreamy bits: <a href="../MIDI/Elgar - Sop.mid"
                            target="_blank">soprano</a> | <a
                            href="../MIDI/Elgar - Alt.mid"
                            target="_blank">alto</a> | <a
                            href="../MIDI/Elgar - Ten.mid"
                            target="_blank">tenor</a> | <a
                            href="../MIDI/Elgar - bas.mid"
                            target="_blank">bass</a></li>
                </ul>
            </div>
            <h2 class="onzichtbaar">Some chamber music works</h2>
            <div class="">
                <h2>Dvořák - Cantata 'Svatební košile' (The Spectre's Bride) op.
                    109 </h2>
                <ul>
                    <li><a href="../pdf/2026-1/Dvořák - Svatební košíle - score A4.pdf"
                            target="_blank">Full orchestral score</a></li>
                    <li>Singers can download and print the <a
                            href="../pdf/2026-1/SK_piano_reduction_A4.pdf"
                            target="_blank">vocal score</a></li>
                    <li>This page by former participant Marrie Kardol gives <a
                            href="https://midi.emjeka.nl/midifiles/dvorak-bruidshemd.html"
                            target="_blank">practice files for all voices of all
                            choruses of Svatební košile</a></li>
                </ul>
                <div class="cols3">
                    <ul>
                        <li><a href="../pdf/2026-1/Flauto 1.pdf"
                                target="_blank">Flute I</a></li>
                        <li><a href="../pdf/2026-1/Flauto 2.pdf"
                                target="_blank">Flute II</a></li>
                        <li><a href="../pdf/2026-1/Oboe 1.pdf"
                                target="_blank">Oboe I</a></li>
                        <li><a href="../pdf/2026-1/Oboe 2.pdf"
                                target="_blank">Oboe II</a></li>
                        <li><a href="../pdf/2026-1/Corno ingl..pdf"
                                target="_blank">Cor anglais</a></li>
                        <li><a href="../pdf/2026-1/Clarinetto 1.pdf"
                                target="_blank">Clarinet I</a></li>
                        <li><a href="../pdf/2026-1/Clarinetto 2.pdf"
                                target="_blank">Clarinet II</a></li>
                        <li><a href="../pdf/2026-1/Svatební košile - Bass clarinet - Bass Clarinet in Bb.pdf"
                                target="_blank">Bass Clarinet</a></li>
                        <li><a href="../pdf/2026-1/Fagott 1.pdf"
                                target="_blank">Bassoon I</a></li>
                        <li><a href="../pdf/2026-1/Fagott 2.pdf"
                                target="_blank">Bassoon II</a></li>
                        <li><a href="../pdf/2026-1/Corno 1.pdf"
                                target="_blank">Horn I</a></li>
                        <li><a href="../pdf/2026-1/Corno 2.pdf"
                                target="_blank">Horn II</a></li>
                        <li><a href="../pdf/2026-1/Corno 3.pdf"
                                target="_blank">Horn III</a></li>
                        <li><a href="../pdf/2026-1/Corno 4.pdf"
                                target="_blank">Horn IV</a></li>
                        <li><a href="../pdf/2026-1/Tromba 1.pdf"
                                target="_blank">Trumpet I</a></li>
                        <li><a href="../pdf/2026-1/Tromba 2.pdf"
                                target="_blank">Trumpet II</a></li>
                        <li><a href="../pdf/2026-1/Trombone 1.pdf"
                                target="_blank">Trombone I</a></li>
                        <li><a href="../pdf/2026-1/Trombone 2.pdf"
                                target="_blank">Trombone II</a></li>
                        <li><a href="../pdf/2026-1/Trombone 3.pdf"
                                target="_blank">Trombone III</a></li>
                        <li><a href="../pdf/2026-1/Tuba.pdf"
                                target="_blank">Tuba</a></li>
                        <li><a href="../pdf/2026-1/Timpani.pdf"
                                target="_blank">Timpani</a>
                        <li><a href="../pdf/2026-1/Svatební košile - Triangle, Tam-tam, Orchestral Bells.pdf"
                                target="_blank">Other percussion</a>
                        <li><a href="../pdf/2026-1/ARPA I.pdf"
                                target="_blank">Harp</a>
                        </li>
                        <li style="break-before: column;"><a
                                href="../pdf/2026-1/Violino I.pdf"
                                target="_blank">Violin I <b>(with
                                    bowings)</b></a></li>
                        <li><a href="../pdf/2026-1/Violino II.pdf"
                                target="_blank">Violin II <b>(with
                                    bowings)</b></a></li>
                        <li><a href="../pdf/2026-1/Viola.pdf"
                                target="_blank">Viola <b>(with bowings)</b></a>
                        </li>
                        <li><a href="../pdf/2026-1/Violoncello.pdf"
                                target="_blank">Cello <b>(with bowings)</b></a>
                        </li>
                        <li><a href="../pdf/2026-1/Contrabasso.pdf"
                                target="_blank">Double bass <b>(with
                                    bowings)</b></a></li>
                    </ul>
                </div>
                <p><a href="https://open.spotify.com/playlist/6Q0jeTv8wp11eJyxItIBCB?si=3446d002e0fe45ce"
                        target="_blank">Excellent recordings on Spotify to get
                        an impression of the music</a></p>
                <h2> <a href="javascript: history.go(-1)">Back</a></h2>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>
</html>