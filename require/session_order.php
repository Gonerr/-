<?php
session_start(); // Начинаем сессию
if(isset($_SESSION['selected_journey'])) {
    $selectedJourneyType = $_SESSION['selected_journey'];
} elseif (!empty($_POST["type_of_journey"])) { 
    $selectedJourneyType = $_POST["type_of_journey"];
}else {
    // Если тип путевки не выбран, устанавливаем первый тип путевки в качестве выбранного по умолчанию
    $selectedJourneyType = array_key_first($journeyTypes);
}


//для order.php
$warning = 'Пожалуйста, введите Ваши контактные данные перед тем, как продолжить.';
if(isset($_POST['next_button'])) {
    // Сохраняем данные в сессии
    $_SESSION['selected_journey'] = $_POST["type_of_journey"];
    $_SESSION['selected_nutrition'] = $_POST["selected_nutrition"];
    $contacts = [
        "Имя" => $_POST["Имя"],
        "Телефон" => $_POST["Телефон"],
        "Почта" => $_POST["Почта"]
    ];

    // Сохраняем контактные данные в сессию
    $_SESSION['contacts'] = $contacts;
    if ($contacts["Имя"]){
        // Перенаправляем пользователя на страницу заказа
        $warning = null;
        header("Location: bill.php");
        exit; 
    }
} 
?>