<?php
session_start();
if (!isset( $_SESSION["user"])) {
    header("Location: account-login.php"); //if user is NOT logged in, redirect the user to the login page. (!isset)
}
require_once "database.php";
?>
<?php
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
    <link rel="stylesheet" href="profile-style.css">
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
       
        <div class="profile-container">

            <div class="h1-container">
            <h1>Profile Information</h1>
            </div>

            <div class="file-container">
            <img src="Upload/<?php echo $user['filename']; ?>" alt="User Image">
            </div>
            <div class="name-container">
            <label for="name">Name:</label>
            <div class="bothname-container">
                <div class="fname-profile-container">
                <?php echo isset($user["fname"]) ? $user["fname"] : ''; ?>
                </div>
                <div class="lname-profile-container">
                <?php echo isset($user["lname"]) ? $user["lname"] : ''; ?>
                </div>
            </div>
                
            </div>

            <div class="mnumber-container">
            <label for="mnumber">Mobile Number:</label><?php echo isset($user["mnumber"]) ? $user["mnumber"] : ''; ?>
            </div>
        
            <div class="email-container">
            <label for="email">Email:</label><?php echo isset($user["email"]) ? $user["email"] : ''; ?>
            </div>

            <div class="birthday-container">
            <label for="birthday">Birthday:</label><?php echo isset($user["birthday"]) ? $user["birthday"] : ''; ?>
            </div>
        
            <div class="address-container">
            <label for="address">Address:</label>
            <div class="address-php-container">
            <?php echo isset($user["address"]) ? $user["address"] : ''; ?>
            </div>
            </div>

            <div class="update-profile-button-container">
            <a href="update-profile.php">
            <button class="update-profile-button">Update</button>
            </a>
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
    
    
    <script>
        function toggleMenu() {
  subMenu.classList.toggle("open-menu");
}
    </script>
</body>
</html>