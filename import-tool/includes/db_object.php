<?php
    //require_once("variable_library.php");

    Class Db_object {

        public function __construct($ary){
            foreach($ary as $new_vars => $val){
                ($new_vars == 'compatibleProducts') ? $this->_links_related_sku = $val : $this->$new_vars = $val;
            }
        }


    }

?>