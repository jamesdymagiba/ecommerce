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

        <div class="update-container">
        <form action="update-profile.php" method="post" enctype="multipart/form-data">
           
           <div class="forms-container">
           
            <h1 class="Update-h1">Update Profile Information</h1>

            <div class="name-container">
            <label for="name">Name:</label>
            <input type="text" name="fname" value="<?php echo isset($user["fname"]) ? $user["fname"] : ''; ?>" class="update-fname">
            <input type="text" name="lname" value="<?php echo isset($user["lname"]) ? $user["lname"] : ''; ?>" class="update-lname">
            </div>

            <div class="other-input-container">
            <div class="password-container">
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="  Password" class="update-password">
            </div>

            <div class="mnumber-container">
            <label for="mnumber">Mobile Number:</label>
            <input type="number" name="mnumber" value="<?php echo isset($user["mnumber"]) ? $user["mnumber"] : ''; ?>" class="update-mnumber">
            </div>

            <div class="email-container">
            <label for="email">E-Mail:</label>
            <input type="text" name="email" value="<?php echo isset($user["email"]) ? $user["email"] : ''; ?>" class="update-email">
            </div>

            <div class="birthday-container">
            <label for="birthday">Brithday:</label>
            <input type="date" required name="birthday" id="birthday" class="update-birthday" value="<?php echo isset($user["birthday"]) ? $user["birthday"] : ''; ?>">
            </div>

            <div class="address-container">
            <label for="address">Address:</label>
            <input type="text" name="address" value="<?php echo isset($user["address"]) ? $user["address"] : ''; ?>" class="update-address">
            </div>

            <div class="image-container">
            <label for="name">Image:</label>
            <input type="file" name="filename" id="filename">
            </div>
            </div>

            <div class="update-button-container">
                    <a href="">
                        <button id="update" class="btn-update" name="update">Update</button>
                    </a>

                </div>
                <?php
                if (isset($_POST["update"])) {
                    $fname = $_POST["fname"];
                    $lname = $_POST["lname"];
                    $mnumber = $_POST["mnumber"];
                    $email = $_POST["email"];
                    $birthday = $_POST["birthday"];
                    $address = $_POST["address"];

                    // Check if a file is uploaded
                    if ($_FILES["filename"]["size"] > 0) {
                        // File is uploaded
                        $filename = $_FILES["filename"]["name"];
                        $filetmp = $_FILES["filename"]["tmp_name"];
                        $target_dir = "Upload/";
                        $target_path = $target_dir . $filename;

                        move_uploaded_file($filetmp, $target_path);
                    } else {
                        // No file uploaded, keep the existing filename in the database
                        $filename = $user['filename'];
                    }

                    // Check if the password field is not empty
                    if (!empty($_POST["password"])) {
                        $password = $_POST["password"];
                        // Update user data in the database with the new password
                        $updateSql = "UPDATE usertable SET fname=?, lname=?, password=?, mnumber=?, email=?, birthday=?, address=?, filename=? WHERE userid=?";
                        $updateStmt = mysqli_prepare($conn, $updateSql);

                        if ($updateStmt) {
                            mysqli_stmt_bind_param($updateStmt, "ssssssssi", $fname, $lname, $password, $mnumber, $email, $birthday, $address, $filename, $userid);
                            mysqli_stmt_execute($updateStmt);
                            mysqli_stmt_close($updateStmt);

                            // Fetch the updated user data
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                $user = mysqli_fetch_assoc($result);
                            } else {
                                die("Error retrieving updated user data: " . mysqli_error($conn));
                            }

                            echo "<div class='success-msg'>Profile updated successfully.</div>";
                        } else {
                            echo "<div class='error-msg'>Error preparing update statement.</div>";
                        }
                    } else {
                        // Password field is empty, keep the existing password in the database
                        // Update user data in the database without changing the password
                        $updateSql = "UPDATE usertable SET fname=?, lname=?, mnumber=?, email=?, birthday=?, address=?, filename=? WHERE userid=?";
                        $updateStmt = mysqli_prepare($conn, $updateSql);

                        if ($updateStmt) {
                            mysqli_stmt_bind_param($updateStmt, "sssssssi", $fname, $lname, $mnumber, $email, $birthday, $address, $filename, $userid);
                            mysqli_stmt_execute($updateStmt);
                            mysqli_stmt_close($updateStmt);

                            // Fetch the updated user data
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                $user = mysqli_fetch_assoc($result);
                            } else {
                                die("Error retrieving updated user data: " . mysqli_error($conn));
                            }

                            echo "<div class='success-msg'>Profile updated successfully.</div>";
                        } else {
                            echo "<div class='error-msg'>Error preparing update statement.</div>";
                        }
                    }
                }
                ?>
            
           </div>
           </form>
           <div class="back-container">
           <a href="profile.php">
                <button>Go back</button>
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