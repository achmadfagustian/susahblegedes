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
							<th class="head1">Nama Item</th>
							<th class="head0">Satuan</th>
							<th class="head1">Qty</th>
							<th class="head0">Harga</th>
							<th class="head1">Disc%</th>
							<th class="head0">Diskon</th>
							<th class="head1">Sub Total</th>
						</tr>
					</thead>
					<tbody>
						{{#if results}}
							{{#each results}}
							<tr id="{{nik}}">
								<td class="chkbox"><input type="checkbox" class="chkbox-input" value="{{id_perusahaan}}"/></td>
								<td>{{kode_barang}}</td>
								<td>{{nama}}</td>
								<td>{{kode_satuan}}</td>                                               
								<td>{{qty}}</td>
								<td>{{harga}}</td>
								<td>{{diskon}}</td>
								<td>{{diskon_total}}</td>  
								<td>{{sub_total}}</td>                                                                    
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
			<input type="hidden" name="no_polisi" value="<?php echo htmlspecialchars($no_polisi);?>"/>
            <input type="hidden" name="id_customer" value="<?php echo htmlspecialchars($id_customer);?>"/>

		</form>
		<div id="pagination"></div>
		<script type="text/javascript" src="<?php echo base_url('js/plugins/jquery-1.10.2.js')?>"></script>
		<script src="<?php echo base_url('js/plugins/handlebars-v1.3.0.js') ?>"></script> 
		<script>
			var base_url = "<?php echo base_url(); ?>";
			var url = "admin/report/penjualan_table/";	
			
			function populate_filter(data){
				
			}
		</script>
		<script src="<?php echo base_url('js/common-table.js')?>"></script>
	</body>
</html>