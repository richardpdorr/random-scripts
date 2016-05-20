<?php
//$PW = $_GET['v'];

//if($PW != "0391")
//{
//	echo 'ACCESS DENIED';
//	exit;
//}

include_once ('inc/header.php');
session_start();
	if(!isset($_SESSION['itemPP']))
	{
		$_SESSION['itemPP'] = 9;
	}?>

<html>
<head>
		<?php include dots('css/global-css.php'); ?>
		<?php include dots('inc/analytics.php'); ?>
		<?php include dots('js/global-js.php'); ?>
	<script type="text/javascript">
	function pageNum(){
		{
			$.ajax({
	  					url: "page-num.php",
                    	success: function(response){
						$('#pagenum').html(response);  
                    	}
						
						}); 
		}
		}
		
	window.onload = function () {
		$('.result').load('parse_table_new.php');
		$('.brands').load('brands-menu.php');
		$('.categories').load('cats-menu.php');
		$('.itemsPP').load('menu.php');
		$('.itemsSort').load('menu-two.php');
		   

	}
	
$(document).on("change", ".brands input", function(){
    $('.brands input').not(this).prop('checked', false);
	var infoPO = $(this).prop('checked');
	var uncheck = $(this).is(':checked');
	var infoM = $(this).attr('value');
	$.ajax({
	  				url: "parse_table_new.php",
                    type: "POST",
					data: {"brandChecked":infoPO, "manu":infoM},
                    success: function(response){
						$('.result').html(response); 
						
						
					$.ajax({
	  				url: "cats-menu.php",
                    type: "POST",
					data: {"manu":infoM,"unchecked":uncheck},
                    success: function(response){
						$('.categories').html(response);   
						
					
 							 $.ajax({
	  							url: "brands-menu.php",
                    			type: "POST",
								data: {"brandChecked":uncheck},
                    			success: function(response){
								$('.brands').html(response);
						   
                   				 }
                	 			});
					}
					
					});  
  
						
					}
  
});
});

$(document).on("change", ".categories input", function(){
    $('.categories input').not(this).prop('checked', false);
	var infoPO = $(this).prop('checked');
	var uncheck = $(this).is(':checked');
	var infoM = $(this).attr('value');
	$.ajax({
	  				url: "parse_table_new.php",
                    type: "POST",
					data: {"catsChecked":infoPO, "manuCat":infoM},
                    success: function(response){
						$('.result').html(response);  
						
						$.ajax({
	  					url: "brands-menu.php",
                    	type: "POST",
						data: {"selectedCat":infoM,"unchecked":uncheck},
                    	success: function(response){
						$('.brands').html(response);
						
 							 $.ajax({
	  							url: "cats-menu.php",
                    			type: "POST",
								data: {"currentCat":uncheck},
                    			success: function(response){
								$('.categories').html(response);
						   
                   				 }
                	 			});
						}
						});
					}
  
});
});
		
$(document).on('click','.next', function(event){ 
	event.preventDefault();
	var infoPO = 1;
  $.ajax({
	  				url: "parse_table_new.php",
                    type: "POST",
					data: {"moveValue":infoPO},
                    success: function(response){
						$('.result').html(response);  
                    }
                 });
});





$(document).on('click','.prev', function(event){
	event.preventDefault();
	var infoPO = -1;
  $.ajax({
	  				url: "parse_table_new.php",
                    type: "POST",
					data: {"moveValue":infoPO},
                    success: function(response){
						$('.result').html(response);
						   
                    }
                 });
  
});

$(document).on('click','.viewshow', function(event){
	event.preventDefault();
	var infoPO = 1;
  $.ajax({
	  				url: "brands-menu.php",
                    type: "POST",
					data: {"showAll":infoPO},
                    success: function(response){
						$('.brands').html(response);
						   
                    }
                 });
  
});



$(document).on('click','.viewhide', function(event){
	event.preventDefault();
	var infoPO = 0;
  $.ajax({
	  				url: "brands-menu.php",
                    type: "POST",
					data: {"showAll":infoPO},
                    success: function(response){
						$('.brands').html(response); 
						   
                    }
                 });
  
});



$(document).on('click','.catviewshow', function(event){
	event.preventDefault();
	var infoPO = 1;
  $.ajax({
	  				url: "cats-menu.php",
                    type: "POST",
					data: {"showAllCats":infoPO},
                    success: function(response){
						$('.categories').html(response);
						   
                    }
                 });
  
});



