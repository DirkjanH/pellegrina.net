# Afmelden voor mailings

Voer vóór ingebruikname eenmaal `bin/mailing_afmeldingen.sql` uit op de database van de website. Zonder deze tabel stopt de mailingverzending veilig.

Kies in de mailingeditor Nederlands of Engels en voeg de afmeldlink in. Een bezoek aan de link toont een bevestigingsknop; automatisch openen van een link door spamfilters meldt niemand af. E-mailproviders kunnen via de `List-Unsubscribe`- en `List-Unsubscribe-Post`-headers direct afmelden. Een afmelding geldt voor alle toekomstige mailings via dit systeem, ongeacht de adresbron of afzender. Bevestigingsmails voor inschrijvingen en betalingen blijven mogelijk.

Voor RFC 8058 moet de DKIM-handtekening **beide** afmeldheaders ondertekenen. Laat Cloud86 dit instellen: een eerder ontvangen bericht ondertekende alleen `To`, `From` en `Subject`. Controleer daarna de `h=`-lijst in de `DKIM-Signature` van een nieuwe testmail. Zonder deze aanpassing herkennen mailproviders de one-click-headers mogelijk niet. Test ook de zichtbare link en controleer dat afgemelde adressen bij volgende mailings worden overgeslagen.

## Verzending via cron

1. Stop vóór de overstap alle oude verzendtabbladen en wacht tot eventuele lopende verzoeken klaar zijn. De oude browserversie gebruikt niet dezelfde vergrendeling.
2. Voer eenmaal `bin/mailing_verzendtaken.sql` uit op de websitedatabase. De bestaande afmeldtabel blijft ook vereist. Controleer daarnaast dat `mailing_adressen` en `mailing_opdrachten` de InnoDB-engine gebruiken; anders stopt de werker, omdat transacties nodig zijn voor een betrouwbare verzendregistratie.
3. Publiceer de gewijzigde bestanden. Configureer daarna een cronjob die iedere minuut de PHP **CLI** van de website gebruikt. Vervang de paden door de werkelijke paden op de server:

   ```cron
   * * * * * /pad/naar/php /pad/naar/webroot/bin/mailing_worker.php >> /pad/buiten-webroot/mailing-worker.log 2>&1
   ```

   De cronaccount moet de webbestanden en databaseconfiguratie kunnen lezen, database- en SMTP-toegang hebben en naar het privélog kunnen schrijven. PHP heeft dezelfde extensies nodig als de website, waaronder PDO MySQL en OpenSSL. Controleer het cronlog en test met een kleine testmailing.
4. Open bij een nieuwe mailing **Verzending beheren**, of selecteer een bestaande mailing in de mailingstatistieken. Klik op **Mailing starten** of **Mailing hervatten**. De computer en browser hoeven daarna niet aan te blijven. De voortgang en eventuele fouten zijn op dezelfde pagina te zien.

De werker verstuurt maximaal 40 berichten per blok en wacht na ieder blok minstens 15 minuten voordat een volgend blok begint, ook voor een andere mailing. Een databasevergrendeling voorkomt dat twee werkers tegelijk versturen. Via de beheerpagina kan de mailing tussen blokken worden gepauzeerd. Een fout stopt de mailing; los de fout op en hervat handmatig. Als de cronjob niet is ingesteld of niet werkt, blijft de mailing in de wachtrij staan.

Een SMTP-verzending en de registratie daarvan in de database zijn niet atomair. Bij een onderbreking tijdens een bericht stopt de werker daarom bij de volgende poging en vraagt om een keuze: opnieuw proberen of het bericht als verzonden registreren. Controleer eerst de server- en maillogs; opnieuw proberen kan een dubbele mail veroorzaken. Verwijder of reset de bestaande verzendtijden niet bij het hervatten.

## Beveiliging adresformulieren

De Nederlandse en Engelse adresformulieren gebruiken een Google reCAPTCHA-sitesleutel. Plaats vóór publicatie de bijbehorende geheime sleutel in `/var/www/vhosts/horringa.net/private/recaptcha.php`, buiten de webroot. Dit PHP-bestand moet een array met sleutel `secret` teruggeven en leesbaar zijn voor PHP. Plaats het niet in de repository. Als het bestand ontbreekt, kan de sleutel ook via de PHP-omgevingsvariabele of servervariabele `RECAPTCHA_SECRET` worden ingesteld. Een aanwezig maar ongeldig privébestand geeft een fout. Zonder geldige sleutel, werkende cURL-extensie en bereikbare Google-verificatie worden aanvragen niet opgeslagen.

Onzichtbare reCAPTCHA v2 en v3 worden ondersteund. Bij v3 moet de actie `submit` zijn en de score minimaal 0,5 bedragen. Test na installatie beide talen met de eigen websitesleutel.
