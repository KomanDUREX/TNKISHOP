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

## Структура проекту (корінь)

```
app/
	Http/
		Controllers/
		Middleware/
	Models/
	Providers/
bootstrap/
config/
database/
	migrations/
	seeders/
public/
resources/
	views/
	js/
	css/
routes/
storage/
tests/
composer.json
package.json
artisan
README.md
```

## Контакти

Автор: KomanDUREX — novikov.vlad09743@gmail.com

---

Потрібно додати приклад `.env`, інструкцію по тестуванню або CI (GitHub
Actions)? Напишіть бажані секції — додам.
# TNKISHOP