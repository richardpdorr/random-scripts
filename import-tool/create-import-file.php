<?php

require_once('includes/init.php');

function nofToValues($name_of_file, &$name_of_cat, &$name_of_specs)
{
    switch ($name_of_file) {
        case 'power_units.csv':
            $name_of_cat = 'Power Unit';
            $name_of_specs = 'powerUnitSpecs';
            break;

        case 'backpack_vacs.csv':
            $name_of_cat = 'Backpack Vacuum';
            $name_of_specs = 'backpackSpecs';
            break;

        case 'upright_vacs.csv':
            $name_of_cat = 'Upright Vacuum';
            $name_of_specs = 'uprightSpecs';
            break;

        case 'canister_vacs.csv':
            $name_of_cat = 'Canister Vacuum';
            $name_of_specs = 'canisterSpecs';
            break;

        case 'bags.csv':
            $name_of_cat = 'Bags';
            $name_of_specs = 'bagSpecs';
            break;

        case 'belts.csv':
            $name_of_cat = 'Belts';
            $name_of_specs = 'beltSpecs';
            break;

        case 'b_rollers.csv':
            $name_of_cat = 'Brush Rollers';
            $name_of_specs = 'brSpecs';
            break;

        case 'b_strips.csv':
            $name_of_cat = 'Brush Strips';
            $name_of_specs = 'bsSpecs';
            break;

        case 's_strips.csv':
            $name_of_cat = 'Sealing Strips';
            $name_of_specs = 'ssSpecs';
            break;

        case 'p_bumpers.csv':
            $name_of_cat = 'Protective Bumpers';
            $name_of_specs = 'pbSpecs';
            break;

        case 'deodorizers.csv':
            $name_of_cat = 'Deodorizers';
            $name_of_specs = 'deoSpecs';
            break;

        case 'clean_powder.csv':
            $name_of_cat = 'Cleaning Powder';
            $name_of_specs = 'cpSpecs';
            break;

        case 'm_cloths.csv':
            $name_of_cat = 'Maintenance Cloths';
            $name_of_specs = 'mcSpecs';
            break;

        case 'filters.csv':
            $name_of_cat = 'Filters';
            $name_of_specs = 'fSpecs';
            break;

        case 'wall_inlets.csv':
            $name_of_cat = 'Wall Inlets';
            $name_of_specs = 'wiSpecs';
            break;

        case 'inlet_mount_bracket.csv':
            $name_of_cat = 'Inlet Mounting Bracket';
            $name_of_specs = 'imbSpecs';
            break;

        case 'inlet_trim.csv':
            $name_of_cat = 'Inlet Trim';
            $name_of_specs = 'itSpecs';
            break;

        case 'auto_dustpans.csv':
            $name_of_cat = 'Automatic Dustpans';
            $name_of_specs = 'adSpecs';
            break;

        case 'dustpan_trim.csv':
            $name_of_cat = 'Dustpan Trim';
            $name_of_specs = 'dtSpecs';
            break;

        case 'cords.csv':
            $name_of_cat = 'Cords';
            $name_of_specs = 'cSpecs';
            break;

        case 'hoses.csv':
            $name_of_cat = 'Hoses';
            $name_of_specs = 'hSpecs';
            break;

        case 'hose_socks.csv':
            $name_of_cat = 'Hose Socks';
            $name_of_specs = 'hsSpecs';
            break;

        case 'tool_holders.csv':
            $name_of_cat = 'Tool Holders';
            $name_of_specs = 'thSpecs';
            break;

        case 'wand_holders.csv':
            $name_of_cat = 'Wand Holders';
            $name_of_specs = 'whSpecs';
            break;

        case 'wands.csv':
            $name_of_cat = 'Wands';
            $name_of_specs = 'wSpecs';
            break;

        case 'floor_brushes.csv':
            $name_of_cat = 'Floor Brushes';
            $name_of_specs = 'fbSpecs';
            break;

        case 'carpet_brushes.csv':
            $name_of_cat = 'Carpet Brushes';
            $name_of_specs = 'cpbSpecs';
            break;

        case 'combo_tools.csv':
            $name_of_cat = 'Combo Tools';
            $name_of_specs = 'ctSpecs';
            break;

        case 'electric_ph.csv':
            $name_of_cat = 'Electric Powerheads';
            $name_of_specs = 'ephSpecs';
            break;

        case 'turbo_ph.csv':
            $name_of_cat = 'Turbo Powerheads';
            $name_of_specs = 'tphSpecs';
            break;

        case 'service_boxes.csv':
            $name_of_cat = 'Service Boxes';
            $name_of_specs = 'sbSpecs';
            break;

        case 'attachments.csv':
            $name_of_cat = 'Attachments';
            $name_of_specs = 'atSpecs';
            break;

        case 'attach_kits.csv':
            $name_of_cat = 'Attachment Kits';
            $name_of_specs = 'atkSpecs';
            break;

        case 'pipes_and_fittings.csv':
            $name_of_cat = 'Pipes &amp; Fittings';
            $name_of_specs = 'pfSpecs';
            break;

        case 'mufflers.csv':
            $name_of_cat = 'Mufflers';
            $name_of_specs = 'mSpecs';
            break;

        case 'exhaust_vents.csv':
            $name_of_cat = 'Exhaust Vents';
            $name_of_specs = 'evSpecs';
            break;

        case 'motors.csv':
            $name_of_cat = 'Motors';
            $name_of_specs = 'mtSpecs';
            break;

        case 'carbon_brushes.csv':
            $name_of_cat = 'Carbon Brushes';
            $name_of_specs = 'cbSpecs';
            break;

        case 'sweepers.csv':
            $name_of_cat = 'Sweepers';
            $name_of_specs = 'sSpecs';
            break;

        case 'floor_machines.csv':
            $name_of_cat = 'Floor Machines';
            $name_of_specs = 'fmSpecs';
            break;

        case 'carpet_extractors.csv':
            $name_of_cat = 'Carpet Extractors';
            $name_of_specs = 'ceSpecs';
            break;

        case 'air_blowers.csv':
            $name_of_cat = 'Air Blowers';
            $name_of_specs = 'abSpecs';
            break;

        case 'replacement_parts.csv':
            $name_of_cat = 'Replacement Parts';
            $name_of_specs = 'rpSpecs';
            break;

        default:
            break;
    }
}

    if($_POST['submit'] == '1') {
        $name_of_file = $_POST['name_of_file'];
        $name_of_cat = $name_of_specs = null;
        nofToValues($name_of_file, $name_of_cat, $name_of_specs);
        $magento_products = set_magento_products(get_all($name_of_cat, $name_of_specs), get_magento_fields());
        create_magento_file(create_magento_file_txt_mapped($magento_products), $name_of_file);
    }
    else if ($_POST['submit'] == '2')
    {
        $arrayOfCSVs = array('power_units.csv', 'backpack_vacs.csv', 'upright_vacs.csv', 'canister_vacs.csv', 'bags.csv', 'belts.csv', 'b_rollers.csv', 'b_strips.csv', 's_strips.csv', 'p_bumpers.csv',
            'deodorizers.csv', 'clean_powder.csv', 'm_cloths.csv', 'filters.csv', 'wall_inlets.csv', 'inlet_mount_bracket.csv', 'inlet_trim.csv', 'auto_dustpans.csv', 'dustpan_trim.csv',
            'cords.csv', 'hoses.csv', 'hose_socks.csv', 'tool_holders.csv', 'wand_holders.csv', 'wands.csv', 'floor_brushes.csv', 'carpet_brushes.csv', 'combo_tools.csv',
            'electric_ph.csv', 'turbo_ph.csv', 'service_boxes.csv', 'attachments.csv', 'attach_kits.csv', 'pipes_and_fittings.csv', 'mufflers.csv', 'exhaust_vents.csv',
            'motors.csv', 'carbon_brushes.csv', 'sweepers.csv', 'floor_machines.csv', 'carpet_extractors.csv', 'air_blowers.csv', 'replacement_parts.csv');

        foreach($arrayOfCSVs as $name_of_file)
        {
            $name_of_cat = $name_of_specs = null;
            nofToValues($name_of_file, $name_of_cat, $name_of_specs);
            $magento_products = set_magento_products(get_all($name_of_cat, $name_of_specs), get_magento_fields());
            create_magento_file(create_magento_file_txt_mapped($magento_products), $name_of_file);
        }
    }


?>