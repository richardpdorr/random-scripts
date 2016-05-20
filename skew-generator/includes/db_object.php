<?php
    //require_once("var_lib.php");

    Class Db_object {

        public function __construct($ary, $category){
            foreach($ary as $new_vars => $val){
                $this->$new_vars = $val;
            }
            $this->class_type = $category;
        }


    }

?>