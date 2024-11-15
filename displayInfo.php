<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        table {
            border-collapse: collapse;
            width: 90%;
            max-width: 1000px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #7e5af0;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e6e6ff;
        }
        h1 {
            color: #7e5af0;
            text-align: center;
            margin-top: 0;
            font-size: 24px;
        }
    </style>
</head>
<body>

<?php
include 'connect_db.php';

$sql = "SELECT f_name, l_name, bday, email, mobile_num, gender, h_address, city, pin_code, r_state, country, hobbies FROM reg_tbl";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Birthdate</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>Gender</th>
                <th>Address</th>
                <th>City</th>
                <th>Pin Code</th>
                <th>State</th>
                <th>Country</th>
                <th>Hobbies</th>
            </tr>";

    // Output data for each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["f_name"] . "</td>
                <td>" . $row["l_name"] . "</td>
                <td>" . $row["bday"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["mobile_num"] . "</td>
                <td>" . $row["gender"] . "</td>
                <td>" . $row["h_address"] . "</td>
                <td>" . $row["city"] . "</td>
                <td>" . $row["pin_code"] . "</td>
                <td>" . $row["r_state"] . "</td>
                <td>" . $row["country"] . "</td>
                <td>" . $row["hobbies"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

?>

