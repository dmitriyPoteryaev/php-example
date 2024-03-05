<?php
       //  download CSV-file from server

       function downloadCSVfile($selectedFiles) {

        include "getCSVfile.php";

        $basedir = '/var/www/html/csvFiles/';

        if (!$selectedFiles) {
            echo '<script type="text/javascript">';
            echo 'window.location.href = document.referrer;
                  alert("You don\'t choose file for upload. Please try again!")';
            echo '</script>';
 
            return;
        }

        // create CSV-file and put to csvFiles folder

         getCSVfile($selectedFiles);

         $nameCSVfile = strstr($selectedFiles, '.', true);

        //  download csv-file
 
         $uploadfile = $basedir . $nameCSVfile . ".csv";
 
         header("Content-Disposition: attachment; filename=$nameCSVfile.csv");
 
         header('Content-Type: text/plain');
 
         readfile($uploadfile);
 
        return;


       }

?>