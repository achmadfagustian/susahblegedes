<?php
/*
Fungsi : Model untuk Absensi
*/
class Absensi_model extends CI_Model {
	/**
	 * Constructor
	 */
	function Absensi_model()
	{
		parent::__construct();
	}

	/* Insialiasi nama table */

	var $table_abs			= 'abs_data';

	/* Insert abs */
	function add_abs_data($abs){
		$this->db->insert($this->table_abs, $abs);
	}
		
	/* Get class paging */
	function get_paging($limit, $offset, $search){	
		$this->db->select('*');
		$this->db->join('main_user','abs_data.nik = main_user.nik');
		if(!empty($search)) {
			$this->db->like('tgl_tarik',$search);
		}
		$this->db->order_by('abs_data.nik','ASC');
		$this->db->limit($limit, $offset);
  		return $this->db->get($this->table_abs);
	}

	/* Get class total rows */
	function count_rows($search){	
		$this->db->select('*');
		$this->db->join('main_user','abs_data.nik = main_user.nik');
		if(!empty($search)) {
			$this->db->like('tgl_tarik',$search);
		}
		return $this->db->count_all_results($this->table_abs);
	}
	
	function GetData_Abs($date)
	{	
		$query = "SELECT CONCAT('000',id,'00000',nik,status,DATE_FORMAT(tgl_abs,'%Y%m%d%H%i')) 
					as absensi FROM abs_data ";
		if(!empty($date)) {
			//$this->db->where('tgl_collect',$date);
			//$this->db->or_like('murl',$search);
			$kondisi = "WHERE tgl_tarik = '".$date."' ";
		}
		$sql = $query.$kondisi;
		return $this->db->query($sql);
	}
	
	/* Delete class */
	function del_abs($id)
	{
		$this->db->where('tgl_tarik', $id);
		$this->db->delete($this->table_abs);
		
	}
	
	/* Get class by mid */
	function get_abs_id($id)
	{
		$this->db->where('tgl_tarik', $id);
		return $this->db->get($this->table_abs_detail);
	}
		
	function GetData_Machine(){
		return $this->db->get('m_fingerprint');
	}
	
	function GetData_MachineIP($ip){
		$this->db->where('ip_address', $ip);
		$this->db->where('status', '1');
		return $this->db->get('m_fingerprint');
	}

	function CekData_abs($date, $PIN, $DateTime, $Status, $ID)
	{
		if(!empty($date)) {
			$this->db->where('tgl_tarik',$date);
			$this->db->where('nik',$PIN);
			$this->db->where('tgl_abs',$DateTime);
			$this->db->where('status',$Status);
			$this->db->where('id',$ID);
		}
		return $this->db->count_all_results('abs_data');
	}
	
	function GetData_kry($nik)
	{
		if(!empty($nik)) {
			$this->db->where('nik',$nik);
		}
		return $this->db->get('main_user');
	}

}