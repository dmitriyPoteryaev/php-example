<?php



function getCSVfile($nameXMLfile) {

include "parseXmlToArray.php";

$pathXmlFile = '/var/www/html/save/' . $nameXMLfile;

$categories = simplexml_load_file($pathXmlFile);


$array = parseXmlToArray($categories->categories);


//  Convert array with rows to CSV-file

// Name of columns
$columns = ['Артикул', 'Цена', 'Полное имя', 'Имя группы'];



$nameCSVfile = strstr($nameXMLfile, '.', true);

// path to CSV-file
$filePath = '/var/www/html/csvFiles/' . $nameCSVfile . '.csv';

// Open file for writing 
$file = fopen($filePath, 'w');

// Writing headers columns

 fputcsv($file, $columns);

//  ЗWriting data

  foreach ($array as $row) {
 
  fputcsv($file, $row);

  }

// Close file

 fclose($file);

}
?>