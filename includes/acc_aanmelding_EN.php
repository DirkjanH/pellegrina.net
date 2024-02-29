<hr>
   <p><strong>Standard accommodation is a double room at the <span class="budweis">ceramics school</span> hostel. <br>
   Please indicate underneath if you want another type of accommodation.</strong></p>
            <table class="formulier">
              <tr>
                <td class="linkerkolom" ><input type="checkbox" name="eenpersoons" id="eenpersoons" value="1"
						 <?php if (isset($_POST['eenpersoons']) AND $_POST['eenpersoons'] == 1) echo 'checked'; ?>></td>
                <td>I prefer a single room at the <span class="budweis">ceramics</span> school hostel <span class="nadruk">(surcharge <?php echo euro_en($cursusdata['eenpers']) ?>;
                  availability limited)</span></td>
              </tr>
              <tr class="budweis">
                <td class="linkerkolom"><input name="hotel_2pp" type="checkbox" id="hotel_2pp" value="1" 
						<?php if (isset($_POST['hotel_2pp']) and $_POST['hotel_2pp'] == 1) echo 'checked'; ?>></td>
                <td>I prefer a double room at Penzion Elektra <span class="nadruk onzichtbaar">No longer available; Penzion Elektra is already fully booked 
						 </span><span class="nadruk"> (surcharge <?php echo euro_en($cursusdata['hotel_2pp']); ?> per person;
                  availability limited)</span></td>
              </tr>
              <tr class="budweis">
                <td class="linkerkolom"><input name="hotel_1pp" type="checkbox" id="hotel_1pp" value="1" 
							<?php if (isset($_POST['hotel_1pp']) and $_POST['hotel_1pp'] == 1) echo 'checked'; ?>></td>
                <td>I prefer a single room at Penzion Elektra <span class="nadruk onzichtbaar">Single rooms are no longer available; they are already fully booked 
						 </span><span class="nadruk"> (surcharge <?php echo euro_en($cursusdata['hotel_1pp']); ?>;
                  <a href="praktisch.php#elektra">availability very limited</a>)</span></td>
              </tr>
              <tr class="budweis">
                <td class="linkerkolom"><input name="kamperen" type="checkbox" id="kamperen" value="1"
						<?php if (isset($_POST['kamperen']) AND $_POST['kamperen'] == 1) echo 'checked'; ?>></td>
                <td>I would like to camp in the monastery garden <span class="nadruk">(reduction <?php echo euro_en($cursusdata['korting_eigen_acc']) ?>;
                  availability limited )</span></td>
              </tr>
              <tr>
                <td class="linkerkolom"><input name="eigen_acc" type="checkbox" id="eigen_acc" value="1"
						<?php if (isset($_POST['korting_eigen_acc']) AND $_POST['korting_eigen_acc'] == 1) echo 'checked'; ?>></td>
                <td>I arrange my own accommodation and breakfast <span class="nadruk">(reduction <?php echo euro_en($cursusdata['korting_eigen_acc']) ?>)</span></td>
              </tr>
            </table>
            <p>Other wishes concerning accommodation:<br>
              <textarea name="acc_wens" cols="70" rows="5"><?php 
						if (isset($_POST['acc_wens'])) echo $_POST['acc_wens']; ?></textarea>
            </p>
            <hr>
            <p>Diet requirements:
              <input name="dieet" type=text id="dieet"
					size="50"
					value="<?php 
								if (isset($_POST['Dieet']) AND $_POST['Dieet'] != "") echo $_POST['Dieet']; else echo "[none]"; ?>">
            </p>
            <hr>
            <table>
              <tr>
                <td>&nbsp;</td>
                <td><p><br>
                  I intend to travel to the summer school in the following
                  way: <span class="nadruk">(please select
                    an option)</span><br>
                  <select name="vervoer" size="7" id="vervoer">
                    <option value="???" <?php 
										if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "???")) echo 'selected'; 
										?> >not yet known</option>

                    <option value="car (0 pl.)" <?php 
												if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "car (0 pl.)")) 
									echo 'selected'; ?>>by car, no places for passengers</option>
                    <option value="car (? pl.)" <?php 
										if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "car (? pl.)")) echo 'selected'; 
										?> >by car, possibly place for one or more passengers</option>
                    <option value="ride" <?php 
										if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "ride")) echo 'selected'; 
										?> >I wish to join others travelling by car</option>
                    <option value="plane" <?php 
										if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "plane")) echo 'selected'; 
										?> >by plane</option>
                    <option value="train" <?php 
										if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "train")) echo 'selected'; 
										?> >by train</option>
                    <option value="bus" <?php 
										if (isset($_POST['vervoer']) and ($_POST['vervoer'] == "bus")) echo 'selected'; 
										?> >by bus</option>
                  </select>
                </p></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><br>
                  Different, i.e.:<br>
                  <textarea name="reistype" cols="70" rows="3"><?php 
										if (isset($_POST['reistype'])) echo $_POST['reistype']; ?></textarea></td>
              </tr>
            </table>
            <hr>
            <table>
              <tr>
                <td width="33" class="linkerkolom"><input name="storting_fonds" type="checkbox" value="1" 
									<?php if (isset($_POST['storting_fonds']) 
									AND $_POST['storting_fonds'] == 1) echo 'checked'; ?> ></td>
                <td width="555">I am willing to contribute EUR
                  <input name="donatie" type=text id="donatie" value="<?php 
										if (isset($_POST['donatie']) AND $_POST['donatie'] > 0) 
										{$_POST['storting_fonds'] = 1; echo $_POST['donatie'];} ?>" size="5">
                  to the reduction fund for participants from Eastern
                  Europe and students. </td>
              </tr>
              <tr>
                <td class="linkerkolom"><input type="checkbox" name="student" value="1" id="student" 
									<?php if (isset($_POST['student']) AND $_POST['student'] == 1) echo 'checked'; ?> >
                  <label for="checkbox"></label></td>
                <td>I am a full-time student or up to 35 years <span class="nadruk">(fee <?php echo euro_en($cursusdata['prijs_student']); ?>, please <a href="contact.php">send in by e-mail</a>
                  a copy of proof of registration or passport as proof of age) </span></td>
              </tr>
              <tr>
                <td class="linkerkolom"><input name="info_korting" type="checkbox" id="info_korting" value="1" <?php 
									if (isset($_POST['info_korting']) AND $_POST['info_korting'] == 1) 
									echo 'checked'; ?> ></td>
                <td>I am a music student and wish to receive information about reductions. </td>
              </tr>
              <tr>
                <td class="linkerkolom"><input name="oost" type="checkbox" id="oost" value="1" <?php 
									if (isset($_POST['oost']) AND $_POST['oost'] == 1) echo 'checked'; ?> ></td>
                <td>I am citizen of a Central European
                  or former Soviet Union country and apply for the
                  relevant reduction.<br>
                  <span class="nadruk">(for more information see <a href="/algemeen/CE_prijzen.php" target="_blank">CE
                    prices</a> or <a href="/algemeen/CZ_prijzen.php" target="_blank">České
                      ceny</a>)</span></td>
              <tr>
                <td colspan="2"><br>
                  Remarks and additional information:<br>
                  <textarea name="opmerkingen" rows="5" cols="70"><?php 
											if (isset($_POST['opmerkingen'])) echo $_POST['opmerkingen']; ?></textarea></td>
              </tr>
            </table>
            </p>
            <hr>
            <table border="0">
              <tr>
                <td valign="bottom" class="linkerkolom"><input type="checkbox" name="voorwaarden" value="akkoord" 
									<?php if (isset($_POST['voorwaarden'])) echo 'checked'; ?> ></td>
                <td>I agree to the conditions stated in <a href="praktisch.php">Practical
                matters</a> and elsewhere on this site <span class="nadruk">(mandatory!)</span>. <br>
                I understand my personal data are stored for practical reasons related to the organisation of the summer school. They will never be shared with third parties without my explicit permission.</td>
              </tr>
 			     <tr>
                <td valign="bottom" class="linkerkolom"><input type="checkbox" name="aanbetaling" value="betaald" 
									<?php if (isset($_POST['aanbetaling'])) echo 'checked'; ?> ></td>
                <td valign="top">I have paid a deposit of <?php echo euro_en($cursusdata['inschrijfgeld']); ?> by bank transfer or by <a href="praktisch.php#paypal">PayPal</a> <span class="nadruk">(paying the deposit is required for further processing!)</span>
                  <p>Please see the <a href="praktisch.php" target="_blank">practical matters</a> page for other convenient ways of international
                payment.</p></td>
              </tr>
            </table>
            <p>
              <input name="submit" type="submit" value="send the form">
              <input name="reset" type="reset" value="clear">
              <span class="nadruk">(please click only once.
            You will see an automatic confirmation of receipt)</span></p>
