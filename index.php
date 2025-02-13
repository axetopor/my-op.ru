<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// Перенаправление, если пользователь уже авторизован
if (isset($_SESSION['user'])) {
    header("Location: page.php");
    exit;
}

// Инициализация переменных
$emailError = $passError = $errMSG = '';
$email = '';

// Обработка формы входа
if (isset($_POST['btn-login'])) {
    // Очистка и валидация ввода
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    // Валидация email
    if (empty($email)) {
        $error = true;
        $emailError = "Пожалуйста, введите свой адрес электронной почты.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Пожалуйста, введите правильный адрес электронной почты.";
    }

    // Валидация пароля
    if (empty($pass)) {
        $error = true;
        $passError = "Пожалуйста, введите свой пароль.";
    }

    // Если ошибок нет, пытаемся авторизовать пользователя
    if (empty($error)) {
        // Хэширование пароля
        $password = hash('sha256', $pass);

        // Использование подготовленных выражений для защиты от SQL-инъекций
        $stmt = $conn->prepare("SELECT userId, userName, userPass FROM users WHERE userEmail = ?");
        $stmt->bind_param("s", $email); // Привязываем email к запросу
        $stmt->execute(); // Выполняем запрос
        $stmt->store_result(); // Сохраняем результат
        $stmt->bind_result($userId, $userName, $userPass); // Привязываем результат к переменным
        $stmt->fetch(); // Получаем данные

        // Проверяем, есть ли пользователь с таким email и паролем
        if ($stmt->num_rows == 1 && $userPass == $password) {
            // Устанавливаем сессию для авторизованного пользователя
            $_SESSION['user'] = $userId;
            // Перенаправляем на защищенную страницу
            header("Location: page.php");
            exit; // Завершаем выполнение скрипта
        } else {
            // Если данные неверны, выводим сообщение об ошибке
            $errMSG = "Неверные учетные данные. Попробуйте снова...";
        }

        $stmt->close(); // Закрываем запрос
    }
}
?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Вход - Coding Cage</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/style.css">
    </head>
    <body>
    <div class="container">
        <div id="login-form">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                <div class="col-md-12">
                    <div class="form-group">
                        <h2>Вход</h2>
                        <hr>
                    </div>

                    <!-- Вывод ошибок -->
                    <?php if (!empty($errMSG)): ?>
                        <div class="form-group">
                            <div class="alert alert-danger">
                                <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Поле для email -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="email" name="email" class="form-control" placeholder="Ваш Email" value="<?php echo $email; ?>" maxlength="40" required>
                        </div>
                        <span class="text-danger"><?php echo $emailError; ?></span>
                    </div>

                    <!-- Поле для пароля -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name="pass" class="form-control" placeholder="Ваш пароль" maxlength="15" required>
                        </div>
                        <span class="text-danger"><?php echo $passError; ?></span>
                    </div>

                    <div class="form-group">
                        <hr>
                    </div>

                    <!-- Кнопка входа -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary" name="btn-login">Войти</button>
                    </div>

                    <div class="form-group">
                        <hr>
                    </div>

                    <!-- Ссылка на регистрацию -->
                    <div class="form-group">
                        <a href="registration.php">Регистрация</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </body>
    </html>
<?php ob_end_flush(); ?>