<?php
include_once "../includes/session.php";
include_once "../includes/functions.php";

checkSession();

$action = $_GET["action"] ?? "displayContent";

switch ($action) {
    case 'displayContent':
        redirect("../model/payments-model.php?action=$action");
        break;
    case 'displayPayments':
        redirect("../view/payments.php");
}