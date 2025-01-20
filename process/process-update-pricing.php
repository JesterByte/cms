<?php
session_start();
require_once "../config/database.php";
require_once "../utils/autoload.php";

autoloadUtils(__DIR__ . "/../utils");

if (isSubmitAndPost("update_phase_pricing"))  {
    $phase = sanitizeInput($_POST["phase"]);
    $lotType = sanitizeInput($_POST["lot_type"]);
    $newPrice = sanitizeInput($_POST["new_phase_price"]);

    if (validatePhase($phase) && validateLotType($lotType) && validatePrice($newPrice)) {
        updatePhasePricing($connection, $phase, $lotType, $newPrice);
    } else {
        echo "Invalid input";
    }
} else if (isSubmitAndPost("update_estate_pricing"))  {
    $estate = sanitizeInput($_POST["estate"]);
    $newPrice = sanitizeInput($_POST["new_estate_price"]);

    if (validateEstate($estate) && validatePrice($newPrice)) {
        updateEstatePricing($connection, $estate, $newPrice);
    } else {
        echo "Invalid input";
    }
}

function updateEstatePricing($connection, $estate, $newPrice) {
    $vat = 0.12;
    $mcf = 80000;

    $cashSaleDiscount = 0.1;
    $sixMonthsDiscount = 0.05;

    $installmentDownPaymentRate = 0.2;

    // $oneYearInterest = 0;
    $twoYearInterest = 0.1;
    $threeYearInterest = 0.15;
    $fourYearInterest = 0.2;
    $fiveYearInterest = 0.25; 

    // Calculate total purchase price with 12% VAT and 10,000 MCF
    $totalPurchasePrice = ($newPrice + ($newPrice * $vat)) + $mcf;
    $totalPurchasePrice = round($totalPurchasePrice, 2);

    // Calculate other amounts based on the new price
    $cashSale = $totalPurchasePrice - ($totalPurchasePrice * $cashSaleDiscount);
    $cashSale = round($cashSale, 2) + 8000;

    $sixMonths = $totalPurchasePrice - ($totalPurchasePrice * $sixMonthsDiscount);
    $sixMonths = round($sixMonths, 2) + 4000;

    $installmentDownPayment = $totalPurchasePrice * $installmentDownPaymentRate;
    $installmentDownPayment = round($installmentDownPayment, 2) + 64000;

    $balance = $totalPurchasePrice - $installmentDownPayment;
    $balance = round($balance, 2);

    $monthlyAmortization1yr = $balance / 12;
    $monthlyAmortization1yr = round($monthlyAmortization1yr, 2);

    $monthlyAmortization2yrs = ($balance * (1 + $twoYearInterest)) / 24;
    $monthlyAmortization2yrs = round($monthlyAmortization2yrs, 2);

    $monthlyAmortization3yrs = ($balance * (1 + $threeYearInterest)) / 36;
    $monthlyAmortization3yrs = round($monthlyAmortization3yrs, 2);

    $monthlyAmortization4yrs = ($balance * (1 + $fourYearInterest)) / 48;
    $monthlyAmortization4yrs = round($monthlyAmortization4yrs, 2);

    $monthlyAmortization5yrs = ($balance * (1 + $fiveYearInterest)) / 60;
    $monthlyAmortization5yrs = round($monthlyAmortization5yrs, 2);

    $updateEstatePricing = mysqli_prepare($connection, 
        "UPDATE estate_price_list 
        SET 
        lot_price = ?, 
        total_purchase_price = ?, 
        cash_sale_10_discount = ?, 
        6_months_5_discount = ?, 
        down_payment_20 = ?,
        balance = ?,
        monthly_amortization_1yr = ?,
        monthly_amortization_2yrs_10_interest = ?,
        monthly_amortization_3yrs_15_interest = ?,
        monthly_amortization_4yrs_20_interest = ?,
        monthly_amortization_5yrs_25_interest = ?
        WHERE estate = ?");

    mysqli_stmt_bind_param($updateEstatePricing,"ddddddddddds",
        $newPrice,
        $totalPurchasePrice,
        $cashSale,
        $sixMonths,
        $installmentDownPayment,
        $balance,
        $monthlyAmortization1yr,
        $monthlyAmortization2yrs,
        $monthlyAmortization3yrs,
        $monthlyAmortization4yrs,
        $monthlyAmortization5yrs,
        $estate
    );

    if (mysqli_stmt_execute($updateEstatePricing)) {
        $_SESSION["estate_price_updated"] = true;
        serverRedirect("../estate/");
    } else {
        echo "Database error";
    }
}

function updatePhasePricing($connection, $phase, $lotType, $newPrice) {
    $vat = 0.12;
    $mcf = 10000;

    $cashSaleDiscount = 0.1;
    $sixMonthsDiscount = 0.05;

    $installmentDownPaymentRate = 0.2;

    // $oneYearInterest = 0;
    $twoYearInterest = 0.1;
    $threeYearInterest = 0.15;
    $fourYearInterest = 0.2;
    $fiveYearInterest = 0.25; 

    // Calculate total purchase price with 12% VAT and 10,000 MCF
    $totalPurchasePrice = ($newPrice + ($newPrice * $vat)) + $mcf;
    $totalPurchasePrice = round($totalPurchasePrice, 2);

    // Calculate other amounts based on the new price
    $cashSale = $totalPurchasePrice - ($totalPurchasePrice * $cashSaleDiscount);
    $cashSale = round($cashSale, 2) + 1000;

    $sixMonths = $totalPurchasePrice - ($totalPurchasePrice * $sixMonthsDiscount);
    $sixMonths = round($sixMonths, 2) + 500;

    $installmentDownPayment = $totalPurchasePrice * $installmentDownPaymentRate;
    $installmentDownPayment = round($installmentDownPayment, 2) + 8000;

    $balance = $totalPurchasePrice - $installmentDownPayment;
    $balance = round($balance, 2);

    $monthlyAmortization1yr = $balance / 12;
    $monthlyAmortization1yr = round($monthlyAmortization1yr, 2);

    $monthlyAmortization2yrs = ($balance * (1 + $twoYearInterest)) / 24;
    $monthlyAmortization2yrs = round($monthlyAmortization2yrs, 2);

    $monthlyAmortization3yrs = ($balance * (1 + $threeYearInterest)) / 36;
    $monthlyAmortization3yrs = round($monthlyAmortization3yrs, 2);

    $monthlyAmortization4yrs = ($balance * (1 + $fourYearInterest)) / 48;
    $monthlyAmortization4yrs = round($monthlyAmortization4yrs, 2);

    $monthlyAmortization5yrs = ($balance * (1 + $fiveYearInterest)) / 60;
    $monthlyAmortization5yrs = round($monthlyAmortization5yrs, 2);

    $updatePhasePricing = mysqli_prepare($connection, 
        "UPDATE phase_price_list 
        SET 
        lot_price = ?, 
        total_purchase_price = ?, 
        cash_sale_10_discount = ?, 
        6_months_5_discount = ?, 
        down_payment_20 = ?,
        balance = ?,
        monthly_amortization_1yr = ?,
        monthly_amortization_2yrs_10_interest = ?,
        monthly_amortization_3yrs_15_interest = ?,
        monthly_amortization_4yrs_20_interest = ?,
        monthly_amortization_5yrs_25_interest = ?
        WHERE phase = ? AND lot_type = ?");

    mysqli_stmt_bind_param($updatePhasePricing,"dddddddddddss",
        $newPrice,
        $totalPurchasePrice,
        $cashSale,
        $sixMonths,
        $installmentDownPayment,
        $balance,
        $monthlyAmortization1yr,
        $monthlyAmortization2yrs,
        $monthlyAmortization3yrs,
        $monthlyAmortization4yrs,
        $monthlyAmortization5yrs,
        $phase,
        $lotType
    );

    if (mysqli_stmt_execute($updatePhasePricing)) {
        $_SESSION["phase_price_updated"] = true;
        serverRedirect("../phase/");
    } else {
        echo "Database error";
    }
}