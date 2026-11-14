<?php
$adresformulierTekst = $adresformulierTaal === 'NL' ? [
    'titel' => 'Adresgegevens en nieuwsbrief',
    'inleiding' => 'Blijf op de hoogte van de zomercursussen en andere projecten van <em>La Pellegrina</em>. Met dit formulier kun je je gegevens toevoegen of je afmelden. Als je al bekend bent bij <em>La Pellegrina</em>, kun je je gegevens wijzigen door dit formulier in te sturen.',
    'verplicht' => 'Velden met * zijn verplicht. Bij afmelden zijn alleen je naam en e-mailadres nodig.',
    'actie' => 'Wat wil je doen?',
    'acties' => [
        'alles' => 'Mij aanmelden voor de nieuwsbrief',
        'email' => 'Ik ben al bekend bij <em>La Pellegrina</em>. Update mijn gegevens als volgt in het bestand (alle relevante gegevens en tenminste je naam en emailadres invullen en op verzenden drukken)',
        'delete' => 'Mij afmelden voor de nieuwsbrief',
    ],
    'persoonlijk' => 'Persoonlijke gegevens',
    'contact' => 'Adres en telefoon',
    'voornaam' => 'Voornaam',
    'tussenvoegsels' => 'Tussenvoegsels',
    'achternaam' => 'Achternaam',
    'email' => 'E-mail',
    'instrstem' => 'Instrument / stemsoort',
    'geboortedatum' => 'Geboortedatum (dd-mm-jjjj)',
    'geslacht' => 'Geslacht',
    'M' => 'M',
    'V' => 'V',
    'X' => 'X',
    'adres' => 'Straat en huisnummer',
    'postcode' => 'Postcode',
    'plaats' => 'Plaats',
    'land' => 'Land',
    'telefoon' => 'Telefoon',
    'opmerkingen' => 'Opmerkingen (optioneel)',
    'verzenden' => 'Verzenden',
    'wissen' => 'Formulier leegmaken',
] : [
    'titel' => 'Contact details and newsletter',
    'inleiding' => 'Stay informed about <em>La Pellegrina</em> summer schools and related projects. Use this form to add your details or to unsubscribe. If you are known by <em>La Pellegrina</em> you can change your details by sending this form.',
    'verplicht' => 'Fields marked * are required. To unsubscribe, only your name and email address are needed.',
    'actie' => 'What would you like to do?',
    'acties' => [
        'alles' => 'Subscribe to the newsletter',
        'email' => 'I am already known to <em>La Pellegrina</em>. Update my details in your records as follows (fill in all relevant details and at least your name and email address, then press Send)',
        'delete' => 'Unsubscribe from the newsletter',
    ],
    'persoonlijk' => 'Personal details',
    'contact' => 'Address and telephone',
    'voornaam' => 'First name',
    'tussenvoegsels' => 'Middle name / name prefix',
    'achternaam' => 'Surname',
    'email' => 'Email',
    'instrstem' => 'Instrument / voice type',
    'geboortedatum' => 'Date of birth (dd-mm-yyyy)',
    'geslacht' => 'Gender',
    'M' => 'M',
    'V' => 'F',
    'X' => 'X',
    'adres' => 'Street and house number',
    'postcode' => 'Postal code',
    'plaats' => 'City',
    'land' => 'Country',
    'telefoon' => 'Telephone',
    'opmerkingen' => 'Remarks (optional)',
    'verzenden' => 'Send',
    'wissen' => 'Reset form',
];
$adresformulierEscape = static function ($waarde) {
    return htmlspecialchars((string)$waarde, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
};
$adresformulierWaarde = static function ($veld) use ($adresformulierEscape, $adresformulierTaal) {
    $standaard = $veld === 'land' && $adresformulierTaal === 'NL' ? 'Netherlands' : '';
    return $adresformulierEscape($_POST[$veld] ?? $standaard);
};
$adresformulierActie = $_POST['actie'] ?? ($Aanvraag['folder'] ?? '');
$adresformulierAfmelden = $adresformulierActie === 'delete';
$adresformulierVelden = [
    'persoonlijk' => [
        'voornaam' => ['text', 'given-name', true],
        'tussenvoegsels' => ['text', 'additional-name', false],
        'achternaam' => ['text', 'family-name', true],
        'email' => ['email', 'email', true],
        'instrstem' => ['text', '', true],
        'geboortedatum' => ['text', '', true],
    ],
    'contact' => [
        'adres' => ['text', 'street-address', true],
        'postcode' => ['text', 'postal-code', true],
        'plaats' => ['text', 'address-level2', true],
        'land' => ['text', 'country-name', true],
        'telefoon' => ['tel', 'tel', true],
    ],
];
?>
<section class="adresformulier" lang="<?php echo strtolower($adresformulierTaal); ?>">
    <h2 class="begin"><?php echo $adresformulierTekst['titel']; ?></h2>
    <p><?php echo $adresformulierTekst['inleiding']; ?></p>
    <p id="adresformulier-uitleg"><?php echo $adresformulierTekst['verplicht']; ?></p>
    <?php if (!empty($error)): ?>
        <div class="adresformulier-fouten" role="alert"><?php echo $fout; ?></div>
    <?php endif; ?>
    <form action="<?php echo $adresformulierEscape($editFormAction); ?>" method="post"
        id="info-aanvraag" aria-describedby="adresformulier-uitleg">
        <fieldset>
            <legend><?php echo $adresformulierTekst['actie']; ?> *</legend>
            <?php foreach ($adresformulierTekst['acties'] as $actie => $label): ?>
                <label class="adresformulier-keuze">
                    <input type="radio" name="actie" value="<?php echo $actie; ?>" required
                        <?php if ($adresformulierActie === $actie) echo 'checked'; ?>>
                    <span><?php echo $label; ?></span>
                </label>
            <?php endforeach; ?>
        </fieldset>
        <?php foreach ($adresformulierVelden as $groep => $velden): ?>
            <fieldset>
                <legend><?php echo $adresformulierTekst[$groep]; ?></legend>
                <div class="adresformulier-velden">
                    <?php foreach ($velden as $veld => [$type, $autocomplete, $verplicht]):
                        $altijdVerplicht = in_array($veld, ['voornaam', 'achternaam', 'email'], true);
                        $voorwaardelijkVerplicht = $verplicht && !$altijdVerplicht;
                        $nuVerplicht = $altijdVerplicht || ($voorwaardelijkVerplicht && !$adresformulierAfmelden);
                    ?>
                        <div<?php if ($veld === 'voornaam') echo ' class="adresformulier-naam"'; ?>>
                            <?php if ($veld === 'voornaam'): ?>
                                <div class="adresformulier-geslacht">
                                    <label for="adres-geslacht"><?php echo $adresformulierTekst['geslacht']; ?></label>
                                    <select name="geslacht" id="adres-geslacht" autocomplete="sex">
                                        <option value="">-</option>
                                        <?php foreach (['M', 'V', 'X'] as $geslacht): ?>
                                            <option value="<?php echo $geslacht; ?>" <?php if (($_POST['geslacht'] ?? '') === $geslacht) echo 'selected'; ?>><?php echo $adresformulierTekst[$geslacht]; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                            <?php endif; ?>
                            <label for="adres-<?php echo $veld; ?>">
                                <?php echo $adresformulierTekst[$veld]; ?>
                                <?php if ($verplicht): ?>
                                    <span <?php if ($voorwaardelijkVerplicht) echo 'data-adres-markering'; ?>
                                        <?php if (!$nuVerplicht) echo 'hidden'; ?> aria-hidden="true">*</span>
                                <?php endif; ?>
                            </label>
                            <input type="<?php echo $type; ?>" id="adres-<?php echo $veld; ?>"
                                name="<?php echo $veld; ?>" value="<?php echo $adresformulierWaarde($veld); ?>"
                                <?php if ($autocomplete !== ''): ?>autocomplete="<?php echo $autocomplete; ?>"<?php endif; ?>
                                <?php if ($veld === 'geboortedatum'): ?>placeholder="<?php echo $adresformulierTaal === 'NL' ? 'dd-mm-jjjj' : 'dd-mm-yyyy'; ?>" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}"<?php endif; ?>
                                <?php if ($voorwaardelijkVerplicht) echo 'data-adres-verplicht'; ?>
                                <?php if ($nuVerplicht) echo 'required'; ?>>
                            <?php if ($veld === 'voornaam'): ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </fieldset>
        <?php endforeach; ?>
        <label for="adres-opmerkingen"><?php echo $adresformulierTekst['opmerkingen']; ?></label>
        <textarea name="opmerkingen" id="adres-opmerkingen" rows="4"><?php echo $adresformulierWaarde('opmerkingen'); ?></textarea>
        <div class="adresformulier-knoppen">
            <button type="submit" data-sitekey="6LcMbAIkAAAAANkqG0D-L46IHFm8z2-8bRCT6tEg"
                data-callback="onAdresformulierSubmit" data-action="submit"
                class="g-recaptcha w3-btn w3-green"><?php echo $adresformulierTekst['verzenden']; ?></button>
            <button type="reset" class="w3-btn"><?php echo $adresformulierTekst['wissen']; ?></button>
        </div>
        <input type="hidden" name="MM_insert" value="info-aanvraag">
    </form>
</section>
<script>
    (function () {
        const form = document.getElementById('info-aanvraag');
        function updateRequiredFields() {
            const unsubscribe = form.querySelector('input[name="actie"]:checked')?.value === 'delete';
            form.querySelectorAll('[data-adres-verplicht]').forEach(function (input) {
                input.required = !unsubscribe;
                input.closest('div').querySelector('[data-adres-markering]').hidden = unsubscribe;
            });
        }
        form.addEventListener('change', updateRequiredFields);
        form.addEventListener('reset', function () {
            setTimeout(updateRequiredFields, 0);
        });
        window.onAdresformulierSubmit = function () {
            updateRequiredFields();
            if (form.reportValidity()) {
                form.submit();
            } else {
                grecaptcha.reset();
            }
        };
        updateRequiredFields();
    }());
</script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
