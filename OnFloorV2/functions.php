<?php

function getNumberofTasksGivenSet($set_id){

    $query = " SELECT count(task_id) as 'task_qty'
               FROM tasks
               WHERE parent_set = $set_id;

    ";

        $dbc = db_connect();
        if ( $r = mysqli_query( $dbc, $query ) ) {
            while ( $record = mysqli_fetch_array( $r ) ) {
                $task_qty = $record['task_qty'];
            }
        }

        return $task_qty;
}

?>