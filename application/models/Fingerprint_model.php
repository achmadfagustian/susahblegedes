<?php
/*
Fungsi : Model untuk Fingerprint
*/
class Fingerprint_model extends CI_Model {
	
	function Fingerprint_model(){
		parent::__construct();
	}
	
	/* Insialiasi nama table */
	var $table_fp		= 'm_fingerprint';

	function insert($data){
		$data['status'] = 1;
		$this->db->insert($this->table_fp, $data);
	}
	
	function update($data){
		$this->db->where('id_fingerprint',$data['id_fingerprint']);
		$this->db->update($this->table_fp, $data);
	}
	
	function delete($data){
		$data['status'] = 0;
		$this->db->where('id_fingerprint',$data['id_fingerprint']);
		$this->db->update($this->table_fp, $data);
	}
	
	function multiple_delete($arrId){
		$data['status'] = 0;
		$this->db->where_in('id_fingerprint',$arrId);
		$this->db->update($this->table_fp, $data);
	}
	
	function fetch_record($limit, $start, $filter){
		$this->db->limit($limit, $start);
		$this->db->where('status >',0);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$query = $this->db->get($this->table_fp);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

	function record_count($filter){
		$this->db->where('status >',0);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$this->db->from($this->table_fp);
		return $this->db->count_all_results();
	}
	
	function get_data_fp($id){
		$this->db->where('id_fingerprint', $id);
		$this->db->where('status >',0);
		$query = $this->db->get($this->table_fp);
		return $query->row();
	}
		
  /* Get paging */
  function get_fp_paging($limit, $offset, $search)
	{	
		if(!empty($search)) {
  		$this->db->like('id',$search);
		
		}
		$this->db->order_by('id','ASC');
		$this->db->limit($limit, $offset);
  		return $this->db->get($this->table_fp);
	}

	/* Get total rows */
	function count_rows_fp($search)
	{	
		if(!empty($search)) {
  		$this->db->like('id',$search);
		
		}
		return $this->db->count_all_results($this->table_fp);
	}
	
	/* Delete */
	function del_fp($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table_fp);
		
	}
	
	/* Get by ko */
	function get_fp($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table_fp);
	}
	
	/* Get all class */
	function get_fp_all()
	{
		$this->db->order_by('id','ASC');
		return $this->db->get($this->table_fp);
		
	}
	
	function get_id()
	{
		$this->db->select_max('right(id,3) + 1','MaxID');
		return $this->db->get($this->table_fp)	;
	}
	
	function GetData_fp($id)
	{
		//$this->db->join('biaya','kursus.kdkursus = biaya.kdkursus');
		//$this->db->where('biaya.biaya',0);
		if(!empty($id)){
			$this->db->where('id',$id);
		}
		$this->db->order_by('id','ASC');
		return $this->db->get($this->table_fp);	
	}
}