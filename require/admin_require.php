<?php
session_start();
require_once('../require/session_vars.php');
require_once('../require/config.php');

if (!isset($_COOKIE['adminMode']) || $_COOKIE['adminMode'] !== 'true') {
    header('Location: ../index.php'); // Перенаправление на главную страницу, если пользователь не администратор
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['table'])) {
    $_SESSION['selected_table'] = $_POST['table'];
}

// Получение списка таблиц
$stmt = $connect->prepare("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA = ?");
$stmt->execute([$connect->query("SELECT DATABASE()")->fetchColumn()]);
$tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

function getPrimaryKey($connect, $table) {
    $stmt = $connect->prepare("
        SELECT COLUMN_NAME 
        FROM INFORMATION_SCHEMA.COLUMNS 
        WHERE TABLE_SCHEMA = DATABASE() 
          AND TABLE_NAME = :table 
          AND COLUMN_KEY = 'PRI'
    ");
    $stmt->bindParam(':table', $table, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['COLUMN_NAME'] : null;
}

// Определение текущей таблицы
$table = isset($_POST['table']) ? $_POST['table'] : null;

if (isset($_POST['table'])) {
    $table = $_POST['table'];
    $primaryKey = getPrimaryKey($connect, $table);

    if ($primaryKey) {
        $stmt = $connect->prepare("SELECT * FROM $table");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>