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

    
    $sql = "SELECT * FROM " . $tablename . " WHERE username = '" . $data->username . "' and password = '" . $data->password . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_array(MYSQL_ASSOC)) {
           $myArray[] = $row;
        }
        session_start();
        $_SESSION['uid']=uniqid('baby_');
        $json = array();
        $json[0] = $myArray;
        $json[1] = $_SESSION['uid'];
        print json_encode($json);
        // print $_SESSION['uid'];
        // print json_encode($myArray);
    }


?>