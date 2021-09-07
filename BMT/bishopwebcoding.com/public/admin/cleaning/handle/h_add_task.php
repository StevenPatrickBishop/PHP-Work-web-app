<?php
//-------------------------------------------handle add tasks-------------------------------------

if(isset($_POST['adding_task'])){

    $error = false;

    if(empty($_POST['task'])){

        $error = true;
		
    }

    if(!$error){

    $dbc = db_connect();

    $task_list = explode("." , $_POST['task']);
    $sub_id = $_POST['sub_for_task']; 


        foreach($task_list as $task){

            $query = "INSERT INTO tasks(task_description,subset_id)
            VALUES      ('$task', '$sub_id')";
            mysqli_query( $dbc, $query );
			print_r($query);
        }
       
        db_disconnect($dbc);
		ob_end_clean();
        header('location: set_tasks.php');
        exit();
		
    }

}
?>
