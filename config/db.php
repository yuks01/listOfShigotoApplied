<?php 
class Database{ 
 
    // specify your own database credentials 
    private $servername = "localhost"; 
    private $dbname = "ShigotoApplied"; 
    private $username = "root"; 
    private $password = "mysql";  
    private $conn; 
 
    // get the database connection 
    public function getConnection(){ 
        $this->conn = null;

        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if($this->conn->connect_error){
            die("connection error: " . $this->conn->connect_error);
        }
        return $this->conn;
    }
}
?>