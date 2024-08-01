<?php
session_start();
$auth = isset($_COOKIE['auth']) && $_COOKIE['auth'] === 'true';
$adminMode = isset($_COOKIE['adminMode']) && $_COOKIE['adminMode'] === 'true';

if ($auth) {
    $str_login = 'Вы зашли как '.$_COOKIE['login'];
} else {
    $str_login = 'Пользователь не авторизован';
}

if (isset($_POST["exit_button"])){
        setcookie('auth', '', time() - 3600, '/');
        setcookie('login', '', time() - 3600, '/');

        // Очистка всех данных сессии
        session_unset();
        // Уничтожение сессии
        session_destroy();

        header("Location: ../index.php");
        exit; } 
?>