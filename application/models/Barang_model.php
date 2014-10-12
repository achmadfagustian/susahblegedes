<?php
/*
Fungsi : Model untuk Barang
*/
class Barang_model extends CI_Model {

	function Barang_model(){
		parent::__construct();
	}
	
	/* Insialiasi nama table */
	var $table_barang		= 'm_barang';
	var $vw_barang_lokasi	= 'vw_barang_lokasi';
	
	function insert($data){
		$this->db->insert($this->table_barang, $data);
	}
	
	function update($data){
		$this->db->where('id_barang',$data['id_barang']);
		$this->db->update($this->table_barang, $data);
	}
	
	function fetch_record($limit, $start, $filter){
		$this->db->limit($limit, $start);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$query = $this->db->get($this->table_barang);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

	function record_count($filter){
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$this->db->from($this->table_barang);
		return $this->db->count_all_results();
	}
	
	function select_barang_lokasi(){
		$this->db->select(" m_lokasi.id_lokasi,m_lokasi.nama,m_barang_lokasi.min,m_barang_lokasi.max,m_barang_lokasi.stock");
		$this->db->from("m_barang_lokasi");
		$this->db->join("m_lokasi", "m_lokasi.kode_lokasi = m_barang_lokasi.kode_lokasi","right outer");
		$this->db->where('m_lokasi.status >',0);
		$query = $this->db->get();
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}
	
	function select_barang_supplier(){
		$this->db->select(" m_supplier.id_supplier,m_supplier.kode_supplier,m_supplier.nama");
		$this->db->from("m_barang_supplier");
		$this->db->join("m_supplier", "m_supplier.kode_supplier = m_barang_supplier.kode_supplier","left");
		$this->db->where('m_supplier.status >',0);
		$query = $this->db->get();
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}
	
	function select_data($data){
		$this->db->select("kode_barang,nama,kode_satuan,hjual,hpp_terakhir,hpp_terbesar");
		$this->db->from($this->table_barang);
		if(isset($data['kode_barang'])){
			$this->db->where('kode_barang',$data['kode_barang']);
		}
		$this->db->where('status =',1);
		return $this->db->get();
	}
	
	function fetch_record_common_all($limit, $start, $search){
		$this->db->select("kode_barang,nama,nama_alias,status,kode_lokasi,nama_lokasi,stock");
		$this->db->limit($limit, $start);
		//$this->db->where('status >',0);
		if($search!=""){
			$this->db->like('kode_barang',$search);
			$this->db->or_like('nama', $search); 
			$this->db->or_like('nama_alias', $search); 
		}
		$query = $this->db->get($this->vw_barang_lokasi);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

	function record_count_common_all($search){
		//$this->db->where('status >',0);
		if($search!=""){
			$this->db->like('kode_barang',$search);
			$this->db->or_like('nama', $search); 
			$this->db->or_like('nama_alias', $search); 
		}
		$this->db->from($this->vw_barang_lokasi);
		return $this->db->count_all_results();
	}
}