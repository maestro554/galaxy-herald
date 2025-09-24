<?php
// Подключение к базе
$servername = "db";        // имя сервиса из docker-compose.yml (обычно db)
$username = "user";        // пользователь (или тот, что ты указал в env)
$password = "password";     // пароль (как в docker-compose.yml)
$dbname = "news";          // имя базы (как в dump.sql или в docker-compose.yml)

// Создаём соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
