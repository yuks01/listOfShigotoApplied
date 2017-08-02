<?php
    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8"); 

    $data = json_decode(file_get_contents("php://input"));

    include_once 'config/db.php';
    $database = new Database();
    $conn = $database->getConnection();
    $tablename = "user";

    $sql = "INSERT INTO " . $tablename . " (username, password, name, email) VALUES(?,?,?,?)";
    $stmt = $conn->prepare($sql);

    $username = $data->username;
    $passwordNotHash = $data->password;
    $password = password_hash($passwordNotHash, PASSWORD_DEFAULT);
    $name = $data->name;
    $email = $data->email;

    $stmt->bind_param("ssss", $username, $password, $name, $email);

    if($stmt->execute()){
        $message = "success";
        print json_encode($message);
    } else {
        print json_encode($stmt->error);
    }

    // $result = $conn->query($sql);

    // if ($result->num_rows > 0) {
    //     // output data of each row
    //     while($row = $result->fetch_array(MYSQL_ASSOC)) {
    //        $myArray[] = $row;
    //     }
    //     session_start();
    //     $_SESSION['uid']=uniqid('baby_');
    //     $json = array();
    //     $json[0] = $myArray;
    //     $json[1] = $_SESSION['uid'];
    //     print json_encode($json);
    //     // print $_SESSION['uid'];
    //     // print json_encode($myArray);
    // }


?>