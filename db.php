<?php
// Данные берем строго из твоего лога (строка bind-address)
$host = '127.0.1.13'; 
$port = '3306';
$db   = 'tourhub'; 
$user = 'root';
$pass = ''; 

try {
    // Вставляем конкретный IP из лога
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Связь с горами установлена!"; // Можно раскомментировать для проверки
} catch (PDOException $e) {
    die("Ошибка подключения к базе: " . $e->getMessage());
}
?>
