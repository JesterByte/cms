<?php 
include_once "../includes/session.php";
include_once "../includes/functions.php";

if (isset($_POST["submit-button"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $username = sanitizeUsername($_POST["username"]);
    if (!validateUsername($username)) {
        $_SESSION["invalid_sign_in"] = true;
        redirect("../index.php");
    }

    $password = $_POST["password"];
    // $password = sanitizePassword($_POST["password"]);

    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;
    redirect("../model/sign-in-model.php");
}

if (isset($_SESSION["user_id"])) {
    redirect("../view/dashboard.php");
} else {
    redirect("../index.php");
}

if (isset($_SESSION["invalid_sign_in"])) {
    redirect("../index.php");
}