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
					</colgroup>
					<thead>
						<tr>
							<th class="head1"><input type="checkbox" class="checkall"/></th>
							<th class="head0">Kode</th>
							<th class="head1">Nama</th>
							<th class="head0">Kota</th>
							<th class="head1">Status</th>
						</tr>
					</thead>
					<tbody>
						{{#if results}}
							{{#each results}}
							<tr id="{{id_perusahaan}}">
								<td class="chkbox"><input type="checkbox" class="chkbox-input" value="{{id_perusahaan}}"/></td>
								<td>{{kode_perusahaan}}</td>                                                                                   
								<td>{{nama}}</td>                                                                                   
								<td>{{kota}}</td>                                                                                   
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
			<input type="hidden" name="kode_perusahaan" id="f_kode_perusahaan" value="<?php echo $kode_perusahaan?>"/>
			<input type="hidden" name="nama" id="f_nama" value="<?php echo $nama?>"/>
			<input type="hidden" name="kota" id="f_kota" value="<?php echo $kota?>"/>
			<input type="hidden" name="kodepos" id="f_kodepos" value="<?php echo $kodepos?>"/>
			<input type="hidden" name="no_telp" id="f_no_telp" value="<?php echo $no_telp?>"/>
			<input type="hidden" name="no_fax" id="f_no_fax" value="<?php echo $no_fax?>"/>
			<input type="hidden" name="ajax" value="true"/>
		</form>
		<div id="pagination"></div>
		<script type="text/javascript" src="<?php echo base_url('js/plugins/jquery-1.10.2.js')?>"></script>
		<script src="<?php echo base_url('js/plugins/handlebars-v1.3.0.js') ?>"></script> 
		<script>
			var base_url = "<?php echo base_url(); ?>";
			var url = "admin/master_data/kolega_table/";	
			
			function populate_filter(data){
				$('#f_kode_perusahaan').val(data.kode_perusahaan);
				$('#f_nama').val(data.nama)
				$('#f_kota').val(data.kota);
				$('#f_kodepos').val(data.kodepos);
				$('#f_no_telp').val(data.no_telp);
				$('#f_no_fax').val(data.no_fax);
			}
		</script>
		<script src="<?php echo base_url('js/common-table.js')?>"></script>
	</body>
</html>