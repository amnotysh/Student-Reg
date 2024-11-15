<?php
  session_start();  

    include 'reg_tbl.php';
    include 'insert.php';
    if (!isset($_SESSION['personal_data'])) {
      $_SESSION['personal_data'] = [
          'f_name' => '',
          'l_name' => '',
          'bday' => '',
          'email' => '',
          'mobile_num' => '',
          'gender' => '',
          'h_address' => '',
          'city' => '',
          'r_state' => '',
          'country' => '',
          'pin_code' => '',
          'hobbies' => [],
          'other_hobbies' => '',
      ];
  }
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reg_submit'])) {
    // Store form data in session variables
    $_SESSION['personal_data'] = [
        'f_name' => $_POST['f_name'] ?? '',
        'l_name' => $_POST['l_name'] ?? '',
        'bday' => $_POST['bday'] ?? '',
        'email' => $_POST['email'] ?? '',
        'mobile_num' => $_POST['mobile_num'] ?? '',
        'gender' => $_POST['gender'] ?? '',
        'h_address' => $_POST['h_address'] ?? '',
        'city' => $_POST['city'] ?? '',
        'r_state' => $_POST['r_state'] ?? '',
        'country' => $_POST['country'] ?? '',
        'pin_code' => $_POST['pin_code'] ?? '',
        'hobbies' => isset($_POST['hobbies']) ? (array) $_POST['hobbies'] : [],
        'other_hobbies' => $_POST['other_hobbies'] ?? '',
    ];    
        $hobbies = isset($_POST['hobbies']) ? (array) $_POST['hobbies'] : [];

        $hobbies = array_filter($hobbies, function($hobby) {
          return $hobby !== 'Others:'; // Exclude "Others:"
      });
      // Check if "Others" is checked and add the other_hobbies value
      if (isset($_POST['hobbies']) && in_array('Others:', $_POST['hobbies'])) {
          $other_hobbies = trim($_POST['other_hobbies']);
          if (!empty($other_hobbies)) {
              $hobbies[] = $other_hobbies; // Add the other hobbies to the hobbies array
          }
  
  }
  $_SESSION['personal_data']['hobbies'] = $hobbies;

  header('Location: qualification.php');
  }
  // Check if the clear button is pressed
  if (isset($_POST['clear'])) {
      // Unset personal_data session variable
      unset($_SESSION['personal_data']);
      header('Location: index.php');
      exit;

}
if (isset($_SESSION['success_message'])) {
  echo <<<HTML
  <div class= 'card__main__container'>
    <div class = "card_sub_container" >
      <div class="card">
      <button type='button' class='dismiss' onclick="closeModal();">
                <img src='assets/images/x.svg'>
        </button>
        <h2 class="cookieHeading">Successfully Inserted in the database</h2>
        <h1 class="cookieHeading">Data Saved Successfully</h1>
        <p class="cookieDescription"> 
        Your data is now stored in the reg_tbl table
        </p>
        <button class = "primary__btn__solid" onclick="closeModal();">
          <a class = "secondary_bg_txt">Done</a>
        </button>
      </div>
    </div>
  </div>
  HTML;
  unset($_SESSION['success_message']); // Clear the message after displaying
}
if (isset($_SESSION['error_message'])) {
  echo <<<HTML
  <div class= 'card__main__container'>
    <div class = "card_sub_container" >
      <div class="card">
        <button type='button' class='dismiss' onclick="closeModal();">
                <img src='assets/images/x.svg'>
        </button>
        <h2 class = "cookieHeading">Data insert unsuccessful</h2>
        <h1 class="cookieHeading">Student Data already exist</h1>
        <p class="cookieDescription">
        Please insert a different student data.
        </p>
        <button class = "primary__btn__solid" onclick="closeModal();">
          <a class = "secondary_bg_txt">OK</a>
          </button>
      </div>
    </div>
  </div>
  HTML;
  unset($_SESSION['error_message']); // Clear the message after displaying
} 
?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Details</title>
    <!-- montserrat font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- hind font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- style link -->
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/default.css">
    <link rel="stylesheet" href="styles/utility.css">
    <link rel="stylesheet" href="styles/form.css">
    <link rel="stylesheet" href="styles/modal.css">
    <script>
    function toggleOtherHobbies(checkbox) {
      const inputField = document.getElementById('otherHobbiesInput');
      inputField.disabled = !checkbox.checked;
      if (checkbox.checked) inputField.focus(); 
    }

    document.addEventListener('DOMContentLoaded', function() {
      const othersCheckbox = document.querySelector('input[name="hobbies[]"][value="Others:"]');
      const otherHobbiesInput = document.getElementById('otherHobbiesInput');
      otherHobbiesInput.disabled = !othersCheckbox.checked;
    });

    function closeModal() {
      const modal = document.querySelector('.card__main__container');
      if (modal) {
        modal.classList.add('closeWindow'); // Hide the modal by adding a 'closeWindow' class
      }
    }
