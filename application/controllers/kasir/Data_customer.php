<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_customer extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->fungsi->check_login(KASIR);
		$this->load->model('Customer_model', '', TRUE);
    }

	public function index(){
		$this->form();
	}
	
	public function cust_list(){
		$data = array(
			'title' => 'Kasir | Data Customer -> List',
			'menu_active' => M_DATA_CUSTOMER,
			'submenu_active' => M_DATA_CUSTOMER_LIST
		);
		$this->view('kasir/data_customer/customer_list',$data);
	}
	
	public function cust_table_index(){
		$data = array(	'search'		=> $this->input->get('search'));
		$this->load->view('kasir/data_customer/template/customer_table',$data);
	}
	
	public function cust_table(){
		$search	= $this->input->post('search');
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "kasir/data_customer/cust_table/";
		$config["total_rows"] = $this->Customer_model->record_count($search);
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->Customer_model->fetch_record($config["per_page"], $page,$search);

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'search'	=> $search,
				'results' 		=> $data["results"],
				'pagination' 	=> $this->pagination->create_links()
			));
		};
	}
	
	public function form($id=0){
		$data = array(
			'title' => 'Kasir | Data Customer -> Form',
			'menu_active' => M_DATA_CUSTOMER,
			'submenu_active' => M_DATA_CUSTOMER_ADD_EDIT,
			'form_action' => site_url('kasir/data_customer/save')
		);
		$data['id_customer'] = $id;
		if($id>0){
			$result = $this->Customer_model->select_data($data);
			$result = $result->row();
		
			$data['id_pelanggan'] = $result->id_pelanggan;
			$data['no_polisi'] = $result->no_polisi;
			$data['pemilik'] = $result->pemilik;
			$data['alamat'] = $result->alamat;
			$data['telepon'] = $result->telepon;
			$data['tipe'] = $result->tipe;
			$data['merek'] = $result->merek;	
			$data['jenis'] = $result->jenis;	
			$data['warna'] = $result->warna;
			$data['tahun_produksi'] = $result->tahun_produksi;
			$data['no_rangka'] = $result->no_rangka;
			$data['no_mesin'] = $result->no_mesin;
			$data['keterangan'] = $result->keterangan;
		}
		
		$this->view('kasir/data_customer/customer_form',$data);
	}
	
	public function save(){
		$data = array(	'id_pelanggan'	=> $this->input->post('id_pelanggan'),
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
		if($this->input->post('id_customer') > 0){
			$data['id_customer'] = $this->input->post('id_customer');
			$this->Customer_model->update($data);
		}else{
			$data['crby'] = $this->session->userdata('id_user');
			$this->Customer_model->insert($data);
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