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
							<th class="head0">Pemilik</th>
							<th class="head1">No Polisi</th>
							<th class="head0">Tipe</th>
							<th class="head1">Kilometer</th>
							<th class="head0">Mekanik</th>
							<th class="head1">tanggal Register</th>
							<th class="head0">Keterangan</th>
						</tr>
					</thead>
					<tbody>
						{{#if results}}
							{{#each results}}
							<tr id="{{id_customer_history}}">
								<td class="chkbox"><input type="checkbox" class="chkbox-input" value="{{id_customer_history}}"/></td>
								<td>{{pemilik}}</td>                                                                                   
								<td>{{no_polisi}}</td>                                                                                   
								<td>{{jenis}}</td>
								<td>{{km}}</td>                                                                                        
								<td>{{mekanik}}</td>
								<td>{{reg_datetime}}</td>
								<td>{{keterangan}}</td>                                                                                                                
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
		</form>
		<div id="pagination"></div>
		<script type="text/javascript" src="<?php echo base_url('js/plugins/jquery-1.10.2.js')?>"></script>
		<script src="<?php echo base_url('js/plugins/handlebars-v1.3.0.js') ?>"></script> 
		<script>
			var base_url = "<?php echo base_url(); ?>";
			var url = "admin/report/riwayat_table/";	
			
			function populate_filter(data){
				
			}
		</script>
		<script src="<?php echo base_url('js/common-table.js')?>"></script>
	</body>
</html>