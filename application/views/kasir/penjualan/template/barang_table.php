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
							<th class="head0">Kode</th>
							<th class="head1">Nama</th>
							<th class="head0">Nama Alias</th>
							<th class="head1">Jenis</th>
							<th class="head0">Status</th>
						</tr>
					</thead>
					<tbody>
						{{#if results}}
							{{#each results}}
							<tr id="{{id_barang}}">
								<td class="chkbox"><input type="checkbox" class="chkbox-input" value="{{id_barang}}"/></td>
								<td>{{kode_barang}}</td>                                                                                   
								<td>{{nama}}</td>                                                                                   
								<td>{{nama_alias}}</td>                                                                                   
								<td>
									{{#ifCond jenis '==' 0}}
										Barang
									{{else}}
										Jasa
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
							  <tr><td colspan="6">No records found!</tr></td>
						{{/if}}
					</tbody>
				</table>
			</script>
		</div>
		<form method="POST" action="#" id="form-hidden-filter" class="hidden">
			<input type="hidden" name="kode_barang" id="f_kode_barang" value="<?php echo $kode_barang?>"/>
			<input type="hidden" name="nama" id="f_nama" value="<?php echo $nama?>"/>
			<input type="hidden" name="nama_alias" id="f_nama_alias" value="<?php echo $nama_alias?>"/>
			<input type="hidden" name="jenis" id="f_jenis" value="<?php echo $jenis?>"/>
			<input type="hidden" name="status" id="f_status" value="<?php echo $status?>"/>
			<input type="hidden" name="ajax" value="true"/>
		</form>
		<div id="pagination"></div>
		<script type="text/javascript" src="<? echo base_url('js/plugins/jquery-1.10.2.js')?>"></script>
		<script src="<?php echo base_url('js/plugins/handlebars-v1.3.0.js') ?>"></script> 
		<script>
			var base_url = "<?php echo base_url(); ?>";
			var url = "kasir/stock/barang_table/";	
			
			function populate_filter(data){
				$('#f_kode_barang').val(data.kode_barang);
				$('#f_nama').val(data.nama);
				$('#f_nama_alias').val(data.nama_alias);
				$('#f_jenis').val(data.jenis);
				$('#f_status').val(data.status);
			}
		</script>
		<script src="<? echo base_url('js/common-table.js')?>"></script>
	</body>
</html>