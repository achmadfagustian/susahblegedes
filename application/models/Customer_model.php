<?php
/*
Fungsi : Model untuk Customer
*/
class Customer_model extends CI_Model {
	/**
	 * Constructor
	 */
	function Customer_model()
	{
		parent::__construct();
	}
	
	/* Insialiasi nama table */
	var $table_customer		= 'customer';
	var $table_customer_history	= 'customer_history';
	var $table_customer_history_detail	= 'customer_history_detail';
	var $vw_transaksi	= 'vw_transaksi';
	var $vw_transaksi_mekanik = 'vw_transaksi_mekanik';
	var $vw_history_mekanik_user = 'vw_history_mekanik_user';
	var $vw_history_detail = 'vw_history_detail';

	function insert($data){
		$this->db->insert($this->table_customer, $data);
	}
	
	function insert_history_detail($data){
		$this->db->insert($this->table_customer_history_detail, $data);
	}
	
	function insert_select_key($data){
		$this->db->insert($this->table_customer, $data);
		
		$this->db->select("id_customer");
		$this->db->from($this->table_customer);
		$this->db->where("id_pelanggan", $data['id_pelanggan']);
		$this->db->where("no_polisi", $data['no_polisi']);
		$query = $this->db->get();
		$row = $query->row();
		return $row->id_customer;
	}
	
	function insert_history_select_key($data){
		$this->db->insert($this->table_customer_history, $data);
		
		$this->db->select("id_customer_history");
		$this->db->from($this->table_customer_history);
		$this->db->where("id_customer", $data['id_customer']);
		$this->db->where("tipe", $data['tipe']);
		$this->db->order_by('reg_datetime','DESC');
		$query = $this->db->get();
		$row = $query->row();
		return $row->id_customer_history;
	}
	
	function update($data){
		$this->db->where('id_customer',$data['id_customer']);
		$this->db->update($this->table_customer, $data);
	}
	
	function update_history($data){
		$this->db->where('id_customer_history',$data['id_customer_history']);
		$this->db->update($this->table_customer_history, $data);
	}
	
	function select_data($cust){
		$this->db->select("*");
		$this->db->from($this->table_customer);
		if(isset($cust['id_customer'])){
			$this->db->where('id_customer',$cust['id_customer']);
		}
		if(isset($cust['id_pelanggan'])){
			$this->db->where('id_pelanggan',$cust['id_pelanggan']);
		}
		if(isset($cust['no_polisi'])){
			$this->db->where('no_polisi',$cust['no_polisi']);
		}
		$this->db->order_by('pemilik','ASC');
		$custs = $this->db->get();
		return $custs;
	}
	
	function select_data_like($cust){
		$this->db->select("*");
		$this->db->from($this->table_customer);
		if(isset($cust['id_pelanggan'])){
			$this->db->like('id_pelanggan',$cust['id_pelanggan']);
		}
		if(isset($cust['no_polisi'])){
			$this->db->like('no_polisi',$cust['no_polisi']);
		}
		$this->db->order_by('pemilik','ASC');
		$custs = $this->db->get();
		return $custs;
	}
	
	function select_data_compl($id_customer){
		$this->db->select("customer_history.nik_mekanik,main_user.nama AS nama_mekanik");
		$this->db->from($this->table_customer_history);
		$this->db->join("main_user", "main_user.nik = customer_history.nik_mekanik");
		$this->db->limit(1, 0);		
		$this->db->order_by('customer_history.id_customer_history','DESC');
		$query = $this->db->get();
		return ($query->num_rows() > 0)  ? $query->row() : FALSE;
	}
	
	function select_history_data($cust){
		$this->db->select("*");
		$this->db->from($this->table_customer_history);
		if(isset($cust['id_customer_history'])){
			$this->db->where('id_customer_history',$cust['id_customer_history']);
		}
		if(isset($cust['id_customer'])){
			$this->db->where('id_customer',$cust['id_customer']);
		}
		if(isset($cust['id_perusahaan'])){
			$this->db->where('id_perusahaan',$cust['id_perusahaan']);
		}
		if(isset($cust['pit_no'])){
			$this->db->where('pit_no_temp',$cust['pit_no']);
		}
		if(isset($cust['limit'])){
			$this->db->limit($cust['limit'], 0);
		}
		$custs = $this->db->get();
		return $custs;
	}
	
	function select_available_history_data($cust){
		$this->db->select("*");
		$this->db->from($this->table_customer_history);
		if(isset($cust['id_perusahaan'])){
			$this->db->where('id_perusahaan',$cust['id_perusahaan']);
		}
		if(isset($cust['pit_no'])){
			$this->db->where('pit_no_temp',$cust['pit_no']);
		}
		$this->db->where('finish_datetime IS NULL',NULL);
		if(isset($cust['limit'])){
			$this->db->limit($cust['limit'], 0);
		}
		$custs = $this->db->get();
		return $custs;
	}
	
	
	function select_history_data_all($cust){
		$this->db->select("*");
		$this->db->from($this->vw_history_mekanik_user);
		if(isset($cust['id_customer'])){
			$this->db->where('id_customer',$cust['id_customer']);
		}
		if(isset($cust['limit'])){
			$this->db->limit($cust['limit'], 0);
		}
		$custs = $this->db->get();
		return $custs;
	}
	
