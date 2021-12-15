<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ekstrakulikuler extends CI_Model {
	public function select_all() {
		$data = $this->db->get('ekstrakulikuler');

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM ekstrakulikuler WHERE id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_siswa($id) {
		$sql = " SELECT siswa.id AS id, siswa.nama AS siswa, siswa.telp AS telp, kelas.nama AS kelas, kelamin.nama AS kelamin, ekstrakulikuler.nama AS ekstrakulikuler FROM siswa, kelas, kelamin, ekstrakulikuler WHERE siswa.id_kelamin = kelamin.id AND siswa.id_ekstrakulikuler = ekstrakulikuler.id AND siswa.id_kelas = kelas.id AND siswa.id_ekstrakulikuler={$id}";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data) {
		$sql = "INSERT INTO ekstrakulikuler VALUES('','" .$data['ekstrakulikuler'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('ekstrakulikuler', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE ekstrakulikuler SET nama='" .$data['ekstrakulikuler'] ."' WHERE id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM ekstrakulikuler WHERE id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('ekstrakulikuler');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('ekstrakulikuler');

		return $data->num_rows();
	}
}

/* End of file M_ekstrakulikuler.php */
/* Location: ./application/models/M_ekstrakulikuler.php */