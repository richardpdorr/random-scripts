<?php
	session_start();
	
	
	if($_POST['menubar'] == 'itemsSort')
	{
		$options = array(array('pop', 'Most Relative'), array('pricelow', 'Price - Low to High'), array('pricehigh', 'Price - High to Low'), array('titlow', 'Title - A to Z'), array('tithigh', 'Title - Z to A'));
		$currentSelected = array($_POST['name'], $_POST['selected']);
		$_SESSION['menuoptiontwo'] = $_POST['selected'];
		if(($key = array_search($currentSelected, $options)) !== FALSE)
		{
			echo '<option name="' . $currentSelected[0] . '">' . $currentSelected[1] . '</option>';
			unset($options[$key]);
		}
		foreach($options as $option)
		{
		echo '<option name="' . $option[0] . '">' . $option[1] . '</option>';
		}
	}
	
	if(isset($_SESSION['menuoptiontwo']) && !(isset($_POST['menubar'])))
	{
		$check = array('Most Relative', 'Price - Low to High', 'Price - High to Low', 'Title - A to Z', 'Title - Z to A');
		$names = array('pop', 'pricelow', 'pricehigh', 'titlow', 'tithigh');
		if(($key = array_search($_SESSION['menuoptiontwo'], $check)) !== FALSE)
		{
		echo '<option name="' . $names[$key] . '">' . $_SESSION['menuoptiontwo'] . '</option>';
		unset($check[$key]);
		unset($names[$key]);
		}
		foreach($check as $key => $option)
		{
		echo '<option name="' . $names[$key] . '">' . $option . '</option>';
		}
	}
	
	else if(!(isset($_POST['menubar'])))
	{
		$options = array(array('pop', 'Most Relative'), array('pricelow', 'Price - Low to High'), array('pricehigh', 'Price - High to Low'), array('titlow', 'Title - A to Z'), array('tithigh', 'Title - Z to A'));
		foreach($options as $option)
	{
		echo '<option name="' . $option[0] . '">' . $option[1] . '</option>';
	}
	}
		
?>