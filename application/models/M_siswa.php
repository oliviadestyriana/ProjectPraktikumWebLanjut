<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_siswa extends CI_Model {
	public function select_all_siswa() {
		$sql = "SELECT * FROM siswa";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all() {
		$sql = " SELECT siswa.id AS id, siswa.nama AS siswa, siswa.telp AS telp, kelas.nama AS kelas, kelamin.nama AS kelamin, ekstrakulikuler.nama AS ekstrakulikuler FROM siswa, kelas, kelamin, ekstrakulikuler WHERE siswa.id_kelamin = kelamin.id AND siswa.id_ekstrakulikuler = ekstrakulikuler.id AND siswa.id_kelas = kelas.id";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT siswa.id AS id_siswa, siswa.nama AS nama_siswa, siswa.id_kelas, siswa.id_kelamin, siswa.id_ekstrakulikuler, siswa.telp AS telp, kelas.nama AS kelas, kelamin.nama AS kelamin, ekstrakulikuler.nama AS ekstrakulikuler FROM siswa, kelas, kelamin, ekstrakulikuler WHERE siswa.id_kelas = kelas.id AND siswa.id_kelamin = kelamin.id AND siswa.id_ekstrakulikuler = ekstrakulikuler.id AND siswa.id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_ekstrakulikuler($id) {
		$sql = "SELECT COUNT(*) AS jml FROM siswa WHERE id_ekstrakulikuler = {$id}";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_kelas($id) {
		$sql = "SELECT COUNT(*) AS jml FROM siswa WHERE id_kelas = {$id}";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data) {
		$sql = "UPDATE siswa SET nama='" .$data['nama'] ."', telp='" .$data['telp'] ."', id_kelas=" .$data['kelas'] .", id_kelamin=" .$data['jk'] .", id_ekstrakulikuler=" .$data['ekstrakulikuler'] ." WHERE id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM siswa WHERE id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data) {
		$id = md5(DATE('ymdhms').rand());
		$sql = "INSERT INTO siswa VALUES('{$id}','" .$data['nama'] ."','" .$data['telp'] ."'," .$data['kelas'] ."," .$data['jk'] ."," .$data['ekstrakulikuler'] .",1)";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('siswa', $data);
		
		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('siswa');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('siswa');

		return $data->num_rows();
	}
}

/* End of file M_siswa.php */
/* Location: ./application/models/M_siswa.php */