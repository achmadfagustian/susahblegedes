<?php
/*
Fungsi : Model untuk Customer
*/
class Role_model extends CI_Model {
	/**
	 * Constructor
	 */
	function Role_model(){
		parent::__construct();
	}
	
	function select_menu_by_id_role($select, $type, $id_role, $parent, $result){
		$this->db->select($select);
		$this->db->from("role_menu");
		$this->db->join("m_menu", "m_menu.id_menu = role_menu.id_menu");
		$this->db->join("m_role", "m_role.id_role = role_menu.id_role");
		$this->db->where("role_menu.id_role", $id_role);
		$this->db->where("m_role.tipe", $type);
		if($parent!=""){
			$this->db->where("m_menu.parent", $parent);
		}
		$this->db->where("m_role.status", 1);
		$this->db->where("m_menu.status", 1);
		$this->db->order_by('m_menu.order','ASC');
		$menus = $this->db->get();
		if($result=="result")
			return $menus->result();
		else if($result=="row")
			return $menus->row();
	}
	
	function get_data($type){
		$this->db->where('tipe', $type);
		return $this->db->get('m_role');
	}
}