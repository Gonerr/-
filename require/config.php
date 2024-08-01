<?php
header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header('Content-Type: text/html; charset=utf-8');

$host = "localhost";        // адрес сервера базы данных
$user= "lihacht3_local";              // имя пользователя базы данных
$password = "Lihachka03";     // пароль пользователя базы данных
$db = "lihacht3_local";         // название базы данных

// $conn = mysqli_connect($host, $user, $password, $db);  //процедурный стиль
// if (mysqli_connect_errno()) {
//     exit();
// }
// mysqli_query($conn, "SET NAMES 'utf8'");

$dsn="mysql:host=$host;dbname=$db;charset=utf8";

try {
    $connect=new PDO($dsn,$user,$password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connect->exec("set names utf8");
}
catch(PDOException $exception) {
    echo $exception->getMessage();}
?>