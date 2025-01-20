<?php
session_start();
require_once "../config/database.php";
require_once "../utils/autoload.php";

autoloadUtils(__DIR__ . "/../utils");

if (!empty($_POST["lot_id"]) && !empty($_POST["lot_type"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $lotId = $_POST["lot_id"];
    if (!validateLotId($lotId)) {
        echo "Invalid lot id";
        exit;
    }

    $lotType = $_POST["lot_type"];
    if (!validateLotType($lotType)) {
        echo "Invalid lot type";
        exit;
    }

    $reservationStatus = "Verified";

    updateReservation($connection, $lotType, $reservationStatus, $lotId);
}

function updateReservation($connection, $lotType, $reservationStatus, $lotId) {
    $updateReservation = mysqli_prepare($connection, "UPDATE lot_reservations SET lot_type = ?, reservation_status = ? WHERE reserved_lot = ?");
    mysqli_stmt_bind_param($updateReservation, "sss", $lotType, $reservationStatus, $lotId);
    if (mysqli_stmt_execute($updateReservation)) {
        $_SESSION["lot_reservation_updated"] = true;
        serverRedirect("../reservation-requests/?type=lot");
    } else {
        echo "Database error";
    }
}