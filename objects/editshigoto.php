<?php

class EditShigoto{

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
	public $coment;

	public function __construct($db){
		$this->conn = $db;
	}

	function edit(){
		$this->id = (int)htmlspecialchars(strip_tags($this->id));

		$query = "UPDATE " . $this->table_name . " SET companyName=:companyName, position=:position, details=:details, dateApplied=:dateApplied, coverletter=:coverletter, appliedLink=:appliedLink, dateContacted1=:dateContacted1, emailLink1=:emailLink1, dateofInterview1=:dateofInterview1, dateContacted2=:dateContacted2, emailLink2=:emailLink2, dateofInterview2=:dateofInterview2, dateContacted3=:dateContacted3, emailLink3=:emailLink3, dateofInterview3=:dateofInterview3, dateContacted4=:dateContacted4, emailLink4=:emailLink4, dateofInterview4=:dateofInterview4, dateContacted5=:dateContacted5, emailLink5=:emailLink5, dateofInterview5=:dateofInterview5, comment=:comment WHERE id = " . $this->id;


		$stmt = $this->conn->prepare($query);

		echo '<script>console.log(' . $this->id . ')</script>';
		$this->companyName = htmlspecialchars(strip_tags($this->companyName));
		$this->position = htmlspecialchars(strip_tags($this->position));
		$this->details = htmlspecialchars(strip_tags($this->details));
		$this->dateApplied = htmlspecialchars(strip_tags($this->dateApplied));
		$this->coverletter = htmlspecialchars(strip_tags($this->coverletter));
		$this->appliedLink = htmlspecialchars(strip_tags($this->appliedLink));
		$this->dateContacted1 = htmlspecialchars(strip_tags($this->dateContacted1));
		$this->emailLink1 = htmlspecialchars(strip_tags($this->emailLink1));
		$this->dateofInterview1 = htmlspecialchars(strip_tags($this->dateofInterview1));
		$this->dateContacted2 = htmlspecialchars(strip_tags($this->dateContacted2));
		$this->emailLink2 = htmlspecialchars(strip_tags($this->emailLink2));
		$this->dateofInterview2 = htmlspecialchars(strip_tags($this->dateofInterview2));
		$this->dateContacted3 = htmlspecialchars(strip_tags($this->dateContacted3));
		$this->emailLink3 = htmlspecialchars(strip_tags($this->emailLink3));
		$this->dateofInterview3 = htmlspecialchars(strip_tags($this->dateofInterview3));
		$this->dateContacted4 = htmlspecialchars(strip_tags($this->dateContacted4));
		$this->emailLink4 = htmlspecialchars(strip_tags($this->emailLink4));
		$this->dateofInterview4 = htmlspecialchars(strip_tags($this->dateofInterview4));
		$this->dateContacted5 = htmlspecialchars(strip_tags($this->dateContacted5));
		$this->emailLink5 = htmlspecialchars(strip_tags($this->emailLink5));
		$this->dateofInterview5 = htmlspecialchars(strip_tags($this->dateofInterview5));
		$this->comment = htmlspecialchars(strip_tags($this->comment));

	    $stmt->bindParam(":companyName", $this->companyName);
	    $stmt->bindParam(":position", $this->position);
	    $stmt->bindParam(":details", $this->details);
	    $stmt->bindParam(":dateApplied", $this->dateApplied);
	    $stmt->bindParam(":coverletter", $this->coverletter);
	    $stmt->bindParam(":appliedLink", $this->appliedLink);
	    $stmt->bindParam(":dateContacted1", $this->dateContacted1);
	    $stmt->bindParam(":emailLink1", $this->emailLink1);
	    $stmt->bindParam(":dateofInterview1", $this->dateofInterview1);
	    $stmt->bindParam(":dateContacted2", $this->dateContacted2);
	    $stmt->bindParam(":emailLink2", $this->emailLink2);
	    $stmt->bindParam(":dateofInterview2", $this->dateofInterview2);
	    $stmt->bindParam(":dateContacted3", $this->dateContacted3);
	    $stmt->bindParam(":emailLink3", $this->emailLink3);
	    $stmt->bindParam(":dateofInterview3", $this->dateofInterview3);
	    $stmt->bindParam(":dateContacted4", $this->dateContacted4);
	    $stmt->bindParam(":emailLink4", $this->emailLink4);
	    $stmt->bindParam(":dateofInterview4", $this->dateofInterview4);
	    $stmt->bindParam(":dateContacted5", $this->dateContacted5);
	    $stmt->bindParam(":emailLink5", $this->emailLink5);
	    $stmt->bindParam(":dateofInterview5", $this->dateofInterview5);
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