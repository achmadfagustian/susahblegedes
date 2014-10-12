<?php
/*
Fungsi : Model untuk Report
*/
class Report_model extends CI_Model {
	
	function Report_model(){
		parent::__construct();
	}
	
	/* Insialiasi nama table */
	var $table_absensi		= 'abs_data';
	var $table_riwayat		= 'customer_history';
	//var $table_absensi		= 'abs_data';
	
	function fetch_record_absensi($limit, $start){
		$this->db->select("abs_data.*, main_user.nama");
		$this->db->from($this->table_absensi);
		$this->db->join("main_user", "abs_data.nik = main_user.nik");
		$this->db->limit($limit, $start);
		
		$this->db->order_by('abs_data.tgl_abs','DESC');
		$query = $this->db->get();
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

	function record_count_absensi(){
		
		$this->db->from($this->table_absensi);
		return $this->db->count_all_results();
	}
	
//======================================================
	function fetch_record_riwayat($limit, $start){
		$this->db->select("customer_history.*");
		$this->db->from($this->table_riwayat);
		//$this->db->join("main_user", "abs_data.nik = main_user.nik");
		$this->db->limit($limit, $start);
		
		$this->db->order_by('customer_history.reg_datetime','DESC');
		$query = $this->db->get();
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

	function record_count_riwayat(){
		
		$this->db->from($this->table_riwayat);
		return $this->db->count_all_results();
	}
}