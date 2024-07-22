<?php
include_once 'db.php';

$database = new Database();
$obj = $database->get_token();

if (isset($obj->access_token)) {
    header('Content-Type: application/json');
    echo json_encode($obj);
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Не вдалося отримати ключ.', 'details' => $obj]);
}
?>
