<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->fungsi->check_login(1);
		$this->load->model('Role_model', '', TRUE);
    }
	
	public function index(){
		$data = array(
			'title' => 'Admin | Role',
			'menu_active' => M_ROLE
		);
		$this->view('admin/role',$data);
	}
	
	public function view($php,$data){
		$this->parser->parse('template/site_head', $data);
		$this->parser->parse('template/site_admin_top', $data);
		$this->load->view($php,$data);
		$this->parser->parse('template/site_foot', $data);
	}
}