<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pco extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->fungsi->check_login(2);
    }	
	
	public function index(){
		$data = array(
			'title' => 'Kasir | PCO',
			'menu_active' => M_PCO
		);
		$this->view('kasir/pco',$data);
	}
	
	public function view($php,$data){
		$this->parser->parse('template/site_head', $data);
	 	$this->parser->parse('template/site_kasir_top', $data);
		$this->load->view($php,$data);
		$this->parser->parse('template/site_foot', $data);
	}
}