<?php

class DeleteShigoto{

	private $conn;
	private $table_name = "applied";

	public $id;

	public function __construct($db){
		$this->conn = $db;
	}

	function delete(){
		$this->id = (int)htmlspecialchars(strip_tags($this->id));

		$query = "DELETE FROM " . $this->table_name . " WHERE id = " . $this->id;


		$stmt = $this->conn->prepare($query);

		echo '<script>console.log(' . $this->id . ')</script>';

		if($stmt->execute()){
			return true;
		} else {
			echo"<pre>";
				print_r($stmt->errorInfo());
			echo"<pre>";

			return false;
		}
	}

}

?>