<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_adm1n extends CI_Controller {

	public function index(){
		$this->load->model('user_model', '', TRUE);
		$this->display_form();
	}
	
	public function display_form(){
		$data = array(
            'title' => 'Kings Motor | Admin'
        );
		$this->parser->parse('template/login_head', $data);
		$this->load->view('login_admin');
		$this->parser->parse('template/login_foot', $data);
	}
	
	public function do_login(){
		$this->load->model('user_model', '', TRUE);
		$this->load->model('role_model', '', TRUE);
		/* Set validasi */
		$config = array(
				array(
                     'field'   => 'username',
                     'label'   => 'Username',
                     'rules'   => 'required'
                ),
				array(
                     'field'   => 'pass',
                     'label'   => 'Password',
                     'rules'   => 'required'
                )
            );
		$this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE){
			$users = $this->user_model->check_login($this->input->post('username'),ADMIN);	
			//Jika user ditemukan maka check password
			if ($users->num_rows() > 0){
				foreach($users->result() as $user){
					if( $this->fungsi->decrypt($user->pass) == $this->input->post('pass')){
						//Check apakah user di lock ?
						if( $user->status == 2 ){
							$this->session->set_flashdata('message_err', 'Your account is locked, please contact admin');
							redirect('login_adm1n');	
						}else{
							//Masukkan informasi user kedalam session
							$id_menus = $this->role_model->select_menu_by_id_role("GROUP_CONCAT(m_menu.id_menu) AS id_menus",'1',$user->id_role,M_KASIR,"row")->id_menus;
							$ses_data_user = array(	'login' => TRUE,'id_user' => $user->id_user, 'dispname' => $user->dispname, 'tipe' => $user->tipe, 'id_role' => $user->id_role,
													'id_menus' => $id_menus);
							$this->session->set_userdata($ses_data_user);
							redirect('admin/dashboard');
						}
					}
				}
				redirect('login_adm1n');	
			}else{
				$this->session->set_flashdata('message_err', 'Username or password is wrong, please try again');
				redirect('login_adm1n');
			}
		}else{
			$this->session->set_flashdata('message_err', validation_errors('<p class="field_error">', '</p>'));
			redirect('login_adm1n');
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		$this->session->set_flashdata('message_err', 'Please login to enter system');
		redirect('login_adm1n', 'refresh');
	}
}