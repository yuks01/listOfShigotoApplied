<?php
    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8"); 

    $data = json_decode(file_get_contents("php://input"));
    print $data->id;
    $servername = "localhost"; 
    $dbname = "ShigotoApplied"; 
    $username = "root"; 
    $password = "mysql"; 
    $tablename = "applied";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("connection error: " . $conn->connect_error);
    }



    $sql = "SELECT * FROM " . $tablename . " WHERE id = '" . $data . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        
        print $data->id;

        // $row = $result->fetch_array(MYSQL_ASSOC);
        while($row = $result->fetch_assoc()) {
            print json_encode($row);
    }
        // print $row["username"];


        }

    


?>