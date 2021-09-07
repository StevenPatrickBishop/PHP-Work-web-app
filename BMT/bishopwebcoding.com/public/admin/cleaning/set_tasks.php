<?php require_once('../../../private/initialize.php');?>
<?php include "../../../../DB/database.php";?>
<?php $page_title = 'BMT - CLEANING'?>
<?php $area_heading = 'Admin - Set Tasks'?>
<?php include(SHARED_PATH . '/admin_header.php');?>
<?php
// include form handlers
include('handle/h_add_set.php');

include('handle/h_edit_set.php');

include('handle/h_add_sub_set.php');
include('handle/h_remove_sub_set.php');

include('handle/h_add_task.php');
include('handle/h_remove_task.php');
?>

<!-----------------------------------------Page Markup--------------------------------------->
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
        <!--------------------------------------  task table set--------------------------------------->
         <div class="table-heading">
            <h2>Current Tasks</h2>
            <hr/>    
        </div>
       
        <div class="task-table">
            <table>
                <?php
                
                    $dbc = db_connect();
                
                    $query1 = "SELECT * FROM  sets ";
                
                    $counter = 0;
                
                    if ( $r = mysqli_query( $dbc, $query1 ) ) {
                        while ( $record = mysqli_fetch_array( $r ) ) {	
                            
                            $set_name = $record['set_name'];
                            $set_id = $record['set_id'];
                            $day = $record['scheduled_for'];
                            
                            $counter++;
                            if(($counter % 2) == 0){
                                $class = "even";
                                echo"<tr class='$class'>
                                    <th><h3>Task set: $set_name</h3></th>
                                    <th><h3>Execute on: $day</h3></th>
                                </tr>";
                            }
                            else{
                                $class = "odd";
                                echo"<tr class='$class'>
                                <th><h3>Task set: $set_name</h3></th>
                                <th><h3>Execute on: $day</h3></th>
                                </tr>";
                            }
                            
                            $dbc2 = db_connect();
                            
                            $query2 = "	SELECT	sub_name, sub_id
                                        FROM 	sub_sets
                                        WHERE	set_id = '$set_id' ";
                            
                            
                            if ( $r2 = mysqli_query( $dbc2, $query2 ) ) {
                                while ( $record2 = mysqli_fetch_array( $r2 ) ) {
                                    
                                    $sub = $record2['sub_name'];
                                    $sub_set_id = $record2['sub_id'];
                                    
                                    $counter++;
                                    if(($counter % 2) == 0){
                                        $class = "even";
                                        echo "<tr class='sub-row'><td><h4>Subset: $sub</h4></td></tr>";
                                    }
                                    else{
                                        $class = "odd";
                                          echo "<tr class='sub-row'><td><h4>Subset: $sub</h4></td></tr>";
                                    }
                                    
                                    
                                    //third layer here
                                    $dbc3 = db_connect();

                                    $query3 = "	SELECT	task_description
                                    FROM 	tasks
                                    WHERE	subset_id = '$sub_set_id' ";


                                    if ( $r3 = mysqli_query( $dbc3, $query3 ) ) {
                                        while ( $record3 = mysqli_fetch_array( $r3 ) ) {

                                            $task = $record3['task_description'];

                                            $counter++;
                                            if(($counter % 2) == 0){
                                                $class = "even";
                                                echo "<tr class='$class task'><td><p>$task</p></td></tr>";
                                            }
                                            else{
                                                $class = "odd";
                                                echo "<tr class='$class task'><td><p>$task</p></td></tr>";
                                            }
    
                                       }//end query fetching 3
                            }//end query 3
                                    db_disconnect($dbc3);
                                          
                                }//end query fetching 2
                            }//end query 2
                            db_disconnect($dbc2);						
                        }//end query fetching 1
                    }//end query 1
                    db_disconnect($dbc);
                ?>		
            </table>
        </div>
                

        <!--------------------------------------  task table set END --------------------------------------->   
        
            <div class="table-heading">
                <hr/>  
                <h2>Edit sets</h2>
                <hr/>    
            </div>
        
        
        
        
        <!--------------------------------------  Add/Remove Sets --------------------------------------->
        <div class="edit-tasks">
        <div class="cleaning_task_add_remove">
            <div class="col-left">
            <div class ='form_wrap'>
<!--
            <div class="form-heading">
            <h3>Add set</h3>
            </div>
