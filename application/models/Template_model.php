<?php
/*
Fungsi : Model untuk Template
*/
class Template_model extends CI_Model {
	
	function Template_model(){
		parent::__construct();
	}
	
	/* Insialiasi nama table */
	var $table_template		= 'm_template';

	function insert($data){
		$data['status'] = 1;
		$this->db->insert($this->table_template, $data);
	}
	
	function update($data){
		$this->db->where('id_template',$data['id_template']);
		$this->db->update($this->table_template, $data);
	}
	
	function delete($id){
		$data['status'] = 0;
		$this->db->where('id_template',$data['id_template']);
		$this->db->update($this->table_template, $data);
	}
	
	function multiple_delete($arrId){
		$data['status'] = 0;
		$this->db->where_in('id_template',$arrId);
		$this->db->update($this->table_template, $data);
	}


	function fetch_record($limit, $start, $filter){
		$this->db->select("id_template,kode_template,status");
		$this->db->limit($limit, $start);
		$this->db->where('status >',0);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$query = $this->db->get($this->table_template);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

	function record_count($filter){
		$this->db->where('status >',0);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$this->db->from($this->table_template);
		return $this->db->count_all_results();
	}
	
	function get_data($id){
		$this->db->where('id_template', $id);
		$this->db->where('status >',0);
		$query = $this->db->get($this->table_template);
		return $query->row();
	}
	
	function select_all(){
		$this->db->select("id_template,kode_template,keterangan");
		$this->db->where('status =',1);
		$query = $this->db->get($this->table_template);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}
}