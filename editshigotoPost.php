<?php
	include_once 'config/database.php';
	$database = new Database();
	$db = $database->getConnection();

	include_once 'objects/editshigoto.php';
	$editShigoto = new EditShigoto($db);

	$data = json_decode(file_get_contents("php://input"));

	$editShigoto->id = $data->id;
	$editShigoto->companyName = $data->companyName;
	$editShigoto->position = $data->position;
	$editShigoto->details = $data->details;
	$editShigoto->dateApplied = $data->dateApplied;
	$editShigoto->coverletter = $data->coverletter;
	$editShigoto->appliedLink = $data->appliedLink;
	$editShigoto->dateContacted = $data->dateContacted;
	$editShigoto->emailLink = $data->emailLink;
	$editShigoto->dateofInterview = $data->dateofInterview;
	$editShigoto->comment = $data->comment;
	echo '<script>console.log(' . $data->id . ')</script>';;
	if($editShigoto->edit()){
		echo "Product was edited.";
	}

	else {
		echo "Unable to edit product.";
	}
?>