</script>
  </head>
  <body>
    <main>
      <section class="reg__container container">
        <div class="sub__container">
          <div class="upper__content">
            <img src="assets/images/logo.png" alt="" class="logo">
            <h1>Personal Information</h1>
          </div>
          <form action = "" method = "POST">
            <div class="input__container">  
              <div class="multi__input">
                <div class="input__group">
                  <label class="label">First Name</label>
                  <input type="text" name="f_name" class="input input__name" required value="<?php echo $_SESSION['personal_data']['f_name'] ?? ''; ?>">
                </div>
                <div class="input__group">
                  <label class="label">Last Name</label>
                  <input type="text" name="l_name" class="input input__name" required value="<?php echo $_SESSION['personal_data']['l_name'] ?? ''; ?>">
                </div>
              </div>
              <div class="input__group">
                  <label class="label">Date of Birth</label>
                  <input type="date" name="bday" class="input single__input" required value="<?php echo $_SESSION['personal_data']['bday'] ?? ''; ?>">
              </div>
              <div class="input__group">
                  <label class="label">Email ID</label>
                  <input type="email" name="email" class="input single__input" required value="<?php echo $_SESSION['personal_data']['email'] ?? ''; ?>">
              </div>
              <div class="multi__input">
                <div class="input__group">
                  <label class="label">Mobile Number</label>
                  <input type="tel" name="mobile_num" class="input input__name" required value="<?php echo $_SESSION['personal_data']['mobile_num'] ?? ''; ?>">
                </div>
                <div class="input__group">
                  <label class="label">Gender</label>
                  <select class="input input__name" name="gender" id="gender" required>
                    <option value="">Gender</option>
                    <option value="Male" <?php echo $_SESSION['personal_data']['gender'] && $_SESSION ['personal_data']['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo $_SESSION['personal_data']['gender'] && $_SESSION ['personal_data']['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                  </select>
                </div>
              </div>
              <div class="input__group">
                  <label class="label">Address</label>
                  <input type="text" name="h_address" class="input single__input" required value="<?php echo $_SESSION['personal_data']['h_address'] ?? ''; ?>">
              </div>
              <div class="multi__input">
                <div class="input__group">
                  <label class="label">City</label>
                  <input type="text" name="city" class="input input__name" required value="<?php echo $_SESSION['personal_data']['city'] ?? ''; ?>">
                </div>
                <div class="input__group">
                  <label class="label">State</label>
                  <select class="input input__name" name="r_state" id="state" required>
                    <option value="">Select Region</option>
                    <option value="NCR" <?php echo $_SESSION['personal_data']['r_state'] && $_SESSION ['personal_data']['r_state'] == 'NCR' ? 'selected' : ''; ?>>NCR</option>
                    <option value="CAR" <?php echo $_SESSION['personal_data']['r_state'] && $_SESSION ['personal_data']['r_state'] == 'CAR' ? 'selected' : ''; ?>>CAR</option>
                    <option value="Region I" <?php echo $_SESSION['personal_data']['r_state'] && $_SESSION ['personal_data']['r_state'] == 'Region I' ? 'selected' : ''; ?>>Region I</option>
                    <option value="Region II" <?php echo $_SESSION['personal_data']['r_state'] && $_SESSION ['personal_data']['r_state'] == 'Region II' ? 'selected' : ''; ?>>Region II</option>
                    <option value="Region III" <?php echo $_SESSION['personal_data']['r_state'] && $_SESSION ['personal_data']['r_state'] == 'Region III' ? 'selected' : ''; ?>>Region III</option>
                    <option value="Region IV-A" <?php echo $_SESSION['personal_data']['r_state'] && $_SESSION ['personal_data']['r_state'] == 'Region IV-A' ? 'selected' : ''; ?>>Region IV-A</option>
                    <option value="Region IV-B" <?php echo $_SESSION['personal_data']['r_state'] && $_SESSION ['personal_data']['r_state'] == 'Region IV-B' ? 'selected' : ''; ?>>Region IV-B</option>
                    <option value="Region V" <?php echo $_SESSION['personal_data']['r_state'] && $_SESSION ['personal_data']['r_state'] == 'Region V' ? 'selected' : ''; ?>>Region V</option>
                    <option value="Region VI" <?php echo $_SESSION['personal_data']['r_state'] && $_SESSION ['personal_data']['r_state'] == 'Region VI' ? 'selected' : ''; ?>>Region VI</option>
                    <option value="Region VII" <?php echo $_SESSION['personal_data']['r_state'] && $_SESSION ['personal_data']['r_state'] == 'Region VII' ? 'selected' : ''; ?>>Region VII</option>
                    <option value="Region VIII" <?php echo $_SESSION['personal_data']['r_state'] && $_SESSION ['personal_data']['r_state'] == 'Region VIII' ? 'selected' : ''; ?>>Region VIII</option>
                    <option value="Region IX" <?php echo $_SESSION['personal_data']['r_state'] && $_SESSION ['personal_data']['r_state'] == 'Region IX' ? 'selected' : ''; ?>>Region IX</option>
                    <option value="Region X" <?php echo $_SESSION['personal_data']['r_state'] && $_SESSION ['personal_data']['r_state'] == 'Region X' ? 'selected' : ''; ?>>Region X</option>
                    <option value="Region XI" <?php echo $_SESSION['personal_data']['r_state'] && $_SESSION ['personal_data']['r_state'] == 'Region XI' ? 'selected' : ''; ?>>Region XI</option>
                    <option value="Region XII" <?php echo $_SESSION['personal_data']['r_state'] && $_SESSION ['personal_data']['r_state'] == 'Region XII' ? 'selected' : ''; ?>>Region XII</option>
                    <option value="Region XIII" <?php echo $_SESSION['personal_data']['r_state'] && $_SESSION ['personal_data']['r_state'] == 'Region XIII' ? 'selected' : ''; ?>>Region XIII</option>
                    <option value="BARMM" <?php echo $_SESSION['personal_data']['r_state'] && $_SESSION ['personal_data']['r_state'] == 'BARMM' ? 'selected' : ''; ?>>BARMM</option>
                  </select>
                </div>
              </div>
              <div class="multi__input">
                <div class="input__group">
                    <label class="label">Country</label>
                    <select class="input input__name" name="country" id="country" required> 
                      <option value="">Country</option> 
                      <option value="Philippines" <?php echo $_SESSION['personal_data']['country'] && $_SESSION ['personal_data']['country'] == 'Philippines' ? 'selected' : ''; ?>>Philippines</option>
                      <option value="United States" <?php echo $_SESSION['personal_data']['country'] && $_SESSION ['personal_data']['country'] == 'United States' ? 'selected' : ''; ?>>United States</option>
                      <option value="Canada" <?php echo $_SESSION['personal_data']['country'] && $_SESSION ['personal_data']['country'] == 'Canada' ? 'selected' : ''; ?>>Canada</option>
                      <option value="United Kingdom" <?php echo $_SESSION['personal_data']['country'] && $_SESSION ['personal_data']['country'] == 'United Kingdom' ? 'selected' : ''; ?>>United Kingdom</option>
                      <option value="Australia" <?php echo $_SESSION['personal_data']['country'] && $_SESSION ['personal_data']['country'] == 'Australia' ? 'selected' : ''; ?>>Australia</option>
                      <option value="Germany" <?php echo $_SESSION['personal_data']['country'] && $_SESSION ['personal_data']['country'] == 'Germany' ? 'selected' : ''; ?>>Germany</option>
                      <option value="France" <?php echo $_SESSION['personal_data']['country'] && $_SESSION ['personal_data']['country'] == 'France' ? 'selected' : ''; ?>>France</option>
                      <option value="Italy" <?php echo $_SESSION['personal_data']['country'] && $_SESSION ['personal_data']['country'] == 'Italy' ? 'selected' : ''; ?>>Italy</option>
                      <option value="Japan" <?php echo $_SESSION['personal_data']['country'] && $_SESSION ['personal_data']['country'] == 'Japan' ? 'selected' : ''; ?>>Japan</option>
                      <option value="China" <?php echo $_SESSION['personal_data']['country'] && $_SESSION ['personal_data']['country'] == 'China' ? 'selected' : ''; ?>>China</option>
                      <option value="India" <?php echo $_SESSION['personal_data']['country'] && $_SESSION ['personal_data']['country'] == 'India' ? 'selected' : ''; ?>>India</option>
                      <option value="Brazil" <?php echo $_SESSION['personal_data']['country'] && $_SESSION ['personal_data']['country'] == 'Brazil' ? 'selected' : ''; ?>>Brazil</option>
                      <option value="South Africa" <?php echo $_SESSION['personal_data']['country'] && $_SESSION ['personal_data']['country'] == 'South Africa' ? 'selected' : ''; ?>>South Africa</option>
                      <option value="Mexico" <?php echo $_SESSION['personal_data']['country'] && $_SESSION ['personal_data']['country'] == 'Mexico' ? 'selected' : ''; ?>>Mexico</option>
                      <option value="South Korea" <?php echo $_SESSION['personal_data']['country'] && $_SESSION ['personal_data']['country'] == 'South Korea' ? 'selected' : ''; ?>>South Korea</option>
                    </select>
                  </div>
                  <div class="input__group">
                    <label class="label">Zip Code</label>
                    <input type="number" name="pin_code" class="input input__name" required value="<?php echo $_SESSION['personal_data']['pin_code'] ?? ''; ?>">
                  </div>
                </div>
            </div>
            <div class="input__group hobbies__main">
              <h2>Hobbies</h2>  
              <div class="hobbies_sub">
                <div class="hobbies">
                  <div class="hobbies__container">
                    <div class="check__container">
                      <div class="check__box check__one">
                        <label>
                          <input type="checkbox" class="input" name = "hobbies[]" value = "Dancing"
                          <?php echo (isset($_SESSION['personal_data']['hobbies']) && is_array($_SESSION['personal_data']['hobbies']) && in_array('Dancing', $_SESSION['personal_data']['hobbies'])) ? 'checked' : ''; ?>>
                          <span class="custom-checkbox"></span> 
                          Dancing
                        </label>
                        </div>
                        <div class="check__box check__two">
                          <label>
                            <input type="checkbox" class="input" name = "hobbies[]" value = "Drawing"
                            <?php echo (isset($_SESSION['personal_data']['hobbies']) && is_array($_SESSION['personal_data']['hobbies']) && in_array('Drawing', $_SESSION['personal_data']['hobbies'])) ? 'checked' : ''; ?>>
                            <span class="custom-checkbox"></span>
                            Drawing
                          </label>
                        </div>
                    </div>
                    <div class="check__container">
                      <div class="check__box check__one">
                        <label>
                          <input type="checkbox" class="input" name = "hobbies[]" value = "Singing"
                          <?php echo (isset($_SESSION['personal_data']['hobbies']) && is_array($_SESSION['personal_data']['hobbies']) && in_array('Singing', $_SESSION['personal_data']['hobbies'])) ? 'checked' : ''; ?>>
                          <span class="custom-checkbox"></span>
                          Singing
                        </label>
                      </div>
                      <div class="check__box check__two">
                        <label>
                          <input type="checkbox" class="input" name = "hobbies[]" value = "Playing"
                          <?php echo (isset($_SESSION['personal_data']['hobbies']) && is_array($_SESSION['personal_data']['hobbies']) && in_array('Playing', $_SESSION['personal_data']['hobbies'])) ? 'checked' : ''; ?>>
                          <span class="custom-checkbox"></span>
                          Playing
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="check__box check__other">
                  <label> 
                    <input type="checkbox" class="input" name="hobbies[]" value="Others:"
                      <?php echo (isset($_SESSION['personal_data']['hobbies']) && is_array($_SESSION['personal_data']['hobbies']) && in_array('Others:', $_SESSION['personal_data']['hobbies'])) ? 'checked' : ''; ?> 
                      onclick="toggleOtherHobbies(this)">
                    <span class="custom-checkbox"></span>
                    Others:
                  </label>
                </div>
                <div class="input__group">
                  <input type="text" name="other_hobbies" class="input input__name other__hobbies" placeholder="Other Hobbies" value="<?php echo $_SESSION['personal_data']['other_hobbies'] ?? ''; ?>" id="otherHobbiesInput" disabled>
                </div>
              </div>
            </div>
            <div class="button__fields">
            <button type="submit" name = "clear" class="clear__input__btn">Clear</button>
              <button type = "submit" name = "reg_submit" class="primary__btn__solid reg__submit">
                  Next  
              </button>
            </div>
          </form>
        </div>
      </section>
      <div class="btn__div container">
        <button class="primary__btn__solid">
          <a href="displayInfo.php">
            Display Information
          </a>
        </button>
      </div>
    </main>
  </body>
  </html>