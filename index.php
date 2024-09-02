<?php
// 111
include "./utils/class.php";

$state = new State;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $tmp_name = $_FILES["filename"]["tmp_name"];

            //  save xml file

             $state->createCSV($tmp_name);



} if($_SERVER['REQUEST_METHOD'] === 'GET' || $state->error) {

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
                    <span class="error">
                        <?php
                        echo $state->error;
                        ?>
                    </span>
                </form>
            </div>
        </main> 

    </body>
    </html>

    <?php
};
