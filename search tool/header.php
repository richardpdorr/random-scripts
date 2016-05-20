<?
    error_reporting(0);
    require('mysql.class.php');
    require('item.class.php');
    require('recaptchalib.php');
    /***
    Domain Name:    www.thinkvacuums.com
    This is a global key. It will work across all domains, and 127.0.0.1 or localhost
    Public Key:    6Lfd1c8SAAAAAD64KoPHnmcmLJfFYWP5ntbce43o
    Private Key:    6Lfd1c8SAAAAAIr6IhHh4ES-6ekV_55jXOe4BUkt
    */
    $recaptcha_private_key = "6Lfd1c8SAAAAAIr6IhHh4ES-6ekV_55jXOe4BUkt";
    $recaptcha_public_key = "6Lfd1c8SAAAAAD64KoPHnmcmLJfFYWP5ntbce43o";
	
	$tm = time();                                                    
	srand($tm / pi());
	$random = rand(); 

    $db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
    $db->connect();

    //echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";
		$u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    if(preg_match('/MSIE 6/i',$u_agent) || preg_match('/MSIE 7/i',$u_agent)) 
    { 
        echo "<script type=\"text/javascript\">";
    		echo "window.location = \"http://www.thinkvacuums.com/index_old.htm\";";
				echo "</script>";
    } 

    function clean_input($input)
    {
		$input = htmlspecialchars(stripslashes(trim($input)));
		return $input;
    }

    function getDBTable($section)
    {
		switch ($section){
		    case "centralvacs":
			$table = 'central-vacuum-specs';
			break;
		    case "householdvacs":
			$table = 'household-specs';
			break;
		    case "commercialvacs":
			$table = 'commercial-specs';
			break;
		    case "backpackvacs":
			$table = 'backpack-specs';
			break;
		    case "centralaccessories":
			$table = 'central-vacuum-accessories';
			break;
			case "householdaccessories":
			$table = "household-accessories";
			break;
		    case "commercialaccessories":
			$table = 'commercial-accessories';
			break;
		    case "bags":
			$table = 'bags';
			break;
		    case "motors":
			$table = 'motors';
			break;
		    default:
			return false;
			break;
		}

		return $table;
    }

    function dots($url = null)
    {
		$tmp = dirname($_SERVER['PHP_SELF']);
		$tmp = str_replace('\\', '/', $tmp);
		$tmp = explode('/', $tmp);

		$relpath = null;
		for ($i = 0; $i < count($tmp); $i++){
		    $level = ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "192.168.0.109") ? 2 : 1; //local and live have diff structures
		    //$level = 2;
		    if ($tmp[$i] != '' && $i >= $level) $relpath .= '../';
		}

		$relpath = ($relpath != null) ? substr($relpath, 0, -1) : '.';

		if ($url){
		    if (substr($url, 0, 1) != '/')
			return $relpath .= ('/' . $url);
		    return $relpath .= $url;
		}
		else
		    return $relpath;
    }
	
	function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
	
function addProduct($details, $i, $page)
{
	//Creates a div element with the product ID, link text, description text, link location, and image location.
	
	echo '<div class="product-listing">';
	echo '<div class="pl-one">';
	$bs = 'no-bs';
	$pop = 'pl-30d';
	$default_imgWidth = 110;
	if ($page == "floorbrush")
	{
		$default_imgWidth = 170;
	}
	if ($page == "inlets")
	{
	if ($i == 0)
	{
		$pop = 'pl-30d pl-30d1';
	}
	if ($details['SmallDesc'] != "")
	{
		echo '<div class="' . $pop . '">' . $details['SmallDesc'] . '</div>';
		$bs = 'bs';
	}
	}
	echo '<a href="' . dots($details['Link']) . '"><img class="robsimg" src="' . dots($details['webThumbnail']) . '" width="' . $default_imgWidth . '" height="110" alt="' . $details['Manufacturer'] . ' ' . $details['Model'] . '">';
	echo '<a class="' . $bs . '" href="' . dots($details['Link']) . '"><span class="pl-helper"></span><p class="accessories-p">' . $details['Comments'] . '</p><br/>';
	if($i == 0 && $page == "inlets")
	{
	echo '<a data-toggle="modal" class="modal_async" data-modal-width="1000" data-target-content="../../modals/innovation_inlet.php" href="#modal">';
	echo htmlspecialchars('>>') . ' more info ' . htmlspecialchars('<<') . '</a>';
	}
	echo '</a></div>';
	if($details['Live'] == FALSE)
	{
		echo '<div class="cv-price" style="padding-top:48px; padding-bottom:48px; margin-top:0;">DISCONTINUED</div>';
	}
	else
	{
		echo '<form action="https://cart.thinkvacuums.com/cart32.exe/thinkvac-AddItem" method="post">';
		echo '<div class="pl-two">';
		echo '<span class="pl-helper"></span>';
		$options = str_replace("d-","", $details['Options']);
		$colors = explode(';' , $options);
		$option = "Option";
		if($colors[0] == "Size")
		{
			$option = "Size";
		}
		if($colors[0] == "Color" || $colors[0] == "Colors")
		{
			$option = "Color";
		}
		if (count($colors) == 1 ){
				echo '<span name="p1" class="pl-colors-none">No Additional Options Available</span>';
		}
		else {
			
		echo '<span class="pl-desc"><span class="pl-clrtext">Select ' . $option . '</span><br><input type="hidden" name="t1" value="'. $details['Options'] . '">';
			echo '<select name="p1" class="pl-colors">';
			echo '<option value="' . $colors[1] . '" selected>' . $colors[1] . '</option>';
		}
		foreach (array_slice($colors, 2) as $option)
		{
			echo '<option value="' . $option . '">' . $option . '</option>';
		}
		echo '</select></span></div>';
	}
	if($details['Live'] != FALSE)
	{
    echo '<div class="pl-price">Price: $' . number_format($details['Price'],2) . '</div>';
	echo '<div class="pl-form">';
    echo '<strong class="pl-qty">Qty:</strong> <input class="pl-input" name="qty" value="1">';
    echo '<button type="submit">';
    echo '<img src="' . dots('images/cart-btn.png') . '" alt=""/></button>';
    echo '<input type="hidden" name="AccountingCategory" value="Sales">';
    echo '<input type="hidden" name="Item" value="' . $details['Manufacturer'] . ' ' . $details['Model'] . ' (p)">';
    echo '<input type="hidden" value="' . $details['Price'] . '" name="Price">';
    echo '<input type="hidden" name="PartNo" value="">';
    echo '</form>';
	echo '</div>';
	}
	
	
    echo '</div>';
	
	return 0;

}

