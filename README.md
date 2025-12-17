# TNKISHOP

Кошик-магазин на Laravel — простий приклад e-commerce додатку з
адмін-панеллю для керування товарами, категоріями та фільтрами.

## 1. Опис проекту

- Laravel-проєкт для демонстрації каталогу товарів, кошика, профілю
	користувача та простого адміністративного інтерфейсу.

## 2. Вимоги

- PHP 8.0+
- Composer
- MySQL або MariaDB
- Node.js + npm (для збірки фронтенду)
- Рекомендувані PHP-розширення: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON
- Git (для роботи з репозиторієм)

## 3. Як встановити та запустити

1. Клонувати репозиторій:

```bash
git clone https://github.com/KomanDUREX/TNKISHOP.git
cd TNKISHOP
```

2. Встановити залежності PHP:

```bash
composer install
cp .env.example .env
php artisan key:generate
```

3. Налаштувати `.env` (база даних, пошта тощо), потім виконати міграції та сидування:

```bash
php artisan migrate --seed
```

4. Встановити залежності фронтенду та зібрати ресурси:

```bash
npm install
npm run build   # або `npm run dev` для розробки
```

5. Запустити локальний сервер:

```bash
php artisan serve
# Відкрити http://127.0.0.1:8000
```

Примітка: якщо ваш GitHub-репозиторій приватний, налаштуйте автентифікацію (SSH ключі або PAT).

## 4. Повна структура проекту (корінь)

- app/
	- Http/
		- Controllers/
		- Middleware/
	- Models/
	- Providers/
- bootstrap/
- config/
- database/
	- migrations/
	- seeders/
- public/
- resources/
	- views/
	- js/
	- css/
- routes/
- storage/
- tests/
- composer.json
- package.json
- artisan
- README.md

----

Якщо потрібно, можу розширити README: додати приклади .env, секцію про тестування або GitHub Actions.
# TNKISHOP