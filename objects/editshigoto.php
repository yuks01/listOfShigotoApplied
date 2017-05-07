<?php

class EditShigoto{

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
	public $coment;

	public function __construct($db){
		$this->conn = $db;
	}

	function edit(){
		$this->id = (int)htmlspecialchars(strip_tags($this->id));

		$query = "UPDATE " . $this->table_name . " SET title=:title, companyName=:companyName, position=:position, details=:details, dateApplied=:dateApplied, coverletter=:coverletter, appliedLink=:appliedLink, dateContacted=:dateContacted, emailLink=:emailLink, dateofInterview=:dateofInterview, comment=:comment WHERE id = " . $this->id;


		$stmt = $this->conn->prepare($query);

		echo '<script>console.log(' . $this->id . ')</script>';
		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->companyName = htmlspecialchars(strip_tags($this->companyName));
		$this->position = htmlspecialchars(strip_tags($this->position));
		$this->details = htmlspecialchars(strip_tags($this->details));
		$this->dateApplied = htmlspecialchars(strip_tags($this->dateApplied));
		$this->coverletter = htmlspecialchars(strip_tags($this->coverletter));
		$this->appliedLink = htmlspecialchars(strip_tags($this->appliedLink));
		$this->dateContacted = htmlspecialchars(strip_tags($this->dateContacted));
		$this->emailLink = htmlspecialchars(strip_tags($this->emailLink));
		$this->dateofInterview = htmlspecialchars(strip_tags($this->dateofInterview));
		$this->comment = htmlspecialchars(strip_tags($this->comment));

		$stmt->bindParam(":title", $this->title);
	    $stmt->bindParam(":companyName", $this->companyName);
	    $stmt->bindParam(":position", $this->position);
	    $stmt->bindParam(":details", $this->details);
	    $stmt->bindParam(":dateApplied", $this->dateApplied);
	    $stmt->bindParam(":coverletter", $this->coverletter);
	    $stmt->bindParam(":appliedLink", $this->appliedLink);
	    $stmt->bindParam(":dateContacted", $this->dateContacted);
	    $stmt->bindParam(":emailLink", $this->emailLink);
	    $stmt->bindParam(":dateofInterview", $this->dateofInterview);
	    $stmt->bindParam(":comment", $this->comment);

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