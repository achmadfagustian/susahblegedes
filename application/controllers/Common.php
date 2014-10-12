<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		if(!$this->fungsi->is_login()){
			redirect('login/logout');
		}
		
		$this->load->model('Customer_model', '', TRUE);
		$this->load->model('Barang_model', '', TRUE);
		$this->load->model('Perusahaan_model', '', TRUE);
		$this->load->model('Template_model', '', TRUE);
    }
	
	public function index(){
		redirect('login/logout');
	}
	
	public function history_kendaraan($pos="",$val=""){
		$data['id_pelanggan'] = "";
		$data['no_polisi'] = "";
		if($pos=="id_pelanggan"){
			$data['id_pelanggan'] = $val;
		}else if($pos=="no_polisi"){
			$data['no_polisi'] = $val;
		}
		$data['pos'] = $pos;
		$this->load->view('common/history_kendaraan',$data);
	}
	
	public function stock($val=""){
		$data['search'] = $val;	
		$this->load->view('common/stock',$data);
	}
	
	public function stock_table_index(){
		$data['search']	= $this->input->get('search');
		$this->load->view('common/template/stock_table',$data);
	}
	
	public function stock_table(){
		$search	= $this->input->post('search');
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "common/stock_table/";
		$config["total_rows"] = $this->Barang_model->record_count_common_all($search);
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['page'] = $page;

		$data["results"] = $this->Barang_model->fetch_record_common_all($config["per_page"], $page, $search);

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'search'		=> $search,
				'results' 		=> $data["results"],
				'pagination' 	=> $this->pagination->create_links()
			));
		};
	}
	
	public function total_finish($pit_no=""){
		$data['pit_no'] = $pit_no; 
		$this->load->view('common/total_finish',$data);
	}
	
	public function total_finish_index(){
		$data['pit_no']	= $this->input->get('pit_no');
		$data['search']	= $this->input->get('search');
		$this->load->view('common/template/total_finish_table',$data);
	}
	
	public function total_finish_table(){
		$data['id_perusahaan'] 	= $this->session->userdata('office_id');
		$data['pit_no']	= $this->input->post('pit_no');
		$data['search']	= $this->input->post('search');
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "common/total_finish_table/";
		$config["total_rows"] = $this->Customer_model->record_count_finish_all($data);
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['page'] = $page;

		$data["results"] = $this->Customer_model->fetch_record_finish_all($config["per_page"], $page, $data);

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'pit_no'		=> $data['pit_no'],
				'search'		=> $data['search'],
				'results' 		=> $data["results"],
				'pagination' 	=> $this->pagination->create_links()
			));
		};
	}
	
	public function detail_penjualan($id_customer_history=""){
		$data['id_customer_history'] = $id_customer_history;
		$dataCh = $this->Customer_model->select_history_mekanik_user($data);
		$data['kode_trx'] = $dataCh->kode_trx;
		$data['finish_datetime'] = $dataCh->finish_datetime;
		$data['mekanik_nama'] = $dataCh->mekanik_nama;
		
		$dataP = $this->Perusahaan_model->get_data($dataCh->id_perusahaan);
		$data['perusahaan_nama'] = $dataP->nama;
		
		$dataC['id_customer'] = $dataCh->id_customer;
		$dataC = $this->Customer_model->select_data($dataC);
		$dataC = $dataC->row();
		$data['id_pelanggan'] = $dataC->id_pelanggan;
		$data['no_polisi'] = $dataC->no_polisi;
		$data['pemilik'] = $dataC->pemilik;
		$data['tipe'] = $dataC->tipe;
		$data['km'] = $dataCh->km;
		
		$data['keluhan'] = $dataCh->keluhan;
		$data['diganti'] = $dataCh->diganti;
		
		$data_det['id_customer_history'] = $id_customer_history;
		$data['detail'] = $this->Customer_model->select_history_detail_data($data_det);
		
		$data['template'] = $this->Template_model->select_all();
		
		$this->load->view('common/detail_penjualan',$data);
	}
	
	public function get_customer($pos=""){
		$result = "";
		$val = $this->input->post('val');
		if($pos=="id_pelanggan"){
			$data['id_pelanggan'] = $val;
			$result = $this->Customer_model->select_data($data);
			$result = $result->row();
		}else if($pos=="no_polisi"){
			$data['no_polisi'] = $val;
			$result = $this->Customer_model->select_data($data);
			$result = $result->row();
		}
		if(!empty($result)){
			echo json_encode(array(
				'id_customer' => $result->id_customer,
				'id_pelanggan' => $result->id_pelanggan,
				'no_polisi' => $result->no_polisi,	
				'pemilik' => $result->pemilik,	
				'alamat' => $result->alamat,	
				'telepon' => $result->telepon,	
				'tipe' => $result->tipe,	
				'merek' => $result->merek,	
				'jenis' => $result->jenis,	
				'warna' => $result->warna,	
				'tahun_produksi' => $result->tahun_produksi,	
				'no_rangka' => $result->no_rangka,	
				'no_mesin' => $result->no_mesin,	
				'keterangan' => $result->keterangan,	
				'result' => 1
			));
		}else{
			echo json_encode(array(
				'result' => 0
			));
		}	
	}
	
	public function get_customer_compl($pos=""){
		$result = "";
		$val = $this->input->post('val');
		if($pos=="id_pelanggan"){
			$data['id_pelanggan'] = $val;
			$result = $this->Customer_model->select_data($data);
			$result = $result->row();
		}else if($pos=="no_polisi"){
			$data['no_polisi'] = $val;
			$result = $this->Customer_model->select_data($data);
			$result = $result->row();
		}
		$result_mek = $this->Customer_model->select_data_compl($result->id_customer);
		if(!empty($result)){
			echo json_encode(array(
				'id_customer' => $result->id_customer,
				'id_pelanggan' => $result->id_pelanggan,
				'no_polisi' => $result->no_polisi,	
				'pemilik' => $result->pemilik,	
				'nik_mekanik' => $result_mek->nik_mekanik,
				'nama_mekanik' => $result_mek->nama_mekanik,
				'result' => 1
			));
		}else{
			echo json_encode(array(
				'result' => 0
			));
		}	
	}
	
	public function get_customer_mek($pos="",$val=""){
		$result = "";
		
		if($pos=="id_pelanggan"){
			$data['id_pelanggan'] = $val;
			$result = $this->Customer_model->select_data_trx($data);
			$result = $result->row();
		}else if($pos=="no_polisi"){
			$data['no_polisi'] = $val;
			$result = $this->Customer_model->select_data_trx($data);
			$result = $result->row();
		}
		if(!empty($result)){
			echo json_encode(array(
				'id_customer' => $result->id_customer,
				'id_pelanggan' => $result->id_pelanggan,
				'no_polisi' => $result->no_polisi,	
				'pemilik' => $result->pemilik,	
				'nik_mekanik' => $result->nik_mekanik,
				'nama_mekanik' => $result->nama_mekanik,
				'result' => 1
			));
		}else{
			echo json_encode(array(
				'result' => 0
			));
		}	
	}
	
	public function get_customer_trx($pit_no=""){
		$data['id_perusahaan'] 	= $this->session->userdata('office_id');
		$data['pit_no'] 		= $pit_no;
		$cust_hist = $this->Customer_model->select_available_history_data($data);
		
		$total_finish = $this->Customer_model->get_count_finish($data['id_perusahaan'],$data['pit_no']);
		
		if($cust_hist->num_rows() > 0){
			$dat_cust_hist = $cust_hist->row();
		
			$data['id_customer'] = $dat_cust_hist->id_customer;
			$cust = $this->Customer_model->select_data($data);
			$dat_cust = $cust->row();
			
			$data_det['id_customer_history'] = $dat_cust_hist->id_customer_history;
			$dat_cust_hist_det = $this->Customer_model->select_history_detail_data($data_det);
			
			echo json_encode(array(
				'dat_cust' => $dat_cust,
				'dat_cust_hist' => $dat_cust_hist,
				'dat_cust_hist_det' => $dat_cust_hist_det,
				'total_finish' => $total_finish,
				'result' => 1
			));
		}else{
			echo json_encode(array(
				'total_finish' => $total_finish,	
				'result' => 0
			));
		}
	}
	
	public function get_customer_hist($pos="",$crit=""){
		$result = "";
		$val = $this->input->post('val');
		if($pos=="id_pelanggan"){
			$data['id_pelanggan'] = $val;
		}else if($pos=="no_polisi"){
			$data['no_polisi'] = $val;
		}
		if($crit=="where"){
			$result = $this->Customer_model->select_data($data);
		}else{
			$result = $this->Customer_model->select_data_like($data);
		}
		
		if($result->num_rows() > 0){
			$result = $result->row();
			
			$data['id_customer'] = $result->id_customer;
			$data['limit'] = 10;
			$result_hist = $this->Customer_model->select_history_data_all($data);
			$result_hist = $result_hist->result_array();
			
			echo json_encode(array(
				'id_customer' => $result->id_customer,
				'id_pelanggan' => $result->id_pelanggan,
				'no_polisi' => $result->no_polisi,	
				'pemilik' => $result->pemilik,	
				'tipe' => $result->tipe,	
				'hist' => $result_hist,
				'result' => 1
			));
		}else{
			echo json_encode(array(
				'result' => 0
			));
		}
	}
	
	public function get_customer_hist_detail(){
		$data_det['id_customer_history'] = $this->input->post('id_ch');
		$dat_cust_hist_det = $this->Customer_model->select_history_detail_data_arr($data_det);
		if($dat_cust_hist_det->num_rows() > 0){
			echo json_encode(array(
				'hist_detail' => $dat_cust_hist_det->result_array(),
				'result' => 1
			));
		}else{
			echo json_encode(array(
				'result' => 0
			));
		}
	}
	
	public function get_barang(){
		$data['kode_barang'] = $search	= $this->input->post('kode');
		$result = $this->Barang_model->select_data($data);
		$result = $result->row();
		
		if(!empty($result)){
			echo json_encode(array(
				'nama' => $result->nama,
				'satuan' => $result->kode_satuan,	
				'harga' => $result->hpp_terbesar,
				'result' => 1
			));
		}else{
			echo json_encode(array(
				'result' => 0
			));
		}		
	}
	
	public function get_id_pelanggan(){	
		if (isset($_GET['term'])){
		  $q = strtolower($_GET['term']);
		  $result = $this->Customer_model->get_id_pelanggan($q);
		  foreach ($result->result_array() as $row){
			$new_row['label']=htmlentities(stripslashes($row['id_pelanggan']));
			$new_row['value']=htmlentities(stripslashes($row['id_pelanggan']));
			$row_set[] = $new_row;
		  }
		  echo json_encode($row_set);
		}
	}
	
	public function get_no_polisi(){	
		if (isset($_GET['term'])){
		  $q = strtolower($_GET['term']);
		  $result = $this->Customer_model->get_no_polisi($q);
		  foreach ($result->result_array() as $row){
			$new_row['label']=htmlentities(stripslashes($row['no_polisi']));
			$new_row['value']=htmlentities(stripslashes($row['no_polisi']));
			$row_set[] = $new_row;
		  }
		  echo json_encode($row_set);
		}
	}
	
	public function view($php,$data){
		$this->parser->parse('template/site_head', $data);
	 	$this->parser->parse('template/site_kasir_top', $data);
		$this->load->view($php,$data);
		$this->parser->parse('template/site_foot', $data);
	}
	
}