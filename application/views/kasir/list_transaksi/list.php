    <style>
	.form-wrap{
		width:100%;
	}
	</style>
	<div id="main-content" style="text-align:center;">
		<div class="form-wrap">
			<form class="stdform" method="POST" action="#">
				<div class="btn-top-wrap">
					<input type="button" value="Cari" class="btn-top" id="cari">
				</div>
				<div id="ajaxDataList"></div>
			</form>
		</div>
	</div>
	<div id="dialog-filter">
		<form method="POST" action="#" id="form-filter">
			<table id="form-dialog">
				<tr>
					<td class="label" width="150px"><label>Pemilik : </label></td>
					<td><span class="field"><input type="text" name="pemilik"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>No Polisi: </label></td>
					<td><span class="field"><input type="text" name="no_polisi"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Jenis Motor: </label></td>
					<td><span class="field"><input type="text" name="jenis"/></span></td>
				</tr>
			</table>
		</form>
	</div>
	<script>
		var i = 0;
		
		function pagination_change(){
			i = 0;
		};
		
		var refresh_table_url = "<?php echo site_url('kasir/list_transaksi/table_index')?>";
		var dialog_save_url = "";
		var multiple_del_url = "";
		var get_data_url = "";
		
		var attr_add = {title: ""};
		var attr_edit = {title: ""};
		var attr_search = {title: "Cari Transaksi"};
		var width_form = 600;
		var height_form = 420;
		var width_filter = 600;
		var height_filter = 250;
		
		function clearForm(){};
		
		function setOtherData(){};
	</script>
	<script src="http://localhost/kings/js/common-form.js"></script>