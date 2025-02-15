<?php
include '../includes/config.php';

$province_id = $_GET['province_id'];
$sql = "SELECT id, name FROM cities WHERE province_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$province_id]);
$cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($cities);
?>
