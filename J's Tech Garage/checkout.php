<?php
require_once "database.php";
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: account-login.php");
    exit();
}

$userid = $_SESSION["user"];

// Fetch the cart from the database
$sqlCart = "SELECT * FROM cart WHERE userid = $userid";
$resultCart = mysqli_query($conn, $sqlCart);

if ($resultCart) {
    $cart = mysqli_fetch_all($resultCart, MYSQLI_ASSOC);

    // Process each item in the cart
    foreach ($cart as $cartProduct) {
        $productId = $cartProduct['productid'];
        $quantity = $cartProduct['quantity'];

        // Update product quantity in the product table
        $sqlUpdateProduct = "UPDATE producttable SET productquantity = productquantity - $quantity WHERE productid = $productId";
        mysqli_query($conn, $sqlUpdateProduct);

        // Remove item from the cart
        $sqlRemoveFromCart = "DELETE FROM cart WHERE userid = $userid AND productid = $productId";
        mysqli_query($conn, $sqlRemoveFromCart);
    }

    // Redirect to cart page
    header("Location: cart.php");
    exit();
} else {
    die("Error retrieving cart data: " . mysqli_error($conn));
}
?>
