<?php
	include ('php-classes.php');
	
	/* Minify html */
	function minifyHTML($result) {
		$r1 = '/(<!--([\s\S]*?)-->)/';
		$r2 = '/(^\s{2,})|(\t)/m';
		$r3 =	'/[ ]{2,}/';
		$o1 = preg_replace($r1,'', $result);
		$o2 = preg_replace($r2,'', $o1);
		$output = preg_replace($r3,' ', $o2);
		echo $output;
	}
	/* add product form for individual product pages */
	function addProductForm($item) {
		if (!empty($item->item['Manufacturer'])) {
			$manf = $item->item['Manufacturer'] . ' ' . $item->item['Model'];
		} else {
			$manf = $item->item['Model'];
		}
		echo '<form class="center" action="https://cart.thinkvacuums.com/cart32.exe/thinkvac-AddItem" method="post">';
		echo '<input type="hidden" name="AccountingCategory" value="Sales">';
		echo '<input type="hidden" name="Price" value="' . $item->item['Price'] . '">';
		$doptions = $item->item['Options'];
		$dprices = $item->item['OptionVars'];
		getOptions($doptions,$dprices);
		echo '<span class="center" style="font-weight:normal;font-size:12px;">Qty: <input type="text" name="qty" value="1" style="width:25px;margin-left:5px;"></span>';
		echo '<input type="hidden" name="Qty" value="1">';
		echo '<input type="hidden" name="Item" value="' . $manf . ' (p)">';
		if ($item->item['PartNo']) {
			echo '<input type="hidden" name="PartNo" value="' . $item->item['PartNo'] . '">';
		}
		echo '<input class="addToCart" type="image" src="' . dots('images/cart-btn-large.png') . '" width="165" height="36" style="margin-bottom:-2px">';
		echo '</form>';
	}
	/* end product form for individual product pages */
	/* start function to grab options and create selection dropdowns */
	function getOptions($doptions,$dprices) { 
		if ($doptions != null) {
			$o = 0;
			$p = 0;
			if (strpos($doptions,'|') !== false) {
				$options = explode("|",$doptions);
				$prices = explode("|",$dprices);
				foreach ($options as $opts) {
					$current = $opts;
					${"option" . $o} = explode(";",$current);
					$o++;
				}
				foreach ($prices as $prcs) {
					$current = $prcs;
					${"price" . $p} = explode(";",$current);
					$p++;
				}
			} else {
				$options = array ($doptions);
				$prices = array ($dprices);
				$option0 = explode(";",$doptions);
				$price0 = explode(";",$dprices);
			}
			$t = 1;
			$e = 0;
			echo '<div class="options">';
			foreach ($options as $opts) {
				$c = 0;
				$num = 1;
				${"is" . $e} = "";
				foreach ( ${"option" . $e} as $each) {
					if (array_key_exists($c,${"price" . $e}) && ${"price" . $e}[$c] != '') {
						if ($each === end(${"option" . $e})) {
							${"is" . $e} .= $each . ':' . ${"price" . $e}[$c];
						} else {
							${"is" . $e} .= $each . ':' . ${"price" . $e}[$c] . ';';
						}
					} else {
						if ($each === end(${"option" . $e})) {
							${"is" . $e} .= $each;
						} else {
						${"is" . $e} .= $each . ';';
						}
					}
					$c++;
				}
				echo '<input type="hidden" name="t' . $t . '" value="' . ${"is" . $e} . '">';
				if (${"option" . $e}[2]) {
					echo '<select name="p' . $t . '" size="1" class="opts" required>';
					$name = str_replace("d-","", ${"option" . $e}[0]);
					echo '<option disabled="true" selected="true" value="disabled">'. $name . '</option>';
					foreach (array_slice(${"option" . $e}, 1) as $opt) {
						$amount = ( isset(${"price" . $e}[$num]) ? ' ' . str_replace("price=", "$", ${"price" . $e}[$num]) : '');
						$amount = ( strpos($amount,'$+') !== false ? str_replace("$+", "+$", $amount) : '');
						echo '<option value="' . $opt . '">' . $opt . $amount . '</option>';
						$num++;
					}
					echo '</select>';
				} else {
					echo '<option type="hidden" value="' . $option0[1] . '" >' . $option0[1] . '</option>';
				}
				$t++;
				$e++;
			}
			echo '</div>';
		}
	}
	/* end function to grab options and create selection dropdowns */
	/* load related products */
	function addRelated($arrayofProducts, $rate, $dir) {
		$i = 0;
		if (!$rate) {
			$rate = '';
		}
		if (!$dir) {
			$dir = 'right';
		}
		if ($dir == 'full') {
			echo '<div class="clear"></div>';
			echo '<div class="fbisCarousel full">';
			echo '<div class="arrows">';
			echo '<a class="slideleft" href="#"><span>&gt;</span></a>';
			echo '<h3 align="center"><font color="#f9ce04">"Must Have"</font> Related Items</h3>';
			echo '<a class="slideright" href="#"><span>&lt;</span></a>';
		  echo '</div>';
			echo '<ul>';
		} elseif ($dir == 'right' || !$dir) {
			echo '<div id="right-side">';
			echo '<div id="upgrade-options"><h4><strong>Related Items</strong></h4></div>';
			echo '<div id="rel-items3">';
		}
		foreach ($arrayofProducts as $key => $product) {
			if($product->comments) {
			$manf = $product->comments;
			} else {
				$manf = (!$product->manufacturer) ? '$product->manufacturer' : '' . $product->model;
			}
			if ($dir == 'full') {
				echo '<li class="cell">';
				echo '<div class="center">';
				echo '<a href="' . dots($product->link) . '"><img class="m4" width="100" height="100" src="' . dots($product->webThumb) . '" alt="' . $manf . '"></a>';
				echo '<p class="title"><a href="' . dots($product->link) . '">' . $manf . '</a></p>';
				echo '</div>';
				if (isset($product->rob)) {
					echo '<span class="desc">' . $product->rob . '</span>';
				}
				echo '<form class="center" action="https://cart.thinkvacuums.com/cart32.exe/thinkvac-AddItem" method="post">';
				echo '<span class="price">$' . $product->price . '</span>';
				$doptions = $product->options;
				$dprices = $product->optionVars;
				getOptions($doptions,$dprices);
				echo '<button class="center addToCart" type="submit"><img src="' . dots('images/cart-btn.png') . '" alt=""></button>';
				echo '<input type="hidden" name="AccountingCategory" value="Sales">';
				echo '<input type="hidden" name="Item" value="' . $manf . ' (rp)">';
				echo '<input type="hidden" name="Price" value="' . $product->price . '">';
				if (!empty($product->partNo)) {
					echo '<input type="hidden" name="PartNo" value="' . $product->partNo . '"> '; 
				}	
				echo '</form>';
				echo '</li>';
				
			} elseif ($dir == 'right' || !$dir) {
				echo '<div class="items-hor2">';
				echo '<div class="items-img3 shadow">';
				echo '<a href="' . dots($product->link) . '"><img width="115" height="115" src="' . dots($product->webThumb) . '" alt="' . $manf . '"></a>';
				echo '</div>';
				echo '<div class="items-des-hor3 pad5" style="margin-bottom: 10px;">';
				if ($rate && is_numeric($rate[$i])) {
					echo '<div class="rating star-' . $rate[$i] . '" style="margin-bottom:2px;"></div>';
				}
				echo '<h4><a href="' . dots($product->link) . '">' . $manf . '</a></h4>';
				echo '<h3><span style="color:#990000;font-size:12px;margin-top:-3px;">$' . $product->price . '</span></h3>';
				echo '<form class="center" action="https://cart.thinkvacuums.com/cart32.exe/thinkvac-AddItem" method="post" style="margin-bottom:5px;">';
				$doptions = $product->options;
				$dprices = $product->optionVars;
				getOptions($doptions,$dprices);
				echo '<button class="center addToCart" type="submit"><img src="' . dots('images/cart-btn.png') . '" alt=""></button>';
				echo '<input type="hidden" name="AccountingCategory" value="Sales">';
				echo '<input type="hidden" name="Item" value="' . $manf . ' (rp)">';
				echo '<input type="hidden" name="Price" value="' . $product->price . '">';
				if (!empty($product->partNo)) {
					echo '<input type="hidden" name="PartNo" value="' . $product->partNo . '"> '; 
				}	
				echo '</form>';
				echo '</div>';
				echo '</div>';
			}
			$i++;
		}
		if ($dir == 'full') {
			echo '</div>';
		} elseif ($dir == 'right' || !$dir) {
			echo '</div>';
			echo '</div>';
		}
	}
	/* end related products */
	
	/* start product query for catalog pages */
	function queryOrder($feed, &$arrayofProducts) {
		$arrayofProducts[] = '';
		$dbnames = array(
			'A' => 'backpack-specs',
			'B' => 'bags',
			'C' => 'central-vacuum-accessories',
			'D' => 'central-vacuum-specs',
			'E' => 'commercial-accessories',
			'F' => 'commercial-specs',
			'G' => 'household-accessories',
			'H' => 'household-specs',
			'I' => 'motors'
		);
		$dbs = array(
			'backpack-specs' => '',
			'bags' => '',
			'central-vacuum-accessories' => '',
			'central-vacuum-specs' => '',
			'commercial-accessories' => '',
			'commercial-specs' => '',
			'household-accessories' => '',
			'household-specs' => '',
			'motors' => ''
		);
		foreach ($feed as $key => $item) {
			preg_match('/(\w)(\d+)/',$item,$theid);
			foreach ($dbnames as $ref => $db) {
				if ($ref == $theid[1]) {
					$theid[0] = $db;

				}
			}
			$order[$key] = $theid;
		}
		foreach ($order as $num => $ids) {
			$dbs[$ids[0]] .= $ids[2] . ','; 
		}
		foreach ($dbs as $dbname => $pid) {
			$sql_id_string = rtrim($pid,',');
			if ($sql_id_string) {
				$sql = "SELECT * FROM `" . $dbname . "` WHERE `ID` IN (" . $sql_id_string . ") ORDER BY FIELD(`ID`, " . $sql_id_string . ")";
				$result = $GLOBALS['db']->query($sql);
				while($details = $GLOBALS['db']->fetch_array($result)) {
					$product = new Product();
					$product->setProductVars($details);
					foreach ($feed as $order => $fed) {
						if ($fed == $product->feed) {
							$arrayofProducts[$order] = $product;
						}
					}
				}
			}
		}
		ksort($arrayofProducts);
	}
	/* end product query */
	
	/* start function to add products to catalog page */	
	function addCatalog($arrayofProducts) {
		$i = 0;
		array_unshift($arrayofProducts,'');
		unset($arrayofProducts[0]);
		$count = array_keys($arrayofProducts);
		$end = end($count);
		echo '<div class="catalog-table">';
		echo '<ul class="table-row">';
		foreach ($arrayofProducts as $key => $product) {
			if(isset($product->manufacturer)) {
			$manf = $product->manufacturer . ' ';
			}
			$title = $manf . $product->model;
			echo '<li class="cell center">';
			if ($product->link) {
				echo '<a class="center" href="' . dots($product->link) . '">';
			}
			if ($product->webThumb) {
				echo '<img class="thumb" width="110" height="110" src="' . dots($product->webThumb) . '" alt="' . $title . '">';
			} else {
				echo '<img class="thumb" width="110" height="110" src="' . dots('images/image-coming-soon.jpg') . '" alt="' . $title . '">';
			}
			echo '<span class="helpwrap"><span class="helper"></span><span class="title">' . $title . '</span></span>';
			if ($product->link) {
				echo '</a>';
			}
			echo '<form class="center" action="https://cart.thinkvacuums.com/cart32.exe/thinkvac-AddItem" method="post">';
			if ($product->live != 0) {
				$doptions = $product->options;
				$dprices = $product->optionVars;
				getOptions($doptions,$dprices);
				echo '<div class="clip"><span class="price">Price: $<span class="amount">' . $product->price . '</span></span>';
				echo '<span class="qty">Qty:<input class="qty center" name="qty" value="1"></span>';
				echo '<button class="center addToCart" type="submit"><img src="' . dots('images/cart-btn.png') . '" alt=""></button></div>';
			} else {
				echo '<div class="clip"><span class="price">Product Discontinued.<br/>Call for Replacement</span></div>';
			}
			echo '<input type="hidden" name="AccountingCategory" value="Sales">';
			echo '<input type="hidden" name="Item" value="' . $title . ' (p)">';
			echo '<input type="hidden" name="Price" value="' . $product->price . '">';
			if (!empty($product->partNo)) {
				echo '<input type="hidden" name="PartNo" value="' . $product->partNo . '"> '; 
			}	
			echo '</form>';
			echo '</li>';
			$i++;
			if (($key % 5) == 0 && $key != 0) {
				echo '</ul>';
				echo '<ul class="table-row">';
			}
			if ($key == $end) {
				echo '</ul>';
			}
		}
		echo '</div>';
	}
	/* end add catalog products */

	function addCatalog2($arrayofProducts) {
		$i = 0;
		
		$_SESSION['numofProducts'] = count($arrayofProducts);
		$items_per_page = $_SESSION['itemsPP'];
		$loopCount = ceil($_SESSION['numofProducts'] / $items_per_page);
		for($c=0; $c < $loopCount; $c++)
		{
		${'products_to_display' . $c} = array_slice($arrayofProducts, ($items_per_page*$c), $items_per_page);
		}
		$_SESSION['numofpages'] = $c;
		
		array_unshift(${'products_to_display' . $_SESSION['currentSearchPage']},'');
		unset(${'products_to_display' . $_SESSION['currentSearchPage']}[0]);
		$count = array_keys(${'products_to_display' . $_SESSION['currentSearchPage']});
		$end = end($count);
		echo '<div class="catalog-table search-results">';
		echo '<ul class="table-row">';
		foreach (${'products_to_display' . $_SESSION['currentSearchPage']} as $key => $product) {
			if(isset($product->manufacturer)) {
			$manf = $product->manufacturer . ' ';
			}
			$title = $manf . $product->model;
			echo '<li class="cell center">';
			if ($product->link) {
				$link = 'href="' . dots($product->link) . '"';
			} else {
				$link = 'href="#"';
			}
			echo '<a class="center" ' . $link . '>';
			if ($product->webThumb) {
				echo '<img class="thumb" width="110" height="110" src="' . dots($product->webThumb) . '" alt="' . $title . '">';
			} else {
				echo '<img class="thumb" width="110" height="110" src="' . dots('images/image-coming-soon.jpg') . '" alt="' . $title . '">';
			}
			echo '<span class="helpwrap"><span class="helper"></span><span class="title">' . $title . '</span></span>';
			echo '</a>';
			echo '<form class="center" action="https://cart.thinkvacuums.com/cart32.exe/thinkvac-AddItem" method="post">';
			if ($product->live != 0) {
				print_r($details);
				$doptions = $product->options;
				$dprices = $product->optionVars;
				getOptions($doptions,$dprices);
				echo '<div class="clip"><span class="price">Price: $<span class="amount">' . $product->price . '</span></span>';
				echo '<span class="qty">Qty:<input class="qty center" name="qty" value="1"></span>';
				echo '<button class="center addToCart" type="submit"><img src="' . dots('images/cart-btn.png') . '" alt=""></button></div>';
			} else {
				echo '<div class="clip"><span class="price">Product Discontinued.<br/>Call for Replacement</span></div>';
			}
			echo '<input type="hidden" name="AccountingCategory" value="Sales">';
			echo '<input type="hidden" name="Item" value="' . $title . ' (p)">';
			echo '<input type="hidden" name="Price" value="' . $product->price . '">';
			if (!empty($product->partNo)) {
				echo '<input type="hidden" name="PartNo" value="' . $product->partNo . '"> '; 
			}	
			echo '</form>';
			echo '</li>';
			$i++;
			if (($key % 3) == 0 && $key != 0) {
				echo '</ul>';
				echo '<ul class="table-row">';
			}
			if ($key == $end) {
				echo '</ul>';
			}
		}
		echo '</div>';
	}
	
	function decodeCats($category)
	{
		switch($category)
		{
			case 'Central Vacuum':
			$newstring = 'centralvacuum';
			break;
			
			case 'Accessories':
			$newstring = 'accessories';
			break;
			
			case 'Bags':
			$newstring = 'bags';
			break;
			
			case 'Filters':
			$newstring = 'filters';
			break;
			
			case 'Wands':
			$newstring = 'wands';
			break;
			
			case 'Wall Inlets':
			$newstring = 'wallinlets';
			break;
			
			case 'Automatic Dustpans':
			$newstring = 'automaticdustpans';
			break;
			
			case 'Hoses':
			$newstring = 'hoses';
			break;
			
			case 'Combo Kits':
			$newstring = 'combokits';
			break;
			
			case 'Power Heads':
			$newstring = 'powerheads';
			break;
			
			case 'Attachments':
			$newstring = 'attachments';
			break;
			
			case 'Attachment Kits':
			$newstring = 'attachmentkits';
			break;
			
			case 'Pipes &amp; Fittings':
			$newstring = 'pipesandfittings';
			break;
			
			case 'Car &amp; Garage':
			$newstring = 'cargarage';
			break;
			
			case 'Motors':
			$newstring = 'motors';
			break;
			
			default:
			$newstring = 'none';
			break;
			
		}
		return $newstring;
	}
	
	function relateCatsToBrands($arrayofBrandObjects){
		$currentBrand = new Brand();
		$currentBrand->setProductVars();
		$arrayofBrandObjectsFull = array();
		foreach($arrayofBrandObjects as $key => $brand)
		{
			${$key} = new Brand();
			${$key}->setProductVars();
			foreach($brand as $product)
			{	
				//str_replace('&amp;', '', str_replace(' ', '' , strtolower($product->category)));
				//var_dump(decodeCats($product->category));
				${$key}->{decodeCats($product->category)}++;
			}
			
			$arrayofBrandObjectsFull[$key] = ${$key};
		}
		//var_dump($arrayofBrandObjectsFull);
		$_SESSION['arrayOfRelations'] = serialize($arrayofBrandObjectsFull);
	}
	
	
	/* sort by brand filter function */
	function sortByBrand(&$arrayofProducts, $currentBrand)
	{
		$arrayofBrandObjects = array();
		$arrayofBrands = array();
		foreach($arrayofProducts as $product)
		{
			$manu = strtolower(str_replace(' ', '', $product->manufacturer));
			if($manu == NULL)
			{
				$manu = 'generic';
			}
			if(array_search($manu, $arrayofBrands) === FALSE)
			{
				array_push($arrayofBrands, $manu);
				if(!isset(${$manu . 'array'}))
				{
					${$manu . 'array'} = array();
				}
			}
			
			
				array_push(${$manu . 'array'}, $product);
		}
		$numBrands = array();
		foreach($arrayofBrands as $brand)
		{
			array_push($numBrands, count(${$brand . 'array'}));
			$arrayofBrandObjects[$brand] = ${$brand . 'array'};
		}
		relateCatsToBrands($arrayofBrandObjects);
		arsort($numBrands);
		$_SESSION['numBrands'] = $numBrands;
		$_SESSION['arrayofBrands'] = $arrayofBrands;
		if(isset($currentBrand))
		{
		$currentBrand = strtolower($currentBrand);
		$arrayofProducts = ${$currentBrand . 'array'};
		}
		
	}
	/* end sort by brand filter function */
	
	/* sort by brand filter function */
	function sortByCategory(&$arrayofProducts, $currentCategory)
	{
		$arrayofCategories = array();
		foreach($arrayofProducts as $product)
		{
			$manu = strtolower(str_replace(' ', '', $product->category));
			$manu = str_replace('-', '', $manu);
			$manu = str_replace('&amp;', '', $manu);
			if($manu == NULL)
			{
				$manu = 'generic';
			}
			if(array_search($manu, $arrayofCategories) === FALSE)
			{
				if($manu == 'generic')
				{
					continue;
				}
				array_push($arrayofCategories, $manu);
				if(!isset(${$manu . 'array'}))
				{
					${$manu . 'array'} = array();
				}
			}
			
			
				array_push(${$manu . 'array'}, $product);
		}
		$numCats = array();
		foreach($arrayofCategories as $cat)
		{
			array_push($numCats, count(${$cat . 'array'}));
		}
		arsort($numCats);
		$_SESSION['numCats'] = $numCats;
		$_SESSION['arrayofCats'] = $arrayofCategories;
		if(isset($currentCategory))
		{
		$currentCategory = strtolower($currentCategory);
		$arrayofProducts = ${$currentCategory . 'array'};
		$_SESSION['currentCats'] = $arrayofProducts;
		}
	}
	/* end sort by brand filter function */
	
	/* sort by price filter function */
	function sortByPrice(&$arrayofProducts, $upOrDown)
	{
		function cmpUp($a, $b)
		{
   			 if ($a->price == $b->price) {
    		    return 0;
    		}
 		   return ($a->price < $b->price) ? -1 : 1;
		}
		function cmpDown($a, $b)
		{
   			 if ($a->price == $b->price) {
    		    return 0;
    		}
 		   return ($a->price < $b->price) ? 1 : -1;
		}
		if($upOrDown == 1)
		{
		usort($arrayofProducts, "cmpUp"); 
		}
		if($upOrDown == 0)
		{
		usort($arrayofProducts, "cmpDown"); 
		}
		
		
	}
	/* end sort by price filter function */
	
	
	/* sort by title filter function */
	function sortByTitle(&$arrayofProducts, $upOrDown)
	{
		function cmpDown($a, $b)
		{
			if(!empty($a->manufacturer))
			{
			$fullTitleA = substr(trim($a->manufacturer), 0, 1);
			}
			else
			{
			$fullTitleA = substr(trim($a->model), 0, 1);
			}
			if(!empty($b->manufacturer))
			{
			$fullTitleB = substr(trim($b->manufacturer), 0, 1);
			}
			else
			{
			$fullTitleB = substr(trim($b->model), 0, 1);
			}
			$result = strcmp($fullTitleA, $fullTitleB);
   			 if ($result == 0) {
    		    return 0;
    		}
 		   return ($result < 0) ? -1 : 1;
		}
		function cmpUp($a, $b)
		{
			if(!empty($a->manufacturer))
			{
			$fullTitleA = substr(trim($a->manufacturer), 0, 1);
			}
			else
			{
			$fullTitleA = substr(trim($a->model), 0, 1);
			}
			if(!empty($b->manufacturer))
			{
			$fullTitleB = substr(trim($b->manufacturer), 0, 1);
			}
			else
			{
			$fullTitleB = substr(trim($b->model), 0, 1);
			}
			$result = strcmp($fullTitleA, $fullTitleB);
   			 if ($result == 0) {
    		    return 0;
    		}
 		   return ($result > 0) ? -1 : 1;
		}
		if($upOrDown == 0)
		{
		usort($arrayofProducts, "cmpDown");
		}
		if($upOrDown == 1)
		{
		usort($arrayofProducts, "cmpUp");
		}
		
	}
	/* end sort by title filter function */
	
	
	/* assign searchPTS for products based on search function */
	function checkKeyForBrand(&$allProducts, $keywords)
	{
		$substring = array();
		$substring = explode(' ', $keywords);
		foreach($substring as $needle)
		{
			if (substr($needle, -1) == 's')
			{
				$newstring = chop($needle, 's');
				array_push($substring, $newstring);
			}
		}
		$newProductsArray = array();
		foreach($allProducts as $key => $product)
		{
			$submanu = explode(' ', $product->manufacturer);
			$submodel = explode(' ', $product->model);
			foreach($substring as $needle)
			{
				unset($exactMatchmManu);
				unset($exactMatchmModel);
				if(in_array(strtolower($needle), array_map('strtolower', $submanu)))
				{
					$product->searchPTS += 7;
					$exactMatchmManu = TRUE;
				}
				if(in_array(strtolower($needle), array_map('strtolower', $submodel)))
				{
					$product->searchPTS += 4;
					$exactMatchmModel = TRUE;
				}
				if(stripos(strtolower($product->category), $needle) !== FALSE)
				{
					$product->searchPTS += 9;
				}
				if(stripos($product->manufacturer, $needle) !== FALSE && $exactMatchmManu !== TRUE)
				{
					$product->searchPTS += 5;
				}
				if(stripos($product->model, $needle) !== FALSE && $exactMatchmModel !== TRUE)
				{
					$product->searchPTS += 3;
				}
			}
			if($product->searchPTS > 0)
			{
				array_push($newProductsArray, $product);
			}
		}
		$allProducts = $newProductsArray;
	}
	/* end searchPTS for products based on search function */
	
	
	/* sort by highest SearchPTS function */
	function sortBySearchPTS(&$allProducts)
	{
		function cmp($a, $b)
		{
   			 if ($a->searchPTS == $b->searchPTS) {
    		    return 0;
    		}
 		   return ($a->searchPTS < $b->searchPTS) ? 1 : -1;
		}
		usort($allProducts, "cmp");
	}
	/* end sort by highest SearchPTS function */
	
?>