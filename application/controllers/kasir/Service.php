<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->fungsi->check_login(KASIR);
		$this->load->model('Customer_model', '', TRUE);
		$this->load->model('User_model', '', TRUE);
    }	
	
	public function index(){
		$data = array(
			'title' => 'Kasir | Service',
			'menu_active' => M_SERVICE
		);
		$data['cust_left'] = $this->Customer_model->select_data_by_status(1);
		$data['mek_pit'] = $this->User_model->select_mekanik_pit($this->session->userdata('office_id'));
		
		$this->view('kasir/service/service_form',$data);
	}
	
	public function get_customer_trx_save($id_customer_history="",$nik="", $pit_no=""){
		if($id_customer_history!=""){
			if($nik!=""){
				$data['id_customer_history'] = $id_customer_history;
				$data['nik_mekanik'] = $nik;
				$data['start_datetime'] = date('Y-m-d H:i:s');
				$data['pit_no_temp'] = $pit_no;
				$this->Customer_model->update_history($data);
			}
			
			$cust_hist = $this->Customer_model->select_history_data($data);
			$dat_cust_hist = $cust_hist->row();
			
			$data['id_customer'] = $dat_cust_hist->id_customer;
			$cust = $this->Customer_model->select_data($data);
			$dat_cust = $cust->row();
			
			$data_det['id_customer_history'] = $id_customer_history;
			$dat_cust_hist_det = $this->Customer_model->select_history_detail_data($data_det);
			
			
			$total_finish = $this->Customer_model->get_count_finish($this->session->userdata('office_id'),$pit_no);
		
			echo json_encode(array(
				'dat_cust' => $dat_cust,
				'dat_cust_hist' => $dat_cust_hist,
				'dat_cust_hist_det' => $dat_cust_hist_det,
				'total_finish' => $total_finish,
				'result' => 1
			));
		};
	}

	public function save($isSubmit=0){
		if($this->input->post('id_customer')!=""){
			$dataHist['id_customer_history'] = $this->input->post('id_customer_history');
			$dataHist['id_customer'] = $this->input->post('id_customer');
			$dataHist['keluhan'] = $this->input->post('keluhan');
			$dataHist['diganti'] = $this->input->post('diganti');
			$dataHist['keterangan'] = $this->input->post('keterangan');
			
			if($isSubmit==1){
				$dataHist['finish_datetime'] = date('Y-m-d H:i:s');
				$dataHist['kode_trx'] = "A".$dataHist['id_customer_history'];
			}
		
			$dataHist['crby'] = $this->session->userdata('id_user');
			$dataHist['id_perusahaan'] = $this->session->userdata('office_id');
			$dataHist['tipe'] = $this->session->userdata('tipe');
				
			//Save Customer History
			$this->Customer_model->update_history($dataHist);
			
			$id_customer_history = $this->input->post('id_customer_history');
			
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
				$this->Customer_model->delete_hist_detail_by_cust_hist($id_customer_history);
				$total = 0;
				$arrCount--;
				for($j = 0; $j < $arrCount; $j++) {
					$total += $arr_sub_total[$j];
				}
				for($i = 0; $i < $arrCount; $i++) {				
					if($arr_kode_barang[$i]!=""){
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