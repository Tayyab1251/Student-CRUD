<?php include '../view/header.php'; ?>
<h3 class="title fw-bold py-4">Edit Student Record</h3>

<?php
include 'db-config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($id) {
    $query = "SELECT * FROM `students` WHERE id = $id";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
        if (!$row) {
            echo "Record not found.";
            exit;
        }
    } else {
        echo "Error in query: " . mysqli_error($connection);
        exit;
    }
} else {
    echo "No ID specified.";
    exit;
}


?>
<!-- Form -->

<form action="update.php?id=<?php echo $id; ?>" method="POST" >
    <!-- onsubmit="alert('Form is being submitted!');" -->
    <div class="modal-body">
        <!-- Form for getting user data -->
        <div class="mb-3">
            <label for="firstName" class="form-label">First Name :</label>
            <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo $row['firstName'];?>">
        </div>
        <div class="mb-3">
            <label for="lastName" class="form-label">Last Name :</label>
            <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo $row['lastName'];?>">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone :</label>
            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $row['cell'];?>">
        </div>
    </div>
    <input type="submit" name="update" class="btn btn-primary" value="Update">
</form>

<?php include '../view/footer.php'; ?>
