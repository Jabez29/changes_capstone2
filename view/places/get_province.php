<?php
include '../includes/config.php';

$region_id = $_GET['region_id'];
$sql = "SELECT id, name FROM provinces WHERE region_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$region_id]);
$provinces = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($provinces);
?>
