<?php
require_once('admin_require.php');
if (isset($_GET['table'])) {
    $table = $_GET['table'];
    $primaryKey = getPrimaryKey($connect, $table);

    if ($primaryKey) {
        $stmt = $connect->prepare("SELECT * FROM $table");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            echo "<tr>";
            foreach ($row as $key => $value) {
                echo "<td><input type='text' name='data[{$row[$primaryKey]}][$key]' value='".htmlspecialchars($value)."'></td>";
            }
            echo "<td><input type='checkbox' name='selectedRows[]' value='{$row[$primaryKey]}'></td>";
            echo "</tr>";
        }
    }
} else {
    echo "Ошибка.";
}

?>