<?php require_once('../../../private/initialize.php');?>
<?php include "../../../../DB/database.php";?>
<?php $page_title = 'BMT - CLEANING'?>
<?php $area_heading = 'Admin - Cleaning Assignments'?>
<?php include(SHARED_PATH . '/admin_header.php');?>
<?php

echo '<p style="color: white;">made it here </p>';







//handle form
if(isset($_POST['complete_task'])){

	
	echo '<p style="color: white;">clear post check </p>';
	$error = false;

	if(empty($_POST['user'])){
		$error = true;
		echo '<p style="color: white;">error is true</p>';
	}

	if(!$error){
		
		$task = $_POST['task'];
		$id = $_POST['id'];
		$today = date('Y-m-d');
		$user = $_POST['user'];
		
		echo "<p style='color: white;'>$task</p>";
		echo "<p style='color: white;'>$id</p>";
		echo "<p style='color: white;'>$today</p>";
		echo "<p style='color: white;'>$user</p>";
//	
//		
//		
//		$dbc = db_connect();
//		$query ="UPDATE tasks set last_performed = '$today' WHERE task_id = '$id' ";
//		mysqli_query($dbc, $query);
//		db_disconnect($dbc);
//	
//	
//		$dbc = db_connect();
//		$query = "INSERT INTO activities(user,activity,date)
//		VALUES('$user','$task','$today')";
//		mysqli_query($dbc, $query);
//		db_disconnect($dbc);
//	
//		ob_end_clean();
//		header('location: index.php#'.$id);
//		exit();

	}

}





//	
//	if(isset($_POST['complete_task_with_comment'])){
//
//	$error = false;
//
//	if(empty($_POST['user'])){
//		$error = true;
//	}
//
//	if(!$error){
//		$task = $_POST['task'];
//		$id = $_POST['id'];
//		$today = date('Y-m-d');
//		$user = $_POST['user'];
//	
//		
//		
//		$dbc = db_connect();
//		$query ="UPDATE tasks set last_performed = '$today' WHERE task_id = '$id' ";
//		mysqli_query($dbc, $query);
//		db_disconnect($dbc);
//	
//	
//		$dbc = db_connect();
//		$query = "INSERT INTO activities(user,activity,date)
//		VALUES('$user','$task','$today')";
//		mysqli_query($dbc, $query);
//		db_disconnect($dbc);
//	
//		ob_end_clean();
//		header('location: index.php#'.$id);
//		exit();
//
//	}
//
//}
//	
//	
?>

<?php include( SHARED_PATH .'/admin_footer.php');?>