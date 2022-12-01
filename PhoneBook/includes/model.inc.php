<?php
	
	class Model 
	{	
		private $servername = 'localhost';
		private $username = 'root';
		private $password = 'Albertparale080599!';
		private $dbname = 'Phonebook';
		private $conn;

		//Database Connection
		public function __construct()
		{
			$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

			if($this->conn->connect_error){
				echo "Connection Failed!";
			}else{
				return $this->conn;			
			}
		}

		//insert data record
		public function insertRecord($post){
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$number = $_POST['number'];

			$sql = "INSERT INTO `user` (firstname, lastname, `number`) VALUES ('$fname', '$lname', '$number');";
			$result = $this->conn->query($sql);
			if ($result) {
				header("Location: index.php");
			}else{
				echo "Error " .$sql."<br>".$this->conn->error;
			}
		}

		//display data record
		public function displayRecord(){
			$sql = "SELECT * FROM `user`";
			$result = $this->conn->query($sql);
			if ($result->num_rows>0) {
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				return $data;
			}
		}

		//display data record by id
		public function displayRecordById($editid){
			$sql = "SELECT * FROM `user` WHERE `id` = '$editid'";
			$result = $this->conn->query($sql);
			if ($result->num_rows==1) {
				$row = $result->fetch_assoc();
				return $row;
			}
		}
		

		//update data record
		public function updateRecord($post){
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$number = $_POST['number'];
			$editid = $_POST['hid'];
			$sql = "UPDATE user SET firstname='$fname', lastname='$lname', `number`='$number' WHERE id='$editid'";
			$result = $this->conn->query($sql);
			if ($result) {
				header("Location: index.php");
			}else{
				echo "Error " .$sql."<br>".$this->conn->error;
			}
		}

		public function deleteRecord($delid){
			$sql = "DELETE FROM `user` WHERE `id` = '$delid'";
			$result = $this->conn->query($sql);
			if ($result) {
				header("Location: index.php");
			}else{
				echo "Error " .$sql."<br>".$this->conn->error;
			}
		}

	}

	
?>