$(document).on('click','.catviewhide', function(event){
	event.preventDefault();
	var infoPO = 0;
  $.ajax({
	  				url: "cats-menu.php",
                    type: "POST",
					data: {"showAllCats":infoPO},
                    success: function(response){
						$('.categories').html(response); 
						   
                    }
                 });
  
});



$(document).on('change','.itemsPP', function(event){
	event.preventDefault();
	var infoPO = $('.itemsPP option:selected').text();
  $.ajax({
	  				url: "parse_table_new.php",
                    type: "POST",
					data: {"itemsPP":infoPO},
                    success: function(response){
						$('.result').html(response);
						 
						
						$.ajax({
	  					url: "menu.php",
                   		type: "POST",
						data: {"selected":infoPO, "menubar":"itemsPP"},
                    	success: function(response){
						$('.itemsPP').html(response);  
                    	}
						
						});
					
					}
  		});
});

$(document).on('change','.itemsSort', function(event){
	event.preventDefault();
	var infoPO = $('.itemsSort option:selected').attr("name");
	var menuTxt = $('.itemsSort option:selected').text();
  $.ajax({
	  				url: "parse_table_new.php",
                    type: "POST",
					data: {"sortbythis":infoPO},
                    success: function(response){
						$('.result').html(response);
						
						$.ajax({
	  					url: "menu-two.php",
                   		type: "POST",
						data: {"selected":menuTxt,"name":infoPO, "menubar":"itemsSort"},
                    	success: function(response){
						$('.itemsSort').html(response);  
                    	}
						
						});
											
					}
  		});
});			
		


