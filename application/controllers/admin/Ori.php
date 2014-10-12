<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ori extends CI_Controller {

	public function __construct(){
            parent::__construct();
    }
	
	public function index()
	{
		$data = array(
			'title' => 'Admin | Dashboard',
			'menu_active' => M_DASHBOARD
		);
		$this->view('admin/dashboard',$data);
	}
	
	public function view($php,$data){
		$this->parser->parse('template/site_head', $data);
		$this->parser->parse('template/site_admin_top', $data);
		$this->load->view($php,$data);
		$this->parser->parse('template/site_foot', $data);
	}
}