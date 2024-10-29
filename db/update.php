<?php
include 'db-config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;

    // Check if form values are set
    $firstName = $_POST['firstName'] ?? null;
    $lastName = $_POST['lastName'] ?? null;
    $phone = $_POST['phone'] ?? null;

    // Check for a valid connection

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($id && $firstName && $lastName && $phone) {
        // Update query with `SET` clause
        $update_query = "UPDATE students SET firstName='$firstName', lastName='$lastName', cell='$phone' WHERE id=$id";

        if (mysqli_query($connection, $update_query)) {
            // echo "Record updated successfully";
            header("Refresh: 0; url=../index.php");
            exit;

        } else {
            echo "Error updating record: " . mysqli_error($connection);
        }
    } else {
        echo "Invalid data or missing fields.";
        var_dump($_POST);
        var_dump($id);

    }
}
mysqli_close($connection);
?>
