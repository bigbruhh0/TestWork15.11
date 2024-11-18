<?php
include_once '../db.php';

$departureDate = isset($_GET['departure_date']) ? $_GET['departure_date'] : null;
$arrivalDate = isset($_GET['arrival_date']) ? $_GET['arrival_date'] : null;

$query = "SELECT trips.id, regions.name AS region, couriers.name AS courier, trips.departure_date, trips.arrival_date
          FROM trips
          JOIN regions ON trips.region_id = regions.id
          JOIN couriers ON trips.courier_id = couriers.id";

$conditions = [];
$params = [];

if ($departureDate) {
    $conditions[] = "trips.departure_date = ?";
    $params[] = $departureDate;
}

if ($arrivalDate) {
    $conditions[] = "trips.arrival_date = ?";
    $params[] = $arrivalDate;
}

if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($data);
