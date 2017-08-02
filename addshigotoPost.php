<?php
	include_once 'config/database.php';
	$database = new Database();
	$db = $database->getConnection();

	include_once 'objects/addshigoto.php';
	$addShigoto = new AddShigoto($db);
	session_start();
	$data = json_decode(file_get_contents("php://input"));
	$user = $_SESSION['user'];


	$addShigoto->companyName = $data->companyName;
	$addShigoto->position = $data->position;
	$addShigoto->details = $data->details;
	$addShigoto->dateApplied = $data->dateApplied;
	$addShigoto->coverletter = $data->coverletter;
	$addShigoto->appliedLink = $data->appliedLink;
	$addShigoto->user = $user;

	// print $addShigoto->user;

	if($addShigoto->create()){
		echo "Shigoto was added.";
	}

	else {
		echo "Unable to add shigoto.";
	}
?>