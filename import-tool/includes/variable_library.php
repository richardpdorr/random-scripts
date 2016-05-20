<?php

    $blankRows = array();

    $allUnitSpecs = array(
        'name',
        'sku',
        '_attribute_set',
        'compatibleProducts',
        'discontinued',
        'special_order',
        'org_ul_recognized',
        'org_gl_approved',
        'org_leed_certified',
        //'cost',
        'price',
        'description',
        'short_description',
        'weight',
        'qty',
        'color',
        'qty_in_pack',
        'product_width_inches',
        'product_length_inches',
        'product_height_inches',
        'part_model_number',
        'part_store_number',
        'gtin12_upc',
        'product_family_series',
        'brand',
        'manufacturer',
        'country_of_manufacture',
        'product_warranty',
        'pdf_spec_sheet',
        'pdf_manuals',
        'product_video_youtube_link',
        'includedProducts'
    );

    $powerUnitSpecs = array(
        'visual_interface_type',
        'indicator_motor_status',
        'indicator_bag_full',
        'indicator_filter_replace',
        'power_cord_length_feet',
        'filter_type',
        'filtration_method',
        'filter_washable',
        'sealed_system',
        'diameter',
        'capacity_gal',
        'voltage',
        'amps',
        'decibels',
        'square_ft',
        'waterlift',
        'air_watts',
        'cfm',
        'system_type',
        'wet_dry',
        'wet_dry_drain_required',
        'utility_valve',
        'power_safety_shutoff',
        'motor_name',
        'motor_stages',
        'motor_qty'
    );

    $backpackSpecs = array(
        'visual_interface_type',
        'indicator_motor_status',
        'indicator_bag_full',
        'indicator_filter_replace',
        'power_cord_length_feet',
        'clean_path_width',
        'operating_radius_feet',
        'handle_ergonomic',
        'product_tool_storage',
        'cord_auto_rewind',
        'indicator_brush_obstruction',
        'filter_type',
        'filtration_method',
        'filter_washable',
        'sealed_system',
        'capacity_gal',
        'voltage',
        'amps',
        'decibels',
        'waterlift',
        'air_watts',
        'cfm',
        'system_type',
        'power_control_variable',
        'power_settings',
        'power_settings_auto',
        'power_safety_shutoff',
        'roller_motor_controls',
        'cord_hook_adjust',
        'motor_name',
        'motor_stages',
        'motor_qty'
    );

    $uprightSpecs = array(
        'visual_interface_type',
        'indicator_motor_status',
        'indicator_bag_full',
        'indicator_filter_replace',
        'power_cord_length_feet',
        'clean_path_width',
        'operating_radius_feet',
        'wheels_swivel',
        'handle_ergonomic',
        'product_tool_storage',
        'cord_auto_rewind',
        'scraped',
        'indicator_brush_obstruction',
        'filter_type',
        'filtration_method',
        'filter_washable',
        'sealed_system',
        'capacity_gal',
        'voltage',
        'amps',
        'decibels',
        'waterlift',
        'air_watts',
        'cfm',
        'system_type',
        'power_control_variable',
        'power_settings',
        'power_settings_auto',
        'power_safety_shutoff',
        'product_bumper_included',
        'roller_motor',
        'roller_motor_controls',
        'cord_hook_adjust',
        'anti_tip_device',
        'headlight',
        'height_settings',
        'height_settings_auto',
        'handle_adjust',
        'powerhead_removable',
        'roller_rpm',
        'motor_name',
        'motor_stages',
        'motor_qty'
        );

    $canisterSpecs = array(
        'visual_interface_type',
        'indicator_motor_status',
        'indicator_bag_full',
        'indicator_filter_replace',
        'power_cord_length_feet',
        'clean_path_width',
        'operating_radius_feet',
        'wheels_swivel',
        'handle_ergonomic',
        'product_tool_storage',
        'cord_auto_rewind',
        'indicator_brush_obstruction',
        'indicator_roller_replace',
        'filter_type',
        'filtration_method',
        'filter_washable',
        'sealed_system',
        'capacity_gal',
        'voltage',
        'amps',
        'decibels',
        'waterlift',
        'air_watts',
        'cfm',
        'system_type',
        'wet_dry',
        'power_control_variable',
        'power_settings',
        'power_settings_auto',
        'power_safety_shutoff',
        'product_bumper_included',
        'roller_motor',
        'roller_motor_controls',
        'cord_hook_adjust',
        'headlight',
        'height_settings',
        'height_settings_auto',
        'handle_adjust',
        'powerhead_removable',
        'roller_rpm',
        'motor_name',
        'motor_stages',
        'motor_qty'
        );

        $bagSpecs = array(
        'capacity_gal',
        'maintenance',
        'bag_type',
        'scraped',
        'bag_fill_style',
        'bag_filtration',
        'bag_electrostatic',
        'bag_layers',
        'filter_efficiency',
        'filter_microns',
        'bag_filter_inc',
        'bag_filter_qty'
        );


        $beltSpecs = $ssSpecs = $deoSpecs = $cpSpecs = $mcSpecs = $imbSpecs = $itSpecs = $dtSpecs = $cSpecs = $hsSpecs = $sbSpecs = array();

        $brSpecs = array(
            'product_material',
            'brush_material',
            'brush_size'
        );

        $bsSpecs = array(
            'brush_size'
        );

        $pbSpecs = array(
            'bumper_fit',
            'bumper_size',
            'bumper_width',
            'bumper_depth'
        );

        $fSpecs = array(
            'filter_type',
            'filtration_method',
            'filter_washable',
            'scraped',
            'sealed_system',
            'capacity_gal',
            'diameter',
            'maintenance'
        );

        $wiSpecs = array(
            'inlet_connection',
            'diameter',
            'inlet_auto_on',
            'inlet_door_style',
            'indicator_on_off_light'
        );

        $adSpecs = array(
            'product_material',
            'inlet_auto_on',
            'inlet_lights',
            'inlet_use_trim'
        );

        $hSpecs = array(
            'power_cord_length_feet',
            'hose_length_feet',
            'hose_type',
            'connection_type',
            'hose_crushproof',
            'handle_ergonomic',
            'hose_air_relief_valve',
            'receptacle_type',
            'hose_power_switch',
            'diameter',
            'handle_swivel',
            'fit',
            'adj_min_length',
            'adj_max_length'
        );

        $thSpecs = $whSpecs = array(
            'hanger_max_length',
            'hanger_washable'
        );

        $wSpecs = array(
            'indicator_dirt_sensor',
            'electric',
            'connection_type',
            'receptacle_type',
            'diameter',
            'product_material',
            'fit',
            'cord_management',
            'product_finish',
            'adj_min_length',
            'adj_max_length',
            'adj_interval_length'
        );

        $fbSpecs = $cpbSpecs = array(
            'clean_path_width',
            'wheels',
            'wet_dry',
            'product_bumper_included',
            'diameter',
            'product_material',
            'brush_material',
            'neck_movement',
            'fit'
        );

        $ctSpecs = array(
            'clean_path_width',
            'wheels',
            'wet_dry',
            'product_bumper_included',
            'diameter',
            'product_material',
            'brush_material',
            'neck_movement',
            'combo_floor_switch',
            'fit'
        );

        $ephSpecs = $tphSpecs = array(
            'handheld',
            'clean_path_width',
            'indicator_dirt_sensor',
            'indicator_brush_obstruction',
            'indicator_roller_replace',
            'headlight',
            'height_settings',
            'height_settings_auto',
            'product_bumper_included',
            'neck_movement',
            'edge_clean',
            'wet_dry',
            'fit',
            'connection_type',
            'receptacle_type',
            'roller_motor',
            'roller_motor_controls',
            'roller_rpm',
            'motor_watts',
            'noise_level',
            'power_safety_shutoff',
            'power_reset_btn',
            'wand_included',
            'brush_material',
            'roller_material',
            'product_material',
            'maintenance',
            'filter_type',
            'filter_washable'
        );

        $atSpecs = array(
            'attachment_type',
            'clean_path_width',
            'neck_movement',
            'brush_removable',
            'flexible'
        );

        $atkSpecs = array(
            'clean_path_width',
            'neck_movement',
            'brush_removable',
            'product_material',
            'flexible'
        );

        $pfSpecs = array(
            'pvc_style',
            'pvc_type',
            'pvc_degree'
                );

        $mSpecs = array(
            'muffler_shape',
            'filtration_method'
        );

        $evSpecs = array(
            'exhaust_opening',
            'exhaust_cyclonic'
        );

        $mtSpecs = array(
            'voltage',
            'motor_watts',
            'motor_stages',
            'motor_speeds',
            'motor_type',
            'motor_frequency',
            'motor_fan_diameter',
            'motor_fan_style',
            'motor_air_discharge',
            'motor_temp_low',
            'motor_temp_high',
            'motor_bearing',
            'motor_brush',
            'motor_cobr_material',
            'motor_fabr_material',
            'motor_therm_protect',
            'motor_ins_class',
            'motor_fashcoat',
            'motor_duty_cycle',
            'motor_electric_conn'
        );

        $cbSpecs = array(
            'voltage'
        );

        $sSpecs = array(
            'clean_path_width',
            'height_settings',
            'handle_adjust',
            'handle_folds',
            'cordless_battery',
            'brush_size',
            'brush_qty',
            'brush_side_size',
            'drive_train',
            'decibels',
            'amps',
            'product_material'
        );

        $fmSpecs = array(
            'pad_driver_incl',
            'clean_path_width',
            'squeegee_width',
            'brush_size',
            'brush_qty',
            'brush_shapes',
            'power_cord_length_feet',
            'power_safety_shutoff',
            'cordless_battery',
            'cordless_runtime',
            'charge_time',
            'handle_folds',
            'handle_adjust',
            'solution_capacity',
            'recovery_capacity',
            'capacitors',
            'gearbox',
            'roller_rpm',
            'motor_hp',
            'amps',
            'decibels',
            'product_material'
        );

        $ceSpecs = array(
            'solution_capacity',
            'recovery_capacity',
            'psi',
            'waterlift',
            'cfm',
            'amps',
            'decibels',
            'filtration_method',
            'inc_p_extractor_wand',
            'hose_length_feet',
            'power_cord_length_feet',
            'motor_stages',
            'handle_carry'
        );

        $abSpecs = array(
            'power_cord_length_feet',
            'safety_guard',
            'switch_loc',
            'handle_folds',
            'handle_adjust',
            'motor_speeds',
            'motor_hp',
            'voltage',
            'amps',
            'decibels',
            'product_material'
        );

        $rpSpecs = array(
            'replacement_part'
        );


?>