<?php require_once('../../../private/initialize.php');?>
<?php include "../../../../DB/database.php";?>
<?php $page_title = 'BMT - USERS'?>
<?php $area_heading = 'Admin - Delete User'?>
<?php include(SHARED_PATH . '/admin_header.php');?>

<?php

if(isset($_POST['delete_user'])){

    $id = $_POST['user_id'];

    $query = "DELETE FROM users WHERE user_id = $id";

    $dbc = db_connect();
    mysqli_query( $dbc, $query);
    db_disconnect($dbc);
    header('location: index.php');
    exit();
}


?>



<div class="content">


</div><!--end of content-->

<?php include( SHARED_PATH .'/admin_footer.php');?>