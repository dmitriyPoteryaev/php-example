<?php

    
include "parseXmlToArray.php";
include "checkFileExtension.php";

class State{

    public $error = "";

   private $phpFileUploadErrors = array(
        0 => '',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    );


    function createCSV($xmlName, $tmlXmlFile){

        $numberError = $_FILES['filename']['error'];

        if($this->phpFileUploadErrors[$numberError] ){

            $this->error = $this->phpFileUploadErrors[$numberError];

            return;
        }
    
        // if format of file isn't xml than  return to form
    
         $IsTextExtensionFile =  checkFileExtension($xmlName);
    
        if (!$IsTextExtensionFile) {

            $this->error = "Choose other file!";


            return;
        }

$categories = simplexml_load_file($tmlXmlFile);


$array = parseXmlToArray($categories->categories);


// //  Convert array with rows to CSV-file

// // Name of columns
$columns = ['Артикул', 'Цена', 'Полное имя', 'Имя группы'];

array_unshift($array, $columns);


 header('Content-Type: text/csv');
 header('Content-Disposition: attachment; filename="catalog.csv"');


$output = fopen('php://output', 'w');

foreach ($array as $row) {
    fputcsv($output, $row);
}

fclose($output);


return;


    }


};
?>