<?php 
// 1. Подключаем базу данных
require_once 'db.php'; 
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оставить заявку | Горные приключения</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Навигация -->
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
                        
                        <form id="contactForm">
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

    <!-- Модальное окно успеха -->
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold text-success">Успешно!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <p id="modalMessage" class="mb-0 fs-5"></p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-mountain px-4" data-bs-dismiss="modal">Отлично</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Список заявок -->
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3> Все заявки из базы</h3>
            <button id="refreshBtn" class="btn btn-mountain">Обновить список</button>
        </div>
        
        <div id="feedbacksContainer" class="row row-cols-1 row-cols-md-2 g-4">
            <!-- Заполняется через JS -->
        </div>
        
        <p id="listStatus" class="text-center text-muted mt-3"></p>
    </div>

    <footer class="text-center mt-auto"><p>&copy; 2026 Горные туры</p></footer>

    <!-- Подключаем скрипты (один раз!) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>