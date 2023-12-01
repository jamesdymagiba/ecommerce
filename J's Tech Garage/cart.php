<?php
require_once "database.php";
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: account-login.php");
    exit();
}

$userid = $_SESSION["user"];

$sqlUser = "SELECT * FROM usertable WHERE userid = $userid";
$resultUser = mysqli_query($conn, $sqlUser);

if ($resultUser) {
    $user = mysqli_fetch_assoc($resultUser);
} else {
    die("Error retrieving user data: " . mysqli_error($conn));
}

// Fetch the cart from the database
$sqlCart = "SELECT * FROM cart WHERE userid = $userid";
$resultCart = mysqli_query($conn, $sqlCart);

if ($resultCart) {
    $cart = mysqli_fetch_all($resultCart, MYSQLI_ASSOC);
} else {
    die("Error retrieving cart data: " . mysqli_error($conn));
}

// Initialize subtotal and shipping fee variables
$subtotal = 0;
$shippingFee = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J's Tech Garage Shop</title>
    <link rel="stylesheet" href="cartstyle.css">
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
                            </a>
                            <a href="logout.php" class="sub-menu-link">
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

        <div class="cart-container">
            <div class="product-text-container">
                <div class="text-container">
                    <h4>Product</h4>
                    <div class="quantity-container">
                        <h4>Price</h4>
                        <h4>Quantity</h4>
                        <h4>Total</h4>
                    </div>
                </div>
            </div>

            <div class="product-container">
                
                <div class="added-product-container">
                <?php
                // Fetch the cart from the database
                $sqlCart = "SELECT * FROM cart WHERE userid = $userid";
                $resultCart = mysqli_query($conn, $sqlCart);

                if ($resultCart) {
                    $cart = mysqli_fetch_all($resultCart, MYSQLI_ASSOC);
                    $subtotal = 0; // Initialize subtotal variable

                    foreach ($cart as $cartProduct) {
                        echo '<div class="product-item">';
                        echo '<h4>' . $cartProduct['productname'] . '</h4>';
                        $price = intval($cartProduct['productprice']);
                        $quantity = intval($cartProduct['quantity']);
                        $total = $price * $quantity;
                        
                        echo '<div class="inside-quantity-container">';
                        echo '<div class="total">₱' . $price . '</div>';
                        echo '<div class="total">' . $quantity . '</div>';
                        echo '<div class="total">₱' . $total . '</div>';
                        echo '</div>';
                        echo '</div>';

                        $subtotal += $total;
                    }
                } else {
                    die("Error retrieving cart data: " . mysqli_error($conn));
                }

                $shippingFee = count($cart) > 0 ? 100 : 0;

                echo '</div>';
                echo '</div>';
                echo '<div class="subtotal-text-container">';
                echo '<h4>Subtotal: ₱' . $subtotal . '</h4>';
                echo '</div>';
                ?>
            </div>

            <div class="checkout-container">
                <div class="cart-text-container">
                    <div class="total-text-container">
                        <h4>Shipping Fee:</h4>
                        <h4>Total:</h4>
                    </div>
                    <div class="total-price-container">
                        <h4>₱<?php echo $shippingFee; ?></h4>
                        <h4>₱<?php echo $subtotal + $shippingFee; ?></h4>
                    </div>
                </div>

                <div class="order-details-container">
                    <h4>Order Details</h4>
                    <p><strong>First Name:</strong> <?php echo $user['fname']; ?></p>
                    <p><strong>Last Name:</strong> <?php echo $user['lname']; ?></p>
                    <p><strong>Address:</strong> <?php echo $user['address']; ?></p>
                    <p><strong>Mobile Number:</strong> <?php echo $user['mnumber']; ?></p>

                    <!-- Add a checkout button -->
                    <div class="checkout-btn-container">
                    <form method="post" action="checkout.php">
                        <input type="submit" value="Checkout" name="checkout" class="checkout-btn">
                    </form>
                    </div>
                    
                </div>
            </div>

            <div class="footer">
                <div class="footer-about">
                    <img src="images/biglogonobg.png">
                    <p>J's Tech Garage was formed and built in 2005 out of Leslie Sineneng's passion and hobby for motorcycles. Today, it is one of the most famous places for motor parts and services.</p>
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
                    <p>This website is a school project made by students in Bulacan State University Sarmiento Campus.</p>
                </div>
            </div>
        </div>

        <script src="cart.js"></script>
    </body>
    </html>
