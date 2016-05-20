<?php
	session_start();
	include_once('inc/functions.php');
	include_once('inc/header.php');
	
	function grabAllFromDB($product_tables)
	{
		$newarray = array();
		foreach ($product_tables as $table)
		{
		$sql = "SELECT * FROM `" . $table;
		$result = $GLOBALS["db"]->query($sql);
		$details = $GLOBALS["db"]->fetch_array($result);
		while($details = $GLOBALS["db"]->fetch_array($result)){
			$product = new Product();
			$product->setProductVars($details);
			array_push($newarray, $product);
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
				
				default:
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
		$searchTermKeywords[] = "((`Model` LIKE '%" . $keywords . "%') AND (`Price` != '0.00' AND `Live` != '0') OR (`Manufacturer` LIKE '%" . $keywords . "%'))"  . " AND (`Price` != '0.00' AND `Live` != '0')";
		foreach ($product_tables as $table)
		{
		
		$sql = "SELECT * FROM `" . $table . "` WHERE ".implode(' OR ', $searchTermKeywords) . "";
		$result = $GLOBALS["db"]->query($sql);
		$details = $GLOBALS["db"]->fetch_array($result);
		if(empty($details) && empty($arrayofProducts))
		{
			$noproduct = TRUE;
		}
		else{
		while($details = $GLOBALS["db"]->fetch_array($result)){
			$noproduct = FALSE;
			$product = new Product();
			$product->setProductVars($details);
			array_push($arrayofProducts, $product);
			$serializedArray = serialize($arrayofProducts);
			$_SESSION['arrayOfProducts'] = $serializedArray;
		}
		}
		}
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
		$arrayforBrands = array();
		$arrayforBrands = $arrayfromSession;
		if(isset($_SESSION['brandChecked']) && $_SESSION['brandChecked'] == 'true')
		{
			sortByBrand($arrayforBrands, $_SESSION['manu']);
			addCatalog2($arrayforBrands);
		}
		else
		{
			sortByBrand($arrayfromSession);
			addCatalog2($arrayfromSession);
		}
    	echo '</div>';
     	echo '</div>';
    	echo '</div>';
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
		$allProducts = array();
		$allProducts = grabAllFromDB($product_tables);
		echo checkKeyForBrand($allProducts, $keywords);
		sortBySearchPTS($allProducts);
		addCatalog2($allProducts);
		}
	}
	
	
	
	
	

?>