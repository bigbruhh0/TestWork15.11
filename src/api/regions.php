<?php
require '../db.php';

$sql = "SELECT id, name FROM regions ORDER BY name";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$regions = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($regions);
