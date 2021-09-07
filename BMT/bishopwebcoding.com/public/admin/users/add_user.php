<?php require_once('../../../private/initialize.php');?>
<?php include "../../../../DB/database.php";?>
<?php $page_title = 'BMT - USERS'?>
<?php $area_heading = 'Admin - Add User'?>
<?php include(SHARED_PATH . '/admin_header.php');?>



<?php // handle form

	if(isset($_POST['adding_new_user'])){
		
		$error = false;
		
		if(empty($_POST['first_name'])){
			$error = true;
		}
		if(empty($_POST['last_name'])){
			$error = true;
		}
		if(empty($_POST['title'])){
			$error = true;
		}
		
		if(!$error){

			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$role = $_POST['role'];
			$title = $_POST['title'];
			$username = substr($first_name,0,1).'_'.$last_name;
			$passkey ='resultsdriver';

			$query = " 	INSERT INTO users (first_name,last_name, role, title, username, passkey )
			VALUES(
				'$first_name',
				'$last_name',
				'$role',
				'$title',
				'$username',
				'$passkey'
			);";

			$dbc = db_connect();
			
			mysqli_query( $dbc, $query );
				
			db_disconnect($dbc);
			
			header('location: index.php');
			exit();
			
		}
	}


?>





<div class="content">
<div class ='user_form_wrap'>
<form action="" method='post'>
<table>
<tr>
	<td><p>First Name: </p></td>
	<?php $value = isset( $_POST[ 'first_name' ] ) ? htmlspecialchars( $_POST[ 'first_name' ] ) : '';?>
	<td><input type="text" name='first_name' value="<?php echo $value ?>"/></td>
	<td><?php if(isset($_POST['first_name']) && empty($_POST['first_name']) ){
				echo "<p class='error'>First Name not set</p>";} ?>
	</td>
</tr>
	<tr>
	<td><p>Last Name: </p></td>
	<?php $value = isset( $_POST[ 'last_name' ] ) ? htmlspecialchars( $_POST[ 'last_name' ] ) : '';?>
	<td><input type="text" name='last_name'/></td>
	<td><?php if(isset($_POST['last_name']) && empty($_POST['last_name']) ){
				echo "<p class='error'>Last Name not set</p>";} ?>
	</td>
</tr>
<tr>
	<td><p>Title: </p></td>
	<?php $value = isset( $_POST[ 'title' ] ) ? htmlspecialchars( $_POST[ 'title' ] ) : '';?>
	<td><input type="text" name='title'/></td>
	<td><?php if(isset($_POST['title']) && empty($_POST['title']) ){
				echo "<p class='error'>Title not set</p>";} ?>
	</td>
</tr>
	<tr>
	<td><p>Role: </p></td>
	<td>
		<select name='role'>
			<option value = 'admin'>Admin</option>
			<option value="super_user">Super User</option>
			<option value="user">User</option>
			<option value="public">Public</option>
		</select>
	</td>
	<td><?php ?></td>
</tr>
<tr>
	<td></td>
	<td><p><input type="submit" name="adding_new_user" value="Add User"></p></td>
	<td></td>
</tr>
</table>	

	
</form>	

<a href='index.php'><button>Back to Users</button></a>
	</div>
</div><!--end of content-->

<?php include( SHARED_PATH .'/admin_footer.php');?>