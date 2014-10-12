<html>	
	<head>
	</head>
	<body>
		<div id="result_table2"></div>
		<div id="result_table">
			<script id="result_template" type="text/x-handlebars-template">
				<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb overviewtable2">
					<colgroup>
						<col class="con0" style="width: 2%" />
						<col class="con1" />
						<col class="con0" />
						<col class="con1" />
						<col class="con0" />
						<col class="con1" />
					</colgroup>
					<thead>
						<tr>
							<th class="head1"><input type="checkbox" class="checkall"/></th>
							<th class="head0">NIK</th>
							<th class="head1">Nama Lengkap</th>
							<th class="head0">Nama Tampilan</th>
							<th class="head1">Tingkat Keahlian</th>
							<th class="head0">Status</th>
						</tr>
					</thead>
					<tbody>
						{{#if results}}
							{{#each results}}
							<tr id="{{id_main_user}}">
								<td class="chkbox"><input type="checkbox" class="chkbox-input" value="{{id_main_user}}"/></td>
								<td>{{nik}}</td>                                                                                   
								<td>{{nama}}</td>                                                                                   
								<td>{{dispname}}</td>                                                                                   
								<td>
									{{#ifCond keahlian '==' 1}}
										Tidak Digolongkan
									{{else}}
										{{#ifCond keahlian '==' 2}}
											Pemula
										{{else}}
											{{#ifCond keahlian '==' 3}}
												Menengah
											{{else}}
												Mahir
											{{/ifCond}}
										{{/ifCond}}
									{{/ifCond}}
								</td>   
								<td>
									{{#ifCond status '==' 1}}
										Active
									{{else}}
										Inactive
									{{/ifCond}}
								</td>								
							</tr>
							{{/each}}
						{{else}}
							  <tr><td colspan="5">No records found!</tr></td>
						{{/if}}
					</tbody>
				</table>
			</script>
		</div>
		<form method="POST" action="#" id="form-hidden-filter" class="hidden">
			<input type="hidden" name="nik" id="f_nik" value="<?php echo $nik?>"/>
			<input type="hidden" name="nama" id="f_nama" value="<?php echo $nama?>"/>
			<input type="hidden" name="dispname" id="f_dispname" value="<?php echo $dispname?>"/>
			<input type="hidden" name="kota" id="f_kota" value="<?php echo $kota?>"/>
			<input type="hidden" name="no_telp" id="f_no_telp" value="<?php echo $no_telp?>"/>
			<input type="hidden" name="keahlian" id="f_keahlian" value="<?php echo $keahlian?>"/>
			<input type="hidden" name="ajax" value="true"/>
		</form>
		<div id="pagination"></div>
		<script type="text/javascript" src="<? echo base_url('js/plugins/jquery-1.10.2.js')?>"></script>
		<script src="<?php echo base_url('js/plugins/handlebars-v1.3.0.js') ?>"></script> 
		<script>
			var base_url = "<?php echo base_url(); ?>";
			var url = "admin/user/mekanik_table/";	
			
			function populate_filter(data){
				$('#f_nik').val(data.nik);
				$('#f_nama').val(data.nama);
				$('#f_dispname').val(data.dispname);
				$('#f_kota').val(data.kota);
				$('#f_no_telp').val(data.no_telp);
				$('#f_keahlian').val(data.keahlian);
			}
		</script>
		<script src="<? echo base_url('js/common-table.js')?>"></script>
	</body>
</html>