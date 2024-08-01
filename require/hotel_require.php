<?php 
session_start();
require_once('../require/hotelInfo.php');

if(!isset($_SESSION['arrivalDate']) || !isset($_SESSION['departureDate']) ||  !isset($_SESSION['maxOccupancy'])){
  header("Location: ../pages/orders.php");
  exit();
}

// Проверка, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['choose_room'])) {
  // Сохранение выбранных услуг
  $_SESSION['service'] = isset($_POST['service']) ? $_POST['service'] : [];

  // Сохранение выбранного типа питания и стоимости
  $_SESSION['chosen_food'] = isset($_POST['radio_'.$_POST['choose_room'].'']) ? $_POST['radio_'.$_POST['choose_room'].''] : []; 
  if (isset($_SESSION['chosen_food'])) {
    list($foodType, $foodCost) = explode('|', $_SESSION['chosen_food']);
    $_SESSION['chosen_food_type'] = $foodType;
    $_SESSION['chosen_food_cost'] = $foodCost;
}

  // Сохранение выбранной комнаты и стоимости
  $_SESSION['chosen_room'] = isset($_POST['choose_room']) ? $_POST['choose_room'] : '';

  // Обработка данных выбранной комнаты
  foreach ($filteredRooms as $room) {
      if ($room['ID_Типа_номера'] === $_SESSION['chosen_room']) {
          $_SESSION['room'] = $room;
          break;
      }
  }

  header("Location: bill.php");
  exit();
}
require_once('../require/hotel_require.php');
?>