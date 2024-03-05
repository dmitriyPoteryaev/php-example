<?php

include "checkFileExtension.php";

function saveFile($tmpFile, $name) {


    $basedir = '/var/www/html/save/';

//    if file didn't choose than return to form
    if (!$name) {
        echo '<script type="text/javascript">'; 
        echo 'window.location.href = document.referrer;
              alert("You don\'t choose file for save on server. Please try again!")';
        echo '</script>';

        return;
    }
    //    if there is already such name of file on server then return to form

    $array_files = scandir($basedir);

    if (in_array($name, $array_files)) {
        echo '<script type="text/javascript">'; 
        echo 'window.location.href = document.referrer;
              alert("There is already file with this name. Please try again!")';
        echo '</script>';

        return;
    }

    // if format of file isn't xml than  return to form

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