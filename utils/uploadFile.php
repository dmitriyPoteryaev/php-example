<?php
       //  upload file from server

       function uploadFile($selectedFiles) {

        $basedir = '/var/www/html/uploads/';


        if (!$selectedFiles) {
            echo '<script type="text/javascript">';
            echo 'window.location.href = document.referrer;
                  alert("You don\'t choose file for upload. Please try again!")';
            echo '</script>';
 
            return;
        }
 
        $uploadfile = $basedir . $selectedFiles;
 
        header("Content-Disposition: attachment; filename=$selectedFiles");
 
        header('Content-Type: text/plain');
 
        readfile($uploadfile);
 
        return;


       }

?>