# Вступление
Проект - это интернет магазин, написан, как тестовый, показывающий мои знания в области разработки серверной части.</br>
**В проекте реализовал:** CRUD, RESTful Api, разделение ролей на: admin, authenticated и guest, JWT регистрацию, авторизацию, аутентификацию, документацию api через swagger/openApi, корзину товаров, создание миграций, заполнение БД данными с помощью фабрик.

---

# Что было использовано:

- **Ubuntu 24.04**
- **NeoVim**
- **Programming Language**: PHP 8.1
- **MySQL 5.7**
- **Framework**: Laravel 11
- **POSTMAN(curl)**
- **Swagger/OpenApi**
- **JavaScript:** fetch запросы и async/await

---

# Установка

Откройте терминал и клонируйте репозиторий

В редакторе кода откройте папку с проектом и, для установки необходимых пакетов и библиотек, в терминале выполните команды:
```bash
composer install
npm install
```

Для настройки базы данных выполните команды,а после впишите данные вашей БД:
```bash
cp .env.example .env
```
```bash
php artisan key:generate
```

Для создания таблиц, выполните миграции:
```bash
php artisan make:migration
```

Чтобы заполнить таблицы выполните:
```bash
php artisan DB:seed
```

# Основные функции для пользователей

1. JWT регистрация, авторизация, аутентификация, при этом есть разделение ролей у пользователей </br>
2. Просматривать список товаров, т.е. реализована пагинация и выполнять CRUD операции над ними; </br>
3. Просматривать список вакансий, т.е. реализована пагинация и выполнять CRUD операции над ними; </br>
4. Просматривать список сотрудников, т.е. реализована пагинация и выполнять CRUD операции над ними; А так же выносить их в docx документ, в котором будут их ФИО(Этот документ в проекте используется как генерация приказа об увольнении сотрудника)</br>
5. Добавлять товары в корзину и оформлять доставку, при этом товары из корзины удалятся; </br>

# Примечания

После генерации данных в таблицах БД, нам доступна учётная запись администратора. Для того, чтобы в неё войти нам нужно ввести эти данные в форму входа: </br>
Логин: `admin@mail.ru` </br>
Пароль: `Q1qqqqqq` </br>

Если вы не хотите входить в аккаунт администратора, то зарегистрируйтесь. У учётной записи администратора есть преимущества над обычными пользователями. Например, незарегистрированным пользователям не открыты некоторые страницы. </br>
Администратор может выполнять CRUD операции недоступные другим пользователям.

# Swagger-документация

Если в адресной строке перейти по пути `/swagger` то вы попадёте на страницу документации api. </br>
<p align="center">
    <img  src="https://github.com/R3ndly/diplom/blob/main/public/img/swagger1.png"/>
</p>

Ещё про swagger в моём проекте можно посмотреть [тут](./README2.md)


