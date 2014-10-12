<?php
/*
Fungsi : Model untuk Paid Card
*/
class Paid_card_model extends CI_Model {

	function Paid_card_model(){
		parent::__construct();
	}
	
	/* Insialiasi nama table */
	var $table_paid_card		= 'm_paid_card';
	
	function insert($data){
		$data['status'] = 1;
		$this->db->insert($this->table_paid_card, $data);
	}
	
	function update($data){
		$this->db->where('id_paid_card',$data['id_paid_card']);
		$this->db->update($this->table_paid_card, $data);
	}
	
	function delete($data){
		$data['status'] = 0;
		$this->db->where('id_paid_card',$data['id_paid_card']);
		$this->db->update($this->table_paid_card, $data);
	}
	
	function multiple_delete($arrId){
		$data['status'] = 0;
		$this->db->where_in('id_paid_card',$arrId);
		$this->db->update($this->table_paid_card, $data);
	}

	function fetch_record($limit, $start, $filter){
		$this->db->limit($limit, $start);
		$this->db->where('status >',0);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$query = $this->db->get($this->table_paid_card);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

	function record_count($filter){
		$this->db->where('status >',0);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$this->db->from($this->table_paid_card);
		return $this->db->count_all_results();
	}
	
	function get_data($id){
		$this->db->where('id_paid_card', $id);
		$this->db->where('status >',0);
		$query = $this->db->get($this->table_paid_card);
		return $query->row();
	}
}