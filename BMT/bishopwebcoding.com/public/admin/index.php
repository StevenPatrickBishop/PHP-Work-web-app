<?php require_once('../../private/initialize.php');?>
<?php include "../../../DB/database.php";?>
<?php $page_title = 'BMT - ADMIN'?>
<?php $area_heading = 'BMT Admin Area'?>
<?php include(SHARED_PATH . '/admin_header.php');?>

<div class="page-wrap">
	
	 <div class='main-menu'>
		 <h2>Main Menu</h2>
		  <ul>
			<li><a href="<?php echo url_for('admin/index.php');?>">Home</a></li>
			<li><a href="users/index.php">Users</a></li>
			<li><a href="cleaning/index.php">Cleaning</a></li>
			<li><a href="cleaning/set_tasks.php">Set Tasks</a></li>
			<li><a href="batchgrades/index.php">Batchgrades</a></li>
		  </ul>
      </div>
	
	
  <div class="content">
	  <div class="report-table">
		  <h2>Yesterday's Report</h2>
		<table>
			<tr>
				<th>User</th>
				<th>Area</th>
				<th>Activity</th>
				<th>Date</th>
			</tr>
			<?php
			
			$query ="	SELECT 	CONCAT(u.first_name,' ', u.last_name) AS 'name',
								(SELECT sub_name 
                                 FROM sub_sets 
                                 WHERE sub_id = (SELECT subset_id 
                                                 FROM tasks 
                                                 WHERE task_id = a.activity)) AS 'area',
                                (SELECT task_description 
                                 FROM tasks 
                                 WHERE task_id = a.activity) AS 'activity',
                                date
						FROM 	activities a
						JOIN 	users u on u.user_id = a.user
						WHERE  date = CURRENT_DATE()-1;
						";
			
			$dbc = db_connect();
		
		
			if ( $r = mysqli_query( $dbc, $query ) ) {
				while ( $record = mysqli_fetch_array( $r ) ) {
					
					$name = $record['name'];
					$area = $record['area'];
					$activity = $record['activity'];
					$date = $record['date'];
					
					echo"
						<tr>
							<td>$name</td>
							<td>$area</td>
							<td>$activity</td>
							<td>$date</td>
						</tr>
						";
				}
			}
			db_disconnect($dbc);
			?>
		</table>  
	  </div>
	  	
  </div>
</div>
	
<?php include( SHARED_PATH .'/admin_footer.php');?>