<?php

    function getAllScrapedIds(){
        global $db;

        $sql = 'SELECT ID FROM products WHERE scraped = 1';
        $result = $db->query($sql);

        $i = 0;
        $output = array();
        while($row = mysqli_fetch_row($result)){

            array_push($output, $row[0]);
        }

        return $output;

    }

    function create_csv_file($allProducts){

        $output             = '"sku","_links_crosssell_sku"';

        foreach($allProducts as $product)
        {
            if(!empty($product->relatedProductsSkus)){
                $output .= "\n" . '"' . $product->sku . '"';
                $count = 0;
                foreach($product->relatedProductsSkus as $relatedProduct){
                    if($count == 0)
                    {
                        $output .= ',"' . $relatedProduct . '"';
                        $count++;
                    }
                    else{
                        $output .= "\n" . '""' . ',"' . $relatedProduct . '"';
                    }
                }
            }
            else{
                continue;
            }
        }

        return $output;
    }

    function create_magento_file($magento_file_text, $name_of_file)
    {
        $file = fopen("{$name_of_file}", "w");
        fwrite($file, $magento_file_text);
        fclose($file);
        echo 'Import file created.' . '<br/>';
    }


?>