<?php
class Database {
	private $db_host;
	private $db_username;
	private $db_password;
	private $db_name;

	public function __construct($db_host = "localhost",$db_username = "root",$db_password="",$db_name="osis") {
		$this->db_host 		= $db_host;
		$this->db_username 	= $db_username;
		$this->db_password 	= $db_password;
		$this->db_name 		= $db_name;
	}

	public function connectDB() {
		$db_host	 	= $this->db_host;
		$db_username 	= $this->db_username;
		$db_password 	= $this->db_password;
		$db_name 		= $this->db_name;

		return mysqli_connect($db_host,$db_username,$db_password,$db_name);
	}
}
?>