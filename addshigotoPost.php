<?php
	include_once 'config/database.php';
	$database = new Database();
	$db = $database->getConnection();

	include_once 'objects/addshigoto.php';
	$addShigoto = new AddShigoto($db);

	$data = json_decode(file_get_contents("php://input"));

	$addShigoto->companyName = $data->companyName;
	$addShigoto->position = $data->position;
	$addShigoto->details = $data->details;
	$addShigoto->dateApplied = $data->dateApplied;
	$addShigoto->coverletter = $data->coverletter;
	$addShigoto->appliedLink = $data->appliedLink;
	
	if($addShigoto->create()){
		echo "Product was created.";
	}

	else {
		echo "Unable to create product.";
	}
?>