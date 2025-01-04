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

    $selectInterments = mysqli_prepare($connection, "SELECT * FROM interments ORDER BY date_of_interment DESC");
    if (mysqli_stmt_execute($selectInterments)) {
        $selectIntermentsResult = mysqli_stmt_get_result($selectInterments);
        $intermentsTable = [];
        if (mysqli_num_rows($selectIntermentsResult) > 0) {
            while ($intermentRow = mysqli_fetch_assoc($selectIntermentsResult)) {
                $intermentsTable[] = $intermentRow;
            }
        }
        $_SESSION["interments_table"]  = $intermentsTable;
        redirect("../controller/interments-controller.php?action=displayInterments");
    }
}