<?php
/*
Fungsi : Model untuk Satuan
*/
class Satuan_model extends CI_Model {

	function Satuan_model(){
		parent::__construct();
	}
	
	/* Insialiasi nama table */
	var $table_satuan		= 'm_satuan';
	
	function insert($data){
		$data['status'] = 1;
		$this->db->insert($this->table_satuan, $data);
	}
	
	function update($data){
		$this->db->where('id_satuan',$data['id_satuan']);
		$this->db->update($this->table_satuan, $data);
	}
	
	function delete($data){
		$data['status'] = 0;
		$this->db->where('id_satuan',$data['id_satuan']);
		$this->db->update($this->table_satuan, $data);
	}
	
	function multiple_delete($arrId){
		$data['status'] = 0;
		$this->db->where_in('id_satuan',$arrId);
		$this->db->update($this->table_satuan, $data);
	}

	function fetch_record($limit, $start, $filter){
		$this->db->limit($limit, $start);
		$this->db->where('status >',0);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$query = $this->db->get($this->table_satuan);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

	function record_count($filter){
		$this->db->where('status >',0);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$this->db->from($this->table_satuan);
		return $this->db->count_all_results();
	}
	
	function get_data($id){
		$this->db->where('id_satuan', $id);
		$this->db->where('status >',0);
		$query = $this->db->get($this->table_satuan);
		return $query->row();
	}
	
	function select_all(){
		$this->db->where('status =',1);
		$query = $this->db->get($this->table_satuan);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}
}