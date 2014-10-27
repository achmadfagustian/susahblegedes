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
							<th class="head0">NIK</th>
							<th class="head1">Nama</th>
							<th class="head0">Tanggal Absensi</th>
							<th class="head1">Status</th>
							<th class="head0">Gaji</th>
						</tr>
					</thead>
					<tbody>
						{{#if results}}
							{{#each results}}
							<tr id="{{nik}}">
								<td class="chkbox"><input type="checkbox" class="chkbox-input" value="{{id_perusahaan}}"/></td>
								<td>{{nik}}</td>                                                                                   
								<td>{{nama}}</td>                                                                                   
								<td>{{tgl_abs}}</td>                                                                                   
								<td>
									{{#ifCond status '==' 0}}
										Active (In)
									{{else}}
										{{#ifCond status '==' 1}}
											Active (out)
											{{else}}
											Inactive
										{{/ifCond}}
									{{/ifCond}}
								</td>     
								<td>{{gaji}}</td>                                                                        
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
			<input type="hidden" name="nama" value="<?php echo htmlspecialchars($nama); ?>"/> <!-- This is the way to get data from controler -->
			<input type="hidden" name="nik" value="<?php echo htmlspecialchars($nik); ?>"/>
			<input type="hidden" name="date_from" value="<?php echo htmlspecialchars($date_from); ?>"/>
			<input type="hidden" name="date_to" value="<?php echo htmlspecialchars($date_to); ?>"/>
		</form>
		<div id="pagination"></div>
		<script type="text/javascript" src="<?php echo base_url('js/plugins/jquery-1.10.2.js')?>"></script>
		<script src="<?php echo base_url('js/plugins/handlebars-v1.3.0.js') ?>"></script> 
		<script>
			var base_url = "<?php echo base_url(); ?>";
			var url = "admin/report/absensi_table/";	
		</script>
		<script src="<?php echo base_url('js/common-table.js')?>"></script>
	</body>
</html>