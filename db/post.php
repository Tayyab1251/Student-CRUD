<?php
    $addBtn = $_POST['addStudent']; // Use null coalescing operator

    if (isset($addBtn)) {
        // echo 'Button is clicked';
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $phone = $_POST['phone'];

        $error = '';

        if (empty($firstName)) {
            $error = 'Please enter first name';
            echo $error;
        } elseif (empty($lastName)) {
            $error = 'Please enter last name';
            echo $error;
        } elseif (empty($phone)) {
            $error = 'Please enter phone';
            echo $error;
        }elseif(!empty($error)){
            echo $error;
        } 
        else{
            // echo 'Data is valid ! ';
                // Inserting data
                include 'db-config.php';

                $sql = "INSERT INTO `students` (`firstName`, `lastName`, `cell`) VALUES ('{$firstName}', '{$lastName}', {$phone})";

                if (mysqli_query($connection, $sql)) {
                    // echo "New record created successfully";
                    header("Refresh: 0; url=../index.php");
                    //echo '<p>You will be redirected in 5 seconds.</p>';
                    exit;

                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
                }
        }
    } else {
        echo 'Bruh something shitty happened....';
    }
