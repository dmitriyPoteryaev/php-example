<?php

// check file extension 

function checkFileExtension($xmlName){

    $extension = strstr($xmlName, '.', false);

   return  $extension == '.xml';
     
}
?>
