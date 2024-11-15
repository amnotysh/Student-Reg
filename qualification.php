<?php
session_start();
include 'qualification_tbl.php';
include 'insert.php';

if (!isset($_SESSION['qualification_data'])) {
  $_SESSION['qualification_data'] = [
      'board_class_x' => '',
      'percentage_class_x' => '',
      'year_class_x' => '',
      'board_class_xii' => '',
      'percentage_class_xii' => '',
      'year_class_xii' => '',
      'board_graduation' => '',
      'percentage_graduation' => '',
      'year_graduation' => '',
      'board_masters' => '',
      'percentage_masters' => '',
      'year_masters' => '',
      'course_applied' => ''
  ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['back'])) {
      // Store form data in session variables
      $_SESSION['qualification_data'] = [
          'board_class_x' => $_POST['board_class_x'] ?? '',
          'percentage_class_x' => $_POST['percentage_class_x'] ?? '',
          'year_class_x' => $_POST['year_class_x'] ?? '',
          'board_class_xii' => $_POST['board_class_xii'] ?? '',
          'percentage_class_xii' => $_POST['percentage_class_xii'] ?? '',
          'year_class_xii' => $_POST['year_class_xii'] ?? '',
          'board_graduation' => $_POST['board_graduation'] ?? '',
          'percentage_graduation' => $_POST['percentage_graduation'] ?? '',
          'year_graduation' => $_POST['year_graduation'] ?? '',
          'board_masters' => $_POST['board_masters'] ?? '',
          'percentage_masters' => $_POST['percentage_masters'] ?? '',
          'year_masters' => $_POST['year_masters'] ?? '',
          'course_applied' => $_POST['course_applied'] ?? ''
      ];
      header('Location: index.php');
  }
  if (isset($_POST['clear'])) {
    // Unset personal_data session variable
    unset($_SESSION['qualification_data']);
    header('Location: qualification.php');
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qualification Form</title>
    <!-- montserrat font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- hind font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/default.css">
    <link rel="stylesheet" href="styles/utility.css">
    <link rel="stylesheet" href="styles/form.css">
    <script src="js/main.js"></script>
</head>
<body>
  <main class="container">
  <div class="qualification__container">
    <div class="upper__content">
      <img src="assets/images/logo.png" alt="" class="logo">
      <h1>Qualification Form</h1>
    </div>
    <div class="form__container">
    <form action = "" method = "POST">
        <table border="1" cellpadding="10" cellspacing="0" align="center">
            <thead>
                <tr>
                    <th>Sl. No. of Examination</th>
                    <th>Board</th>
                    <th>Percentage</th>
                    <th>Year of Passing</th>
                </tr>
            </thead>
            <tbody>
                <tr class="spaceUnder">
                    <td>1. Class X</td>
                    <td><input type="text" name="board_class_x" placeholder="Board Name" class="qual__input" required
                        value="<?php echo $_SESSION['qualification_data']['board_class_x'] ?? ''; ?>"></td>
                    <td><input type="number" name="percentage_class_x" placeholder="%" min = "0" max="100" maxlength = "3" oninput="if (this.value > 100) this.value = 100;" class ="qual__input" required 
                        value="<?php echo $_SESSION['qualification_data']['percentage_class_x'] ?? ''; ?>"></td>
                    <td><input type="text" name="year_class_x" placeholder="yyyy" maxlength="4" class="qual__input" required
                        value="<?php echo $_SESSION['qualification_data']['year_class_x'] ?? ''; ?>"></td>
                </tr>
                <tr class="spaceUnder">
                    <td>2. Class XII</td>
                    <td><input type="text" name="board_class_xii" placeholder="Board Name" class="qual__input" requried
                        value="<?php echo $_SESSION['qualification_data']['board_class_xii'] ?? ''; ?>"></td>
                    <td><input type="number" name="percentage_class_xii" placeholder="%" min="0" max="100" maxlength = "3" oninput="if (this.value > 100) this.value = 100;" class="qual__input" required
                        value="<?php echo $_SESSION['qualification_data']['percentage_class_xii'] ?? ''; ?>"></td>
                    <td><input type="text" name="year_class_xii" placeholder="yyyy" maxlength="4" class="qual__input" required
                        value="<?php echo $_SESSION['qualification_data']['year_class_xii'] ?? ''; ?>"></td>
                </tr>
                <tr class="spaceUnder">
                    <td>3. Graduation</td>
                    <td><input type="text" name="board_graduation" placeholder="Board Name" class="qual__input"
                        value="<?php echo $_SESSION['qualification_data']['board_graduation'] ?? ''; ?>"></td>
                    <td><input type="number" name="percentage_graduation" placeholder="%" min="0" max="100" maxlength = "3" oninput="if (this.value > 100) this.value = 100;" class="qual__input"
                        value="<?php echo $_SESSION['qualification_data']['percentage_graduation'] ?? ''; ?>"></td>
                    <td><input type="text" name="year_graduation" placeholder="yyyy" maxlength="4" class="qual__input"
                        value="<?php echo $_SESSION['qualification_data']['year_graduation'] ?? ''; ?>"></td>
                </tr>
                <tr class="spaceUnder">
                    <td>4. Masters</td>
                    <td><input type="text" name="board_masters" placeholder="Board Name" class="qual__input"
                        value="<?php echo $_SESSION['qualification_data']['board_masters'] ?? ''; ?>"></td>
                    <td><input type="number" name="percentage_masters" placeholder="%" min="0" max="100" maxlength = "3" oninput="if (this.value > 100) this.value = 100;" class="qual__input"
                        value="<?php echo $_SESSION['qualification_data']['percentage_masters'] ?? ''; ?>"></td>
                    <td><input type="text" name="year_masters" placeholder="yyyy" maxlength="4" class="qual__input"
                        value="<?php echo $_SESSION['qualification_data']['year_masters'] ?? ''; ?>"></td>
                </tr>
            </tbody>
        </table>
        <div class="input__group">
          <label class="label">Course Applied For</label>
          <select class="input input__course" name="course_applied" required>
            <option value="">Select Course</option>
            <option value="BS Civil Engineering" <?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Civil Engineering' ? 'selected' : ''; ?>>BS Civil Engineering</option>
            <option value="BS Mechanical Engineering" <?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Mechanical Engineering' ? 'selected' : ''; ?>>BS Mechanical Engineering</option>
            <option value="BS Electrical Engineering"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Electrical Engineering' ? 'selected' : ''; ?>>BS Electrical Engineering</option>
            <option value="BS Electronics Engineering"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Electronics Engineering' ? 'selected' : ''; ?>>BS Electronics Engineering</option>

            <option value="BS Computer Engineering"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Computer Engineering' ? 'selected' : ''; ?>>BS Computer Engineering</option>
            <option value="BS Industrial Engineering"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Industrial Engineering' ? 'selected' : ''; ?>>BS Industrial Engineering</option>
            <option value="BS Mechatronics Engineering"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Mechatronics Engineering' ? 'selected' : ''; ?>>BS Mechatronics Engineering</option>
            <option value="BS Architecture"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Architecture' ? 'selected' : ''; ?>>BS Architecture</option>

            <option value="BS Information Technology"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Information Technology' ? 'selected' : ''; ?>>BS Information Technology</option>
            <option value="BS Accountancy"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Accountancy' ? 'selected' : ''; ?>>BS Accountancy</option>
            <option value="BS Entrepreneurship"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Entrepreneurship' ? 'selected' : ''; ?>>BS Entrepreneurship</option>
            <option value="BS Business Administration"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Business Administration' ? 'selected' : ''; ?>>BS Business Administration</option>

            <option value="BS Office Administration"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Office Administration' ? 'selected' : ''; ?>>BS Office Administration</option>
            <option value="BS Psychology"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Psychology' ? 'selected' : ''; ?>>BS Psychology</option>
            <option value="BS Astronomy"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Astronomy' ? 'selected' : ''; ?>>BS Astronomy</option>
            <option value="BS Statistics"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Statistics' ? 'selected' : ''; ?>>BS Statistics</option>

            <option value="BS Biology"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BSB' ? 'selected' : ''; ?>>BS Biology</option>
            <option value="BS Political Science"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Political Science' ? 'selected' : ''; ?>>BS Political Science</option>
            <option value="BS Education"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Education' ? 'selected' : ''; ?>>BS Education</option>
            <option value="BS Technical Vocational"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BS Technical Vocational' ? 'selected' : ''; ?>>BS Technical Vocational</option>
            <option value="BS Physical Education"<?php echo $_SESSION['qualification_data']['course_applied'] == 'BSPE ' ? 'selected' : ''; ?>>BS Physical Education</option>
          </select>
        </div>
        <div class="button__fields">
        <button type="submit" name = "back" onclick = "window.location.href = 'index.php'" class = "primary__btn__solid white back__btn">
              Back  
            </button>
            <button type="submit" name = "clear" class="clear__input__btn" onclick=clearInputField()>Clear</button>
          <button class="primary__btn__solid white" type="submit" name = "insert">Submit</button>
        </div>
    </form>
    </div>
  </div>
  </main>
</body>
</html>