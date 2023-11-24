<?php
require_once "database.php";
session_start(); // Check if there is a user session
if (!isset($_SESSION["user"])) {
    // Redirect to the login page if no user session
    header("Location: account-login.php");
    exit(); // Ensure script stops execution after redirection
}
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
        
        <div class="forms-container">
        <form action="admin-register.php" method="post" enctype="multipart/form-data" class="form-container">
        <h1 class="signup-h1">Add User</h1>
            <input type="text" name="fname" required placeholder="  First Name" class="signup-fname">
            <input type="text" name="lname" required placeholder="  Last Name" class="signup-lname">

            <div class="radio-container">
                <label for="gender">Gender:</label>
                <div class="male-container">
                <input type="radio" name="gender" required value="Male"><label for="male">Male</label>
                </div>
                <div class="female-container">
                <input type="radio" name="gender" required value="female"><label for="female">Female</label>
                </div>
            </div>

            <input type="password" name="password" required placeholder="  Password" class="signup-password">
            <input type="number" name="mnumber" required placeholder="  Mobile Number" class="signup-mnumber">
            <input type="text" name="email" required  placeholder="  Email" class="signup-email">

            <div class="birthday-container">
                <label for="birthday">Birthday:</label>
                <input type="date" required name="birthday" id="birthday" class="signup-birthday">
            </div>
            <input type="text" name="address" required placeholder="  Address" class="signup-address">
            <input type="file" name="filename" id="filename" required>

            <div class="signup-container">
                
                
                <a href="">
                    <button id="signup" class="btn-signup" name="submit">Add User</button>
                </a>
            </div>
            <?php include("register-process.php"); ?>
         
            </form>

            <div class="back-container">
            <a href="admin.php">
                <button id="goback" class="btn-goback">Go Back</button>
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
    
    
    <script src="admin-register.js"></script>
    
</body>
</html>