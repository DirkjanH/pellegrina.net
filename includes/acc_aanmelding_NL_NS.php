<hr>
<p><strong> Geef SVP hieronder je voorkeur aan voor je accommodatie.</strong><br>
<span class="nadruk">De basisprijs is incl. een plaats in een tweepersoonskamer en volpension. Als je dat wilt hoef je niets aan te vinken.</span></p>
    <table class="formulier">
      <tr>
        <td class="linkerkolom"><input type="checkbox" name="eenpersoons" id="eenpersoons" value="1"
						 <?php if (isset($_POST['eenpersoons']) AND $_POST['eenpersoons'] == 1) echo 'checked'; ?>></td>
        <td>Ik wil bij voorkeur een eenpersoonskamer <span class="nadruk">(meerprijs <?php echo euro($cursusdata['eenpers']) ?>; beperkt beschikbaar)</span></td>
      </tr>
      <tr>
        <td class="linkerkolom"><input name="kamperen" type="checkbox" id="kamperen" value="1"
						<?php if (isset($_POST['kamperen']) AND $_POST['kamperen'] == 1) echo 'checked'; ?>></td>
        <td>Ik wil graag kamperen op de kloostercamping <span class="nadruk">(korting <?php echo euro($cursusdata['kamperen']) ?> per persoon; beperkt beschikbaar)</span></td>
      </tr>
      <tr>
        <td class="linkerkolom"><input name="eigen_acc" type="checkbox" id="eigen_acc" value="1"
						<?php if (isset($_POST['eigen_acc']) AND $_POST['eigen_acc'] == 1) echo 'checked'; ?>></td>
        <td><p>Ik regel mijn eigen accommodatie en maak alleen gebruik van de gezamenlijke lunch, diner en koffie/thee<span class="nadruk"> (korting <?php echo euro($cursusdata['korting_eigen_acc']) ?>)</span></p></td>
      </tr>
      <tr>
        <td class="linkerkolom"><input name="diner" type="checkbox" id="diner" value="1"
						<?php if (isset($_POST['diner']) AND $_POST['diner'] == 1) echo 'checked'; ?>></td>
        <td><p>Hoewel ik mijn eigen accommodatie regel, maak ik graag ook gebruik van het gezamenlijke diner<span class="nadruk"> (meerprijs <?php echo euro($cursusdata['diner']) ?>)</span></p></td>
      </tr>
    </table>
    <p>Andere wensen t.a.v. huisvesting <span class="nadruk">(b.v. voorkeuren voor kamers delen)</span>: <br>
      <textarea name="acc_wens" cols="70" rows="5"><?php if (isset($_POST['acc_wens'])) echo $_POST['acc_wens']; ?></textarea>
    </p>
    <hr>
    <p>Eventuele dieetwensen:
      <input name="dieet" type=text id="dieet"
					value="<?php 
								if (isset($_POST['Dieet']) AND $_POST['Dieet'] != "") echo $_POST['Dieet']; else echo "[geen]"; ?>">
    </p>
    <hr>
    <table class="formulier">
      <tr>
        <td><p><br>
            Ik reis naar de cursuslocatie op de volgende wijze: <span class="nadruk">(graag
            een optie aanklikken)</span><br>
            <select name="vervoer" size="5" id="vervoer">
              <option value="???"
							<?php
							if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "???")) echo 'selected';
							?>>nog niet bekend</option>
              <option value="car (0 pl.)"
							<?php
							if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "car (0 pl.)"))
							echo 'selected'; ?>>met eigen auto, geen plaats voor meerijders</option>
              <option value="car (? pl.)"
							<?php
							if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "car (? pl.)")) echo 'selected';
							?>>met eigen auto, mogelijk plaats voor meerijder(s)</option>
              <option value="ride"
							<?php
							if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "ride")) echo 'selected';
							?>>graag meerijden</option>
              <option value="train"
							<?php
							if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "train")) echo 'selected';
							?>>per openbaar vervoer</option>
            </select>
          </p></td>
      </tr>
      <tr>
        <td><br>
          Anders, n.l.<br>
          <textarea name="reistype" rows="3"><?php 
						if (isset($_POST['reistype'])) echo $_POST['reistype']; ?></textarea></td>
      </tr>
    </table>
    <hr>
    <table class="formulier">
      <tr>
        <td class="linkerkolom"><input name="storting_fonds" type="checkbox" value="1"
						<?php if (isset($_POST['storting_fonds'])
						AND $_POST['storting_fonds'] == 1) echo 'checked'; ?>></td>
        <td>Ik ben bereid een bedrag van &euro;
          <input name="donatie"
							type=text id="donatie"
							value="<?php 
										if (isset($_POST['donatie']) AND $_POST['donatie'] > 0) 
										{$_POST['storting_fonds'] = 1; echo $_POST['donatie'];} ?>">
          te storten in het kortingenfonds&#160;ten behoeve van muziekstudenten.&#160;</td>
      </tr>
      <tr>
		<td class="linkerkolom"><input type="checkbox" name="student" value="1" id="student"
				<?php if (isset($_POST['student']) AND $_POST['student'] == 1) echo 'checked'; ?>>
		  <label for="checkbox"></label></td>
		<td>Ik ben student en/of jonger dan 36 jaar <span class="nadruk">(cursusgeld <?php echo euro($cursusdata['prijs_student']); ?> incl. plaats in tweepersoonskamer en volpension; SVP kopie bewijs van inschrijving of paspoort per mail insturen)</span></td>
	  </tr>
      <tr>
        <td class="linkerkolom"><input name="info_korting" type="checkbox" id="info_korting"
							value="1"
							<?php
							if (isset($_POST['info_korting'])
							AND $_POST['info_korting'] == 1) echo 'checked'; ?>></td>
        <td>Ik ben muziekstudent en zou informatie over kortingsmogelijkheden willen ontvangen.&#160;</td>
      </tr>
      <tr>
        <td colspan="2"><br>
