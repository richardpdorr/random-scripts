<?php
    class Filter extends Product{

        public $relatedVacuums = array();

        function __construct(){
            $this->productType = 'Filters';
        }

    }

?>