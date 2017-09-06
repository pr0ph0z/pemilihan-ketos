<?php
(class_exists('Database')) ? null : include 'database.php';
class Kandidat {
	private $conn;

	public function __construct() {
		$db = new Database;
		$this->conn = $db->connectDB();
	}

	public function getIndex() {
		return $query = $this->conn->query("SELECT * FROM `kandidat`");
	}

	public function getKandidat($id) {
		return $this->conn->query("SELECT * FROM `kandidat` WHERE `id` = '$id'");
	}
}
?>