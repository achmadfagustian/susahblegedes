<?php 
/*
Fungsi : Semua fungsi-fungsi global ditaruh disini
*/
Class Fungsi{

	function Fungsi(){
		/* Load Library CI */
		$this->CI =& get_instance();
		$this->CI->load->library(array('session','encrypt'));
	}
	
	/* Display system message ok & error */
	/*OK*/
	function disp_sys_msg(){	
		echo $this->CI->session->flashdata('message_ok') == '' ? '' : '<div class="success">' . $this->CI->session->flashdata('message_ok') . '</div>';
		echo $this->CI->session->flashdata('message_err') == '' ? '' : '<div class="error">' . $this->CI->session->flashdata('message_err') . '</div>';	
		echo $this->CI->session->flashdata('message_war') == '' ? '' : '<div class="warning">' . $this->CI->session->flashdata('message_war') . '</div>';	
	}
	
	/*OK*/
	function get_sys_msg(){	
		$msg = "";
		if($this->CI->session->flashdata('message_ok') != ''){
			$msg = '<div class="success">' . $this->CI->session->flashdata('message_ok') . '</div>';
		}else if($this->CI->session->flashdata('message_err') != ''){
			$msg = '<div class="error">' . $this->CI->session->flashdata('message_err') . '</div>';
		}else if($this->CI->session->flashdata('message_war') != ''){
			$msg = '<div class="warning">' . $this->CI->session->flashdata('message_war') . '</div>';
		};
		return $msg;
	}

/* Fungsi untuk membuat combo box menu */
function get_menu($id,$level, $post_data)
{
      			$response = '';
				$query = $this->CI->db->query('SELECT * FROM master_menu WHERE pid ='.$id.' ORDER BY mid, pid ASC');
				foreach($query->result() as $row): 
				
          		$response .= $row->mid== $post_data ? '<option value="'.$row->mid.'" selected="selected">': '<option value="'.$row->mid.'">';
				for ($i = 0; $i < ($level-1); $i++) $response .= '&nbsp;&nbsp;&nbsp;&nbsp;';
				$response .= '|___'.$row->mname;
				$response .= '</option>';
				$response .= $this->get_menu($row->mid,$level+1,$post_data);
     			endforeach;
      			return $response;      
}

/*Fungsi membuat tree menu */
function menu_widget($data,$parent){
  if(isset($data[$parent])){ 
	$str = ''; 
	foreach($data[$parent] as $value){
	  $child = $this->menu_widget($data,$value->mid); 
	 if ( $value->murl == '#' && $value->tcode == '' ) { $url=$this->CI->config->item('base_url').'/frame/frame_body'; $tcode=''; } else { $url=$this->CI->config->item('base_url').'/'.$value->murl; $tcode=$value->tcode.'-'; }
	 $str .= '<li class="closed">';
	 //$str .= '<li class="open">';
	 $str .= ($child) ? '<span class="folder"><a href="'.$url.'" target="mainFrame">'.$tcode.$value->mname.'</a></span><ul>' : '<span class="file"><a href="'.$url.'" target="mainFrame">'.$tcode.$value->mname.'</a></span></li>';
	  if($child) $str .= $child;
	}
	$str .= '</ul>';
	return $str;
  }else return false;	  
}

/*Fungsi membuat tree menu utk menu admin role edit */
function menu_widget_role_edit($data,$parent,$chk){
  if(isset($data[$parent])){ 
	$str = ''; 
	foreach($data[$parent] as $value){
	  $child = $this->menu_widget_role_edit($data,$value->mid,$chk); 
	 // $str .= '<li class="closed">';
	 $str .= '<li>';
	 $str .= ($child) ? '<input type="checkbox" name="chk_menu[]" value="'.$value->mid.'"'.set_checkbox('chk_menu[]', $value->mid, isset($chk) && $this->search_array($chk, $value->mid)  ? TRUE : FALSE ).'><label>'.$value->mname.'</label><ul>' : '<input type="checkbox" name="chk_menu[]" value="'.$value->mid.'"'.set_checkbox('chk_menu[]', $value->mid, isset($chk) && $this->search_array($chk, $value->mid)  ? TRUE : FALSE ).'><label>'.$value->mname.'</label></li>';
	  if($child) $str .= $child;
	}
	$str .= '</ul>';
	return $str;
  }else return false;	  
}

/*Fungsi membuat tree menu utk menu input admin role */
function menu_widget_role($data,$parent){
  if(isset($data[$parent])){ 
	$str = ''; 
	foreach($data[$parent] as $value){
	  $child = $this->menu_widget_role($data,$value->mid); 
	 // $str .= '<li class="closed">';
	 $str .= '<li>';
	 $str .= ($child) ? '<input type="checkbox" name="chk_menu[]" value="'.$value->mid.'"'.set_checkbox('chk_menu[]', $value->mid, isset($default['chk_update']) && $default['chk_update'] == $value->mid  ? TRUE : FALSE ).'><label>'.$value->mname.'</label><ul>' : '<input type="checkbox" name="chk_menu[]" value="'.$value->mid.'"'.set_checkbox('chk_menu[]', $value->mid, isset($default['chk_update'] ) && $default['chk_update'] == $value->mid  ? TRUE : FALSE ).'><label>'.$value->mname.'</label></li>';
	  if($child) $str .= $child;
	}
	$str .= '</ul>';
	return $str;
  }else return false;	  
}

//Fungsi utk mendapatkan auto increment berikutnya
function get_last_id($table)
{
	$query = $this->CI->db->query(" SHOW TABLE STATUS LIKE '".$table."' ");
	return $query;
}

	//Fungsi utk search array ( Tidak berlaku utk multidimensional array )
	/*OK*/
	function search_array($array, $value){
		 if(in_array($value ,$array)){
			 return true;
		 }
	}

//Fungsi utk check array kosong
/*OK*/
function is_array_empty($InputVariable){
   $Result = true;

   if (is_array($InputVariable) && count($InputVariable) > 0){
      foreach ($InputVariable as $Value){
         $Result = $Result && $this->is_array_empty($Value);
      }
   }
   else{
      $Result = empty($InputVariable);
   }

   return $Result;
}

/* Fungsi untuk convert status */
 	function convert_status($status)
	{
		
		switch ($status)
		{
			case 1:
			  $status = 'Yes';
			  break;
			case 0:
			  $status = 'No';
			  break;
		}
	
	return $status;
		
	}

/* Fungsi untuk convert gender */
 	function convert_gender($gender)
	{
		switch ($gender)
		{
			case 1:
			  $gender = 'Female';
			  break;
			case 0:
			  $gender = 'Male';
			  break;
		}
	return $gender;
	}
	
	/* Fungsi Untuk Enkripsi */
	/*OK*/
	function encrypt($string){
		return $this->CI->encrypt->encode($string, $this->CI->config->item('encryption_key'));		
	}
	
	function encrypt_ses($string){
		return $this->CI->encrypt->encode($string, $this->CI->config->item('encryption_key_session'));		
	}

	/* Fungsi Untuk Dekripsi */
	/*OK*/
	function decrypt($string){
		return $this->CI->encrypt->decode($string, $this->CI->config->item('encryption_key'));		
	}
	
	function decrypt_ses($string){
		return $this->CI->encrypt->decode($string, $this->CI->config->item('encryption_key_session'));		
	}

	/* Fungsi utk check session user */
	/*OK*/
	function is_login(){	
		if($this->CI->session->userdata('login')==TRUE){
			return true;
		}else{
			return false;
		}
	}
	
	function check_login($tipe){	
		if($this->CI->session->userdata('login')==TRUE && $this->CI->session->userdata('tipe')==$tipe){
			return true;
		}else{
			$this->CI->session->set_flashdata('message_err', 'Please login to enter system');
			if($tipe==1){
				redirect('login_adm1n/logout');
			}else{
				redirect('login/logout');
			}
		}
	}
	/* Fungsi utk get Menu Top User Login */
	function get_menu_top($tipe,$parent){
		$this->CI->load->model('role_model', '', TRUE);
		$menu_tops = $this->CI->role_model->select_menu_by_id_role("m_menu.*",$tipe,$this->CI->session->userdata('id_role'),$parent,"result");
		return $menu_tops;
	}
	
	/* Fungsi utk get Menu Left User Login */
	function get_menu_left($tipe,$parent){
		$this->CI->load->model('role_model', '', TRUE);
		$menu_tops = $this->CI->role_model->select_menu_by_id_role("m_menu.*",$tipe,$this->CI->session->userdata('id_role'),$parent,"result");
		return $menu_tops;
	}

/* Fungsi utk check otorisasi menu */
function menu_auth($mid)
{	
	$query_user_menu = $this->CI->db->query("select * from role_menu where roleid='".$this->CI->session->userdata('roleid')."' and mid='".$mid."'");
	
	if ($query_user_menu->num_rows() == 0 && $this->CI->session->userdata('rolename') != 'ADMIN')
		{
		$this->CI->session->set_flashdata('message_err', 'You do not have authorization to access menu');
		redirect('frame/frame_blank/');
		}
}

/* Fungsi utk check otorisasi transaksi */
function trans_auth($sess)
{	
	if ($sess == 0 && $this->CI->session->userdata('rolename') != 'ADMIN')
		{
		$this->CI->session->set_flashdata('message_err', 'You do not have authorization to do the transaction');
		redirect('frame/frame_blank/');
		}
}

 //Fungsi utk menghapus data session pencarian
 function sess_search_segment()
 {
	if ($this->CI->session->userdata('sess_segment')=='')
	{
		$this->CI->session->set_userdata('sess_segment',$this->CI->uri->segment(3));
	}
	else
	{
		if($this->CI->session->userdata('sess_segment') != $this->CI->uri->segment(3))
		{
		//Hapus data session pencarian
		$this->CI->session->unset_userdata('sess_search');
		$this->CI->session->set_userdata('sess_segment',$this->CI->uri->segment(3));
		}
	}	 
 }

/*Fungsi Format Penomoran */
	function format($no)
	{
	
	return str_pad($no, 5, "0", STR_PAD_LEFT);
	
	}
	
	function format_bulan($no)
	{
		return str_pad($no, 2, "0", STR_PAD_LEFT);
	}
	
/*fungsi format bulan indonesia*/
	function MonthName($bln){
			switch ($bln){
				case 1;
					return "Januari";
					break;
				case 2;
					return "Februari";
					break;
				case 3;
					return "Maret";
					break;
				case 4;
					return "April";
					break;
				case 5;
					return "Mei";
					break;
				case 6;
					return "Juni";
					break;
				case 7;
					return "Juli";
					break;
				case 8;
					return "Agustus";
					break;
				case 9;
					return "September";
					break;
				case 10;
					return "Oktober";
					break;
				case 11;
					return "November";
					break;
				case 12;
					return "Desember";
					break;
				}
		}
	
	function MonthNumber($bln){
			switch ($bln){
				case "Januari";
					return "1";
					break;
				case "Februari";
					return "2";
					break;
				case "Maret";
					return "3" ;
					break;
				case "April";
					return "4";
					break;
				case "Mei";
					return "5";
					break;
				case "Juni";
					return "6";
					break;
				case "Juli";
					return "7";
					break;
				case "Agustus";
					return "8";
					break;
				case "September";
					return "9";
					break;
				case "Oktober";
					return "10";
					break;
				case "November";
					return "11";
					break;
				case "Desember";
					return "12";
					break;
				}
		}
		
		/* -------------------------------------------------
		 * Fungsi untuk menghitung selisih antara 2 waktu 
		 * -------------------------------------------------
		 */ 
		function time_diff($from, $to)
		{
			$diff = abs(strtotime($from)- strtotime($to));
			
			$units = array('year' => 31557600, 'month' => 2635200, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute' => 60, 'second' => 1);
			
			$str = '';
			foreach($units as $title => $length)
			{
				if($d = floor($diff / $length))
				{
					//$str[] = $d . ' ' . $title . ($d > 1 ? 's' : '');
					$str[] = sprintf('%02d',$d); 
					$diff -= $length * $d;
				}
			}
			
			if ($from!='0000-00-00 00:00:00'){
				//print_r ($from.' to '.$to.'<br>');
				return implode(':', $str);
			}
		}  
	
	//fungsi untuk convert time ke decimal	
	function time_to_decimal($time) {
		$timeArr = explode(':', $time);
		//$decTime = ($timeArr[0]*60) + ($timeArr[1]) + ($timeArr[2]/60);
	 	$decTime = ($timeArr[0] + ($timeArr[1]/60) + ($timeArr[2]/3600));
		return $decTime;
	}
	
	//fungsi rounddown menghilangkan angka < 1000
	function rounddown($value, $num_digit)
	{
		if(substr($value, $num_digit)<1000){
			$pengurang = substr($value, $num_digit);
			$hasil = $value - $pengurang ;
			return $hasil;
		}	
	} 
	
	//Format mata uang rupiah
	function format_idr($amount)
	{
		$amount = number_format($amount,0,"",".");
		return $amount;
	}
	
	//Convert to date mysql format
	function convert_to_ymd($date){	
		return date("Y-m-d",   strtotime($date));	
	}
	
	//Convert mysql date format to date format
	function convert_to_dmy($date){	
		return date("d.m.Y",   strtotime($date));	
	}
	
	function dateDiff($endDate, $beginDate){
		$start_date = date("Y-m-d",   strtotime($beginDate));
		$finish_date = date("Y-m-d",   strtotime($endDate));
		$selisih=(strtotime($finish_date)-strtotime($start_date))/(60*60*24);
		$hasil = $selisih + 1; 
		return $hasil;
	}
	
	public function common_pagination(){
		$config = array();
		$config['full_tag_open'] = '<div class="pagination pagination-centered"><ul class="paging_table">';
		$config['full_tag_close'] = '</ul></div><!--pagination-->';
		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		return $config;
	}
}