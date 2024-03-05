<?php

function getCSVfile($nameXMlfile) {


include "parseXmlToArray.php";

$pathXmlFile = '/var/www/html/save/' . $nameXMlfile;

$categories = simplexml_load_file($pathXmlFile);

// var_dump($categories->categories);

$array = parseXmlToArray($categories->categories);


//  Перевеводим массив array в csv-файл

// Названия столбцов
$columns = ['Артикул', 'Цена', 'Полное имя', 'Имя группы'];


// Путь к файлу CSV

$nameCSVfile = strstr($nameXMlfile, '.', true);

$filePath = '/var/www/html/csvFiles/' . $nameCSVfile . '.csv';

// Открываем файл для записи
$file = fopen($filePath, 'w');
// Записываем заголовки столбцов

 fputcsv($file, $columns);

//  Записываем данные

  foreach ($array as $row) {
 
  fputcsv($file, $row);

  }

// // Закрываем файл
 fclose($file);

}
?>