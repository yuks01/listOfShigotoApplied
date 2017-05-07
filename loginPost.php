<?php
    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8"); 

    $data = json_decode(file_get_contents("php://input"));

    $servername = "localhost"; 
    $dbname = "ShigotoApplied"; 
    $username = "root"; 
    $password = "mysql"; 
    $tablename = "user";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("connection error: " . $conn->connect_error);
    }

    
    $sql = "SELECT * FROM " . $tablename . " WHERE username = '" . $data->username . "'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        


        $row = $result->fetch_array(MYSQL_ASSOC);
        
        // print $row["username"];
        
        session_start();
        $user = $row;
        if(password_verify($data->password, $user["password"])){
            // print $user["username"];
            $_SESSION['user']=$user["username"];
            // print $_SESSION['user'];
            $json = array();
            $json[0] = $row;
            $json[1] = $_SESSION['user'];
            print json_encode($json);
            // print $_SESSION['uid'];
            // print json_encode($myArray);  
        } else {
            $error = "error";
            print json_encode($error);
            
        }

    }


?>