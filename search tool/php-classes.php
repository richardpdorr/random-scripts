<?php

class Product
{
	public $id;
	public $manufacturer;
	public $live;
	public $model;
	public $price;
	public $rating;
	public $imgFull;
	public $imgThumb;
	public $webFull;
	public $webThumb;
	public $comments;
	public $options;
	public $optionVars;
	public $link;
	public $feed;
	
	public function setProductVars($arraylist){
	$this->id = $arraylist['ID'];
	$this->live = $arraylist['Live'];
	$this->manufacturer = $arraylist['Manufacturer'];
	$this->model = $arraylist['Model'];
	$this->price = $arraylist['Price'];
	$this->rating = $arraylist['Rating'];
	$this->imgFull = $arraylist['imgFull'];
	$this->imgThumb = $arraylist['imgThumbnail'];
	$this->webFull = $arraylist['webFull'];
	$this->webThumb = $arraylist['webThumbnail'];
	$this->comments = $arraylist['Comments'];
	$this->options = $arraylist['Options'];
	$this->optionVars = $arraylist['OptionVars'];
	$this->link = $arraylist['Link'];
	$this->feed = $arraylist['Feed'];
	$this->category = $arraylist['Category'];
	$this->searchPTS = 0;
	
	}
	
	function WhoAreYou()
	{
		echo $this->id;
		echo '<br/>';
		echo $this->manufacturer;
		echo '<br/>';
		echo $this->model;
		echo '<br/>';
		echo $this->price;
		echo '<br/>';
	}
	
	
}
		
class Brand
{
	public $centralvacuum;
	public $accessories;
	public $bags;
	public $filters;
	public $wands;
	public $wallinlets;
	public $automaticdustpans;
	public $hoses;
	public $combokits;
	public $powerheads;
	public $attachments;
	public $attachmentkits;
	public $pipesandfits;
	public $cargarage;
	public $motors;
	
	public function setProductVars(){
		
	$this->centralvacuum = 0;
	$this->accessories = 0;
	$this->bags = 0;
	$this->filters = 0;
	$this->wands = 0;
	$this->wallinlets = 0;
	$this->automaticdustpans = 0;
	$this->hoses = 0;
	$this->combokits = 0;
	$this->powerheads = 0;
	$this->attachments = 0;
	$this->attachmentkits = 0;
	$this->pipesandfits = 0;
	$this->cargarage = 0;
	$this->motors = 0;
	
	}
	
	
}



?>