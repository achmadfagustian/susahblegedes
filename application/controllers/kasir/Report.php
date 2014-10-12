<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->fungsi->check_login(2);
    }	
	
	public function index(){
		$data = array(
			'title' => 'Kasir | Report',
			'menu_active' => M_REPORT_K,
			'submenu_active' => ''
		);
		$this->view('kasir/report/dashboard',$data);
	}
	
	public function riwayat_kendaraan(){
		$data = array(
			'title' => 'Kasir | Report -> Riwayat Kendaraan',
			'menu_active' => M_REPORT_K,
			'submenu_active' => M_REPORT_K_RIWAYAT_KENDARAAN
		);
		$this->view('kasir/report/riwayat_kendaraan',$data);
	}
	
	public function riwayat_kendaraan_detail(){
		$data = array(
			'title' => 'Kasir | Report -> Riwayat Kendaraan Detail',
			'menu_active' => M_REPORT_K,
			'submenu_active' => M_REPORT_K_RIWAYAT_KENDARAAN_DETAIL
		);
		$this->view('kasir/report/riwayat_kendaraan_detail',$data);
	}
	
	public function service(){
		$data = array(
			'title' => 'Kasir | Report -> Service',
			'menu_active' => M_REPORT_K,
			'submenu_active' => M_REPORT_K_SERVICE
		);
		$this->view('kasir/report/service',$data);
	}
	
	public function service_detail(){
		$data = array(
			'title' => 'Kasir | Report -> Service Detail',
			'menu_active' => M_REPORT_K,
			'submenu_active' => M_REPORT_K_SERVICE_DETAIL
		);
		$this->view('kasir/report/service_detail',$data);
	}
	
	public function penjualan(){
		$data = array(
			'title' => 'Kasir | Report -> Penjualan',
			'menu_active' => M_REPORT_K,
			'submenu_active' => M_REPORT_K_PENJUALAN
		);
		$this->view('kasir/report/penjualan',$data);
	}
	
	public function penjualan_detail(){
		$data = array(
			'title' => 'Kasir | Report -> Penjualan Detail',
			'menu_active' => M_REPORT_K,
			'submenu_active' => M_REPORT_K_PENJUALAN_DETAIL
		);
		$this->view('kasir/report/penjualan_detail',$data);
	}
	
	public function mekanik(){
		$data = array(
			'title' => 'Kasir | Report -> Mekanik',
			'menu_active' => M_REPORT_K,
			'submenu_active' => M_REPORT_K_MEKANIK
		);
		$this->view('kasir/report/mekanik',$data);
	}
	
	public function view($php,$data){
		$this->parser->parse('template/site_head', $data);
	 	$this->parser->parse('template/site_kasir_top', $data);
		$this->load->view($php,$data);
		$this->parser->parse('template/site_foot', $data);
	}
}