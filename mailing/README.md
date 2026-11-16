# Afmelden voor mailings

Voer vóór ingebruikname eenmaal `bin/mailing_afmeldingen.sql` uit op de database van de website. Zonder deze tabel stopt de mailingverzending veilig.

Kies in de mailingeditor Nederlands of Engels en voeg de afmeldlink in. Een bezoek aan de link toont een bevestigingsknop; automatisch openen van een link door spamfilters meldt niemand af. E-mailproviders kunnen via de `List-Unsubscribe`- en `List-Unsubscribe-Post`-headers direct afmelden. Een afmelding geldt voor alle toekomstige mailings via dit systeem, ongeacht de adresbron of afzender. Bevestigingsmails voor inschrijvingen en betalingen blijven mogelijk.

Voor RFC 8058 moet de DKIM-handtekening **beide** afmeldheaders ondertekenen. Laat Cloud86 dit instellen: een eerder ontvangen bericht ondertekende alleen `To`, `From` en `Subject`. Controleer daarna de `h=`-lijst in de `DKIM-Signature` van een nieuwe testmail. Zonder deze aanpassing herkennen mailproviders de one-click-headers mogelijk niet. Test ook de zichtbare link en controleer dat afgemelde adressen bij volgende mailings worden overgeslagen.

## Beveiliging adresformulieren

De Nederlandse en Engelse adresformulieren gebruiken de bestaande Google reCAPTCHA-sitesleutel. Stel vóór publicatie de bijbehorende geheime sleutel op de webserver in als `RECAPTCHA_SECRET`, beschikbaar voor PHP via een omgevingsvariabele of servervariabele. Plaats de sleutel niet in de repository. Zonder geldige sleutel, werkende cURL-extensie en bereikbare Google-verificatie worden aanvragen niet opgeslagen.

Onzichtbare reCAPTCHA v2 en v3 worden ondersteund. Bij v3 moet de actie `submit` zijn en de score minimaal 0,5 bedragen. Test na installatie beide talen met de eigen websitesleutel.
