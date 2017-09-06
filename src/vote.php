<?php
(class_exists('Database')) ? null : include 'database.php';
class Vote {
	public function __construct($id_kandidat, $kelas) {
		$db = new Database;
		$db->connectDB()->query("INSERT INTO vote(id_kandidat,kelas) VALUES ('$id_kandidat','$kelas')");

	} 
}

new Vote($_GET['id_kandidat'],$_GET['kelas']);;
?>