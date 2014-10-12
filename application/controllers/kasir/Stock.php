<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->fungsi->check_login(KASIR);
		$this->load->model('Golongan_model', '', TRUE);
		$this->load->model('Satuan_model', '', TRUE);
		$this->load->model('Barang_model', '', TRUE);
		$this->load->model('Lokasi_model', '', TRUE);
		$this->load->model('Supplier_model', '', TRUE);
    }	
	
	public function index(){
		$data = array(
			'title' => 'Kasir | Stock',
			'menu_active' => M_STOCK,
			'submenu_active' => ''
		);
		$this->view('kasir/stock/dashboard',$data);
	}
	
	/*-------------------------
	|
	| List Barang/Jasa
	|
	-------------------------*/
	public function barang_list(){
		$data = array(
			'title' => 'Kasir | Stock -> List Barang/Jasa',
			'menu_active' => M_STOCK,
			'submenu_active' => M_STOCK_LIST
		);
		$this->view('kasir/stock/barang_list',$data);
	}
	
	public function barang_table_index(){
		$data = array( 	'kode_barang'	=> $this->input->get('kode_barang'),
						'nama'			=> $this->input->get('nama'),
						'nama_alias'	=> $this->input->get('nama_alias'),
						'jenis'			=> $this->input->get('jenis'),
						'status'		=> $this->input->get('status'));
		$this->load->view('kasir/stock/template/barang_table',$data);
	}
	
	public function barang_table(){
		$filter = array('kode_barang'	=> $this->input->post('kode_barang'),
						'nama'			=> $this->input->post('nama'),
						'nama_alias'	=> $this->input->post('nama_alias'),
						'jenis'			=> $this->input->post('jenis'),
						'status'		=> $this->input->post('status'));
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "kasir/stock/barang_table/";
		$config["total_rows"] = $this->Barang_model->record_count($filter);
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->Barang_model->fetch_record($config["per_page"], $page,$filter);

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'kode_barang' => $filter['kode_barang'],
				'nama' => $filter['nama'],
				'nama_alias' => $filter['nama_alias'],
				'jenis' => $filter['jenis'],
				'status' => $filter['status'],
				'results' => $data["results"],
				'pagination' => $this->pagination->create_links()
			));
		};
	}
	
	/*-------------------------
	|
	| Add/Edit Barang/Jasa
	|
	-------------------------*/
	public function barang_form(){
		$data = array(
			'title' => 'Kasir | Add Stock',
			'menu_active' => M_STOCK,
			'submenu_active' => M_STOCK_ADD
		);
		$data['golongan'] = $this->Golongan_model->select_all();
		$data['satuan'] = $this->Satuan_model->select_all();
		$data['lokasi'] = $this->Lokasi_model->select_all();
		$data['supplier'] = $this->Supplier_model->select_all();
		$this->view('kasir/stock/barang_form',$data);
	}
	
	public function barang_save(){
		$data = array( 	'kode_barang'	=> $this->input->post('kode_barang'),
						'nama'			=> $this->input->post('nama'),
						'nama_alias'	=> $this->input->post('nama_alias'),
						'jenis'			=> $this->input->post('jenis'),
						'status'		=> $this->input->post('status'),
						'kode_golongan'	=> $this->input->post('kode_golongan'),
						'kode_satuan'	=> $this->input->post('kode_satuan'),
						'jenis_komisi'	=> $this->input->post('jenis_komisi'),
						'persen_komisi'	=> $this->input->post('persen_komisi'),
						'nominal_komisi'=> $this->input->post('nominal_komisi'),
						'hjual'			=> $this->input->post('hjual'),
						'persen_modal'	=> $this->input->post('persen_modal'),
						'hpp_terakhir'	=> $this->input->post('hpp_terakhir'),
						'hpp_terbesar'	=> $this->input->post('hpp_terbesar'),
						'keterangan'	=> $this->input->post('keterangan'));
		if($this->input->post('id_barang')!=""){
			$data['id_barang'] = $this->input->post('id_barang');
			$this->Barang_model->update($data);
		}else{
			$data['crby'] = 0;
			$this->Barang_model->insert($data);
		};
		echo "1";
	}
	
	public function cabang_get_data($id){
		$data = $this->Perusahaan_model->get_data($id,array(PUSAT,CABANG));
	
		echo json_encode(array(
			'id_perusahaan' => $data->id_perusahaan,
			'tipe' => $data->tipe,
			'kode_perusahaan' => $data->kode_perusahaan,
			'nama' => $data->nama,
			'alamat' => $data->alamat,
			'kota' => $data->kota,
			'kodepos' => $data->kodepos,
			'no_telp' => $data->no_telp,
			'no_fax' => $data->no_fax
		));
	}
	
	public function cabang_delete(){
		$data = array('id_perusahaan'	=> $this->input->post('id_perusahaan'));
		$this->Perusahaan_model->delete($data,array(PUSAT,CABANG));
		echo "1";
	}
	
	public function cabang_multi_delete(){
		$arrId = explode(",", $this->input->post('arrId'));
		$this->Perusahaan_model->multiple_delete($arrId,array(PUSAT,CABANG));
		echo "1";
	}
	
	
	
	
	
	
	
	
	
	public function upload(){
		$data = array(
			'title' => 'Kasir | Upload Stock',
			'menu_active' => M_STOCK
		);
		$this->view('kasir/stock_upload',$data);
	}
	
	public function list_view(){
		$data = array(
			'title' => 'Kasir | Upload Stock',
			'menu_active' => M_STOCK
		);
		$this->view('kasir/stock_upload',$data);
	}
	
	public function adjustment(){
		$data = array(
			'title' => 'Kasir | Upload Stock',
			'menu_active' => M_STOCK
		);
		$this->view('kasir/stock_upload',$data);
	}
	
	public function pengiriman_kolega(){
		$data = array(
			'title' => 'Kasir | Upload Stock',
			'menu_active' => M_STOCK
		);
		$this->view('kasir/stock_upload',$data);
	}
	
	public function penerimaan_kolega(){
		$data = array(
			'title' => 'Kasir | Upload Stock',
			'menu_active' => M_STOCK
		);
		$this->view('kasir/stock_upload',$data);
	}
	
	public function s_po(){
		$data = array(
			'title' => 'Kasir | Upload Stock',
			'menu_active' => M_STOCK
		);
		$this->view('kasir/stock_upload',$data);
	}
	
	public function s_do(){
		$data = array(
			'title' => 'Kasir | Upload Stock',
			'menu_active' => M_STOCK
		);
		$this->view('kasir/stock_upload',$data);
	}
	
	public function view($php,$data){
		$this->parser->parse('template/site_head', $data);
	 	$this->parser->parse('template/site_kasir_top', $data);
		$this->load->view($php,$data);
		$this->parser->parse('template/site_foot', $data);
	}
}