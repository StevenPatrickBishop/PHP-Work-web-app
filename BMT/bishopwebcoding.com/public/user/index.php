<?php require_once('../../private/initialize.php');?>
<?php $page_title = 'BMT - USER'?>
<?php $area_heading = 'BMT User Area'?>
<?php include(SHARED_PATH . '/admin_header.php');?>

<div class="page-wrap">
  	<div class='main-menu'>
		<h2>Main Menu</h2> 
		<ul>
			<li><a href="<?php echo url_for('user/index.php');?>">Home</a></li>
			<li><a href="cleaning/index.php">Cleaning</a></li>
			
			
		</ul>
	</div>
  <div class="content"></div>
</div>
<?php include( SHARED_PATH .'admin_footer.php');?>