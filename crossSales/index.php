<?php

ini_set('xdebug.var_display_max_children', 2000 );


    require_once('includes/init.php');

    $allProducts = array();

    $sql = "SELECT compatibleProducts, sku FROM products WHERE compatibleProducts != '' AND sku != ''";
    $result = $db->query($sql);

    while($row = mysqli_fetch_row($result)) {

        $product = new RelatedProduct($row[0], $row[1]);

        $scraped = getAllScrapedIds();
        $product->removeScrapedProducts(getAllScrapedIds());

        if (!empty($product->relatedProductsSkus)){

            $product->setRelatedProducts();
            array_push($allProducts, $product);

        }

    }

    var_dump($allProducts);
    create_magento_file(create_csv_file($allProducts), 'cross_sell.csv');



?>