Verdere opmerkingen en aanvullingen:<br>
<textarea name="opmerkingen" cols="70" rows="5" ><?php if (isset($_POST['opmerkingen'])) echo $_POST['opmerkingen']; ?></textarea></td>
      </tr>
    </table>
</p>
    <hr>
    <table border="0" class="formulier">
      <tr>
        <td class="linkerkolom"><input type="checkbox" name="voorwaarden"
							value="akkoord"
							<?php if (isset($_POST['voorwaarden'])) echo 'checked'; ?>></td>
        <td>Ik verklaar mij akkoord met de voorwaarden zoals vermeld onder <a href="praktisch.php">praktische zaken</a> en elders op de site <span class="nadruk">(verplicht!)</span> <br>
        	Ik begrijp dat mijn persoonlijke gegevens worden opgeslagen om praktische redenen die verband houden met de organisatie van de zomercursus. Ze worden nooit met andere partijen gedeeld zonder mijn uitdrukkelijke toestemming. <br></td>
      </tr>
      <tr class="">
        <td class="linkerkolom"><input type="checkbox" name="aanbetaling"
							value="betaald"
							<?php if (isset($_POST['aanbetaling'])) echo 'checked'; ?>></td>
        <td>Ik heb de aanbetaling van <?php echo euro($cursusdata['inschrijfgeld']) ?> overgemaakt op bankrekening NL33 ASNB 0707 2500 72 t.n.v. <em>La Pellegrina</em>,
          Utrecht. <span class="nadruk">(noodzakelijk voor verdere verwerking!)</span></td>
      </tr>
    </table>
<p>
      <input name="verzenden" type="submit" value="formulier verzenden">
      <span class="nadruk">(SVP slechts één keer klikken. Je ontvangt een automatische bevestiging van de verzending)</span>
      <input type="hidden" name="MM_insert" value="aanmelding">
</p>
