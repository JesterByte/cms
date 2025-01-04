<?php
include_once "../includes/session.php";
include_once "../includes/functions.php";

$_SESSION = array();
session_destroy();
redirect("../view/sign-in.php");