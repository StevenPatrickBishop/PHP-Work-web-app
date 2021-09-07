<?php
// -----------------------------------handle add subsection-------------------------------

if(isset($_POST['adding_sub_set'])){

	
		
	$error = false;

	if(empty($_POST['sub_list'])){
		$error = true;
		
	}

	if(!$error){
		$sub_list = explode("," , $_POST['sub_list']);
		$id = $_POST['set'];
		
	$dbc = db_connect();
	
	foreach($sub_list as $item){
		$query = "INSERT INTO sub_sets(sub_name, set_id)
				 VALUES('$item', '$id');";
	mysqli_query( $dbc, $query );
		
	}

	
	db_disconnect($dbc);
	ob_end_clean();
	header('location: set_tasks.php');
	exit();

	}//error test
}//post test


?>



