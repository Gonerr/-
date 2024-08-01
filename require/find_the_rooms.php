<?php
session_start();
require_once('config.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Сохраняем данные из POST в сессии
    $_SESSION['selected_type_of_journey'] = isset($_POST['locationType']) ? $_POST['locationType'] : '';
    $_SESSION['departureDate'] = isset($_POST['departureDate']) ? $_POST['departureDate'] : '';
    $_SESSION['arrivalDate'] = isset($_POST['arrivalDate']) ? $_POST['arrivalDate'] : '';

  }  

// Значения для передачи в процедуру
$maxOccupancy = isset($_POST['countOfPeople']) ? $_POST['countOfPeople'] : 1;
$_SESSION['maxOccupancy']=$maxOccupancy;
$placeType = isset($_POST['locationType']) ? $_POST['locationType'] : '';
$arrivalDate = isset($_POST['arrivalDate']) ? $_POST['arrivalDate'] : '';
$departureDate = isset($_POST['departureDate']) ? $_POST['departureDate'] : '';

// Создаем соединение с базой данных
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Подготавливаем вызов хранимой процедуры
$stmt = $connect->prepare("CALL getAvailableRooms(:maxOccupancy, :placeType, :arrivalDate, :departureDate)");

// Привязываем параметры
$stmt->bindParam(':maxOccupancy', $maxOccupancy, PDO::PARAM_INT);
$stmt->bindParam(':placeType', $placeType, PDO::PARAM_STR);
$stmt->bindParam(':arrivalDate', $arrivalDate, PDO::PARAM_STR);
$stmt->bindParam(':departureDate', $departureDate, PDO::PARAM_STR);

// Выполняем запрос
$stmt->execute();

// Получаем результаты
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($results) {
    // Собираем ID мест в массив
    $places = array();
    foreach ($results as $row) {
        $places[] = $row['ID_Места'];
    }

    // Возвращаем данные в виде JSON
    echo json_encode($places);
} else {
    // Возвращаем пустой массив в виде JSON, если результаты не найдены
    echo json_encode(array());
}
//     foreach ($results as $row) {
//         // Обрабатываем каждую строку результата
//         echo "ID Номера: " . $row['ID_Типа_номера'] . "<br>";
//         echo "ID Места: " . $row['ID_Места'] . "<br>";
//         echo "Название: " . $row['Название'] . "<br>";
//         echo "Фотография: " . $row['Фотография'] . "<br><br>";
//     }
// } else {
//     echo "No results found.";
// }
// Закрываем соединение
$pdo = null;


?>