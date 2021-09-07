<?php require_once('../../../private/initialize.php');?>
<?php include "../../../../DB/database.php";?>
<?php $page_title = 'BMT - CLEANING'?>
<?php $area_heading = 'Cleaning Assignments'?>
<?php include(SHARED_PATH . '/admin_header.php');?>
<?php
//handle form
if(isset($_POST['complete_task'])){

	$error = false;

	if(empty($_POST['user'])){
		$error = true;
	}

	if(!$error){
		
		$task = $_POST['task'];
		$id = $_POST['id'];
		$today = date('Y-m-d');
		$user = $_POST['user'];
	
		
		
		$dbc = db_connect();
		$query ="UPDATE tasks set last_performed = '$today' WHERE task_id = '$id' ";
		mysqli_query($dbc, $query);
		db_disconnect($dbc);
	
	
		$dbc = db_connect();
		$query = "INSERT INTO activities(user,activity,date)
		VALUES('$user','$id','$today')";
		mysqli_query($dbc, $query);
		db_disconnect($dbc);
	
	
		
		ob_end_clean();
		header('location: index.php#'.$id);
		exit();

	}

}
?>

<?php
//--------------------------------------handle form with comments----------------------------------



if(isset($_POST['complete_task_with_comment'])){

	$error = false;

	if(empty($_POST['user'])){
		$error = true;
	}

	if(!$error){
		
		$task = $_POST['task'];
		$id = $_POST['id'];
		$today = date('Y-m-d');
		$user = $_POST['user'];
		$comments = $_POST['comments'];
	
		
		
		$dbc = db_connect();
		$query ="UPDATE tasks set last_performed = '$today' WHERE task_id = '$id' ";
		mysqli_query($dbc, $query);
		db_disconnect($dbc);
	
	
		$dbc = db_connect();
		$query = "INSERT INTO activities(user,activity,date)
		VALUES('$user','$id','$today')";
		mysqli_query($dbc, $query);
		db_disconnect($dbc);
		
		
		$dbc = db_connect();
		$query = "INSERT INTO comments (user,sub_set,activity,comment)
					VALUES(	'$user',
       						(SELECT subset_id FROM tasks
							 WHERE task_id = $id),
       						'$id',
       						'$comments');";
		mysqli_query($dbc, $query);
		db_disconnect($dbc);

		
		ob_end_clean();
		header('location: index.php#'.$id);
		exit();

	}

}
	
?>







<div class="page-wrap">
  	<div class='main-menu'>
		<h2>Main Menu</h2> 
		<ul>
			<li><a href="<?php echo url_for('../index.php');?>">Home</a></li>
			<li><a href="../cleaning/index.php">Cleaning</a></li>
			
		</ul>
	</div>
  <div class="content">

	<div class ='cleaning-grid-wrap'>
        <div>
          <h2 class='routine-heading'>Today's Cleaning Routine</h2>
        </div>

		<?php
			
			$today = date("l");

			$query = "SELECT 	s.set_name AS 'set',
								s.set_id,
								s.scheduled_for AS 'day',
								b.sub_name AS 'sub',
								t.task_id,
								t.task_description AS 'task',
								t.last_performed AS 'last'
					   	FROM sets s
					   	JOIN sub_sets b ON s.set_id = b.set_id
						JOIN tasks t on b.sub_id = t.subset_id
						WHERE s.scheduled_for = DAYNAME(CURRENT_DATE());";

		$dbc = db_connect();

		$today = date('Y-m-d');
		$record_count = 0;
		$tasks_completed = 0;

		if ( $r = mysqli_query( $dbc, $query ) ) {
			while ( $record = mysqli_fetch_array( $r ) ) {
				$last = $record['last'];
				$record_count++;

				if($last == $today){
					$tasks_completed++;
					// echo "<p>$last</p>";
				}
			
			}

		}

		

		$complete_percent = ($record_count > 0) ? round((($tasks_completed / $record_count)* 100 ),0) : "0";
?>

			<div class='set-heading'>
				<!-- <h3>Section one</h3> -->
		  		<div class='section-complete'>
			  		<h3><span><?php echo $complete_percent;?></span>%</h3>
			  		<p>completed</p>
		  		</div>	 


		


				  <div class='participation-today'>
			  		<h3><span><?php echo getParticipationRate();?></span>%</h3>
			  		<p>Participation</p>
		  		</div>	 
	  		</div>

	
