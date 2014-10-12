<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Absensi extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('Absensi_model', '', TRUE);
		$this->fungsi->check_login(1);
    }
	
	public function index(){
		$this->add_abs();
	}
	
	public function add_abs(){
		/* Setting Parameter Untuk Paging List collect */
		$data['search'] = date('Y-m-d', strtotime($this->uri->segment(4)));
		$uri_segment = 5;
		$offset = $this->uri->segment($uri_segment);
		$collect = $this->Absensi_model->get_paging($this->config->item('paging_limit'), $offset, $data['search'])->result();
		$num_rows = $this->Absensi_model->count_rows($data['search']);
		$data['total2'] = $num_rows;
		$config['base_url'] = site_url('admin/absensi/index/'.$data['search'].'/');
		if ($num_rows > 0) // Jika query menghasilkan data
				{
					// Membuat pagination			
					$config['total_rows'] = $num_rows;
					$config['per_page'] = $this->config->item('paging_limit');
					$config['uri_segment'] = $uri_segment;
					$this->pagination->initialize($config);
					$data['pagination2'] = $this->pagination->create_links();
					$i = 0 + $offset;
					
					$tmpl = array( 'table_open'     => '<table border="0" cellpadding="1" cellspacing="1" id="list">',
								   'row_alt_start'  => '<tr class="zebra">',
								   'row_alt_end'    => '</tr>'
								  );
					$this->table->set_template($tmpl);
		
					// Set heading untuk tabel
					$this->table->set_empty("&nbsp;");
					$this->table->set_heading('No','Tgl.', 'nik', 'Nama', 'Waktu Absen', 'Status');
				
					foreach ($collect  as $rows)
					{	
						$a = $rows;
						$status = $rows->status;
						if($status==0){
							$status = 'Masuk';
						}elseif($status==1){
							$status = 'Pulang';
						}elseif($status==2){
							$status = 'Keluar';
						}elseif($status==3){
							$status = 'Kembali';
						}elseif($status==4){
							$status = 'Lembur Masuk';
						}elseif($status==5){
							$status = 'Lembur Keluar';
						}else{
							$status = $status;
						}
						$this->table->add_row(date('d-m-Y', strtotime($rows->tgl_tarik)),$rows->nik, $rows->nama, date('d-m-Y H:i:s', strtotime($rows->tgl_abs)), $in_out);		
					}
					$data['message2'] = '<b>Total Data: </b>'.($num_rows).' rows';
					$data['table2'] = $this->table->generate();
				}
			else
				{
					$data['message2'] = '<div style="padding:5px 5px 5px 5px;">No data to display</div>';
				}
		
		$data['message'] = '<div style="padding:5px 5px 5px 5px;">No data to display</div>';
		//Get machine data
		$GetMachine = $this->Absensi_model->GetData_Machine()->result();
		$data['machine'] = '<option value="0">-- Pilih --</option>';
		foreach($GetMachine as $row){
			$data['machine'] .= '<option value='.$row->ip_address.'>'.$row->nama.'</option>';
		}
		
		$data['form_action']= site_url('admin/absensi/add_list_abs');
		$data['view_disabled']='';
		$data['download_disabled']='disabled';
		$data['export_disabled']='';
		
		$data['title'] = 'Admin | Absensi';
		$data['menu_active'] = M_ABSENSI;
		
		$this->view('admin/absensi',$data);
	}
	
	function add_abs_data()
	{
		$date = date('Y-m-d',strtotime($this->uri->segment(4)));
		$IPNya = $this->uri->segment(5);
		$GetMachineIP = $this->Absensi_model->GetData_MachineIP($IPNya)->result();
		foreach($GetMachineIP as $row){
			$IP = $row->ip_address;
			$Key = $row->pass;
			$pass = $row->pass;//echo $IP;
			$ID = $row->id;//echo $ID;
			/*For insert to att_data_collect*/
			if(!empty($IP)){
				$Connect = fsockopen($IP, "80", $errno, $errstr, 1);
				if($Connect){
					$soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$pass."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
				
					$newLine="\r\n";
					fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
					fputs($Connect, "Content-Type: text/xml".$newLine);
					fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
					fputs($Connect, $soap_request.$newLine);
					$buffer="";
					while($Response=fgets($Connect, 1024)){
						$buffer=$buffer.$Response;
					}
				
					include("parse.php");
					$buffer=Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
					$buffer=explode("\r\n",$buffer);
					
					for($a=0;$a<count($buffer);$a++){
						$data=Parse_Data($buffer[$a],"<Row>","</Row>");
						$PIN=Parse_Data($data,"<PIN>","</PIN>");
						$DateTime=Parse_Data($data,"<DateTime>","</DateTime>");
						$Verified=Parse_Data($data,"<Verified>","</Verified>");
						$Status=Parse_Data($data,"<Status>","</Status>");
						
						$dateNya= date('Y-m-d',strtotime($DateTime));
						//insert
						if(!empty($PIN)){
							//cek data att_data_collect
							$numrows = $this->Absensi_model->CekData_abs($date, $PIN, $DateTime, $Status, $ID);
							if ($numrows == 0){
								/* Insert data att_data_collect*/
								$data_abs = array( 	
														'tgl_tarik'		=> $date,
														'nik'			=> $PIN,
														'tgl_abs'		=> $DateTime,
														'status' 		=> $Status,
														'id'			=> $ID
											);
								$this->Absensi_model->add_abs_data($data_abs);
							}
						}
					}
	
					//for deleting data in device
					$Connect = fsockopen($IP, "80", $errno, $errstr, 1);
					if($Connect){
						$soap_request="<ClearData><ArgComKey xsi:type=\"xsd:integer\">".$pass."</ArgComKey><Arg><Value xsi:type=\"xsd:integer\">3</Value></Arg></ClearData>";
						$newLine="\r\n";
						fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
						fputs($Connect, "Content-Type: text/xml".$newLine);
						fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
						fputs($Connect, $soap_request.$newLine);
						$buffer="";
						while($Response=fgets($Connect, 1024)){
							$buffer=$buffer.$Response;
						}
					}
					
					$this->session->set_flashdata('message_ok', 'Tarik data sukses...');
					redirect('admin/absensi/add_abs/'.$date);
				}else{
					
					$this->session->set_flashdata('message_err', 'Fingerprint Cannot Detected . . .');
					redirect('tr/tarik_abs_con/add_abs');	
				
				}
			}else{//jika IP tidak ada
					$this->session->set_flashdata('message_err', 'Unable to connect to (IP:'.$IP.') . . .');
					redirect('tr/tarik_abs_con/add_abs');
				}
		}//end foreach
			
	}
	
	function add_list_abs()
	{
		if($this->input->post('submit')=='Tarik Data'){
			redirect('admin/absensi/add_abs_data/'.$this->input->post('datepicker1').'/'.$this->input->post('cb_machine'));
		}elseif($this->input->post('submit')=='Export Data'){
			redirect('admin/absensi/export_to_txtfile/'.$this->input->post('datepicker1'));
		}
		
		$CollectDate = date('d-m-Y', strtotime($this->input->post('datepicker1')));
		$GetMachineIP = $this->Absensi_model->GetData_MachineIP($this->input->post('cb_machine'));
		foreach($GetMachineIP->result() as $row)
		
		
		
		
		
		
		$IP = $row->ip_address;
		$Key = $row->pass;//$this->input->post('txt_key');
		$id = '';
		$fn = '';
		if(!empty($IP)){
			$Connect = fsockopen($IP, "80", $errno, $errstr, 1);
			if($Connect){
				$soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
			
				$newLine="\r\n";
				fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
				fputs($Connect, "Content-Type: text/xml".$newLine);
				fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
				fputs($Connect, $soap_request.$newLine);
				$buffer="";
				while($Response=fgets($Connect, 1024)){
					$buffer=$buffer.$Response;
				}
			
				include("parse.php");
				$buffer=Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
				$buffer=explode("\r\n",$buffer);
				
				$uri_segment = 4;
				$offset = $this->uri->segment($uri_segment);
				$num_rows = count($buffer);
				if ($num_rows > 0) // Jika query menghasilkan data
				{
					//create header table
					$config['total_rows'] = $num_rows;
					$config['per_page'] = $this->config->item('paging_limit');
					$config['uri_segment'] = $uri_segment;
					$this->pagination->initialize($config);
					$data['pagination'] = $this->pagination->create_links();
					$i = 0 + $offset;
					
					$tmpl = array( 'table_open'     => '<table border="0" cellpadding="1" cellspacing="1" id="list">',
								   'row_alt_start'  => '<tr class="zebra">',
								   'row_alt_end'    => '</tr>'
								  );
					$this->table->set_template($tmpl);
		
					// Set heading untuk tabel
					$this->table->set_empty("&nbsp;");
					$this->table->set_heading('No','Tgl.', 'nik', 'Nama', 'Waktu Absen', 'Status');
					$name = '';
					for($a=0;$a<count($buffer);$a++){
						$data=Parse_Data($buffer[$a],"<Row>","</Row>");
						$PIN=Parse_Data($data,"<PIN>","</PIN>");
						$DateTime=Parse_Data($data,"<DateTime>","</DateTime>");
						$Verified=Parse_Data($data,"<Verified>","</Verified>");
						$Status=Parse_Data($data,"<Status>","</Status>");
						
						$dateNya= date('d-m-Y',strtotime($DateTime));
						//insert
						if(!empty($PIN)){
							$GetDataKry = $this->Absensi_model->GetData_kry($PIN)->result();
							foreach($GetDataKry as $row){
							$name = $row->nama;			}
							$status = $rows->status;
							if($status==0){
								$status = 'Masuk';
							}elseif($status==1){
								$status = 'Pulang';
							}elseif($status==2){
								$status = 'Keluar';
							}elseif($status==3){
								$status = 'Kembali';
							}elseif($status==4){
								$status = 'Lembur Masuk';
							}elseif($status==5){
								$status = 'Lembur Keluar';
							}else{
								$status = $status;
							}
							$this->table->add_row($a, $CollectDate, $PIN, $name, date('d-m-Y H:i:s', strtotime($DateTime)), $Status);
						}
					}
					$data['message'] = '<b>Total Data: </b>'.($num_rows - 2).' rows';
					$data['table'] = $this->table->generate();
				}else{
					$data['message'] = '<div style="padding:5px 5px 5px 5px;">No data to display</div>';
				}
			}
		}//end if for (!empty($IP))
		$data['totalrow'] = $num_rows.' data';
		$data['default']['datepicker1'] = date('d-m-Y', strtotime($this->input->post('datepicker1')));
		
		//Get machine data by id
		$GetMachineIP = $this->Absensi_model->GetData_MachineIP($this->input->post('cb_machine'))->result();
		foreach($GetMachineIP as $row);
		$data['machine'] ='<option value="'.$row->ip_address.'">'.$row->nama.'</option>';
		//Get machine data all
		$GetMachine = $this->Absensi_model->GetData_Machine()->result();
		//$data['machine'] = '<option value="0">Pilih</option>';
		foreach($GetMachine as $row){
			$data['machine'] .= '<option value='.$row->ip_address.'>'.$row->nama.'</option>';
		}
		
		$data['message2'] = '<div style="padding:5px 5px 5px 5px;">No data to display</div>';
		$data['form_action']= site_url('admin/absensi/add_list_abs');
		
		$data['download_disabled']='';
		$data['export_disabled']='';
		$data['view_disabled']='disabled';
		
		$data['title'] = 'Admin | Absensi';
		$data['menu_active'] = M_ABSENSI;
		
		$this->view('admin/absensi',$data);
	}
	
	function export_to_txtfile()
	{	
		$date = date('Y-m-d',strtotime($this->uri->segment(4)));
		if($date=='1970-01-01'){
			$this->session->set_flashdata('message_err', 'Tanggal Tarik Data Harus Diisi');
			redirect('tr/tarik_abs_con/add_abs');
		}
		
		$structure = 'C:\Data Absen';
		if (is_dir('Data Absen')==false){
			mkdir($structure, 0777, true);
			$path = $structure;
		}else{
			$path = $structure;
		}
		
		$content = $this->Absensi_model->GetData_Collect($date)->result();
		foreach($content as $row){
			if(!empty($absensi)){
				$absensi .= $row->absensi.PHP_EOL;
			}else{
				$absensi = $row->absensi.PHP_EOL;
			}
		}
		
		$filename = date('Ymd',strtotime($this->uri->segment(4)));
		$fp = fopen($path."/".$filename.".txt","wb");//tempat penyimpanan file
		$filename = $path."/".$filename.".txt";
		if($fp){
			fwrite($fp,$absensi);
			
			$download_name = basename($filename);
			
			if(file_exists($filename))
			{	
				header('Content-Description: File Transfer');
				header('Content-Type: application/force-download');
				header('Content-Transfer-Encoding: Binary');
				header("Content-Disposition: attachment; filename=".$download_name);
				header('X-SendFile: '.$filename);
				header('Pragma: no-cache');
				header("Expires: 0");
				readfile($filename);
			} 
			fclose($fp);
		}else{
			$this->session->set_flashdata('message_err', 'File name is already exist');
			redirect('admin/absensi/add_abs/'.$date);
		}
	}
	
	public function view($php,$data){
		$this->parser->parse('template/site_head', $data);
		$this->parser->parse('template/site_admin_top', $data);
		$this->load->view($php,$data);
		$this->parser->parse('template/site_foot', $data);
	}
}