<?php
	session_start();
	include_once('inc/functions.php');
	include_once('inc/header.php');
	
	function grabAllFromDB($product_tables)
	{
		$newarray = array();
		foreach ($product_tables as $table)
		{
		$sql = "SELECT * FROM `" . $table . "`";
		$result = $GLOBALS["db"]->query($sql);
		$details = $GLOBALS["db"]->fetch_array($result);
		while($details = $GLOBALS["db"]->fetch_array($result)){
			$product = new Product();
			$product->setProductVars($details);
			array_push($newarray, $product);
		}
		}
		foreach($newarray as $key => $product)
		{
			if($product->price == '0.00')
			{
				unset($newarray[$key]);
			}
			else if($product->live == '0')
			{
				unset($newarray[$key]);
			}
		}
		return $newarray;
	}

	function manufacturerKeywords(&$keyword){
	
	switch($keyword)
	{
		case ('blackanddecker'):
		{
			$keyword = 'black and decker';
			break;
		}
		case ('canavac'):
		{
			$keyword = 'cana vac';
			break;
		}
		case ('cvinternational'):
		{
			$keyword = 'cv international';
			break;
		}
		case ('dirtdevil'):
		{
			$keyword = 'dirt devil';
			break;
		}
		case ('easyflo'):
		{
			$keyword = 'easy flo';
			break;
		}
		case ('mdmanufacturing'):
		{
			$keyword = 'md manufacturing';
			break;
		}
		case ('pullmanholt'):
		{
			$keyword = 'pullman holt';
			break;
		}
		case ('ventavac'):
		{
			$keyword = 'vent a vac';
			break;
		}
		case ('dustcare'):
		{
			$keyword = 'dust care';
			break;
		}
		
		default:
		break;
	}
		
		
	}
	

	if(isset($_POST))
	{	
		if(isset($_POST['sortbythis']))
		{
			switch($_POST['sortbythis'])
			{
				case 'pricehigh':
				$_SESSION['sorted'] = 'pricehigh';
				$sortPrice = 0;
				break;
				
				case 'pricelow':
				$_SESSION['sorted'] = 'pricelow';
				$sortPrice = 1;
				break;
				
				case 'tithigh':
				$_SESSION['sorted'] = 'tithigh';
				$sortTitle = 1;
				break;
				
				case 'titlow':
				$_SESSION['sorted'] = 'titlow';
				$sortTitle = 0;
				break;
				
				case 'pop':
				$reset = 1;
				break;
				
				default:
				unset($reset);
				unset($sortPrice);
				unset($sortTitle);
				unset($_SESSION['sorted']);
				break;
			}
		}
		if(isset($_POST['brandChecked']))
		{
			
		$_SESSION['brandChecked'] = $_POST['brandChecked'];
		if($_POST['brandChecked'] == 'true')
		{
		$_SESSION['manu'] = $_POST['manu'];
		$_SESSION['currentSearchPage'] = 0;
		}
		if($_POST['brandChecked'] == 'false'){
			unset($_SESSION['manu']);
			unset($_SESSION['brandChecked']);
			$_SESSION['currentSearchPage'] = 0;
			$_POST['moveValue'] = 0;
		}
		}
		if(isset($_POST['catsChecked']))
		{
			
		$_SESSION['catsChecked'] = $_POST['catsChecked'];
		if($_POST['catsChecked'] == 'true')
		{
		$_SESSION['manuCat'] = $_POST['manuCat'];
		$_SESSION['currentSearchPage'] = 0;
		}
		if($_POST['catsChecked'] == 'false'){
			unset($_SESSION['manuCat']);
			unset($_SESSION['catsChecked']);
			$_SESSION['currentSearchPage'] = 0;
			$_POST['moveValue'] = 0;
		}
		}
		if(!isset($_SESSION['itemsPP']))
		{
			$_SESSION['itemsPP'] = 9;
		}
		if(isset($_POST['moveValue']))
		{
			if((($_SESSION['currentSearchPage']+1) < ($_SESSION['numofpages'])) && ($_POST['moveValue'] == 1))
			{
			$_SESSION['currentSearchPage'] += $_POST['moveValue'];
			}
			if($_SESSION['currentSearchPage'] != 0 && $_POST['moveValue'] == -1)
			{
			$_SESSION['currentSearchPage'] += $_POST['moveValue'];
			}
		}
		if(isset($_POST['itemsPP']))
		{	
		$_SESSION['itemsPP'] = $_POST['itemsPP'];
		}
		if((($_SESSION['currentSearchPage']+1)*$_SESSION['itemsPP']) > $_SESSION['numofProducts'])
		{
			$_SESSION['currentSearchPage'] = floor($_SESSION['numofProducts'] / $_SESSION['itemsPP']);
		}
		if(isset($_POST['keywords']))
		{
		unset($_SESSION['manu']);
		$_SESSION['currentSearchPage'] = 0;
		$_SESSION['keywords'] = $_POST['keywords'];
		$keywords = $_POST['keywords'];
		$originalWord = $keywords;
		$searchTermKeywords = array();
		$arrayofProducts = array();
		$product_tables = array("backpack-specs","bags","central-vacuum-accessories","central-vacuum-specs","commercial-accessories","commercial-specs","household-accessories","household-specs","motors");
		$productList = array();
		$dbname = array();
		$id = array();
		$allProducts = array();
		$allProducts = grabAllFromDB($product_tables);
		echo checkKeyForBrand($allProducts, $keywords);
		sortBySearchPTS($allProducts);
		$serializedArray = serialize($allProducts);
		$_SESSION['arrayOfProducts'] = $serializedArray;
		$_SESSION['relatedProducts'] = $serializedArray;
		if(empty($allProducts))
		{
			$noproduct = TRUE;
		}
		else{
			$noproduct = FALSE;
		}
		//}
		}
		if($noproduct == FALSE)
		{
		echo '<div id="cv-brand-unit" class="rad power-unit698" style="float:left;">';
    	echo '<div id="cv-title-unit" style="margin-top:10px;text-align:center">';
    	echo '<h3 style="color:#FF0;"><a name="attachmentKits"></a>Search Results for the term(s) "' . $_SESSION['keywords'] . '"</h3>';
		echo '<h5 id="pagenum"></h5>';
    	echo '</div>';
		echo '<div class="clr"></div>';
    	echo '<div class="product-container">';
		$arrayofProducts = $_SESSION['arrayOfProducts'];
		$arrayfromSession = unserialize($arrayofProducts);
		if(isset($sortPrice))
			{
			sortByPrice($arrayfromSession, $sortPrice);
			$serializedArray = serialize($arrayfromSession);
			$_SESSION['arrayOfProducts'] = $serializedArray;
			}
		if(isset($sortTitle))
		{
		sortByTitle($arrayfromSession, $sortTitle);
		$serializedArray = serialize($arrayfromSession);
		$_SESSION['arrayOfProducts'] = $serializedArray;
		}
		if(isset($reset))
		{
			$_SESSION['arrayOfProducts'] = $_SESSION['relatedProducts'];
			$arrayofProducts = $_SESSION['arrayOfProducts'];
			$arrayfromSession = unserialize($arrayofProducts);
		}
		$arrayforBrands = array();
		$arrayforBrands = $arrayfromSession;
		$arrayforCats = array();
		$arrayforCats = $arrayfromSession;
		if(isset($_SESSION['brandChecked']) && $_SESSION['brandChecked'] == 'true')
		{
			sortByBrand($arrayforBrands, $_SESSION['manu']);
			if(isset($_SESSION['catsChecked']) && $_SESSION['catsChecked'] == 'true')
			{
			sortByCategory($arrayforBrands, $_SESSION['manuCat']);
			}
			addCatalog2($arrayforBrands);
			$_SESSION['currentProductsArray'] = $arrayforBrands;
		}
		else if(isset($_SESSION['catsChecked']) && $_SESSION['catsChecked'] == 'true')
		{
			sortByCategory($arrayforCats, $_SESSION['manuCat']);
			addCatalog2($arrayforCats);
			$_SESSION['currentProductsArray'] = $arrayforCats;
		}
		else
		{
			sortByBrand($arrayfromSession);
			sortByCategory($arrayfromSession);
			addCatalog2($arrayfromSession);
			$_SESSION['currentProductsArray'] = $arrayfromSession;
		}
    	echo '</div>';
     	echo '</div>';
    	echo '</div>';
		echo '<script>changePrice();validateAddToCart();pageNum();</script>';
		}
		if($noproduct == TRUE){
		unset($_SESSION['arrayOfProducts']);
		sortByBrand($arrayfromSession);
		echo '<div id="cv-brand-unit" class="rad power-unit698" style="float:left;">';
    	echo '<div id="cv-title-unit" style="margin-top:10px;text-align:center">';
    	echo '<h3 style="color:#FF0;"><a name="attachmentKits"></a>Search Results for the term(s) "' . $_SESSION['keywords'] . '"</h3>';
		echo '<h5 id="pagenum"></h5>';
    	echo '</div>';
		echo '<div class="clr"></div>';
    	echo '<div class="product-container">';
		echo '<h4 align="center">No search results found for the term(s) "' . $_SESSION['keywords'] . '"</h4>';
		echo '</div>';
     	echo '</div>';
    	echo '</div>';
		echo '<script>changePrice();validateAddToCart();pageNum();</script>';
		}
	}
	
	
	
	
	

?>