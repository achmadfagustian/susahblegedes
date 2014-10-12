<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index(){
		$this->display_form();
	}
	
	public function display_form(){
		$this->load->model('Perusahaan_model', '', TRUE);
		$data = array(
            'title' => 'Kings Motor | Kasir'
        );
		$office = $this->Perusahaan_model->select_all()->result();
		$data['office'] = '<option value="">-- Pilih --</option>';
		foreach($office as $row){
			$data['office'] .= '<option value='.$row->id_perusahaan.'>'.$row->nama.'</option>';
		}
		$this->parser->parse('template/login_head', $data);
		$this->load->view('login');
		$this->parser->parse('template/login_foot', $data);
	}
	
	public function do_login(){
		$this->load->model('user_model', '', TRUE);
		$this->load->model('role_model', '', TRUE);
		$this->load->model('perusahaan_model', '', TRUE);
		/* Set validasi */
		$config = array(
				array('field'   => 'username', 	'label'   => 'Username', 			'rules'   => 'required'),
				array('field'   => 'pass', 		'label'   => 'Password', 			'rules'   => 'required'),
				array('field'   => 'office',	'label'   => 'Kantor Pusat/Cabang',	'rules'   => 'required')
            );
		$this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE){
			$users = $this->user_model->check_login($this->input->post('username'),2);	
			//Jika user ditemukan maka check password
			if ($users->num_rows() > 0){
				foreach($users->result() as $user){
					if( $this->fungsi->decrypt($user->pass) == $this->input->post('pass')){
						//Check apakah user di lock ?
						if( $user->status == 2 ){
							$this->session->set_flashdata('message_err', 'Your account is locked, please contact admin');
							redirect('login');	
						}else{
							$office = $this->perusahaan_model->get_data($this->input->post('office'),NULL);
							
							//Masukkan informasi user kedalam session
							$id_menus = $this->role_model->select_menu_by_id_role("GROUP_CONCAT(m_menu.id_menu) AS id_menus",'2',$user->id_role,M_KASIR,"row")->id_menus;
							$ses_data_user = array(	'login' => TRUE,'id_user' => $user->id_user, 'dispname' => $user->dispname, 'tipe' => $user->tipe, 'id_role' => $user->id_role,
													'id_menus' => $id_menus, 'office_id' => $office->id_perusahaan, 'officename' => $office->nama);
							$this->session->set_userdata($ses_data_user);
							redirect('kasir/dashboard');
						}
					}
				}
				redirect('login');	
			}else{
				$this->session->set_flashdata('message_err', 'Username or password is wrong, please try again');
				redirect('login');
			}
		}else{
			$this->session->set_flashdata('message_err', validation_errors('<p class="field_error">', '</p>'));
			redirect('login');
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		$this->session->set_flashdata('message_err', 'Please login to enter system');
		redirect('login', 'refresh');
	}
}