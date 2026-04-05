<?php 
// 1. Подключаем базу данных
require_once 'db.php'; 
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Наши туры | Горные приключения</title>
    <!-- Локальный Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m,e,t,r,i,k,a){
            m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
        })(window, document,'script','https://mc.yandex.ru/metrika/tag.js?id=107312436', 'ym');

        ym(107312436, 'init', {ssr:true, webvisor:true, clickmap:true, ecommerce:"dataLayer", referrer: document.referrer, url: location.href, accurateTrackBounce:true, trackLinks:true});
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/107312436" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
</head>
<body>
    <!-- Навигация -->
    <nav class="navbar navbar-expand-lg fixed-top shadow-sm"> 
        <div class="container">
            <a class="navbar-brand fw-bold text-white d-flex align-items-center" href="index.php">
                <img src="img/лого.png" alt="Logo" width="40" height="40" class="me-2">
                ГОРНЫЕ ТУРЫ
            </a>
            <div class="ms-auto">
                <ul class="navbar-nav flex-row gap-4">
                    <li><a class="nav-link" href="index.php">Главная</a></li>
                    <li><a class="nav-link active" href="list.php">Список</a></li>
                    <li><a class="nav-link" href="form.php">Форма</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Основной контент -->
    <section class="list-bg py-5">
        <main class="container py-5 mt-5">
            <header class="text-center my-5 text-white">
                <h1 class="fw-bold">Выберите свой маршрут</h1>
            </header>

            <!-- Окно поиска (ЛР №3) -->
            <div class="container mb-4">
                <input type="text" id="tourSearch" class="form-control form-control-lg shadow-sm" placeholder="Поиск тура по названию...">
            </div>

            <div class="row g-4">
                <?php
                // 2. Получаем все туры из таблицы tours
                $stmt = $pdo->query("SELECT * FROM tours");
                
                // 3. Цикл для вывода каждой строки из БД
                while ($row = $stmt->fetch()) {
                ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card tour-card h-100 p-3 shadow-sm border-0">
                            <!-- Подставляем имя картинки из базы -->
                            <img src="img/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top rounded-4" alt="Тур">
                            <div class="card-body text-center">
                                <!-- Подставляем заголовок из базы -->
                                <h5 class="card-title fw-bold"><?php echo htmlspecialchars($row['title']); ?></h5>
                                <!-- Подставляем описание из базы -->
                                <p class="card-text text-muted"><?php echo htmlspecialchars($row['description']); ?></p>
                                <!-- Ссылка с ID тура для страницы item.php -->
                                <a href="item.php?id=<?php echo $row['id']; ?>" class="btn btn-mountain w-100">Подробнее</a>
                            </div>
                        </div>
                    </div>
                <?php } // Конец цикла ?>
            </div>
        </main>
    </section>

    <footer class="text-center mt-5 text-white"><p>&copy; 2026 Горные туры</p></footer>
    
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
