<?php/*
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "INSERT INTO requests (name, phone, email) VALUES (:name, :phone, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name, 'phone' => $phone, 'email' => $email]);

    // После сохранения возвращаем на страницу формы
    header('Location: contact.php?success=1');
}
?>*/