<?php
$uploadDir = __DIR__ . '/uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$files = array_diff(scandir($uploadDir), ['.', '..']);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список файлов</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px auto;
            width: 700px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px 10px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .empty {
            text-align: center;
            color: #666;
            margin-top: 30px;
        }
    </style>
</head>
<body>
<h1>Список файлов в папке uploads</h1>

<?php if (empty($files)): ?>
    <p class="empty">Папка пуста. Загрузите хотя бы один файл.</p>
<?php else: ?>
    <table>
        <tr>
            <th>Имя файла</th>
            <th>Размер</th>
            <th>Дата изменения</th>
            <th>Скачать</th>
        </tr>
        <?php foreach ($files as $file):
            $filePath = $uploadDir . $file;
            $fileUrl = 'uploads/' . rawurlencode($file);
            $sizeKb = round(filesize($filePath) / 1024, 2);
            $modified = date('Y-m-d H:i:s', filemtime($filePath));
            ?>
            <tr>
                <td><?= htmlspecialchars($file) ?></td>
                <td><?= $sizeKb ?> KB</td>
                <td><?= $modified ?></td>
                <td><a href="<?= $fileUrl ?>" download>Скачать</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
</body>
</html>