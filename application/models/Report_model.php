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
	var $table_riwayat		= 'vw_transaksi';
	var $table_stok_barang 	= 'm_barang';
	var $table_service		= 'vw_transaksi_mekanik';
	
	function fetch_record_absensi($limit, $start, $filter){
	  	$this->db->select("abs_data.*, main_user.nama");
		$this->db->from($this->table_absensi);
		
		foreach ($filter as $key => $value) {
			if($value!="" && $key == "nik"){
				$this->db->where("abs_data.nik", $value);
			}elseif ($value!="" && $key == "date_from") {
				$this->db->where("abs_data.tgl_abs >=", $filter['date_from']);
			}elseif ($value!="" && $key == "date_to") {
				$this->db->where("abs_data.tgl_abs <=", $filter['date_to'] );
			}elseif ($value!="" && $key == "nama") {
				$this->db->where("main_user.nama", $value);
			}
		}
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
		$this->db->select("vw_transaksi.*, customer_history.mekanik, customer_history.km, customer_history.keterangan");
		$this->db->from($this->table_riwayat);
		$this->db->join("customer_history", "vw_transaksi.id_customer_history = customer_history.id_customer_history");
		$this->db->limit($limit, $start);
		
		$this->db->order_by('vw_transaksi.id_customer_history','ASC');
		$query = $this->db->get();
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

	function record_count_riwayat(){
		
		$this->db->from($this->table_riwayat);
		return $this->db->count_all_results();
	}

//======================================================
	function fetch_record_service($limit, $start){
		$this->db->select("vw_transaksi_mekanik.*");
		$this->db->from($this->table_service);
		$this->db->limit($limit, $start);
		
		$this->db->order_by('vw_transaksi_mekanik.nama_mekanik','DESC');
		$query = $this->db->get();
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

	function record_count_service(){
		
		$this->db->from($this->table_absensi);
		return $this->db->count_all_results();
	}

	function fetch_record_stok_barang($limit, $start, $filter){
		$this->db->select("m_barang.id_barang, m_barang.nama, m_barang.jum_stock");
		$this->db->from($this->table_stok_barang);
		$this->db->limit($limit, $start);
		
		foreach ($filter as $key => $value) {
			if($value!="" && $key == "id_barang"){
				$this->db->where("m_barang.id_barang", $value);
			}elseif ($value!="" && $key == "nama") {
				$this->db->where("m_barang.nama", $value);
			}
		}
		
		$this->db->order_by('m_barang.id_barang','ASC');
		$query = $this->db->get();
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

}