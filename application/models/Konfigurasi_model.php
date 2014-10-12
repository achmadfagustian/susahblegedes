<?php
/*
Fungsi : Model untuk Konfigurasi
*/
class Konfigurasi_model extends CI_Model {
	
	function Konfigurasi_model()
	{
		parent::__construct();
	}
	
	/* Insialiasi nama table */
	var $table_konfigurasi		= 'konfigurasi';

	
	function update($data){
		$this->db->where('nama',$data['nama']);
		$this->db->update($this->table_konfigurasi, $data);
	}
	
	function fetch_record($limit, $start){
		$this->db->limit($limit, $start);
		$query = $this->db->get($this->table_konfigurasi);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

	function record_count(){
		$this->db->from($this->table_konfigurasi);
		return $this->db->count_all_results();
	}
	
	function get_data($nama){
		$this->db->where('nama', $nama);
		$query = $this->db->get($this->table_konfigurasi);
		return $query->row();
	}
}