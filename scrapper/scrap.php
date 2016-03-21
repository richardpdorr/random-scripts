<?php

    session_start();

    require_once('includes/init.php');
    require_once('includes/simple_html_dom.php');
    if(isset($_POST['data']))
    {
        $scrapInfo = getVarsForScrapping($_POST['data']);
    }

    $productType        = $scrapInfo->productType;
    $navBar             = $scrapInfo->navBar;
    $num_of_pages       = $scrapInfo->numOfPages;
    $navPathFunctions   = $scrapInfo->navPathFunctions;
    $page               = $scrapInfo->fullHtml;
    $nextPageHtml       = $scrapInfo->nextPagesHtml;
    $productListItem    = $scrapInfo->productListItem;
    $fullLinkPathFn     = $scrapInfo->fullLinkPathFunctions;
    $imgLinkPathFn      = $scrapInfo->imgLinkPathFunctions;
    $nameLinkPathFn     = $scrapInfo->nameLinkPathFunctions;
    $modelNoPathFn      = $scrapInfo->modelNoPathFunctions;
    $pricePathFn        = $scrapInfo->pricePathFunctions;
    $baseURL            = $scrapInfo->baseURL;
    $first_page_num     = $scrapInfo->firstPageNum;

    $counter = new Counter();

    $html               = file_get_html($page);

    if(isset($navBar)) {
        $navigation_menu = $html->find($navBar);
        $nav = $navigation_menu[0];
        $nav = translatePathFunctions($nav, $navPathFunctions);
        $num_of_pages = htmlentities($nav, ENT_QUOTES | ENT_SUBSTITUTE);
    }

    $brand          = new Brand;
    $brand->name    = $scrapInfo->brand;

    $productContainer = $html->find($productListItem);

    $counter->max_items = count($productContainer) * $num_of_pages;


    foreach($html->find($productListItem) as $element) {

        $product = new $productType();
        $product->brand             = $brand->name;
        $fullLink = translatePathFunctions($element, $fullLinkPathFn);
        if(strpos($fullLink, '.com')) $fullLink = preg_replace("(http:\/\/.*?\/)", "/", $fullLink);
        $product->fullLink          = $baseURL . $fullLink;
        $imgLink = translatePathFunctions($element, $imgLinkPathFn);
        if(strpos($imgLink, '.com')) $imgLink = preg_replace("(http:\/\/.*?\/)", "/", $imgLink);
        $product->imgLink           = $baseURL . htmlentities($imgLink);
        $product->name              = trim(fixTrademarks(htmlentities(translatePathFunctions($element, $nameLinkPathFn))));
        $modelNo                    = trim(translatePathFunctions($element, $modelNoPathFn));
        $price                      = translatePathFunctions($element, $pricePathFn);
        getInfoFromTags($scrapInfo->brand, $modelNo, $price);
        $product->modelNo           = $modelNo;
        $product->price             = $price;
        $product->fromScrapper      = true;
        $product->relatedVacuums    = getVacuumsFromURL($scrapInfo, $product);

        dl_ImgFromSourceToLocal($product);
        addProductToDB($product);
        array_push($brand->listOfProducts, $product);
        $counter->current_item++;
        updateProgress($counter);
    }
    //var_dump($brand->listOfProducts);

    if(isset($num_of_pages)) {
        for ($i = $first_page_num; $i <= $num_of_pages; $i++) {
            $next_page = str_replace('{$i}', $i, $nextPageHtml);
            $html = file_get_html($next_page);
            foreach ($html->find($productListItem) as $element) {

                $product = new $productType();
                $product->brand             = $brand->name;
                $fullLink = translatePathFunctions($element, $fullLinkPathFn);
                if(strpos($fullLink, '.com')) $fullLink = preg_replace("(http:\/\/.*?\/)", "/", $fullLink);
                $product->fullLink          = $baseURL . $fullLink;
                $imgLink = translatePathFunctions($element, $imgLinkPathFn);
                if(strpos($imgLink, '.com')) $imgLink = preg_replace("(http:\/\/.*?\/)", "/", $imgLink);
                $product->imgLink           = $baseURL . htmlentities($imgLink);
                $product->name              = trim(fixTrademarks(htmlentities(translatePathFunctions($element, $nameLinkPathFn))));
                $modelNo                    = trim(translatePathFunctions($element, $modelNoPathFn));
                $price                      = translatePathFunctions($element, $pricePathFn);
                getInfoFromTags($scrapInfo->brand, $modelNo, $price);
                $product->modelNo           = $modelNo;
                $product->price             = $price;
                $product->fromScrapper      = true;
                $product->relatedVacuums    = getVacuumsFromURL($scrapInfo, $product);

                dl_ImgFromSourceToLocal($product);
                addProductToDB($product);
                array_push($brand->listOfProducts, $product);
                $counter->current_item++;
                updateProgress($counter);
            }
        }
    }

    clearProgress();
    echo 'we makin moves baby. DB updated.';

?>