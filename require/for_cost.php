<?php
session_start();
$arrivalDate = strtotime($_SESSION['arrivalDate']); 
$departureDate = strtotime($_SESSION['departureDate']); 

// Разница в секундах между датами
$timeDiff = $departureDate - $arrivalDate;

// Количество целых дней в разнице времени
$days = ceil($timeDiff / (60 * 60 * 24));

$cost=0;

$ServicesCost = 0; // Переменная для хранения общей стоимости выбранных услуг

$servicesWithCost = $_SESSION['servicesWithCost'];

foreach ($_SESSION['service'] as $selectedService) {
 
    // Проверяем, существует ли выбранная услуга в массиве стоимостей
    if (isset($servicesWithCost[$selectedService])) {
        $serviceCost = $servicesWithCost[$selectedService];
        // Вы можете использовать $serviceCost для дальнейших операций, если это необходимо
        $ServicesCost += $serviceCost; // Добавляем стоимость текущей услуги к общей стоимости
    }
}

$foodCost=$_SESSION['chosen_food_cost']*$days;
$costOfRoom=$room['Стоимость_номера']*$days;

$cost = $costOfRoom + $foodCost + $ServicesCost;
?>