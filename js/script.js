/*document.addEventListener('DOMContentLoaded', () => {
    console.log("--- Скрипт Горные Туры активирован! ---");

    // --- 1. ЖИВОЙ ПОИСК (для catalog.html) ---
    const searchInput = document.getElementById('tourSearch');
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const val = e.target.value.toLowerCase().trim();
            const cardColumns = document.querySelectorAll('.row.g-4 > div');

            cardColumns.forEach(column => {
                const titleElement = column.querySelector('.card-title');
                if (titleElement) {
                    const titleText = titleElement.innerText.toLowerCase();
                    // Фильтрация: показываем блок, если текст совпадает
                    column.style.display = titleText.includes(val) ? 'block' : 'none';
                }
            });
        });
        console.log("Поиск по турам готов к работе.");
    }

    // --- 2. ОБРАБОТКА ФОРМЫ (для contact.html / form.html) ---
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Отключаем переход на другую страницу

            // Получаем значения полей
            const name = document.getElementById('name').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const email = document.getElementById('email').value.trim();

            // Регулярные выражения
            const phoneRegex = /^(\+7|8)?[0-9]{10}$/; 
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Валидация
            if (!name) {
                alert("Введите имя!");
                return;
            }

            if (!phoneRegex.test(phone.replace(/\s/g, ''))) {
                alert("Введите корректный номер (например, +79991234567 или 89991234567)");
                return;
            }

            if (!emailRegex.test(email)) {
                alert("Введите корректный Email!");
                return;
            }

            // --- ВЫВОД В КОНСОЛЬ (Требование ЛР №3) ---
            console.log("=== НОВАЯ ЗАЯВКА ПРИНЯТА ===");
            console.log("Имя:", name);
            console.log("Телефон:", phone);
            console.log("Email:", email);
            console.log("Статус: Валидация пройдена успешно");
            console.log("============================");

            // --- ПОКАЗ МОДАЛЬНОГО ОКНА (Исправлено для устранения Illegal invocation) ---
            const modalElement = document.getElementById('statusModal');
            if (modalElement) {
                // Пытаемся получить существующий экземпляр или создаем новый
                let myModal = bootstrap.Modal.getInstance(modalElement);
                if (!myModal) {
                    myModal = new bootstrap.Modal(modalElement);
                }

                // Заполняем данные в модалке
                document.getElementById('modalTitle').innerText = "Успешно!";
                document.getElementById('modalTitle').style.color = "#5d2e1a";
                document.getElementById('modalMessage').innerText = `Заявка от ${name} принята. Мы свяжемся с вами по почте ${email}.`;
                
                myModal.show();
            }

            contactForm.reset(); // Очищаем форму
        });
    }
});*/

document.addEventListener('DOMContentLoaded', () => {
    console.log("Скрипт Горные Туры активирован!");

    // --- 1. ЖИВОЙ ПОИСК (для catalog.html) ---
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

    // --- 2. ОБРАБОТКА ФОРМЫ (для contact.html) ---
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault(); 

            const name = document.getElementById('name').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const email = document.getElementById('email').value.trim();

            // --- ОБНОВЛЕННАЯ ПРОВЕРКА ТЕЛЕФОНА ---
            // Разрешает: +7..., 8...,(всего от 10 до 12 символов)
            const phoneRegex = /^(\+7|8)?[0-9]{10}$/; 
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!name) {
                alert("Введите имя!");
                return;
            }

            // Валидация телефона
            if (!phoneRegex.test(phone.replace(/\s/g, ''))) { // убираем пробелы при проверке
                alert("Введите корректный номер (например, +79991234567 или 89991234567)");
                return;
            }

            // Валидация Email
            if (!emailRegex.test(email)) {
                alert("Введите корректный Email!");
                return;
            }

            // Вывод в консоль (ЛР требование)
            console.log("--- Данные формы ---");
            console.log("Имя:", name, "Телефон:", phone, "Email:", email);

            // Показ модалки
            const modalElement = document.getElementById('statusModal');
            if (modalElement) {
                document.getElementById('modalTitle').innerText = "Успешно!";
                document.getElementById('modalMessage').innerText = `Заявка от ${name} принята.`;
                const myModal = new bootstrap.Modal(modalElement);
                myModal.show();
            }

            contactForm.reset();
        });
    }
}); 
