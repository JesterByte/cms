<?php
require_once "../config/database.php";
require_once "../utils/helpers.php";

$burialRecordsTable = selectBurialRecords($connection);

function selectBurialRecords($connection){
    $burialRecordsTable = [];
    $selectBurialRecords = mysqli_prepare($connection, "SELECT * FROM deceased");
    if (mysqli_stmt_execute($selectBurialRecords)) {
        $selectBurialRecordsResult = mysqli_stmt_get_result($selectBurialRecords);

        if (mysqli_num_rows($selectBurialRecordsResult) > 0) {
            while($burialRow = mysqli_fetch_assoc($selectBurialRecordsResult)) {
                $burialRow["full_name"] = getFullname($burialRow["first_name"], $burialRow["middle_name"], $burialRow["last_name"], $burialRow["suffix"]);
                $burialRecordsTable[] = $burialRow;
            }
        } 
    }

    return $burialRecordsTable;
}