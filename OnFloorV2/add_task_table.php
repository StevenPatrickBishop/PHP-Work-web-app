<table id='task-table modal-table'>
				<tr class='table-heading'>
					
					<th>Tasks</th>
					<th>Overdue limit</th>
					<th>Last Performed</th>
					<th>Remove Task</th>
				</tr>

				<?php

				$dbc2 = db_connect();
				$query2 = "SELECT * FROM tasks WHERE parent_set = $set_id";
				if ( $r2 = mysqli_query( $dbc2, $query2 ) ) {
				while ( $record2 = mysqli_fetch_array( $r2 ) ) {
				$task_description = $record2['task_description'];
				$overdue_point = $record2['overdue_point'];
				$last_performed = isset($record['last_performed']) ? $record['last_performed'] : 'never';

				?>

				<tr>
					
					<td class='left-aligned-text' ><?php echo $task_description ?></td>
					<td><?php echo $overdue_point ?> <span>Days</span></td>
					<td><?php echo $last_performed ?></td>
					<td><button class='btn-delete-task' <?php echo $delete_set?>'>&times;</button></td>
				</tr>

				<?php } } db_disconnect($dbc2); ?> <!--query loop end-->

				<!-- add new task -->
				<tr>
					<?php include('add_new_task.php')?>
				</tr>
			</table>