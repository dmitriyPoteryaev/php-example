<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['filename'])) {

        // Save xml file or download csv file

        if (isset($_POST["save"])) {

            include "./utils/saveFile.php";

            $name = $_FILES["filename"]["name"];

            $tmp_name = $_FILES["filename"]["tmp_name"];

            //  save xml file

            saveFile($tmp_name, $name);
        }

        if (isset($_POST["download"])) {

            include "./utils/downloadCSVfile.php";

            //  download csv-file from server

            $selectedFile = $_POST["files"];

            downloadCSVfile($selectedFile);
        }
    }
}

?>

<?php

include "./utils/filteredFilesArray.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $files = scandir("/var/www/html/save");

    $filteredFiles =  filteredFilesArray($files);

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>AKYTEC</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <main class="main">
            <div class="wrapper_form">
                <h2> Save xml-file on server and convert to csv-file</h2>
                <form class="form" method="post" enctype="multipart/form-data">
                    <label class="save">
                        <input type="file" name="filename" />
                        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                        <button id="save_btn" name="save">Save on server</button>
                    </label>
                    <label class="download">
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
                        <button id="download_btn" name="download">Download from server</button>

                    </label>
                </form>
            </div>
        </main> 
        <script>

            // TO-DO - можно ли этот кусок сркипта перенести в отдельный файл?
            const downloadButton = document.getElementById("download_btn");

            if (ArraySeverFiles.length === 0) {

                downloadButton.disabled = true;
            }
        </script>


    </body>

    </html>

<?php
};
?>