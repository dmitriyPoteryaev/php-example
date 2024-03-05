<?php

// Если это GET-запрос или были ошибки при обработке файла, выводим форму
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['filename'])) {
        // Обработка POST-запроса с файлом

       

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

include "./utils/filteredFilesArray.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $files = scandir("/var/www/html/uploads");

    $filteredFiles =  filteredFilesArray($files);

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>AKYTEC</title>
        <meta charset="utf-8" />
        <script defer src="js/script.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <main class="main">
        <div class="wrapper_form">
        <h2> Upload or save file on server </h2>
        <form class="form" method="post" enctype="multipart/form-data">
            <label class="save">
            <input type="file" name="filename" />
            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
            <button id="save_btn" name="save">Save on server</button>
            </label>
            <label class="upload">
            <?php

             $js_filteredFilesArray = json_encode(filteredFilesArray($files));

            if (count(filteredFilesArray($files)) == 0) {

                  echo "<script> const  ArraySeverFiles = " . $js_filteredFilesArray . ";</script>";

                echo "На сервере не имеется файлов <br>";
            } else {

                echo "<script> const  ArraySeverFiles = " . $js_filteredFilesArray . ";</script>";

                echo ' <select name="files" id="files">';

                foreach (filteredFilesArray($files) as $file) {

                    echo '<option value="' . $file . '">' . $file . '</option>';
                }

                echo  '</select>';
            }

            ?>
            <button id="upload_btn" name="upload">Upload from server</button>

            </label>
        </form>
        </div>
        </main>
        <script>
            const saveButton = document.getElementById("upload_btn");

            if (ArraySeverFiles.length === 0) {

                saveButton.disabled = true;
            }
        </script>
    </body>

    </html>

<?php
};
?>