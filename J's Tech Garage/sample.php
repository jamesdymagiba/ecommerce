<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sample</title>
    </head>
    <body>
    <form action="sample.php" method="post">
            <?php
           if (isset($_POST["submit"])) {
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $password = $_POST["password"];
            $mnumber = $_POST["mnumber"];
            $email = $_POST["email"];
            $birthday = $_POST["birthday"];
            $errors = array();
        
            if (empty($fname) || empty($lname) || empty($password) || empty($mnumber) || empty($email) || empty($birthday)) {
                array_push($errors, "All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            if (strlen($password)<8) {
                array_push($errors,"Password must be at least 8 characters long");
            }
            if (count($errors)>0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }else {
                #insert the data into the database
            }
           }
            ?>
       <div class="forms-container">
        <h1 class="signup-h1">Sign up</h1>
            <input type="text" name="fname" placeholder="  First Name" class="signup-fname">
            <input type="text" name="lname" placeholder="  Last Name" class="signup-lname">
            <input type="password" name="password" placeholder="  Password" class="signup-password">
            <input type="number" name="mnumber" placeholder="  Mobile Number" class="signup-mnumber">
            <input type="text" name="email" placeholder="  Email" class="signup-email">

            <div class="birthday-container">
                <label for="birthday">Brithday:</label>
                <input type="date" name="birthday" id="birthday" class="signup-birthday">
            </div>

            <div class="signup-container">
                <a href="">
                    <button class="btn-signup" name="submit">Sign up</button>
                </a>
            </div>

        
       </div>
       </form>
    </body>
</html>