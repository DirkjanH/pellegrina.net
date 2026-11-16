# Afmelden voor mailings

Voer vóór ingebruikname eenmaal `bin/mailing_afmeldingen.sql` uit op de database van de website. Zonder deze tabel stopt de mailingverzending veilig.

Kies in de mailingeditor Nederlands of Engels en voeg de afmeldlink in. Een bezoek aan de link toont een bevestigingsknop; automatisch openen van een link door spamfilters meldt niemand af. E-mailproviders kunnen via de `List-Unsubscribe`- en `List-Unsubscribe-Post`-headers direct afmelden. Een afmelding geldt voor alle toekomstige mailings via dit systeem, ongeacht de adresbron of afzender. Bevestigingsmails voor inschrijvingen en betalingen blijven mogelijk.

Voor RFC 8058 moet de DKIM-handtekening **beide** afmeldheaders ondertekenen. Laat Cloud86 dit instellen: een eerder ontvangen bericht ondertekende alleen `To`, `From` en `Subject`. Controleer daarna de `h=`-lijst in de `DKIM-Signature` van een nieuwe testmail. Zonder deze aanpassing herkennen mailproviders de one-click-headers mogelijk niet. Test ook de zichtbare link en controleer dat afgemelde adressen bij volgende mailings worden overgeslagen.
