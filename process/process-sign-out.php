<?php
session_start();
require_once "../utils/helpers.php";

signoutUser();

function signoutUser() {
    $_SESSION = [];
    session_destroy();
    
    serverRedirect("../");    
}
