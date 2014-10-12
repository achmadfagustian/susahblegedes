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
							<th class="head0">Status</th>
						</tr>
					</thead>
					<tbody>
						{{#if results}}
							{{#each results}}
							<tr id="{{id_paid_card}}">
								<td class="chkbox"><input type="checkbox" class="chkbox-input" value="{{id_paid_card}}"/></td>
								<td>{{kode_paid_card}}</td>                                                                                   
								<td>{{nama}}</td>                                                                                   
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
							  <tr><td colspan="4">No records found!</tr></td>
						{{/if}}
					</tbody>
				</table>
			</script>
		</div>
		<form method="POST" action="#" id="form-hidden-filter" class="hidden">
			<input type="hidden" name="kode_paid_card" id="f_kode_paid_card" value="<?php echo $kode_paid_card?>"/>
			<input type="hidden" name="nama" id="f_nama" value="<?php echo $nama?>"/>
			<input type="hidden" name="ajax" value="true"/>
		</form>
		<div id="pagination"></div>
		<script type="text/javascript" src="<? echo base_url('js/plugins/jquery-1.10.2.js')?>"></script>
		<script src="<?php echo base_url('js/plugins/handlebars-v1.3.0.js') ?>"></script> 
		<script>
			var base_url = "<?php echo base_url(); ?>";
			var url = "admin/master_data/paid_card_table/";	
			
			function populate_filter(data){
				$('#f_kode_paid_card').val(data.kode_paid_card);
				$('#f_nama').val(data.nama)
			}
		</script>
		<script src="<? echo base_url('js/common-table.js')?>"></script>
	</body>
</html>