<?php
session_start();
require_once('../require/config.php');
require_once('../require/admin_require.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';
    $table = $_POST['table'] ?? '';

    
    $primaryKey = getPrimaryKey($connect, $table);

    if ($action === 'delete' && isset($_POST['selectedRows'])) {
        try {
            $selectedRows = $_POST['selectedRows'];
            $inQuery = implode(',', array_fill(0, count($selectedRows), '?'));
            $stmt = $connect->prepare("DELETE FROM $table WHERE $primaryKey IN ($inQuery)");

            foreach ($selectedRows as $index => $rowId) {
                $stmt->bindValue(($index+1), $rowId, PDO::PARAM_INT);
            }
            $stmt->execute();
            echo "Выбранные записи удалены успешно";
        } catch (PDOException $e) {
            echo "Ошибка";
        }
        exit();
    }

    if ($action === 'save') {
        if (isset($_POST['data'])) {
            try {
                foreach ($_POST['data'] as $primaryKeyValue => $fields) {
                    $updateFields = [];
                    $updateValues = [];
                    foreach ($fields as $columnName => $value) {
                        // Заменяем пустые строки на NULL
                        $value = ($value === '') ? null : $value;
                        $updateFields[] = "$columnName = ?";
                        $updateValues[] = $value;
                    }
                    $updateValues[] = $primaryKeyValue;
                    $sql = "UPDATE $table SET " . implode(', ', $updateFields) . " WHERE $primaryKey = ?";
                    $stmt = $connect->prepare($sql);
                    $stmt->execute($updateValues);
                }
                echo "Данные успешно сохранены.";
            } catch (PDOException $e) {
                echo "Ошибка при сохранении данных";
            }
        }

        if (isset($_POST['newRow'])) {
            $newRow = $_POST['newRow'];
            foreach ($newRow as $key => &$value) {
                if ($value === '') {
                    $value = null;
                }
            }
            unset($value);
            $columns = array_keys($newRow);
            $values = array_values($newRow);
            $placeholders = implode(', ', array_fill(0, count($values), '?'));
            $columnsList = implode(', ', $columns);

            try {
                $stmt = $connect->prepare("INSERT INTO $table ($columnsList) VALUES ($placeholders)");
                $stmt->execute($values);
                echo "Новая запись добавлена.";
            } catch (PDOException $e) {
                echo "Ошибка при добавлении данных";
            }
        }
        exit();
    }
}
?>