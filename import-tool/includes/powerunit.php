<?php
    //require_once("var_lib.php");

    Class PowerUnit {

        public function __construct($ary){
            foreach($ary as $new_vars => $val){
                $this->$new_vars = $val;
            }
        }


    }

?>