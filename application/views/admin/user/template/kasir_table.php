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
							<th class="head0">Role</th>
							<th class="head1">Status</th>
						</tr>
					</thead>
					<tbody>
						{{#if results}}
							{{#each results}}
							<tr id="{{id_main_user}}">
								<td class="chkbox"><input type="checkbox" class="chkbox-input" value="{{id_main_user}}"/></td>
								<td>{{nik}}</td>                                                                                   
								<td>{{nama}}</td>                                                                                   
								<td>{{role_nama}}</td>                                                                                   
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
			<input type="hidden" name="id_role" id="f_id_role" value="<?php echo $id_role?>"/>
			<input type="hidden" name="username" id="f_username" value="<?php echo $username?>"/>
			<input type="hidden" name="dispname" id="f_dispname" value="<?php echo $dispname?>"/>
			<input type="hidden" name="email" id="f_email" value="<?php echo $email?>"/>
			<input type="hidden" name="nik" id="f_nik" value="<?php echo $nik?>"/>
			<input type="hidden" name="nama" id="f_nama" value="<?php echo $nama?>"/>
			<input type="hidden" name="ajax" value="true"/>
		</form>
		<div id="pagination"></div>
		<script type="text/javascript" src="<? echo base_url('js/plugins/jquery-1.10.2.js')?>"></script>
		<script src="<?php echo base_url('js/plugins/handlebars-v1.3.0.js') ?>"></script> 
		<script>
			var base_url = "<?php echo base_url(); ?>";
			var url = "admin/user/kasir_table/";	
			
			function populate_filter(data){
				$('#f_id_role').val(data.id_role);
				$('#f_username').val(data.username);
				$('#f_dispname').val(data.dispname);
				$('#f_email').val(data.email);
				$('#f_nik').val(data.nik);
				$('#f_nama').val(data.nama);
			}
		</script>
		<script src="<? echo base_url('js/common-table.js')?>"></script>
	</body>
</html>