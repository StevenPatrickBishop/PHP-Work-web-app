<?php error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
<?php session_start(); ?>
<?php ob_start(); ?>
<?php require_once('private/initialize.php');?>
<?php include "../DB/database.php";?>
<?php
//handle login

if(isset($_POST['login'])){
	
	$error = false;
	
	if(empty($_POST['username'])){
		$error = true;
	}
	
	if(empty($_POST['password'])){
		$error = true;
	}
	
	
	if(!$error){
		
			$user_passed_in = $_POST['username'];
			$password_passed_in = $_POST['password'];
			$account_exists	 = false;	
			
			$query ="
			SELECT * from users
			WHERE username = '$user_passed_in'
			AND passkey = '$password_passed_in'
			";
			
			$dbc = db_connect();
			
			$_SESSION['active_user'] = [];	
			
			if ( $r = mysqli_query( $dbc, $query ) ) {
				while ( $record = mysqli_fetch_array( $r ) ){
					$account_exists	 = true;
					
					$_SESSION['active_user']['user'] 	= $record['username'];
					$_SESSION['active_user']['role']		= $record['role'];
					$_SESSION['active_user']['first_name']	= $record['first_name'];
					$_SESSION['active_user']['last_name'] 	= $record['last_name'];
					
				} 
				
				if($account_exists){
					$user = $_SESSION['active_user']['user'];
					$user_role = $_SESSION['active_user']['role'];

					if($user_role == 'admin'){
						ob_end_clean();
						header("location: http://bishopwebcoding.com/public/admin/");
						exit();

					}
				
				
				}
				else{
					$no_match = 'credentials did not return a match.';
				}
			
			}
			
			
			
			db_disconnect($dbc);
	}//empty test
}//post test
?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<title>BMT</title>
<link href="public/styles/style.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>	
	<div class="page-wrap">	
		<div class="content">
			<div id="login-logo">
				<figure>
				<img src="images/OnFloorLogo.svg">
				</figure>    
			</div>
			<div id="login-section">
				<form id='login' action="" method ="post">
					
			<div>
			<?php if(isset($user)) echo $user_role?>
			<?php $u_value = isset( $_POST[ 'username' ] ) ? htmlspecialchars( $_POST[ 'username' ] ) : '';?>
			<p><input name='username' type='text'  value='<?php echo $u_value; ?>' placeholder='Username'/></p>
			<?php if(isset($_POST['login']) && empty($_POST['username']))
			{echo "<p class='error'>Username not set</p>";} ?>
			
		</div>
		<div>
			<?php $p_value = isset( $_POST[ 'password' ] ) ? htmlspecialchars( $_POST[ 'password' ] ) : '';?>
			<p></p><input type="password" name='password' value='<?php echo $p_value ?>' placeholder='Password'/></p>
			<?php if(isset($_POST['login']) && empty($_POST['password']))
			{echo "<p class='error'>password not set</p>";} ?>
		
		</div>
		<div>
			<p><input type="submit" name='login' value="Sign in"/></p>
			
		</div> 
				</form>	
				<P>Forgot your password? <span><a href=" ">click here</a></span></P>
				<p><a href="public/user/cleaning/index.php">Public Access</a></p>	
			</div>		 
		</div>
	</div>
</body>
</html>