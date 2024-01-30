<?php

include "checkFileExtension.php";

function saveFile($tmpFile, $name) {


    $basedir = '/var/www/html/uploads/';

    if (!$name) {
        echo '<script type="text/javascript">'; 
        echo 'window.location.href = document.referrer;
              alert("You don\'t choose file for save on server. Please try again!")';
        echo '</script>';

        return;
    }


    $IsTextExtensionFile =  checkFileExtension($name);

    if (!$IsTextExtensionFile) {

        echo '<script type="text/javascript">'; 
        echo 'window.location.href = document.referrer;
              alert("Choose other file!")';
        echo '</script>';

        return;
    }

    $saved_file = $basedir . basename($name);

    move_uploaded_file($tmpFile, $saved_file);


    echo '<script type="text/javascript">'; 
    echo 'window.location.href = document.referrer;
          alert("Congratulations! File added!")';
    echo '</script>';

}

?>