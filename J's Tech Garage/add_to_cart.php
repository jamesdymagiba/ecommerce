<?php
require_once "database.php"; // Assuming this file contains your database connection code

$data = json_decode(file_get_contents("php://input"));
$quantityToAdd = mysqli_real_escape_string($conn, $data->quantityToAdd);
if ($data && isset($data->user, $data->productid, $data->product)) {
    $userid = mysqli_real_escape_string($conn, $data->user);
    $productid = mysqli_real_escape_string($conn, $data->productid);
    $productname = mysqli_real_escape_string($conn, $data->product->productname);
    $quantity = mysqli_real_escape_string($conn, $data->product->quantity);
    $productprice = mysqli_real_escape_string($conn, $data->product->productprice);
    
    // Check if the product is already in the cart
    $checkCartQuery = "SELECT * FROM cart WHERE userid = '$userid' AND productid = '$productid'";
    $checkCartResult = mysqli_query($conn, $checkCartQuery);

    if ($checkCartResult) {
        if (mysqli_num_rows($checkCartResult) > 0) {
            // Increment the quantity if the product is already in the cart
            $updateCartQuery = "UPDATE cart SET quantity = quantity + $quantityToAdd WHERE userid = '$userid' AND productid = '$productid'";
            $cartResult = mysqli_query($conn, $updateCartQuery);
        } else {
            // Insert the product into the cart
            $insertCartQuery = "INSERT INTO cart (userid, productid, productname, quantity, productprice) VALUES ('$userid', '$productid', '$productname', '$quantityToAdd', '$productprice')";
            $cartResult = mysqli_query($conn, $insertCartQuery);
        }

        if (!$cartResult) {
            // Handle the error appropriately
            echo "Error updating/inserting into the cart: " . mysqli_error($conn);
        } else {
            echo "Product added to cart successfully.";
        }
    } else {
        // Handle the error appropriately
        echo "Error checking the cart: " . mysqli_error($conn);
    }
} else {
    // Handle invalid data format
    echo "Invalid data format.";
}

// Close the database connection
mysqli_close($conn);
?>
