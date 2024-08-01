<?php
session_start();
require_once ('config.php');
header('Content-Type: application/json');

$response = ["success" => false, "message" => ""];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        
        try {
            // Запрос для получения пароля по заданному email (PDO)
            $sql = "CALL GetUserCredentials(:email, @p_password, @p_role)";
            $stmt = $connect->prepare($sql);
            $stmt->bindParam(':email', $login, PDO::PARAM_STR);
            $stmt->execute();

            // Получение результатов процедуры
            $result = $connect->query("SELECT @p_password AS Пароль, @p_role AS Роль")->fetch(PDO::FETCH_ASSOC);
        
            if ($result) {
                if ($password === $result['Пароль']) {
                    setcookie('auth', 'true', time() + 7200, '/');
                    setcookie('login', isset($_POST['login']) ? $_POST['login'] : '', time() + 7200, '/');

                    switch($result['Роль']){
                        case 'Админ':
                            setcookie('adminMode', 'true', time() + 7200, '/');
                            setcookie('employeeMode', 'true', time() + 7200, '/');
                            break; 
                        case 'Сотрудник':
                            setcookie('employeeMode', 'true', time() + 7200, '/');
                            break;
                        default:
                            setcookie('employeeMode', 'false', time() + 7200, '/');
                            setcookie('adminMode', 'false', time() + 7200, '/');
                            break; 
                    }
                    $response["success"] = True;
                    $response["message"] = "Вход выполнен успешно!";
                } else {
                    $response["message"] = "Неверный логин или пароль";
                }
            } else {
                $response["message"] = "Пользователь с таким логином не найден";
            }
        } catch (PDOException $e) {
            $response["message"] = "Ошибка подключения к базе данных: " . $e->getMessage();
        }
    } else {
        $response["message"] = "Логин и пароль обязательны";
    }
    echo json_encode($response);
    exit;
}
?>