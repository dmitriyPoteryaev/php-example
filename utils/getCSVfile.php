<?php

function getCSVfile() {


include "parseXmlToArray.php";

$pathXmlFile = '/var/www/html/utils/' . 'catalog.xml';

$categories = simplexml_load_file($pathXmlFile);

// var_dump($categories->categories);

$array = parseXmlToArray($categories->categories);


//  Перевеводим массив array в csv-файл

// Названия столбцов
$columns = ['Артикул', 'Цена', 'Полное имя', 'Имя группы'];


// Путь к файлу CSV

$filePath = '/var/www/html/uploads/' . 'data.csv';

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

getCSVfile();
?>