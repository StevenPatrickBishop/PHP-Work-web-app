<?php include 'credentials.php'?>
<?php
function db_connect(){
    if($connection = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE)){
        mysqli_set_charset($connection, 'utf8');
        //echo "<p>connection dbc opened</p>";
        return $connection;
    }
    else{
        echo "not working";
    }
             
}

function db_disconnect($connection){
    if(isset($connection)){
        mysqli_close($connection);
        //echo "<p>connection dbc closed</p>";
    }
    else{
        echo "connection not set";
    }
}
?>