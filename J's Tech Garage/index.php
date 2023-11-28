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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    

    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="index.php"><img src="images/biglogonobg.png" width="125px"></a>
            </div>
            <nav>
                <ul>
                <?php
                    // Check if the user has the "admin" usertype
                    if ($user['usertype'] === 'admin') {
                        echo '<li><a href="admin.php">Admin</a></li>';
                    }
                    ?>
                    <?php
                    // Check if the user has the "staff" usertype
                    if ($user['usertype'] === 'staff') {
                        echo '<li><a href="staff.php">Staff</a></li>';
                    }
                    ?>
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
        <div class="row">
            <div class="column1">
                <h1>We sell Parts and do Services for your Motorcycle!</h1>
                <p>No matter how difficult it gets, never stop going the distance. </p>
                <br><br>
                <a href="#locate-button">
                <button class="locate-button">Locate Us!</button>
                </a>
            </div> 

                <div class="slideshow-container">
                    <div class="mySlides fade">
                        <div class="numbertext">1 / 17</div>
                        <img src="images/motors/aerox-blackraven-s.png">
                        <div class="text">Yamaha MIO Aerox S</div>
                        
                    </div>

                    <div class="mySlides fade">
                        <div class="numbertext">2 / 17</div>
                        <img src="images/motors/aerox-removebg-preview.png">
                        <div class="text">Yamaha MIO Aerox 155</div>
                    </div>
        
                    <div class="mySlides fade">
                        <div class="numbertext">3 / 17</div>
                        <img src="images/motors/Fazzio-White.png" >
                        <div class="text">Yamaha MIO Fazzio</div>
                    </div>
        
                    <div class="mySlides fade">
                        <div class="numbertext">4 / 17</div>
                        <img src="images/motors/Yamaha-Mio-Gear-Offwhite.png">
                        <div class="text">Yamaha MIO Gear</div>
                    </div>
        
                    <div class="mySlides fade">
                        <div class="numbertext">5 / 17</div>
                        <img src="images/motors/Yamaha-Mio-Gear-S-matte-black.png">
                        <div class="text">Yamaha MIO Gear S</div>
                    </div>
        
                    <div class="mySlides fade">
                        <div class="numbertext">6 / 17</div>
                        <img src="images/motors/mio gravis-matte-red.png">
                        <div class="text">Yamaha MIO Gravis</div>
                    </div>
        
                    <div class="mySlides fade">
                        <div class="numbertext">7 / 17</div>
                        <img src="images/motors/yamaha-mio-gravis 23 YM-matte-black.png">
                        <div class="text">Yamaha MIO Gravis 23 YM</div>
                    </div>
        
                    <div class="mySlides fade">
                        <div class="numbertext">8 / 17</div>
                        <img src="images/motors/mio_i125-removebg-preview.png">
                        <div class="text">Yamaha MIO i125</div>
                    </div>
        
                    <div class="mySlides fade">
                        <div class="numbertext">9 / 17</div>
                        <img src="images/motors/mio i125s matte-black-1.png">
                        <div class="text">Yamaha MIO i125s</div>
                    </div>
        
                    <div class="mySlides fade">
                        <div class="numbertext">10 / 17</div>
                        <img src="images/motors/mio soul i125s-matte-black.png">
                        <div class="text">Yamaha MIO Soul i125s</div>
                    </div>
        
                    <div class="mySlides fade">
                        <div class="numbertext">11 / 17</div>
                        <img src="images/motors/Yamaha Mio Sporty Casual Edition.png">
                        <div class="text">Yamaha MIO Sporty (Casual Edition)</div>
                    </div>
        
                    <div class="mySlides fade">
                        <div class="numbertext">12 / 17</div>
                        <img src="images/motors/mio-sporty-matte-black.png">
                        <div class="text">Yamaha MIO Sporty (Matte Bold Edition)</div>
                    </div>
        
                    <div class="mySlides fade">
                        <div class="numbertext">13 / 17</div>
                        <img src="images/motors/barako-removebg-preview.png">
                        <div class="text">Kawasaki Barako</div>
                    </div>
        
                    <div class="mySlides fade">
                        <div class="numbertext">14 / 17</div>
                        <img src="images/motors/nmax-removebg-preview.png">
                        <div class="text">Yamaha NMAX</div>
                    </div>
        
                    <div class="mySlides fade">
                        <div class="numbertext">15 / 17</div>
                        <img src="images/motors/tmx-removebg-preview.png">
                        <div class="text">Honda TMX</div>
                    </div>
        
                    <div class="mySlides fade">
                        <div class="numbertext">16 / 17</div>
                        <img src="images/motors/wave_125-removebg-preview.png">
                        <div class="text">Honda Wave 125</div>
                    </div>

                    <div class="mySlides fade">
                        <div class="numbertext">17 / 17</div>
                        <img src="images/motors/hondaclick-removebg-preview.png">
                        <div class="text">Honda Click 125</div>
                    </div>


                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>

            </div>
                    <br>
                    <div class="dot-container">
                        <span class="dot" onclick="currentSlide(1)"></span>
                        <span class="dot" onclick="currentSlide(2)"></span>
                        <span class="dot" onclick="currentSlide(3)"></span>
                        <span class="dot" onclick="currentSlide(4)"></span>
                        <span class="dot" onclick="currentSlide(5)"></span>
                        <span class="dot" onclick="currentSlide(6)"></span>
                        <span class="dot" onclick="currentSlide(7)"></span>
                        <span class="dot" onclick="currentSlide(8)"></span>
                        <span class="dot" onclick="currentSlide(9)"></span>
                        <span class="dot" onclick="currentSlide(10)"></span>
                        <span class="dot" onclick="currentSlide(11)"></span>
                        <span class="dot" onclick="currentSlide(12)"></span>
                        <span class="dot" onclick="currentSlide(13)"></span>
                        <span class="dot" onclick="currentSlide(14)"></span>
                        <span class="dot" onclick="currentSlide(15)"></span>
                        <span class="dot" onclick="currentSlide(16)"></span>
                        <span class="dot" onclick="currentSlide(17)"></span>
                        <section id="locate-button">
                      </div>
        </div>
            <div class="mapcontainer">
                <div class="map-info-container">
                <h3>J's Tech Garage</h3>
                <br><br>
                <p>Gov Fortunato Halili Road, San Jose del Monte City, Bulacan</p>
                <br><br>
                <p>Monday - Saturday: 8:30 AM - 6:00 PM <br>
                Sunday: Closed</p>
                <br><br>
                <p>Contact Number: 09672180298</p>
                </div>
                    <div class="map">
                            <!--section goes here-->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3857.5329482137618!2d121.051746!3d14.7953175!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397af0f65859d07%3A0x5b7e7eac7b5b9c08!2sJ&#39;s%20TechGarage!5e0!3m2!1sen!2sph!4v1699417667395!5m2!1sen!2sph" 
                    width="140%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
    
    
    <script src="script.js"></script>
    
</body>
</html>