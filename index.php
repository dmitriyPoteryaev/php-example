<!DOCTYPE html>
<html>

<head>
    <title>METANIT.COM</title>
    <meta charset="utf-8" />
</head>

<body>
    <h2>Загрузка файла</h2>
    <form method="post" enctype="multipart/form-data">
        Выберите файл: <input type="file" name="filename" size="10" /><br /><br />
        <input type="submit" value="Загрузить" />
    </form>

</body>

</html>

<?php


if ($_FILES && $_FILES["filename"]["error"] == UPLOAD_ERR_OK) {


    //  сначала перемещаем файл на севрер
    $name = $_FILES["filename"]["name"];

    move_uploaded_file($_FILES["filename"]["tmp_name"], $name);
    echo "Файл загружен";


    //  скачиваем файл с сервера
    header('Content-Type: README/md');


    header('Content-Disposition: attachment; filename="README.md"');


    readfile('README.md');
}
?>