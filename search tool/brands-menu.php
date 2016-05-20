<?php
	session_start();
	$brandList = array();
	$viewHidden = FALSE;
	
	if(isset($_POST['brandChecked']))
	{
		if($_POST['brandChecked'] == 'false')
		{
			if(isset($_SESSION['currentManu']))
			{
			unset($_SESSION['currentManu']);
			}
		}
	}
	
	function textforOutput($brandList){
		$outputText = array();
		foreach($brandList as $brand)
		{
		switch($brand){
		case 'astrovac':
		array_push($outputText, 'AstroVac');
		break;
		
		case 'beam':
		array_push($outputText, 'Beam');
		break;
		
		case 'blackanddecker':
		array_push($outputText, 'Black and Decker');
		break;
		
		case 'budd':
		array_push($outputText, 'Budd');
		break;
		
		case 'cana-vac':
		array_push($outputText, 'Cana-Vac');
		break;
		
		case 'dirtdevil':
		array_push($outputText, 'Dirt Devil');
		break;
		
		case 'drainvac':
		array_push($outputText, 'DrainVac');
		break;
		
		case 'dustcare':
		array_push($outputText, 'Dustcare');
		break;
		
		case 'easy-flo':
		array_push($outputText, 'Easy-Flo');
		break;
		
		case 'electrolux':
		array_push($outputText, 'Electrolux');
		break;
		
		case 'fasco':
		array_push($outputText, 'Fasco');
		break;
		
		case 'filtex':
		array_push($outputText, 'Filtex');
		break;
		
		case 'honeywell':
		array_push($outputText, 'Honeywell');
		break;
		
		case 'hoover':
		array_push($outputText, 'Hoover');
		break;
		
		case 'kenmore':
		array_push($outputText, 'Kenmore');
		break;
		
		case 'nutone':
		array_push($outputText, 'NuTone');
		break;
		
		case 'patton':
		array_push($outputText, 'Patton');
		break;
		
		case 'pullman-holt':
		array_push($outputText, 'Pullman-Holt');
		break;
		
		case 'purvac':
		array_push($outputText, 'PurVac');
		break;
		
		case 'sequoia':
		array_push($outputText, 'Patton');
		break;
		
		case 'signature':
		array_push($outputText, 'Patton');
		break;
		
		case 'simplicity':
		array_push($outputText, 'Patton');
		break;
		
		case 'smart':
		array_push($outputText, 'Patton');
		break;
		
		case 'vacuflo':
		array_push($outputText, 'Patton');
		break;
		
		case 'valet':
		array_push($outputText, 'Patton');
		break;
		
		case 'walvac':
		array_push($outputText, 'WalVac');
		break;
		
		case 'whirlpool':
		array_push($outputText, 'Whirlpool');
		break;
		
		case 'zenex':
		array_push($outputText, 'Zenex');
		break;
		
		case 'vent-a-vac':
		array_push($outputText, 'Vent-A-Vac');
		break;
		
		case 'duovac':
		array_push($outputText, 'DuoVac');
		break;
		
		case 'deluxe':
		array_push($outputText, 'Deluxe');
		break;
		
		case 'hayden':
		array_push($outputText, 'Hayden');
		break;
		
		case 'nadair':
		array_push($outputText, 'Nadair');
		break;
		
		case 'powerstar':
		array_push($outputText, 'Power Star');
		break;
		
		case 'generic':
		array_push($outputText, 'Generic');
		break;
		
		case 'eureka':
		array_push($outputText, 'Eureka');
		break;
		
		case 'royal':
		array_push($outputText, 'Royal');
		break;
		
		case 'sanitaire':
		array_push($outputText, 'Sanitaire');
		break;
		
		case 'intervac':
		array_push($outputText, 'InterVac');
		break;
		
		case 'frigidaire':
		array_push($outputText, 'Frigidaire');
		break;
		
		case 'brute':
		array_push($outputText, 'Brute');
		break;
		
		case 'sebo':
		array_push($outputText, 'SEBO');
		break;
		
		case 'aggresor':
		array_push($outputText, 'Aggresor');
		break;
		
		case 'flipbus':
		array_push($outputText, 'FlipBUS');
		break;
		
		case 'featherlite':
		array_push($outputText, 'FeatherLite');
		break;
		
		case 'miele':
		array_push($outputText, 'Miele');
		break;
		
		case 'bissell':
		array_push($outputText, 'Bissell');
		break;
		
		case 'bosch':
		array_push($outputText, 'Bosch');
		break;
		
		case 'samsung':
		array_push($outputText, 'Samsung');
		break;
		
		case 'airvac':
		array_push($outputText, 'AirVac');
		break;
		
		case 'oreck':
		array_push($outputText, 'Oreck');
		break;
		
		case 'sharp':
		array_push($outputText, 'Sharp');
		break;
		
		case 'regina':
		array_push($outputText, 'Regina');
		break;
		
		case 'riccar':
		array_push($outputText, 'Riccar');
		break;
		
		case 'md':
		array_push($outputText, 'Modern Day');
		break;
		
		case 'riccar':
		array_push($outputText, 'Riccar');
		break;
		
		case 'proteam':
		array_push($outputText, 'ProTeam');
		break;
		
		case 'ge':
		array_push($outputText, 'General Electric');
		break;
		
		case 'filterqueen':
		array_push($outputText, 'FilterQueen');
		break;
		
		case 'vacumaid':
		array_push($outputText, 'VacuMaid');
		break;
		
		case 'cirrus':
		array_push($outputText, 'Cirrus');
		break;
		
		case 'kirby':
		array_push($outputText, 'Kirby');
		break;
		
		case 'yellowjacket':
		array_push($outputText, 'Yellow Jacket');
		break;
		
		case 'sanyo':
		array_push($outputText, 'Sanyo');
		break;
		
		default:
		array_push($outputText, $brand);
		break;
		
		
		
			
		}
		}
		
		return $outputText;
	
		
	}
	
	if(isset($_POST['unchecked']) && $_POST['unchecked'] == 'false')
	{
		unset($_SESSION['selectedCat']);
	}
	
	if(isset($_POST['unchecked']) && $_POST['unchecked'] == 'true')
	{
		if(isset($_POST['selectedCat']))
		{
			$selectedCat = $_POST['selectedCat'];
			$checkedCategory = TRUE;
		}
	}
	
	
	if(isset($checkedCategory) && $checkedCategory == TRUE  || isset($_SESSION['selectedCat']))
	{
	$maxNumBrands = 4;
	if(isset($_POST['selectedCat']))
	{
	$_SESSION['selectedCat'] = $selectedCat;
	}
	else
	{
	$selectedCat = $_SESSION['selectedCat'];
	}
	if(isset($_SESSION['currentManu']))
	{
	$selectedBrand = $_SESSION['currentManu'];
	}
	$relations = unserialize($_SESSION['arrayOfRelations']);
	$manuObjects = array();
	$newManufacturers = array();
	//echo '<h2 class="brandheader">Brands</h2><form>';
	//echo '<div class="branditem"><input type="checkbox" checked value="' . $selectedBrand . '" name="checkboxG' . $key . '" id="checkboxG' . $key . '" class="css-checkbox" /><label for="checkboxG' . $key . '" class="css-label">'. $outputList[$key] . ' [' . $numBrands[$key] . ']</label></div>';
	foreach($relations as $key => $manufacturer)
	{
		$manuObjects = get_object_vars($manufacturer);
		if($manuObjects[$selectedCat] != 0)
		{
			$newManufacturers[$key] = $manuObjects[$selectedCat];
		}
	}
	$arrayofKeys = array();
	foreach($newManufacturers as $key => $manu)
	{
		array_push($arrayofKeys, $key);
	}
	$outputList = textforOutput($arrayofKeys);
	$i= 0;
	$maxi = count($newManufacturers) - 1;
	echo '<h2 class="brandheader">Brands</h2><form>';
	if(isset($selectedBrand))
	{
	$location = array_search($selectedBrand, $arrayofKeys);
	echo '<div class="branditem"><input type="checkbox" checked value="' . $selectedBrand . '" name="checkboxG' . $location . '" id="checkboxG' . $location . '" class="css-checkbox" /><label for="checkboxG' . $location . '" class="css-label">'. $outputList[$location] . ' [' . $newManufacturers[$selectedBrand] . ']</label></div>';
	}
	foreach($newManufacturers as $key => $manu)
	{
		if(isset($selectedBrand) && $selectedBrand == $arrayofKeys[$i]){$i++; continue;}
	echo '<div class="branditem"><input type="checkbox" value="' . $key . '" name="checkboxG' . $i . '" id="checkboxG' . $i . '" class="css-checkbox" /><label for="checkboxG' . $i . '" class="css-label">'. $outputList[$i] . ' [' . $manu . ']</label></div>';
	if(($i == $maxNumBrands) && ($i != $maxi) && ((!isset($_POST['showAll'])) || (isset($_POST['showAll']) && $_POST['showAll'] == FALSE)))
		{
			echo '<div class="viewshow"><a href="#">View More</a></div>';
			$viewHidden = TRUE;
			break;
		}
		else if($i == $maxi && $i <= $maxNumBrands)
		{
			$viewHidden = TRUE;
		}
		$i++;
	}
	echo '</form>';
	
		
	}
	else if(isset($_SESSION['arrayofBrands']) && isset($_SESSION['numBrands']))
	{
	$brandList = $_SESSION['arrayofBrands'];
	$numBrands = $_SESSION['numBrands'];
	$outputList = array();
	$outputList = textforOutput($brandList);
	echo '<h2 class="brandheader">Brands</h2><form>';
	$i = 0;
	$maxNumBrands = 4;
	$maxi = count($numBrands) - 1;
	if(isset($_SESSION['currentManu']))
	{
		$maxNumBrands = 3;
		$currentManu = $_SESSION['currentManu'];
		$key = array_search($currentManu, $brandList);
	echo '<div class="branditem"><input type="checkbox" checked value="' . $currentManu . '" name="checkboxG' . $key . '" id="checkboxG' . $key . '" class="css-checkbox" /><label for="checkboxG' . $key . '" class="css-label">'. $outputList[$key] . ' [' . $numBrands[$key] . ']</label></div>';
	}
	foreach($numBrands as $key => $num)
	{
		if(isset($currentManu) && $currentManu == $brandList[$key]){continue;}
		echo '<div class="branditem"><input type="checkbox" value="' . $brandList[$key] . '" name="checkboxG' . $key . '" id="checkboxG' . $key . '" class="css-checkbox" /><label for="checkboxG' . $key . '" class="css-label">'. $outputList[$key] . ' [' . $num . ']</label></div>';
		if(($i == $maxNumBrands) && ($i != $maxi) && ((!isset($_POST['showAll'])) || (isset($_POST['showAll']) && $_POST['showAll'] == FALSE)))
		{
			echo '<div class="viewshow"><a href="#">View More</a></div>';
			$viewHidden = TRUE;
			break;
		}
		else if($i == $maxi && $i <= $maxNumBrands)
		{
			$viewHidden = TRUE;
		}
		$i++;
	}
	if ($viewHidden == FALSE && !($i <= $maxNumBrands))
	{
	echo '<div class="viewhide"><a href="#">Show Less</a></div>';
	}
	}
	else
	{
	echo '<p>No brands to be displayed.</p>';
	}
	echo '</form>';