<?php
require '../db.php';


$data = json_decode(file_get_contents('php://input'), true);

$region_id = $data['region_id'];
$courier_id = $data['courier_id'];
$departure_date = $data['departure_date'];


$sql = "SELECT duration_days FROM regions WHERE id = :region_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['region_id' => $region_id]);

$duration = $stmt->fetchColumn();
$arrival_date = date('Y-m-d', strtotime("+$duration days", strtotime($departure_date)));


$sql = "SELECT MIN(departure_date) 
        FROM trips 
        WHERE courier_id = :courier_id 
        AND departure_date < :arrival_date 
        AND departure_date > :departure_date";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'courier_id' => $courier_id, 
    'departure_date' => $departure_date,
    'arrival_date' => $arrival_date
]);

$conflicts = $stmt->fetchColumn();

if ($conflicts > 0) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Курьер не успеет вернуться с заказа.',
        'conflictDate' => $conflicts
    ]);
    exit;
}

$sql = "SELECT MAX(arrival_date) FROM trips 
        WHERE courier_id = :courier_id 
        AND departure_date <= :departure_date 
        AND arrival_date >= :departure_date";
$stmt = $pdo->prepare($sql);
$stmt->execute(['courier_id' => $courier_id, 'departure_date' => $departure_date]);

$lastArrival = $stmt->fetchColumn();

if ($lastArrival) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Курьер занят в указанное время.',
        'available_from' => date('Y-m-d', strtotime('+1 day', strtotime($lastArrival)))
    ]);
    exit;
}



$sql = "INSERT INTO trips (region_id, courier_id, departure_date, arrival_date) 
        VALUES (:region_id, :courier_id, :departure_date, :arrival_date)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
        'region_id' => $region_id,
        'courier_id' => $courier_id,
        'departure_date' => $departure_date,
        'arrival_date' => $arrival_date
        ]);

// Отправляем успешный ответ
http_response_code(201);
echo json_encode([
    'success' => true,
    'arrival_date' => $arrival_date
]);