	function select_history_detail_data($cust){
		$this->db->select("*");
		$this->db->from($this->table_customer_history_detail);
		if(isset($cust['id_customer_history'])){
			$this->db->where('id_customer_history',$cust['id_customer_history']);
		}
		$custs = $this->db->get();
		return $custs->result();
	}
	
	function select_history_detail_data_arr($cust){
		$this->db->select("*");
		$this->db->from($this->vw_history_detail);
		if(isset($cust['id_customer_history'])){
			$this->db->where('id_customer_history',$cust['id_customer_history']);
		}
		return $this->db->get();
	}
	
	function select_data_trx($cust){
		$this->db->select("id_customer,id_pelanggan,no_polisi,pemilik,nik_mekanik,nama_mekanik");
		$this->db->from($this->vw_transaksi_mekanik);
		
		if(isset($cust['id_pelanggan'])){
			$this->db->where('id_pelanggan',$cust['id_pelanggan']);
		}
		if(isset($cust['no_polisi'])){
			$this->db->where('no_polisi',$cust['no_polisi']);
		}
		$this->db->order_by('reg_datetime','DESC');
		$custs = $this->db->get();
		return $custs;
	}
	
	function fetch_record($limit, $start, $search){
		$this->db->limit($limit, $start);
		//$this->db->where('status >',0);
		if($search!=""){
			$this->db->like('id_pelanggan',$search);
			$this->db->or_like('no_polisi', $search); 
			$this->db->or_like('pemilik', $search); 
			$this->db->or_like('tipe', $search); 
		}
		$query = $this->db->get($this->table_customer);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

	function record_count($search){
		//$this->db->where('status >',0);
		if($search!=""){
			$this->db->like('id_pelanggan',$search);
			$this->db->or_like('no_polisi', $search); 
			$this->db->or_like('pemilik', $search); 
			$this->db->or_like('tipe', $search); 
		}
		$this->db->from($this->table_customer);
		return $this->db->count_all_results();
	}
	
	function fetch_record_trx($limit, $start, $filter){
		$this->db->limit($limit, $start);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		$query = $this->db->get($this->vw_transaksi);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}

	function record_count_trx($filter){
		$this->db->from($this->vw_transaksi);
		foreach ($filter as $key => $value) {
			if($value!=""){
				$this->db->like($key,$value);
			}
		}
		return $this->db->count_all_results();
	}
	/*
	| Status = 1 -> BELUM START
	|
	*/
	function select_data_by_status($status=0){
		$this->db->select("*");
		$this->db->from($this->vw_transaksi);
		if($status==1){
			$this->db->where('start_datetime IS NULL',NULL);
		}
		$this->db->order_by('reg_datetime','DESC');
		$trx = $this->db->get();
		return $trx->result();
	}
	
	function get_id_pelanggan($q){
		$this->db->select('id_pelanggan');
		$this->db->like('id_pelanggan', $q);
		$this->db->order_by('id_pelanggan','ASC');
		return $this->db->get($this->table_customer);
	}
	
	function get_no_polisi($q){
		$this->db->select('no_polisi');
		$this->db->like('no_polisi', $q);
		$this->db->order_by('no_polisi','ASC');
		return $this->db->get($this->table_customer);
	}
	
	function get_count_finish($id_perusahaan,$pit_no){
		$this->db->from($this->table_customer_history);
		$this->db->where('id_perusahaan', $id_perusahaan);
		$this->db->where('pit_no_temp', $pit_no);
		$this->db->where('DATE(finish_datetime) = CURDATE()', NULL);
		return $this->db->count_all_results(); 
	}
	
	function fetch_record_finish_all($limit, $start, $data){
		$this->db->select("id_customer_history,pemilik,jenis,no_polisi,reg_datetime,start_datetime,finish_datetime");
		$this->db->limit($limit, $start);
		$this->db->where('id_perusahaan',$data['id_perusahaan']);
		$this->db->where('pit_no_temp',$data['pit_no']);
		if($data['search']!=""){
			$where = "(pemilik LIKE '%".$data['search']."%' OR no_polisi LIKE '%".$data['search']."%' OR jenis LIKE '%".$data['search']."%')";
			$this->db->where($where);
		}
		$this->db->where('finish_datetime IS NOT NULL',NULL);
		$query = $this->db->get($this->vw_transaksi);
		return ($query->num_rows() > 0)  ? $query->result() : FALSE;
	}
	
	function record_count_finish_all($data){
		$this->db->where('id_perusahaan',$data['id_perusahaan']);
		$this->db->where('pit_no_temp',$data['pit_no']);
		if($data['search']!=""){
			$where = "(pemilik LIKE '%".$data['search']."%' OR no_polisi LIKE '%".$data['search']."%' OR jenis LIKE '%".$data['search']."%')";
			$this->db->where($where);
		}
		$this->db->where('finish_datetime IS NOT NULL',NULL);
		$this->db->from($this->vw_transaksi);
		return $this->db->count_all_results();
	}
	
	function delete_hist_detail_by_cust_hist($id_customer_history){
		$this->db->delete($this->table_customer_history_detail, array('id_customer_history' => $id_customer_history)); 
	}
	
	function select_history_mekanik_user($data){
		$this->db->select("id_customer_history,id_customer,kode_trx,mekanik_nama,km,finish_datetime,id_perusahaan,keluhan,diganti,keterangan");
		$this->db->where('id_customer_history',$data['id_customer_history']);
		$this->db->from($this->vw_history_mekanik_user);
		$this->db->limit(1, 0);		
		$query = $this->db->get();
		return $query->row();
	}

}