<?php
    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8"); 

    include_once 'config/database.php';
    include_once 'objects/readShigoto.php';
    session_start();
    $database = new Database();
    $db = $database->getConnection();

    $readData = new ReadData($db);

    $user = $_SESSION['user'];

    // print $user;

    $stmt = $readData->readAll($user);
    $num = $stmt->rowCount();

    $data = "";

    if ($num>0){
        $x=1;
        $jsonData = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
        // extract row
        // this will make $row['name'] to
        // just $name only

        // extract($row);
          
        // $data .= '{';
        //     $data .= '"id":"'  . $id . '",';
        //     $data .= '"companyName":"' . $companyName . '",';
        //     $data .= '"position":"' . $position . '",';
        //     $data .= '"details":"' . html_entity_decode($details) . '",';
        //     $data .= '"coverletter":"' . html_entity_decode($coverletter) . '",';
        //     $data .= '"appliedLink":"' . $appliedLink . '",';
        //     $data .= '"dateApplied":"' . $dateApplied . '",';
        //     $data .= '"dateContacted":"' . $dateContacted . '",';
        //     $data .= '"emailLink":"' . $emailLink . '",';
        //     $data .= '"dateofInterview":"' . $dateofInterview . '"';
        // $data .= '}'; 
          
        // $data .= $x<$num ? ',' : '';

        $jsonData[] = $row;

        $x++; 

        } 

        echo json_encode($jsonData, JSON_NUMERIC_CHECK);
    }
    // echo '{"shigotoslist":[' . $data . ']}'; 


?>