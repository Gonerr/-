<?php

        $file_path = "../".$_POST["firstname_input"].'_'. date("d-m-Y") . ".txt";
        $data = "Поздравляем Вас, ".$_POST["firstname_input"].", с успешным бронированием базы отдыха:\n";
        $data .= $hotel['Название'].' в номере '.$room['Название_номера'];
        $data .=" \nПо адресу ".$hotel['Адрес'];
        $data .=" \nВаш заезд начинается ".$_SESSION['arrivalDate']." и заканчивается ".$_SESSION['departureDate']."\n";
        $data .= $_SESSION['chosen_food_type'].', '.$foodCost.'₽ на '.$days.' дней';
        $data .= "\nВыбранные услуги на ".$ServicesCost."₽ : ".implode(', ', $_SESSION['service']);
        $data .=" \nКоличество дней: ".$days ;
        $data .= "\nОбщая стоимость заказа составляет: ".$cost." рублей";
        $data .= "\n\n Приятного отдыха!";
        file_put_contents($file_path, $data);
        
    
        // Определяем адрес получателя и отправителя
        $to = $_POST["input_email"];
        $from = "info@lihah.ru";
        
        // Формируем тему письма
        $subject = $_POST["firstname_input"].'_'. date("d-m-Y") . ".txt";
        
        // Получаем содержимое изображения
        $image_path = "../img/".$hotel['Фото'];
        $image_content = file_get_contents($image_path);
        
        // Кодируем изображение в base64
        $image_base64 = base64_encode($image_content);
        
        // Формируем тег <img> с закодированным изображением
        $image_tag = '<img src="data:image/jpeg;base64,' . $image_base64 . '" class="image" style="margin-right: 10px; width: 250px; hidth: 300px;  ">';
        
        // Тело письма
        $message = '<html><body>';
        $message .= '<center>Уважаемый(ая) '.$_POST["firstname_input"].' '.$_POST["lastname_input"].'!</center><br>';
        $message .= '<table cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">';
        $message .= '<tr>';
        $message .= '<td style="padding-right: 300px;">'.$image_tag.'</td>';
        $message .= '<td>';
        $message .= 'Вы забронировали номер в базе отдыха:<br>';
        $message .= '<strong>&nbsp;&nbsp;&nbsp;&nbsp;'.$hotel['Название'].'</strong>, номер '.$room['Название_номера'].'<br>';
        $message .= 'В путёвку входят: <strong>'.$_SESSION['chosen_food_type'].'</strong><br>';
        if (!empty($_SESSION['service'])) {
            $selected_services = $_SESSION['service']; // Предполагается, что это массив
            $message .= '<strong>Дополнительные услуги:</strong>';
            $message .= '<ul>';
            foreach ($selected_services as $service) {
                $message .= '<li>' . htmlspecialchars($service) . '</li>';
            }
            $message .= '</ul>';
        }
        $message .= '</td>';
        $message .= '</tr>';
        $message .= '</table>';
        $message .= 'Полная стоимость бронирования: '.$cost.' рублей.<br>';
        
        $message .= '<small>Почти настоящая компания.</small>';
        $message .= '</body></html>';
        
        // Добавляем вложение
        $file_content = file_get_contents($file_path);
        $encoded_file_content = chunk_split(base64_encode($file_content));
        $attachment = "--boundary\r\n";
        $attachment .= "Content-Type: application/octet-stream; name=\"" . basename($file_path) . "\"\r\n";
        $attachment .= "Content-Transfer-Encoding: base64\r\n";
        $attachment .= "Content-Disposition: attachment; filename=\"" . basename($file_path) . "\"\r\n";
        $attachment .= "\r\n";
        $attachment .= $encoded_file_content . "\r\n";
        
        // Добавляем текстовое сообщение
        $body = "--boundary\r\n";
        $body .= "Content-Type: text/html; charset=utf-8\r\n";
        $body .= "Content-Transfer-Encoding: 8bit\r\n";
        $body .= "\r\n";
        $body .= $message . "\r\n";
        $body .= $attachment;
        $body .= "--boundary--\r\n";
        
        // Заголовки письма
        $headers = "From: $from\r\n";
        $headers .= "Reply-To: info@lihah.ru\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";
        
        // Отправляем письмо
        mail($to, $subject, $body, $headers);
    // Сохранение данных в файл
        file_put_contents($file_path, $data);
        
?>