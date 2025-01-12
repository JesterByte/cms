<?php
require_once "../config/database.php";

$phasePricingTable = selectPricing($connection, "phase_price_list");
$estatePricingTable = selectPricing($connection, "estate_price_list");

function selectPricing($connection, $table) {
    $pricingTable = [];
    $selectPricing = mysqli_prepare($connection, "SELECT * FROM $table");
    if (mysqli_stmt_execute($selectPricing)) {
        $selectPricingResult = mysqli_stmt_get_result($selectPricing);
        
        if (mysqli_num_rows($selectPricingResult) > 0) {
            while($pricingRow = mysqli_fetch_assoc($selectPricingResult)) {
                $pricingTable[] = $pricingRow;
            }
        }
    }

    return $pricingTable;
}
