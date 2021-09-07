<?php error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
<?php session_start(); ?>
<?php ob_start(); ?>
<?php if(!isset($page_title)){$page_title = 'BMT - Staff Page';} ?>
<?php if(!isset($page_title)){$area_heading = 'BMT Staff Area';} ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $page_title ?></title>
<link href="<?php echo url_for('styles/style.css');?>" rel="stylesheet" type="text/css" media="all">
</head>
<body>
<header>
	<div class="logo">
		<img id="header-logo" src="../../../images/headerLogo.svg" alt="logo"/> 
	</div>
	<div class="header_heading">
		<h1><?php echo $area_heading ?></h1>
		<div class='date-heading'>
			<h3><?PHP echo date("l F j, Y")?></h3>
		</div>
	</div>
</header>