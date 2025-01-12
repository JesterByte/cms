<?php
require_once "../config/database.php";
require_once "../utils/autoload.php";

autoloadUtils(__DIR__ . "/../utils");

if (isset($_GET["grave_id"])) {
    $graveId = decodeUrlParameter($_GET["grave_id"]);
    if (!validateGraveId($graveId)) {
        serverRedirect("../reservation-requests/");
    }

    $reservationCoordinates = selectReservationCoordinates($connection, $graveId);
}

function selectReservationCoordinates($connection, $graveId) {
    $reservationRow = "";
    $selectReservationCoordinates = mysqli_prepare($connection, "SELECT latitude_start, longitude_start, latitude_end, longitude_end FROM cemetery_graves WHERE grave_id = ? LIMIT 1");
    mysqli_stmt_bind_param($selectReservationCoordinates, "s", $graveId);
    if (mysqli_stmt_execute($selectReservationCoordinates)) {
        $selectReservationCoordinatesResult = mysqli_stmt_get_result($selectReservationCoordinates);
        if (mysqli_num_rows($selectReservationCoordinatesResult) > 0) {
            $reservationRow = mysqli_fetch_assoc($selectReservationCoordinatesResult);
        }
    }

    return $reservationRow;
}