<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->fungsi->check_login(1);
		$this->load->model('Report_model', '', TRUE);
    }
	
	public function index(){
		$data = array(
			'title' => 'Admin | Master Data',
			'menu_active' => M_REPORT_A,
			'submenu_active' => ''
		);
		$this->view('admin/report/dashboard',$data);
	}
	
	public function absensi(){
		$data = array(
			'title' => 'Admin | Report -> Absensi',
			'menu_active' => M_REPORT_A,
			'submenu_active' => M_REPORT_A_ABSENSI
		);
		$this->view('admin/report/absensi',$data);
	}
	
	public function absensi_table_index(){
		$data = array( 	'date_from'	=> $this->input->get('date_from'),
						'date_to'	=> $this->input->get('date_to'),
						'nama'		=> $this->input->get('nama'));
		$this->load->view('admin/report/template/absensi_table',$data);
	}
	
	public function absensi_table(){
		$filter = array('date_from'	=> $this->input->post('date_from'),
						'date_to'	=> $this->input->post('date_to'),
						'nama'		=> $this->input->post('nama'));
						
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "admin/report/absensi_table/";
		$config["total_rows"] = $this->Report_model->record_count_absensi();
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->Report_model->fetch_record_absensi($config["per_page"], $page);

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'date_from'	=> $filter['date_from'],
				'date_to' 	=> $filter['date_to'],
				'nama' 		=> $filter['nama'],
				'results' 	=> $data["results"],
				'pagination'=> $this->pagination->create_links()
			));
		};
	}
	
	public function print_absensi_xls(){
		
	}
//====================================================================	
	public function riwayat_kendaraan(){
		$data = array(
			'title' => 'Admin | Report -> Riwayat Kendaraan',
			'menu_active' => M_REPORT_A,
			'submenu_active' => M_REPORT_A_RIWAYAT_KENDARAAN
		);
		$this->view('admin/report/template/riwayat_kendaraan',$data);
	}
	
	public function riwayat_table_index(){
		$data = array( 	'date_from'	=> $this->input->get('date_from'),
						'date_to'	=> $this->input->get('date_to'),
						'nama'		=> $this->input->get('nama'));
		$this->load->view('admin/report/template/riwayat_table',$data);
	}
	public function riwayat_table(){
		$filter = array('date_from'	=> $this->input->post('date_from'),
						'date_to'	=> $this->input->post('date_to'),
						'nama'		=> $this->input->post('nama'));
						
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "admin/report/riwayat_table/";
		$config["total_rows"] = $this->Report_model->record_count_riwayat();
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->Report_model->fetch_record_riwayat($config["per_page"], $page);

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'date_from'	=> $filter['date_from'],
				'date_to' 	=> $filter['date_to'],
				'nama' 		=> $filter['nama'],
				'results' 	=> $data["results"],
				'pagination'=> $this->pagination->create_links()
			));
		};
	}
	public function print_riwayat_kendaraan_xls(){
		
	}
//=========================================================================	
	public function riwayat_kendaraan_detail(){
		$data = array(
			'title' => 'Admin | Report -> Riwayat Kendaraan Detail',
			'menu_active' => M_REPORT_A,
			'submenu_active' => M_REPORT_A_RIWAYAT_KENDARAAN_DETAIL
		);
		$this->view('admin/report/riwayat_kendaraan_detail',$data);
	}
	
	public function print_riwayat_kendaraan_detail_xls(){
		
	}
