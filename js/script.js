document.addEventListener('DOMContentLoaded', () => {
    console.log("Скрипт Горные Туры (ЛР №4) активирован!");

    // --- 1. ЖИВОЙ ПОИСК (для list.php) ---
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

    // --- 2. ОБРАБОТКА ФОРМЫ (для form.php) ---
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            // Сначала останавливаем отправку для проверки данных
            e.preventDefault(); 

            const name = document.getElementById('name').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const email = document.getElementById('email').value.trim();

            // Регулярные выражения
            const phoneRegex = /^(\+7|8)?[0-9]{10}$/; 
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Проверка имени
            if (!name) {
                alert("Пожалуйста, введите ваше имя!");
                return;
            }

            // Проверка телефона (убираем пробелы перед проверкой)
            if (!phoneRegex.test(phone.replace(/\s/g, ''))) {
                alert("Введите корректный номер (например, +79991234567 или 89991234567)");
                return;
            }

            // Проверка Email
            if (!emailRegex.test(email)) {
                alert("Введите корректный Email адрес!");
                return;
            }

            // Если всё верно — выводим в консоль и отправляем в PHP
            console.log("Данные верны. Отправка в базу данных...");
            console.log("Имя:", name, "Телефон:", phone, "Email:", email);

            // ВАЖНО: Вместо reset() и модалки здесь мы запускаем реальную отправку формы.
            // Модалку "Успешно" теперь будет показывать PHP через ?success=1 в URL.
            this.submit(); 
        });
    }
});
