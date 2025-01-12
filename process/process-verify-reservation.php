<?php
session_start();
require_once "../config/database.php";
require_once "../utils/autoload.php";

autoloadUtils(__DIR__ . "/../utils");

if (!empty($_POST["grave_id"]) && !empty($_POST["lot_type"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $graveId = $_POST["grave_id"];
    if (!validateGraveId($graveId)) {
        echo "Invalid grave id";
        exit;
    }

    $lotType = $_POST["lot_type"];
    if (!validateLotType($lotType)) {
        echo "Invalid lot type";
        exit;
    }

    $reservationStatus = "Active";

    updateReservation($connection, $lotType, $reservationStatus, $graveId);
}

function updateReservation($connection, $lotType, $reservationStatus, $graveId) {
    $updateReservation = mysqli_prepare($connection, "UPDATE lot_reservations SET lot_type = ?, reservation_status = ? WHERE reserved_lot = ?");
    mysqli_stmt_bind_param($updateReservation, "sss", $lotType, $reservationStatus, $graveId);
    if (mysqli_stmt_execute($updateReservation)) {
        $_SESSION["lot_reservation_updated"] = true;
        serverRedirect("../reservation-requests/?type=lot");
    } else {
        echo "Database error";
    }
}