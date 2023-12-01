<?php include "isLoggedIn.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J's Tech Garage Shop</title>
    <link rel="stylesheet" href="account-login-style.css">
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
        
        <div class="forms-container">
        <form action="account-login.php" method="post" class="input-container">
                <h1 class="login-h1">Login</h1>
                <input type="text" required placeholder="  Email" name="email" class="login-email">
                <input type="password" required placeholder="  Password" name="password" class="login-password">
                <button class="btn-login" name="login">Log in</button>
                <button class="btn-forget">Forget Password</button>
        </form>

                <div class="signup-container">
                    <a href="account-register.php">
                        <button class="btn-signup">Sign up</button>
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
    
    
    <script src="account-login-script.js"></script>
</body>
</html>