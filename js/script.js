document.addEventListener('DOMContentLoaded', () => {
    console.log("Скрипт Горные Туры (ЛР №4 + №5) активирован!");

    // === 1. ЖИВОЙ ПОИСК (для list.php) — остаётся без изменений ===
    const searchInput = document.getElementById('tourSearch');
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const val = e.target.value.toLowerCase().trim();
            const cardColumns = document.querySelectorAll('.row.g-4 > div');

            cardColumns.forEach(column => {
                const titleElement = column.querySelector('.card-title');
                if (titleElement) {
                    const titleText = titleElement.innerText.toLowerCase();
                    column.style.display = titleText.includes(val) ? 'block' : 'none';
                }
            });
        });
    }

    // === 2. AJAX ДЛЯ ФОРМЫ (Лабораторная №5) ===
    // Работает только на form.php (там подключён jQuery)
    if (typeof $ !== 'undefined' && document.getElementById('contactForm')) {

        // Загрузка списка заявок при открытии страницы
        loadFeedbacks();

        // Автообновление каждые 20 секунд 
        setInterval(loadFeedbacks, 20000);

        // Кнопка «Обновить список»
        $('#refreshBtn').on('click', loadFeedbacks);

        function loadFeedbacks() {
            $('#listStatus').text('Загрузка...');

            $.get('ajax.php', { action: 'get_feedbacks' }, function (data) {
                const container = $('#feedbacksContainer');
                container.empty();

                if (!data || data.length === 0) {
                    container.html('<div class="col-12 text-center">Пока нет заявок</div>');
                    $('#listStatus').text('');
                    return;
                }

                data.forEach(fb => {
                    const html = `
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">${fb.name}</h5>
                                    <p class="card-text">
                                        <strong>Телефон:</strong> ${fb.phone}<br>
                                        <strong>Email:</strong> ${fb.email}
                                    </p>
                                </div>
                                <div class="card-footer text-muted small">
                                    ID: ${fb.id || '—'}
                                </div>
                            </div>
                        </div>`;
                    container.append(html);
                });

                $('#listStatus').text('Обновлено: ' + new Date().toLocaleTimeString('ru-RU'));
            }, 'json').fail(() => {
                $('#listStatus').text('Ошибка загрузки списка');
            });
        }

        // === ОБРАБОТКА ФОРМЫ ЧЕРЕЗ AJAX (POST) ===
        $('#contactForm').off('submit').on('submit', function (e) {
            e.preventDefault();

            const name  = $('#name').val().trim();
            const phone = $('#phone').val().trim();
            const email = $('#email').val().trim();

            // Твоя оригинальная валидация (точно как было)
            const phoneRegex = /^(\+7|8)?[0-9]{10}$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!name) {
                alert("Пожалуйста, введите ваше имя!");
                return;
            }
            if (!phoneRegex.test(phone.replace(/\s/g, ''))) {
                alert("Введите корректный номер (например, +79991234567 или 89991234567)");
                return;
            }
            if (!emailRegex.test(email)) {
                alert("Введите корректный Email адрес!");
                return;
            }

            // === AJAX POST (сохраняем без перезагрузки страницы) ===
            $.post('ajax.php', $(this).serialize(), function (res) {
                if (res.success) {
                    // Показываем модальное окно успеха
                    const modal = new bootstrap.Modal(document.getElementById('successModal'));
                    $('#modalMessage').text(res.message);
                    modal.show();

                    // Очищаем форму
                    $('#contactForm')[0].reset();

                    // Сразу обновляем список заявок
                    //loadFeedbacks();
                } else {
                    alert(res.message || 'Ошибка при сохранении');
                }
            }, 'json').fail(() => {
                alert('Ошибка соединения с сервером');
            });
        });
    }
});