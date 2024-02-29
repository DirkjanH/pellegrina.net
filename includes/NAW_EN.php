<table class="formulier">
<?php if ((empty($_POST["MM_insert"])) or ($_POST["MM_insert"] != "aanmelding"))
		{
		$opening = "<tr>
               <td>
					<h2 class=\"begin\">Registration</h2>
       <ul>
          <li>Please register by filling in this registration
             form <b>completely</b></li>
			<li>Please fill in the form for each course if you want to take part in <b>more than one course</b>. 
			If you return to the form using the 'return' function of your browser after registering for the first course, 
				all data filled in will remain in the form. You only have to indicate the second course 
				and possible other preferences</li>
          <li>Please pay the deposit electronically after sending in this form or transfer the <b>deposit of 
			 EUR&nbsp;{$cursusdata['inschrijfgeld']}</b> to <a href=\"contact.php\"><i>La
             Pellegrina,</i></a>. Czech participants can pay their deposit in CZK to Komerční Banka account 538940301/0100.</li>
          <li>You will then receive provisional confirmation of registration. Ultimately on {$cursusdata['beslisdatum']} you will receive a notification of placement</li>
          <li>By applying you agree with conditions stated in <a href=\"praktisch.php\">Practical matters</a> and elsewhere on this site.</li>
       </ul></td>
            </tr>
				<tr>
					<td><form id=\"f_zoeknaam\" action=\"{$_SERVER['PHP_SELF']}\" method=\"get\">
						  <span class=\"nadruk\">N.B.: </span>Did you take part in last year's
						  <i>La Pellegrina</i> summer school? Pre-fill the form with your data by entering the password 
						  sent to you by email and press \"Find last year's data\":
								<input name=\"pw\" type=\"text\" id=\"pw\" 
								value=\"{$_GET['pw']}\" maxlength=\"4\">
								<input name=\"Zoek\" type=\"submit\" id=\"Zoek\" value=\"Find last year's data\">
						</form>
					</td>
				</tr>";
				echo $opening;
				if (isset($zoekresultaat)) echo $zoekresultaat;
		}
	 ?>
<tr>
  <td><form action="<?php echo $editFormAction; ?>" method="POST"
					name="aanmelding" id="aanmelding">
			<hr>
    <table class="NAW">
              <tr>
                <td width="120">First name:</td>
                <td><input name="voornaam" type="text" id="voornaam"
							value="<?php
										 if (isset($_POST['voornaam'])) echo $_POST['voornaam']; ?>" /></td>
                <td width="15">&nbsp;</td>
                <td width="120">Sex: </td>
                <td><input name="geslacht" type="radio" value="M" id="geslacht_man" <?php if (isset($_POST['geslacht']) and ($_POST['geslacht'] == "M")) echo 'checked'; ?> /><label for = "geslacht_man">M</label>
                <input name="geslacht" type="radio" value="V" id="geslacht_vrouw" <?php if (isset($_POST['geslacht']) and ($_POST['geslacht'] == "V")) echo 'checked'; ?> /><label for = "geslacht_vrouw">F</label></td>
              </tr>
              <tr>
                <td>Middle name:</td>
                <td><input name="tussenvoegsels" type="text" id="tussenvoegsels"
							value="<?php if (isset($_POST['tussenvoegsels'])) echo $_POST['tussenvoegsels']; ?>" /></td>
                <td>&#160;</td>
                <td>Date of birth:</td>
                <td><input type="text" class="date" name="geboortedatum"
							value="<?php
