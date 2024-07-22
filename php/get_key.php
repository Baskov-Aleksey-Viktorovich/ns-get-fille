<?php
include_once 'db.php';

$database = new Database();
$obj = $database->get_token();

header('Content-Type: application/json');
echo json_encode($obj);
?>