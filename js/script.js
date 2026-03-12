/* document.addEventListener('DOMContentLoaded', function () {
    
    // --- 1. ЖИВОЙ ПОИСК (для страницы catalog.html) ---
    const searchInput = document.getElementById('tourSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const filter = searchInput.value.toLowerCase();
            const cards = document.querySelectorAll('.col-md-4'); // находим колонки с карточками

            cards.forEach(card => {
                const title = card.querySelector('.card-title').textContent.toLowerCase();
                if (title.includes(filter)) {
                    card.style.display = ""; // показываем
                } else {
                    card.style.display = "none"; // скрываем
                }
            });
        });
    } 

    // --- 2. ОБРАБОТКА ФОРМЫ (для страницы contact.html) ---
    const form = document.getElementById('contactForm');
    if (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // отключаем перезагрузку страницы

            const name = document.getElementById('userName').value;
            const phone = document.getElementById('userPhone').value;
            const email = document.getElementById('userEmail').value;

            // Регулярные выражения для проверки
            const phoneRegex = /^\+?[0-9]{10,12}$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            let isValid = true;
            let errorMsg = "";

            if (!phoneRegex.test(phone)) {
                isValid = false;
                errorMsg += "Некорректный номер телефона. ";
            }
            if (!emailRegex.test(email)) {
                isValid = false;
                errorMsg += "Некорректный Email. ";
            }

            // Вывод в консоль (требование лабы)
            console.log("--- Данные формы ---");
            console.log("Имя:", name);
            console.log("Телефон:", phone);
            console.log("Email:", email);
            console.log("Валидность:", isValid);

            // Показ модального окна Bootstrap
            const statusModal = new bootstrap.Modal(document.getElementById('statusModal'));
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');

            if (isValid) {
                modalTitle.innerText = "Успешно!";
                modalTitle.className = "fw-bold text-success";
                modalMessage.innerText = "Ваша заявка принята. Мы свяжемся с вами скоро!";
                form.reset(); // очистка формы
            } else {
                modalTitle.innerText = "Ошибка!";
                modalTitle.className = "fw-bold text-danger";
                modalMessage.innerText = errorMsg;
            }

            statusModal.show();
        });
    }
}); */

// Ждем загрузку DOM, чтобы скрипт видел все элементы
/*document.addEventListener('DOMContentLoaded', () => {
    console.log("Скрипт Горные Туры активирован!");

    // --- 1. ЖИВОЙ ПОИСК (для catalog.html) ---
    const searchInput = document.getElementById('tourSearch');
    
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const val = e.target.value.toLowerCase().trim();
            // Ищем все колонки, в которых лежат карточки
            const cardColumns = document.querySelectorAll('.row.g-4 > div');

            cardColumns.forEach(column => {
                const titleElement = column.querySelector('.card-title');
                if (titleElement) {
                    const titleText = titleElement.innerText.toLowerCase();
                    // Если текст заголовка включает поиск — показываем колонку, иначе скрываем
                    column.style.display = titleText.includes(val) ? 'block' : 'none';
                }
            });
        });
        console.log("Поиск по турам запущен.");
    }

    // --- 2. ОБРАБОТКА ФОРМЫ (для contact.html / form.html) ---
    const contactForm = document.getElementById('contactForm');

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault(); // 1. Отключаем перезагрузку страницы

            // Получаем данные из твоих полей (id="name", id="phone", id="email")
            const name = document.getElementById('name').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const email = document.getElementById('email').value.trim();

            // 2. Регулярные выражения (ЛР требование)
            const phoneRegex = /^\+?[0-9]{10,15}$/; // Телефон (от 10 до 15 цифр, опционально +)
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Стандартный email

            // Проверка данных (Валидация)
            if (!name) {
                alert("Пожалуйста, введите ваше имя!");
                return;
            }
            if (!phoneRegex.test(phone)) {
                alert("Введите корректный номер телефона (например, +79001234567)");
                return;
            }
            if (!emailRegex.test(email)) {
                alert("Введите корректный Email адрес!");
                return;
            }

            // 3. Вывод данных в консоль (Требование ЛР №3)
            console.log("--- Новая заявка на тур ---");
            console.log("Клиент:", name);
            console.log("Телефон:", phone);
            console.log("Email:", email);

            // 4. Показываем модальное окно Bootstrap (id="statusModal")
            const modalElement = document.getElementById('statusModal');
            if (modalElement) {
                // Наполняем модалку текстом перед показом
                document.getElementById('modalTitle').innerText = "Успешно!";
                document.getElementById('modalTitle').style.color = "#5d2e1a";
                document.getElementById('modalMessage').innerText = `Спасибо, ${name}! Ваша заявка принята.`;
                
                const myModal = new bootstrap.Modal(modalElement);
                myModal.show();
            }

            // Очищаем форму после успешной "отправки"
            contactForm.reset();
        });
        console.log("Валидация формы готова.");
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


