<?php
class Bag extends Product{

    public $relatedVacuums = array();

    function __construct(){
        $this->productType = 'Bags';
    }

}

?>