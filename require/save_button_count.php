<?php
if (isset($_POST['buttonCountText'])) {
    $buttonCountText = $_POST['buttonCountText'];
    
    // Пример сохранения в сессию:
    session_start();
    $_SESSION['buttonCountText'] = $buttonCountText;
} else {
    echo 'Не удалось получить значение из POST запроса';
}
?>