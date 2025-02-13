<?php
// dbconnect.php

$host = 'localhost'; // Хост базы данных
$user = 'axe_root'; // Имя пользователя базы данных
$password = 'nuttertools'; // Пароль пользователя базы данных
$database = 'myop'; // Имя базы данных

// Создаем соединение с базой данных
$conn = new mysqli($host, $user, $password, $database);

// Проверяем соединение
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
?>
