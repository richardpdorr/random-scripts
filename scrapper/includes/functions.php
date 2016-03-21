<?php

    function clearProgress(){

        $myfile = fopen("progress.txt", "w");
        fwrite($myfile, '0');
        fclose($myfile);

    }

    function updateProgress($counter){

        $myfile = fopen("progress.txt", "w");
        $currentPercentage = number_format(($counter->current_item / $counter->max_items), 2);
        fwrite($myfile, $currentPercentage);
        fclose($myfile);


    }

    function fixTrademarks($str)
    {
        return str_replace("'", '', str_replace('&reg;', '', str_replace('&trade;', '', str_replace('&amp;', chr(38),$str))));
    }

    function getInfoFromTags($productType, &$modelNo, &$price){

        switch($productType){

            case 'Hoover':
                $modelNo = str_replace('Model #:', '', $modelNo);
                $price = str_replace('Price: $', '', $price);
                break;

            case 'Dirt Devil':
                $price = str_replace(' $', '', $price);
                break;

            case 'Bissell':
                $price = str_replace('$', '', $price);
                $modelNo = trim(str_replace('Part:', '', $modelNo));

            case 'Bissell Vacuum':
                $modelNo = trim(str_replace('Model Shown: ', '', $modelNo));


            default:
                break;

        }

    }

