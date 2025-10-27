<?php
$log_file = 'log.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['text'])) {
    $text = trim($_POST['text']);

    if ($text !== '') {
        $date = date('Y-m-d H:i:s');
        $entry = "[$date] $text" . PHP_EOL;

        file_put_contents($log_file, $entry, FILE_APPEND | LOCK_EX);
    }
}

$log_content = file_exists($log_file) ? file_get_contents($log_file) : 'Лог пока пуст.';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Содержимое log.txt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px auto;
            width: 600px;
        }
        a {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #007BFF;
        }
        .log {
            margin-top: 10px;
            background: #f9f9f9;
            border: 1px solid #ccc;
            padding: 15px;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
<a href="index.html">&larr; Назад</a>
<h1>Содержимое log.txt</h1>

<div class="log">
    <?= nl2br(htmlspecialchars($log_content)) ?>
</div>
</body>
</html>
