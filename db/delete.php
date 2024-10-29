<?php 
include 'db-config.php';

if(!$connection) {
    die('Connection failed');
}
else {
    $id = $_GET['id'];
    // echo 'Bruhh delete me pls';
    $query = "DELETE FROM `students` WHERE id={$id}";

    if (mysqli_query($connection, $query)) {
    //   echo "Record deleted successfully";
    header("Refresh: 0; url=../index.php");

    } else {
      echo "Error deleting record: " . mysqli_error($connection);
    }
    
    mysqli_close($connection);

}

?>