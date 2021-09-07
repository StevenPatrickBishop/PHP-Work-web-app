<?php
if(isset($_POST['updating_set_day'])){
    
    $id = $_POST['set'];
    $day = $_POST['day']; 
    
    $query = "	UPDATE 	sets
    			SET 	scheduled_for = '$day'
    			WHERE 	set_id = '$id'";
    
    $dbc = db_connect();
      mysqli_query( $dbc, $query );
    db_disconnect($dbc);
	
	ob_end_clean();
	header('location: set_tasks.php');
 	exit();
}
?>