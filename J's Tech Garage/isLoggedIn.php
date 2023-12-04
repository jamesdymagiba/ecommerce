<?php

session_start();

// Check if the user is already logged in
if (isset($_SESSION['user'])) {
    header('Location: index.php'); // Redirect to the dashboard or home page
    exit();
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include the database connection file
    include 'database.php';
    
    // Retrieve user input from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check user credentials
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user) {
        if ($password == $user["password"]) {
            $_SESSION["user"] = $user["userid"]; // Use the user's unique identifier
            header("Location: index.php"); // Redirect to the home page after a successful login
            exit;
        } else {
            echo '<script>alert("Invalid Password");</script>';
        }
    } else {
        echo '<script>alert("Invalid Email");</script>';
    }

    // Close the database connection
    mysqli_close($conn);
}

?>