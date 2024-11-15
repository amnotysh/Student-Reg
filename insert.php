<?php
    include 'connect_db.php';

    if (isset($_POST['insert'])) {
        //reg_tbl
        if (isset($_SESSION['personal_data'])) {
            // Retrieve personal data from session
            $f_name = $_SESSION['personal_data']['f_name'];
            $l_name = $_SESSION['personal_data']['l_name'];
            $bday = $_SESSION['personal_data']['bday'];
            $email = $_SESSION['personal_data']['email'];
            $mobile_num = $_SESSION['personal_data']['mobile_num'];
            $gender = $_SESSION['personal_data']['gender'];
            $h_address = $_SESSION['personal_data']['h_address'];
            $city = $_SESSION['personal_data']['city'];
            $pin_code = $_SESSION['personal_data']['pin_code'];
            $r_state = $_SESSION['personal_data']['r_state'];
            $country = $_SESSION['personal_data']['country'];
            $hobbiesString = implode(', ', $_SESSION['personal_data']['hobbies']); // Join array into a string
            //qual_tbl
            $course_applied = $_POST['course_applied'];
            //class_x_tbl
            $board_class_x = $_POST['board_class_x'];
            $percentage_class_x = $_POST['percentage_class_x'];
            $year_class_x = $_POST['year_class_x'];
            //class_xii_tbl
            $board_class_xii = $_POST['board_class_xii'];
            $percentage_class_xii = $_POST['percentage_class_xii'];
            $year_class_xii = $_POST['year_class_xii'];
            //graduation_tbl
            $board_graduation = $_POST['board_graduation'];
            $percentage_graduation = $_POST['percentage_graduation'];
            $year_graduation = $_POST['year_graduation'];
            //masters_tbl
            $board_masters = $_POST['board_masters'];
            $percentage_masters = $_POST['percentage_masters'];
            $year_masters = $_POST['year_masters'];

            $checkNameQuery = "SELECT * FROM reg_tbl WHERE f_name = '$f_name' AND l_name = '$l_name'";
            $checkNameResult = mysqli_query($connection, $checkNameQuery);

            if (mysqli_num_rows($checkNameResult) > 0) {
                // Combination of first and last name already exists
                $_SESSION['error_message'] = "Combination of first name and last name already exists.";
                header('Location: index.php');
                exit;
            } else {
                // Step 2: Check if email already exists
                $checkEmailQuery = "SELECT * FROM reg_tbl WHERE email = '$email'";
                $checkEmailResult = mysqli_query($connection, $checkEmailQuery);

                if (mysqli_num_rows($checkEmailResult) > 0) {
                    // Email already exists
                    $_SESSION['error_message'] = "Email already exists.";
                    header('Location: index.php');
                    exit;
                } else {
                    // Step 3: Check if mobile number already exists
                    $checkMobileQuery = "SELECT * FROM reg_tbl WHERE mobile_num = '$mobile_num'";
                    $checkMobileResult = mysqli_query($connection, $checkMobileQuery);

                    if($checkMobileResult === false){
                        die('Error executing query for mobile number'.mysqli_error($conn));
                    }

                    if (mysqli_num_rows($checkMobileResult) > 0) {
                        // Mobile number already exists
                        $_SESSION['error_message'] = "Mobile number already exists.";
                        header('Location: index.php');
                        exit;
                    }else {
    
        $insertReg = "INSERT INTO reg_tbl (f_name, l_name, bday, email, mobile_num, gender, h_address, city, pin_code, r_state, country, hobbies) 
        VALUES ('$f_name', '$l_name', '$bday', '$email', '$mobile_num', '$gender', '$h_address', '$city', '$pin_code', '$r_state', '$country' , '$hobbiesString')";

    if (mysqli_query($connection, $insertReg)) {
        $student_id = mysqli_insert_id($connection); // Get the last inserted ID
        
        $insertQual = "INSERT INTO qual_tbl (student_id, course_applied) VALUES ('$student_id', '$course_applied')";
        mysqli_query($connection, $insertQual);

        $insertClassX = "INSERT INTO class_x_tbl (student_id, board_class_x, percentage_class_x, year_class_x)
                         VALUES ('$student_id', '$board_class_x', '$percentage_class_x', '$year_class_x')";
        mysqli_query($connection, $insertClassX);

        $insertClassXii = "INSERT INTO class_xii_tbl (student_id, board_class_xii, percentage_class_xii, year_class_xii)
                           VALUES ('$student_id', '$board_class_xii', '$percentage_class_xii', '$year_class_xii')";
        mysqli_query($connection, $insertClassXii);

        $insertGraduation = "INSERT INTO graduation_tbl (student_id, board_graduation, percentage_graduation, year_graduation)
                             VALUES ('$student_id', '$board_graduation', '$percentage_graduation', '$year_graduation')";
        mysqli_query($connection, $insertGraduation);

        $insertMasters = "INSERT INTO masters_tbl (student_id, board_masters, percentage_masters, year_masters)
                          VALUES ('$student_id', '$board_masters', '$percentage_masters', '$year_masters')";
        mysqli_query($connection, $insertMasters);

        $_SESSION['success_message'] = "Data Inserted Successfully!";
        unset($_SESSION['personal_data']);
        unset($_SESSION['qualification_data']);
        header('Location:index.php');
        exit;
                    }
                }
            }
        }
    }
}
?>