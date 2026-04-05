<?php 
// 1. Подключаем базу данных
require_once 'db.php'; 

// 2. Логика сохранения в БД (PHP обработчик)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    try {
        $sql = "INSERT INTO requests (name, phone, email) VALUES (:name, :phone, :email)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['name' => $name, 'phone' => $phone, 'email' => $email]);
        
        // После сохранения можно отправить сигнал для модалки через URL
        header("Location: form.php?success=1");
        exit;
    } catch (PDOException $e) {
        die("Ошибка сохранения: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оставить заявку | Горные приключения</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- Твоя метрика остается здесь -->
</head>
<body>
    <!-- Навигация (обнови ссылки на .php) -->
    <nav class="navbar navbar-expand-lg fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-white d-flex align-items-center" href="index.php">
                <img src="img/лого.png" alt="Logo" width="40" height="40" class="me-2"> ГОРНЫЕ ТУРЫ
            </a>
            <div class="ms-auto">
                <ul class="navbar-nav flex-row gap-4">
                    <li><a class="nav-link" href="index.php">Главная</a></li>
                    <li><a class="nav-link" href="list.php">Список</a></li>
                    <li><a class="nav-link active" href="form.php">Форма</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="form-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="bg-white p-5 rounded-5 shadow-lg text-center">
                        <h2 class="mb-4 fw-bold" style="color: var(--mt-brown)">ОСТАВИТЬ ЗАЯВКУ</h2>
                        
                        <!-- ОБНОВЛЕНО: Добавлены action и method -->
                        <form id="contactForm" action="form.php" method="POST">
                            <div class="mb-3">
                                <input type="text" id="name" name="name" class="form-control form-control-lg border-0 bg-light px-4" placeholder="Ваше имя" required>
                            </div>
                            <div class="mb-3">
                                <input type="tel" id="phone" name="phone" class="form-control form-control-lg border-0 bg-light px-4" placeholder="Номер телефона" required>
                            </div>
                            <div class="mb-4">
                                <input type="email" id="email" name="email" class="form-control form-control-lg border-0 bg-light px-4" placeholder="Email адрес" required>
                            </div>
                            <button type="submit" class="btn btn-mountain btn-lg w-100 py-3 shadow">Отправить данные</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Твоя модалка остается без изменений -->
    <div class="modal fade" id="statusModal" tabindex="-1" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-body text-center p-5">
                    <h3 id="modalTitle" class="fw-bold mb-3"></h3>
                    <p id="modalMessage" class="text-muted mb-4"></p>
                    <button type="button" class="btn btn-mountain px-5 py-2" data-bs-dismiss="modal">Понятно</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center mt-auto"><p>&copy; 2026 Горные туры</p></footer>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
    
    <!-- Скрипт для показа модалки при успешной отправке PHP -->
    <?php if(isset($_GET['success'])): ?>
    <script>
        window.onload = function() {
            const modalEl = document.getElementById('statusModal');
            document.getElementById('modalTitle').innerText = "Успешно!";
            document.getElementById('modalMessage').innerText = "Данные сохранены в базу данных tourhub!";
            const myModal = new bootstrap.Modal(modalEl);
            myModal.show();
        }
    </script>
    <?php endif; ?>
</body>
</html>
