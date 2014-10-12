<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
            parent::__construct();
			
			$this->fungsi->check_login(1);
    }
	
	public function index()
	{
		$data = array(
			'title' => 'Admin | Dashboard',
			'menu_active' => M_DASHBOARD
		);
		//Stock Limit
		$data['stockLimit'] = "";
		//Absensi
		$data['absensi'] = "";
		//Trx Service
		$data['service'] = "";
		//PCO
		$data['pco'] = "";
		$this->view('admin/dashboard',$data);
	}
	
	public function view($php,$data){
		$this->parser->parse('template/site_head', $data);
		$this->parser->parse('template/site_admin_top', $data);
		$this->load->view($php,$data);
		$this->parser->parse('template/site_foot', $data);
	}
}