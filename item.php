<?php 
// 1. Подключаем базу данных
require_once 'db.php'; 

// 2. Получаем ID из адресной строки (например, item.php?id=1)
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// 3. Ищем этот тур в базе данных
$stmt = $pdo->prepare("SELECT * FROM tours WHERE id = ?");
$stmt->execute([$id]);
$tour = $stmt->fetch();

// 4. Если тур с таким ID не найден — перенаправляем на список
if (!$tour) {
    header('Location: list.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($tour['title']); ?> | Детали тура</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color: var(--mt-light);">
    <nav class="navbar navbar-expand-lg fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-white d-flex align-items-center" href="index.php">
                <img src="img/лого.png" alt="Logo" width="40" height="40" class="me-2"> ГОРНЫЕ ТУРЫ
            </a>
            <div class="ms-auto">
                <ul class="navbar-nav flex-row gap-4">
                    <li><a class="nav-link" href="index.php">Главная</a></li>
                    <li><a class="nav-link" href="list.php">Список</a></li>
                    <li><a class="nav-link" href="form.php">Форма</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-5 mt-5">
        <div class="row justify-content-center">
            <!-- Белая подложка как в твоем дизайне -->
            <div class="col-lg-8 bg-white rounded-5 shadow-lg p-4 mt-4">
                
                <!-- Подгружаем картинку из базы -->
                <img src="img/<?php echo htmlspecialchars($tour['image']); ?>" class="img-fluid rounded-4 mb-4 w-100 shadow-sm" alt="Тур">
                
                <div class="text-center px-md-5">
                    <!-- Подгружаем заголовок из базы -->
                    <h1 class="fw-bold mb-3"><?php echo htmlspecialchars($tour['title']); ?></h1>
                    
                    <!-- Подгружаем описание из базы -->
                    <p class="text-muted mb-4 fs-5">
                        <?php echo htmlspecialchars($tour['description']); ?>
                        <br><br>
                        Это уникальное путешествие позволит вам прикоснуться к нетронутой природе и испытать себя на прочность.
                    </p>
                    
                    <div class="d-flex justify-content-center gap-3">
                        <a href="list.php" class="btn btn-outline-secondary px-4 py-2">Назад к списку</a>
                        <a href="form.php" class="btn btn-mountain px-5 py-2">Забронировать</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center mt-5"><p>&copy; 2026 Горные туры</p></footer>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
