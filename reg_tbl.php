J<?php
include 'connect_db.php';

$sql = "CREATE TABLE IF NOT EXISTS reg_tbl(
    student_id INT PRIMARY KEY AUTO_INCREMENT,
    f_name VARCHAR(30), 
    l_name VARCHAR(30), 
    bday DATE,  
    email VARCHAR(50), 
    mobile_num VARCHAR(11), 
    gender ENUM('Male','Female'), 
    h_address VARCHAR(50), 
    city VARCHAR(30), 
    pin_code VARCHAR(6), 
    r_state VARCHAR(30), 
    country VARCHAR(30) DEFAULT 'Philippines',
    hobbies VARCHAR(100)
)";

$createTable = mysqli_query($connection, $sql);
?>