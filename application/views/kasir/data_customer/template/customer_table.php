<html>	
	<head>
	</head>
	<body>
		<div id="result_table2"></div>
		<div id="result_table">
			<script id="result_template" type="text/x-handlebars-template">
				<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb overviewtable2">
					<colgroup>
						<col class="con0" />
						<col class="con1" />
						<col class="con0" />
						<col class="con1" />
						<col class="con0" />
						<col class="con1" />
						<col class="con0" />
						<col class="con1" />
					</colgroup>
					<thead>
						<tr>
							<th class="head1">Id Pelanggan</th>
							<th class="head0">No Polisi</th>
							<th class="head1">Pemilik</th>
							<th class="head0">Tipe</th>
							<th class="head1">Merk</th>
							<th class="head0">Jenis</th>
							<th class="head1">Warna</th>
							<th class="head0">Status</th>
						</tr>
					</thead>
					<tbody>
						{{#if results}}
							{{#each results}}
							<tr id="{{id_customer}}">
								<td>{{id_pelanggan}}</td>                                                                                   
								<td>{{no_polisi}}</td>                                                                                   
								<td>{{pemilik}}</td>                                                                                   
								<td>{{tipe}}</td>                                                                                   
								<td>{{merek}}</td>                                                                                   
								<td>{{jenis}}</td>                                                                                   
								<td>{{warna}}</td>                                                                                   
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
							  <tr><td colspan="8">No records found!</tr></td>
						{{/if}}
					</tbody>
				</table>
			</script>
		</div>
		<form method="POST" action="#" id="form-hidden-filter" class="hidden">
			<input type="hidden" name="search" id="f_search" value="<?php echo $search?>"/>
			<input type="hidden" name="ajax" value="true"/>
		</form>
		<div id="pagination"></div>
		<script type="text/javascript" src="<? echo base_url('js/plugins/jquery-1.10.2.js')?>"></script>
		<script src="<?php echo base_url('js/plugins/handlebars-v1.3.0.js') ?>"></script> 
		<script>
			var base_url = "<?php echo base_url(); ?>";
			var url = "kasir/data_customer/cust_table/";	
			
			function populate_filter(data){
				$('#f_search').val(data.search);
			}
		</script>
		<script src="<? echo base_url('js/common-table.js')?>"></script>
	</body>
</html>