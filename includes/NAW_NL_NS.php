<table border="0" cellpadding="5" class="formulier">
  <?php if ((empty($_POST["MM_insert"])) or ($_POST["MM_insert"] != "aanmelding")) {
    $opening =
      "<tr>
                <td>
					<h2 class=\"begin\">Aanmelding</h2>
					<ul>
						<li>Je kunt je inschrijven voor deze cursus door middel van dit formulier, dat <b>volledig</b> ingevuld dient te worden</li>
						<li>Je aanmelding wordt verwerkt zodra de <b>aanbetaling van €&nbsp;{$cursusdata['inschrijfgeld']}</b> is ontvangen op rekening NL60 BUNQ 2177 4957 25 (BIC BUNQ NL2A) t.n.v. <em>La Pellegrina</em>, Utrecht</li>
						<li>Je ontvangt dan een voorlopige bevestiging van inschrijving. Uiterlijk op <b>{$cursusdata['beslisdatum']}</b> wordt de definitieve bezetting bekend gemaakt</li>
						<li>Door inschrijving verklaar je je akkoord met de voorwaarden zoals vermeld onder <a href=\"praktisch.php\">praktische zaken</a> en elders op de site.</li>
					  </ul>
				 </td>
            </tr>
			<tr>
				<td><form id=\"f_zoeknaam\" action=\"{$_SERVER['PHP_SELF']}\" method=\"get\">
					  <span class=\"nadruk\">N.B.:</span> Heb je eerder deelgenomen
					  aan een cursus van <i>La Pellegrina</i>? Haal dan je gegevens op uit het bestand. 
					  Vul je per email gekregen password in en druk op \"Zoek oude gegevens\":
							<input name=\"pw\" type=\"text\" id=\"pw\" 
							value=\"{$_GET['pw']}\" maxlength=\"4\">
							<input name=\"Zoek\" type=\"submit\" id=\"Zoek\" value=\"Zoek oude gegevens\">
					</form>
				</td>
			</tr>";
    echo $opening;
    if (isset($zoekresultaat)) echo $zoekresultaat;
  }
  ?>
  <tr>
    <td>
      <form action="<?php echo $editFormAction; ?>" method="POST"
        name="aanmelding" id="aanmelding">
        <hr>
        <table class="NAW">
          <tr>
            <td>Voornaam:</td>
            <td><input name="voornaam" type=text id="voornaam"
                value="<?php
                        if (isset($_POST['voornaam'])) echo $_POST['voornaam']; ?>"></td>
            <td width="15">&nbsp;</td>
            <td width="105"> Geslacht: </td>
            <td><input name="geslacht" type="radio" value="M" id="geslacht_man" <?php if (isset($_POST['geslacht']) and ($_POST['geslacht'] == "M")) echo 'checked'; ?> />
              <label for="geslacht_man">M</label>
              <input name="geslacht" type="radio" value="V" id="geslacht_vrouw" <?php if (isset($_POST['geslacht']) and ($_POST['geslacht'] == "V")) echo 'checked'; ?> />
              <label for="geslacht_vrouw">F</label>
            </td>
          </tr>
          <tr>
            <td>Tussenvoegsels:</td>
            <td><input name="tussenvoegsels" type="text" id="tussenvoegsels"
                value="<?php if (isset($_POST['tussenvoegsels'])) echo $_POST['tussenvoegsels']; ?>"></td>
            <td>&#160;</td>
            <td>Geb.datum:</td>
            <td><input type="text" class="date" name="geboortedatum"
                value="<?php
                        if (isset($geboortedatum)) echo safestrtotime('d-m-Y', $geboortedatum);
                        else echo '[dd-mm-jjjj]'; ?>" /></td>
          </tr>
          <tr>
            <td>Achternaam:</td>
            <td colspan="4"><input name="achternaam" type=text id="achternaam"
                value="<?php if (isset($_POST['achternaam'])) echo $_POST['achternaam']; ?>" class="lange_input"></td>
          </tr>
          <tr>
            <td>Adres:</td>
            <td colspan="4"><input name="adres" type=text
                value="<?php if (isset($_POST['adres'])) echo $_POST['adres']; ?>" class="lange_input"></td>
          </tr>
          <tr>
            <td>Postcode:</td>
            <td><input type=text name="postcode"
                value="<?php if (isset($_POST['postcode'])) echo $_POST['postcode']; ?>"></td>
            <td>&nbsp;</td>
            <td>Plaats:&#160;</td>
            <td><input type=text name="plaats"
                value="<?php if (isset($_POST['plaats'])) echo $_POST['plaats']; ?>" /></td>
          </tr>
          <tr>
            <td>Land:&#160; <br></td>
            <td colspan="4"><input name="taal" type=hidden value="NL">
              <input
                type=text name="land"
                value="<?php
                        if (isset($_POST['land'])) echo $_POST['land']; ?>" class="lange_input" />
              <span class="nadruk">(alleen invullen indien niet
                Nederland)</span>
              <input
                name="eerste_inschrijving" type="hidden"
                value="<?php echo $_POST['eerste_inschrijving']; ?>" />
              <input
                name="DlnmrId" type="hidden"
                value="<?php echo $_POST['DlnmrId']; ?>" />
              <input
                name="DlnmrId_FK" type="hidden"
                value="<?php echo $_POST['DlnmrId_FK']; ?>" />
              <input
                name="AdresId_FK" type="hidden"
                value="<?php echo $_POST['AdresId_FK']; ?>" />
              <input
                name="AdresId" type="hidden"
                value="<?php echo $_POST['AdresId']; ?>" />
              <input
                name="datum_inschr" type="hidden"
                value="<?php echo date("Y-m-d"); ?>" />
            </td>
          </tr>
          <tr>
            <td>Telefoon:</td>
            <td><input type=tel name="telefoon"
                value="<?php if (isset($_POST['telefoon'])) echo $_POST['telefoon']; ?>"></td>
            <td>&nbsp;</td>
            <td>Mobiel nr.:&#160;</td>
            <td><input type="tel"
                name="mobiel"
                value="<?php if (isset($_POST['mobiel'])) echo $_POST['mobiel']; ?>" /></td>
          </tr>
          <tr>
            <td>Email:</td>
            <td colspan="4"><input name=email type="email" id="email"
                value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
              <span class="nadruk">(verplicht!)</span>
            </td>
          </tr>
        </table>
        <hr>
        <p>Ik neem graag deel aan het project </p>
        <h1 class="<?php echo $filenaam[6] ?> cursusnaam"><?php echo $cursusdata['cursusnaam_nl']; ?></h1>
        <p class="<?php echo $filenaam[6] ?>"><strong><?php echo $cursusdata['cursusplaats_nl'] . ', ' . $cursusdata['datum']; ?></strong></p>
        <p>De prijs van het project bedraagt <strong><?php echo euro($cursusdata['prijs_volledig']) ?></strong> per
          persoon, <strong>exclusief</strong> accommodatie en maaltijden.</p>
        <input name="CursusId_FK" type="hidden" value="<?php echo $cursusdata['CursusId']; ?>">
        <hr>
        <p>Ik weet van deze cursus in de eerste plaats via:</p>
        <table class="formulier">
          <tr>
            <td class="standaard"><input type="hidden" name="publiciteit" value="niet ingevuld">
              <input type="radio" name="publiciteit"
                value="kennis"
                <?php
                if (isset($_POST['publiciteit']) and ($_POST['publiciteit'] == "kennis"))
                  echo 'checked'; ?>>
              vrienden/bekenden, n.l.
              <input
                name="naam_aanbrenger" type="text" id="naam_aanbrenger"
                value="<?php if (isset($_POST['naam_aanbrenger']))
                          echo $_POST['naam_aanbrenger']; ?>">
            </td>
          </tr>
          <tr>
            <td class="standaard"><input type="radio" name="publiciteit"
                value="VolkskrantNRCTrouw"
                <?php
                if (isset($_POST['publiciteit']) and ($_POST['publiciteit'] == "VolkskrantNRCTrouw"))
                  echo 'checked'; ?>>
              advertentie in de Volkskrant/NRC/Trouw</td>
          </tr>
          <tr>
            <td class="standaard"><label>
                <input type="radio"
                  name="publiciteit" value="ZingAkkoord"
                  <?php
                  if (isset($_POST['publiciteit']) and ($_POST['publiciteit'] == "ZingAkkoord"))
                    echo 'checked'; ?>>
                advertentie in Zing! / Akkoord </label></td>
          </tr>
          <tr>
            <td class="standaard"><label>
                <input type="radio"
                  name="publiciteit" value="internet"
                  <?php
                  if (isset($_POST['publiciteit']) and ($_POST['publiciteit'] == "internet"))
                    echo 'checked'; ?>>
                internet</label></td>
          </tr>
          <tr>
            <td class="standaard"><label>
                <input type="radio"
                  name="publiciteit" value="folder"
                  <?php
                  if (isset($_POST['publiciteit']) and ($_POST['publiciteit'] == "folder"))
                    echo 'checked'; ?>>
                de La Pellegrina-folder</label></td>
          </tr>
          <tr>
            <td class="standaard"><label>
                <input type="radio"
                  name="publiciteit" value="anders"
                  <?php
                  if (isset($_POST['publiciteit']) and ($_POST['publiciteit'] == "anders"))
                    echo 'checked'; ?>>
                anders, n.l.</label></td>
          </tr>
        </table>
        <p class="standaard">
          <textarea name="publiciteit_tx" cols="70"
            rows="3" id="publiciteit_tx"><?php
                                          if (isset($_POST['publiciteit_tx'])) echo $_POST['publiciteit_tx']; ?>
</textarea>
        </p>
        <hr>