<?php

//--------------------------------------- Handle remove subsection--------------------------

if(isset($_POST['removing_sub_set'])){

	
	$id = $_POST['set'];
	
    $query = "DELETE FROM sub_sets WHERE sub_id = '$id'";
  
	$dbc = db_connect();
	mysqli_query( $dbc, $query );
	db_disconnect($dbc);
	ob_end_clean();
	header('location: set_tasks.php');
	exit();
}

?>