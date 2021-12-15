<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_siswa');
		$this->load->model('M_ekstrakulikuler');
		$this->load->model('M_kelas');
	}

	public function index() {
		$data['jml_siswa'] 	= $this->M_siswa->total_rows();
		$data['jml_ekstrakulikuler'] 	= $this->M_ekstrakulikuler->total_rows();
		$data['jml_kelas'] 		= $this->M_kelas->total_rows();
		$data['userdata'] 		= $this->userdata;

		$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
		
		$ekstrakulikuler 				= $this->M_ekstrakulikuler->select_all();
		$index = 0;
		foreach ($ekstrakulikuler as $value) {
		    $color = '#' .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)];

			$siswa_by_ekstrakulikuler = $this->M_siswa->select_by_ekstrakulikuler($value->id);

			$data_ekstrakulikuler[$index]['value'] = $siswa_by_ekstrakulikuler->jml;
			$data_ekstrakulikuler[$index]['color'] = $color;
			$data_ekstrakulikuler[$index]['highlight'] = $color;
			$data_ekstrakulikuler[$index]['label'] = $value->nama;
			
			$index++;
		}

		$kelas 				= $this->M_kelas->select_all();
		$index = 0;
		foreach ($kelas as $value) {
		    $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];

			$siswa_by_kelas = $this->M_siswa->select_by_kelas($value->id);

			$data_kelas[$index]['value'] = $siswa_by_kelas->jml;
			$data_kelas[$index]['color'] = $color;
			$data_kelas[$index]['highlight'] = $color;
			$data_kelas[$index]['label'] = $value->nama;
			
			$index++;
		}

		$data['data_ekstrakulikuler'] = json_encode($data_ekstrakulikuler);
		$data['data_kelas'] = json_encode($data_kelas);

		$data['page'] 			= "home";
		$data['judul'] 			= "Beranda";
		$data['deskripsi'] 		= "Manage Data CRUD";
		$this->template->views('home', $data);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */