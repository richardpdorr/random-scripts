<?php
	session_start();
	$brandList = array();
	$viewHidden = FALSE;
	if(isset($_SESSION['arrayofBrands']) && isset($_SESSION['numBrands']))
	{
	$brandList = $_SESSION['arrayofBrands'];
	$numBrands = $_SESSION['numBrands'];
	echo '<h2 class="brandheader">Brands</h2><form><select>';
	$i = 0;
	foreach($numBrands as $key => $num)
	{
		echo '<option value="' . $brandList[$key] . '" /></option>';
	}
	}
	echo '</select>';
	echo '</form>';
?>