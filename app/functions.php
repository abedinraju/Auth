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


      /**
       * Value Check
       */
  
         function valueCheck($table,$column,$value){
         global $connection;

         $sql ="SELECT $column FROM $table WHERE $column='$value'";
         $data = $connection -> query($sql);
         return $data -> num_rows;
      }

?>