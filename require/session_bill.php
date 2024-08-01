<?php
session_start(); // Начинаем сессию

 // Проверяем, была ли отправлена форма
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $_SESSION["count_of_days"] = $_POST["count_of_days"];
          $_SESSION["selected_country"] = $_POST["country"];
          if (isset($_POST["service"]) && is_array($_POST["service"])) {
             // Преобразуем массив выбранных сервисов в строку и сохраняем его в сессию
             $_SESSION["selected_services"] = $_POST["service"];
         }
       if(isset($_POST['next_button'])) {
          header("Location: basket.php");
          exit; }
 
       if(isset($_POST['back_button'])) {
          header("Location: order.php");
          exit; } 
       }         
?>