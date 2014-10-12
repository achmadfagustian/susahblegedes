<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->fungsi->check_login(KASIR);
		$this->load->model('Customer_model', '', TRUE);
    }
	
	public function index(){
		$data = array(
			'title' => 'Kasir | Pendaftaran',
			'menu_active' => M_PENDAFTARAN
		);
		$this->view('kasir/pendaftaran/daftar_form',$data);
	}
	
	public function save(){
		if($this->input->post('id_customer')==""){
			$data = array( 	'id_pelanggan'	=> $this->input->post('id_pelanggan'),
							'no_polisi'		=> $this->input->post('no_polisi'),
							'pemilik'		=> $this->input->post('pemilik'),
							'alamat'		=> $this->input->post('alamat'),
							'telepon'		=> $this->input->post('telepon'),
							'tipe'			=> $this->input->post('tipe'),
							'merek'			=> $this->input->post('merek'),
							'jenis'			=> $this->input->post('jenis'),
							'warna'			=> $this->input->post('warna'),
							'tahun_produksi'=> $this->input->post('tahun_produksi'),
							'no_rangka'		=> $this->input->post('no_rangka'),
							'no_mesin'		=> $this->input->post('no_mesin'),
							'keterangan'	=> $this->input->post('keterangan'));	
			
			//Save Customer
			$dataHist['id_customer'] = $this->Customer_model->insert_select_key($data);
		}else{
			$dataHist['id_customer'] = $this->input->post('id_customer');
		};
		
		$dataHist['keluhan'] = $this->input->post('keluhan');
		$dataHist['diganti'] = "";
		$dataHist['keterangan'] = "";
		$dataHist['tipe'] = 1;
		$dataHist['crby'] = $this->session->userdata('id_user');
		$dataHist['id_perusahaan'] = $this->session->userdata('office_id');
			
		//Save Customer History
		$id_customer_history = $this->Customer_model->insert_history_select_key($dataHist);
		
		//Save Customer History Detail
		$arr_kode_barang 	= $this->input->post('kode_barang');
		$arr_nama 			= $this->input->post('nama');
		$arr_qty 			= $this->input->post('qty');
		$arr_harga 			= $this->input->post('harga');
		$arr_diskon 		= $this->input->post('diskon');
		$arr_diskon_total	= $this->input->post('diskon_total');
		$arr_sub_total		= $this->input->post('sub_total');
		
		$arrCount = count($arr_kode_barang);
		
		if($arrCount>0){
			$total = 0;
			$arrCount--;
			for($j = 0; $j < $arrCount; $j++) {
				$total += $arr_sub_total[$j];
			}
			for($i = 0; $i < $arrCount; $i++) {
				$dataHD = array();
				$dataHD['id_customer_history'] = $id_customer_history;
				$dataHD['kode_barang'] = $arr_kode_barang[$i];
				$dataHD['nama'] = $arr_nama[$i];
				$dataHD['qty'] = $arr_qty[$i];
				$dataHD['harga'] = $arr_harga[$i];
				$dataHD['diskon'] = $arr_diskon[$i];
				$dataHD['diskon_total'] = $arr_diskon_total[$i];
				$dataHD['sub_total'] = $arr_sub_total[$i];
				$dataHD['total'] = $total;
				$this->Customer_model->insert_history_detail($dataHD);
			}
		}
		
		echo "1";
	}
	
	public function view($php,$data){
		$this->parser->parse('template/site_head', $data);
	 	$this->parser->parse('template/site_kasir_top', $data);
		$this->load->view($php,$data);
		$this->parser->parse('template/site_foot', $data);
	}
	
}