-->         
       <fieldset><legend>Add set</legend>     <form action="" method='post'>
            <table>
            <tr>
            <td><p>set Name:</p></td>
            <?php $value = isset( $_POST[ 'set_name' ] ) ? htmlspecialchars( $_POST[ 'set_name' ] ) : '';?>
            <td><p><input type='text' name='set_name' value="<?php echo $value ?>"></p></td> 
            <td><?php if(isset($_POST['set_name']) && empty($_POST['set_name']) ){
            echo "<p class='error'>set name not set</p>";} ?>
            <?php if(isset($name_exists) && $name_exists == true ){
            echo "<p class='error'>set name already taken</p>";} ?>
            </td>
            </tr>
            <tr>
            <td><p>Add Sub sets:</p><p>comma seperated:</p></td>
            <?php $value = isset( $_POST[ 'sub_list' ] ) ? htmlspecialchars( $_POST[ 'sub_list' ] ) : '';?>
            <td><p><textarea name='sub_list'><?php echo $value ?></textarea></p></td> 
            <td><?php if(isset($_POST['sub_list']) && empty($_POST['sub_list']) ){
            echo "<p class='error'>sub_list not set</p>";} ?>
            </td> 
            </tr>
            <tr>
            <td><p>Clean on Day: </p></td>
            <td><p>
            <select name='clean_day'>
            <option value='Monday'>Monday</option>
            <option value='Tuesday'>Tuesday</option>
            <option value='Wednesday'>Wednesday</option>
            <option value='Thursday'>Thursday</option>
            <option value='Friday'>Friday</option>
            <option value='Saturday'>Saturday</option>
            <option value='Sunday'>Sunday</option>
            </select>
            </p></td> 
            <td><p></p></td>  
            </tr>
            <tr>
            <td><p></p></td>
            <td><p><input class="form-button" type ='submit' name='adding_set' value='Add set'/></p></td> 
            <td><p></p></td>  
            </tr>
            </table>
            </form></fieldset>
            </div>
            </div>
            <!------------------------------------------REMOVE SET----------------------------------------------->
            <div class="col-right">
                <div class="form_wrap">

            <fieldset><legend>Remove set</legend>        <form action="handle/h_remove_set.php" method="post">
                        <table>
                            <tr>
                                <td><p>Select set: </p></td>
                                <td>
                                    <p>
                                        <select name='set_to_delete'>
                                            <?PHP
                                            
                                            $query = "SELECT    set_name,
                                                                set_id
                                                      FROM 	    sets";
                                            
                                            $dbc = db_connect();
                                            
                                            $count = 0;
                                            
                                            if ( $r = mysqli_query( $dbc, $query ) ) {
                                                while ( $record = mysqli_fetch_array( $r ) ) {
                                                    $name = $record['set_name'];
                                                    $id = $record['set_id'];
                                                    $count++;
                                                    echo "<option value='$id'>$name</option>";
                                                }
                                            }	
                                            db_disconnect($dbc);
                                            
                                            ?>
                                        </select>
                                    </p>
                                </td> 
                            <td><p></p></td>  
                            </tr>
                            <tr>
                                <td>
                                </td>
                                
                                <?PHP
                                    if($count > 0){
                                     echo "<td><p><input class='form-button' type ='submit' name='removing_set' value='Remove set'/></p></td>";
                                    }
                                ?>
                                
                                <td><p></p></td>  
                            </tr>
                        </table>	
                    </form></fieldset>
                </div>
                
             
                
                 <div class="form_wrap">

               <fieldset><legend>Set Day</legend>     <form action="" method="post">
                        <table>
                            <tr>
                                <td><p>Select set: </p></td>
                                <td>
                                    <p>
                                        <select name='set'>
                                            <?PHP
                                            
                                            $query = "SELECT    set_name,
                                                                set_id
                                                      FROM 	    sets";
                                            
                                            $dbc = db_connect();
                                            
                                            $count = 0;
                                            
                                            if ( $r = mysqli_query( $dbc, $query ) ) {
                                                while ( $record = mysqli_fetch_array( $r ) ) {
                                                    $name = $record['set_name'];
                                                    $id = $record['set_id'];
                                                    $count++;
                                                    echo "<option value='$id'>$name</option>";
                                                }
                                            }	
                                            db_disconnect($dbc);
                                            
                                            ?>
                                        </select>
                                    </p>
                                </td> 
                            <td><p></p></td>  
                            </tr>
                             <tr>
            <td><p>Clean on Day: </p></td>
            <td>
				<p>
					<select name='day'>
						<option value='Monday'>Monday</option>
						<option value='Tuesday'>Tuesday</option>
						<option value='Wednesday'>Wednesday</option>
						<option value='Thursday'>Thursday</option>
						<option value='Friday'>Friday</option>
						<option value='Saturday'>Saturday</option>
                        <option value='Sunday'>Sunday</option>
					</select>
            	</p>
			</td> 
            <td><p></p></td>  
            </tr>
                            <tr>
                                <td>
                                </td>
                                <?PHP
                                    if($count > 0){
                                     echo "<td><p><input class='form-button' type ='submit' name='updating_set_day' value='Set Day'/></p></td>";
                                    }
                                ?>
                                
                                <td><p></p></td>  
                            </tr>
                        </table>	
                    </form></fieldset>
                </div>
                
                
                
            </div>
        </div>    
        	
        
        <!-------------------------------------ADD SUB_SET--------------------------------------->
            
              <div class="table-heading">
                <hr/>  
                <h2>Edit Sub sets</h2>
                <hr/>    
            </div>    
        
        <div class="cleaning_task_add_remove">
            <div class='col-left'>
                <div class="form_wrap">
