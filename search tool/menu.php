<?php
	session_start();
	
	
	if($_POST['menubar'] == 'itemsPP')
	{
	$sizes = array(9,12,15,18);
	$currentSelected = $_POST['selected'];
	$_SESSION['menuoption'] = $currentSelected;
	if(($key = array_search($currentSelected, $sizes)) !== FALSE)
	{
		unset($sizes[$key]);
	}
	echo '<option>' . $currentSelected . '</option>';
	foreach($sizes as $option)
	{
	echo '<option>' . $option . '</option>';
	}
	}
		
	if(isset($_SESSION['menuoption']) && !(isset($_POST['menubar'])))
	{
		$sizes = array(9,12,15,18);
		if(($key = array_search($_SESSION['menuoption'], $sizes)) !== FALSE)
		{
		unset($sizes[$key]);
		}
	echo '<option>' . $_SESSION['menuoption'] . '</option>';
	foreach($sizes as $option)
	{
	echo '<option>' . $option . '</option>';
	}
	}
	
	else if(!(isset($_POST['menubar'])))
	{
		$sizes = array(9,12,15,18);
		foreach($sizes as $option)
	{
	echo '<option>' . $option . '</option>';
	}
	}
		
?>