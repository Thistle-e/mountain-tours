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
            const phoneRegex = /^(\+7|8)[0-9]{10}$/; 
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


