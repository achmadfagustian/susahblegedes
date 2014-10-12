<?php
/*
Fungsi : Model untuk Lokasi Barang
*/
class Lokasi_model extends CI_Model {

	function Lokasi_model(){
		parent::__construct();
	}
	
	/* Insialiasi nama table */
	var $table_lokasi		= 'm_lokasi';
	
	function insert($data){
		$data['status'] = 1;
		$this->db->insert($this->table_lokasi, $data);
	}
	
	function update($data){
		$this->db->where('id_lokasi',$data['id_lokasi']);
		$this->db->update($this->table_lokasi, $data);
	}
	
	function delete($data){
		$data['status'] = 0;
		$this->db->where('id_lokasi',$data['id_lokasi']);
		$this->db->update($this->table_lokasi, $data);
	}
	
	function multiple_delete($arrId,$tipe){
		$data['status'] = 0;
		$this->db->where_in('id_lokasi',$arrId);
		$this->db->update($this->table_lokasi, $data);
	}

	function fetch_record($limit, $start, $filter){
		$this->db->limit($limit, $start);
		$this->db->where('status >',0);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$query = $this->db->get($this->table_lokasi);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

	function record_count($filter){
		$this->db->where('status >',0);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$this->db->from($this->table_lokasi);
		return $this->db->count_all_results();
	}
	
	function get_data($id){
		$this->db->where('id_lokasi', $id);
		$this->db->where('status >',0);
		$query = $this->db->get($this->table_lokasi);
		return $query->row();
	}
	
	function select_all(){
		$this->db->where('status =',1);
		$query = $this->db->get($this->table_lokasi);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}
}