# Mollie-configuratie

Zonder privéconfiguratie blijft Mollie in de bestaande testmodus. Voor livebetalingen gebruikt de website de sleutel uit `/var/www/vhosts/horringa.net/private/mollie.php`, buiten de webmap en repository:

```php
<?php
return [
    'live_api_key' => 'VUL_HIER_DE_NIEUWE_LIVE_SLEUTEL_IN',
];
```

Maak dit bestand rechtstreeks op de server, beperk de leesrechten tot de PHP-gebruiker en plaats het niet in Git. Als alternatief kan de server de omgevingsvariabele `MOLLIE_LIVE_API_KEY` instellen. Het privébestand heeft voorrang. Een aanwezige maar ongeldige configuratie veroorzaakt een fout en schakelt niet ongemerkt terug naar testmodus.

De vroegere live-sleutel heeft in de repository gestaan. Vervang die bij Mollie en gebruik de nieuwe sleutel in de privéconfiguratie. Activeer livebetalingen pas nadat de serverconfiguratie is ingesteld en de volledige betaal- en webhookroute is gecontroleerd.
