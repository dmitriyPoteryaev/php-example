<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $files = scandir("/var/www/html/uploads");

    function filterFilesArray($files)
    {

        $FIRST_PATH_TO_ANOTHER_DIR =  0;

        $SECOND_PATH_TO_ANOTHER_DIR = 1;

        $EMPTY_ARRAY = [];

        $i = 0;

        foreach ($files as $file) {

            if ($i != $FIRST_PATH_TO_ANOTHER_DIR && $i != $SECOND_PATH_TO_ANOTHER_DIR) {

                array_push($EMPTY_ARRAY, $file);
            }

            $i++;
        }

        return $EMPTY_ARRAY;
    }

    echo "<script> const  ArraySeverFiles = " . json_encode(filterFilesArray($files)). ";</script>";

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
        if(count(filterFilesArray($files)) == 0){

        echo "На сервере не имеется файлов <br>";

        } else{
            echo ' <select name="files" id="files">';

            foreach (filterFilesArray($files) as $file) {

           echo '<option value="' . $file .'">' . $file . '</option>';

            }
          
            echo  '</select>';

        }

         ?>
        </form>
        <script>
            console.log(ArraySeverFiles);
            let save_button = document.getElementById("upload_btn");

            if (ArraySeverFiles.length === 0) {

                save_button.disabled = true;
            }
        </script>
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

        function uploadFile()
        {

    
            $basedir = '/var/www/html/uploads/';
         
            if(isset($_POST["save"])){

                $name = $_FILES["filename"]["name"];

                $path_info = pathinfo("/var/www/html/uploads/" . $name);
    
                $file_extension = $path_info['extension'];
    
                if ($file_extension != "md") {
    
                    echo "Type file $file_extension! Choose other file!  <br/>";
    
                    return;
                }
    

                $savefile = $basedir . basename($name);

                move_uploaded_file($_FILES["filename"]["tmp_name"], $savefile);

                return;

            }

            if(isset($_POST["upload"])){

  //  скачиваем файл с серера

             $selectedFiles = $_POST["files"];

             $uploadfile = $basedir . $selectedFiles;

             header("Content-Disposition: attachment; filename=$selectedFiles");

             header('Content-Type: text/plain');
             readfile($uploadfile);

             return;

            }

        }


        // switch ($size_file) {
        //     case $size_file >= $MAX_FILE_SIZE:
        //         uploadFile();
        //         echo "Size file more then 30000 byte! It's so big file! Choose other file! <br/> ";
        //         break;
        //     default:
                uploadFile();
        // }
    }
}

?>