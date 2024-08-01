<?php 
session_start();
require_once('../require/config.php');
if(isset($_SESSION['room'])){
  $room=$_SESSION['room'];
  
  if(isset($_SESSION['select_hotel'])){
    $hotel=$_SESSION['select_hotel'];

    $_SESSION['bookings'][] = array(
      'hotel' => $hotel,
      'room' => $room
    );
  }
}
require_once('../require/for_cost.php');


if(isset($_POST['booking_the_room'])){ //и отправляем сообщение на почту
    $_SESSION['lastname_input']=$_POST['lastname_input'];
    $_SESSION['firstname_input']=$_POST['firstname_input'];
    $_SESSION['phone_input']=$_POST['phone_input'];
  $_SESSION['isExistOrder']=true;

  $_SESSION['lastname_input']=$_POST['lastname_input'];
  $_SESSION['firstname_input']=$_POST['firstname_input'];
  $_SESSION['phone_input']=$_POST['phone_input'];

  $firstname = $_POST['firstname_input'];
  $lastname = $_POST['lastname_input'];
  $phone = $_POST['phone_input'];

  $sql = "SELECT * FROM пользователи WHERE Телефон = :phone";
  $stmt = $connect->prepare($sql);
  $stmt->bindParam(':phone', $phone);
  $stmt->execute();

  $userExists = $stmt->fetch(PDO::FETCH_ASSOC);

  $login=$_COOKIE['login'];

  $sql = "SELECT ID_Учетной_записи FROM учетные_данные WHERE Email = :login";
  $stmt = $connect->prepare($sql);
  $stmt->bindParam(":login", $login);
  $stmt->execute();
  $ID = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($userExists) {

    $userId = $userExists['ID_Пользователя'];

  } else {

    $sql = "INSERT INTO пользователи (Имя, Фамилия, Телефон, ID_Учетной_записи) VALUES (:firstname, :lastname, :phone, :ID)";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':ID', $ID['ID_Учетной_записи']);
    $stmt->execute();

    $userId = $connect->lastInsertId();
  }

  // Получаем данные из сессии
  $arrivalDate = $_SESSION['arrivalDate'];
  $departureDate = $_SESSION['departureDate'];    
  $numberOfGuests = $_SESSION['maxOccupancy'];
  $roomId = $room['ID_Типа_номера'];

  // Проверяем, существует ли уже бронирование для данного пользователя и периода
  $sqlCheckBooking = "SELECT COUNT(*) FROM бронирующие WHERE (ID_Пользователя = :userId AND Дата_приезда = :arrivalDate AND Дата_выезда = :departureDate) OR (ID_Типа_Номера = :roomId AND Дата_приезда = :arrivalDate AND Дата_выезда = :departureDate)";
  $stmtCheckBooking = $connect->prepare($sqlCheckBooking);
  $stmtCheckBooking->bindParam(':userId', $userId);
  $stmtCheckBooking->bindParam(':roomId', $roomId);
  $stmtCheckBooking->bindParam(':arrivalDate', $arrivalDate);
  $stmtCheckBooking->bindParam(':departureDate', $departureDate);
  $stmtCheckBooking->execute();

  $existingBookingCount = $stmtCheckBooking->fetchColumn();

if ($existingBookingCount == 0) {
    // Если бронирование не существует, выполняем вставку в таблицу бронирований
    $sqlInsertBooking = "INSERT INTO бронирующие (Дата_приезда, Дата_выезда, Количество_проживающих, ID_Пользователя, ID_Типа_Номера, Стоимость) 
                         VALUES (:arrivalDate, :departureDate, :numberOfGuests, :userId, :roomId, :cost)";
    $stmtInsertBooking = $connect->prepare($sqlInsertBooking);
    $stmtInsertBooking->bindParam(':arrivalDate', $arrivalDate);
    $stmtInsertBooking->bindParam(':departureDate', $departureDate);
    $stmtInsertBooking->bindParam(':numberOfGuests', $numberOfGuests);
    $stmtInsertBooking->bindParam(':userId', $userId);
    $stmtInsertBooking->bindParam(':roomId', $room['ID_Типа_номера']);
    $stmtInsertBooking->bindParam(':cost', $cost );
    $stmtInsertBooking->execute();

   // Получаем ID бронирования
   $bookingId = $connect->lastInsertId();

    // Получаем ID каждой услуги из таблицы услуг
    $serviceIds = [];
    foreach ($_SESSION['service'] as $serviceName) {
        $sqlGetServiceId = "SELECT ID_Услуги FROM услуги WHERE Наименование = :serviceName";
        $stmtGetServiceId = $connect->prepare($sqlGetServiceId);
        $stmtGetServiceId->bindParam(':serviceName', $serviceName);
        $stmtGetServiceId->execute();
        $serviceId = $stmtGetServiceId->fetchColumn();
        if ($serviceId) {
            $serviceIds[] = $serviceId;
        }
    }

    // Вставляем данные в таблицу активов и бронирования
    $sqlInsertAssets = "INSERT INTO активы_и_бронь (ID_Брони, ID_Места, ID_Питания, ID_Услуги)
                        VALUES (:bookingId, :hotelId, :foodId, :serviceId)";
    $stmtInsertAssets = $connect->prepare($sqlInsertAssets);


    $foodname=$_SESSION['chosen_food_type'];
    $sql = "SELECT ID_Питания FROM типы_питания WHERE Состав = :foodname";
    $stmt = $connect->prepare($sql);
    
    // Привязка значения переменной к параметру запроса
    $stmt->bindParam(':foodname', $foodname);
    
    // Выполнение запроса
    $stmt->execute();
    
    // Получение результата запроса
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // ID питания
    $foodId = $result['ID_Питания'];

    foreach ($serviceIds as $serviceId) {
        $stmtInsertAssets->bindParam(':bookingId', $bookingId);
        $stmtInsertAssets->bindParam(':hotelId', $hotel['ID']);
        $stmtInsertAssets->bindParam(':foodId', $foodId);
        $stmtInsertAssets->bindParam(':serviceId', $serviceId);
        $stmtInsertAssets->execute();
    }
    
    require_once('basket_options.php');
    
    //header("Location: account.php");
    //exit();
    
   }else{
    header("Location: orders.php");
    exit();
   }
}

?>