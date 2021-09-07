<?php require_once('../../../../private/initialize.php');?>
<?php include "../../../../../DB/database.php";?>

<?php $page_title = 'BMT - CLEANING'?>
<?php $area_heading = 'Admin - Delete Section'?>
<?php include(SHARED_PATH . '/admin_header.php');?>




<?php
// form handle

if(isset($_POST['removing_set_confirm'])){

    $id = $_POST['id'];

    $query = "DELETE FROM sub_sets
              WHERE set_id = '$id'";

     $dbc = db_connect();
     mysqli_query( $dbc, $query );          
    
     $query = "DELETE FROM sets
     WHERE set_id = '$id'";

    mysqli_query( $dbc, $query ); 


     db_disconnect($dbc);
  
     header('location: ../set_tasks.php');
     exit();

}

?>


<!-----------------------------------------Page Markup--------------------------------------->
<div class="page-wrap">
	
	<div class='main-menu'>
		<h2>Main Menu</h2> 
		<ul>
			<li><a href="<?php echo url_for('admin/index.php');?>">Home</a></li>
			<li><a href="../users/index.php">Users</a></li>
			<li><a href="../cleaning/index.php">Cleaning</a></li>
			<li><a href="set_tasks.php">Add Cleaning Task</a></li>
			<li><a href="../batchgrades/index.php">Batchgrades</a></li>
		</ul>
	</div>
	
	<div class="content">

<!--	catch incoming form-->
    <?php if(isset($_POST['removing_set']))
    
//        $name = $_POST['name'];
        $id = $_POST['set_to_delete'];
		
		
		$query = "SELECT set_name from sets WHERE set_id = '$id'";
		
		$dbc = db_connect();
		
		if ( $r = mysqli_query( $dbc, $query ) ) {
			while ( $record = mysqli_fetch_array( $r ) ) {
				$name = $record['set_name'];
			}
		}
		
		db_disconnect($dbc);

        echo "
            <h2>Confrim delete of $name?</h2>
            <div class='form_wrap'>
            <a href='../set_tasks.php'><button class='form-button'>Back</button></a>
            <form action='' method='post'>
                <input name='id' type='hidden' value = '$id'>
                <input class='form-button' name='removing_set_confirm' type='submit' value = 'Remove Set'>
            </form>
        </div>
        ";
    
    
    ?>

        

        
      


    </div>
	
</div>
<?php include( SHARED_PATH .'/admin_footer.php');?>
