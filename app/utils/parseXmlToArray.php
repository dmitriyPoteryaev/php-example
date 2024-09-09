<?php

// goes through all xml-file and return array of arrays. In each such array there are four values -
// vendor code, price, full  name, category


function parseXmlToArray($cur_xml)  {

  $arrayWithRows = [];
  $cur_category = "";
  $cur_full_name = "";

  function getArray($xml, $cur_category, $cur_full_name, &$arrayWithRows) {

    foreach ($xml as $child) {

      $cur_tag_name = $child->getName();

      $cur_path = $child->xpath("..")[0]->getName();

      if ($cur_tag_name == "name" && $cur_path == "category") {

        $cur_category = $child;
      }
      if ($cur_tag_name == "name" && $cur_path == "product") {

        $cur_full_name = $child;
      }
      if ($cur_tag_name == "price" && $cur_path == "prices" && $child->xpath("../..")[0]->getName() == "product") {

        $local_array = [$child->name, $child->price, $cur_full_name, $cur_category];

        array_push($arrayWithRows, $local_array);
      }
      if (is_array((array) $child[0])) {

        getArray($child, $cur_category, $cur_full_name, $arrayWithRows);
      }
    }
  }

  getArray($cur_xml, $cur_category, $cur_full_name, $arrayWithRows);

  return $arrayWithRows;
}

?>