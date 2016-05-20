<?php

error_reporting(E_ALL);
require_once('includes/init.php');
require_once('includes/Encoding.php');
use \ForceUTF8\Encoding;  // It's namespaced now.

function create_magento_file($magento_file_text)
{
    $file = fopen("images.csv", "w");
    fwrite($file, $magento_file_text);
    fclose($file);
    echo 'Import file created.' . '<br/>';
}

function create_csv_file($arrayOfProducts){

    $output             = '"sku","media_gallery"';

    foreach($arrayOfProducts as $product)
    {
        if(!empty($product->media_gallery)){
            $output .= "\n" . '"' . $product->sku . '"';
            $count = 0;
            foreach($product->media_gallery as $image){
                if($count == 0)
                {
                    $output .= ',"/' . $image . '"';
                    $count++;
                }
                else{
                    $output .= "\n" . '"' . $product->sku . '"' . ',"/' . $image . '"';
                }
            }

        }
        else{
            continue;
        }
    }

    return $output;
}


        function getFilepathAndSku () {
            global $db;

            $sql = "SELECT * from images WHERE heathersRelPath != '\\\\' AND heathersRelPath != '' AND sku != ''";
            $details = $db->query($sql);

//            $directory_contents = preg_grep('/^([^.])/', scandir(str_replace('\\\\Hugessd\heathers thing to connect to','Z:\\\\',$image_path)));
//
//            var_dump($directory_contents);

            $i = 0;
            $name_of_file = 'heathers.txt';
            $file = fopen("{$name_of_file}", "w");
            $arrayOfProducts = array();
            while($row = mysqli_fetch_row($details))
            {
                //var_dump($row);
                $product_id = $row[0];
                $product_sku = trim($row[1]);
                $image_path = $row[2];
                $product_name = $row[3];
                //var_dump($image_path);
                $heathersBullshitArray = array();
                $imageFolder = "C:\wamp\www\photoApp\uploads\megaUploadFolder";
//                var_dump($imageFolder);
                $image_path = html_entity_decode($image_path);

//                $sql = "UPDATE images SET heathersRelPath = '{$image_path}' WHERE id = '{$product_id}'";
//                $db->query($sql);

                $dir_path = html_entity_decode(preg_replace( '/[^[:print:]]/', '', str_replace('\\', '/', str_ireplace('\\\\Hugessd\\heathers thing to connect to\\','Z:\\\\',$image_path)))) . "/";
                $ext = "{jpeg,jpg,gif,png,JPEG,JPG,GIF,PNG}";
//                var_dump($dir_path);
                if($image_in_dir = glob($dir_path."*.".$ext, GLOB_BRACE))
                {
                    if($product_sku == 'BR:0029')
                    {
                        var_dump($image_in_dir);
                    }
                    $count = 0;
                    $magento_product = new Magento_Product;
                    $magento_product->sku = $product_sku;
                    foreach($image_in_dir as $image){
                        $image_size = getimagesize($image);
                        preg_match("/\.\w+$/", $image, $image_ext);
                        if($image_size[0] < 1000 && $image_size[1] < 1000){

                            //copy($image, $imageFolder.'\\'.$product_id.'_'.$count.$image_ext[0]);
                            array_push($magento_product->media_gallery, $product_id.'_'.$count.$image_ext[0]);
                            $count++;
                        }

                    }
                    array_push($arrayOfProducts, $magento_product);
//                    var_dump($image_in_dir);
                    //$directory_contents = preg_grep('/^([^.])/', $image_in_dir);
                }
                else
                {
                    $heathersBullshitArray[$product_name] = $image_path;
                }

                foreach($heathersBullshitArray as $key => $attr)
                {
                    fwrite($file, $key . ' => ' .  $attr . "\n\n");
                }




                //unset($directory_contents[array_search('Thumbs.db', $directory_contents)]);
                //var_dump(preg_replace( '/[^[:print:]]/', '',$image_path));
                //var_dump($directory_contents);

                //$sql = "INSERT INTO images (product_sku, img_names) VALUES (\"'\" . {$product_sku} . \"','\" . {$img_names} . \"'\")";


                $i++;
            }

            //var_dump($arrayOfProducts);
            create_magento_file(create_csv_file($arrayOfProducts));
            echo $i;
            fclose($file);

        };




    getFilepathAndSku();




?>