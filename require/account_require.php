<?php
session_start();
require_once('../require/session_vars.php');
require_once('../require/config.php');

if (isset($_COOKIE['login'])) {
  $email = $_COOKIE['login'];
  $parts = explode('@', $email);

  // Берем первую часть массива, которая будет до '@'
  $username = $parts[0];
} else{
  header("Location: registration.php");
  exit; } 
  
$sql = "CALL GetBookingDetailsByEmail(:email)";
$stmt = $connect->prepare($sql);
$stmt->bindParam(':email', $_COOKIE['login'], PDO::PARAM_STR);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


  // Шаг 1: Найти ID учетной записи по логину
  $stmt = $connect->prepare("SELECT ID_Учетной_записи FROM учетные_данные WHERE Email = :email");
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $accountId = $row['ID_Учетной_записи'];

    $sql = "SELECT GetUserDetailsByID(:userID) AS user_data";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':userID', $accountId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Парсим результат
    $userData = $result['user_data'];
    if ($userData!=''){
      list($firstname, $lastname, $patronymic, $phone) = explode(', ', $userData);
    }
    else{
      $firstname="";
      $lastname="";
      $patronymic="";
      $phone="";
    }
    

    if ($_COOKIE['employeeMode']=='true'){
        $conn = new mysqli($host,$user, $password, $db);
        // для получения статистики бронирований
        $sql_bookings = "SELECT getTotalBookings() AS total_booking";
        $result_bookings = $conn->query($sql_bookings);
        $total_bookings = $result_bookings->fetch_assoc()['total_booking'];
    
        //для получения информации о популярных услугах
        $sql_services = $connect->prepare("SELECT * FROM популярные_услуги");
        $sql_services->execute();
        $result_services = $sql_services->fetchAll(PDO::FETCH_ASSOC);
    
        $sql_income = "SELECT getTotalIncome() AS total";
        $result_income = $conn->query($sql_income);
        $total_income = $result_income->fetch_assoc()['total'];
        
        // Выполнение запроса для извлечения данных сотрудника по ID_Пользователя
        $sql_employee = $connect->prepare("SELECT * FROM сотрудники с LEFT JOIN пользователи п ON п.ID_Пользователя = с.ID_Пользователя 
        LEFT JOIN базы_отдыха бо ON бо.ID_Места = с.ID_Места
        WHERE п.ID_Учетной_записи = :accountId LIMIT 1");
        $sql_employee->bindParam(':accountId', $accountId, PDO::PARAM_INT);
        $sql_employee->execute();
        $employee_data = $sql_employee->fetch(PDO::FETCH_ASSOC);
  
      }

if (isset($_POST["save_button"])){
  $_SESSION["firstname"] = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
  $_SESSION["lastname"] = isset($_POST["lastname"]) ? $_POST["lastname"] : "";
  $_SESSION["patronymic"] = isset($_POST["patronymic"]) ? $_POST["patronymic"] : "";
  $_SESSION["phone"] = isset($_POST["phone"]) ? $_POST["phone"] : "";

  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $patronymic = $_POST["patronymic"];
  $phone = $_POST["phone"];
  if ($userData!=''){
    $stmt = $connect->prepare("UPDATE пользователи SET Имя = :firstname, Фамилия = :lastname, Отчество = :patronymic, Телефон = :phone WHERE ID_Учетной_записи = :accountId LIMIT 1");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':patronymic', $patronymic);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':accountId', $accountId);
    $stmt->execute();
  }
  else{
    $sql = "INSERT INTO пользователи (Имя, Фамилия, Отчество, Телефон, ID_Учетной_записи) VALUES (:firstname,:lastname, :patronymic, :phone, :accountId)";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':patronymic', $patronymic);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':accountId', $accountId);
    $stmt->execute();
  }

  if ($_COOKIE['employeeMode']=='true'){
    if ($employee_data['Должность']!=""){
      $_SESSION["staff"] = isset($_POST["staff"]) ? $_POST["staff"] : "";
      $_SESSION["start_work"] = isset($_POST["start_work"]) ? $_POST["start_work"] : "";
      $_SESSION["work"] = isset($_POST["work"]) ? $_POST["work"] : "";
    
      $staff = $_POST["staff"];
      $start_work = $_POST["start_work"];
      $work = $_POST["work"];

      $stmt = $connect->prepare("
    UPDATE сотрудники с
    JOIN пользователи п ON п.ID_Пользователя = с.ID_Пользователя
    SET с.Должность = :staff, с.Дата_приема_на_работу = :start_work, с.ID_Места = :work
    WHERE п.ID_Учетной_записи = :accountId
    ");
    $stmt->bindParam(':staff', $staff);
    $stmt->bindParam(':start_work', $start_work);
    $stmt->bindParam(':work', $employee_data['ID_Места']);
    $stmt->bindParam(':accountId', $accountId);
    $stmt->execute();
    }
    else{


      $sql = "INSERT INTO сотрудники (Должность, Дата_приема_на_работу, ID_Места, ID_Пользователя) VALUES (:staff, :start_work, :work, :user_id)";
      $stmt = $connect->prepare($sql);
      $stmt->bindParam(':staff', $staff);
      $stmt->bindParam(':start_work', $start_work);
      $stmt->bindParam(':work', $work);
      $stmt->bindParam(':user_id',  $employee_data['ID_Пользователя']);
      $stmt->execute();
    }
  }
} 

if (isset($_POST["admin"])){
    header("Location: admin.php");
    exit; 
}


  if (isset($_POST["exit_button"])){
    setcookie('auth', '', time() - 3600, '/');
    setcookie('login', '', time() - 3600, '/');
    setcookie('adminMode', '', time() - 3600, '/');
    setcookie('employeeMode', '', time() - 3600, '/');
  
    // Очистка всех данных сессии
    session_unset();
    session_destroy();
  
    header("Location: ../index.php");
    exit; } 
?>