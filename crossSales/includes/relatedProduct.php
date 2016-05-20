<?php

    class RelatedProduct{

        public $sku;
        public $relatedProductsSkus = array();

        public function __construct($str1, $str2){

            $this->relatedProductsSkus = explode(',', $str1);
            $this->sku = trim($str2);


        }

        public function removeScrapedProducts($scraped){

            foreach($this->relatedProductsSkus as $key => $internalID){

                if(in_array($internalID, $scraped)){

                    unset($this->relatedProductsSkus[$key]);

                }

            }

            $this->relatedProductsSkus = array_values($this->relatedProductsSkus);

            if(isset($this->relatedProductsSkus[0]) && $this->relatedProductsSkus[0] == ''){

                $this->relatedProductsSkus = array();

            }


        }

        public function setRelatedProducts(){
            global $db;

            $sql = "SELECT sku FROM  `products` WHERE  `ID` IN (".implode(',', $this->relatedProductsSkus).")";
            $result = $db->query($sql);
            $this->relatedProductsSkus = array();
            if($result) {
                while ($row = mysqli_fetch_row($result)) {

                    if($row[0] != '') array_push($this->relatedProductsSkus, trim($row[0]));

                }
            }
            else{
                var_dump($this->relatedProductsSkus);
                echo $sql . "\n";
            }

        }



    }

?>