function getInfoFromTagsVacuum($brand, &$modelNo){

    switch($brand){

        case 'Bissell':
            $modelNo = trim(str_replace('Model Shown: ', '', $modelNo));
            break;


        default:
            break;

    }

}


    function translatePathFunctions($domElement, $pathFunctions){

        foreach($pathFunctions as $nav_dom_translate)
        {
            if($nav_dom_translate == 'plaintext' || $nav_dom_translate == 'href' || $nav_dom_translate == 'src') {

                $domElement = $domElement->$nav_dom_translate;

            }
            else{
                if(strpos($nav_dom_translate, 'children') !== false ) {
                        $number = preg_split('/(children)/', $nav_dom_translate)[1];
                        $nav_dom_translate = preg_split('/\d+/', $nav_dom_translate)[0];
                        $domElement = $domElement->$nav_dom_translate($number);
                }
                else {

                    $domElement = $domElement->$nav_dom_translate();

                }
            }
        }

        return $domElement;

    }

    function getVarsForScrapping($inputVars)
    {
        $scrapInfo = new ScrapTool;
        switch($inputVars){

            case 'Hoover Filters':
                $scrapInfo->baseURL = 'http://hoover.com';
                $scrapInfo->fullHtml = 'http://hoover.com/parts/category/filters/';
                $scrapInfo->nextPagesHtml = 'http://hoover.com/parts/category/filters/?page={$i}';
                $scrapInfo->brand = 'Hoover';
                $scrapInfo->productType = 'Filter';
                $scrapInfo->navBar = 'ol.paging';
                $scrapInfo->navPathFunctions = array('last_child', 'prev_sibling', 'plaintext');
                $scrapInfo->productListItem = 'div.part_list_item';
                $scrapInfo->vacuumListItem = 'tr[class^=alt]';
                $scrapInfo->fullLinkPathFunctions = array('children0', 'children0', 'href');
                $scrapInfo->imgLinkPathFunctions = array('children0', 'children0', 'children0', 'src');
                $scrapInfo->vacuumImgLinkPathFunctions = array('children0', 'children0', 'src');
                $scrapInfo->nameLinkPathFunctions = array('children1', 'plaintext');
                $scrapInfo->vacuumNameLinkPathFunctions = array('children3', 'plaintext');
                $scrapInfo->modelNoPathFunctions = array('children2', 'plaintext');
                $scrapInfo->vacuumModelNoPathFunctions = array('children1', 'children0', 'plaintext');
                $scrapInfo->pricePathFunctions = array('children3', 'plaintext');
                $scrapInfo->firstPageNum = 2;
                break;

            case 'Hoover Bags':
                $scrapInfo->baseURL = 'http://hoover.com';
                $scrapInfo->fullHtml = 'http://hoover.com/parts/category/bags/';
                $scrapInfo->nextPagesHtml = 'http://hoover.com/parts/category/bags/?page={$i}';
                $scrapInfo->brand = 'Hoover';
                $scrapInfo->productType = 'Bag';
                $scrapInfo->navBar = 'ol.paging';
                $scrapInfo->navPathFunctions = array('last_child', 'prev_sibling', 'plaintext');
                $scrapInfo->productListItem = 'div.part_list_item';
                $scrapInfo->vacuumListItem = 'tr[class^=alt]';
                $scrapInfo->fullLinkPathFunctions = array('children0', 'children0', 'href');
                $scrapInfo->imgLinkPathFunctions = array('children0', 'children0', 'children0', 'src');
                $scrapInfo->vacuumImgLinkPathFunctions = array('children0', 'children0', 'src');
                $scrapInfo->nameLinkPathFunctions = array('children1', 'plaintext');
                $scrapInfo->vacuumNameLinkPathFunctions = array('children3', 'plaintext');
                $scrapInfo->modelNoPathFunctions = array('children2', 'plaintext');
                $scrapInfo->vacuumModelNoPathFunctions = array('children1', 'children0', 'plaintext');
                $scrapInfo->pricePathFunctions = array('children3', 'plaintext');
                $scrapInfo->firstPageNum = 2;
                break;

            case 'Dirt Devil Filters':
                $scrapInfo->baseURL = 'http://dirtdevil.com';
                $scrapInfo->fullHtml = 'http://dirtdevil.com/parts/category/filters/';
                $scrapInfo->nextPagesHtml = 'http://dirtdevil.com/parts/category/filters/{$i}/';
                $scrapInfo->brand = 'Dirt Devil';
                $scrapInfo->productType = 'Filter';
                $scrapInfo->navBar = 'ul.paging';
                $scrapInfo->navPathFunctions = array('last_child', 'plaintext');
                $scrapInfo->productListItem = 'ul[id=list-filters] li[data-model]';
                $scrapInfo->vacuumListItem = 'ul[id=list-fits-these-models] li[data-model]';
                $scrapInfo->fullLinkPathFunctions = array('children0', 'children0', 'href');
                $scrapInfo->imgLinkPathFunctions = array('children0', 'children0', 'children0', 'src');
                $scrapInfo->vacuumImgLinkPathFunctions = array('children0', 'children0', 'children0', 'src');
                $scrapInfo->nameLinkPathFunctions = array('children1', 'children0', 'plaintext');
                $scrapInfo->vacuumNameLinkPathFunctions = array('children1', 'children0', 'plaintext');
                $scrapInfo->modelNoPathFunctions = array('children1', 'children1', 'plaintext');
                $scrapInfo->vacuumModelNoPathFunctions = array('children1', 'children1', 'plaintext');
                $scrapInfo->pricePathFunctions = array('children1', 'children4', 'plaintext');
                $scrapInfo->firstPageNum = 2;
                break;

            case 'Dirt Devil Bags':
                $scrapInfo->baseURL = 'http://dirtdevil.com';
                $scrapInfo->fullHtml = 'http://dirtdevil.com/parts/category/bags/';
                $scrapInfo->nextPagesHtml = 'http://dirtdevil.com/parts/category/bags/{$i}/';
                $scrapInfo->brand = 'Dirt Devil';
                $scrapInfo->productType = 'Bag';
                $scrapInfo->navBar = 'ul.paging';
                $scrapInfo->navPathFunctions = array('last_child', 'plaintext');
                $scrapInfo->productListItem = 'ul[id=list-bags] li[data-model]';
                $scrapInfo->vacuumListItem = 'ul[id=list-fits-these-models] li[data-model]';
                $scrapInfo->fullLinkPathFunctions = array('children0', 'children0', 'href');
                $scrapInfo->imgLinkPathFunctions = array('children0', 'children0', 'children0', 'src');
                $scrapInfo->vacuumImgLinkPathFunctions = array('children0', 'children0', 'children0', 'src');
                $scrapInfo->nameLinkPathFunctions = array('children1', 'children0', 'plaintext');
                $scrapInfo->vacuumNameLinkPathFunctions = array('children1', 'children0', 'plaintext');
                $scrapInfo->modelNoPathFunctions = array('children1', 'children1', 'plaintext');
                $scrapInfo->vacuumModelNoPathFunctions = array('children1', 'children1', 'plaintext');
                $scrapInfo->pricePathFunctions = array('children1', 'children4', 'plaintext');
                $scrapInfo->firstPageNum = 2;
                break;

            case 'Bissell Filters':
                $scrapInfo->baseURL = 'http://www.bissell.com';
                $scrapInfo->fullHtml = 'http://www.bissell.com/search?s=filter&f=BHI_PartCategory%3aFilter&page=0&i=20';
                $scrapInfo->nextPagesHtml = 'http://www.bissell.com/search?s=filter&f=BHI_PartCategory%3aFilter&page={$i}&i=20';
                $scrapInfo->brand = 'Bissell';
                $scrapInfo->productType = 'Filter';
                $scrapInfo->productListItem = 'div.search-results ul li';
                $scrapInfo->vacuumListItem = 'ul.associated-products li';
                $scrapInfo->fullLinkPathFunctions = array('children0', 'children0', 'href');
                $scrapInfo->imgLinkPathFunctions = array('children0', 'children0', 'children0', 'src');
                $scrapInfo->vacuumImgLinkPathFunctions = array('children0', 'children0', 'children0', 'src');
                $scrapInfo->nameLinkPathFunctions = array('children1', 'children0', 'plaintext');
                $scrapInfo->vacuumNameLinkPathFunctions = array('children1', 'children0', 'plaintext');
                $scrapInfo->modelNoPathFunctions = array('children1', 'children1','children0', 'plaintext');
                $scrapInfo->vacuumModelNoPathFunctions = array('children1', 'children1', 'plaintext');
                $scrapInfo->pricePathFunctions = array('children2', 'children0', 'children0', 'plaintext');
                $scrapInfo->numOfPages = 9;
                $scrapInfo->firstPageNum = 1;
                break;

            case 'Bissell Bags':
                $scrapInfo->baseURL = 'http://www.bissell.com';
                $scrapInfo->fullHtml = 'http://www.bissell.com/search?s=bag&f=BHI_PartCategory%3aBag&page=0&i=20';
                $scrapInfo->nextPagesHtml = 'http://www.bissell.com/search?s=bag&f=BHI_PartCategory%3aBag&page={$i}&i=20';
                $scrapInfo->brand = 'Bissell';
                $scrapInfo->productType = 'Bag';
                $scrapInfo->productListItem = 'div.search-results ul li';
                $scrapInfo->vacuumListItem = 'ul.associated-products li';
                $scrapInfo->fullLinkPathFunctions = array('children0', 'children0', 'href');
                $scrapInfo->imgLinkPathFunctions = array('children0', 'children0', 'children0', 'src');
                $scrapInfo->vacuumImgLinkPathFunctions = array('children0', 'children0', 'children0', 'src');
                $scrapInfo->nameLinkPathFunctions = array('children1', 'children0', 'plaintext');
                $scrapInfo->vacuumNameLinkPathFunctions = array('children1', 'children0', 'plaintext');
                $scrapInfo->modelNoPathFunctions = array('children1', 'children1','children0', 'plaintext');
                $scrapInfo->vacuumModelNoPathFunctions = array('children1', 'children1', 'plaintext');
                $scrapInfo->pricePathFunctions = array('children2', 'children0', 'children0', 'plaintext');
                $scrapInfo->numOfPages = 2;
                $scrapInfo->firstPageNum = 1;
                break;

        }

        return $scrapInfo;

    }

    function checkForCompatibility($currentDBRow, $arrayOfCompatiblities){

        global $db;
        $db_table               = 'products';
        $current_row_id         = $currentDBRow['ID'];
        $current_row_compatibility  = $currentDBRow['compatibleProducts'];

        if($currentDBRow['compatibleProducts'] == null){

            $data['compatibleProducts'] = $arrayOfCompatiblities;
            $db->update_query($db_table, $data, "ID = {$current_row_id}");

        }
        else{

            $current_compatible_pds = explode(',', $current_row_compatibility);
            $new_compatible_pds = explode(',', $arrayOfCompatiblities);

            foreach($new_compatible_pds as $key => $compatible_pd){

                $token = array_search($compatible_pd, $current_compatible_pds);
                if($token !== false){
                    unset($new_compatible_pds[$key]);
                }
            }

            if(!empty($new_compatible_pds)) {
                $data['compatibleProducts'] = implode(',', $new_compatible_pds);
            }
            if(!empty($data)) {
                $db->update_add_query($db_table, $data, "ID = {$current_row_id}");
            }

        }

    }

    function getVacuumsFromURL($scrapInfo, $product){

        $vacuumListItem = $scrapInfo->vacuumListItem;
        $vacuumImgLinkFn = $scrapInfo->vacuumImgLinkPathFunctions;
        $vacuumModelNoFn = $scrapInfo->vacuumModelNoPathFunctions;
        $vacuumNameFn = $scrapInfo->vacuumNameLinkPathFunctions;
        $baseURL = $scrapInfo->baseURL;

        $html = file_get_html($product->fullLink);
        $arrayofVacuums = array();

        foreach($html->find($vacuumListItem) as $element){
            $vacuum = new Vacuum;
            $vacuum->fromScrapper = true;
            $vacuum->brand = $product->brand;
            $vacuum->imgFullLink = str_replace(' ', '%20' ,$baseURL . translatePathFunctions($element, $vacuumImgLinkFn));
            $vacuum->modelNo = trim(translatePathFunctions($element, $vacuumModelNoFn));
            $vacuum->name = fixTrademarks(htmlentities(translatePathFunctions($element, $vacuumNameFn)));
            getInfoFromTagsVacuum($scrapInfo->brand, $vacuum->modelNo);
            array_push($arrayofVacuums, $vacuum);
        }

        return $arrayofVacuums;
    }

    function dl_ImgFromSourceToLocal($product)
    {
        $brandName              = $product->brand;
        $productModel           = $product->modelNo;
        $productType            = $product->productType;
        $source                 = $product->imgLink;
        $relatedVacuums         = $product->relatedVacuums;

        if(!file_exists("dl_img/{$brandName}/{$productType}")) {
            mkdir("dl_img/{$brandName}/{$productType}", 0777, true);
        }
        $destination = "dl_img/{$brandName}/{$productType}/{$productModel}.jpg";
        $product->localImgLink = $destination;
        if(!file_exists($destination)) {
            copy($source, $destination);
        }

        foreach($relatedVacuums as $vacuum)
        {
            $vacuumSource = $vacuum->imgFullLink;
            if(!isset($vacuumSource))
            {
                continue;
            }

            $brandName              = $vacuum->brand;
            $vacuumModel            = $vacuum->modelNo;
            $productType            = $vacuum->productType;

            if(!file_exists("dl_img/{$brandName}/{$productType}")) {
                mkdir("dl_img/{$brandName}/{$productType}", 0777, true);
            }

            $destination = "dl_img/{$brandName}/{$productType}/{$vacuumModel}.jpg";
            $vacuum->localImgLink = $destination;
            if(!file_exists($destination)) {
                copy($vacuumSource, $destination);
            }

        }
    }

    function addVacuumsForProduct($product)
    {
        global $db;
        $vacuums                = $product->relatedVacuums;
        $db_table               = 'products';
        $compatiblity           = array();

        foreach($vacuums as $vacuum){
            $modelNo = $vacuum->modelNo;
            $brand = $vacuum->brand;
            $sql = "SELECT * FROM {$db_table} WHERE concat(brand, modelNo) = concat('{$brand}', '{$modelNo}')";
            $result = $db->query($sql);
            if($row = mysqli_fetch_array($result))
            {
                $data['img6'] = $vacuum->localImgLink;
                checkForCompatibility($row, $product->dbRowID);
                $db->update_query($db_table, $data, "ID = {$row['ID']}");
                array_push($compatiblity, $row['ID']);
            }
            else
            {
               $vacuum_objects = get_object_vars($vacuum);
                foreach($vacuum_objects as $var_name => $val){

                    switch($var_name)
                    {
                        case 'price':
                            $col_name = 'salePrice';
                            break;

                        case 'localImgLink':
                            $col_name = 'img6';
                            break;

                        case 'imgFullLink':
                        case 'dbRowID':
                        case 'productType':
                            continue 2;

                        default:
                            $col_name = $var_name;
                            break;
                    }
                    $data[$col_name] = $val;

                }

                $data['compatibleProducts'] = $product->dbRowID;
                array_push($compatiblity, $db->insert_query($db_table, $data));
            }
            unset($data);
        }
        return $compatiblity;
    }

    function addProductToDB($product)
    {

        global $db;
        $data = array();
        $modelNo = $product->modelNo;
        $brand = $product->brand;
        $db_table = 'products';
        $sql = "SELECT * FROM {$db_table} WHERE concat(brand, modelNo) = concat('{$brand}', '{$modelNo}')";

        $result = $db->query($sql);
        if ($row = mysqli_fetch_array($result)) {
            $data['img6'] = $product->localImgLink;
            $db->update_query($db_table, $data, "ID = {$row['ID']}");
            $product->dbRowID = $row['ID'];
        } else {
            $product_objects = get_object_vars($product);
            foreach ($product_objects as $var_name => $val) {

                switch ($var_name) {
                    case 'productType':
                        $col_name = 'category';
                        break;

                    case 'price':
                        $col_name = 'salePrice';
                        break;

                    case 'localImgLink':
                        $col_name = 'img6';
                        break;

                    case 'relatedVacuums':
                    case 'dbRowID':
                    case 'fullLink':
                    case 'imgLink':
                        continue 2;

                    default:
                        $col_name = $var_name;
                        break;
                }
                $data[$col_name] = $val;


            }
            $product->dbRowID = $db->insert_query($db_table, $data);
        }

        $compatibleVacuums = addVacuumsForProduct($product);

        if (!empty($compatibleVacuums)) {
        $compatibleVacuums = implode(',', $compatibleVacuums);
        $result = $db->query($sql);
        $row = mysqli_fetch_array($result);
        checkForCompatibility($row, $compatibleVacuums);
    }


    }



?>