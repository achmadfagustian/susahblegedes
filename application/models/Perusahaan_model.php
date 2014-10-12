<?php
/*
Fungsi : Model untuk Perusahaan
*/
class Perusahaan_model extends CI_Model {

	function Perusahaan_model(){
		parent::__construct();
	}
	
	/* Insialiasi nama table */
	var $table_perusahaan		= 'm_perusahaan';
	var $table_perusahaan_mekanik = 'perusahaan_mekanik';
	
	function insert($data){
		$data['status'] = 1;
		$this->db->insert($this->table_perusahaan, $data);
	}
	
	function insert_perusahaan_mekanik($data){
		$this->db->insert($this->table_perusahaan_mekanik, $data);
	}
	
	function update($data){
		$this->db->where('id_perusahaan',$data['id_perusahaan']);
		$this->db->update($this->table_perusahaan, $data);
	}
	
	function delete($data,$tipe){
		$data['status'] = 0;
		$this->db->where('id_perusahaan',$data['id_perusahaan']);
		$this->db->where_in('tipe',$tipe);
		$this->db->update($this->table_perusahaan, $data);
	}
	
	function multiple_delete($arrId,$tipe){
		$data['status'] = 0;
		$this->db->where_in('id_perusahaan',$arrId);
		$this->db->where_in('tipe',$tipe);
		$this->db->update($this->table_perusahaan, $data);
	}

	function fetch_record($limit, $start, $filter, $tipe){
		$this->db->select("id_perusahaan,kode_perusahaan,nama,kota,tipe,status");
		$this->db->limit($limit, $start);
		$this->db->where_in('tipe',$tipe);
		$this->db->where('status >',0);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$query = $this->db->get($this->table_perusahaan);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

	function record_count($filter,$tipe){
		$this->db->where_in('tipe',$tipe);
		$this->db->where('status >',0);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$this->db->from($this->table_perusahaan);
		return $this->db->count_all_results();
	}
	
	function get_data($id,$tipe=NULL){
		$this->db->where('id_perusahaan', $id);
		if($tipe!=NULL){
			$this->db->where_in('tipe',$tipe);
		}
		$this->db->where('status >',0);
		$query = $this->db->get($this->table_perusahaan);
		return $query->row();
	}
	
	function select_all(){
		$this->db->where('tipe >', 0);
		return $this->db->get($this->table_perusahaan);
	}
	
	function select_all_mekanik($id_perusahaan){
		$this->db->where('id_perusahaan', $id_perusahaan);
		$query = $this->db->get($this->table_perusahaan_mekanik);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}
	
	function delete_all_mekanik($data){
		$this->db->delete($this->table_perusahaan_mekanik, array('id_perusahaan' => $data['id_perusahaan'])); 
	}
}