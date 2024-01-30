<?php

// Если это GET-запрос или были ошибки при обработке файла, выводим форму
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['filename'])) {
        // Обработка POST-запроса с файлом

        $size_file = $_FILES['filename']['size'];

        $MAX_FILE_SIZE = 30000;

        $MIN_FILE_SIZE = 10000;

       

            if (isset($_POST["save"])) {

                include "./utils/saveFile.php";

                $name = $_FILES["filename"]["name"];

                $tmp_name = $_FILES["filename"]["tmp_name"];

                saveFile($tmp_name, $name);
            }

            if (isset($_POST["upload"])) {

                include "./utils/uploadFile.php";

                //  upload file from server

                $selectedFile = $_POST["files"];

                uploadFile($selectedFile);
            }
        }


}

?>


<?php

include "./utils/filterfilesArray.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $files = scandir("/var/www/html/uploads");

    $filteredFiles =  filterFilesArray($files);

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>AKYTEC</title>
        <meta charset="utf-8" />
    </head>

    <body>
        <h2>Загрузка файла или сохранение файла</h2>
        <form method="post" enctype="multipart/form-data">
            Выберите файл: <input type="file" name="filename" /><br /><br />
            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
            <input id="upload_btn" name="upload" type="submit" value="Выгрузить с сервера" />
            <input id="save_btn" name="save" type="submit" value="Сохранить на сервер" />
            <?php
            if (count(filterFilesArray($files)) == 0) {

                echo "<script> const  ArraySeverFiles =  [];</script>";

                echo "На сервере не имеется файлов <br>";
            } else {

                echo "<script> const  ArraySeverFiles = " . json_encode(filterFilesArray($files)) . ";</script>";

                echo ' <select name="files" id="files">';

                foreach (filterFilesArray($files) as $file) {

                    echo '<option value="' . $file . '">' . $file . '</option>';
                }

                echo  '</select>';
            }

            ?>
        </form>
        <script>
            const save_button = document.getElementById("upload_btn");

            if (ArraySeverFiles.length === 0) {

                save_button.disabled = true;
            }
        </script>
    </body>

    </html>

<?php
};
?>