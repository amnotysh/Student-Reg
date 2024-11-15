<?php
    $localhost = "localhost:8111";
    $user = "root";
    $pass = "";

    $connection = mysqli_connect($localhost, $user, $pass);

    if ( !$connection ) {
    die('Could not connect' . mysqli_connect_error());
    }

    //Create database
    $creating = mysqli_query( $connection, 'CREATE DATABASE IF NOT EXISTS stu_reg_db');
        
    //Select Database
    $selectDb = mysqli_select_db($connection, 'stu_reg_db');
?>