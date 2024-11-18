<?php
include_once 'db.php';

$currentDate = date('Y-m-d');
$threeMonthsAgo = date('Y-m-d', strtotime('-3 months'));

$couriersQuery = "SELECT id, name FROM couriers";
$stmt = $pdo->prepare($couriersQuery);
$stmt->execute();
$couriers = $stmt->fetchAll(PDO::FETCH_ASSOC);

$regionsQuery = "SELECT id, name, duration_days FROM regions";
$stmt = $pdo->prepare($regionsQuery);
$stmt->execute();
$regions = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($couriers as $courier) {
    $currentDepartureDate = $threeMonthsAgo;

    while (strtotime($currentDepartureDate) < strtotime($currentDate)) {
        $downtime = rand(1, 5);// дни отдыха
        $nextDepartureDate = date('Y-m-d', strtotime("+$downtime days", strtotime($currentDepartureDate)));

        $randomRegion = $regions[array_rand($regions)];

        $durationDays = $randomRegion['duration_days'];

        $arrivalDate = date('Y-m-d', strtotime("+$durationDays days", strtotime($nextDepartureDate)));

        $insertTripQuery = "INSERT INTO trips (region_id, courier_id, departure_date, arrival_date) 
                            VALUES (:region_id, :courier_id, :departure_date, :arrival_date)";
        $stmt = $pdo->prepare($insertTripQuery);
        $stmt->execute([
            'region_id' => $randomRegion['id'],
            'courier_id' => $courier['id'],
            'departure_date' => $nextDepartureDate,
            'arrival_date' => $arrivalDate,
        ]);

        $currentDepartureDate = $arrivalDate;
    }
}

echo "Данные успешно добавлены.";
?>
