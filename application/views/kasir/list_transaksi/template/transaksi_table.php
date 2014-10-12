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
						<col class="con0" />
					</colgroup>
					<thead>
						<tr>
							<th class="head1">Pemilik</th>
							<th class="head0">No Polisi</th>
							<th class="head1">Jenis Motor</th>
							<th class="head0" width="115px">Waktu Pendaftaran</th>
							<th class="head1">Mulai Pengerjaan</th>
							<th class="head0">Selesai Pengerjaan</th>
							<th class="head1">Cancel</th>
							<th class="head0">Sumber</th>
							<th class="head1">Status</th>
						</tr>
					</thead>
					<tbody>
						{{#if results}}
							{{#each results}}
							<tr id="{{id_customer}}">
								<td>{{pemilik}}</td>                                                                                   
								<td>{{no_polisi}}</td>                                                                                   
								<td>{{jenis}}</td>                                                                                   
								<td>{{reg_datetime}}</td>                                                                                   
								<td>{{start_datetime}}</td>                                                                                   
								<td>{{finish_datetime}}</td>                                                                                   
								<td>{{cancel_datetime}}</td>                                                                                   
								<td>
									{{#ifCond tipe '==' 1}}
										P
									{{else}}
										C
									{{/ifCond}}
								</td>          
								{{#ifCond finish_datetime '==' NULL}}
									<td class="red"></td>
								{{else}}
									<td class="green"></td>
								{{/ifCond}}								
							</tr>
							{{/each}}
						{{else}}
							  <tr><td colspan="9">No records found!</tr></td>
						{{/if}}
					</tbody>
				</table>
			</script>
		</div>
		<form method="POST" action="#" id="form-hidden-filter" class="hidden">
			<input type="hidden" name="pemilik" id="f_pemilik" value="<?php echo $pemilik?>"/>
			<input type="hidden" name="no_polisi" id="f_no_polisi" value="<?php echo $no_polisi?>"/>
			<input type="hidden" name="jenis" id="f_jenis" value="<?php echo $jenis?>"/>
			<input type="hidden" name="tipe" id="f_tipe" value="<?php echo $tipe?>"/>
			<input type="hidden" name="ajax" value="true"/>
		</form>
		<div id="pagination"></div>
		<script type="text/javascript" src="<? echo base_url('js/plugins/jquery-1.10.2.js')?>"></script>
		<script src="<?php echo base_url('js/plugins/handlebars-v1.3.0.js') ?>"></script> 
		<script>
			var base_url = "<?php echo base_url(); ?>";
			var url = "kasir/list_transaksi/table/";	
			
			function populate_filter(data){
				$('#f_pemilik').val(data.pemilik);
				$('#f_no_polisi').val(data.no_polisi);
				$('#f_jenis').val(data.jenis);
				$('#f_tipe').val(data.tipe);
			}
		</script>
		<script src="http://localhost/kings/js/common-table.js')"></script>
	</body>
</html>