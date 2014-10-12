	<style>
	.form-wrap {
		width: 100%;
	}
	</style>
	<?php $this->load->view('admin/master_data/left_menu');?>
    <div class="centercontent">
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
					<td class="label" width="150px"><label>Kode : </label></td>
					<td><span class="field"><input type="text" name="kode_perusahaan" id="kode_perusahaan" maxlength="10" required oninvalid="this.setCustomValidity('kode perusahaan harus diisi')" oninput="setCustomValidity('')"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Nama Perusahaan : </label></td>
					<td><span class="field"><input type="text" name="nama" id="nama" maxlength="20" required oninvalid="this.setCustomValidity('nama perusahaan harus diisi')" oninput="setCustomValidity('')"/></span></td>
				</tr>
				<tr>
					<td class="label" style="vertical-align: top;padding-top: 3px;"><label>Alamat : </label></td>
					<td><span class="field"><input type="text" name="alamat" id="alamat" maxlength="90" required oninvalid="this.setCustomValidity('alamat perusahaan harus diisi')" oninput="setCustomValidity('')"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Kota : </label></td>
					<td><span class="field"><input type="text" name="kota" maxlength="20" id="kota"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Kodepos : </label></td>
					<td><span class="field"><input type="text" maxlength="10" name="kodepos" id="kodepos"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Telephone : </label></td>
					<td><span class="field"><input type="text" name="no_telp" id="no_telp" maxlength="10" required oninvalid="this.setCustomValidity('no telephone harus diisi')" oninput="setCustomValidity('')"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>FAX : </label></td>
					<td><span class="field"><input type="text" maxlength="10" name="no_fax" id="no_fax"/></span></td>
				</tr>
			</table>
			<input type="hidden" name="id_perusahaan" id="id_perusahaan"/>
		</form>
	</div>
	<div id="dialog-filter">
		<form method="POST" action="#" id="form-filter">
			<table id="form-dialog">
				<tr>
					<td class="label" width="150px"><label>Kode : </label></td>
					<td><span class="field">
					  <input type="text" name="kode_perusahaan" id="kode_perusahaan" maxlength="10" required="required" oninvalid="this.setCustomValidity('kode perusahaan harus diisi')" oninput="setCustomValidity('')"/>
					</span></td>
				</tr>
				<tr>
					<td class="label"><label>Nama Perusahaan : </label></td>
					<td><span class="field">
					  <input type="text" name="nama" id="nama" maxlength="20" required="required" oninvalid="this.setCustomValidity('nama perusahaan harus diisi')" oninput="setCustomValidity('')"/>
					</span></td>
				</tr>
				<tr>
					<td class="label"><label>Kota : </label></td>
					<td><span class="field"><input type="text" name="kota"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Kodepos : </label></td>
					<td><span class="field"><input type="text" maxlenth="taksi" name="kodepos"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Telephone : </label></td>
					<td><span class="field">
					  <input type="text" name="no_telp" id="no_telp" maxlength="10" required="required" oninvalid="this.setCustomValidity('no telephone harus diisi')" oninput="setCustomValidity('')"/>
					</span></td>
				</tr>
				<tr>
					<td class="label"><label>FAX : </label></td>
					<td><span class="field">
					  <input type="text" maxlength="10" name="no_fax" id="no_fax"/>
					</span></td>
				</tr>
			</table>
		</form>
	</div>
	<script>
		var i = 0;
		
		function pagination_change(){
			i = 0;
		};
		
		var refresh_table_url = "<?php echo site_url('admin/master_data/kolega_table_index')?>";
		var dialog_save_url = "<?php echo site_url('admin/master_data/kolega_save')?>";
		var multiple_del_url = "<?php echo site_url('admin/master_data/kolega_multi_delete')?>";
		var get_data_url = "<?php echo site_url('admin/master_data/kolega_get_data')?>/";
		
		var attr_add = {title: "Tambah Kolega"};
		var attr_edit = {title: "Ubah Kolega"};
		var attr_search = {title: "Cari Kolega"};
		var width_form = 600;
		var height_form = 490;
		var width_filter = 600;
		var height_filter = 380;
		
		function clearForm(){
			$('#form-dialog input').val('');
			$('#form-dialog textarea').val('');
			$('#id_perusahaan').val('');
		};
		
		function setOtherData(){};
	</script>
	<script src="<? echo base_url('js/common-form.js')?>"></script>