//==============================================================================	
	public function service(){
		$data = array(
			'title' => 'Admin | Report -> Service',
			'menu_active' => M_REPORT_A,
			'submenu_active' => M_REPORT_A_SERVICE
		);
		$this->view('admin/report/service',$data);
	}
	
	public function print_service_xls(){
	
	}

	public function service_detail(){
		$data = array(
			'title' => 'Admin | Report -> Service Detail',
			'menu_active' => M_REPORT_A,
			'submenu_active' => M_REPORT_A_SERVICE_DETAIL
		);
		$this->view('admin/report/service_detail',$data);
	}
	
	public function print_service_detail_xls(){
	
	}

	public function service_table_index(){
		$data = array( 	'kode_perusahaan'	=> $this->input->get('kode_perusahaan'),
						'nama'			=> $this->input->get('nama'),
						'kota'			=> $this->input->get('kota'),
						'kodepos'		=> $this->input->get('kodepos'),
						'no_telp'		=> $this->input->get('no_telp'),
						'no_fax'		=> $this->input->get('no_fax'));
		$this->load->view('admin/report/template/service_table',$data);
	}
	public function service_table(){
		$filter = array('date_from'	=> $this->input->post('date_from'),
						'date_to'	=> $this->input->post('date_to'),
						'nama'		=> $this->input->post('nama'));
						
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "admin/report/absensi_table/";
		$config["total_rows"] = $this->Report_model->record_count_absensi();
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->Report_model->fetch_record_service($config["per_page"], $page);

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'date_from'	=> $filter['date_from'],
				'date_to' 	=> $filter['date_to'],
				'nama' 		=> $filter['nama'],
				'results' 	=> $data["results"],
				'pagination'=> $this->pagination->create_links()
			));
		};
	}
//==============================================================================	
	
	public function penjualan(){
		$data = array(
			'title' => 'Admin | Report -> Penjualan',
			'menu_active' => M_REPORT_A,
			'submenu_active' => M_REPORT_A_PENJUALAN
		);
		$this->view('admin/report/penjualan',$data);
	}
	
	public function print_penjualan_xls(){
		
	}
//==============================================================================	
	
	public function penjualan_detail(){
		$data = array(
			'title' => 'Admin | Report -> Penjualan Detail',
			'menu_active' => M_REPORT_A,
			'submenu_active' => M_REPORT_A_PENJUALAN_DETAIL
		);
		$this->view('admin/report/penjualan_detail',$data);
	}
	
	public function print_penjualan_detail_xls(){
		
	}
//==============================================================================	
	
	public function mekanik(){
		$data = array(
			'title' => 'Admin | Report -> Mekanik',
			'menu_active' => M_REPORT_A,
			'submenu_active' => M_REPORT_A_MEKANIK
		);
		$this->view('admin/report/mekanik',$data);
	}
	
	public function print_mekanik_xls(){
		
	}
//==============================================================================	
	
	public function mekanik_detail(){
		$data = array(
			'title' => 'Admin | Report -> Mekanik Detail',
			'menu_active' => M_REPORT_A,
			'submenu_active' => M_REPORT_A_MEKANIK_DETAIL
		);
		$this->view('admin/report/mekanik_detail',$data);
	}
	
	public function print_mekanik_detail_xls(){
		
	}
	//==============================================================================	
	
	public function stok_barang(){
		$data = array(
			'title' => 'Admin | Report -> Stok Barang',
			'menu_active' => M_REPORT_A,
			'submenu_active' => M_REPORT_A_MEKANIK_DETAIL
		);
		$this->view('admin/report/stok_barang',$data);
	}
	
	public function print_stok_barang_xls(){
		
	}
	//==============================================================================	
	
	public function stok_barang_detail(){
		$data = array(
			'title' => 'Admin | Report -> Mekanik Detail',
			'menu_active' => M_REPORT_A,
			'submenu_active' => M_REPORT_A_MEKANIK_DETAIL
		);
		$this->view('admin/report/stok_detail',$data);
	}
	
	public function print_stok_barang_detil_xls(){
		
	}
//==============================================================================	
	
	public function view($php,$data){
		$this->parser->parse('template/site_head', $data);
		$this->parser->parse('template/site_admin_top', $data);
		$this->load->view($php,$data);
		$this->parser->parse('template/site_foot', $data);
	}
}