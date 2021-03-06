<?php
    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8"); 

    $data = json_decode(file_get_contents("php://input"));

    include_once 'config/db.php';
    $database = new Database();
    $conn = $database->getConnection();

    $tablename = "user";

    // $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if($conn->connect_error){
        die("connection error: " . $conn->connect_error);
    }

    
    $sql = "SELECT * FROM " . $tablename . " WHERE username = '" . $data->username . "'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        


        $row = $result->fetch_array(MYSQLI_ASSOC);
        
        // print $row["username"];
        
        
        $user = $row;
        // print_r($user);
        if(password_verify($data->password, $user["password"])){
            session_start();
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