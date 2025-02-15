<?php
// Connect to Database
include("../database/connection.php"); // Adjust this path if needed

header('Content-Type: application/json'); // Ensure JSON output

$query = "SELECT id, name FROM regions"; // Adjust table name if needed
$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(["error" => mysqli_error($conn)]); // Show SQL error
    exit();
}

$regions = [];
while ($row = mysqli_fetch_assoc($result)) {
    $regions[] = $row;
}

echo json_encode($regions);
?>
