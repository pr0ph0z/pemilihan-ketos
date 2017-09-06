<?php
(class_exists('Database')) ? null : include 'database.php';
class Hasil {
	private $conn;

	public function __construct() {
		$db = new Database;
		$this->conn = $db->connectDB();
	}

	public function getHasil() {
		return $query = $this->conn->query("SELECT id, COUNT(id) AS jumlah FROM vote GROUP BY(id_kandidat)");
	}

	public function getHasilKelasTerbanyak($id_kandidat) {
		return $query = $this->conn->query("SELECT kelas, COUNT(id) AS jumlah FROM vote WHERE id_kandidat = $id_kandidat GROUP BY(kelas) ORDER BY jumlah DESC");
	}

	public function getHasilByJumlah($id_kandidat) {
		return $query = $this->conn->query("SELECT kelas, COUNT(id) AS jumlah FROM vote WHERE id_kandidat = $id_kandidat ORDER BY jumlah DESC");
	}

	public function getHasilByKelasIndex() {
		return $query = $this->conn->query("SELECT kelas, COUNT(id) AS jumlah FROM vote GROUP BY(kelas) ORDER BY jumlah DESC");
	}

	public function getHasilByKelasJoin($kelas) {
		return $query = $this->conn->query("SELECT kandidat.nama, COUNT(vote.id_kandidat) AS jumlah FROM kandidat RIGHT JOIN `vote` ON kandidat.id = vote.id_kandidat WHERE vote.kelas = '$kelas'  GROUP BY (vote.id_kandidat)");
	}

	public function getHasilByKandidatIndex() {
		return $query = $this->conn->query("SELECT kandidat.nama, COUNT(vote.id_kandidat) AS jumlah FROM kandidat RIGHT JOIN `vote` ON kandidat.id = vote.id_kandidat GROUP BY (vote.id_kandidat)");
	}
	
}
?>