<?php

require_once('var_lib.php');

function get_all($cat_type, $specs){
    global $db;
    global $allUnitSpecs;
    global ${$specs};
    $currentSpecs = ${$specs};
    $units                = array();
    $all_sql_specs              = implode(',', $allUnitSpecs);
    $custom_sql_specs           = implode(',', $currentSpecs);

    $sql = "SELECT ". $all_sql_specs . "," . $custom_sql_specs ." FROM products WHERE _attribute_set = '{$cat_type}'";
    $result = $db->query($sql);

//    for($i = 0; $i < 10; $i++){
//
//        $row = mysqli_fetch_assoc($result);
//        $powerUnit                  = new PowerUnit($row);
//        array_push($power_units, $powerUnit);
//
//    }

        while($row = mysqli_fetch_assoc($result)){
            $unit                  = new Db_object($row, $cat_type);
            array_push($units, $unit);
        }

    return($units);

}

function create_skus(&$products_array){
    global $db;

    $wet = $bp = $dry = $up = $cn = $bt = $br = $bg = $bs = $ss = $pb = $do = $cp =
    $mc = $f = $wi = $it = $imb = $ad = $dt = $c = $h = $hs = $th = $wh = $w = $sb =
    $fb = $cpb = $ct = $ep = $tp = $a = $ak = $pf = $m = $ev = $mt = $cb = $s = $fm =
    $ce = $ab = $rp = 0;

    foreach($products_array as $products){

        switch($products->class_type){

            case 'Power Unit':
                $products->sku = 'PU';
                if($products->wet_dry == "Yes"){
                    $products->sku .= ':W' . ':' . str_pad($wet, 4, 0, STR_PAD_LEFT);
                    $wet++;
                }else{
                    $products->sku .= ':D' . ':' .  str_pad($dry, 4, 0, STR_PAD_LEFT);
                    $dry++;
                }
                break;

            case 'Backpack Vacuum':
                $products->sku = 'VB';
                $products->sku .= ':' . str_pad($bp, 4, 0, STR_PAD_LEFT);
                $bp++;
                break;

            case 'Upright Vacuum':
                $products->sku = 'VU';
                $products->sku .= ':' . str_pad($up, 4, 0, STR_PAD_LEFT);
                $up++;
                break;

            case 'Canister Vacuum':
                $products->sku = 'VC';
                $products->sku .= ':' . str_pad($cn, 4, 0, STR_PAD_LEFT);
                $cn++;
                break;

            case 'Bags':
                $products->sku = 'BG';
                $products->sku .= ':' . str_pad($bg, 4, 0, STR_PAD_LEFT);
                $bg++;
                break;

            case 'Belts':
                $products->sku = 'BT';
                $products->sku .= ':' . str_pad($bt, 4, 0, STR_PAD_LEFT);
                $bt++;
                break;

            case 'Brush Rollers':
                $products->sku = 'BR';
                $products->sku .= ':' . str_pad($br, 4, 0, STR_PAD_LEFT);
                $br++;
                break;

            case 'Brush Strips':
                $products->sku = 'BS';
                $products->sku .= ':' . str_pad($bs, 4, 0, STR_PAD_LEFT);
                $bs++;
                break;

            case 'Sealing Strips':
                $products->sku = 'SS';
                $products->sku .= ':' . str_pad($ss, 4, 0, STR_PAD_LEFT);
                $ss++;
                break;

            case 'Protective Bumpers':
                $products->sku = 'PB';
                $products->sku .= ':' . str_pad($pb, 4, 0, STR_PAD_LEFT);
                $pb++;
                break;

            case 'Deodorizers':
                $products->sku = 'DO';
                $products->sku .= ':' . str_pad($do, 4, 0, STR_PAD_LEFT);
                $do++;
                break;

            case 'Cleaning Powder':
                $products->sku = 'CP';
                $products->sku .= ':' . str_pad($cp, 4, 0, STR_PAD_LEFT);
                $cp++;
                break;

            case 'Maintenance Cloths':
                $products->sku = 'MC';
                $products->sku .= ':' . str_pad($mc, 4, 0, STR_PAD_LEFT);
                $mc++;
                break;

            case 'Filters':
                $products->sku = 'F';
                $products->sku .= ':' . str_pad($f, 4, 0, STR_PAD_LEFT);
                $f++;
                break;

            case 'Wall Inlets':
                $products->sku = 'WI';
                $products->sku .= ':' . str_pad($wi, 4, 0, STR_PAD_LEFT);
                $wi++;
                break;

            case 'Inlet Mounting Bracket':
                $products->sku = 'MB';
                $products->sku .= ':' . str_pad($imb, 4, 0, STR_PAD_LEFT);
                $imb++;
                break;

            case 'Inlet Trim':
                $products->sku = 'IT';
                $products->sku .= ':' . str_pad($it, 4, 0, STR_PAD_LEFT);
                $it++;
                break;

            case 'Automatic Dustpans':
                $products->sku = 'AD';
                $products->sku .= ':' . str_pad($ad, 4, 0, STR_PAD_LEFT);
                $ad++;
                break;

            case 'Dustpan Trim':
                $products->sku = 'DT';
                $products->sku .= ':' . str_pad($dt, 4, 0, STR_PAD_LEFT);
                $dt++;
                break;

            case 'Cords':
                $products->sku = 'C';
                $products->sku .= ':' . str_pad($c, 4, 0, STR_PAD_LEFT);
                $c++;
                break;

            case 'Hoses':
                $products->sku = 'H';
                $products->sku .= ':' . str_pad($h, 4, 0, STR_PAD_LEFT);
                $h++;
                break;

            case 'Hose Socks':
                $products->sku = 'HS';
                $products->sku .= ':' . str_pad($hs, 4, 0, STR_PAD_LEFT);
                $hs++;
                break;

            case 'Tool Holders':
                $products->sku = 'TH';
                $products->sku .= ':' . str_pad($th, 4, 0, STR_PAD_LEFT);
                $th++;
                break;

            case 'Wand Holders':
                $products->sku = 'WH';
                $products->sku .= ':' . str_pad($wh, 4, 0, STR_PAD_LEFT);
                $wh++;
                break;

            case 'Wands':
                $products->sku = 'W';
                $products->sku .= ':' . str_pad($w, 4, 0, STR_PAD_LEFT);
                $w++;
                break;

            case 'Floor Brushes':
                $products->sku = 'FB';
                $products->sku .= ':' . str_pad($fb, 4, 0, STR_PAD_LEFT);
                $fb++;
                break;

            case 'Carpet Brushes':
                $products->sku = 'CPB';
                $products->sku .= ':' . str_pad($cpb, 4, 0, STR_PAD_LEFT);
                $cpb++;
                break;

            case 'Combo Tools':
                $products->sku = 'CT';
                $products->sku .= ':' . str_pad($ct, 4, 0, STR_PAD_LEFT);
                $ct++;
                break;

            case 'Electric Powerheads':
                $products->sku = 'EP';
                $products->sku .= ':' . str_pad($ep, 4, 0, STR_PAD_LEFT);
                $ep++;
                break;

            case 'Turbo Powerheads':
                $products->sku = 'TP';
                $products->sku .= ':' . str_pad($tp, 4, 0, STR_PAD_LEFT);
                $tp++;
                break;

            case 'Service Boxes':
                $products->sku = 'SB';
                $products->sku .= ':' . str_pad($sb, 4, 0, STR_PAD_LEFT);
                $sb++;
                break;

            case 'Attachments':
                $products->sku = 'A';
                $products->sku .= ':' . str_pad($a, 4, 0, STR_PAD_LEFT);
                $a++;
                break;

            case 'Attachment Kits':
                $products->sku = 'AK';
                $products->sku .= ':' . str_pad($ak, 4, 0, STR_PAD_LEFT);
                $ak++;
                break;

            case 'Pipes &amp; Fittings':
                $products->sku = 'PF';
                $products->sku .= ':' . str_pad($pf, 4, 0, STR_PAD_LEFT);
                $pf++;
                break;

            case 'Mufflers':
                $products->sku = 'M';
                $products->sku .= ':' . str_pad($m, 4, 0, STR_PAD_LEFT);
                $m++;
                break;

            case 'Exhaust Vents':
                $products->sku = 'EV';
                $products->sku .= ':' . str_pad($ev, 4, 0, STR_PAD_LEFT);
                $ev++;
                break;

            case 'Motors':
                $products->sku = 'MT';
                $products->sku .= ':' . str_pad($mt, 4, 0, STR_PAD_LEFT);
                $mt++;
                break;

            case 'Carbon Brushes':
                $products->sku = 'CB';
                $products->sku .= ':' . str_pad($cb, 4, 0, STR_PAD_LEFT);
                $cb++;
                break;

            case 'Sweepers':
                $products->sku = 'S';
                $products->sku .= ':' . str_pad($s, 4, 0, STR_PAD_LEFT);
                $s++;
                break;

            case 'Floor Machines':
                $products->sku = 'FM';
                $products->sku .= ':' . str_pad($fm, 4, 0, STR_PAD_LEFT);
                $fm++;
                break;

            case 'Carpet Extractors':
                $products->sku = 'CE';
                $products->sku .= ':' . str_pad($ce, 4, 0, STR_PAD_LEFT);
                $ce++;
                break;

            case 'Air Blowers':
                $products->sku = 'AB';
                $products->sku .= ':' . str_pad($ab, 4, 0, STR_PAD_LEFT);
                $ab++;
                break;

            case 'Replacement Parts':
                $products->sku = 'RP';
                $products->sku .= ':' . str_pad($rp, 4, 0, STR_PAD_LEFT);
                $rp++;
                break;


        }

        $sql = "UPDATE products SET sku = '{$products->sku}' WHERE id = '{$products->id}'";
        $db->query($sql);
    }

}



?>