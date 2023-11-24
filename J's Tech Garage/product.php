<?php
require_once "database.php";
session_start(); // Check if there is a user session
if (!isset($_SESSION["user"])) {
    // Redirect to the login page if no user session
    header("Location: account-login.php");
    exit(); // Ensure script stops execution after redirection
}
$userid = $_SESSION["user"]; 
$sql = "SELECT * FROM usertable WHERE userid = $userid"; 

$result = mysqli_query($conn, $sql);

if ($result) {
    $user = mysqli_fetch_assoc($result);
} else {
    die("Error retrieving user data: " . mysqli_error($conn));
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J's Tech Garage Shop</title>
    <link rel="stylesheet" href="productstyle.css">
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

        <div class="search-container">
            <input type="text" placeholder="  What are you looking for?" autofocus>
            <a href="" class="search-img" ><img src="images/icons/search.png"></a>
        </div>
        
        <div class="filter-container">
            <select class="filter-dd" name="filter-type" id="filter">
                <option value="" disabled selected>Filter by Type</option>
                    <option value="brake-pad">Brake Pad</option>
                    <option value="rear-shock">Rear Shock</option>
                    <option value="motor-oil">Motor Oil</option>
                    <option value="motor-oil">All Type</option>
            </select>
            
            <select class="sort-dd" name="sort-price" id="sort">
                <option value="" disabled selected>Sort by Price</option>
                    <option value="lowest-highest">Lowest-Highest</option>
                    <option value="highest-lowest">Highest-Lowest</option>
                    <option value="motor-oil">Any Price</option>
            </select>
        </div>

        <div class="product-container">

                <div class="img-container">
                    <img src="images/products/grs-throttle-cable.jpg">
                    <div class="product-name">GRS Throttle Cable</div>
                    <div class="product-price">₱1000</div>
                </div>

                <div class="img-container">
                    <img src="images/products/jvt-brake-shoe.jpg">
                    <div class="product-name">JVT Brake Shoe</div>
                    <div class="product-price">₱2000</div>
                </div>

                <div class="img-container">
                    <img src="images/products/jvt-breakpad.jpg">
                    <div class="product-name">JVT Brake Pad</div>
                    <div class="product-price">₱3000</div>
                </div>

                <div class="img-container">
                    <img src="images/products/koby-tire-selant.jpg">
                    <div class="product-name">Koby Tire Sealant</div>
                    <div class="product-price">₱4000</div>
                </div>

                <div class="img-container">
                    <img src="images/products/kryon-brake-shoe.jpg">
                    <div class="product-name">Kryon Brake Shoe</div>
                    <div class="product-price">₱5000</div>               
                 </div>

                <div class="img-container">
                    <img src="images/products/mutarru-rear-shock.jpg">
                    <div class="product-name">Mutarru Rear Shock</div>
                    <div class="product-price">₱6000</div>
                </div>

                <div class="img-container">
                    <img src="images/products/Petron-gasoline-engine-oil-blaze-racing.jpg">
                    <div class="product-name">Petron Engine Oil</div>
                </div>

                <div class="img-container">
                    <img src="images/products/shell-motor-oil.jpg">
                    <div class="product-name">Shell Motor Oil</div>
                    <div class="product-price">₱8000</div>
                 </div>

                <div class="img-container">
                    <img src="images/products/smok-rear-shock.jpg">
                    <div class="product-name">Smok Rear Shock</div>
                    <div class="product-price">₱9000</div>  
                 </div>
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
                    <a href="https://www.facebook.com/profile.php?id=100063721553694"target="_blank">J's Tech Garage</a>
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
    
    
    <script src="product.js"></script>
</body>
</html>