if (isset($geboortedatum))echo safestrtotime('d-m-Y',$geboortedatum); else echo '[dd-mm-yyyy]'; ?>" /></td>
              </tr>
              <tr>
                <td>Last name:</td>
                <td colspan="4"><input name="achternaam" type="text" id="achternaam"
							value="<?php if (isset($_POST['achternaam'])) echo $_POST['achternaam']; ?>" class="lange_input" /></td>
              </tr>
              <tr>
                <td>Address:</td>
                <td colspan="4"><input name="adres" type="text"
							value="<?php if (isset($_POST['adres'])) echo $_POST['adres']; ?>" class="lange_input" /></td>
              </tr>
              <tr>
                <td>Postal code:</td>
                <td><input type="text" name="postcode"
							value="<?php if (isset($_POST['postcode'])) echo $_POST['postcode']; ?>" /></td>
                <td>&nbsp;</td>
                <td>Town:&#160;</td>
                <td><input type="text" name="plaats"
							value="<?php if (isset($_POST['plaats'])) echo $_POST['plaats']; ?>" /></td>
              </tr>
              <tr>
                <td>Country:&nbsp; <br /></td>
                <td colspan="4"><input name="taal" type="hidden" id="taal" value="EN" />
                  <input
							type="text" name="land"
							value="<?php 
										if (isset($_POST['land'])) echo $_POST['land']; ?>" class="lange_input" />
                  <input
							name="eerste_inschrijving" type="hidden" id="eerste_inschrijving"
							value="<?php echo $_POST['eerste_inschrijving']; ?>" />
                  <input
							name="DlnmrId" type="hidden" id="DlnmrId"
							value="<?php echo $_POST['DlnmrId']; ?>" />
                  <input
							name="DlnmrId_FK" type="hidden" id="DlnmrId_FK"
							value="<?php echo $_POST['DlnmrId_FK']; ?>" />
                  <input
							name="AdresId_FK" type="hidden" id="AdresId_FK"
							value="<?php echo $_POST['AdresId_FK']; ?>" />
                  <input
							name="AdresId" type="hidden" id="AdresId"
							value="<?php echo $_POST['AdresId']; ?>" />
                  <input
							name="datum_inschr" type="hidden" id="datum_inschr"
							value="<?php echo date("Y-m-d");?>" /></td>
              </tr>
              <tr>
                <td>Telephone:</td>
                <td><input type="tel" name="telefoon"
							value="<?php if (isset($_POST['telefoon'])) echo $_POST['telefoon']; ?>" /></td>
                <td>&nbsp;</td>
                <td>Mobile/cell phone:&#160;</td>
                <td><input type="tel"
							name="mobiel"
							value="<?php if (isset($_POST['mobiel'])) echo $_POST['mobiel']; ?>" /></td>
              </tr>
              <tr>
                <td>Email:</td>
                <td colspan="4"><input name="email" type="email" id="email"
							value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" />
                  <span class="nadruk">(obligatory!)</span></td>
              </tr>
    </table>
    <hr>
    <p> I wish to participate in the summer school</p>
    <h1 class="<?php echo $filenaam[6] ?> cursusnaam"><?php echo $cursusdata['cursusnaam_en']; ?></h1>
    <p class="<?php echo $filenaam[6] ?>"><strong><?php echo $cursusdata['cursusplaats_en'] . ', ' . $cursusdata['datum']; ?></strong></p>
    <p>      The course fee is <strong><?php echo euro_en($cursusdata['prijs_volledig']) ?></strong> per
      person; students and participants up to 35 years pay <strong><?php echo euro_en($cursusdata['prijs_student']) ?></strong>. <strong>Early registration</strong> (before <?php echo $cursusdata['beslisdatum']; ?>) 
      gives a <strong><?php echo euro_en($cursusdata['korting_vroeg']) ?> reduction</strong>.</p>
    <input name="CursusId_FK" type="hidden" value="<?php echo $cursusdata['CursusId']; ?>">
    <hr>
    <p>I know about this course in the first place from:</p>
    <table class="formulier">
      <tr>
        <td><input type="hidden" name="publiciteit" value="niet ingevuld">
          <input type="radio" name="publiciteit" 
											value="kennis" <?php 
									if (isset($_POST['publiciteit']) and ($_POST['publiciteit'] == "kennis"))
									echo 'checked'; ?>>
          friends/acquaintances, e.g.
          <input name="naam_aanbrenger" type="text" id="naam_aanbrenger" size="20" 
										value="<?php if (isset($_POST['naam_aanbrenger'])) 
										echo $_POST['naam_aanbrenger']; ?>"></td>
      </tr>
      <tr>
        <td><input type="radio" name="publiciteit" 
									value="VolkskrantNRCTrouw" <?php 
									if (isset($_POST['publiciteit']) and ($_POST['publiciteit'] == "VolkskrantNRCTrouw"))
									echo 'checked'; ?>>
          advert in a newspaper</td>
      </tr>
      <tr>
        <td><label>
            <input type="radio" name="publiciteit" 
										value="ZingAkkoord" <?php 
									if (isset($_POST['publiciteit']) and ($_POST['publiciteit'] == "ZingAkkoord"))
									echo 'checked'; ?>>
            advert in a musical journal</label></td>
      </tr>
      <tr>
        <td><label>
            <input type="radio" name="publiciteit" 
										value="internet" <?php 
									if (isset($_POST['publiciteit']) and ($_POST['publiciteit'] == "internet"))
									echo 'checked'; ?>>
            the internet</label></td>
      </tr>
      <tr>
        <td><label>
            <input type="radio" name="publiciteit" 
										value="folder" <?php 
									if (isset($_POST['publiciteit']) and ($_POST['publiciteit'] == "folder"))
									echo 'checked'; ?>>
            the La Pellegrina leaflet </label></td>
      </tr>
      <tr>
        <td><label>
            <input type="radio" name="publiciteit" 
										value="anders" <?php 
									if (isset($_POST['publiciteit']) and ($_POST['publiciteit'] == "anders"))
									echo 'checked'; ?>>
            otherwise, e.g. </label></td>
      </tr>
    </table>
    <p class="standaard">
      <textarea name="publiciteit_tx" cols="70" rows="3" id="publiciteit_tx"><?php 
					if (isset($_POST['publiciteit_tx'])) echo $_POST['publiciteit_tx']; ?></textarea>
    </p>
    <hr>
