<?php
       //  upload file from server

       function uploadFile($selectedFiles) {

        include "getCSVfile.php";

        $basedir = '/var/www/html/uploads/';


        echo $selectedFiles;

        if (!$selectedFiles) {
            echo '<script type="text/javascript">';
            echo 'window.location.href = document.referrer;
                  alert("You don\'t choose file for upload. Please try again!")';
            echo '</script>';
 
            return;
        }

         getCSVfile();
 
        //  $uploadfile = $basedir . "data.csv";
 
        //  header("Content-Disposition: attachment; filename=$selectedFiles");
 
        //  header('Content-Type: text/plain');
 
        //  readfile($uploadfile);
 
        return;


       }

?>