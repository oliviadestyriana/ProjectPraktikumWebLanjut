<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kelas extends CI_Model {
	public function select_all() {
		$this->db->select('*');
		$this->db->from('kelas');

		$data = $this->db->get();

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM kelas WHERE id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_siswa($id) {
		$sql = " SELECT siswa.id AS id, siswa.nama AS siswa, siswa.telp AS telp, kelas.nama AS kelas, kelamin.nama AS kelamin, ekstrakulikuler.nama AS ekstrakulikuler FROM siswa, kelas, kelamin, ekstrakulikuler WHERE siswa.id_kelamin = kelamin.id AND siswa.id_ekstrakulikuler = ekstrakulikuler.id AND siswa.id_kelas = kelas.id AND siswa.id_kelas={$id}";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data) {
		$sql = "INSERT INTO kelas VALUES('','" .$data['kelas'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('kelas', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE kelas SET nama='" .$data['kelas'] ."' WHERE id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM kelas WHERE id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('kelas');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('kelas');

		return $data->num_rows();
	}
}

/* End of file M_kelas.php */
/* Location: ./application/models/M_kelas.php */