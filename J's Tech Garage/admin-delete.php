<?php
require_once "database.php";

// Check if the user ID is provided in the POST data
if (isset($_POST['userid'])) {
    $userid = $_POST['userid'];

    // Perform the deletion in your database
    $sql = "DELETE FROM usertable WHERE userid = $userid";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error deleting user: " . mysqli_error($conn));
    }

    // Redirect back to the admin page after deletion
    header("Location: admin.php");
    exit();
} else {
    // If the user ID is not provided in the POST data, handle the error or redirect
    header("Location: admin.php");
    exit();
}
?>