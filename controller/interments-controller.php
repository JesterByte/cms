<?php
include_once "../includes/session.php";
include_once "../includes/functions.php";

checkSession();

$action = $_GET["action"] ?? "displayContent";

switch ($action) {
    case 'displayContent':
        redirect("../model/interments-model.php?action=$action");
        break;
    case 'displayInterments':
        redirect("../view/interments.php");
    // default:
    //     include_once "../view/interments.php";
    //     break
}