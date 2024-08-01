<?php
session_start();
require_once ('config.php'); // Подключение к базе данных
// Только для этого файла 
if (isset($_POST['find_place_button'])) {
  if (isset($_POST["type_of_journey"])) {
    
    $_SESSION["selected_type_of_journey"] = $_POST["type_of_journey"];
  }

  if (isset($_POST['departureDate'])){
    $_SESSION['departureDate'] = $_POST['departureDate'];
  }

  if (isset($_POST['arrivalDate'])){
    $_SESSION['arrivalDate'] = $_POST['arrivalDate'];
  }
  header("Location: ./pages/orders.php");
  exit;
}
$warning1 = "";
$warning2 = "";
$auth = false;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        if (isset($_POST['login_button'])) {

            if ($_POST['login'] != null && $_POST['password'] != null){
                $login = $_POST['login'];
                $password = $_POST['password'];
            
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

                                header('Location: admin.php');
                                exit;
                                break; 
                            case 'Сотрудник':
                                setcookie('employeeMode', 'true', time() + 7200, '/');
                                break;
                            default:
                                setcookie('employeeMode', 'false', time() + 7200, '/');
                                setcookie('adminMode', 'false', time() + 7200, '/');
                                break; 
                        }
                        // Определение пути к account.php относительно корня сайта
                        $rootPath = ($_SERVER['SCRIPT_NAME'] === 'index.php') ? 'pages/account.php' : 'account.php';

                        header('Location: ' . $rootPath);
                        exit;
                    } else {
                        $warning1 = "Неверный логин или пароль";
                    }
                } else {
                    $warning1 = "Пользователь с таким логином не найден";
                }
            }
        }
        else if (isset($_POST['createUserButton'])) {
            if ($_POST['newPassword']===$_POST['repeatNewPassword']){

                $login = $_POST['newLogin'];
                $password = $_POST['newPassword'];
                $role = isset($_POST['isEmployee']) ? 'Сотрудник' : 'Пользователь';

                // Запрос для получения пароля по заданному email (PDO)
                $sql = "CALL GetUserCredentials(:email, @p_password, @p_role)";
                $stmt = $connect->prepare($sql);
                $stmt->bindParam(':email', $login, PDO::PARAM_STR);
                $stmt->execute();

                // Получение результатов процедуры
                $result = $connect->query("SELECT @p_password AS Пароль, @p_role AS Роль")->fetch(PDO::FETCH_ASSOC);
                if ($result['Пароль']!=''){
                    $warning2 = 'Извините, такой пользователь уже существует';
                }else{
                    $sql = "INSERT INTO учетные_данные (Email, Пароль, Роль) VALUES (:email, :password, :role)";
                    $stmt = $connect->prepare($sql);
                    $stmt->bindParam(':email', $login, PDO::PARAM_STR);
                    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                    $stmt->bindParam(':role', $role, PDO::PARAM_STR);
                    $stmt->execute();

                    setcookie('auth', 'true', time() + 7200, '/');
                    setcookie('login', isset($_POST['newLogin']) ? $_POST['newLogin'] : '', time() + 7200, '/');

                    switch($role){
                        case 'Пользователь':
                            setcookie('employeeMode', 'false', time() + 7200, '/');
                            setcookie('adminMode', 'false', time() + 7200, '/');
                            break; 
                        case 'Сотрудник':
                            setcookie('employeeMode', 'true', time() + 7200, '/');
                            break;
                        default:
                            break; 
                    }
                    header('Location: account.php');
                    exit;
                }
            }else {
                $warning2 = 'Пароли не совпадают!';
            }
        }

        // Проверяем, была ли отправлена форма для входа или регистрации
        if (isset($_POST['login_button'])) {
            // Устанавливаем значение в сессии
            $_SESSION['selected_form'] = 'login';
        } elseif (isset($_POST['createUserButton'])) {
            $_SESSION['selected_form'] = 'register';
        }
}
?>