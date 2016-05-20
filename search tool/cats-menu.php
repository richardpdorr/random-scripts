<?php
	include_once('inc/php-classes.php');
	session_start();
	$brandList = array();
	$viewHidden = FALSE;
	
	if(isset($_POST['currentCat']))
	{
		if($_POST['currentCat'] == 'false')
		{
			if(isset($_SESSION['selectedCat']))
			{
			unset($_SESSION['selectedCat']);
			}
		}
	}
	
	function textforOutput($catList){
		$outputText = array();
		foreach($catList as $category)
		{
		switch($category){
		case 'centralvacuum':
		array_push($outputText, 'Central Vacuums');
		break;
		
		case 'accessories':
		array_push($outputText, 'Accessories');
		break;
		
		case 'bags':
		array_push($outputText, 'Bags');
		break;
		
		case 'filters':
		array_push($outputText, 'Filters');
		break;
		
		case 'wands':
		array_push($outputText, 'Wands');
		break;
		
		case 'wallinlets':
		array_push($outputText, 'Wall Inlets');
		break;
		
		case 'automaticdustpans':
		array_push($outputText, 'Automatic Dustpans');
		break;
		
		case 'hoses':
		array_push($outputText, 'Hoses');
		break;
		
		case 'combokits':
		array_push($outputText, 'Combo Kits');
		break;
		
		case 'powerheads':
		array_push($outputText, 'Power Heads');
		break;
		
		case 'attachments':
		array_push($outputText, 'Attachments');
		break;
		
		case 'attachmentkits':
		array_push($outputText, 'Attachment Kits');
		break;
		
		case 'pipesfittings':
		array_push($outputText, 'Pipes & Fittings');
		break;
		
		case 'mufflers':
		array_push($outputText, 'Mufflers');
		break;
		
		case 'cargarage':
		array_push($outputText, 'Car & Garage');
		break;
		
		case 'motors':
		array_push($outputText, 'Motors');
		break;
		
		
		default:
		array_push($outputText, $category);
		break;
		
			
		}
		}
		
		return $outputText;
	
		
	}
	
	if(isset($_POST['unchecked']) && $_POST['unchecked'] == 'false')
	{
		unset($_SESSION['currentManu']);
	}
	
	
	if(isset($_SESSION['selectedCat']))
	{
	$selectedCat = $_SESSION['selectedCat'];
	}
	
	
	if(isset($_POST['manu']) && $_POST['unchecked'] != 'false')
	{
	$selectedBrand = $_POST['manu'];
	$_SESSION['currentManu'] = $selectedBrand;
	$test = unserialize($_SESSION['arrayOfRelations']);
	$currentBrandCats = $test[$selectedBrand];
	$arrayofAllCats = array();
			$newarray = array();
			$newarray = get_object_vars($currentBrandCats);
			foreach($newarray as $key => $cat)
			{
					if($cat > 0)
					{
						array_push($arrayofAllCats, array($key, $cat));
					}
			}
			if(!empty($arrayofAllCats))
			{
					$newarray = array();
				foreach($arrayofAllCats as $category)
				{
					array_push($newarray, $category[0]);
				}
					$output = textforOutput($newarray);
				echo '<h2 class="brandheader">Categories</h2><form>';
				$i=0;
				foreach($arrayofAllCats as $key => $array)
				{
					if(isset($selectedCat))
					{
					if(array_search($selectedCat, $array) !== FALSE)
					{
						$selectedLocation = $key;
					}
					}
				}
				if(isset($selectedCat))
				{
					$outputText = textforOutput(array($selectedCat));
					echo '<div class="catitem"><input type="checkbox" checked value="' . $selectedCat . '" name="checkboxA' . $i . '" id="checkboxA' . $i . '" class="css-checkbox" /><label for="checkboxA' . $i . '" class="css-label">'. $outputText[0] . ' [' . $arrayofAllCats[$selectedLocation][1] . ']</label></div>';
					$i++;
				}
				foreach($arrayofAllCats as $key => $category)
				{
					if(isset($selectedCat) && $selectedCat == $arrayofAllCats[$key][0]){continue;}
					echo '<div class="catitem"><input type="checkbox" value="' . $category[0] . '" name="checkboxA' . $key . '" id="checkboxA' . $key . '" class="css-checkbox" /><label for="checkboxA' . $key . '" class="css-label">'. $output[$key] . ' [' . $category[1] . ']</label></div>';
					$i++;
				}
				echo '</form>';
			}
		
	}
		
	else if(isset($_SESSION['arrayofCats']) && isset($_SESSION['numCats']))
	{
	$brandList = $_SESSION['arrayofCats'];
	$numBrands = $_SESSION['numCats'];
	$outputList = array();
	$outputList = textforOutput($brandList);
	echo '<h2 class="brandheader">Categories</h2><form>';
	$i = 0;
	$maxi = count($numBrands) - 1;
	if(isset($selectedCat))
	{		
	$currentkey = array_search($selectedCat, $brandList);
	$output = textforOutput(array($selectedCat));
	echo '<div class="catitem"><input type="checkbox" checked value="' . $selectedCat . '" name="checkboxA' . $currentkey . '" id="checkboxA' . $currentkey . '" class="css-checkbox" /><label for="checkboxA' . $currentkey . '" class="css-label">'. $output[0] . ' [' . $numBrands[$currentkey] . ']</label></div>';
	}
	foreach($numBrands as $key => $num)
	{
		if(isset($currentkey))
		{
		if($key == $currentkey){$i++; continue;}
		}
		echo '<div class="catitem"><input type="checkbox" value="' . $brandList[$key] . '" name="checkboxA' . $key . '" id="checkboxA' . $key . '" class="css-checkbox" /><label for="checkboxA' . $key . '" class="css-label">'. $outputList[$key] . ' [' . $num . ']</label></div>';
		if(($i == 4) && ($i != $maxi) && ((!isset($_POST['showAllCats'])) || (isset($_POST['showAllCats']) && $_POST['showAllCats'] == FALSE)))
		{
			echo '<div class="catviewshow"><a href="#">View More</a></div>';
			$viewHidden = TRUE;
			break;
		}
		else if($i == $maxi && $i <= 4)
		{
			$viewHidden = TRUE;
		}
		$i++;
	}
	if ($viewHidden == FALSE && !($i <= 4))
	{
	echo '<div class="catviewhide"><a href="#">Show Less</a></div>';
	}
	}
	else
	{
	echo '<p>No categories to be displayed.</p>';
	}
	echo '</form>';
?>