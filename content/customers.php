<?php
require_once "../config/database.php";
require_once "../utils/helpers.php";

$customersTable = selectCustomers($connection);

function selectCustomers($connection) {
    $customersTable = [];
    $selectCustomers = mysqli_prepare($connection, "SELECT * FROM customers");
    if (mysqli_stmt_execute($selectCustomers)) {
        $selectCustomersResult = mysqli_stmt_get_result($selectCustomers);
        
        if (mysqli_num_rows($selectCustomersResult) > 0) {
            while($customerRow = mysqli_fetch_assoc($selectCustomersResult)) {
                $customerRow["full_name"] = getFullname($customerRow["first_name"], $customerRow["middle_name"], $customerRow["last_name"], $customerRow["suffix"]);
                $customersTable[] = $customerRow;
            }
        }
    }
    
    return $customersTable;
}