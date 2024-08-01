<?php
// Ваши переменные для количества взрослых и детей
session_start();
require_once('../require/config.php');
require_once('../require/index_auth.php');
require_once('../require/session_vars.php');


// Массив с данными для чекбоксов типов отдыха
$relax_types = [
  'Гостиница',
  'База отдыха',
  'Санаторий'
];

$conn = new mysqli($host, $user, $password, $db);
$sql = "SELECT Состав FROM типы_питания";
$result = $conn->query($sql);

// Инициализация массива для хранения типов питания
$food_types = array();
// Проверка наличия данных и их добавление в массив
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $food_types[] = $row['Состав'];
    }
}

$sql = "SELECT Наименование FROM услуги";
$result = $conn->query($sql);
// Инициализация массива для хранения типов питания
$services = array();

// Проверка наличия данных и их добавление в массив
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $services[] = $row['Наименование'];
    }
}

// Массив с данными для чекбоксов бюджета
$budgets = [
  'До 2 000 ₽',
  '2 000 - 4 000 ₽',
  '4 000 - 6 000 ₽',
  'Более 6 000 ₽',
  'Любая стоимость'
];

$ratings = [
  '5 звёзд',
  'От 4 звёзд',
  'От 3 звёзд',
  'Любая оценка'
];

if(isset($_POST['selected_hotel'])) {
  $_SESSION['selected_hotel'] = $_POST['selected_hotel'];
  
  header("Location: hotel.php");
  exit;
} 

?>