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
							<th class="head0">ID Barang</th>
							<th class="head1">Nama</th>
							<th class="head0">Jumlah</th>
						</tr>
					</thead>
					<tbody>
						{{#if results}}
							{{#each results}}
							<tr id="{{id_barang}}">
								<td class="chkbox"><input type="checkbox" class="chkbox-input" value="{{id_perusahaan}}"/></td>
								<td>{{id_barang}}</td>                                                                              
								<td>{{nama}}</td>                                                                                   
								<td>{{jum_stock}}</td>                                                                        
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
			<input type="hidden" name="ajax" value="true"/>
			<input type="hidden" name="nama" value="<?php echo htmlspecialchars($nama);?>"/>
			<input type="hidden" name="id_barang" value="<?php echo htmlspecialchars($id_barang);?>"/>
		</form>
		<div id="pagination"></div>
		<script type="text/javascript" src="<?php echo base_url('js/plugins/jquery-1.10.2.js')?>"></script>
		<script src="<?php echo base_url('js/plugins/handlebars-v1.3.0.js') ?>"></script> 
		<script>
			var base_url = "<?php echo base_url(); ?>";
			var url = "admin/report/stok_barang_table/";	
			
			function populate_filter(data){
				
			}
		</script>
		<script src="<?php echo base_url('js/common-table.js')?>"></script>
	</body>
</html>