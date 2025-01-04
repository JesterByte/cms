<?php
include '../includes/database-connection.php';

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $sql = "INSERT INTO cemetery_graves (grave_id, latitude_start, longitude_start, latitude_end, longitude_end, status) VALUES ";
    $values = [];

    foreach ($data as $grave) {
        $values[] = sprintf(
            "('%s', %.8f, %.8f, %.8f, %.8f, '%s')",
            $grave['graveId'], $grave['latitudeStart'], $grave['longitudeStart'], $grave['latitudeEnd'], $grave['longitudeEnd'], $grave['status']
        );
    }

    $sql .= implode(", ", $values);

    if (mysqli_query($connection, $sql)) {
        echo "Graves inserted successfully!";
    } else {
        echo "Error: " . mysqli_error($connection);
    }
} else {
    echo "No data received.";
}

mysqli_close($connection);
?>
