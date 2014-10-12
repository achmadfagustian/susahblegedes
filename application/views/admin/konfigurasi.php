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
					<div id="ajaxDataList"></div>
				</form>
			</div>
		</div>
	</div>
	<div id="dialog">
		<form method="POST" action="#" id="form-data">
			<table id="form-dialog">
				<tr>
					<td class="label" width="150px"><label>Nama : </label></td>
					<td><span class="field"><input type="text" name="nama" id="nama" readonly="readonly"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Value 1 : </label></td>
					<td><span class="field"><input type="text" name="value1" id="value1"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Value 2 : </label></td>
					<td><span class="field"><input type="text" name="value2" id="value2"/></span></td>
				</tr>
			</table>
		</form>
	</div>
	<script>
		var i = 0;
		
		function pagination_change(){
			i = 0;
		};
		
		var refresh_table_url = "<?php echo site_url('admin/konfigurasi/konfigurasi_table_index')?>";
		var dialog_save_url = "<?php echo site_url('admin/konfigurasi/konfigurasi_save')?>";
		var multiple_del_url = "";
		var get_data_url = "<?php echo site_url('admin/konfigurasi/konfigurasi_get_data')?>/";
		
		var attr_add = {title: ""};
		var attr_edit = {title: "Ubah Konfigurasi"};
		var attr_search = {title: ""};
		var width_form = 600;
		var height_form = 260;
		var width_filter = 600;
		var height_filter = 260;
		
		function clearForm(){
			$('#form-dialog input').val('');
		};
		
		function setOtherData(){
		};
		
	</script>
	<script src="<? echo base_url('js/common-form.js')?>"></script>