<!--
                    <div class="form-heading">
                    <h3>Add Sub set</h3>
                    </div>
-->
               <fieldset><legend>Add Sub-set</legend>     <form action="" method="post">
                        <table>
                            <tr>
                                <td><p>Select set: </p></td>
                                <td>
                                    <p>
                                        <select name='set'>
                                            <?PHP
                                                $query = "SELECT    set_name,
                                                                    set_id
                                                          FROM 	    sets";

                                                $dbc = db_connect();

                                                $count = 0; //COUNT NUMBER OF RECORDS RETURNED

                                                if ( $r = mysqli_query( $dbc, $query ) ) {
                                                    while ( $record = mysqli_fetch_array( $r ) ) {
                                                        $name = $record['set_name'];
                                                        $id = $record['set_id'];
                                                        $count++;
                                                        echo "<option value='$id'>$name</option>";
                                                    }
                                                }

                                                db_disconnect($dbc);
                                            ?>
                                        </select>
                                    </p>
                                </td> 
                                <td><p></p></td>  
                            </tr>
                            <tr>
                                <td>
                                    <p>Add Sub sets:</p>
                                    <p>comma seperated:</p>
                                </td>
                                
                                <?php $value = isset( $_POST[ 'sub_list' ] ) ? htmlspecialchars( $_POST[ 'sub_list' ] ) : '';?>
                                <td><p><textarea name='sub_list'><?php echo $value ?></textarea></p></td> 
                                <td><?php if(isset($_POST['sub_list']) && empty($_POST['sub_list']) ){
                                echo "<p class='error'>sub_list not set</p>";} ?>
                                </td> 
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <?PHP
                                    //SHOW BUTTON IF SUBSETS EXIST
                                    if($count > 0){
                                    echo "<td><p><input class='form-button' type ='submit' name='adding_sub_set' value='Add Sub set'/></p></td>";
                                    }
                                ?>
                                <td><p></p></td>  
                            </tr>
                        </table>	
                    </form> <!--ADD SUBset FORM END--></fieldset>
                </div> <!--ADD SUBset FORM WRAP END-->
            </div> <!--SUBset COL LEFT END-->
            
            <!-------------Remove subset---------->
            <div class="col-right">
                <div class="form_wrap">
<!--
                    <div class="form-heading">
                        <h3>Remove Subset</h3>
                    </div>
-->
                       <fieldset id='r_sub'><legend>Remove Sub-set</legend> <form action="" method="post">
                        <table>
                            <tr>
                                <td><p>Select Sub set: </p></td>
                                <td>
                                    <p>
                                    <select name='set'>
                                        
                                        <?PHP
                                        
                                            $query = "SELECT    sub_name,
                                                                sub_id
                                                      FROM 	    sub_sets";
                                        
                                            $dbc = db_connect();
                                        
                                            $count = 0;//COUNTS NUMBER OF RECORDS RETURNED
                                        
                                            if ( $r = mysqli_query( $dbc, $query ) ) {
                                                while ( $record = mysqli_fetch_array( $r ) ) {
                                                    $name = $record['sub_name'];
                                                    $id = $record['sub_id'];
                                                    $count++;
                                                    echo "<option value='$id'>$name</option>";
                                                }
                                            }
                                        
                                            db_disconnect($dbc);
                                        
                                        ?>
                                        
                                    </select>
                                    </p>
                                </td> 
                                <td><p></p></td>  
                            </tr>
                            <tr>
                                <td>
                                  
                                </td>
                                
                                <?PHP
                                    //IF THERE ARE SUBset ESTABLISHED, THAN SHOW THE REMOVE BUTTON. 
                                    if($count > 0){
                                     echo "<td><p><input class='form-button' type ='submit' name='removing_sub_set' value='Remove Sub_set'/></p></td>";
                                    }
                                ?>	
                                <td><p></p></td>  
                            </tr>
                        </table>	
                    </form><!--REMOVE SUBset FORM END--></fieldset>
                </div><!--REMOVE SUBset FORM WRAP END-->
            </div><!--SUBset COL RIGHT END-->
        </div><!--ADD REMOVE SUBset END-->
        
        
        
        
         <!---------------------------------------------ADD TASKS------------------------------------------------>



        
         <div class="table-heading">
                <hr/>  
                <h2>Edit Tasks</h2>
                <hr/>    
            </div>
        

        <div class="cleaning_task_add_remove">
            <div class='col-left'>
                <div class="form_wrap">
