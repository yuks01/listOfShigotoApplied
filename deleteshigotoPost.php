<?php
	include_once 'config/database.php';
	$database = new Database();
	$db = $database->getConnection();

	include_once 'objects/deleteshigoto.php';
	$deleteShigoto = new DeleteShigoto($db);

	$data = json_decode(file_get_contents("php://input"));

	$deleteShigoto->id = $data->id;

	echo '<script>console.log(' . $data->id . ')</script>';;
	if($deleteShigoto->delete()){
		echo "Product was delete.";
	}

	else {
		echo "Unable to delete product.";
	}
?>