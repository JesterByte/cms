<?php
require_once "../config/database.php";
require_once "../utils/autoload.php";

autoloadUtils(__DIR__ . "/../utils");

if (isset($_GET["lot_id"])) {
    $lotId = decodeUrlParameter($_GET["lot_id"]);
    if (!validateLotId($lotId)) {
        serverRedirect("../reservation-requests/");
    }

    $reservationCoordinates = selectReservationCoordinates($connection, $lotId);
}

function selectReservationCoordinates($connection, $lotId) {
    $reservationRow = "";
    $selectReservationCoordinates = mysqli_prepare($connection, "SELECT latitude_start, longitude_start, latitude_end, longitude_end FROM cemetery_lots WHERE lot_id = ? LIMIT 1");
    mysqli_stmt_bind_param($selectReservationCoordinates, "s", $lotId);
    if (mysqli_stmt_execute($selectReservationCoordinates)) {
        $selectReservationCoordinatesResult = mysqli_stmt_get_result($selectReservationCoordinates);
        if (mysqli_num_rows($selectReservationCoordinatesResult) > 0) {
            $reservationRow = mysqli_fetch_assoc($selectReservationCoordinatesResult);
        }
    }

    return $reservationRow;
}