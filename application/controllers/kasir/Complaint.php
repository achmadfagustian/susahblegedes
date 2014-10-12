<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Complaint extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->fungsi->check_login(KASIR);
		$this->load->model('Customer_model', '', TRUE);
    }
	
	public function index(){
		$data = array(
			'title' => 'Kasir | Complaint',
			'menu_active' => M_COMPLAINT
		);
		$this->view('kasir/complaint/complaint_form',$data);
	}
	
	public function save(){
		$dataHist = array(  'id_customer'		=> $this->input->post('id_customer'),
							'nik_mekanik_awal'	=> $this->input->post('nik_mekanik'),
							'keluhan'			=> $this->input->post('keluhan'),
							'diganti' 			=> "",
							'keterangan' 		=> "",
							'tipe'				=> 2,
							'crby'				=> $this->session->userdata('id_user'),
							'id_perusahaan'		=> $this->session->userdata('office_id'));	
		
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
		
		$arrCount = count($arr_qty);
		
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