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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Фиксируем фон чтобы не дергался */
        .list-bg {
            background-attachment: fixed !important;
            background-position: center center !important;
            background-size: cover !important;
        }
        #toursContainer {
            min-height: 400px;
        }
    </style>
</head>
<body>
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

    <section class="list-bg">
        <main class="container py-5">
            <header class="text-center py-5 text-white">
                <h1 class="fw-bold">Выберите свой маршрут</h1>
                <p class="lead">Откройте для себя новые вершины</p>
            </header>

            <div class="container mb-4">
                <div class="d-flex justify-content-between align-items-center gap-3">
                    <input type="text" id="tourSearch" class="form-control form-control-lg shadow-sm" placeholder="Поиск тура по названию...">
                    <button id="refreshToursBtn" class="btn btn-mountain px-4 py-2" style="white-space: nowrap;">
                        Обновить
                    </button>
                </div>
            </div>

            <div id="toursContainer" class="row g-4">
                <div class="col-12 text-center text-white">
                    <div class="spinner-border text-light" role="status">
                        <span class="visually-hidden">Загрузка...</span>
                    </div>
                    <p class="mt-2">Загрузка туров...</p>
                </div>
            </div>
            
            <p id="toursStatus" class="text-center text-white-50 mt-3 small"></p>
        </main>
    </section>

    <footer class="text-center py-3 text-white" style="background-color: rgba(0,0,0,0.7);">
        <p class="mb-0">&copy; 2026 Горные туры</p>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    
    <script>
    $(document).ready(function() {
        let refreshInterval;
        
        // Функция загрузки туров
        function loadTours() {
            $('#toursStatus').text('Загрузка...');
            
            $.get('ajax.php', { action: 'get_tours' }, function(data) {
                const container = $('#toursContainer');
                container.empty();
                
                if (!data || data.length === 0) {
                    container.html('<div class="col-12 text-center text-white"> Туры временно недоступны</div>');
                    $('#toursStatus').text('');
                    return;
                }
                
                data.forEach(tour => {
                    let shortDesc = tour.description;
                    if (shortDesc && shortDesc.length > 80) {
                        shortDesc = shortDesc.substring(0, 77) + '...';
                    }
                    
                    const html = `
                        <div class="col-12 col-md-6 col-lg-4" data-tour-title="${escapeHtml(tour.title.toLowerCase())}">
                            <div class="card tour-card h-100 p-3 shadow-sm border-0">
                                <img src="img/${escapeHtml(tour.image)}" class="card-img-top rounded-4" alt="${escapeHtml(tour.title)}" onerror="this.src='img/placeholder.jpg'">
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold">${escapeHtml(tour.title)}</h5>
                                    <p class="card-text text-muted">${escapeHtml(shortDesc || 'Увлекательное горное приключение')}</p>
                                    <a href="item.php?id=${tour.id}" class="btn btn-mountain w-100">Подробнее</a>
                                </div>
                            </div>
                        </div>`;
                    container.append(html);
                });
                
                const now = new Date();
                $('#toursStatus').text(`Обновлено: ${now.toLocaleTimeString('ru-RU')}`);
                
                // Применяем фильтр если есть активный поиск
                const searchVal = $('#tourSearch').val();
                if (searchVal) {
                    filterTours(searchVal);
                }
            }, 'json').fail(function() {
                $('#toursStatus').text('Ошибка загрузки списка туров');
            });
        }
        
        // Функция фильтрации
        function filterTours(searchText) {
            const val = searchText.toLowerCase().trim();
            $('#toursContainer > div').each(function() {
                const title = $(this).data('tour-title') || '';
                if (val === '') {
                    $(this).show();
                } else {
                    $(this).toggle(title.includes(val));
                }
            });
        }
        
        // Экранирование HTML
        function escapeHtml(str) {
            if (!str) return '';
            return str
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
        }
        
        // === ТАЙМЕР ОБНОВЛЕНИЯ ===
        function startAutoRefresh() {
            if (refreshInterval) clearInterval(refreshInterval);
            refreshInterval = setInterval(function() {
                console.log('Автообновление туров...');
                loadTours();
            }, 20000);
        }
        
        // === КНОПКА ОБНОВЛЕНИЯ ===
        $('#refreshToursBtn').on('click', function() {
            const btn = $(this);
            const originalText = btn.html();
            btn.html('Загрузка...').prop('disabled', true);
            
            loadTours();
            
            setTimeout(() => {
                btn.html(originalText).prop('disabled', false);
            }, 1000);
        });
        
        // === ЖИВОЙ ПОИСК ===
        $('#tourSearch').on('input', function(e) {
            filterTours(e.target.value);
        });
        
        // Загружаем туры при загрузке страницы и запускаем таймер
        loadTours();
        startAutoRefresh();
    });
    </script>
</body>
</html>