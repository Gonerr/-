<?php
session_start();
require_once('config.php');
// Запрос для информации об отелях через представление (объектный стиль)
$conn = new mysqli($host,$user, $password, $db);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Сохраняем данные из POST в сессии
        $_SESSION['type_of_relax'] = isset($_POST['type_of_relax']) ? $_POST['type_of_relax'] : [];
        $_SESSION['food_type'] = isset($_POST['food_type']) ? $_POST['food_type'] : [];
        $_SESSION['service'] = isset($_POST['service']) ? $_POST['service'] : [];
        $_SESSION['budget'] = isset($_POST['budget']) ? $_POST['budget'] : null;
        $_SESSION['rating'] = isset($_POST['rating']) ? $_POST['rating'] : null;
    }  

    // Получение данных из формы
    $hotels = isset($_POST['hotels']) ? $_POST['hotels'] : [];
    $type_of_relax = isset($_POST['type_of_relax']) ? $_POST['type_of_relax'] : [];
    $services = isset($_POST['service']) ? $_POST['service'] : [];
    $food_types = isset($_POST['food_type']) ? $_POST['food_type'] : [];
    $budget = isset($_POST['budget']) ? $_POST['budget'] : null;
    $rating = isset($_POST['rating']) ? $_POST['rating'] : null;


    $sql = "SELECT * FROM hotelInfo WHERE 1=1";
        // Добавление фильтров на основе данных из формы
    if (!empty($hotels)) {
        $hotels_filters = array_map(function($type) use ($conn) {
            return "'" . $conn->real_escape_string($type) . "'";
        }, $hotels);
        $sql .= " AND ID IN (" . implode(", ", $hotels_filters) . ")";
    }

    if (!empty($type_of_relax)) {
        $type_of_relax_filters = array_map(function($type) use ($conn) {
            return "'" . $conn->real_escape_string($type) . "'";
        }, $type_of_relax);
        $sql .= " AND Тип_отеля IN (" . implode(", ", $type_of_relax_filters) . ")";
    }
   
    if (!empty($services)) {
        $service_filters = array_map(function($service) use ($conn) {
            return "FIND_IN_SET('" . $conn->real_escape_string($service) . "', Услуги)";
        }, $services);
        $sql .= " AND (" . implode(" OR ", $service_filters) . ")";
    }

    if (!empty($food_types)) {
        $food_filters = array_map(function($food_type) use ($conn) {
            return "FIND_IN_SET('" . $conn->real_escape_string($food_type) . "', Тип_питания)";
        }, $food_types);
        $sql .= " AND (" . implode(" OR ", $food_filters) . ")";
    }

    if (!empty($budget)) {
        switch ($budget) {
            case 'До 2 000 ₽':
                $sql .= " AND Мин_стоимость <= 2000";
                break;
            case '2 000 - 4 000 ₽':
                $sql .= " AND Мин_стоимость BETWEEN 2000 AND 4000";
                break;
            case '4 000 - 6 000 ₽':
                $sql .= " AND Мин_стоимость BETWEEN 4000 AND 6000";
                break;
            case 'Более 6 000 ₽':
                $sql .= " AND Мин_стоимость > 6000";
                break;
            case 'Любая стоимость':
                break;
        }
    }

    if (!empty($rating)) {
        switch ($rating) {
            case '5 звёзд':
                $sql .= " AND Оценка >= 5";
                break;
            case 'От 4 звёзд':
                $sql .= " AND Оценка >= 4";
                break;
            case 'От 3 звёзд':
                $sql .= " AND Оценка >= 3";
                break;
            case 'Любая оценка':
                break;
        }
    }

$result = $conn->query($sql);


if ($result === false) {
    // // Обработка ошибки выполнения запроса
    echo "Ошибка выполнения запроса: " . $conn->error;
} else {
// Проверка результатов и вывод карточек
if ($result->num_rows > 0) {
    while ($hotel = $result->fetch_assoc()) {
        
        echo '<div class="card">';
        
        echo '<img src="../img/' . $hotel['Фото'] . '" alt="image" class="card-image"/>';
        echo '<div class="card-description">';
        echo '<div class="row-card"> ';
        echo '<div class="card-main-description">';
        echo '<div class="card-container">';
        echo '<p class="card-text">' . $hotel['Оценка'] . '</p>';
        echo '<p class="card-text1">' . ($hotel['Оценка'] >= 4.5 ? 'Очень хорошо' : ($hotel['Оценка'] >= 4 ? 'Хорошо' : ($hotel['Оценка'] >= 3 ? 'Неплохо' : 'Ещё нет оценок'))) . '</p>';
        echo '</div>';
        echo '<h4 class="card-text2">' . $hotel['Тип_отеля'] . '</h4>';
        echo '<h3 >' . $hotel['Название'] . '</h3>';
        echo '<p class="card-text4">Расстояние до водоёма: ' . $hotel['До_воды'] . '</p>';
        echo '</div>';
        echo '<div class="card-price">';
        echo '<h2 class="text-price"> От '.$hotel['Мин_стоимость'].' ₽ </h2>';
        echo '</div>';
        echo '</div>';
        echo '<div class="card-no-main-description">';
        echo '<p class="card-text5">' . $hotel['Адрес'] . '</p>';
        
        echo '<div class="card-container1">';
        if (isset($_COOKIE['auth']) && $_COOKIE['auth'] === 'true'){
            echo '<form method="post" action="" style="width:auto; height:auto; display:flex;">';
        echo '<button class="card-button" name="selected_hotel" value="'.$hotel['ID'].'" type="submit">Выбрать &gt;</button>';
        echo '</form>';}
        else{
        echo '<a href="registration.php" class="link">';
        echo '<div class="solid-button-container">';
        echo  '<button class="solid-button-button">Войти в аккаунт</button>';
        echo '</div>';
        echo '</a>';
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        echo '</div>';
       
        
    }
} else {
    echo "<p> Извините, нет доступных отелей</p>";
}
}
$conn->close();

?>