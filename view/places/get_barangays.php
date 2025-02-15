<?php
include '../includes/config.php';

$city_id = $_GET['city_id'];
$sql = "SELECT id, name FROM barangays WHERE city_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$city_id]);
$barangays = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($barangays);
?>