function decodeFeed2($productlist, &$dbnames, &$newids){
	$arraylen = count($productlist);
	for($p=0; $p < $arraylen; $p++)
		{
			$str = $productlist[$p];
			$numchars = strlen($str);
			preg_match_all('/(\d)|(\w)/', $str, $matches);
			$firstLetter = $matches[0][0];
		
			for($i=1; $i<$numchars; $i++)
				{
				$newid .= $matches[0][$i];
				}
			array_push($newids, $newid);
			unset($newid);
				
			switch($firstLetter)
			{
				case "A":
				array_push($dbnames, "backpack-specs");
				break;
		
				case "B":
				array_push($dbnames, "bags");
				break;
		
				case "C":
				array_push($dbnames, "central-vacuum-accessories");
				break;		
		
				case "D":
				array_push($dbnames, "central-vacuum-specs");
				break;
		
				case "E":
				array_push($dbnames, "commercial-accessories");
				break;
		
				case "F";
				array_push($dbnames, "commercial-specs");
				break;
		
				case "G":
				array_push($dbnames, "household-accessories");
				break;
		
				case "H":
				array_push($dbnames, "household-specs");
				break;
		
				case "I":
				array_push($dbnames, "motors");
				break;
				
				default:
				array_push($dbnames, "test");
				break;
		
			}
		}
	
			return 0;
		}
		
function fetch_array_of_products($url) {
	$sql = 'SELECT `Products` from `product_listings` WHERE `URL` = "' . $url . '";';
	$result = $GLOBALS['db']->query($sql);
	$details = $GLOBALS['db']->fetch_array($result);
	return $details;
}

function decodeFeed($str, &$db, &$newid){
	$numchars = strlen($str);
	preg_match_all('/(\d)|(\w)/', $str, $matches);
	
	$firstLetter = $matches[0][0];
		
	for($i=1; $i<$numchars; $i++)
	{
		$newid .= $matches[0][$i];
	}
	
	switch($firstLetter)
	{
		case "A":
		$db = "backpack-specs";
		break;
		
		case "B":
		$db = "bags";
		break;
		
		case "C":
		$db = "central-vacuum-accessories";
		break;		
		
		case "D":
		$db = "central-vacuum-specs";
		break;
		
		case "E":
		$db = "commercial-accessories";
		break;
		
		case "F";
		$db = "commercial-specs";
		break;
		
		case "G":
		$db = "household-accessories";
		break;
		
		case "H":
		$db = "household-specs";
		break;
		
		case "I":
		$db = "motors";
		break;
		
	}
	
	return 0;
	}


