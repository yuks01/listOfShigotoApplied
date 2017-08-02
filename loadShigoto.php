<?php
    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8"); 

    $data = json_decode(file_get_contents("php://input"));
    print $data->id;
    include_once 'config/db.php';
    $database = new Database();
    $conn = $database->getConnection();
    $tablename = "applied";

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