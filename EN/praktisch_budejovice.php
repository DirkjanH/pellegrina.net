<!doctype html>
<html>
<!-- InstanceBegin template="/Templates/leeg_EN.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <!-- CSS: -->
    <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Naamloos document</title>
    <!-- InstanceEndEditable -->
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>

<body>
    <!-- InstanceBeginEditable name="mainpage" -->
    <h2 class="begin">Practical facts & prices
        "<?php echo $cursusdata['cursusnaam_en']; ?>"</h2>
    <h3>Admission and confirmation</h3>
    <p>It is our aim to form groups well-balanced according to their musical
        level. This is our first criterion when selecting participants. The
        second is the date of registration. If two candidates are of equal level
        for one place, preference will be given to the candidate who applied
        first. Please <a href="contact.php">contact</a> <em>La Pellegrina</em>
        if you have any doubts about your musical level or ability.</p>
    <p>For the above reasons all registrations will first be collected. Final
        confirmation of participation cannot be given until
        <?php echo $cursusdata['beslisdatum']; ?>. In view of the limited number
        of places it is recommended to register early. It is possible to apply
        after <?php echo $cursusdata['beslisdatum']; ?>, but only for places
        that are still vacant. </p>
    <h3>Registration and paying the deposit</h3>
    <p>You can register for a course by <strong>completely</strong> filling out
        the registration form. You can pay the deposit of
        <strong><?php echo euro_en($cursusdata['inschrijfgeld']); ?></strong>
        electronically at the same time as registering, or separately
        transferring your payment to bank account NL33 ASNB 0707 2500 72 in name
        of <em>La Pellegrina</em>, Utrecht, Netherlands (for transfers from
        outside the European Union: BIC ASNB NL21). Our electronic payment
        service accepts credit cards, but as credit card companies deduct a
        commission of about 3 %, we will offset this against your next payment.
        We will then send you provisional confirmation of your registration.
        Deposits will of course be refunded to applicants who cannot be placed.
        The entire fee is to be paid on
        <?php echo $cursusdata['betaaldatum']; ?> at the latest.
    </p>
    <h3>Prices </h3>
    <p>The course fee -
        <strong><?php echo euro_en($cursusdata['prijs_volledig']); ?></strong>
        per person - includes accomodation in double rooms (with private
        bathroom) at the conservatoire, breakfast, lunch and (only on the first
        and last night) dinner. Travel and insurance expenses are not included.
        Any bank and credit card charges are payable by the participant.
    </p>
    <h4>Not yet 36? Student? Pay the reduced price! </h4>
    <p>Applicants up to 35 years old and <em>fulltime</em> students at a
        university or polytechnic pay
        <strong><?php echo euro_en($cursusdata['prijs_student']); ?>&nbsp;</strong>
        per course, per person. Please send us a copy or scan of your
        registration with an university or other institution of higher
        education, or of your passport as proof of age.
    </p>
    <h4>Single rooms and your own accommodation </h4>
    <p>Single rooms (with private bathroom) at the conservatoire are available
        to an extra charge of
        <strong><?php echo euro_en($cursusdata['eenpers']); ?></strong>. If you
        want a single room, please let us know at an early stage.
    </p>
    <p>There is also the possibility of booking your own accommodation in Ceské
        Bud&#283;jovice. There is a wide range of hotels, from classic in the
        center to modern just outside. Through <a
            href="http://www.booking.com/city/cz/ceske-budejovice.nl.html"
            target="_blank">booking.com</a> you get a quick overview of the
        possibilities. Also via <a
            href="https://www.airbnb.com/s/%C4%8Cesk%C3%A9-Bud%C4%9Bjovice-?checkin=07%2F24%2F2016&checkout=07%2F31%2F2016&ss_id=qo8di0g9"
            target="_blank">Airbnb</a> there are plenty of options. If you
        arrange your own accommodation and breakfast, you get a discount of
        <strong><?php echo euro($cursusdata['korting_eigen_acc']); ?></strong>
        on the course fee. Lunch and (on the first and last night) dinner are
        shared with all participants and included in the course fee.
    </p>
    <h4>Reduction for early applicants </h4>
    <p>If you apply<strong> before
            <?php echo $cursusdata['beslisdatum']; ?></strong> you will receive
        a reduction of<strong>
            <?php echo euro_en($cursusdata['korting_vroeg']); ?></strong> on the
        course fee. This applies both to the normal fee and to the reduced fee
        for students and those under 36 (but not for auditors). After
        <?php echo $cursusdata['beslisdatum']; ?> you can still register for the
        places which are still open, but the reduction doesn't apply any more,
        of course. </p>
    <h4>Extra reduction for Eastern-european participants</h4>
    <p>For participants from Central European countries and countries of the
        former Soviet Union specially reduced course fees are available thanks
        to a fund sponsored by western participants. Here you find more
        information in <a href="/algemeen/CE_prijzen.php">English</a> or <a
            href="/algemeen/CZ_prijzen.php">Czech</a>.</p>
    <h4>Auditors and non-participating spouses</h4>
    <p>If you just want to come along with your spouse who is participating in
        the course, you pay<strong>
            <?php echo euro_en($cursusdata['toehoorder']); ?></strong> for meals
        and accomodation in double rooms (course fee, travel and insurance
        expenses not included). You are invited to sit in on all rehearsals,
        concerts and other activities during the course. Also, there is plenty
        to see in and around &#268;esk&eacute; Bud&#283;jovice. Please email
        <em>La Pellegrina </em>for more info.
    </p>
    <h4>Large instrument? Rent instead of bringing your own!</h4>
    <p>Sometimes it is more convenient for players of large instruments like
        cello, double bass and viola da gamba to rent it locally than to pay an
        extra ticket. <em>La Pellegrina </em>can help to rent quality
        instruments at a surcharge. Count with a rent of about 50 to 100 EUR for
        the duration of the course. It is recommended to request it at an early
        stage. With some luck you get to play the spare instrument of one of our
        teachers. For string players, it is in principle wise to bring your own
        bow.</p>
    <h4>Taking part in more than one course</h4>
    <p>If you want to participate in more than one course offered by <em>La
            Pellegrina</em> in the same year, we can offer you a
        <strong><?php echo euro_en($cursusdata['korting_meer'] * 2); ?>&nbsp;reduction</strong>.
        Please complete both forms, and click the checkbox at the option 'I wish
        to register for both courses'.
    </p>
    <h4>Exchange rates</h4>
    <table class="w3-table-all">
        <tr>
            <th>In short: all prices and reductions</th>
            <th>When registering <br>before
                <?php echo $cursusdata['beslisdatum']; ?>:</th>
            <th>When registering <br>on or after
                <?php echo $cursusdata['beslisdatum']; ?>:</th>
        </tr>
        <tr>
            <td>Participation in course incl. double room in the conservatoire
            </td>
            <td class="geld">
                <?php echo euro_en($cursusdata['prijs_volledig'] - $cursusdata['korting_vroeg']); ?>
            </td>
            <td class="geld">
                <?php echo euro_en($cursusdata['prijs_volledig']); ?></td>
        </tr>
        <tr>
            <td>Student participating in course incl. double room in the
                conservatoire</td>
            <td class="geld">
                <?php echo euro_en($cursusdata['prijs_student'] - $cursusdata['korting_vroeg']); ?>
            </td>
            <td class="geld">
                <?php echo euro_en($cursusdata['prijs_student']); ?></td>
        </tr>
        <tr>
            <td>Auditor incl. double room in the conservatoire</td>
            <td class="geld"><?php echo euro_en($cursusdata['toehoorder']); ?>
            </td>
            <td class="geld"><?php echo euro_en($cursusdata['toehoorder']); ?>
            </td>
        </tr>
        <tr>
            <td>Supplement single room in the conservatoire</td>
            <td class="geld"><?php echo euro_en($cursusdata['eenpers']); ?></td>
            <td class="geld"><?php echo euro_en($cursusdata['eenpers']); ?></td>
        </tr>
        <tr>
            <td>Reduction for arranging your own accommodation and
                breakfast<span class="nadruk"></span></td>
            <td class="geld">
                <?php echo euro_en($cursusdata['korting_eigen_acc']); ?></td>
            <td class="geld">
                <?php echo euro_en($cursusdata['korting_eigen_acc']); ?></td>
        </tr>
        <tr>
            <td>Reduction when participating in two courses <span
                    class="nadruk">(in total, not per course)</span></td>
            <td class="geld">
                <?php echo euro_en($cursusdata['korting_meer'] * 2); ?></td>
            <td class="geld">
                <?php echo euro_en($cursusdata['korting_meer'] * 2); ?></td>
        </tr>
    </table>
    <div class="w3-panel">
        <iframe title="fx"
            src="https://wise.com/gb/currency-converter/fx-widget/converter?sourceCurrency=EUR&targetCurrency=USD"
            height=490 width=340 frameBorder="0"
            allowtransparency="true"></iframe>
    </div>
    <h3>We speak English</h3>
    <p>The courses organised by <em>La Pellegrina</em> are are open to an
        international audience, with most participants coming from Western and
        Eastern Europe. We do, however, have some regular guests from Japan,
        Taiwan, Canada, Mexico and the US. As English will probably be the
        language we all have in common, tuition will be mainly in English.</p>
    <p class="citaat">Yo van Dijk: &quot;An almost magical mix of feeling at
        home and experiencing new adventures. So nice, all those different
        languages with the language of music as the binding factor.&quot;</p>
    <h3>Holiday in Czechia </h3>
    <p>The <em>La Pellegrina summer schools </em>offer excellent possibilities
        to combine ten days of music-making with further holidaying in Czechia,
        which for its peaceful and beautiful countryside is an increasingly
        popular part of Europe. </p>
    <p class="citaat">Laurie Boltjes: 'I always go on a long cycling tour after
        the course. Sometimes some of the other participants join me for a short
        holiday.' </p>
    <p class="citaat">Katy and Jan de Jongh: 'Before the course, we stay in
        Prague for a few days, and afterwards, we have a quiet holiday near the
        town. Bohemia is so cheap that we can afford to stay a little longer.'
    </p>
    <h3><b><a name="annul"></a></b>Cancellation policy</h3>
    <p>If <em>La Pellegrina</em> is unable to offer a place, or is forced to
        cancel a course, any fees that have been paid will be entirely refunded.
        Deposits cannot be refunded to applicants who withdraw from the course.
        Applicants cancelling after <?php echo $cursusdata['betaaldatum']; ?>
        are obliged to pay the entire course fee. It is therefore advisable to
        take out a cancellation insurance. </p>
    <p><i>La Pellegrina</i> retains the right to change tutors and programmes if
        such changes are considered necessary.
        <!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd -->

</html>