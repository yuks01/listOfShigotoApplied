<?php

class AddShigoto{

	private $conn;
	private $table_name = "applied";

	public $id;
	public $title;
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

	function create(){
		$query = "INSERT INTO " . $this->table_name . " SET title=:title, companyName=:companyName, position=:position, details=:details, dateApplied=:dateApplied, coverletter=:coverletter, appliedLink=:appliedLink, user=:user";


		$stmt = $this->conn->prepare($query);

		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->companyName = htmlspecialchars(strip_tags($this->companyName));
		$this->position = htmlspecialchars(strip_tags($this->position));
		$this->details = htmlspecialchars(strip_tags($this->details));
		$this->dateApplied = htmlspecialchars(strip_tags($this->dateApplied));
		$this->coverletter = htmlspecialchars(strip_tags($this->coverletter));
		$this->appliedLink = htmlspecialchars(strip_tags($this->appliedLink));
		$this->user = htmlspecialchars(strip_tags($this->user));

		$stmt->bindParam(":title", $this->title);
	    $stmt->bindParam(":companyName", $this->companyName);
	    $stmt->bindParam(":position", $this->position);
	    $stmt->bindParam(":details", $this->details);
	    $stmt->bindParam(":dateApplied", $this->dateApplied);
	    $stmt->bindParam(":coverletter", $this->coverletter);
	    $stmt->bindParam(":appliedLink", $this->appliedLink);
	    $stmt->bindParam(":user", $this->user);

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