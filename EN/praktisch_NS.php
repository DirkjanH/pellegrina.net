<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
    <title>Naamloos document</title>
</head>

<body>
    <h2 class="begin">Practical facts & prices
        "<?php echo $cursusdata['cursusnaam_en']; ?>"</h2>
    <h3>Admission and confirmation</h3>
    <p>It is our aim to form groups well-balanced according to their musical
        level, for the benefit of all participants. This is our first criterion
        when selecting participants. The second is the date of registration. If
        two candidates are of equal level for one place, preference will be
        given to the candidate who applied first. Often we have to choose from
        too many applicants for a particular instrument, especially for wind
        instruments and certain voice types. We then look in the first place at
        musical education, experience and insight. It is therefore important to
        describe your musical level well. Please <a
            href="contact.php">contact</a> <em>La Pellegrina</em> if you have
        any doubts about your musical level or ability.</p>
    <p>For the above reasons all registrations will first be collected. Final
        confirmation of participation cannot be given until
        <?php echo $cursusdata['beslisdatum']; ?>. In view of the limited number
        of places it is recommended to register early. It is possible to apply
        after <?php echo $cursusdata['beslisdatum']; ?>, but only for places
        that are still vacant. </p>
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
        <?php echo $cursusdata['betaaldatum']; ?> at the latest.
    </p>
    <p class="citaat">Marrie Kardol: &ldquo;The beautiful inspiring environment,
        the orderly progress of the program, the good preparation and the
        friendly and pleasant way in which the tutors deal with the participants
        ..., all this makes Pellegrina a must for every music lover!&rdquo;</p>
    <h3>Prices</h3>
    <p>The course fee -
        <strong><?php echo euro_en($cursusdata['prijs_volledig']); ?></strong>
        per person - includes accommodation in a double room in the monastery
        hostel and full board. Students and anyone up to the age of 36 pay
        <strong><?php echo euro_en($cursusdata['prijs_student']); ?></strong>.
        If you register in time, you will receive a
        <strong><?php echo euro_en($cursusdata['korting_vroeg']); ?></strong>
        discount. If you camp or arrange your own accommodation, you will
        receive a discount; single rooms are possible at a surcharge.
    </p>
    <h4>Significant discount for students and young people</h4>
    <p><em>Full-time</em> students at academic and higher professional education
        and participants up to 35 years of age (at the start of the course for
        which they have registered), receive a substantial discount and pay
        <strong><?php echo euro_en($cursusdata['prijs_student']); ?></strong>
        course fee per person, based on a double room. When registration a copy
        or scan of the registration certificate (or of your passport as proof of
        age).
    </p>

    <h3>Accommodation</h3>
    <h4>Single and double rooms in Monastery Nieuw Sion</h4>
    <p>Most participants stay in Monastery Nieuw Sion. There are two places where people can stay, the Guest House (Gastenverblijf) and the Gatehouse (Poortgebouw).</p>
    <p>The Guest House has one double room and thirteen single rooms. The facilities are simple but clean, with shared bathroom facilities.</p>
    <p>In addition, there is the recently renovated and comfortable Gatehouse, with three single rooms with shared bathroom facilities and five double rooms with private bathroom facilities.
    <h4>Camping in the monastery garden</h4>
    <p>There are a few camping spots available in the monastery's walnut orchard. Tents, campers and caravans are welcome; electricity is NOT available. The number of spots is limited, and there are simple shared sanitary facilities in the monastery.
    <h4>Own accommodation</h4>
    <p>It is possible to participate in the course on the basis of your own accommodation, for example for those who live nearby or can arrange their own
        accommodation. In that case, in addition to the course fee, you only pay a contribution for coffee and tea and the communal lunch. There
        are several hotels and Bed & Breakfast establishments in the vicinity. It is also possible to have dinner in the monastery at an additional cost.</p>

    <h3>Meals</h3>
    <p>During the course, we have a separate dining room where coffee and tea are available. There is an extensive breakfast buffet. Lunch
        and dinner are served on the outdoor terrace, weather permitting.

    <h3>All prices at a glance</h3>
    <table class="w3-table-all">
        <tr>
            <th>Overview of all prices and discounts</th>
            <th>When registering <br />before <?php echo $cursusdata["beslisdatum"]; ?>:</th>
            <th>When registering <br />on or after <?php echo $cursusdata["beslisdatum"]; ?>:</th>
        </tr>
        <tr>
            <td>Participation incl. double room in the Guest House, with shared bathroom facilities</td>
            <td class="geld"><?php echo euro($cursusdata["prijs_volledig"] - $cursusdata["korting_vroeg"]); ?></td>
            <td class="geld"><?php echo euro($cursusdata["prijs_volledig"]); ?></td>
        </tr>
        <tr>
            <td>Participation for students or participants up to age 35, including a double room in the Guest House with shared bathroom facilities</td>
            <td class="geld"><?php echo euro($cursusdata["prijs_student"] - $cursusdata["korting_vroeg"]); ?></td>
            <td class="geld"><?php echo euro($cursusdata["prijs_student"]); ?></td>
        </tr>
        <tr class="onzichtbaar">
            <td>Participation as an auditor, including a double room in the Guest House with shared bathroom facilities</td>
            <td class="geld"><?php echo euro($cursusdata["toehoorder"]); ?></td>
            <td class="geld"><?php echo euro($cursusdata["toehoorder"]); ?></td>
        </tr>
        <tr>
            <td>Surcharge for single room in the Guest House or Gatehouse, with shared bathroom facilities</td>
            <td class="geld"><?php echo euro($cursusdata["eenpers"]); ?></td>
            <td class="geld"><?php echo euro($cursusdata["eenpers"]); ?></td>
        </tr>
        <tr>
            <td>Surcharge for a place in a double room in the Gatehouse, with private bathroom facilities</td>
            <td class="geld"><?php echo euro($cursusdata["hotel_2pp"]); ?></td>
            <td class="geld"><?php echo euro($cursusdata["hotel_2pp"]); ?></td>
        </tr>
        <tr>
            <td>Discount for camping in the monastery garden <span class="emphasis">(per person, including all meals)</span></td>
            <td class="geld"><?php echo euro($cursusdata["kamperen"]); ?></td>
            <td class="geld"><?php echo euro($cursusdata["kamperen"]); ?></td>
        </tr>
        <tr>
            <td>Discount for own accommodation <span class="emphasis">(lunch and coffee/tea are included, breakfast and dinner are not)</span></td>
            <td class="geld"><?php echo euro($cursusdata["korting_eigen_acc"]); ?></td>
            <td class="geld"><?php echo euro($cursusdata["korting_eigen_acc"]); ?></td>
        </tr>
        <tr>
            <td>Surcharge for communal dinner <span class="emphasis">(only necessary if you have your own accommodation;
                    dinner is included as standard for other participants)</span></td>
            <td class="geld"><?php echo euro($cursusdata["diner"]); ?></td>
            <td class="geld"><?php echo euro($cursusdata["diner"]); ?></td>
        </tr>
        <tr>
            <td>Discount for participating in more than one course at <em>La Pellegrina</em> <span class="emphasis">(within one summer)</span></td>
            <td class="geld"><?php echo euro($cursusdata["korting_meer"] * 2); ?></td>
            <td class="geld"><?php echo euro($cursusdata["korting_meer"] * 2); ?></td>
        </tr>
    </table>
    <h4>Exchange rates calculator</h4>
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
</body>

</html>