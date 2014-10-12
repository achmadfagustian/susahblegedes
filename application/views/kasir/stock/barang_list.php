	<style>
	.form-wrap {
		width: 100%;
	}
	</style>
	<div class="vernav iconmenu">
		<?php $this->load->view('kasir/stock/left_menu');?>
	</div>
    <div class="centercontent">
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
	</div>
	<div id="dialog-filter">
		<form method="POST" action="#" id="form-filter">
			<table id="form-dialog">
				<tr>
					<td class="label" width="150px"><label>Kode Barang : </label></td>
					<td><span class="field"><input type="text" name="kode_barang"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Nama Barang : </label></td>
					<td><span class="field"><input type="text" name="nama"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Nama Alias Barang : </label></td>
					<td><span class="field"><input type="text" name="nama_alias"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Jenis Barang : </label></td>
					<td>
						<span class="field">
							<select name="jenis">
								<option value="">-- Pilih -- </option>
								<option value="0">Barang</option>
								<option value="1">Jasa</option>
							</select>
						</span>
					</td>
				</tr>
				<tr>
					<td class="label"><label>Status Barang : </label></td>
					<td>
						<span class="field">
							<select name="status">
								<option value="">-- Pilih -- </option>
								<option value="1">Aktif</option>
								<option value="0">Tidak Aktif</option>
							</select>
						</span>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<script>
		var i = 0;
		
		function pagination_change(){
			i = 0;
		};
		
		var refresh_table_url = "<?php echo site_url('kasir/stock/barang_table_index')?>";
		var dialog_save_url = "";
		var multiple_del_url = "";
		var get_data_url = "";
		
		var attr_add = {title: ""};
		var attr_edit = {title: ""};
		var attr_search = {title: "Cari Barang"};
		var width_form = 600;
		var height_form = 340;
		var width_filter = 600;
		var height_filter = 340;
		
		function clearForm(){};
		
		function setOtherData(){};
	</script>
	<script src="<? echo base_url('js/common-form.js')?>"></script>