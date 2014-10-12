<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penjualan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->fungsi->check_login(KASIR);
		$this->load->model('Template_model', '', TRUE);
    }	

	public function index(){
		$this->jual();
	}
	
	public function jual(){
		$data = array(
			'title' => 'Kasir | Penjualan',
			'menu_active' => M_PENJUALAN
		);
		$data['template'] = $this->Template_model->select_all();
		$this->view('kasir/penjualan/jual_form',$data);
	}
	
	public function view($php,$data){
		$this->parser->parse('template/site_head', $data);
	 	$this->parser->parse('template/site_kasir_top', $data);
		$this->load->view($php,$data);
		$this->parser->parse('template/site_foot', $data);
	}
}