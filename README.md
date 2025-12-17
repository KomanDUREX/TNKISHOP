# TNKISHOP

Лаконічний Laravel e‑commerce (каталог, кошик, адмін) — приклад для
швидкого розгортання та подальшого розвитку.

## Зміст

- Опис
- Вимоги
- Установка та запуск
- Структура проекту
- Контакти

## Опис

TNKISHOP — невеликий магазин на Laravel з базовою адмін-панеллю для
керування товарами, категоріями та фільтрами. Підходить як стартова
база для навчальних проєктів або шаблон для власного магазину.

## Вимоги

- PHP 8.0+
- Composer
- MySQL / MariaDB
- Node.js + npm
- Рекомендовані PHP-розширення: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON

## Установка та запуск

1. Клонування репозиторію

```bash
git clone https://github.com/KomanDUREX/TNKISHOP.git
cd TNKISHOP
```

2. PHP-залежності та налаштування

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Налаштуйте `.env` (DB_* та інші параметри). Далі запустіть міграції і сидери:

```bash
php artisan migrate --seed
```

3. Фронтенд

```bash
npm install
npm run build    # або `npm run dev` для розробки
```

4. Локальний сервер

```bash
php artisan serve
# Відкрити http://127.0.0.1:8000
```

## 🗂️ Структура проєкту

```text
TNKISHOP/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── ProductController.php
│   │   │   │   ├── CategoryController.php
│   │   │   │   ├── FilterController.php
│   │   │   │   └── DashboardController.php
│   │   │   ├── AuthController.php
│   │   │   ├── ProfileController.php
│   │   │   └── ShopController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   ├── Models/
│   │   ├── Product.php
│   │   ├── Category.php
│   │   ├── Filter.php
│   │   └── User.php
│   └── Providers/
│       └── AppServiceProvider.php
├── bootstrap/
│   ├── app.php
│   └── providers.php
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── database.php
│   ├── filesystems.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── services.php
│   └── session.php
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2025_12_15_000001_add_is_admin_is_active_to_users_table.php
│   │   ├── 2025_12_15_000002_create_categories_table.php
│   │   ├── 2025_12_15_000003_create_products_table.php
│   │   └── 2025_12_15_000004_create_filters_table.php
│   ├── seeders/
│   │   ├── DatabaseSeeder.php
│   │   └── ProductSeeder.php
│   └── factories/
│       └── UserFactory.php
├── public/
│   ├── index.php
│   ├── favicon.ico
│   ├── robots.txt
│   └── .htaccess
├── resources/
│   ├── views/
│   │   ├── about.blade.php
│   │   ├── home.blade.php
│   │   ├── catalog.blade.php
│   │   ├── products.blade.php
│   │   ├── cart.blade.php
│   │   ├── contacts.blade.php
│   │   ├── favorites.blade.php
│   │   ├── profile.blade.php
   │   ├── welcome.blade.php
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   └── register.blade.php
│   │   ├── admin/
│   │   │   ├── layout.blade.php
│   │   │   ├── dashboard.blade.php
+│   │   │   ├── products/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   └── edit.blade.php
│   │   │   ├── categories/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   └── edit.blade.php
│   │   │   └── filters/
│   │   │       ├── index.blade.php
│   │   │       ├── create.blade.php
│   │   │       └── edit.blade.php
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── components/
│   │   │   └── product-card.blade.php
│   │   └── partials/
│   │       ├── header.blade.php
│   │       └── footer.blade.php
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── css/
│       └── app.css
├── routes/
│   ├── web.php
│   └── console.php
├── storage/
│   └── (various .gitignore placeholders under framework, logs, app)
├── tests/
│   ├── Feature/
│   │   └── ExampleTest.php
│   └── Unit/
│       └── ExampleTest.php
├── .env.example
├── .gitignore
├── .gitattributes
├── .editorconfig
├── composer.json
├── composer.lock
├── package.json
├── package-lock.json
├── phpunit.xml
├── vite.config.js
├── artisan
└── README.md
```

## Контакти

Автор: KomanDUREX — novikov.vlad09743@gmail.com

---

Потрібно додати приклад `.env`, інструкцію по тестуванню або CI (GitHub
Actions)? Напишіть бажані секції — додам.
# TNKISHOP