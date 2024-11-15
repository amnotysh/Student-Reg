<?php
include 'connect_db.php';

$createTable = "CREATE TABLE IF NOT EXISTS qual_tbl ( 
                    student_id INT AUTO_INCREMENT,
                    course_applied VARCHAR(50),
                    FOREIGN KEY (student_id) REFERENCES reg_tbl (student_id));

                CREATE TABLE IF NOT EXISTS class_x_tbl (
                    board_class_x VARCHAR(50),
                    percentage_class_x DECIMAL(5,2),
                    year_class_x YEAR,
                    student_id INT AUTO_INCREMENT,
                    FOREIGN KEY (student_id) REFERENCES reg_tbl (student_id));

                CREATE TABLE IF NOT EXISTS class_xii_tbl (
                    board_class_xii VARCHAR(50),
                    percentage_class_xii DECIMAL(5,2),
                    year_class_xii YEAR,
                    student_id INT AUTO_INCREMENT,
                    FOREIGN KEY (student_id) REFERENCES reg_tbl (student_id));

                CREATE TABLE IF NOT EXISTS graduation_tbl (
                    board_graduation VARCHAR(50),
                    percentage_graduation DECIMAL(5,2),
                    year_graduation YEAR,
                    student_id INT AUTO_INCREMENT,
                    FOREIGN KEY (student_id) REFERENCES reg_tbl (student_id));

                CREATE TABLE IF NOT EXISTS masters_tbl (
                    board_masters VARCHAR(50),
                    percentage_masters DECIMAL(5,2),
                    year_masters YEAR,
                    student_id INT AUTO_INCREMENT,
                    FOREIGN KEY (student_id) REFERENCES reg_tbl (student_id))";

    mysqli_multi_query($connection, $createTable);  
?>  