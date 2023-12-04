<?php

function loginUser($conn, $email, $password) {
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user) {
        if ($password == $user["password"]) {
            $_SESSION["user"] = $user["userid"];
            redirectUser($user["usertype"]);
            exit;
        } else {
            return "Password is incorrect";
        }
    } else {
        return "Email is incorrect";
    }
}

function redirectUser($userType) {
    switch ($userType) {
        case 'admin':
            header("Location: admin.php");
            exit;
        case 'staff':
            header("Location: staff.php");
            exit;
    }
}
?>