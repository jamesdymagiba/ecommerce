<?php
require_once "database.php";

// Check if the product ID is provided in the POST data
if (isset($_POST['productid'])) {
    $productid = $_POST['productid'];

    // Perform the deletion in your database
    $sql = "DELETE FROM producttable WHERE productid = $productid";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error deleting product: " . mysqli_error($conn));
    }

    // Redirect back to the admin page after deletion
    header("Location: staff.php");
    exit();
} else {
    // If the product ID is not provided in the POST data, handle the error or redirect
    header("Location: staff.php");
    exit();
}
?>
