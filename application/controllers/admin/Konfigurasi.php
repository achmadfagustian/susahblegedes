<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Konfigurasi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->fungsi->check_login(ADMIN);
		$this->load->model('Konfigurasi_model', '', TRUE);
    }
	
	public function index(){
		$data = array(
			'title' => 'Admin | Konfigurasi',
			'menu_active' => M_KONFIGURASI
		);
		$this->view('admin/konfigurasi',$data);
	}
	
	public function konfigurasi_table_index(){
		$this->load->view('admin/template/konfigurasi_table');
	}
	
	public function konfigurasi_table(){
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "admin/konfigurasi/konfigurasi_table/";
		$config["total_rows"] = $this->Konfigurasi_model->record_count();
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->Konfigurasi_model->fetch_record($config["per_page"], $page);
		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'results' => $data["results"],
				'pagination' => $this->pagination->create_links()
			));
		};
	}
	
	public function konfigurasi_save(){
		$data = array( 	'nama'		=> $this->input->post('nama'),
						'value1'	=> $this->input->post('value1'),
						'value2'	=> $this->input->post('value2'));
		$this->Konfigurasi_model->update($data);
		echo "1";
	}
	
	public function konfigurasi_get_data($nama){
		$data = $this->Konfigurasi_model->get_data($nama);
	
		echo json_encode(array(
			'nama' => $data->nama,
			'value1' => $data->value1,
			'value2' => $data->value2
		));
	}
	
	public function view($php,$data){
		$this->parser->parse('template/site_head', $data);
		$this->parser->parse('template/site_admin_top', $data);
		$this->load->view($php,$data);
		$this->parser->parse('template/site_foot', $data);
	}
}