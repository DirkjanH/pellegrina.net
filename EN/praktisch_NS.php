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
        if you have any doubts about your musical level or ability. For the
        above reasons all registrations will first be collected. Final
        confirmation of participation cannot be given until
        <strong><?php echo $cursusdata['beslisdatum']; ?></strong>. In view of
        the limited number of places it is recommended to register early. </p>
    <p class="citaat">Robert Klotz: &ldquo;I flew across an ocean to attend La
        Pellegrina. Would swim if I have to get there next year.&rdquo;</p>
    <h3>Registration and paying the deposit</h3>
    <p>You can register for a course by <strong>completely</strong> filling out
        the registration form. You can pay the deposit of
        <strong><?php echo euro_en($cursusdata['inschrijfgeld']); ?></strong>
        electronically at the same time as registering, or by separately
        transferring your payment to bank account NL33 ASNB 0707 2500 72 in name
        of <em>La Pellegrina</em>, Utrecht, Netherlands (for transfers from
        outside the European Union: BIC ASNB NL21). Our electronic payment
        service accepts credit cards, but as credit card companies deduct a
        commission of about 3 %, we will offset this against your next payment.
        We will then send you provisional confirmation of your registration.
        Deposits will of course be refunded to applicants who cannot be placed.
        The entire fee is to be paid on
        <?php echo $cursusdata['betaaldatum']; ?> at the latest. </p>
    <p class="citaat">Marrie Kardol: &ldquo;The beautiful inspiring environment,
        the orderly progress of the program, the good preparation and the
        friendly and pleasant way in which the tutors deal with the participants
        ...., all this makes Pellegrina a must for every music lover!&rdquo;</p>
    <h3>Prices </h3>
    <p>The course fee -
        <strong><?php echo euro_en($cursusdata['prijs_volledig']); ?></strong>
        per person - includes accommodation in a double room in the monastery
        hostel and full board. Students and anyone up to the age of 36 pay
        <strong><?php echo euro_en($cursusdata['prijs_student']); ?></strong>.
        If you register in time, you will receive a
        <strong><?php echo euro_en($cursusdata['korting_vroeg']); ?></strong>
        discount. If you camp or arrange your own accommodation, you will
        receive a discount; single rooms are possible at a surcharge. </p>
    <h3>Accommodation</h3>
    <h4>Single and double rooms in the guesthouse of Klooster Nieuw Sion</h4>
    <p> Most participants stay in the guest house of Klooster Nieuw Sion. There
        are eight double and ten single rooms, with normal beds, no dorms or
        bunk beds. A linen package is included in the price. The facilities are
        simple but clean, with a communal sanitary area. There is a buffet
        breakfast in the dining room.</p>
    <h4>Camping in the monastery garden</h4>
    <p>Camping in the garden of the monastery is also possible. Tents,
        motorhomes and caravans are welcome but electricity is not available.
        The number of places is limited, there are simple sanitary facilities in
        the monastery.</p>
    <h4>Your own accommodation</h4>
    <p> It is possible to participate in the course on the basis of your own
        accommodation, for example for those who live in the area or can arrange
        accommodation there themselves. In that case, in addition to the course
        fee, you only pay a contribution for coffee and tea and the joint lunch.
        There are a few Bed &amp; Breakfast places in the vicinity of the
        monastery.</p>
    <h3>Meals</h3>
    <p> During the course we have a separate dining room, where coffee and tea
        are ready for us and breakfast, lunch and dinner will be served.</p>
    <h3>All prices </h3>
    <table class="w3-table-all">
        <tr>
            <th>Overview of all prices and reductions</th>
            <th>When registering <br> before
                <?php echo $cursusdata['beslisdatum']; ?>:</th>
            <th>When registering <br> on or after
                <?php echo $cursusdata['beslisdatum']; ?>:</th>
        </tr>
        <tr>
            <td>Participation in the course <span class="nadruk">including a
                    place in a double room in the guest house and full
                    board</span></td>
            <td class="geld">
                <?php echo euro_EN($cursusdata['prijs_volledig'] - $cursusdata['korting_vroeg']); ?>
            </td>
            <td class="geld">
                <?php echo euro_EN($cursusdata['prijs_volledig']); ?></td>
        </tr>
        <tr>
            <td>Participation student or person up to 35 in the course <span
                    class="nadruk">including a place in a double room in the
                    guest house and full board</span></td>
            <td class="geld">
                <?php echo euro_EN($cursusdata['prijs_student'] - $cursusdata['korting_vroeg']); ?>
            </td>
            <td class="geld">
                <?php echo euro_EN($cursusdata['prijs_student']); ?></td>
        </tr>
        <tr>
            <td>Participation as an auditor in the course <span
                    class="nadruk">including a place in a double room in the
                    guest house and full board</span></td>
            <td class="geld"><?php echo euro_EN($cursusdata['toehoorder']); ?>
            </td>
            <td class="geld"><?php echo euro_EN($cursusdata['toehoorder']); ?>
            </td>
        </tr>
        <tr>
            <td>Surcharge for single room in the guesthouse</td>
            <td class="geld"><?php echo euro_EN($cursusdata['eenpers']); ?></td>
            <td class="geld"><?php echo euro_EN($cursusdata['eenpers']); ?></td>
        </tr>
        <tr>
            <td>Reduction for camping at the monastery campsite</td>
            <td class="geld"><?php echo euro_EN($cursusdata['kamperen']); ?>
            </td>
            <td class="geld"><?php echo euro_EN($cursusdata['kamperen']); ?>
            </td>
        </tr>
        <tr>
            <td>Reduction for own accommodation<span class="nadruk"> (the joint
                    lunch and coffee/tea are included, breakfast and dinner
                    not)</span></td>
            <td class="geld">
                <?php echo euro_EN($cursusdata['korting_eigen_acc']); ?></td>
            <td class="geld">
                <?php echo euro_EN($cursusdata['korting_eigen_acc']); ?></td>
        </tr>
        <tr>
            <td>Surcharge for the joint dinner <span class="nadruk">(only needed
                    when having your own accommodation; otherwise it is
                    standard)</span></td>
            <td class="geld"><?php echo euro_EN($cursusdata['diner']); ?></td>
            <td class="geld"><?php echo euro_EN($cursusdata['diner']); ?></td>
        </tr>
        <tr>
            <td>Reduction for taking part in more than one La Pellegrina summer
                school <span class="nadruk">(within one year)</span></td>
            <td class="geld">
                <?php echo euro_EN($cursusdata['korting_meer'] * 2); ?></td>
            <td class="geld">
                <?php echo euro_EN($cursusdata['korting_meer'] * 2); ?></td>
        </tr>
    </table>
    <iframe title="fx"
        src="https://wise.com/gb/currency-converter/fx-widget/converter?sourceCurrency=EUR&targetCurrency=USD"
        height=490 width=100% frameBorder="0" allowtransparency="true"></iframe>
    <script>
    const frames = document.querySelectorAll('iframe');
    const widgetFrame = frames[frames.length - 1];
    window.addEventListener('message', message => {
        if (message.source !== widgetFrame.contentWindow) {
            return;
        }
        widgetFrame.setAttribute('height', message.data.height);
    });
    </script>
    <h3>We speak English</h3>
    <p>The courses organised by <em>La Pellegrina</em> are are open to an
        international audience, with most participants coming from Western and
        Eastern Europe. We do, however, have some regular guests from Japan,
        Taiwan, Canada, Australia, Mexico and the US. As English will probably
        be the language we all have in common, tuition will be in English on
        request.</p>
    <p class="citaat">Jean Walker: Each year on returning I think it can't be as
        good as the previous year… and it is!!! </p>
    <p class="citaat">Laurie Boltjes: 'I always go on a long cycling tour after
        the course. Sometimes some of the other participants join me for a short
        holiday.' </p>
    <h3><b><a name="annul"></a></b>Cancellation policy</h3>
    <p>If <em>La Pellegrina</em> is unable to offer a place, or is forced to
        cancel a course, any fees that have been paid will be entirely refunded.
        Deposits cannot be refunded to applicants who withdraw from the course.
        Applicants cancelling after <?php echo $cursusdata['betaaldatum']; ?>
        are obliged to pay the entire course fee. It is therefore advisable to
        take out a cancellation insurance. </p>
    <p><i>La Pellegrina</i> retains the right to change tutors and programmes if
        such changes are considered necessary.</p>
    <!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd -->
</html>