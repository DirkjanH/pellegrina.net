      <hr>
      <h3>Verzend het formulier</h3>
      <table border="0" class="formulier">
        <tr>
          <td valign="bottom" class="linkerkolom"><input type="checkbox" name="voorwaarden" value="akkoord"
              <?php if (isset($_POST['voorwaarden'])) echo 'checked'; ?>></td>
          <td>Ik verklaar mij akkoord met de voorwaarden zoals vermeld onder <a href="praktisch.php">praktische zaken</a> en elders op de site <span class="nadruk">(verplicht!)</span> <br>
            Ik begrijp dat mijn persoonlijke gegevens worden opgeslagen om praktische redenen die verband houden met de organisatie van de zomercursus. Mijn gegevens worden beschikbaar gesteld aan andere deelnemers en docenten. Ze worden nooit met andere partijen gedeeld zonder mijn uitdrukkelijke toestemming.</td>
        </tr>
      </table>
      <p><input name="submit" type="submit" value="verzenden"></p>
      <p><span class="nadruk">(SVP slechts één keer klikken. Je wordt verder geleid naar de betaalpagina of je ontvangt een automatische bevestiging van de verzending)</span>
      </p>
      <input type="hidden" name="MM_insert" value="aanmelding">
    </form>
    </td>
    </tr>
    </table>
