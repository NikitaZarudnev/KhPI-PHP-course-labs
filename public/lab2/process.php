<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('MAX_FILE_SIZE', 2 * 1024 * 1024);

$allowedExtensions = ['png', 'jpg', 'jpeg'];
$allowedMimeTypes = ['image/png', 'image/jpeg'];

$uploadDir = __DIR__ . '/uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Результат загрузки файла</title>
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
    </style>
</head>
<body>
<a href="index2.html">&larr; Назад</a>
<h2>Результат загрузки</h2>

<?php
if (isset($_FILES['user_file'])) {
    $file = $_FILES['user_file'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo "<p>Ошибка загрузки файла. Код ошибки: {$file['error']}</p>";
        exit;
    }

    if ($file['size'] > MAX_FILE_SIZE) {
        echo "<p>Файл слишком большой. Разрешённый размер — 2 МБ.</p>";
        exit;
    }

    $originalName = $file['name'];
    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowedExtensions, true)) {
        echo "<p>Недопустимое расширение файла. Разрешено: png, jpg, jpeg.</p>";
        exit;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mimeType, $allowedMimeTypes, true)) {
        echo "<p>Недопустимый MIME-тип файла.</p>";
        exit;
    }

    $targetPath = $uploadDir . basename($originalName);

    if (file_exists($targetPath)) {
        $uniqueSuffix = '_' . date('Ymd_His') . '_' . mt_rand(1, 99);
        $baseName = pathinfo($originalName, PATHINFO_FILENAME);
        $newFileName = $baseName . $uniqueSuffix . '.' . $ext;
        $targetPath = $uploadDir . $newFileName;
        echo "<p>Файл с таким именем уже существует. Создано новое имя: <strong>$newFileName</strong></p>";
    } else {
        $newFileName = basename($originalName);
    }

    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        $sizeKb = round($file['size'] / 1024, 2);
        $downloadLink = 'uploads/' . rawurlencode($newFileName);

        echo "<p><strong>Файл успешно загружен!</strong></p>";
        echo "<p>Имя файла: " . htmlspecialchars($newFileName, ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p>MIME-тип: " . htmlspecialchars($mimeType, ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p>Размер: {$sizeKb} KB</p>";
        echo "<p><a href='$downloadLink' download>Скачать файл</a></p>";
    } else {
        echo "<p>Не удалось переместить файл. Проверьте права доступа к каталогу uploads.</p>";
    }
} else {
    echo "<p>Файл не был отправлен. Вернитесь назад и выберите файл.</p>";
}
?>
</body>
</html>