<?php
if (isset($_POST["submit"])) {
    $productname = $_POST["productname"];
    $productdesc = $_POST["productdesc"];
    $producttype = $_POST["producttype"];
    $productprice = $_POST["productprice"];
    $productimage = $_FILES["productimage"]["name"];
    $filetmp = $_FILES["productimage"]["tmp_name"];
    $target_dir = "Upload/"; 
    $target_path = $target_dir . $productimage;

    move_uploaded_file($filetmp, $target_path);

    $errors = array();

    // You can add additional validation for product fields if needed

    require_once "database.php";
    $sql = "SELECT * FROM producttable WHERE productname = '$productname'";
    $result =  mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);

    if ($rowCount > 0) {
        array_push($errors, "Product with the same name already exists");
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='error-msg'>$error</div>";
        }
    } else {
        $sql = "INSERT INTO producttable (productname, productdesc, producttype, productprice, productimage) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssss", $productname, $productdesc, $producttype, $productprice, $productimage);
            mysqli_stmt_execute($stmt);
            echo "<div class='success-msg'>Product added successfully.</div>";
        } else {
            die("Something went wrong");
        }
    }
}
?>