$(document).on('submit','#searchform', function(event){ 	
	event.preventDefault();
	var infoPO = $('#search').val();
  $.ajax({
	  				url: "parse_table_new.php",
                    type: "POST",
					data: {"keywords":infoPO},
                    success: function(response){  
						$('.result').html(response);
						
						$.ajax({
	  					url: "brands-menu.php",
                    	success: function(response){
						$('.brands').html(response);
                    	}
						
						}); 
						
						$.ajax({
	  					url: "cats-menu.php",
                    	success: function(response){
						$('.categories').html(response);
                    	}
						
						}); 
                    }
				
                 });
});
	
	
</script>
<style type="text/css">
	html,body {
		padding:10px;
	}
	.product-table{
		float:left;
		width:100%;
		border: #000 5px solid;
	}
	
	.itemsPP {
		width:50px;
		margin-bottom:0;
	}
	
	.next,.prev {
		float:right;
		display:inline-block;
		border:1px solid #CCC;
		padding:8px;
	}
	
	.prev{
		margin-right:10px;
	}
	
	.items {
		float:left;
		padding:0px;
	}
	
	.items span {
		padding: 5px;
	}
	
	.brands {
		width:180px;
		display:inline-block;
		float:left;
		clear:left;
		margin: 0;
		margin-right:-1px;
		margin-top:70px;
		padding-top:0;
	}
	
	label
	{
		font-size:11px;
	}
	
	.categories {
		min-height:241px;
		width:180px;
		display:inline;
		float:left;
		clear:left;
		margin: 0;
		margin-right:-1px;
		padding-top:0;
	}
	
	.brands form {
		padding:15px;
		margin-top:10px;
		border:1px solid #CCC;
	}
	
	
	
	.categories form {
		box-sizing:border-box;
		min-height:176px;
		padding:15px;
		margin-top:10px;
		border:1px solid #CCC;
	}
	
	.itemsSort {
		width:200px;
		float:left;
	}
	
	.sortheader{
		display:inline;
		float:left;
		padding:5px;
	}
	
	#pagenum {
		height:20px;
		color:#000;
		background:#FFF;
	}
	input[type=checkbox].css-checkbox {
							position:absolute; z-index:-1000; left:-1000px; overflow: hidden; clip: rect(0 0 0 0); height:1px; width:1px; margin:-1px; padding:0; border:0;
						}

						input[type=checkbox].css-checkbox + label.css-label {
							padding-left:23px;
							height:20px; 
							display:inline-block;
							line-height:20px;
							background-repeat:no-repeat;
							background-position: 0 0;
							vertical-align:middle;
							cursor:pointer;

						}

						input[type=checkbox].css-checkbox:checked + label.css-label {
							background-position: 0 -20px;
						}
						label.css-label {
				background-image:url(http://csscheckbox.com/checkboxes/u/csscheckbox_712a79e2b53b8c551e3dbac3d74944bf.png);
				-webkit-touch-callout: none;
				-webkit-user-select: none;
				-khtml-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
			}
			
			.brandheader {
				text-align:center;
				width:calc(100% - 10px);
				margin-top:0;
				color:#FFF!important;
				background: #0e7ba6; /* Old browsers */
background: -moz-linear-gradient(top, #0e7ba6 0%, #014e81 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#0e7ba6), color-stop(100%,#014e81)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #0e7ba6 0%,#014e81 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #0e7ba6 0%,#014e81 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #0e7ba6 0%,#014e81 100%); /* IE10+ */
background: linear-gradient(to bottom, #0e7ba6 0%,#014e81 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0e7ba6', endColorstr='#014e81',GradientType=0 ); /* IE6-9 */;
				
			}
			
			#cv-brand-unit {
				border:none;
			}
			
			#cv-title-unit {
				position:absolute;
				top:80px;
				width:700px;
				left:147px;
			}
			
			#cv-brand-unit h3 {
				color:#FFF!important;
				background: #0e7ba6; /* Old browsers */
background: -moz-linear-gradient(top, #0e7ba6 0%, #014e81 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#0e7ba6), color-stop(100%,#014e81)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #0e7ba6 0%,#014e81 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #0e7ba6 0%,#014e81 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #0e7ba6 0%,#014e81 100%); /* IE10+ */
background: linear-gradient(to bottom, #0e7ba6 0%,#014e81 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0e7ba6', endColorstr='#014e81',GradientType=0 ); /* IE6-9 */;
			}
			
			.brandsnew{background: #0e7ba6; /* Old browsers */
background: -moz-linear-gradient(top, #0e7ba6 0%, #014e81 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#0e7ba6), color-stop(100%,#014e81)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #0e7ba6 0%,#014e81 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #0e7ba6 0%,#014e81 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #0e7ba6 0%,#014e81 100%); /* IE10+ */
background: linear-gradient(to bottom, #0e7ba6 0%,#014e81 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0e7ba6', endColorstr='#014e81',GradientType=0 ); /* IE6-9 */;
			}
			
			
			#searchform {
				margin-left:auto;
				margin-right:auto;
				width:700px;
				height:auto;
				background: #d8d8d8 url('http://www.google.com/cse/images/look/cse_theme_shiny_form_bg.png') repeat-x top left;
				border: 1px solid #cccccc;
				margin-bottom:100px;
			}
			
			#searchform input{
				border-radius: 0;
				border: 1px solid #B6BEC5;
				padding:6px 4px !important;
				margin: 7px 0 7px 6px !important;
				width:80%;
			}
			
			#searchform button{
				background: #d0d1d4;
				padding:6px 8px;
				font-weight:bold;
				border: 1px solid #B6BEC5;
			}
			
			.search-container {
				width: 900px;
			}
			.sortby {
				display:inline-block;
				margin-left:30px;
			}
			
			.search-filters{
				width:700px;
				margin-left:auto;
				margin-right:auto;
			}
			.result {
				display:inline-block;
				float:right;
			}
			
			h4 {
			padding:50px;
			}
</style>
</head>
<body>
<div class="search-container">
<form id="searchform" method="post">
<input type="text" name="search" id="search">
<button type="submit">Search</button>
</form>

<div class="search-filters">

<div class="items">
<span>Display </span>
<select class="itemsPP">
<option>9</option>
<option>12</option>
<option>15</option>
<option>18</option>
</select>
<span> products per page</span>
</div>

<div class="sortby">
<span class="sortheader">Sort by:</span>
<select class="itemsSort">
<option name="pop">Most Relative</option>
<option name="pricelow">Price - Low to High</option>
<option name="pricehigh">Price - High to Low</option>
<option name="titlow">Title - A to Z</option>
<option name="tithigh">Title - Z to A</option>
</select>
</div>

<button class="next">Next</button>
<button class="prev">Previous</button>

</div>


<div class="brands">
</div>

<div class="result"></div>

<div class="categories">
</div>
</div>
</body>
</html>