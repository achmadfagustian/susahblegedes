<?php
/*
Fungsi : Model untuk User
*/
class User_model extends CI_Model {
	/**
	 * Constructor
	 */
	function User_model(){
		parent::__construct();
	}
	
	/* Insialiasi nama table */
	var $table_main_user	= 'main_user';
	var $table_user			= 'm_user';
	var $table_mekanik		= 'm_mekanik';
	var $vw_mekanik_pit		= 'vw_mekanik_pit';

	function insert_main($dataMain){
		$this->db->insert($this->table_main_user, $dataMain);
		
		$this->db->select("id_main_user");
		$this->db->from($this->table_main_user);
		$this->db->where("nik", $dataMain['nik']);
		$this->db->where("nama", $dataMain['nama']);
		$query = $this->db->get();
		$row = $query->row();
		return $row->id_main_user;
	}
	
	function insert_user($data){
		$data['status'] = 1;
		$this->db->insert($this->table_user, $data);
	}
	
	function insert_mekanik($data){
		$data['status'] = 1;
		$this->db->insert($this->table_mekanik, $data);
	}
	
	function update_main($dataMain){
		$this->db->where('id_main_user',$dataMain['id_main_user']);
		$this->db->update($this->table_main_user, $dataMain);
	}
	
	function update_user($data){
		$this->db->where('id_main_user',$data['id_main_user']);
		$this->db->update($this->table_user, $data);
	}
	
	function update_mekanik($data){
		$this->db->where('id_main_user',$data['id_main_user']);
		$this->db->update($this->table_mekanik, $data);
	}
	
	function select_all_mekanik(){
		$this->db->select(" m_mekanik.dispname,main_user.nik ");
		$this->db->from("m_mekanik");
		$this->db->join("main_user", "m_mekanik.id_main_user = main_user.id_main_user");
		$this->db->where('m_mekanik.status =',1);
		$query = $this->db->get();
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}
	
	function fetch_record($limit, $start, $filter, $tipe){
		$this->db->select(" m_user.id_main_user,main_user.nik,main_user.nama,m_user.status,m_role.role_nama");
		$this->db->where('m_user.status >',0);
		$this->db->where("m_role.tipe", $tipe);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}
	
	function fetch_record_mekanik($limit, $start, $filter){
		$this->db->select(" m_mekanik.id_main_user,main_user.nik,main_user.nama,m_mekanik.dispname,m_mekanik.keahlian,m_mekanik.status");
		$this->db->join("main_user", "main_user.id_main_user = m_mekanik.id_main_user");
		$this->db->where('m_mekanik.status >',0);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

	function record_count($filter,$tipe){
		$this->db->from("m_user");
		$this->db->join("m_role", "m_role.id_role = m_user.id_role");
		$this->db->join("main_user", "main_user.id_main_user = m_user.id_main_user");
		$this->db->where("m_role.tipe", $tipe);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		return $this->db->count_all();
	}
	
	function record_count_mekanik($filter){
		$this->db->from("m_mekanik");
		$this->db->where('m_mekanik.status >',0);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		return $this->db->count_all();
	}
	
	function get_data($id){
		$this->db->select(" m_user.id_user,m_user.username,m_user.dispname,m_user.email,m_user.status,m_role.id_role ");
		$this->db->from("m_user");
		$this->db->join("m_role", "m_role.id_role = m_user.id_role");
		$this->db->where('m_user.id_main_user', $id);
		$query = $this->db->get();
		return $query->row();
	}
	
	function get_data_mekanik($id){
		$this->db->select(" m_mekanik.id_main_user,m_mekanik.dispname,m_mekanik.kota,m_mekanik.keahlian,m_mekanik.keterangan ");
		$this->db->from("m_mekanik");
		$this->db->where('m_mekanik.id_main_user', $id);
		$query = $this->db->get();
		return $query->row();
	}
	
	function get_data_main($id){
		$this->db->from($this->table_main_user);
		$this->db->where('id_main_user', $id);
		$query = $this->db->get();
		return $query->row();
	}
	
	function delete_user($id,$tipe){
		$data['status'] = 0;
		$this->db->where('id_main_user',$data['id_main_user']);
		$this->db->update($this->table_user, $data);
	}
	
	function multiple_delete_user($arrId,$tipe){
		$data['status'] = 0;
		$this->db->where_in('id_main_user',$arrId);
		$this->db->update($this->table_user, $data);
	}
	
	function delete_mekanik($id){
		$data['status'] = 0;
		$this->db->where('id_main_user',$data['id_main_user']);
		$this->db->update($this->table_mekanik, $data);
	}
	
	function multiple_delete_mekanik($arrId){
		$data['status'] = 0;
		$this->db->where_in('id_main_user',$arrId);
		$this->db->update($this->table_mekanik, $data);
	}

	function check_login($username,$type){
		$this->db->select("m_user.id_user,m_user.username,m_user.pass,m_user.dispname,m_user.status,m_user.id_role,m_role.tipe");
		$this->db->from("m_user");
		$this->db->join("m_role", "m_role.id_role = m_user.id_role");
		$this->db->where("m_user.username", $username);
		$this->db->where("m_user.status", 1);
		$this->db->where("m_role.tipe", $type);
		$users = $this->db->get();
		return $users;
	}
	
	function select_mekanik_pit($id_perusahaan){
		$this->db->select("*");
		$this->db->from($this->vw_mekanik_pit);
		$this->db->where('id_perusahaan = ',$id_perusahaan);
		$this->db->order_by('pit_no','ASC');
		$data = $this->db->get();
		return $data->result();
	}
}