<?php

    require_once('variable_library.php');
    require_once('Encoding.php');
    use \ForceUTF8\Encoding;

    function swivelNeckFunc($val, &$output)
    {
        global $blankRows;
        $swivelNecks = array_map('trim', explode(',', $val));
        $first = array_shift($swivelNecks);
        $output .= ',"' . $first . '"';

        if(!empty($blankRows) && !empty($swivelNecks))
        {
            foreach($blankRows as $row)
            {
                if(!isset($row->neck_movement) || empty($swivelNecks))
                {
                    continue;
                }
                else{
                    $row->neck_movement = array_shift($swivelNecks);
                }
            }
        }
        else
        {
            while(!empty($swivelNecks)) {
                $newRow = new Magento_Product(get_magento_fields(), false);
                $newRow->neck_movement = array_shift($swivelNecks);
                array_push($blankRows, $newRow);
            }

        }

    }

    function addProductToNewLine($magento_products, &$output){
        global $blankRows;
        foreach($magento_products as $magento_product){

            $i = 0;
            foreach($magento_product as $attr => $val){

                if($attr == '_links_related_sku' && $val != '') {
                    $output .= ',';
//                    $new_line .= add_sku_to_line($val);
                    continue;
                }

                if($attr == 'neck_movement' && $val != '') {
//                    $output .= ',';
                    swivelNeckFunc($val, $output);
                    continue;
                }

                if(($attr == 'description' || $attr == 'short_description') && $val == '')
                {
                    $output .= ',"No Description available."';
                    continue;
                }

                if($i == 0){
                    $output .= '"' . trim($val) . '"';
                }
                else{
                    $output .= ',"' . trim($val) . '"';
                }

                //can put the magento product class inside the magento product class if there is more than one occurence of something or a related product.


                $i=1;

            }
            $output .= "\n";

            if(isset($blankRows))
            {
                foreach($blankRows as $magento_product)
                {
                    $i = 0;
                    foreach($magento_product as $attr => $val){

                        if($i == 0){
                            $output .= '"' . trim($val) . '"';
                        }
                        else{
                            $output .= ',"' . trim($val) . '"';
                        }
                        $i=1;

                    }
                    $output .= "\n";
                }
                $blankRows = array();
            }

            //foreach new_line, add new_line to output

        }

    }

    function decodeIncludedProducts($incP){
        $output = array();
        $incP = html_entity_decode(Encoding::toUTF8($incP));
        $productsNOptions = explode(';', $incP);
        foreach($productsNOptions as $key => $product){
            $token = strtok($product, ':');
            $fieldName = $token;
            $token = strtok(':');
            $output[$fieldName] = str_replace("&amp;#039", "&#039;", htmlentities($token));

        }
        return $output;
    }

    function mapIncludedProducts(&$product, $field_value)
    {
        $incProducts = decodeIncludedProducts($field_value);
        foreach($incProducts as $key => $val)
        {
            switch($key)
            {
                case 'carpet':
                    $product->inc_p_carpet_tool = $val;
                    break;

                case 'floor':
                    $product->inc_p_floor_tool = $val;
                    break;

                case 'dust':
                    $product->inc_p_dusting_brush = $val;
                    break;

                case 'uptool':
                    $product->inc_p_upholstery_tool = $val;
                    break;

                case 'crevtool':
                    $product->inc_p_crevice_tool = $val;
                    break;

                case 'wand':
                    $product->inc_p_wand = $val;
                    break;

                case 'hose':
                    $product->inc_p_hose = $val;
                    break;

                case 'hosecap':
                    $product->inc_p_hygiene_cap = $val;
                    break;

                case 'bags':
                    $product->inc_p_bags = $val;
                    break;

                case 'motorfilter':
                    $product->inc_p_motor_filter = $val;
                    break;

                case 'microfilter':
                    $product->inc_p_micro_filter = $val;
                    break;

                case 'microstrip':
                    $product->inc_p_micro_strip = $val;
                    break;

                case 'other':
                    $product->inc_p_misc = $val;
                    break;
            }
        }
//        $product->inc_p_carpet_tool = $incProducts['carpet'];
//        $product->inc_p_floor_tool = $incProducts['floor'];
//        $product->inc_p_dusting_brush = $incProducts['dust'];
//        $product->inc_p_upholstery_tool = $incProducts['uptool'];
//        $product->inc_p_crevice_tool = $incProducts['crevtool'];
//        $product->inc_p_wand = $incProducts['wand'];
//        $product->inc_p_hose = $incProducts['hose'];
//        $product->inc_p_hygiene_cap = $incProducts['hosecap'];
//        $product->inc_p_bags = $incProducts['bags'];
//        $product->inc_p_motor_filter = $incProducts['motorfilter'];
//        $product->inc_p_micro_filter = $incProducts['microfilter'];
//        $product->inc_p_micro_strip = $incProducts['microstrip'];
//        $product->inc_p_misc = $incProducts['other'];
    }

function get_all($cat_type, $specs){
    global $db;
    global $allUnitSpecs;
    global ${$specs};
    $currentSpecs = ${$specs};
    $units                = array();
    $all_sql_specs              = implode(',', $allUnitSpecs);
    if(!empty($currentSpecs)) $custom_sql_specs = implode(',', $currentSpecs);

        $sql = "SELECT ". $all_sql_specs . (isset($custom_sql_specs) ? "," . $custom_sql_specs : '') ." FROM products WHERE _attribute_set = '{$cat_type}'";
        $result = $db->query($sql);

//        for($i = 0; $i < 10; $i++){
//
//            $row = mysqli_fetch_assoc($result);
//            $powerUnit                  = new PowerUnit($row);
//            array_push($power_units, $powerUnit);
//
//        }

        while($row = mysqli_fetch_assoc($result)){
            $unit                  = new Db_object($row, $cat_type);
            array_push($units, $unit);
        }

        return($units);

    }

    function get_magento_fields (){

        $handle = fopen("includes/magento-exports/catalog_product_20160422_214104.csv", "r");
        $headers = fgets($handle);
        fclose($handle);
        $headers = str_replace(',cost', '', $headers);
        $magento_fields = explode(",", trim(str_replace('"', '', $headers)));

        clearstatcache();

        return $magento_fields;

    }

    function set_magento_products($units, $magento_fields){

        $magento_products = array();

        foreach($units as $unit){

            $product = new Magento_Product($magento_fields, true);

            foreach($unit as $attr => $val){
            if($attr == 'includedProducts')
            {
                if ($val != null){
                    mapIncludedProducts($product, $val);
                }
                    continue;

            }
            if($attr == 'scraped')
            {
                if($val == 1)
                {
                    $product->$attr = 'Yes';
                }
                else{
                    $product->$attr = 'No';
                }
                continue;
            }
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

        addProductToNewLine($magento_products, $output);

        return $output;
    }

    function create_magento_file($magento_file_text, $name_of_file)
    {
        $file = fopen("includes/magento-generated-imports/{$name_of_file}", "w");
        fwrite($file, $magento_file_text);
        fclose($file);
        echo 'Import file created.' . '<br/>';
    }


?>