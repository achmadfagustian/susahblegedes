<?php
/*
Fungsi : Model untuk Supplier
*/
class Supplier_model extends CI_Model {
	
	function Supplier_model(){
		parent::__construct();
	}
	
	/* Insialiasi nama table */
	var $table_supplier		= 'm_supplier';

	function insert($data){
		$data['status'] = 1;
		$this->db->insert($this->table_supplier, $data);
	}
	
	function update($data){
		$this->db->where('id_supplier',$data['id_supplier']);
		$this->db->update($this->table_supplier, $data);
	}
	
	function delete($id){
		$data['status'] = 1;
		$this->db->where('id_supplier',$data['id_supplier']);
		$this->db->update($this->table_supplier, $data);
	}

	function multiple_delete($arrId){
		$data['status'] = 0;
		$this->db->where_in('id_supplier',$arrId);
		$this->db->update($this->table_supplier, $data);
	}
	
	function fetch_record($limit, $start, $filter){
		$this->db->select("id_supplier,kode_supplier,nama,kota,status");
		$this->db->limit($limit, $start);
		$this->db->where('status >',0);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$query = $this->db->get($this->table_supplier);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

	function record_count($filter){
		$this->db->where('status >',0);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$this->db->from($this->table_supplier);
		return $this->db->count_all_results();
	}
	
	function get_data($id){
		$this->db->where('id_supplier', $id);
		$this->db->where('status >',0);
		$query = $this->db->get($this->table_supplier);
		return $query->row();
	}
	
	function select_all(){
		$this->db->where('status =',1);
		$query = $this->db->get($this->table_supplier);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}
}