<!--
                    <div class="form-heading">
                    <h3>Add Task</h3>
                    </div>
-->
                   <fieldset><legend>Add Task</legend> <form action="" method="post">
                        <table>
                            <tr>
                                <td><p>Select Sub set: </p></td>
                                <td>
                                    <p>
                                        <select name='sub_for_task'>
                                        <?PHP
                                        
                                        $query = "SELECT    sub_name,
                                                            sub_id
                                                  FROM 	    sub_sets";
                                    
                                        $dbc = db_connect();
                                    
                                        $count = 0;//COUNTS NUMBER OF RECORDS RETURNED
                                    
                                        if ( $r = mysqli_query( $dbc, $query ) ) {
                                            while ( $record = mysqli_fetch_array( $r ) ) {
                                                $name = $record['sub_name'];
                                                $id = $record['sub_id'];
                                                $count++;
                                                echo "<option value='$id'>$name</option>";
                                            }
                                        }
                                    
                                        db_disconnect($dbc);
                                    
                                    ?>
                                        </select>
                                    </p>
                                </td> 
                                <td><p></p></td>  
                            </tr>
                            <tr>
                                <td>
                                    <p>Add Tasks:</p>
                                    <p>(.) seperated:</p>
                                </td>
                                
                                <?php $value = isset( $_POST[ 'task' ] ) ? htmlspecialchars( $_POST[ 'task' ] ) : '';?>
                                <td><p><textarea name='task'><?php echo $value ?></textarea></p></td> 
                                <td><?php if(isset($_POST['task']) && empty($_POST['task']) ){
                                echo "<p class='error'>Task List not set</p>";} ?>
                                </td> 
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <?PHP
                                    //SHOW BUTTON IF SUBsetS EXIST
                                    if($count > 0){
                                    echo "<td><p><input class='form-button' type ='submit' name='adding_task' value='Add Task'/></p></td>";
                                    }
                                ?>
                                <td><p></p></td>  
                            </tr>
                        </table>	
                    </form> <!--ADD TASK FORM END--></fieldset>
                </div> <!--ADD TASK FORM WRAP END-->
            </div> <!--TASK COL LEFT END-->
            <!-------------------------------------------------Remove Task--------------------------------- -->
            <div class="col-right">
                <div class="form_wrap">
<!--
                    <div class="form-heading">
                        <h3>Remove Cleaning Task</h3>
                    </div>
-->
                        <fieldset><legend>Remove Task</legend><form action="" method="post">
                        <table>
                            <tr>
                                <td><p>Select Tasks: </p></td>
                                <td>
                                    <p>
                                    <select name='task_remove'>
                                        
                                        <?PHP
                                        
                                            $query = "SELECT    task_id,
                                                                task_description,
                                                                subset_id
                                                      FROM 	    tasks";
                                        
                                            $dbc = db_connect();
                                        
                                            $count = 0;//COUNTS NUMBER OF RECORDS RETURNED
                                        
                                            if ( $r = mysqli_query( $dbc, $query ) ) {
                                                while ( $record = mysqli_fetch_array( $r ) ) {
                                                    $desc = $record['task_description'];
                                                    $id = $record['task_id'];
                                                    $count++;
                                                    echo "<option value='$id'>$desc</option>";
                                                }
                                            }
                                        
                                            db_disconnect($dbc);
                                        
                                        ?>
                                        
                                    </select>
                                    </p>
                                </td> 
                                <td><p></p></td>  
                            </tr>
                            <tr>
                                <td>
                                    <p><input type='hidden' name='id' value="<?php echo $id?>"/></p>
                                    <p><input type='hidden' name='name' value="<?php echo $name?>"/></p>
                                </td>
                                
                                <?PHP
                                    //IF THERE ARE SUBset ESTABLISHED, THAN SHOW THE REMOVE BUTTON. 
                                    if($count > 0){
                                     echo "<td><p><input class='form-button' type ='submit' name='removing_task' value='Remove Task '/></p></td>";
                                    }
                                ?>	
                                <td><p></p></td>  
                            </tr>
                        </table>	
                    </form><!--REMOVE TASK FORM END--></fieldset>
                </div><!--REMOVE TASK FORM WRAP END-->
            </div><!--TASK COL RIGHT END-->
        </div><!--ADD REMOVE TASK END-->
        
        

        
        </div><!--EDIT TASKS END-->
    </div><!--CONTENT AREA END-->
</div><!--PAGE WRAP END-->
<?php include( SHARED_PATH .'/admin_footer.php');?>