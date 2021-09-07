<?php
$set_index = "delete_set".$set_id;
if(isset($_POST[$set_index])){
	// delete tasks
	
	$query = "DELETE FROM tasks
			  WHERE parent_set = $set_id";

	$dbc = db_connect();
	mysqli_query( $dbc, $query );
	db_disconnect($dbc);
	
	$query = "DELETE FROM sets
			  WHERE set_id = $set_id";

	$dbc = db_connect();
	mysqli_query( $dbc, $query );
	db_disconnect($dbc);
	header('location: index.php');
	exit();

}


?>


<div class='modal <?php echo $delete_set ?>'>
	<div class='modal-content'>
		<span class='close-modal'>&times;</span>
		<p>The <?php echo $set_name ?> set and all associated tasks will be perminately deleted</p>
		
		<form action="" method="post">
		<?php $set_index = "delete_set".$set_id; ?>
		<input class='btn-delete-set' name='<?php echo $set_index?>' type="submit" value="Delete">
		
		</form>
	</div>
</div>