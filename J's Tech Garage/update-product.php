<?php
require_once "database.php";
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: account-login.php");
    exit();
}

// Include the update process logic
include("staff-update-process.php");

// Retrieve product information for update
if (isset($_GET['productid'])) {
    $productid = $_GET['productid'];
    $sqlProduct = "SELECT * FROM producttable WHERE productid = $productid";
    $resultProduct = mysqli_query($conn, $sqlProduct);

    if ($resultProduct) {
        $productToUpdate = mysqli_fetch_assoc($resultProduct);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>J's Tech Garage Shop</title>
            <link rel="stylesheet" href="admin-register.css">
        </head>
        <body>
            <div class="container">
                <div class="navbar">
                    <div class="logo">
                        <a href="index.php"><img src="images/biglogonobg.png" width="125px"></a>
                    </div>
                    <nav>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="product.php">Products</a></li>
                            <li><img src="images/icons/user.png" onclick="toggleMenu()" class="icon-image"></li>
                            <!-- ... (your existing navbar code) ... -->
                        </ul>
                    </nav>
                </div>

                <div class="forms-container">
                    <form action="update-product.php" method="post" enctype="multipart/form-data" class="form-container">
                        <h1 class="signup-h1">Update Product</h1>
                        <input type="hidden" name="productid" value="<?php echo $productToUpdate['productid']; ?>">
                        <input type="text" name="productname" required placeholder="  Product Name" class="signup-fname" value="<?php echo $productToUpdate['productname']; ?>">
                        <input type="text" name="productdesc" required placeholder="  Product Description" class="signup-lname" value="<?php echo $productToUpdate['productdesc']; ?>">
                        <input type="text" name="producttype" required placeholder="  Product Type" class="signup-password" value="<?php echo $productToUpdate['producttype']; ?>">
                        <input type="text" name="productquantity" required placeholder="  Product Quantity" class="signup-password" value="<?php echo $productToUpdate['productquantity']; ?>">
                        <input type="number" name="productprice" required placeholder="  Product Price" class="signup-mnumber" value="<?php echo $productToUpdate['productprice']; ?>">
                        <input type="file" name="productimage" id="productimage">

                        <div class="signup-container">
                            <button id="update" class="btn-signup" name="submit">Update Product</button>
                        </div>
                    </form>

                    <div class="back-container">
                        <a href="staff.php">
                            <button id="goback" class="btn-goback">Go Back</button>
                        </a>
                    </div>
                </div>

                <div class="footer">
                    <!-- ... (your existing footer code) ... -->
                </div>
            </div>

            <script src="admin-register.js"></script>
        </body>
        </html>
        <?php
    } else {
        echo "Error retrieving product data: " . mysqli_error($conn);
    }
} else {
    echo "Product ID not provided for update.";
}
?>
