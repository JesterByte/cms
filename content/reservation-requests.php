<?php
require_once "../config/database.php";
require_once "../utils/helpers.php";

$lotReservationsTable = selectLotReservationRequests($connection);
$burialReservationsTable = selectBurialReservationRequests($connection);

function selectLotReservationRequests($connection) {
    $reservationsTable = [];
    $reservationStatus = "Pending";
    $selectReservations = mysqli_prepare($connection, "SELECT lr.*, c.first_name, c.middle_name, c.last_name, c.suffix FROM lot_reservations AS lr INNER JOIN customers AS c ON lr.reservee_id = c.customer_id WHERE lr.reservation_status = ?");
    mysqli_stmt_bind_param($selectReservations, "s", $reservationStatus);
    if (mysqli_stmt_execute($selectReservations)) {
        $selectReservationsResult = mysqli_stmt_get_result($selectReservations);
        if (mysqli_num_rows($selectReservationsResult) > 0) {
            while($reservationRow = mysqli_fetch_assoc($selectReservationsResult)) {
                $reservationRow["full_name"] = getFullname($reservationRow["first_name"], $reservationRow["middle_name"], $reservationRow["last_name"], $reservationRow["suffix"]);
                $reservationRow["formatted_reserved_lot"] = displayPhaseLocation($reservationRow["reserved_lot"]);
                $reservationRow["created_at"] = displayDateTime($reservationRow["created_at"]);
                $reservationsTable[] = $reservationRow;
            }
        }
    }

    return $reservationsTable;
}

function selectBurialReservationRequests($connection) {
    $reservationsTable = [];
    $reservationStatus = "Pending";
    $selectReservations = mysqli_prepare($connection, "SELECT lr.*, c.first_name, c.middle_name, c.last_name, c.suffix FROM burial_reservations AS lr INNER JOIN customers AS c ON lr.reservee_id = c.customer_id WHERE lr.reservation_status = ?");
    mysqli_stmt_bind_param($selectReservations, "s", $reservationStatus);
    if (mysqli_stmt_execute($selectReservations)) {
        $selectReservationsResult = mysqli_stmt_get_result($selectReservations);
        if (mysqli_num_rows($selectReservationsResult) > 0) {
            while($reservationRow = mysqli_fetch_assoc($selectReservationsResult)) {
                $reservationRow["full_name"] = getFullname($reservationRow["first_name"], $reservationRow["middle_name"], $reservationRow["last_name"], $reservationRow["suffix"]);
                $reservationRow["formatted_burial_lot"] = displayPhaseLocation($reservationRow["reserved_lot"]);
                $reservationRow["created_at"] = displayDateTime($reservationRow["created_at"]);
                $reservationsTable[] = $reservationRow;
            }
        }
    }

    return $reservationsTable;
}