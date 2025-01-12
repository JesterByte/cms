<?php
require_once "../config/database.php";

$pendingRequests = 0;
$reservationStatus = "Pending";
$selectPendingReservations = mysqli_prepare($connection, "SELECT COUNT(*) AS total_pending_reservations FROM lot_reservations WHERE reservation_status = ?"); // Put burial_reservations later
mysqli_stmt_bind_param($selectPendingReservations, "s", $reservationStatus);
if (mysqli_stmt_execute($selectPendingReservations)) {
    $selectPendingReservationsResult = mysqli_stmt_get_result($selectPendingReservations);
    if (mysqli_num_rows($selectPendingReservationsResult) > 0) {
        $reservationsCount = mysqli_fetch_assoc($selectPendingReservationsResult);
        $pendingRequests = $reservationsCount["total_pending_reservations"];
    }
}