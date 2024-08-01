<?php
session_start();
require_once('config.php');

// ID места отеля
$hotelID = $_SESSION['selected_hotel']; 

$stmt = $connect->prepare("SELECT * FROM hotelInfo WHERE ID = :hotel_id");
$stmt->bindParam(':hotel_id', $hotelID);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);
$_SESSION['select_hotel']=$result;

// Подготавливаем вызов хранимой процедуры
$stmt = $connect->prepare("CALL getAvailableRooms(:maxOccupancy, :placeType, :arrivalDate, :departureDate)");

$maxOccupancy = 0;
// Привязываем параметры
$stmt->bindParam(':maxOccupancy', $_SESSION['maxOccupancy']);
$stmt->bindParam(':placeType', $result['Тип_отеля']);
$stmt->bindParam(':arrivalDate', $_SESSION['arrivalDate']);
$stmt->bindParam(':departureDate', $_SESSION['departureDate']);

// Выполняем запрос
$stmt->execute();

// Получаем результаты
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

 // Фильтруем результат по ID отеля
$filteredRooms = array_filter($rooms, function($room) use ($hotelID) {
    return $room['ID_Места'] == $hotelID;

});

$stmt = $connect->prepare('SELECT Фото FROM hotelInfo WHERE ID = :hotel_id');
$stmt->execute(['hotel_id' => $hotelID]);
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);


if ($result) {
    // Выводите остальные поля аналогично
} else {
    echo "Отель с указанным ID не найден";
}


$servicesInSession = isset($_SESSION['service']) ? $_SESSION['service'] : [];

// Разбиваем строку с названиями услуг на массив
$services = explode(",", $result['Услуги']);

// Для каждой услуги получаем её стоимость и сохраняем пару "услуга - стоимость" в ассоциативный массив
$servicesWithCost = [];
foreach ($services as $service) {
    $stmt = $connect->prepare("CALL getServicesCost(:hotel_id, :service_name)");
    $stmt->bindParam(':hotel_id', $hotelID);
    $stmt->bindParam(':service_name', $service); 
    $stmt->execute();
    $cost = $stmt->fetch(PDO::FETCH_COLUMN);

    // Добавляем название услуги и её стоимость в массив
    $servicesWithCost[$service] = $cost;
}

$_SESSION['servicesWithCost'] = $servicesWithCost;

?>