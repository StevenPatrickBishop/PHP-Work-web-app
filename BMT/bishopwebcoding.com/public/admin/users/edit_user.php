<?php require_once('../../../private/initialize.php');?>
<?php include "../../../../DB/database.php";?>
<?php $page_title = 'BMT - USERS'?>
<?php $area_heading = 'Admin - Edit User'?>
<?php include(SHARED_PATH . '/admin_header.php');?>



<?php
//handle form\

if(isset($_POST['updating_user'])){
   
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
            $id = $_POST['user_id'];

			$query = " 	UPDATE users
                SET first_name = '$first_name',
                    last_name = '$last_name',
                    role = '$role',
                    title = '$title'
                WHERE user_id = '$id' 
                ";
            


			$dbc = db_connect();
			
			mysqli_query( $dbc, $query );
				
			db_disconnect($dbc);
			
			header('location: index.php');
			exit();
			
		}
}

?>


<?php 
//load form data
        if (isset($_POST['edit_user'])){

            $user_id = $_POST['user_id'];

            $query = "Select * FROM users WHERE user_id = '$user_id'";

            $dbc = db_connect();

            if ( $r = mysqli_query( $dbc, $query ) ) {
                while ( $record = mysqli_fetch_array( $r ) ) {
                    $id = $record['user_id'];
                    $first_name = $record['first_name'];
                    $last_name = $record['last_name'];
                    $title = $record['title'];
                    $role = $record['role'];
                }
            }       
            db_disconnect($dbc);
        }
	?>

<div class="content">

<div class ='user_form_wrap'>
<form action="" method='post'>
<table>
<tr>
	<td><p>First Name: </p></td>
	<?php $value = isset($first_name) ? $first_name : '';?>
	<td><input type="text" name='first_name' value="<?php echo $value ?>"/></td>
	<td><?php if(isset($_POST['first_name']) && empty($_POST['first_name']) ){
				echo "<p class='error'>First Name not set</p>";} ?>
	</td>
</tr>
	<tr>
	<td><p>Last Name: </p></td>
	<?php $value = isset($last_name) ? $last_name : '';?>
	<td><input type="text" name='last_name' value="<?php echo $value ?>"/></td>
	<td><?php if(isset($_POST['last_name']) && empty($_POST['last_name']) ){
				echo "<p class='error'>Last Name not set</p>";} ?>
	</td>
</tr>
<tr>
	<td><p>Title: </p></td>
	<?php $value = isset($title) ? $title : '';?>
	<td><input type="text" name='title' value="<?php echo $value ?>"/></td>
	<td><?php if(isset($_POST['title']) && empty($_POST['title']) ){
				echo "<p class='error'>Title not set</p>";} ?>
	</td>
</tr>
	<tr>
	<td><p>Role: </p></td>
	<td>

		<select name='role'>
			<option value = 'admin' <?php if ( isset($role) && ($role == 'admin')) echo 'selected'; ?> >Admin</option>
			<option value="super_user" <?php if ( isset($role) && ($role == 'super_user')) echo 'selected'; ?> >Super User</option>
			<option value="user" <?php if ( isset($role) && ($role == 'user')) echo 'selected'; ?>  >User</option>
			<option value="public" <?php if ( isset($role) && ($role == 'public')) echo 'selected'; ?> >Public</option>
		</select>
	</td>
	<td><?php ?></td>
</tr>
<tr>
	<td></td>
	<td><p><input type="submit" name="updating_user" value="Update User"></p></td>
	<td></td>
</tr>
    <input type="hidden" name="user_id" value="<?php echo $id ?>">
    </table>	
</form>

<table>
    <tr>
	<td></td>
	<td>
	<form action="delete_user.php" method='post'>
	<input type="hidden" name="user_id" value="<?php echo $id ?>">
	<input type='submit' name='delete_user' value ='Delete User'/>
	</form>
	</td>
	<td></td>
</tr>
    
    </table>    



<a href='index.php'><button>Back to Users</button></a>
</div><!--end of form wrap-->

</div><!--end of content-->

<?php include( SHARED_PATH .'/admin_footer.php');?>