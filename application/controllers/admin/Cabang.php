<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabang extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->fungsi->check_login(ADMIN);
		$this->load->model('Perusahaan_model', '', TRUE);
    }
	
	public function index(){
		$this->load->model('User_model', '', TRUE);
		$data = array(
			'title' => 'Admin | Cabang',
			'menu_active' => M_CABANG
		);
		$data['mekanik'] = $this->User_model->select_all_mekanik();
		$this->view('admin/cabang',$data);
	}
	
	public function cabang_table_index(){
		$data = array( 	'tipe'			=> $this->input->get('tipe'),
						'kode_perusahaan'	=> $this->input->get('kode_perusahaan'),
						'nama'			=> $this->input->get('nama'),
						'alamat'		=> $this->input->get('alamat'),
						'kota'			=> $this->input->get('kota'),
						'kodepos'		=> $this->input->get('kodepos'),
						'no_telp'		=> $this->input->get('no_telp'),
						'no_fax'		=> $this->input->get('no_fax'));
		$this->load->view('admin/template/cabang_table',$data);
	}
	
	public function cabang_table(){
		$filter = array('tipe'			=> $this->input->post('tipe'),
						'kode_perusahaan'	=> $this->input->post('kode_perusahaan'),
						'nama'			=> $this->input->post('nama'),
						'alamat'		=> $this->input->post('alamat'),
						'kota'			=> $this->input->post('kota'),
						'kodepos'		=> $this->input->post('kodepos'),
						'no_telp'		=> $this->input->post('no_telp'),
						'no_fax'		=> $this->input->post('no_fax'));
		
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "admin/cabang/cabang_table/";
		$config["total_rows"] = $this->Perusahaan_model->record_count($filter,array(PUSAT,CABANG));
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->Perusahaan_model->fetch_record($config["per_page"], $page,$filter,array(PUSAT,CABANG));

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'tipe' => $filter['tipe'],
				'kode_perusahaan' => $filter['kode_perusahaan'],
				'nama' => $filter['nama'],
				'alamat' => $filter['alamat'],
				'kota' => $filter['kota'],
				'kodepos' => $filter['kodepos'],
				'no_telp' => $filter['no_telp'],
				'no_fax' => $filter['no_fax'],
				'results' => $data["results"],
				'pagination' => $this->pagination->create_links()
			));
		};
	}
	
	public function cabang_save(){
		$data = array( 	'tipe'			=> $this->input->post('tipe'),
						'kode_perusahaan'	=> $this->input->post('kode_perusahaan'),
						'nama'			=> $this->input->post('nama'),
						'alamat'		=> $this->input->post('alamat'),
						'kota'			=> $this->input->post('kota'),
						'kodepos'		=> $this->input->post('kodepos'),
						'no_telp'		=> $this->input->post('no_telp'),
						'no_fax'		=> $this->input->post('no_fax'));
		if($this->input->post('id_perusahaan')!=""){
			$data['id_perusahaan'] = $this->input->post('id_perusahaan');
			$this->Perusahaan_model->update($data);
			
			$this->Perusahaan_model->delete_all_mekanik($data);
			$pit_no = $this->input->post('pit_no');
			$nik = $this->input->post('nik');
			$total_mekanik = $this->input->post('total_mekanik');
			for($i=0;$i<$total_mekanik;$i++){
				if($pit_no[$i]!=""){
					$dataSave['id_perusahaan'] = $data['id_perusahaan'];
					$dataSave['pit_no'] = $pit_no[$i];
					$dataSave['nik_mekanik'] = $nik[$i];
					$this->Perusahaan_model->insert_perusahaan_mekanik($dataSave);
				}
			}
		}else{
			$data['crby'] = $this->session->userdata('id_user');
			$this->Perusahaan_model->insert($data);
		};
		echo "1";
	}
	
	public function cabang_get_data($id){
		$data = $this->Perusahaan_model->get_data($id,array(PUSAT,CABANG));
		$perusahaan_mekanik = $this->Perusahaan_model->select_all_mekanik($data->id_perusahaan);
		echo json_encode(array(
			'id_perusahaan' => $data->id_perusahaan,
			'tipe' => $data->tipe,
			'kode_perusahaan' => $data->kode_perusahaan,
			'nama' => $data->nama,
			'alamat' => $data->alamat,
			'kota' => $data->kota,
			'kodepos' => $data->kodepos,
			'no_telp' => $data->no_telp,
			'no_fax' => $data->no_fax,
			'perusahaan_mekanik' => $perusahaan_mekanik
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
	
	public function view($php,$data){
		$this->parser->parse('template/site_head', $data);
		$this->parser->parse('template/site_admin_top', $data);
		$this->load->view($php,$data);
		$this->parser->parse('template/site_foot', $data);
	}
}