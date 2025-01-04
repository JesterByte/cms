<?php
include_once "../includes/session.php";
include_once "../includes/functions.php";   
include_once "../includes/database-connection.php";

$action = $_GET["action"] ?? "displayContent";

switch ($action) {
    case 'displayContent':
        displayContent();
        break;
}

function displayContent() {
    $connection = connectToDatabase();

    $selectPayments = mysqli_prepare($connection, "SELECT * FROM payments INNER JOIN users ON payments.employee_id = users.user_id  ORDER BY payment_date DESC");
    if (mysqli_stmt_execute($selectPayments)) {
        $selectPaymentsResult = mysqli_stmt_get_result($selectPayments);
        $paymentsTable = [];
        if (mysqli_num_rows($selectPaymentsResult) > 0) {
            while ($paymentRow = mysqli_fetch_assoc($selectPaymentsResult)) {
                $paymentRow["processed_by"] = $paymentRow["username"] . " (" . $paymentRow["role"] . ")";
                $paymentsTable[] = $paymentRow;
            }
        }
        $_SESSION["payments_table"]  = $paymentsTable;
        redirect("../controller/payments-controller.php?action=displayPayments");
    }
}