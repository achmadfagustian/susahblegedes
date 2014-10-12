<?php
/*
Fungsi : Model untuk Golongan
*/
class Golongan_model extends CI_Model {
	
	function Golongan_model(){
		parent::__construct();
	}
	
	/* Insialiasi nama table */
	var $table_golongan		= 'm_golongan';

	function insert($data){
		$data['status'] = 1;
		$this->db->insert($this->table_golongan, $data);
	}
	
	function update($data){
		$this->db->where('id_golongan',$data['id_golongan']);
		$this->db->update($this->table_golongan, $data);
	}
	
	function delete($id){
		$data['status'] = 0;
		$this->db->where('id_golongan',$data['id_golongan']);
		$this->db->update($this->table_golongan, $data);
	}
	
	function multiple_delete($arrId){
		$data['status'] = 0;
		$this->db->where_in('id_golongan',$arrId);
		$this->db->update($this->table_golongan, $data);
	}

	function fetch_record($limit, $start, $filter){
		$this->db->select("id_golongan,kode_golongan,nama,status");
		$this->db->limit($limit, $start);
		$this->db->where('status >',0);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$query = $this->db->get($this->table_golongan);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

	function record_count($filter){
		$this->db->where('status >',0);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$this->db->from($this->table_golongan);
		return $this->db->count_all_results();
	}
	
	function get_data($id){
		$this->db->where('id_golongan', $id);
		$this->db->where('status >',0);
		$query = $this->db->get($this->table_golongan);
		return $query->row();
	}
	
	function select_all(){
		$this->db->where('status =',1);
		$query = $this->db->get($this->table_golongan);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}
}