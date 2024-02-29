<hr>
    <p><strong>Standaard accommodatie is een tweepersoonskamer in het internaat<span class="budweis"> van de keramiekschool</span>. <br>
SVP hieronder je voorkeur aangeven als je een ander type accommodatie wilt.</strong></p>
    <table class="formulier">
      <tr>
        <td class="linkerkolom"><input type="checkbox" name="eenpersoons" id="eenpersoons" value="1"
						 <?php if (isset($_POST['eenpersoons']) AND $_POST['eenpersoons'] == 1) echo 'checked'; ?>></td>
        <td>Ik wil bij voorkeur een eenpersoonskamer in het internaat <span class="nadruk">(meerprijs <?php echo euro($cursusdata['eenpers']) ?>;
          beperkt beschikbaar)</span></td>
      </tr>
      <tr class="budweis">
        <td class="linkerkolom"><input name="hotel_2pp" type="checkbox" id="hotel_2pp" value="1" 
						<?php if (isset($_POST['hotel_2pp']) and $_POST['hotel_2pp'] == 1) echo 'checked'; ?>></td>
        <td>Ik prefereer een plaats in een tweepersoons kamer in Penzion Elektra <span class="nadruk onzichtbaar">Niet meer beschikbaar; Penzion Elektra is al volledig uitverkocht</span><span class="nadruk"> (meerprijs <?php echo euro($cursusdata['hotel_2pp']) ?>&nbsp;p.p.;
          beperkt beschikbaar)</span></td>
      </tr>
      <tr class="budweis">
        <td class="linkerkolom"><input name="hotel_1pp" type="checkbox" id="hotel_1pp" value="1" 
							<?php if (isset($_POST['hotel_1pp']) and $_POST['hotel_1pp'] == 1) echo 'checked'; ?>></td>
        <td>Ik prefereer een eenpersoons kamer in Penzion Elektra <span class="nadruk onzichtbaar">Eenpersoons kamers zijn niet meer beschikbaar in Penzion Elektra</span><span class="nadruk "> (meerprijs <?php echo euro($cursusdata['hotel_1pp']) ?>; <a href="praktisch.php#elektra">zeer beperkt beschikbaar</a>)</span></td>
      </tr>
      <tr class="budweis">
        <td class="linkerkolom"><input name="kamperen" type="checkbox" id="kamperen" value="1"
						<?php if (isset($_POST['kamperen']) AND $_POST['kamperen'] == 1) echo 'checked'; ?>></td>
        <td>Ik wil graag kamperen in de tuin van het klooster <span class="nadruk">(korting <?php echo euro($cursusdata['korting_eigen_acc']) ?>;
          beperkt mogelijk)</span></td>
      </tr>
      <tr>
        <td class="linkerkolom"><input name="eigen_acc" type="checkbox" id="eigen_acc" value="1"
						<?php if (isset($_POST['eigen_acc']) AND $_POST['eigen_acc'] == 1) echo 'checked'; ?>></td>
        <td>Ik regel mijn eigen accommodatie en ontbijt <span class="nadruk">(korting <?php echo euro($cursusdata['korting_eigen_acc']) ?>)</span></td>
      </tr>
    </table>
    <p>Andere wensen t.a.v. huisvesting <span class="nadruk">(b.v. voorkeuren voor kamers)</span>:<br>
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
            <select name="vervoer" size="7" id="vervoer">
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
              <option value="plane"
							<?php
							if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "plane")) echo 'selected';
							?>>per vliegtuig</option>
              <option value="train"
							<?php
							if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "train")) echo 'selected';
							?>>per trein</option>
              <option value="bus"
							<?php
							if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "bus")) echo 'selected';
							?>>per bus</option>
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
          te storten in het kortingenfonds&#160;ten behoeve van
          muziekstudenten en Oosteuropese deelnemers.&#160;</td>
      </tr>
      <tr>
		<td class="linkerkolom"><input type="checkbox" name="student" value="1" id="student"
				<?php if (isset($_POST['student']) AND $_POST['student'] == 1) echo 'checked'; ?>>
		  <label for="checkbox"></label></td>
		<td>Ik ben student en/of jonger dan 36 jaar <span class="nadruk">(cursusgeld <?php echo euro($cursusdata['prijs_student']) ?>;  
		  SVP kopie bewijs van inschrijving of paspoort per mail insturen)</span></td>
	  </tr>
      <tr>
        <td class="linkerkolom"><input name="info_korting" type="checkbox" id="info_korting"
							value="1"
							<?php
							if (isset($_POST['info_korting'])
							AND $_POST['info_korting'] == 1) echo 'checked'; ?>></td>
        <td>Ik ben muziekstudent en zou informatie over
          kortingsmogelijkheden willen ontvangen.&#160;</td>
      </tr>
      <tr>
        <td class="linkerkolom"><input name="oost" type="checkbox" id="oost" value="1"
						<?php if (isset($_POST['oost']) and $_POST['oost'] == 1)echo 'checked'; ?>></td>
        <td>Ik ben burger van een centraaleuropees land of een
          land van de voormalige Sovjet-Unie en doe een beroep op de
          daarvoor geldende korting.&#160;<br>
          <span class="nadruk">(zie voor meer informatie <a href="/algemeen/CE_prijzen.php">CE prices</a> of <a href="/algemeen/CZ_prijzen.php">České ceny</a>)</span></td>
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
      <tr>
        <td class="linkerkolom"><input type="checkbox" name="aanbetaling"
							value="betaald"
							<?php if (isset($_POST['aanbetaling'])) echo 'checked'; ?>></td>
        <td>Ik heb de aanbetaling van <?php echo euro($cursusdata['inschrijfgeld']) ?> overgemaakt op bankrekening NL33 ASNB 0707 2500 72 (BIC ASNB NL21) t.n.v. <em>La Pellegrina</em>,
          Utrecht. <span class="nadruk">(noodzakelijk voor verdere verwerking!)</span></td>
      </tr>
    </table>
<p>
      <input name="verzenden" type="submit" value="formulier verzenden">
      <span class="nadruk">(SVP slechts één keer klikken. Je ontvangt een automatische bevestiging van de verzending)</span>
      <input type="hidden" name="MM_insert" value="aanmelding">
</p>