function replacementItem($replacement, $details) {
	echo '<div id="replacement-header" class="bdr" style="margin-top:0px;margin-left:10px;"><h2>Buy Replacement Model - ' . $replacement['Series'] . ' ' . $replacement['Model'] . '</h2></div>';
    echo '<div id="add-item"><form action="https://cart.thinkvacuums.com/cart32.exe/thinkvac-AddItem" method="post">';
    echo '<span class="replace-price">Price: <div class="price-r">$' . $replacement['Price'] . '</div></span>';
	echo '<p><a href="' . dots($replacement['hardlinkDesk']) . '"><img src="' . dots($replacement['imgThumbnailDesk']) . '" width="110" height="125" alt="' . $replacement['Manufacturer'] . ' ' . $replacement['Series'] . ' ' . $replacement['Model'] . '" /></a></p>';
    echo '<input type="hidden" name="Item" value="' . $replacement['Manufacturer'] . ' ' . $replacement['Series'] . ' ' . $replacement['Model'] . ' ' . $replacement['VacType'] . ' Vacuum (p)">';
    echo '<input type="hidden" name="Price" value="' . $replacement['Price'] . '">';
    echo '<p><a data-toggle="modal" href="#miele-s8-bags"><strong style="white-space:nowrap;"><u>Yes please,</u> add Miele Bags</strong></a>';
    echo '<select name="p1" size="1" class="rel-drop"><option>4 Pack - $' . $details['Price'] . '</option>';
    echo '<option>24 Pack - $' . number_format(($details['Price']*6), 2) . '</option>';
    echo '<option value="No">No Thanks</option></select></p>';
    echo '<span class="addhr"></span>';
	echo '<input type="hidden" name="t1" value="d-Style GN Bags;4 Pack - $' . $details['Price'] .':price=+' . $details['Price'] . ';24 Pack - $' . number_format(($details['Price']*6), 2) . ':price=+' . number_format(($details['Price']*6), 2) . ';No">';
    echo '<input type="image" alt="" cache src="' . dots('images/cart-btn-large.png') . '" width="165" height="36" style="margin-bottom:-2px">'; 
    echo '<input type=hidden name="AccountingCategory" value="Sales"> </form></div>';
  
	return 0;
 }

    /***
    * seo shit
    * /central-vacuums/manufacturer/model.php
    */
	//set testmode
	$testmode = ($_SERVER['REMOTE_ADDR'] == "69.65.77.150") ? true : false;

    //$g_currentPage = ($_SERVER['SERVER_NAME'] == "localhost") ? str_replace("/tv-product", "", strtolower($_SERVER['SCRIPT_NAME'])) : $_SERVER['SCRIPT_NAME'];
    $g_currentPage = ($_SERVER['SERVER_NAME'] == "localhost") ? str_replace("/tv-product", "", strtolower($_SERVER['REQUEST_URI'])) : $_SERVER['REQUEST_URI'];
	$g_currentPage = str_replace("tv-product/", "", $g_currentPage);

	$is_index = strpos($g_currentPage, 'index.');
	$is_dir = (substr($g_currentPage, -1) == '/') ? true : false; //if last char in url is a /

	if (strpos($g_currentPage, "search-results.php") !== false) return;

    //$sql = "SELECT * FROM `pageinfo` WHERE `Page` LIKE '$g_currentPage%' LIMIT 1";
	$sql = "SELECT * FROM `pageinfo` WHERE `Page` LIKE '$g_currentPage' LIMIT 1";
    $result = $db->query($sql);

	if ($testmode){
		//var_dump($_SERVER);
		//var_dump($g_currentPage);
	}

    if ($db->num_rows($result)){
		$details = $db->fetch_array($result);
		$title = stripslashes($details['Title']);
		$keywords = stripslashes($details['Keywords']);
		$description = stripslashes($details['Description']);
    }
	else
	{
		//no page found.
		//defaults
		$title = "Thinkvacuums";
		$keywords = "think, vacuums";
		$description = "Thinkvacuums";
		
		if ($is_index)
		{
			//no pageinfo found for a index.ext uri, try plain directory/
			$g_currentPage = explode('/', $g_currentPage);
			unset($g_currentPage[count($g_currentPage)-1]);
			$g_currentPage = implode('/', $g_currentPage) . '/';
			
			//re-run query with new $g_currentPage
			$sql = "SELECT * FROM `pageinfo` WHERE `Page` LIKE '$g_currentPage' LIMIT 1";
			$result = $db->query($sql);
		}
		elseif ($is_dir)
		{
			//no pageinfo found for a plain directory/, try with index.ext
			$sql = "SELECT * FROM `pageinfo` WHERE `Page` LIKE '" . $g_currentPage . "index%' LIMIT 1";
			$result = $db->query($sql);
		}

		if ($is_index || $is_dir){
			if ($db->num_rows($result)){
				$details = $db->fetch_array($result);
				$title = stripslashes($details['Title']);
				$keywords = stripslashes($details['Keywords']);
				$description = stripslashes($details['Description']);
			}
		}
    }
	
	//mobile site
	if (!isset($_COOKIE['mobile']))
	{
		if ($_GET['mobile'] == "no")
		{
			setcookie("mobile", "no", time()+3600); //expires in an hour
		}
		elseif (preg_match('/(iPod|iPhone|webOS|Android)/', $_SERVER['HTTP_USER_AGENT']))
		{
			//Header('Location: http://m.thinkvacuums.com');
		}
	}

?>
 <script type="text/javascript" src="http://www.thinkvacuums.com/js/overlibmws.js"></script> <script type="text/javascript" src="http://www.thinkvacuums.com/js/overlibmws_modal.js"></script> <script type="text/javascript" src="http://www.thinkvacuums.com/js/home.js"></script>
<script type="text/javascript">

				
				
 function stopFunction(event)
 {
	 event.preventDefault();
	 return false;
 }
			
			</script>
