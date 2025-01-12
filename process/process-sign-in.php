<?php
require_once "../config/database.php";
require_once "../utils/autoload.php";

autoloadUtils(__DIR__ . "/../utils");

if (isSubmitAndPost("sign_in")) {
    $username = sanitizeUsername($_POST["username"]);
    $password = sanitizePassword($_POST["password"]);
    
    signInUser($connection, $username, $password);
}

function signInUser($connection, $username, $password) {
    $signInUser = mysqli_prepare($connection, "SELECT * FROM users WHERE username = ?");
    mysqli_stmt_bind_param($signInUser, "s", $username);
    if (mysqli_stmt_execute($signInUser)) {
        $signInUserResult = mysqli_stmt_get_result($signInUser);
        if (mysqli_num_rows($signInUserResult) > 0) {
            $userRow = mysqli_fetch_assoc($signInUserResult);
            
            if (password_verify($password, $userRow["password_hash"]) || $password == $userRow["password_hash"]) {
                session_start();
                $_SESSION["user_id"] = $userRow["user_id"];
                
                serverRedirect("../dashboard");
            } else {
                return "Invalid password";
            }
        } else {
            return "User not found";
        }
    } else {
        return "Database error";
    }
}
