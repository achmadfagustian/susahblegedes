<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class List_transaksi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->fungsi->check_login(KASIR);
		$this->load->model('Customer_model', '', TRUE);
    }	
	
	public function index(){
		$data = array(
			'title' => 'Kasir | List Transaksi',
			'menu_active' => M_LIST_TRANSAKSI
		);
		$this->view('kasir/list_transaksi/list',$data);
	}
	
	public function table_index(){
		$data = array(	'pemilik'		=> $this->input->get('pemilik'),
						'no_polisi'		=> $this->input->get('no_polisi'),
						'jenis'			=> $this->input->get('jenis'),
						'tipe'			=> $this->input->get('tipe'));
		$this->load->view('kasir/list_transaksi/template/transaksi_table',$data);
	}
	
	public function table(){
		$filter = array('pemilik'		=> $this->input->post('pemilik'),
						'no_polisi'		=> $this->input->post('no_polisi'),
						'jenis'			=> $this->input->post('jenis'),
						'tipe'			=> $this->input->post('tipe'));
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "kasir/list_transaksi/table/";
		$config["total_rows"] = $this->Customer_model->record_count_trx($filter);
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->Customer_model->fetch_record_trx($config["per_page"], $page,$filter);

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'pemilik'		=> $filter['pemilik'],
				'no_polisi'		=> $filter['no_polisi'],
				'jenis'			=> $filter['jenis'],
				'tipe'			=> $filter['tipe'],
				'results' 		=> $data["results"],
				'pagination' 	=> $this->pagination->create_links()
			));
		};
	}
	
	public function view($php,$data){
		$this->parser->parse('template/site_head', $data);
	 	$this->parser->parse('template/site_kasir_top', $data);
		$this->load->view($php,$data);
		$this->parser->parse('template/site_foot', $data);
	}
	
}