<?php
include_once 'db.php';

if (isset($_POST['key'])) {
    $key = $_POST['key'];

    $database = new Database();

    // Отримуємо дані продуктів
    $data = $database->get_products($key);
    $dom = new DOMDocument;
    $dom->loadXML($data);
    $filePath = __DIR__ . '/products.xml';
    $dom->save($filePath);

    // Відправляємо файл клієнту
    header('Content-Description: File Transfer');
    header('Content-Type: application/xml');
    header('Content-Disposition: attachment; filename=' . basename($filePath));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    exit;
} else {
    echo 'No key provided';
}
?>