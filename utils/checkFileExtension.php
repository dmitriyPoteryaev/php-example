<?php

// check file extension 

function checkFileExtension($name){

    $textExtensions = array("xml");

    $path_info = pathinfo("/var/www/html/save/" . $name);

    $file_extension = $path_info['extension'];

    return in_array($file_extension, $textExtensions);
}
?>
