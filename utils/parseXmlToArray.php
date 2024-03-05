<?php

// goes through all xml-file and return array of arrays. In each such array there are four values -
// vendor code, price, full  name, category


$cur_category = "";
$cur_full_name = "";

function parseXmlToArray($cur_xml) {

  global $arrayWithRows;

  $arrayWithRows = [];

function getArray($xml){

global $cur_category;
global $cur_full_name;
global $arrayWithRows;

foreach ($xml as $child) {


  if($child->getName() == "name" && $child->xpath("..")[0]->getName() == "category"){ 

    $cur_category = $child;
  
  }



  if($child->getName() == "name" && $child->xpath("..")[0]->getName() == "product"){

    $cur_full_name = $child;
  
  }


  if($child->getName() == "price" && $child->xpath("..")[0]->getName() == "prices" && $child->xpath("../..")[0]->getName() == "product"){

    $local_array = [$child->name, $child->price, $cur_full_name, $cur_category];

    array_push($arrayWithRows, $local_array);
 
  }

  if(is_array((array) $child[0])){

    getArray($child);

  }

}

}

getArray($cur_xml);

return $arrayWithRows;

}

?>