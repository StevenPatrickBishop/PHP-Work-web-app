<?php
//------------------------------------ handle remove task---------------------------

if(isset($_POST['removing_task'])){

$task_id = $_POST['task_remove'];

$query = "DELETE FROM tasks WHERE task_id = '$task_id' ";

$dbc = db_connect();

mysqli_query($dbc, $query);
db_disconnect($dbc);
 header('location: set_tasks.php');
 exit();

  
}


?>


