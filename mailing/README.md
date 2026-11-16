# Afmelden voor mailings

Voer vóór ingebruikname eenmaal `bin/mailing_afmeldingen.sql` uit op de database van de website. Zonder deze tabel stopt de mailingverzending veilig.

Kies in de mailingeditor Nederlands of Engels en voeg de afmeldlink in. Een bezoek aan de link toont een bevestigingsknop; automatisch openen van een link door spamfilters meldt niemand af. E-mailproviders kunnen via de `List-Unsubscribe`- en `List-Unsubscribe-Post`-headers direct afmelden. Een afmelding geldt voor alle toekomstige mailings via dit systeem, ongeacht de adresbron of afzender. Bevestigingsmails voor inschrijvingen en betalingen blijven mogelijk.

Voor RFC 8058 moet de DKIM-handtekening **beide** afmeldheaders ondertekenen. Laat Cloud86 dit instellen: een eerder ontvangen bericht ondertekende alleen `To`, `From` en `Subject`. Controleer daarna de `h=`-lijst in de `DKIM-Signature` van een nieuwe testmail. Zonder deze aanpassing herkennen mailproviders de one-click-headers mogelijk niet. Test ook de zichtbare link en controleer dat afgemelde adressen bij volgende mailings worden overgeslagen.

## Beveiliging adresformulieren

De Nederlandse en Engelse adresformulieren gebruiken een Google reCAPTCHA-sitesleutel. Plaats vóór publicatie de bijbehorende geheime sleutel in `/var/www/vhosts/horringa.net/private/recaptcha.php`, buiten de webroot. Dit PHP-bestand moet een array met sleutel `secret` teruggeven en leesbaar zijn voor PHP. Plaats het niet in de repository. Als het bestand ontbreekt, kan de sleutel ook via de PHP-omgevingsvariabele of servervariabele `RECAPTCHA_SECRET` worden ingesteld. Een aanwezig maar ongeldig privébestand geeft een fout. Zonder geldige sleutel, werkende cURL-extensie en bereikbare Google-verificatie worden aanvragen niet opgeslagen.

Onzichtbare reCAPTCHA v2 en v3 worden ondersteund. Bij v3 moet de actie `submit` zijn en de score minimaal 0,5 bedragen. Test na installatie beide talen met de eigen websitesleutel.
