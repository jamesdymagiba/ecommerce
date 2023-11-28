<?php
require_once "database.php";
session_start();

// Check if there is a user session
if (!isset($_SESSION["user"])) {
    // Redirect to the login page if no user session
    header("Location: account-login.php");
    exit(); // Ensure script stops execution after redirection
}

$userid = $_SESSION["user"];

// Retrieve information of the currently logged-in user
$sqlUser = "SELECT * FROM usertable WHERE userid = $userid";
$resultUser = mysqli_query($conn, $sqlUser);

if (!$resultUser) {
    die("Error retrieving user data: " . mysqli_error($conn));
}

// Fetch the user information
$user = mysqli_fetch_assoc($resultUser);

// Retrieve all products
$sqlProducts = "SELECT * FROM producttable";
$resultProducts = mysqli_query($conn, $sqlProducts);

if (!$resultProducts) {
    die("Error retrieving product data: " . mysqli_error($conn));
}

// Fetch all products into an array
$products = mysqli_fetch_all($resultProducts, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J's Tech Garage Shop</title>
    <link rel="stylesheet" href="staff.css">
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
                    <li><img src="images/icons/user.png" onclick="toggleMenu()"></li>
                    <div class="sub-menu-container" id="subMenu">
                        <div class="sub-menu">
                            <div class="user-info">
                                <?php
                                $userid = $_SESSION["user"];

                                // Retrieve information of the currently logged-in user
                                $sql = "SELECT * FROM usertable WHERE userid = $userid";
                                $result = mysqli_query($conn, $sql);
                                
                                if (!$result) {
                                    die("Error retrieving user data: " . mysqli_error($conn));
                                }
                                
                                // Fetch the user information
                                $user = mysqli_fetch_assoc($result);
                                ?>
                            <img src="Upload/<?php echo $user['filename']; ?>">
                            <div class="fname-container">
                            <?php echo isset($user["fname"]) ? $user["fname"] : ''; ?>
                            </div>
                            <div class="lname-container">
                            <?php echo isset($user["lname"]) ? $user["lname"] : ''; ?>
                            </div>
                            </div>
                            
                            <hr>

                            <a href="profile.php" class="sub-menu-link">
                                <img src="images/icons/user.png">
                                <p>Update Profile</p>
                                <span>></span>
                            </a><a href="logout.php" class="sub-menu-link">
                                <img src="images/icons/logout.png">
                                <p>Logout</p>
                                <span>></span>
                            </a>

                        </div>
                    </div>
                    <li> <a href="cart.php"><img src="images/icons/shopping-cart.png" class="cart"></a></li>
                </ul>
            </nav>
        </div>

        <div class="table-container">
            <h2>All Products</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th class="product-desc-class">Product Description</th>
                        <th>Product Type</th>
                        <th>Product Price</th>
                        <th>Product Image</th>
                        <!-- Add more columns as needed -->
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td><?php echo $product['productid']; ?></td>
                            <td><?php echo $product['productname']; ?></td>
                            <td><?php echo $product['productdesc']; ?></td>
                            <td><?php echo $product['producttype']; ?></td>
                            <td><?php echo $product['productprice']; ?></td>
                            <td><img src="Upload/<?php echo $product['productimage']; ?>" alt="Product Image" width="50px"></td>
                            <!-- Add more columns as needed -->
                            <td class="btn-class">
                                <!-- Add any operation buttons or links as needed -->
                                <div class="operation-btn-container">
                                <button class="btn-update"><a href="">Update</a></button>
                                <form method="post" action="product-delete.php">
                                    <input type="hidden" name="productid" value="<?php echo $product['productid']; ?>">
                                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                                </div>
                                
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button onclick="redirectToRegister()" class="btn-add">Add Product</button>
        </div>

        <div class="footer">
            <div class="footer-about">
                <img src="images/biglogonobg.png">
                <p>J's Tech Garage was formed and built in 2005 out of <br>
                    Leslie Sineneng's passion and hobby for motorcycles. <br>
                    Today, it is one of the most famous places for motor <br>
                     parts and services. </p>
            </div>
            <div class="footer-contacts">
                    <h3>Contacts</h3>
                    <br>
                    <h5>Facebook:</h5> 
                    <a href="https://www.facebook.com/profile.php?id=100063721553694" target="_blank">J's Tech Garage</a>
                    <br><br>
                    <h5>Contact Number:</h5> 
                    <p>09672180298</p>
                    <br>
                    <p>© 2023 J's Tech Garage</p>
            </div>
            <div class="footer-students">
                    <h3>About</h3>
                    <br>
                    <p>This website is a school project made by students in <br>
                    Bulacan State University Sarmiento Campus.</p>
            </div>
        </div>
    </div>

    <script src="staff.js"></script>
</body>
</html>