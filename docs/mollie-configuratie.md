# Mollie-configuratie

Kies voor nieuwe betalingen `test` of `live` in [mollie_modus.php](../includes/mollie_modus.php) en publiceer dat bestand. `live` maakt echte betaalverzoeken aan. Controleer de gekozen modus voordat je publiceert.

In testmodus maakt de website nog steeds inschrijvingen aan en kan zij bevestigingsmails versturen; alleen de Mollie-betaling is een testbetaling.

Bewaar beide API-sleutels eenmalig buiten de webmap en repository in `/var/www/vhosts/horringa.net/private/mollie.php`:

```php
<?php
return [
    'test_api_key' => 'VUL_HIER_DE_TESTSLEUTEL_IN',
    'live_api_key' => 'VUL_HIER_DE_NIEUWE_LIVE_SLEUTEL_IN',
];
```

Maak dit bestand rechtstreeks op de server, beperk de leesrechten tot de PHP-gebruiker en plaats het niet in Git. Als alternatief kan de server `MOLLIE_TEST_API_KEY` en `MOLLIE_LIVE_API_KEY` instellen als omgevingsvariabelen. Per sleutel heeft het privébestand voorrang. Een ontbrekende of ongeldige sleutel geeft een fout; er wordt niet ongemerkt naar de andere modus overgeschakeld.

De webhook probeert bij een betaling die in de huidige modus niet bestaat ook de andere sleutel. Laat daarom beide sleutels beschikbaar voor betalingen die nog vóór een omschakeling zijn aangemaakt. Zonder de bijbehorende sleutel kan de webhook de status daarvan niet verwerken.

De vroegere live-sleutel heeft in de repository gestaan. Vervang die bij Mollie en gebruik de nieuwe sleutel in de privéconfiguratie. Activeer livebetalingen pas nadat de serverconfiguratie en de volledige betaal- en webhookroute zijn gecontroleerd.