<?php
		if ( $r = mysqli_query( $dbc, $query ) ) {
			while ( $record = mysqli_fetch_array( $r ) ) {
				$sub_set = $record['sub'];
				$task = $record['task'];
				$last = $record['last'];
				$task_id = $record['task_id'];

				$task_status = ($last == $today ) ? 'complete' : 'incomplete';
?>
		
		<form id='<?php echo $task_id;?>' action='' class='complete_task' method='post'>
				<div class='admin-task-block'>
					<div class='admin-task-sub task-heading'><h3><?php echo $sub_set; ?></h3></div>

					<div class='admin-task-content task-heading'>Task:</div>
					<div class='admin-task-content task-content'><?php echo $task; ?> </div>

					<div class='admin-task-status task-heading'>Status:</div>
					<div class='admin-task-status task-content task-status-<?php echo $task_status; ?>'><p> <?php echo $task_status; ?></p></div>

					<div class='admin-task-owner task-heading '>Owner:</div>
					<div class='admin-task-owner task-content'>
						<?php	
							if ($task_status == 'complete'){
									
									$task_owner = getOwnerWhoPerformedTask($task_id);
									echo $task_owner;
								}
								else{
									showUserSelectList();
									if(isset($_POST['user']) && empty($_POST['user']) && $_POST['id'] == $task_id){
										echo "<p class='error'>No name selected</p>";
									}
								}
						?>	
		     	   </div>
				
            		<div class='admin-task-date task-heading'>Last Completed:</div>
					<div class='admin-task-date task-content'><?php echo $last; ?></div>
				<div>
						<?php					
							if($task_status == 'complete'){
								echo "	<div class='admin-task-completed'>&#10004;</div>";
							}
							else{
								//echo"<input type='submit' class='task-btn' name='complete_task' value ='Own it'/> ";
								$modal_id = 'mod'.$task_id;
								echo"<button type='button'  class='task-btn $modal_id'>Own it!</button> ";
								echo "<input type='hidden'  name='id' value ='$task_id'/> ";
								echo "<input type='hidden'  name='task' value ='$task'/> ";
								echo "
								
								<div class='comment_modal modal $modal_id'>
							<div class='modal-content'>
								<div class='modal-header'>
									<h3>Have a comment or suggestion?</h3>
									<span class='closeBtn'>&times;</span>
								</div>
								<textarea name='comments' class='modal-text' placeholder='Type comment or suggestion here'></textarea>
								<div class='modal-footer'>
									<div class='modal_skip_comment'>
										<input type='submit' name='complete_task' value='No comment' />
									</div>
									<div class='modal_add_comment'>
										<input type='submit' name='complete_task_with_comment' value='Add comment'/>
									</div>
								</div>
							</div>
						</div>
								
								
								";
							}
						?>
						
									   
	</div>		
</div>
</form>
		
		<?php
				}
		}
		db_disconnect($dbc);

		?>

	  
	</div>
  
  </div>
</div>









<!-- Page functions -->
<?php

function getOwnerWhoPerformedTask($task){
	
	
	
	$query  = "	SELECT 		CONCAT(first_name, ' ', last_name) AS 'name'
						   	FROM 	activities a
						   	JOIN 	users u ON a.user = u.user_id
							WHERE 	activity = '$task'
							AND 	date = CURRENT_DATE();";

	$dbc = db_connect();
	


				if ( $r = mysqli_query( $dbc, $query ) ){
					while ( $record = mysqli_fetch_array( $r ) ) {
						$name = $record['name']; 
					}
				}
	
	
	db_disconnect($dbc);
	
	if(isset($name)){
		return $name;
	}
	else{
		return 'Don\'t touch my nuts!';
	}
	
}


function showUserSelectList(){

	$query = "SELECT * FROM users WHERE role NOT IN ('public') ORDER BY first_name";
	$dbc = db_connect();
	
	echo "<p><select name='user'>";
	echo "<option value=''>Name</option>";
	
	
	if ( $r = mysqli_query( $dbc, $query ) ){
		while ( $record = mysqli_fetch_array( $r ) ) {
			$name = $record['first_name'] . ' ' . $record['last_name']; 
			$id = $record['user_id'];

			echo"<option value='$id'>$name</option>";
		}

	}

	echo"</select>";
	echo"<p>";

	db_disconnect($dbc);
}




function getParticipationRate(){



		//get participation level
		$query = "SELECT ROUND((SELECT COUNT(DISTINCT user) 
				   FROM activities
				   WHERE date = CURRENT_DATE()
				   AND user IN((SELECT user_id from users where title IN('Operator', 'Material Handler')))) / 
				   COUNT(user_id),2) AS 'participation'
				   FROM     users
				   WHERE	title IN('Operator','Material Handler');";


		$dbc = db_connect();

		if ( $r = mysqli_query( $dbc, $query ) ) {
			while ( $record = mysqli_fetch_array( $r ) ) {

				$participation = $record['participation'];

			}
		}

		db_disconnect($dbc);
		
		return ($participation > 0) ? ($participation * 100 ) : "0";
		

}
?>
<?php include( SHARED_PATH .'/admin_footer.php');?>