<?php

    $host = 'localhost';
    $db   = 'sample_db';
    $user = 'sampleUser';
    $pass = 'samplePassword';

    $conn = mysqli_connect($host, $user, $pass, $db);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    else {
        $fullName = $_POST['fullName'];
        $emailAddress = $_POST['emailAddress'];
        $mobileNumber = $_POST['mobileNumber'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        
        mysqli_query($conn, "INSERT INTO tbl_sample (fullName, emailAddress, mobileNumber, dateOfBirth, age, gender) VALUES ('$fullName', '$emailAddress', '$mobileNumber', '$dateOfBirth', '$age', '$gender')");

        $em = "Data Added Successfully!";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
        exit();
    }

?>