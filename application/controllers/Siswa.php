<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_siswa');
		$this->load->model('M_ekstrakulikuler');
		$this->load->model('M_kelas');
	}

	public function index() {
		$data['userdata'] = $this->userdata;
		$data['dataSiswa'] = $this->M_siswa->select_all();
		$data['dataEkstrakulikuler'] = $this->M_ekstrakulikuler->select_all();
		$data['dataKelas'] = $this->M_kelas->select_all();

		$data['page'] = "Siswa";
		$data['judul'] = "Data Siswa";
		$data['deskripsi'] = "Manage Data Siswa";

		$data['modal_tambah_siswa'] = show_my_modal('modals/modal_tambah_siswa', 'tambah-siswa', $data);

		$this->template->views('siswa/home', $data);
	}

	public function tampil() {
		$data['dataSiswa'] = $this->M_siswa->select_all();
		$this->load->view('siswa/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('ekstrakulikuler', 'Ekstrakulikuler', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_siswa->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Siswa Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Siswa Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$id = trim($_POST['id']);

		$data['dataSiswa'] = $this->M_siswa->select_by_id($id);
		$data['dataEkstrakulikuler'] = $this->M_ekstrakulikuler->select_all();
		$data['dataKelas'] = $this->M_kelas->select_all();
		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_update_siswa', 'update-siswa', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('ekstrakulikuler', 'Ekstrakulikuler', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_siswa->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Siswa Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Siswa Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_siswa->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Data Siswa Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Siswa Gagal dihapus', '20px');
		}
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_siswa->select_all_siswa();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "ID");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Nama");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Nomor Telepon");
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "ID Kelas");
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "ID Kelamin");
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, "ID Ekstrakulikuler");
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, "Status");
		$rowCount++;

		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->nama); 
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('C'.$rowCount, $value->telp, PHPExcel_Cell_DataType::TYPE_STRING);
		    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->id_kelas); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value->id_kelamin); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $value->id_ekstrakulikuler); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $value->status); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data Siswa.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data Siswa.xlsx', NULL);
	}

	public function import() {
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {
			$this->session->set_flashdata('msg', 'File harus diisi');
		} else {
			$config['upload_path'] = './assets/excel/';
			$config['allowed_types'] = 'xls|xlsx';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('excel')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$data = $this->upload->data();
				
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Jakarta');

				include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';

				$inputFileName = './assets/excel/' .$data['file_name'];
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

				$index = 0;
				foreach ($sheetData as $key => $value) {
					if ($key != 1) {
						$id = md5(DATE('ymdhms').rand());
						$check = $this->M_siswa->check_nama($value['B']);

						if ($check != 1) {
							$resultData[$index]['id'] = $id;
							$resultData[$index]['nama'] = ucwords($value['B']);
							$resultData[$index]['telp'] = $value['C'];
							$resultData[$index]['id_kelas'] = $value['D'];
							$resultData[$index]['id_kelamin'] = $value['E'];
							$resultData[$index]['id_ekstrakulikuler'] = $value['F'];
							$resultData[$index]['status'] = $value['G'];
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_siswa->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Siswa Berhasil diimport ke database'));
						redirect('Siswa');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Siswa Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('Siswa');
				}

			}
		}
	}
}

/* End of file Siswa.php */
/* Location: ./application/controllers/Siswa.php */