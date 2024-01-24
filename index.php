<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>AKYTEC</title>
        <meta charset="utf-8" />
    </head>

    <body>
        <h2>Загрузка файла</h2>
        <form method="post" enctype="multipart/form-data">
            Выберите файл: <input type="file" name="filename" /><br /><br />
            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
            <input type="submit" value="Загрузить" />
        </form>

    </body>

    </html>

<?php
};
?>

<?php

// Если это GET-запрос или были ошибки при обработке файла, выводим форму
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['filename'])) {
        // Обработка POST-запроса с файлом

        $size_file = $_FILES['filename']['size'];

        $MAX_FILE_SIZE = 30000;

        $MIN_FILE_SIZE = 10000;

        $full_file_type = $_FILES['filename']['type'];

        $specific_file_type = strstr($full_file_type, "/", true);

        function uploadFile() {

            $full_file_type = $_FILES['filename']['type'];
    
            $specific_file_type = strstr($full_file_type, "/", true);
    
            if($specific_file_type != "text") {
    
                echo "Type file isn't text! Choose other file! <br/> ";
    
                return;
            }
    
            $name = $_FILES["filename"]["name"];
    
            move_uploaded_file($_FILES["filename"]["tmp_name"], $name);
    
            //  скачиваем файл с серера
    
            header("Content-Disposition: attachment; filename=$name");
    
            header('Content-Type: text/plain');
    
            readfile($name);
        }


        switch ($size_file) {
            case $size_file >= $MAX_FILE_SIZE:
                echo "Size file more then 30000 byte! It's so big file! Choose other file! <br/> ";
                break;
            default:
                uploadFile();
        }


    }

}

?>