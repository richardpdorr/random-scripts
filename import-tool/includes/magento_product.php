<?php

srand(time());


    class Magento_Product{

        public function __construct($ary){

            foreach($ary as $key => $val){
                $this->$val = '';
            }

            $this->set_vars_after_construct();

        }

        public function set_vars_after_construct(){

            //Required Fields in Magento, static for now...
            $this->store = 'default';
            $this->websites = 'base';
            $this->type = 'simple';
            $this->product_type_id = 'simple';
            $this->description = 'test';
            $this->short_description = 'test';
            $this->sku = 'TEST' . number_format(rand(0, 9999), 0, '', '');
            $this->weight = 0;
            $this->status = 'Enabled';
            $this->visibility = 'Catalog, Search';
            $this->tax_class_id = 'Shipping';
            $this->qty = '10';
            $this->store_id = '1';

            //Magento Defaults
            $this->is_recurring = 'No';
            $this->page_layout = 'No layout updates';
            $this->options_container = 'Product Info Column';
            $this->msrp_enabled = 'Use config';
            $this->msrp_display_actual_price_type = 'Use config';
            $this->gift_message_available = 'No';
            $this->min_qty = '0';
            $this->use_config_min_qty = '1';
            $this->is_qty_decimal = '0';
            $this->backorders = '0';
            $this->use_config_backorders = '1';
            $this->min_sale_qty = '1';
            $this->use_config_min_sale_qty = '1';
            $this->man_sale_qty = '0';
            $this->use_config_man_sale_qty = '1';
            $this->is_in_stock = '0';
            $this->notify_stockk_qty = '0';
            $this->use_config_notify_stock_qty = '1';
            $this->manage_stock = '0';
            $this->use_config_manage_stock = '1';
            $this->stock_status_changed_auto = '0';
            $this->use_config_qty_increments = '1';
            $this->qty_increments = '0';
            $this->use_config_enable_qty_inc = '1';
            $this->enable_qty_increments = '0';
            $this->is_decimal_divided = '0';
            $this->stock_status_changed_automatically = '0';
            $this->use_config_enable_qty_increments = '1';

        }

    }


?>