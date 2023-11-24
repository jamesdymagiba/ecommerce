<?php
require_once "database.php";
session_start(); // Check if there is a user session
if (!isset($_SESSION["user"])) {
    // Redirect to the login page if no user session
    header("Location: account-login.php");
    exit(); // Ensure script stops execution after redirection
}
$userid = $_SESSION["user"];

// Retrieve all users
$sql = "SELECT * FROM usertable";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error retrieving user data: " . mysqli_error($conn));
}

// Fetch all users into an array
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J's Tech Garage Shop</title>
    <link rel="stylesheet" href="admin.css">
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
            <h2>All Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Mobile Number</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Birthday</th>
                        <th>Address</th>
                        <th>User Type</th>
                        <th>Operation</th>
                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo $user['userid']; ?></td>
                            <td><?php echo $user['fname']; ?></td>
                            <td><?php echo $user['lname']; ?></td>
                            <td><?php echo $user['mnumber']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['gender']; ?></td>
                            <td><?php echo $user['birthday']; ?></td>
                            <td><?php echo $user['address']; ?></td>
                            <td><?php echo $user['usertype']; ?></td>
                            <td>
                                <button class="btn-update"><a href="">Update</a></button>
                                <form method="post" action="admin-delete.php" style="display:inline;">
                    <input type="hidden" name="userid" value="<?php echo $user['userid']; ?>">
                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                </form>
                            </td>


                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button onclick="redirectToRegister()" class="btn-add">Add User</button>
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
    
    
    <script src="admin.js"></script>
    
</body>
</html>