<?php
if(isset($_POST['add_set'])){
   
   $error = false;
   $scheduled_for = "";
   
   if(empty($_POST['set_name'])){
      $error = true;
   }

   if(isset($_POST['cb_mon'])){
      $scheduled_for .= $_POST['cb_mon'];
   }


   if(isset($_POST['cb_tue'])){
      $scheduled_for .=  $_POST['cb_tue'];
   }

   if(isset($_POST['cb_wed'])){
      $scheduled_for .=  $_POST['cb_wed'];
   }

   if(isset($_POST['cb_thr'])){
      $scheduled_for .=  $_POST['cb_thr'];
   }

   if(isset($_POST['cb_fri'])){
      $scheduled_for .=  $_POST['cb_fri'];
   }

   if(isset($_POST['cb_sat'])){
      $scheduled_for .=  $_POST['cb_sat'];
   }

   if(isset($_POST['cb_auto'])){
      $scheduled_for .=  $_POST['cb_auto'];
   }

   if(isset($_POST['cb_off'])){
      $scheduled_for .=  $_POST['cb_off'];
   }

   if($scheduled_for == ""){
      $error = true;
   }

   if(!$error){
      $set_name = $_POST['set_name'];

     
   $query = "INSERT INTO sets(set_name, scheduled_for)
             VALUES ('$set_name','$scheduled_for');
   "; 

         $dbc = db_connect();
			
			mysqli_query( $dbc, $query );
				
			db_disconnect($dbc);
			
			header('location: index.php');
			exit();

   }//error check end
}//post check end

?>

<div id="add-new-set-modal" class="modal">
   <div class="modal-content">
      <span class="close-modal">&times;</span>
      <form action="" method='post'>

         <p>Set Name: 
            <?php $value = isset( $_POST[ 'set_name' ] ) ? htmlspecialchars( $_POST[ 'set_name' ] ) : '';?>
            <input type="text" name='set_name' value="<?php echo $value ?>"/>
            <?php if(isset($_POST['set_name']) && empty($_POST['set_name']) ){
            echo "<span class='error'>Set name not valid </span>";} ?>
         </p>

         <?php include('day_switch.php')?>

         <input type="submit" class='btn-update' name="add_set" value="Add Set">   
      </form>
   </div>
</div>	   