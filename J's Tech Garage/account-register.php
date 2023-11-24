<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J's Tech Garage Shop</title>
    <link rel="stylesheet" href="account-register.css">
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
                    <li> <a href="account-login.php"><img src="images/icons/user.png"></a></li>
                    <li> <a href="cart.php"><img src="images/icons/shopping-cart.png" class="cart"></a></li>
                </ul>
            </nav>
        </div>

        <div class="motto-container">
            <div class="h1-container">
                <h1 class="motto-j">J's </h1> <h1 class="motto-tech">Tech Garage</h1>
            </div>
           
            <br>
                <p>No matter how difficult it gets, never stop going the distance. </p>
                <div class="slideshow-container">
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <div class="racerSlide fade">
                        <div class="numbertext">1 / 9</div>
                        <img src="images/people/racer-1.jpg">
                    </div>
                     
                    <div class="racerSlide fade">
                        <div class="numbertext">2 / 9</div>
                        <img src="images/people/racer-2.jpg">
                    </div>
                     
                    <div class="racerSlide fade">
                        <div class="numbertext">3 / 9</div>
                        <img src="images/people/racer-3.jpg">
                    </div>
                     
                    <div class="racerSlide fade">
                        <div class="numbertext">4 / 9</div>
                        <img src="images/people/racer-4.jpg">
                    </div>
                     
                    <div class="racerSlide fade">
                        <div class="numbertext">5 / 9</div>
                        <img src="images/people/racer-5.jpg">
                    </div>
                     
                    <div class="racerSlide fade">
                        <div class="numbertext">6 / 9</div>
                        <img src="images/people/racer-6.jpg">
                    </div>
                     
                    <div class="racerSlide fade">
                        <div class="numbertext">7 / 9</div>
                        <img src="images/people/racer-7.jpg">
                    </div>
                     
                    <div class="racerSlide fade">
                        <div class="numbertext">8 / 9</div>
                        <img src="images/people/racer-8.jpg">
                    </div>
                     
                    <div class="racerSlide fade">
                        <div class="numbertext">9 / 9</div>
                        <img src="images/people/racer-9.jpg">
                    </div>
                    
                   
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>

                </div>
                
        </div>

        <form action="account-register.php" method="post" enctype="multipart/form-data">
           
       <div class="forms-container">
       
        <h1 class="signup-h1">Sign up</h1>
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
                <label for="birthday">Brithday:</label>
                <input type="date" required name="birthday" id="birthday" class="signup-birthday">
            </div>
            <input type="text" name="address" required placeholder="  Address" class="signup-address">
            <input type="file" name="filename" id="filename" required>

            <div class="signup-container">
                <a href="">
                    <button id="signup" class="btn-signup" name="submit">Sign up</button>
                </a>
            </div>
            <?php include("register-process.php"); ?>
       </div>
       </form>
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
    
    
    <script src="account-login-script.js"></script>
</body>
</html>