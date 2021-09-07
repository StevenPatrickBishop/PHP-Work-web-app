<?php

//--------------------------------------- Handle add set--------------------------

if(isset($_POST['adding_set'])){
	
	

    $name_exists = false;
    $error = false;
		
    if(empty($_POST['set_name'])){
        $error = true;
    }

    if(isset($_POST['set_name'])){

       
        //check if set name is already taken
        $query = "SELECT set_name FROM sets";
        $dbc = db_connect();
		
		if ( $r = mysqli_query( $dbc, $query ) ) {
			while ( $record = mysqli_fetch_array( $r ) ) {
				if($record['set_name'] == $_POST['set_name']){
                    $error = true;
                    $name_exists = true;
                    break;
                }
			}
		}
			
		db_disconnect($dbc);
    }


    if(empty($_POST['sub_list'])){
        $error = true;
    }


    if(!$error){

        $dbc = db_connect();

        $name =  mysqli_real_escape_string($dbc,$_POST['set_name']);
        $day = mysqli_real_escape_string($dbc,$_POST['clean_day']);
        

       $query = "INSERT INTO sets(set_name, scheduled_for)
                VALUES(
                    '$name',
                    '$day'
                )
       ";
   
       mysqli_query( $dbc, $query );
       
       db_disconnect($dbc);




       //get current set id 
       $dbc = db_connect();
       $query = "SELECT set_id FROM sets WHERE set_name = '$name'";

                if ( $r = mysqli_query( $dbc, $query ) ) {
                    while ( $record = mysqli_fetch_array( $r ) ) {
                        $id = $record['set_id'];
                    }
                }

       db_disconnect($dbc);

    //convert sub-list to array
    $sub_list = explode("," , $_POST['sub_list']);
   

      $dbc = db_connect();

            foreach($sub_list as $item){
                $query = "INSERT INTO sub_sets(sub_name, set_id)
                         VALUES('$item', '$id');";
                mysqli_query( $dbc, $query );

            }

    db_disconnect($dbc);

	
       
       header('location: set_tasks.php');
       exit();
    

    }//error test

}//post test


?>