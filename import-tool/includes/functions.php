<?php

    require_once('var_lib.php');



    function get_all_power_units(){
        global $db;
        global $allUnitSpecs;
        global $powerUnitSpecs;
        $power_units                = array();
        $all_sql_specs              = implode(',', $allUnitSpecs);
        $custom_sql_specs           = implode(',', $powerUnitSpecs);

        $sql = "SELECT ". /*$all_sql_specs . "," .*/ $custom_sql_specs ." FROM products WHERE attribute_set = 'Power Unit'";
        $result = $db->query($sql);

        for($i = 0; $i < 10; $i++){

            $row = mysqli_fetch_assoc($result);
            $powerUnit                  = new PowerUnit($row);
            array_push($power_units, $powerUnit);

        }

//        while($row = mysqli_fetch_assoc($result)){
//            $powerUnit                  = new PowerUnit($row);
//            array_push($power_units, $powerUnit);
//        }

        return($power_units);

    }

    function get_magento_fields (){

        $handle = fopen("includes/magento-exports/export_all_products.csv", "r");
        $headers = fgets($handle);
        fclose($handle);
        $magento_fields = explode(",", trim(str_replace('"', '', $headers)));

        clearstatcache();

        return $magento_fields;

    }

    function set_magento_products($power_units, $magento_fields){

        $magento_products = array();

        foreach($power_units as $power_unit){

            $product = new Magento_Product($magento_fields);

            foreach($power_unit as $attr => $val){

            if(in_array($attr, $magento_fields))
            {
                $product->$attr = $val;
            }
            else{
                echo 'The attr ' . $attr . ' is not indexed in the Magento class. <br>';
            }

            }

            $product->product_name = $product->name;

            array_push($magento_products, $product);
        }

        return $magento_products;
    }

    function create_magento_file_txt_mapped($magento_products){

        $output             = null;
        $headers            = array_keys(get_object_vars($magento_products[0]));

        foreach($headers as $key => $val)
        {
            if($key == 0){
                $output .= '"' . $val . '"';
                continue;
            }
            else{
                $output .= ',"' . $val . '"';
            }

        }
        $output .= "\n";

        foreach($magento_products as $magento_product){

            $i = 0;
            foreach($magento_product as $attr => $val){

                if($i == 0){
                    $output .= '"' . trim($val) . '"';
                    $i++;
                    continue;
                }
                else{
                    $output .= ',"' . trim($val) . '"';
                }
                $i++;
            }
            $output .= "\n";

        }

        return $output;
    }

    function create_magento_file($magento_file_text)
    {
        $file = fopen("includes/magento-generated-imports/import-file.csv", "w");
        fwrite($file, $magento_file_text);
        fclose($file);
        echo 'Import file created.';
    }


?>