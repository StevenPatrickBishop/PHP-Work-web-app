<?php 
$set_index = "task_set".$set_id;
if(isset($_POST[$set_index])){
	
	$error = false;
	
	if(empty($_POST['task_description'])){
		$error = true;
	 }

	 if(!$error){

		$task_description = $_POST['task_description'];
		$overdue_point = $_POST['overdue_point'];

		$query = "INSERT INTO tasks (task_description, parent_set, overdue_point)
		VALUES('$task_description','$set_id','$overdue_point');";

		$dbc = db_connect();
					
		mysqli_query( $dbc, $query );
		db_disconnect($dbc);
		header('location: index.php');
		exit();

	 }

}

?>

<form action="" method="post">

	<td class='left-aligned-text' >
		<textarea class='new-task-text' name="task_description" placeholder="Add new Task here"></textarea>
	</td>
	<td>
		<select name="overdue_point">
		<option value="0">None</option>
		<?php
		for($i = 1; $i <= 90; $i++ ){
		echo"<option value='$i'>$i</option>";
		}
		?>
		</select>
	</td>

	<?php $set_index = "task_set".$set_id; ?>
	<td><input class='btn-new-task' type="submit" name='<?php echo $set_index?>' value="Add New Task"></td>

</form>

