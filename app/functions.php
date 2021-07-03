<?php 

/**
 * validation message
 */
 function validationMsg($msg, $type ='danger'){

    return '<p class="alert alert-'. $type .'"> '. $msg .' ! <button class="close"data-dismiss="alert">&times;</button></p>';
 }



 /**
  * Data Base Control(Insert)
  */
      function insert($sql){

         global $connection;
         $connection -> query($sql);
      }
  

?>