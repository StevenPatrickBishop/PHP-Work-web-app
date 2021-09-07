<?php require_once('../../../private/initialize.php');?>
<?php include "../../../../DB/database.php";?>
<?php $page_title = 'BMT - USERS'?>
<?php $area_heading = 'Admin - Users'?>
<?php include(SHARED_PATH . '/admin_header.php');?>
<div class="page-wrap">
	
	<div class='main-menu'>
		<h2>Main Menu</h2> 
		<ul>
			<li><a href="<?php echo url_for('admin/index.php');?>">Home</a></li>
			<li><a href="../users/index.php">Users</a></li>
			<li><a href="../cleaning/index.php">Cleaning</a></li>
			<li><a href="../cleaning/set_tasks.php">Set Tasks</a></li>
			<li><a href="../batchgrades/index.php">Batchgrades</a></li>
		</ul>
	</div>
	
	
  <div class="content">
    <div class='user_table_wrap'>
      <h2>Current Users</h2>
      <table class="user_table" >
        <tbody>
          <tr>
            <td></td>
            <th scope="col">User ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Title</th>
            <th scope="col">Role</th>
          </tr>
          
          <?php 
		$query = "Select * FROM users";
		$dbc = db_connect();
		
		$counter = 0;
		if ( $r = mysqli_query( $dbc, $query ) ) {
			while ( $record = mysqli_fetch_array( $r ) ) {
                $id = $record['user_id'];
                $first_name = $record['first_name'];
                $last_name = $record['last_name'];
                $title = $record['title'];
				$role = $record['role'];
				
				$counter++;
			
				if(($counter % 2) == 0){
					echo "<tr class = 'even'>";
					echo "<td class='edit_user'>
					<form action='edit_user.php' method='post'>
								<input type='hidden' name='user_id' value='$id'/>
								<input type='submit' name='edit_user' value='Edit'/>
							</form>
						</td>";
					echo "<td>$id</td>";
					echo "<td>$first_name</td>";
					echo "<td>$last_name</td>";
					echo "<td>$title</td>";
					echo "<td>$role</td>";
					echo "</tr>"; 

				}
				else{
					echo "<tr class ='odd'>";
					echo "<td class='edit_user'>
							<form action='edit_user.php' method='post'>
								<input type='hidden' name='user_id' value='$id'/>
								<input type='submit' name='edit_user' value='Edit'/>
							</form>
						</td>";
					echo "<td>$id</td>";
					echo "<td>$first_name</td>";
					echo "<td>$last_name</td>";
					echo "<td>$title</td>";
					echo "<td>$role</td>";
					echo "</tr>";
				}
				
			
			}
		}
			
		db_disconnect($dbc);

	?>
          
          <tr>
            <td class='edit_user'>
              <form action='add_user.php' method='post'>
                <input type='submit' name='Add_user' value='Add'/>
              </form>
            </td>
            <td scope="col"></th>
            <td scope="col"></th>
            <td scope="col"></th>
            <td scope="col"></th>
            <td scope="col"></th>
          </tr>
          
          
        </tbody>
      </table>	  
    </div>
    
    
</div><!--end of content--></div>
<?php include( SHARED_PATH .'/admin_footer.php');?>