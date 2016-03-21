<?php

    require_once('includes/init.php');

        $magento_products = set_magento_products(get_all_power_units(), get_magento_fields());

        create_magento_file(create_magento_file_txt_mapped($magento_products));
//
//        var_dump($magento_products);


?>