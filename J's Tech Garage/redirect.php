<?php
function redirectUser($userType) {
    switch ($userType) {
        case 'user':
            header("Location: profile.php");
            exit;
        case 'admin':
            header("Location: admin.php");
            exit;
        case 'staff':
            header("Location: staff.php");
            exit;
        default:
            // Handle other user types or unexpected values
            break;
    }
}
?>