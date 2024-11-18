<?php
require '../db.php';

$sql = "SELECT id, name FROM couriers ORDER BY name";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$couriers = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($couriers);
