	<style>
	.form-wrap {
		width: 100%;
	}
	.time{
		width:60px!important;
	}
	</style>
    <div class="">
		<div id="main-content" style="text-align:center;">
			<div class="form-wrap">
				<form class="stdform" method="POST" action="#">
					<div class="btn-top-wrap">
						<input type="button" value="Delete" class="btn-top" id="multiple-del">
						<input type="button" value="Add" class="btn-top" id="add">
						<input type="button" value="Cari" class="btn-top" id="cari">
					</div>
					<div id="ajaxDataList"></div>
				</form>
			</div>
		</div>
	</div>
	<div id="dialog">
		<form method="POST" action="#" id="form-data">
			<table id="form-dialog">
				<tr>
					<td class="label" width="150px"><label>Tipe : </label></td>
					<td><span class="field">
						<select name="tipe" id="tipe">
							<option value="">-- Pilih --</option>
							<option value="<?php echo PUSAT;?>">Pusat</option>
							<option value="<?php echo CABANG;?>">Cabang</option>
						</select>
					</span></td>
				</tr>
				<tr>
					<td class="label" width="150px"><label>Kode : </label></td>
					<td><span class="field"><input type="text" name="kode_perusahaan" id="kode_perusahaan" maxlength="35"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Nama Cabang : </label></td>
					<td><span class="field"><input type="text" name="nama" id="nama" maxlength="50"/></span></td>
				</tr>
				<tr>
					<td class="label" style="vertical-align: top;padding-top: 3px;"><label>Alamat : </label></td>
					<td><span class="field"><textarea name="alamat" id="alamat"></textarea></span></td>
				</tr>
				<tr>
					<td class="label"><label>Kota : </label></td>
					<td><span class="field"><input type="text" name="kota" id="kota" maxlength="30"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Kodepos : </label></td>
					<td><span class="field"><input type="text" name="kodepos" id="kodepos" maxlength="30"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Telephone : </label></td>
					<td><span class="field"><input type="text" name="no_telp" id="no_telp" maxlength="30"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>FAX : </label></td>
					<td><span class="field"><input type="text" name="no_fax" id="no_fax" maxlength="30"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>PIT Mekanik : </label></td>
					<td>
						<table style="width:90%" class="stdtable stdtablecb overviewtable2">
							<colgroup>
								<col class="con0"/>
								<col class="con1" />
								<col class="con0" />
								<col class="con1" />
							</colgroup>
							<thead>
								<tr>
									<th class="head1">Pit No</th>
									<th class="head0">Nama</th>
									<th class="head1">Pit No</th>
									<th class="head0">Nama</th>
								</tr>
							</thead>
							<tbody>
								<tr>
								<?php $i=1; foreach($mekanik as $row){?>
										<td style="width:10%">
											<input type="text" name="pit_no[<?php echo $i-1;?>]" value="" style="width:30px" class="pit_no mkk<?php echo $row->nik?>">
											<input type="hidden" name="nik[<?php echo $i-1;?>]" value="<?php echo $row->nik;?>">
										</td>
										<td style="width:40%">
										<?php echo $row->dispname;?></td>
										<?php if($i%2==0){?>
										</tr><tr>
										<?php }; $i++;?>
								<?php }?>
								<input type="hidden" name="total_mekanik" value="<?php echo $i-1;?>"/>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</table>
			<input type="hidden" name="id_perusahaan" id="id_perusahaan"/>
		</form>
	</div>
	<div id="dialog-filter">
		<form method="POST" action="#" id="form-filter">
			<table id="form-dialog">
				<tr>
					<td class="label" width="150px"><label>Tipe : </label></td>
					<td><span class="field">
						<select name="tipe">
							<option value="">-- Pilih --</option>
							<option value="<?php echo PUSAT;?>">Pusat</option>
							<option value="<?php echo CABANG;?>">Cabang</option>
						</select>
					</span></td>
				</tr>
				<tr>
					<td class="label" width="150px"><label>Kode : </label></td>
					<td><span class="field"><input type="text" name="kode_perusahaan"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Nama Cabang : </label></td>
					<td><span class="field"><input type="text" name="nama"/></span></td>
				</tr>
				<tr>
					<td class="label" style="vertical-align: top;padding-top: 3px;"><label>Alamat : </label></td>
					<td><span class="field"><textarea name="alamat"></textarea></span></td>
				</tr>
				<tr>
					<td class="label"><label>Kota : </label></td>
					<td><span class="field"><input type="text" name="kota"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Kodepos : </label></td>
					<td><span class="field"><input type="text" name="kodepos"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Telephone : </label></td>
					<td><span class="field"><input type="text" name="no_telp"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>FAX : </label></td>
					<td><span class="field"><input type="text" name="no_fax"/></span></td>
				</tr>
			</table>
		</form>
	</div>
	<script>
		var i = 0;
		
		function pagination_change(){
			i = 0;
		};
		
		var refresh_table_url = "<?php echo site_url('admin/cabang/cabang_table_index')?>";
		var dialog_save_url = "<?php echo site_url('admin/cabang/cabang_save')?>";
		var multiple_del_url = "<?php echo site_url('admin/cabang/cabang_multi_delete')?>";
		var get_data_url = "<?php echo site_url('admin/cabang/cabang_get_data')?>/";
		
		var attr_add = {title: "Tambah Pusat/Cabang"};
		var attr_edit = {title: "Ubah Pusat/Cabang"};
		var attr_search = {title: "Cari Pusat/Cabang"};
		var width_form = 600;
		var height_form = 540;
		var width_filter = 600;
		var height_filter = 540;
		
		function clearForm(){
			$('#form-dialog input').val('');
			$('#form-dialog textarea').val('');
			$('#form-dialog select').val('');
			$('#id_perusahaan').val('');
		};
		
		jQuery(function($){
			i = 0;
			var refreshTable = function(){
				i = 0;
				$('#ajaxDataList').load(refresh_table_url,$('#form-filter').serialize(), function() {});
			};
			refreshTable();
			
			$("#dialog").dialog({
			   autoOpen: false,
			   width: width_form,
			   height: height_form,
			   modal: true,
			   buttons: {
				"Save": function() {
					$.post( dialog_save_url, $('#form-data').serialize())
					  .done(function( data ) {
						alert( "Save Successfully" );
						$("#dialog").dialog( "close" );
						clearForm();
						refreshTable();
					  });
				},
				"Cancel": function() {
					$("#dialog").dialog( "close" );
				}
			   }
			});
			
			$("#dialog-filter").dialog({
			   autoOpen: false,
			   width: width_filter,
			   height: height_filter,
			   modal: true,
			   buttons: {
				"Cari": function() {
					$("#dialog-filter").dialog( "close" );
					refreshTable();
				},
				"Cancel": function() {
					$("#dialog-filter").dialog( "close" );
				}
			   }
			});
						
			$('#add').click(function(){
				clearForm();
				$("#dialog").dialog(attr_add);
				$("#dialog").dialog("open");
			});
			
			$('#multiple-del').click(function(){
				var arrId = new Array();
				$('.chkbox-input:checked').each(function(){
					arrId.push($(this).val());
				});
				$.post( multiple_del_url, {'arrId':arrId.toString()})
				  .done(function( data ) {
					alert( "Delete Successfully" );
					$("#dialog").dialog( "close" );
					clearForm();
					refreshTable();
				  });
			});
			
			$('#cari').click(function(){
				$("#dialog-filter").dialog(attr_search);
				$("#dialog-filter").dialog("open");
			});
			
			$('#ajaxDataList').hover(function(){
				if(i==0){
					$('#ajaxDataList tbody tr td').not('.chkbox').click(function(){
						$.getJSON(get_data_url + $(this).parent().attr('id'), function(data) {
							$.each( data, function( key, val ) {
								$('#'+key,'#form-data').val(val);
							});
							$("#dialog").dialog(attr_edit);
							$("#dialog").dialog("open");
							$('.pit_no').val('');
							$(data.perusahaan_mekanik).each(function(key1,val1){
								$('.mkk'+val1.nik_mekanik).val(val1.pit_no);
							});
						});
					});
					i = 1;
				}
			});
		});
	</script>