<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результат обработки</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);

    if (!empty($firstName) && !empty($lastName)) {
        if (preg_match('/^[a-zA-Zа-яА-ЯёЁ\s\-]+$/u', $firstName) && preg_match('/^[a-zA-Zа-яА-ЯёЁ\s\-]+$/u', $lastName)) {
            echo "<h1>Добро пожаловать, " . htmlspecialchars($firstName) . " " . htmlspecialchars($lastName) . "!</h1>";
        } else {
            echo "<h1>Ошибка: Имя и фамилия должны содержать только буквы, пробелы и дефисы.</h1>";
        }
    } else {
        echo "<h1>Ошибка: Пожалуйста, заполните все поля.</h1>";
    }
} else {
    echo "<h1>Ошибка: Данные не были отправлены. Пожалуйста, заполните <a href='form.html'>форму</a>.</h1>";
}
?>

</body>
</html>