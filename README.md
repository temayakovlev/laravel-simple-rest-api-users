<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## О проекте
Простой REST API <a href="https://laravel.com/api/9.x/Illuminate/Support/Facades/Validator.html" target="_blank">с валидацией пользовательских данных</a>, созданный на фреймворке Laravel 9.50.2.
Доступные методы:
 - создание пользователя
 - авторизация пользователя
 - получение информации (имя, email) о пользователе
 - обновление информации (имя, email) пользователя
 - удаление пользователя

## Установка
1. Клонировать данный репозиторий
2. Открыть терминал и выполнить по очереди следующие команды:
 - composer install
 - cp .env.example .env
 - php artisan key:generate
3. Создать базу данных MySQL и ввести данные для авторизации в файле .env (ключи начинаются с DB_)
4. Выполнить команду php artisan migrate

## Методы
### Создание пользователя
Выполнить POST запрос на URL http://localhost:8000/api/login c заполненным FormData. В FormData передать следующие ключи:
 - name
 - email
 - password

В ответ придет JSON с ключом user_token (accessToken), пример:

```json
{
    "success": "ok",
    "message": "",
    "data": {
        "user_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiZTQyMDRhZjViYmY5ZjY4MmY2YTMzZDdjNWQ5NzYxOGRjN2ZjMzlkNDJjMDRlZDNhYzc3NjUxZDMxZGZmMjQxOWViYjFhY2FjYjA5NzI0MmUiLCJpYXQiOjE2NzU4NTAzNTYuOTc1MjMxLCJuYmYiOjE2NzU4NTAzNTYuOTc1MjM1LCJleHAiOjE3MDczODYzNTYuOTY2OTQxLCJzdWIiOiIyNSIsInNjb3BlcyI6W119.HMFEzwzYtYcrj8Ftw3SS_dDXPR0Zf1aprqAMXFo0-pKNQcLFsuNFLGcikUlKdppMvCgYHiC32RbK5Y8qo8l9rfaQkOfqwtOOtt2MlOV5skcLdivYMDPWCzVznwacceMqEP2HGua6QCYTHg1TlK9UFP1eqV1VUr6Y4HaALJG-6CmXUNnYwoMFg3H4SDoPKfAXQxZm3iXdO4SteNGFTA3PAMAXsPgIlsyXfBEuHEUB8t2ahdPdlEAtgdJmrRjIhAxkmonn85F8TpRaVYN2k4M1DGArCfy9D-nGtvjftIFM-ltPz1_X4-qFm9P4tr04ISdgTa41OT1BmN653JWTBDEV-mpGA9qEUhxkC1EhTHoV7v425mCxNYl9fBteh05ANrTE_suerw5Gm89I78Obi4n7AUedlAM8AkPMgYY6SEUEUtVi-KLDghucTSWHe_zJpAr4pdDi-pqLTxuLZzuOWIZFAjRdOe3xTAitruteVQdEtEPRLyvTE3VRUE5UQ6hZ9cdVKbmSipNHwvXCvgXWymFKMhhitIKt7uj_njGwRq4VRRcs6u7n_WEvzS7ciNFXH1EK4FbZgIQzMIS3UwhZz15MAMIY_ByvXaqGGbcD3gg0KGa6ageAF-ij8ZwpG6yWqTCvvv8LhHexSFVlD_UrhUL4ByUFhdZWPcWZgwmp0qlI2-E"
    }
}
```

### Авторизация пользователя
Выполнить POST запрос на URL http://localhost:8000/api/register c заполненным FormData. В FormData передать следующие ключи:
 - email
 - password

В ответ придет JSON с ключом user_token (accessToken), пример аналогичен созданию.

### Получение информации о пользователе
Выполнить GET запрос на URL http://localhost:8000/api/users/{id пользователя}.

В ответ придет JSON с информацией о пользователе, пример:

```json
{
    "success": "ok",
    "message": "",
    "data": {
        "id": 3,
        "name": "Артемий",
        "email": "ya@ya.ru",
        "email_verified_at": null,
        "created_at": "2023-02-07T14:33:06.000000Z",
        "updated_at": "2023-02-07T14:33:06.000000Z"
    }
}
```

### Обновление информации о пользователе
Выполнить PUT запрос на URL http://localhost:8000/api/users/{id пользователя}, в body передать JSON с ключами name и email.

В ответ придет JSON с обновленной информацией о пользователе.

```json
{
    "success": "ok",
    "message": "",
    "data": {
        "id": 3,
        "name": "Artemiy",
        "email": "example@yandex.ru",
        "email_verified_at": null,
        "created_at": "2023-02-07T14:33:06.000000Z",
        "updated_at": "2023-02-08T10:05:17.000000Z"
    }
}
```

### Удаление пользователя
Выполнить DELETE запрос на URL http://localhost:8000/api/users/{id пользователя}.

В ответ придет JSON с сообщением об удалении указанного пользователя, пример:

```json
{
    "success": "ok",
    "message": "User deleted",
    "data": ""
}
```

## Тестирование
Для тестирования рекомендую использовать <a href="https://www.postman.com/downloads" target="_blank">PostMan</a>.

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).