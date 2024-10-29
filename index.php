<!-- Loading our Footer -->
<?php include './view/header.php';
?>


<div class="container my-2 d-flex justify-content-between">
    <h3 class="title text- fw-bold">All Students</h3>
    <button class="btn btn-danger fw-bold" data-bs-toggle="modal" data-bs-target="#openModal">Add Students</button>
</div>

<!-- Table -->
<div class="row">
    <div class="col">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-danger">ID</th>
                    <th scope="col" class="text-danger">First Name</th>
                    <th scope="col" class="text-danger">Last Name</th>
                    <th scope="col" class="text-danger">Phone</th>
                    <th scope="col" class="text-danger">Edit</th>
                    <th scope="col" class="text-danger">Delete</th>

                </tr>
            </thead>
            <tbody>
                <!-- Loading db-config -->

                <?php include './db/db-config.php'; ?>

                <?php
                if (!$connection) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                // Query to fetch data
                $sql = "SELECT * FROM `students`";
                $result = mysqli_query($connection, $sql);

                if (!$result) {
                    die("Failed to fetch...");
                } else {
                    $counter = 1;
                    // format phone number
                    function formatPhoneNumber($number) {

                        $number = preg_replace('/\D/', '', $number);

                        if (strlen($number) !== 11) {
                            // $message = '<script>"Number length should be 11 digits"</scipt>';
                            // return $message;
                            return "Invalid number format. Please provide an 11-digit number.";
                        }
                    
                        // Format the number as (0300) 123-456
                        $formattedNumber = "(" . substr($number, 0, 4) . ") " . substr($number, 4, 3) . "-" . substr($number, 7);
                    
                        return $formattedNumber;
                    }

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td scope="row">' . $counter++ . '</td>';
                        echo '<td scope="row">' . $row['firstName'] . '</td>';
                        echo '<td scope="row">' . $row['lastName'] . '</td>';
                        // echo '<td scope="row">' . $row['cell'] . '</td>';
                        echo '<td scope="row">' . formatPhoneNumber($row['cell']) . '</td>';
                        echo '<td scope="row"><a href="./db/edit.php?id=' . $row['id'] . '"class="btn btn-primary fw-bold">Edit</a></td>';
                        echo "<td scope='row'><a href='./db/delete.php?id=" . $row['id'] . "' class='btn btn-danger fw-bold' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a></td>";
                        // echo '</tr>';
                    }
                }

                mysqli_close($connection);
                ?>
            </tbody>
        </table>
        <!-- Show Error message here -->
         <!-- Created by Your Name - GitHub: https://github.com/Tayyab1251 -->
    </div>
</div>
<!-- Modal -->
<form action="./db/post.php" method="POST">
    <div class="modal fade" id="openModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Student Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for getting user data -->
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name :</label>
                        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Enter your first name">
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name :</label>
                        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Enter your last name">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone :</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter your phone">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <input type="submit" name="addStudent" class="btn btn-primary" value="Add">
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Loading our Footer -->
<?php include './view/footer.php'; ?>