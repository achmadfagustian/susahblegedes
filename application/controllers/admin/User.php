<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->fungsi->check_login(ADMIN);
		$this->load->model('User_model', '', TRUE);
		$this->load->model('Role_model', '', TRUE);
    }
	
	public function index(){
		$data = array(
			'title' => 'Admin | User',
			'menu_active' => M_USER,
			'submenu_active' => ''
		);
		$this->view('admin/user/dashboard',$data);
	}
	
	/*---------------
	|	ADMIN
	----------------*/
	public function admin(){
		$data = array(
			'title' => 'Admin | User -> Admin',
			'menu_active' => M_USER,
			'submenu_active' => M_USER_ADMIN
		);
		$role = $this->Role_model->get_data(ADMIN)->result();
		$data['role'] = '<option value="">-- Pilih --</option>';
		foreach($role as $row){
			$data['role'] .= '<option value='.$row->id_role.'>'.$row->role_nama.'</option>';
		}
		$this->view('admin/user/admin',$data);
	}
	
	public function admin_table_index(){
		$data = array(	'id_role'		=> $this->input->get('id_role'),
						'username'		=> $this->input->get('username'),
						'dispname'		=> $this->input->get('dispname'),
						'email'			=> $this->input->get('email'),
						'nik'			=> $this->input->get('nik'),
						'nama'			=> $this->input->get('nama'));
		$this->load->view('admin/user/template/admin_table',$data);
	}
	
	public function admin_table(){
		$filter = array('m_role.id_role'		=> $this->input->post('id_role'),
						'm_user.username'		=> $this->input->post('username'),
						'm_user.dispname'		=> $this->input->post('dispname'),
						'm_user.email'			=> $this->input->post('email'),
						'main_user.nik'			=> $this->input->post('nik'),
						'main_user.nama'		=> $this->input->post('nama'));
						
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "admin/user/admin_table/";
		$config["total_rows"] = $this->User_model->record_count($filter,ADMIN);
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->User_model->fetch_record($config["per_page"], $page,$filter,ADMIN);

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'id_role'		=> $this->input->post('id_role'),
				'username'		=> $this->input->post('username'),
				'dispname'		=> $this->input->post('dispname'),
				'email'			=> $this->input->post('email'),
				'nik'			=> $this->input->post('nik'),
				'nama'			=> $this->input->post('nama'),
				'results' 		=> $data["results"],
				'pagination' 	=> $this->pagination->create_links()
			));
		};
	}
	
	public function admin_save(){
		$data = array(	'id_role'		=> $this->input->post('id_role'),
						'username'		=> $this->input->post('username'),
						'dispname'		=> $this->input->post('dispname'),
						'email'			=> $this->input->post('email'));
		$dataMain = array('nik'			=> $this->input->post('nik'),
						'nama'			=> $this->input->post('nama'),
						'jenis_kelamin'	=> $this->input->post('jenis_kelamin'),
						'alamat'		=> $this->input->post('alamat'),
						'no_telp'		=> $this->input->post('no_telp'));
		
		if($this->input->post('pass')!=""){
			$data['pass'] = $this->fungsi->encrypt($this->input->post('pass'));
		}
		if($this->input->post('id_main_user')!=""){
			$dataMain['id_main_user'] = $this->input->post('id_main_user');
			$this->User_model->update_main($dataMain);
			$data['id_main_user'] = $dataMain['id_main_user'];
			$this->User_model->update_user($data);
		}else{
			$dataMain['crby'] = $this->session->userdata('id_user');
			$data['id_main_user'] = $this->User_model->insert_main($dataMain);
			$this->User_model->insert_user($data);
		};
		echo "1";
	}
	
	public function admin_get_data($id){
		$dataMain = $this->User_model->get_data_main($id);
		$data = $this->User_model->get_data($dataMain->id_main_user);
	
		echo json_encode(array(
			'id_main_user' => $dataMain->id_main_user,
			'username' => $data->username,
			'dispname' => $data->dispname,
			'email' => $data->email,
			'id_role' => $data->id_role,
			'nik' => $dataMain->nik,
			'nama' => $dataMain->nama,
			'jenis_kelamin' => $dataMain->jenis_kelamin,
			'alamat' => $dataMain->alamat,
			'no_telp' => $dataMain->no_telp
		));
	}
	
	public function admin_delete(){
		$data = array('id_main_user'	=> $this->input->post('id_main_user'));
		$this->User_model->delete_user($data);
		echo "1";
	}
	
	public function admin_multi_delete(){
		$arrId = explode(",", $this->input->post('arrId'));
		$this->User_model->multiple_delete_user($arrId);
		echo "1";
	}
	
	/*---------------
	|	KASIR
	----------------*/
	public function kasir(){
		$data = array(
			'title' => 'Admin | User -> Kasir',
			'menu_active' => M_USER,
			'submenu_active' => M_USER_KASIR
		);
		$role = $this->Role_model->get_data(KASIR)->result();
		$data['role'] = '<option value="">-- Pilih --</option>';
		foreach($role as $row){
			$data['role'] .= '<option value='.$row->id_role.'>'.$row->role_nama.'</option>';
		}
		$this->view('admin/user/kasir',$data);
	}
	
	public function kasir_table_index(){
		$data = array(	'id_role'		=> $this->input->get('id_role'),
						'username'		=> $this->input->get('username'),
						'dispname'		=> $this->input->get('dispname'),
						'email'			=> $this->input->get('email'),
						'nik'			=> $this->input->get('nik'),
						'nama'			=> $this->input->get('nama'));
		$this->load->view('admin/user/template/kasir_table',$data);
	}
	
	public function kasir_table(){
		$filter = array('m_role.id_role'		=> $this->input->post('id_role'),
						'm_user.username'		=> $this->input->post('username'),
						'm_user.dispname'		=> $this->input->post('dispname'),
						'm_user.email'			=> $this->input->post('email'),
						'main_user.nik'			=> $this->input->post('nik'),
						'main_user.nama'		=> $this->input->post('nama'));
		
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "admin/user/kasir_table/";
		$config["total_rows"] = $this->User_model->record_count($filter,KASIR);
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->User_model->fetch_record($config["per_page"], $page,$filter,KASIR);

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'id_role'		=> $this->input->post('id_role'),
				'username'		=> $this->input->post('username'),
				'dispname'		=> $this->input->post('dispname'),
				'email'			=> $this->input->post('email'),
				'nik'			=> $this->input->post('nik'),
				'nama'			=> $this->input->post('nama'),
				'results' => $data["results"],
				'pagination' => $this->pagination->create_links()
			));
		};
	}
	
	public function kasir_save(){
		$data = array(	'id_role'		=> $this->input->post('id_role'),
						'username'		=> $this->input->post('username'),
						'dispname'		=> $this->input->post('dispname'),
						'email'			=> $this->input->post('email'));
		$dataMain = array('nik'		=> $this->input->post('nik'),
						'nama'			=> $this->input->post('nama'),
						'jenis_kelamin'	=> $this->input->post('jenis_kelamin'),
						'alamat'		=> $this->input->post('alamat'),
						'no_telp'		=> $this->input->post('no_telp'));
		
		if($this->input->post('pass')!=""){
			$data['pass'] = $this->fungsi->encrypt($this->input->post('pass'));
		}
		if($this->input->post('id_main_user')!=""){
			$dataMain['id_main_user'] = $this->input->post('id_main_user');
			$this->User_model->update_main($dataMain);
			$data['id_main_user'] = $dataMain['id_main_user'];
			$this->User_model->update_user($data);
		}else{
			$dataMain['crby'] = $this->session->userdata('id_user');
			$data['id_main_user'] = $this->User_model->insert_main($dataMain);
			$this->User_model->insert_user($data);
		};
		echo "1";
	}
	
	public function kasir_get_data($id){
		$dataMain = $this->User_model->get_data_main($id);
		$data = $this->User_model->get_data($dataMain->id_main_user);
	
		echo json_encode(array(
			'id_main_user' => $dataMain->id_main_user,
			'username' => $data->username,
			'dispname' => $data->dispname,
			'email' => $data->email,
			'id_role' => $data->id_role,
			'nik' => $dataMain->nik,
			'nama' => $dataMain->nama,
			'jenis_kelamin' => $dataMain->jenis_kelamin,
			'alamat' => $dataMain->alamat,
			'no_telp' => $dataMain->no_telp
		));
	}
	
	public function kasir_delete(){
		$data = array('id_main_user'	=> $this->input->post('id_main_user'));
		$this->User_model->delete_user($data);
		echo "1";
	}
	
	public function kasir_multi_delete(){
		$arrId = explode(",", $this->input->post('arrId'));
		$this->User_model->multiple_delete_user($arrId);
		echo "1";
	}
	
	/*---------------
	|	MEKANIK
	----------------*/
	public function mekanik(){
		$data = array(
			'title' => 'Admin | User -> Mekanik',
			'menu_active' => M_USER,
			'submenu_active' => M_USER_MEKANIK
		);
		$data['keahlian'] = '<option value="">-- Pilih --</option>
							<option value="1">Tidak Digolongkan</option>
							<option value="2">Pemula</option>
							<option value="3">Menengah</option>
							<option value="4">Mahir</option>';
		$this->view('admin/user/mekanik',$data);
	}
	
	public function mekanik_table_index(){
		$data = array(	'nik'		=> $this->input->get('nik'),
						'nama'		=> $this->input->get('nama'),
						'dispname'	=> $this->input->get('dispname'),
						'kota'		=> $this->input->get('kota'),
						'no_telp'	=> $this->input->get('no_telp'),
						'keahlian'	=> $this->input->get('keahlian'));
		$this->load->view('admin/user/template/mekanik_table',$data);
	}
	
	public function mekanik_table(){
		$filter = array('main_user.nik'		=> $this->input->post('nik'),
						'main_user.nama'	=> $this->input->post('nama'),
						'm_mekanik.dispname'=> $this->input->post('dispname'),
						'm_mekanik.kota'	=> $this->input->post('kota'),
						'main_user.no_telp'	=> $this->input->post('no_telp'),
						'm_mekanik.keahlian'=> $this->input->post('keahlian'));
		
		$config = $this->fungsi->common_pagination();
		$config["base_url"] = base_url() . "admin/user/mekanik_table/";
		$config["total_rows"] = $this->User_model->record_count_mekanik($filter);
		$config["per_page"] = $this->config->item('paging_limit');

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] = $page;

		$data["results"] = $this->User_model->fetch_record_mekanik($config["per_page"], $page,$filter);

		if($this->input->post('ajax', FALSE)){
			echo json_encode(array(
				'nik'		=> $this->input->post('nik'),
				'nama'		=> $this->input->post('nama'),
				'dispname'	=> $this->input->post('dispname'),
				'kota'		=> $this->input->post('kota'),
				'no_telp'	=> $this->input->post('no_telp'),
				'keahlian'	=> $this->input->post('keahlian'),
				'results' 	=> $data["results"],
				'pagination'=> $this->pagination->create_links()
			));
		};
	}
	
	public function mekanik_save(){
		$data = array(	'dispname'		=> $this->input->post('dispname'),
						'kota'			=> $this->input->post('kota'),
						'keahlian'		=> $this->input->post('keahlian'),
						'keterangan'	=> $this->input->post('keterangan'));
		$dataMain = array('nik'			=> $this->input->post('nik'),
						'nama'			=> $this->input->post('nama'),
						'alamat'		=> $this->input->post('alamat'),
						'no_telp'		=> $this->input->post('no_telp'));
		
		if($this->input->post('pass')!=""){
			$data['pass'] = $this->fungsi->encrypt($this->input->post('pass'));
		}
		if($this->input->post('id_main_user')!=""){
			$dataMain['id_main_user'] = $this->input->post('id_main_user');
			$this->User_model->update_main($dataMain);
			$data['id_main_user'] = $this->input->post('id_main_user');
			$this->User_model->update_mekanik($data);
		}else{
			$dataMain['crby'] = $this->session->userdata('id_user');
			$data['id_main_user'] = $this->User_model->insert_main($dataMain);
			$this->User_model->insert_mekanik($data);
		};
		echo "1";
	}
	
	public function mekanik_get_data($id){
		$dataMain = $this->User_model->get_data_main($id);
		$data = $this->User_model->get_data_mekanik($dataMain->id_main_user);
	
		echo json_encode(array(
			'id_main_user' => $data->id_main_user,
			'nik' => $dataMain->nik,
			'nama' => $dataMain->nama,
			'dispname' => $data->dispname,
			'alamat' => $dataMain->alamat,
			'kota' => $data->kota,
			'no_telp' => $dataMain->no_telp,
			'keahlian' => $data->keahlian,
			'keterangan' => $data->keterangan
		));
	}
	
	public function mekanik_delete(){
		$data = array('id_main_user'	=> $this->input->post('id_main_user'));
		$this->User_model->delete_mekanik($data);
		echo "1";
	}
	
	public function mekanik_multi_delete(){
		$arrId = explode(",", $this->input->post('arrId'));
		$this->User_model->multiple_delete_mekanik($arrId);
		echo "1";
	}
	
	public function view($php,$data){
		$this->parser->parse('template/site_head', $data);
		$this->parser->parse('template/site_admin_top', $data);
		$this->load->view($php,$data);
		$this->parser->parse('template/site_foot', $data);
	}
}