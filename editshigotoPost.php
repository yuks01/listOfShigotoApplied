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
	$editShigoto->dateContacted1 = $data->dateContacted1;
	$editShigoto->emailLink1 = $data->emailLink1;
	$editShigoto->dateofInterview1 = $data->dateofInterview1;
	$editShigoto->dateContacted2 = $data->dateContacted2;
	$editShigoto->emailLink2 = $data->emailLink2;
	$editShigoto->dateofInterview2 = $data->dateofInterview2;
	$editShigoto->dateContacted3 = $data->dateContacted3;
	$editShigoto->emailLink3 = $data->emailLink3;
	$editShigoto->dateofInterview3 = $data->dateofInterview3;
	$editShigoto->dateContacted4 = $data->dateContacted4;
	$editShigoto->emailLink4 = $data->emailLink4;
	$editShigoto->dateofInterview4 = $data->dateofInterview4;
	$editShigoto->dateContacted5 = $data->dateContacted5;
	$editShigoto->emailLink5 = $data->emailLink5;
	$editShigoto->dateofInterview5 = $data->dateofInterview5;
	$editShigoto->comment = $data->comment;
	echo '<script>console.log(' . $data->id . ')</script>';;
	if($editShigoto->edit()){
		echo "Shigoto was edited.";
	}

	else {
		echo "Unable to edit shigoto.";
	}
?>