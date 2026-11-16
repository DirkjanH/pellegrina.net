<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/cursussen.php';
$cursusnr = 1 + $cursus_offset; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
    <title>Travel info <?php echo $cursussen[$cursusnr]['cursusnaam_en'] ?>
    </title>
    <meta name="robots" content="noindex, nofollow">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.EN.php'; ?>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
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
                    <td class="w3-center"><a class="grijs">Map of České Budějovice, with all
                            venues</a></td>
                    <td class="w3-center "><a class="grijs">List of participants</a></td>
                    <td class="w3-center"><a class="grijs">Chamber music formations</a></td>
                    <td class="w3-center"><a class="grijs">Accommodation overview</a></td>
                    <td class="w3-center"><a class="grijs">Daily program</a></td>
                    <td class="w3-center"><a class="grijs">Concert info (in English)</a><br>
                        <a class="grijs">Concert info (in
                            Czech)</a>
                    </td>
                </tr>
            </table>
            <h2 class="onzichtbaar">Chamber Choir Repertoire</h2>
            <ul>
                <li>Chamber Choir Repertoire 2026 <b>(new,
                            improved version)</b> (105 pages)</li>
            </ul>
            <div class="onzichtbaar">
                <p>Some MIDI files of the chamber choir repertoire</p>
                <ul>
                    <li>Sandler - O Mistress Mine: <a class="grijs">soprano</a> | <a class="grijs">alto</a> | <a class="grijs">tenor</a> | <a class="grijs">bass</a></li>
                    <li>Elgar - Dreamy bits: <a class="grijs">soprano</a> | <a class="grijs">alto</a> | <a class="grijs">tenor</a> | <a class="grijs">bass</a></li>
                </ul>
            </div>
            <h2 class="onzichtbaar">Some chamber music works</h2>
            <div class="">
                <h2 class="onzichtbaar">Dvořák - Cantata 'Svatební košile' (The Spectre's Bride) op.
                    109 </h2>
                <ul>
                    <li>Full orchestral score</li>
                    <li>Singers can download and print the NEW & MUCH IMPROVED vocal score
                    </li>
                    <li>This page by former participant Marrie Kardol gives <a class="grijs">practice files for all voices of all
                            choruses of Svatební košile</a></li>
                </ul>
                <div class="cols3">
                    <ul>
                        <li>Flute I</li>
                        <li>Flute II</li>
                        <li>Oboe I</li>
                        <li>Oboe II</li>
                        <li>Cor anglais</li>
                        <li>Clarinet I</li>
                        <li>Clarinet II</li>
                        <li>Bass Clarinet</li>
                        <li>Bassoon I</li>
                        <li>Bassoon II</li>
                        <li>Horn I</li>
                        <li>Horn II</li>
                        <li>Horn III</li>
                        <li>Horn IV</li>
                        <li>Trumpet I</li>
                        <li>Trumpet II</li>
                        <li>Trombone I</li>
                        <li>Trombone II</li>
                        <li>Trombone III</li>
                        <li>Tuba</li>
                        <li>Timpani
                        <li>Other percussion
                        <li>Harp
                        </li>
                        <li style="break-before: column;">Violin I <b>(with
                                    bowings)</b></li>
                        <li>Violin II <b>(with
                                    bowings)</b></li>
                        <li>Viola <b>(with bowings)</b>
                        </li>
                        <li>Cello <b>(with bowings)</b>
                        </li>
                        <li>Double bass <b>(with
                                    bowings)</b></li>
                    </ul>
                </div>
                <p><a class="grijs">Excellent recording on Spotify to get an
                        impression of Dvořák's <i>Spectre's Bride</i></a></p>
                <p><a class="grijs">Another excellent recording, a historic
                        recording from 1961, of Dvořák's <i>Spectre's
                            Bride</i></a></p>
            </div>
            <h2> <a class="grijs">Back</a></h2>
        </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>
</html>