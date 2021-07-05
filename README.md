<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Запуск приложения на локальном сервере

1. Скачать архив распаковать в любое место, зайти в папку и открыть в ней консоль.

2. Запустить команду "composer install"

3. Запустить команду "npm install"

4. Переименовать файл .env.example(в корне проекта) в .env

5. Создать у себя базу данных (например Mysql) и в файле .env задать настройки подключения к БД
   (Название БД - DB_DATABASE, Логин - DB_USERNAME, Пароль - DB_PASSWORD )

6. Запустить команду "php artisan key:generate"

7. Выполнить команду "php artisan migrate:refresh --seed"

8. Для Работы Авторизации выполнить "php artisan passport:install" <br>
   Если Encryption keys уже есть тогда вместо 1 команды можно ввести "php artisan passport:client --personal" ввести любое имя, <br>

9. Для отображения картинок "php artisan storage:link" <br>
   Добавить в .env строку "FILESYSTEM_DRIVER=public"(если нет) и
   на всякий случай можно в строку APP_URL = http://ваш-URL добавить URL - если отличается от localhost

11. Запустить команду "php artisan serve" для запуска встроенного сервера и перейти по URL-адресу указанному в консоли

12. Данные для входа в админку Email - "**admin@mail.com**", Пароль - "**12345678**" <br>




