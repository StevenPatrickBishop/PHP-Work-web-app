<?php
if(isset($_POST[$set_id])){
	$error = false;
	$scheduled_for = "";
	
	if(empty($_POST['set_name'])){
		$error = true;
	 }
  
	 if(isset($_POST['cb_mon'])){
		$scheduled_for .= $_POST['cb_mon'];
	 }
  
  
	 if(isset($_POST['cb_tue'])){
		$scheduled_for .=  $_POST['cb_tue'];
	 }
  
	 if(isset($_POST['cb_wed'])){
		$scheduled_for .=  $_POST['cb_wed'];
	 }
  
	 if(isset($_POST['cb_thr'])){
		$scheduled_for .=  $_POST['cb_thr'];
	 }
  
	 if(isset($_POST['cb_fri'])){
		$scheduled_for .=  $_POST['cb_fri'];
	 }
  
	 if(isset($_POST['cb_sat'])){
		$scheduled_for .=  $_POST['cb_sat'];
	 }
  
	 if(isset($_POST['cb_auto'])){
		$scheduled_for .=  $_POST['cb_auto'];
	 }
  
	 if(isset($_POST['cb_off'])){
		$scheduled_for .=  $_POST['cb_off'];
	 }
  
	 if($scheduled_for == ""){
		$error = true;
	 }
 
	
	if(!$error){

		$set_name = $_POST['set_name'];
		
			
		$query = "  UPDATE sets
					SET set_name = '$set_name',
                    scheduled_for = '$scheduled_for'
                	WHERE set_id = $set_id
					";
	
	$dbc = db_connect();
			
	mysqli_query( $dbc, $query );
	db_disconnect($dbc);
	header('location: index.php');
	exit();
	}//end error check
}//end post check
?>