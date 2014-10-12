<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Po_do extends CI_Controller {

	public function index(){
		$data = array(
			'title' => 'Kasir | PO/DO',
			'menu' => 'poDo'
		);
		$this->view('kasir/po_do',$data);
	}
	
	public function view($php,$data){
		$this->parser->parse('template/site_head', $data);
	 	$this->parser->parse('template/site_kasir_top', $data);
		$this->load->view($php,$data);
		$this->parser->parse('template/site_foot', $data);
	}
}