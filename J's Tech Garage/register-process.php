<?php
if (isset($_POST["submit"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $gender = $_POST["gender"];
    $password = $_POST["password"];
    $mnumber = $_POST["mnumber"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];
    $address = $_POST["address"];
    $filename = $_FILES["filename"]["name"];
    $filetmp = $_FILES["filename"]["tmp_name"];
    $target_dir = "Upload/"; 
    $target_path = $target_dir . $filename;

    move_uploaded_file($filetmp, $target_path);

    $errors = array();

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
    }
    if (strlen($mnumber) !== 11) {
        array_push($errors, "Mobile number must be 11 digits");
    }

    require_once "database.php";
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $result =  mysqli_query($conn,$sql);
    $rowCount = mysqli_num_rows($result);

    if ($rowCount > 0) {
        array_push($errors, "Email already registered");
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='error-msg'>$error</div>";
        }
    } else {
        $usertype = 'user';  // Add this line for the usertype
        $sql = "INSERT INTO usertable (fname, lname, gender, password, mnumber, email, birthday, address, filename, usertype) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssssssss", $fname, $lname, $gender, $password, $mnumber, $email, $birthday, $address, $filename, $usertype);
            mysqli_stmt_execute($stmt);
            echo "<div class='success-msg'>Registered Sucessfuly.</div>";
        } else {
            die("Something went wrong");
        }
    }
}
?>