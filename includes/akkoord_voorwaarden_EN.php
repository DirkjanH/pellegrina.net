      <hr>
      <h3>Submit the form</h3>
      <table border="0" class="formulier">
        <tr>
          <td valign="bottom" class="linkerkolom"><input type="checkbox" name="voorwaarden" value="akkoord"
              <?php if (isset($_POST['voorwaarden'])) echo 'checked'; ?>></td>
          <td>I agree to the terms and conditions as stated under <a href="praktisch.php">practical matters</a> and elsewhere on the site <span class="nadruk">(mandatory!)</span> <br>
            I understand that my personal data will be stored for practical reasons related to the organization of the summer course. My data will be made available to other participants and tutors. They will never be shared with other parties without my express consent.
        </tr>
      </table>
      <p><input name="submit" type="submit" value="verzenden"></p>
      <p><span class="nadruk">(Please click only once. You will be redirected to the payment page or receive an automatic confirmation of the shipment)</span>
      </p>
      <input type="hidden" name="MM_insert" value="aanmelding">
    </form>
    </td>
    </tr>
    </table>
