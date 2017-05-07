<?php

	class ReadData{

		private $conn;
		private $table_name = "applied";

		public $id;
		public $companyName;
		public $position;
		public $details;
		public $dateApplied;
		public $coverletter;
		public $appliedLink;
		public $dateContacted;
		public $emailLink;
		public $dateofInterview;

		public function __construct($db){
			$this->conn = $db;
		}

		function readAll($user){

			$query = "SELECT * FROM " . $this->table_name . " WHERE user = '" . $user . "' ORDER BY id DESC";

			$stmt = $this->conn->prepare($query);

			$stmt->execute();

			return $stmt;
		}

	}

?>