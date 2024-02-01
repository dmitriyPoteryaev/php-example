<?php
   function filteredFilesArray($files)
   {

       $FIRST_PATH_TO_ANOTHER_DIR =  0;

       $SECOND_PATH_TO_ANOTHER_DIR = 1;

       $EMPTY_ARRAY = [];

       $i = 0;

       foreach ($files as $file) {

           if ($i != $FIRST_PATH_TO_ANOTHER_DIR && $i != $SECOND_PATH_TO_ANOTHER_DIR) {

               array_push($EMPTY_ARRAY, $file);
           }

           $i++;
       }

       return $EMPTY_ARRAY;
   }

?>