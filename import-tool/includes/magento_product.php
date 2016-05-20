<?php


    class Magento_Product{

        public function __construct($ary, $vars_after_construct = false){

            foreach($ary as $key => $val){
                ($val == 'compatibleProducts') ? $this->_links_related_sku = '' : $this->$val = '';
            }
            if($vars_after_construct == true)  $this->set_vars_after_construct();

        }

        private function set_vars_after_construct(){

            //Required Fields in Magento, static for now...
            $this->_store = 'default';
            $this->_product_websites = 'base';
            $this->_type = 'simple';
            $this->short_description = 'test';
            $this->weight = 0;
            $this->status = '1';
            $this->visibility = '4';
            $this->tax_class_id = '2';
            $this->qty = '1';

            //Magento Defaults
            $this->options_container = 'Product Info Column';
            $this->msrp_enabled = 'Use config';
            $this->msrp_display_actual_price_type = 'Use config';
            $this->gift_message_available = '0';
            $this->min_qty = '0';
            $this->use_config_min_qty = '1';
            $this->is_qty_decimal = '0';
            $this->backorders = '0';
            $this->use_config_backorders = '1';
            $this->min_sale_qty = '1';
            $this->use_config_min_sale_qty = '1';
            $this->max_sale_qty = '0';
            $this->use_config_max_sale_qty = '1';
            $this->is_in_stock = '1';
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