<?php


// проходит весь xml файл и на выходе создаёт массив из массивов. В каждом таком массиве имеется 4 значения - 
// Артиккул, цена, полное имя, категория
// возвращает ма

$array = [];
$cur_category = "";
$cur_full_name = "";

function parseXmlToArray($cur_xml) {

  global $array;

  $array = [];

function getArray($xml){

global $cur_category;
global $cur_full_name;
global $array;

foreach ($xml as $child) {


  if($child->getName() == "name" && $child->xpath("..")[0]->getName() == "category"){ 

    $cur_category = $child;
  
  }



  if($child->getName() == "name" && $child->xpath("..")[0]->getName() == "product"){

    $cur_full_name = $child;
  
  }


  if($child->getName() == "price" && $child->xpath("..")[0]->getName() == "prices" && $child->xpath("../..")[0]->getName() == "product"){

    $local_array = [$child->name, $child->price, $cur_full_name, $cur_category];

    array_push($array, $local_array);
 
  }

  if(is_array((array) $child[0])){

    getArray($child);

  }

}

}

getArray($cur_xml);

return $array;

}

?>