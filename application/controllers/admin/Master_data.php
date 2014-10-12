<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_data extends CI_Controller {

	public function __construct(){
            parent::__construct();
			
			$this->fungsi->check_login(ADMIN);
			$this->load->model('Perusahaan_model', '', TRUE);
			$this->load->model('Supplier_model', '', TRUE);
			$this->load->model('Lokasi_model', '', TRUE);
			$this->load->model('Satuan_model', '', TRUE);
			$this->load->model('Golongan_model', '', TRUE);
			$this->load->model('Template_model', '', TRUE);
			$this->load->model('Fingerprint_model', '', TRUE);
			$this->load->model('Paid_card_model', '', TRUE);
    }
	
	public function index(){
		$data = array(
			'title' => 'Admin | Master Data',
			'menu_active' => M_MASTER_DATA,
			'submenu_active' => ''
		);
		$this->view('admin/master_data/dashboard',$data);
	}
	
	public function kolega(){
		$data = array(
			'title' => 'Admin | Master Data -> Kolega',
			'menu_active' => M_MASTER_DATA,
			'submenu_active' => M_MASTER_DATA_KOLEGA
		);
		$this->view('admin/master_data/kolega',$data);
	}
	
	public function kolega_table_index(){
		$data = array( 	'kode_perusahaan'	=> $this->input->get('kode_perusahaan'),
						'nama'			=> $this->input->get('nama'),
						'kota'			=> $this->input->get('kota'),
						'kodepos'		=> $this->input->get('kodepos'),
						'no_telp'		=> $this->input->get('no_telp'),
						'no_fax'		=> $this->input->get('no_fax'));
		$this->load->view('admin/master_data/template/kolega_table',$data);
	}
	
	public function kolega_table(){
		$filter = array('kode_perusahaan'	=> $this->input->post('kode_perusahaan'),
						'nama'			=> $this->input->post('nama'),
						'kota'			=> $this->input->post('kota'),
						'kodepos'		=> $this->input->post('kodepos'),
						'no_telp'		=> $this->input->post('no_telp'),
						'no_fax'		=> $this->input->post('no_fax'));
						
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "admin/master_data/kolega_table/";
		$config["total_rows"] = $this->Perusahaan_model->record_count($filter,array(KOLEGA));
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->Perusahaan_model->fetch_record($config["per_page"], $page,$filter,array(KOLEGA));

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'kode_perusahaan'	=> $filter['kode_perusahaan'],
				'nama' 				=> $filter['nama'],
				'kota' 				=> $filter['kota'],
				'kodepos' 			=> $filter['kodepos'],
				'no_telp' 			=> $filter['no_telp'],
				'no_fax' 			=> $filter['no_fax'],
				'results' 			=> $data["results"],
				'pagination' 		=> $this->pagination->create_links()
			));
		};
	}
	
	public function kolega_save(){
		$data = array( 	'kode_perusahaan'	=> $this->input->post('kode_perusahaan'),
						'nama'			=> $this->input->post('nama'),
						'alamat'		=> $this->input->post('alamat'),
						'kota'			=> $this->input->post('kota'),
						'kodepos'		=> $this->input->post('kodepos'),
						'no_telp'		=> $this->input->post('no_telp'),
						'no_fax'		=> $this->input->post('no_fax'),
						'tipe'			=> KOLEGA);
		if($this->input->post('id_perusahaan')!=""){
			$data['id_perusahaan'] = $this->input->post('id_perusahaan');
			$this->Perusahaan_model->update($data);
		}else{
			$data['crby'] = $this->session->userdata('id_user');
			$this->Perusahaan_model->insert($data);
		};
		echo "1";
	}
	
	public function kolega_get_data($id){
		$data = $this->Perusahaan_model->get_data($id,KOLEGA);
	
		echo json_encode(array(
			'id_perusahaan' => $data->id_perusahaan,
			'kode_perusahaan' => $data->kode_perusahaan,
			'nama' => $data->nama,
			'alamat' => $data->alamat,
			'kota' => $data->kota,
			'kodepos' => $data->kodepos,
			'no_telp' => $data->no_telp,
			'no_fax' => $data->no_fax
		));
	}
	
	public function kolega_delete(){
		$data = array('id_perusahaan'	=> $this->input->post('id_perusahaan'));
		$this->Perusahaan_model->delete($data,array(KOLEGA));
		echo "1";
	}
	
	public function kolega_multi_delete(){
		$arrId = explode(",", $this->input->post('arrId'));
		$this->Perusahaan_model->multiple_delete($arrId,array(KOLEGA));
		echo "1";
	}
	
	public function supplier(){
		$data = array(
			'title' => 'Admin | Master Data -> Supplier',
			'menu_active' => M_MASTER_DATA,
			'submenu_active' => M_MASTER_DATA_SUPPLIER
		);
		$this->view('admin/master_data/supplier',$data);
	}
	
	public function supplier_table_index(){
		$data = array( 	'kode_supplier'	=> $this->input->get('kode_supplier'),
						'nama'			=> $this->input->get('nama'),
						'kota'			=> $this->input->get('kota'),
						'kodepos'		=> $this->input->get('kodepos'),
						'no_telp'		=> $this->input->get('no_telp'),
						'no_fax'		=> $this->input->get('no_fax'),
						'bank'			=> $this->input->get('bank'),
						'no_account'	=> $this->input->get('no_account'),
						'atas_nama'		=> $this->input->get('atas_nama'));
		$this->load->view('admin/master_data/template/supplier_table',$data);
	}
	
	public function supplier_table(){
		$filter = array( 	'kode_supplier'	=> $this->input->post('kode_supplier'),
						'nama'			=> $this->input->post('nama'),
						'kota'			=> $this->input->post('kota'),
						'kodepos'		=> $this->input->post('kodepos'),
						'no_telp'		=> $this->input->post('no_telp'),
						'no_fax'		=> $this->input->post('no_fax'),
						'bank'			=> $this->input->post('bank'),
						'no_account'	=> $this->input->post('no_account'),
						'atas_nama'		=> $this->input->post('atas_nama'));
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "admin/master_data/supplier_table/";
		$config["total_rows"] = $this->Supplier_model->record_count($filter);
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->Supplier_model->fetch_record($config["per_page"], $page, $filter);

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'kode_supplier'	=> $filter['kode_supplier'],
				'nama'			=> $filter['nama'],
				'kota'			=> $filter['kota'],
				'kodepos'		=> $filter['kodepos'],
				'no_telp'		=> $filter['no_telp'],
				'no_fax'		=> $filter['no_fax'],
				'bank'			=> $filter['bank'],
				'no_account'	=> $filter['no_account'],
				'atas_nama'		=> $filter['atas_nama'],
				'results' 		=> $data["results"],
				'pagination' 	=> $this->pagination->create_links()
			));
		};
	}
	
	public function supplier_save(){
		$data = array( 	'kode_supplier'	=> $this->input->post('kode_supplier'),
						'nama'			=> $this->input->post('nama'),
						'alamat'		=> $this->input->post('alamat'),
						'kota'			=> $this->input->post('kota'),
						'kodepos'		=> $this->input->post('kodepos'),
						'no_telp'		=> $this->input->post('no_telp'),
						'no_fax'		=> $this->input->post('no_fax'),
						'bank'			=> $this->input->post('bank'),
						'no_account'	=> $this->input->post('no_account'),
						'atas_nama'		=> $this->input->post('atas_nama'),
						'cp'			=> $this->input->post('cp'),
						'email'			=> $this->input->post('email'),
						'no_hp'			=> $this->input->post('no_hp'));
		if($this->input->post('id_supplier')!=""){
			$data['id_supplier'] = $this->input->post('id_supplier');
			$this->Supplier_model->update($data);
		}else{
			$data['crby'] = $this->session->userdata('id_user');
			$this->Supplier_model->insert($data);
		};
		echo "1";
	}
	
	public function supplier_get_data($id){
		$data = $this->Supplier_model->get_data($id);
	
		echo json_encode(array(
			'id_supplier' => $data->id_supplier,
			'kode_supplier'	=> $data->kode_supplier,
			'nama'			=> $data->nama,
			'alamat'		=> $data->alamat,
			'kota'			=> $data->kota,
			'kodepos'		=> $data->kodepos,
			'no_telp'		=> $data->no_telp,
			'no_fax'		=> $data->no_fax,
			'bank'			=> $data->bank,
			'no_account'	=> $data->no_account,
			'atas_nama'		=> $data->atas_nama,
			'cp'			=> $data->cp,
			'email'			=> $data->email,
			'no_hp'			=> $data->no_hp
		));
	}
	
	public function supplier_delete(){
		$data = array('id_supplier'	=> $this->input->post('id_supplier'));
		$this->Supplier_model->delete($data);
		echo "1";
	}
	
	public function supplier_multi_delete(){
		$arrId = explode(",", $this->input->post('arrId'));
		$this->Supplier_model->multiple_delete($arrId);
		echo "1";
	}
	
	public function lokasi(){
		$data = array(
			'title' => 'Admin | Master Data -> Lokasi Barang',
			'menu_active' => M_MASTER_DATA,
			'submenu_active' => M_MASTER_DATA_LOKASI_BARANG
		);
		$this->view('admin/master_data/lokasi',$data);
	}
	
	public function lokasi_table_index(){
		$data = array( 	'kode_lokasi'	=> $this->input->get('kode_lokasi'),
						'nama'			=> $this->input->get('nama'));
		$this->load->view('admin/master_data/template/lokasi_table',$data);
	}
	
	public function lokasi_table(){
		$filter = array('kode_lokasi'	=> $this->input->post('kode_lokasi'),
						'nama'			=> $this->input->post('nama'));
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "admin/master_data/lokasi_table/";
		$config["total_rows"] = $this->Lokasi_model->record_count($filter);
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->Lokasi_model->fetch_record($config["per_page"], $page, $filter);

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'kode_lokasi'	=> $filter['kode_lokasi'],
				'nama'			=> $filter['nama'],
				'results' 		=> $data["results"],
				'pagination' 	=> $this->pagination->create_links()
			));
		};
	}
	
	public function lokasi_save(){
		$data = array( 	'kode_lokasi'	=> $this->input->post('kode_lokasi'),
						'nama'			=> $this->input->post('nama'),
						'keterangan'	=> $this->input->post('keterangan'));
		if($this->input->post('id_lokasi')!=""){
			$data['id_lokasi'] = $this->input->post('id_lokasi');
			$this->Lokasi_model->update($data);
		}else{
			$data['crby'] = $this->session->userdata('id_user');
			$this->Lokasi_model->insert($data);
		};
		echo "1";
	}
	
	public function lokasi_get_data($id){
		$data = $this->Lokasi_model->get_data($id);
	
		echo json_encode(array(
			'id_lokasi' 	=> $data->id_lokasi,
			'kode_lokasi'	=> $data->kode_lokasi,
			'nama'			=> $data->nama,
			'keterangan'	=> $data->keterangan
		));
	}
	
	public function lokasi_delete(){
		$data = array('id_lokasi'	=> $this->input->post('id_lokasi'));
		$this->Lokasi_model->delete($data);
		echo "1";
	}
	
	public function lokasi_multi_delete(){
		$arrId = explode(",", $this->input->post('arrId'));
		$this->Lokasi_model->multiple_delete($arrId);
		echo "1";
	}
	
	public function satuan(){
		$data = array(
			'title' => 'Admin | Master Data -> Satuan',
			'menu_active' => M_MASTER_DATA,
			'submenu_active' => M_MASTER_DATA_SATUAN
		);
		$this->view('admin/master_data/satuan',$data);
	}
	
	public function satuan_table_index(){
		$data = array( 	'kode_satuan'	=> $this->input->get('kode_satuan'),
						'nama'			=> $this->input->get('nama'));
		$this->load->view('admin/master_data/template/satuan_table',$data);
	}
	
	public function satuan_table(){
		$filter = array('kode_satuan'	=> $this->input->post('kode_satuan'),
						'nama'			=> $this->input->post('nama'));
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "admin/master_data/satuan_table/";
		$config["total_rows"] = $this->Satuan_model->record_count($filter);
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->Satuan_model->fetch_record($config["per_page"], $page, $filter);

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'kode_satuan'	=> $filter['kode_satuan'],
				'nama'			=> $filter['nama'],
				'results' 		=> $data["results"],
				'pagination' 	=> $this->pagination->create_links()
			));
		};
	}
	
	public function satuan_save(){
		$data = array( 	'kode_satuan'	=> $this->input->post('kode_satuan'),
						'nama'			=> $this->input->post('nama'),
						'keterangan'	=> $this->input->post('keterangan'));
		if($this->input->post('id_satuan')!=""){
			$data['id_satuan'] = $this->input->post('id_satuan');
			$this->Satuan_model->update($data);
		}else{
			$data['crby'] = $this->session->userdata('id_user');
			$this->Satuan_model->insert($data);
		};
		echo "1";
	}
	
	public function satuan_get_data($id){
		$data = $this->Satuan_model->get_data($id);
	
		echo json_encode(array(
			'id_satuan' 	=> $data->id_satuan,
			'kode_satuan'	=> $data->kode_satuan,
			'nama'			=> $data->nama,
			'keterangan'	=> $data->keterangan
		));
	}
	
	public function satuan_delete(){
		$data = array('id_satuan'	=> $this->input->post('id_satuan'));
		$this->Satuan_model->delete($data);
		echo "1";
	}
	
	public function satuan_multi_delete(){
		$arrId = explode(",", $this->input->post('arrId'));
		$this->Satuan_model->multiple_delete($arrId);
		echo "1";
	}
	
	public function golongan(){
		$data = array(
			'title' => 'Admin | Master Data -> Golongan',
			'menu_active' => M_MASTER_DATA,
			'submenu_active' => M_MASTER_DATA_GOLONGAN
		);
		$this->view('admin/master_data/golongan',$data);
	}
	
	public function golongan_table_index(){
		$data = array( 	'kode_golongan'	=> $this->input->get('kode_golongan'),
						'nama'			=> $this->input->get('nama'));
		$this->load->view('admin/master_data/template/golongan_table',$data);
	}
	
	public function golongan_table(){
		$filter = array('kode_golongan'	=> $this->input->post('kode_golongan'),
						'nama'			=> $this->input->post('nama'));
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "admin/master_data/golongan_table/";
		$config["total_rows"] = $this->Golongan_model->record_count($filter);
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->Golongan_model->fetch_record($config["per_page"], $page, $filter);

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'kode_golongan' => $filter["kode_golongan"],
				'nama' 			=> $filter["nama"],
				'results' 		=> $data["results"],
				'pagination' 	=> $this->pagination->create_links()
			));
		};
	}
	
	public function golongan_save(){
		$data = array( 	'kode_golongan'	=> $this->input->post('kode_golongan'),
						'nama'			=> $this->input->post('nama'),
						'keterangan'	=> $this->input->post('keterangan'));
		
		if($this->input->post('id_golongan')!=""){
			$data['id_golongan'] = $this->input->post('id_golongan');
			$this->Golongan_model->update($data);
		}else{
			$data['crby'] = $this->session->userdata('id_user');
			$this->Golongan_model->insert($data);
		};
		echo "1";
	}
	
	public function golongan_get_data($id){
		$data = $this->Golongan_model->get_data($id);
	
		echo json_encode(array(
			'id_golongan' 	=> $data->id_golongan,
			'kode_golongan'	=> $data->kode_golongan,
			'nama'			=> $data->nama,
			'keterangan'	=> $data->keterangan
		));
	}
	
	public function golongan_delete(){
		$data = array('id_golongan'	=> $this->input->post('id_golongan'));
		$this->Golongan_model->delete($data);
		echo "1";
	}
	
	public function golongan_multi_delete(){
		$arrId = explode(",", $this->input->post('arrId'));
		$this->Golongan_model->multiple_delete($arrId);
		echo "1";
	}
	
	public function template(){
		$data = array(
			'title' => 'Admin | Master Data -> Template',
			'menu_active' => M_MASTER_DATA,
			'submenu_active' => M_MASTER_DATA_TEMPLATE
		);
		$this->view('admin/master_data/template',$data);
	}
	
	public function template_table_index(){
		$data = array( 	'kode_template'	=> $this->input->get('kode_template'));
		$this->load->view('admin/master_data/template/template_table',$data);
	}
	
	public function template_table(){
		$filter = array( 'kode_template'	=> $this->input->post('kode_template'));
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "admin/master_data/template_table/";
		$config["total_rows"] = $this->Template_model->record_count($filter);
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->Template_model->fetch_record($config["per_page"], $page, $filter);

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'kode_template' => $filter["kode_template"],
				'results' => $data["results"],
				'pagination' => $this->pagination->create_links()
			));
		};
	}
	
	public function template_save(){
		$data = array( 	'kode_template'		=> $this->input->post('kode_template'),
						'keterangan'		=> $this->input->post('keterangan'));
		
		if($this->input->post('id_template')!=""){
			$data['id_template'] = $this->input->post('id_template');
			$this->Template_model->update($data);
		}else{
			$data['crby'] = $this->session->userdata('id_user');
			$this->Template_model->insert($data);
		};
		echo "1";
	}
	
	public function template_get_data($id){
		$data = $this->Template_model->get_data($id);
	
		echo json_encode(array(
			'id_template' 	=> $data->id_template,
			'kode_template'	=> $data->kode_template,
			'keterangan'	=> $data->keterangan
		));
	}
	
	public function template_delete(){
		$data = array('id_template'	=> $this->input->post('id_template'));
		$this->Template_model->delete($data);
		echo "1";
	}
	
	public function template_multi_delete(){
		$arrId = explode(",", $this->input->post('arrId'));
		$this->Template_model->multiple_delete($arrId);
		echo "1";
	}
	
	public function fingerprint(){
		$data = array(
			'title' => 'Admin | Master Data -> Fingerprint',
			'menu_active' => M_MASTER_DATA,
			'submenu_active' => M_MASTER_DATA_FINGERPRINT
		);
		$this->view('admin/master_data/fingerprint',$data);
	}
	
	public function fingerprint_table_index(){
		$data = array('nama'	=> $this->input->get('nama'));
		$this->load->view('admin/master_data/template/fingerprint_table',$data);
	}
	
	public function fingerprint_table(){
		$filter = array('nama'	=> $this->input->post('nama'));
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "admin/master_data/fingerprint_table/";
		$config["total_rows"] = $this->Fingerprint_model->record_count($filter);
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->Fingerprint_model->fetch_record($config["per_page"], $page, $filter);

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'nama' => $filter["nama"],
				'results' => $data["results"],
				'pagination' => $this->pagination->create_links()
			));
		};
	}
	
	public function fingerprint_save(){
		$data = array(	'nama'			=> $this->input->post('nama'),
						'ip_address'	=> $this->input->post('ip_address'),
						'pass'			=> $this->input->post('pass'));
		if($this->input->post('id_fingerprint')!=""){
			$data['id_fingerprint'] = $this->input->post('id_fingerprint');
			$this->Fingerprint_model->update($data);
		}else{
			$data['crby'] = $this->session->userdata('id_user');
			$this->Fingerprint_model->insert($data);
		};
		echo "1";
	}
	
	public function fingerprint_get_data($id){
		$data = $this->Fingerprint_model->get_data_fp($id);
	
		echo json_encode(array(
			'id_fingerprint' => $data->id_fingerprint,
			'nama' => $data->nama,
			'ip_address' => $data->ip_address,
			'pass' => $data->pass
		));
	}
	
	public function fingerprint_delete(){
		$data = array('id_fingerprint'	=> $this->input->post('id_fingerprint'));
		$this->Fingerprint_model->delete($data);
		echo "1";
	}
	
	public function fingerprint_multi_delete(){
		$arrId = explode(",", $this->input->post('arrId'));
		$this->Fingerprint_model->multiple_delete($arrId);
		echo "1";
	}
	
	public function paid_card(){
		$data = array(
			'title' => 'Admin | Master Data -> Paid Card',
			'menu_active' => M_MASTER_DATA,
			'submenu_active' => M_MASTER_DATA_PAID_CARD
		);
		$this->view('admin/master_data/paid_card',$data);
	}
	
	public function paid_card_table_index(){
		$data = array( 	'kode_paid_card'=> $this->input->get('kode_paid_card'),
						'nama'			=> $this->input->get('nama'));
		$this->load->view('admin/master_data/template/paid_card_table',$data);
	}
	
	public function paid_card_table(){
		$filter = array('kode_paid_card'=> $this->input->post('kode_paid_card'),
						'nama'			=> $this->input->post('nama'));
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "admin/master_data/paid_card_table/";
		$config["total_rows"] = $this->Paid_card_model->record_count($filter);
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->Paid_card_model->fetch_record($config["per_page"], $page, $filter);

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'kode_paid_card'=> $filter['kode_paid_card'],
				'nama'			=> $filter['nama'],
				'results' 		=> $data["results"],
				'pagination' 	=> $this->pagination->create_links()
			));
		};
	}
	
	public function paid_card_save(){
		$data = array( 	'kode_paid_card'=> $this->input->post('kode_paid_card'),
						'nama'			=> $this->input->post('nama'),
						'keterangan'	=> $this->input->post('keterangan'));
		if($this->input->post('id_paid_card')!=""){
			$data['id_paid_card'] = $this->input->post('id_paid_card');
			$this->Paid_card_model->update($data);
		}else{
			$data['crby'] = $this->session->userdata('id_user');
			$this->Paid_card_model->insert($data);
		};
		echo "1";
	}
	
	public function paid_card_get_data($id){
		$data = $this->Paid_card_model->get_data($id);
	
		echo json_encode(array(
			'id_paid_card' 	=> $data->id_paid_card,
			'kode_paid_card'	=> $data->kode_paid_card,
			'nama'			=> $data->nama,
			'keterangan'	=> $data->keterangan
		));
	}
	
	public function paid_card_delete(){
		$data = array('id_paid_card'	=> $this->input->post('id_paid_card'));
		$this->Paid_card_model->delete($data);
		echo "1";
	}
	
	public function paid_card_multi_delete(){
		$arrId = explode(",", $this->input->post('arrId'));
		$this->Paid_card_model->multiple_delete($arrId);
		echo "1";
	}
	
	public function view($php,$data){
		$this->parser->parse('template/site_head', $data);
		$this->parser->parse('template/site_admin_top', $data);
		$this->load->view($php,$data);
		$this->parser->parse('template/site_foot', $data);
	}
	
}