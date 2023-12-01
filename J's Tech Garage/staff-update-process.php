<?php
require_once "database.php";

if (isset($_POST["submit"])) {
    // Check if productid is provided
    if (isset($_POST["productid"])) {
        $productid = $_POST["productid"];
        // Rest of your code for updating the product...

        // Example update logic
        $productname = $_POST["productname"];
        $productdesc = $_POST["productdesc"];
        $producttype = $_POST["producttype"];
        $productquantity = $_POST["productquantity"];
        $productprice = $_POST["productprice"];
        $productimage = $_FILES["productimage"]["name"];
        $filetmp = $_FILES["productimage"]["tmp_name"];
        $target_dir = "Upload/";
        $target_path = $target_dir . $productimage;

        move_uploaded_file($filetmp, $target_path);

        $sql = "UPDATE producttable SET productname=?, productdesc=?, producttype=?, productquantity=?, productprice=?, productimage=? WHERE productid=?";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssssi", $productname, $productdesc, $producttype, $productquantity, $productprice, $productimage, $productid);
            mysqli_stmt_execute($stmt);
            header("Location: staff.php");
        } else {
            die("Something went wrong");
        }
    } else {
        echo "Product ID not provided for update.";
    }
}
?>
