<?php
require_once 'db.php';

header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $name  = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (empty($name) || empty($phone) || empty($email)) {
        echo json_encode(['success' => false, 'message' => 'Заполните все поля!']);
        exit;
    }

    $sql = "INSERT INTO requests (name, phone, email) VALUES (:name, :phone, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name, 'phone' => $phone, 'email' => $email]);

    echo json_encode([
        'success' => true,
        'message' => 'Заявка успешно отправлена!'
    ]);
    exit;
}

if ($method === 'GET' && isset($_GET['action'])) {
    if ($_GET['action'] === 'get_feedbacks') {
        $stmt = $pdo->query("SELECT * FROM requests ORDER BY id DESC");
        $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($requests);
        exit;
    }
    
    if ($_GET['action'] === 'get_tours') {
        $stmt = $pdo->query("SELECT id, title, description, image FROM tours ORDER BY id");
        $tours = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($tours);
        exit;
    }
}

echo json_encode(['success' => false, 'message' => 'Неверный запрос']);
?>