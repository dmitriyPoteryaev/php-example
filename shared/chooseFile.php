<?php

function chooseFile() {

    if (count(filteredFilesArray($files)) == 0) {

        echo "<script> const  ArraySeverFiles =  [];</script>";
    
        echo "На сервере не имеется файлов <br>";
    } else {
    
        $js_filteredFilesArray = json_encode(filteredFilesArray($files));
    
        echo "<script> const  ArraySeverFiles = " . $js_filteredFilesArray . ";</script>";
    
        echo ' <select name="files" id="files">';
    
        foreach (filteredFilesArray($files) as $file) {
    
            echo '<option value="' . $file . '">' . $file . '</option>';
        }
    
        echo  '</select>';
    }

}
