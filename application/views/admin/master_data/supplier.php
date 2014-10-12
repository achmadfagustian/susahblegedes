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
			<div id="form-dialog"> 
				<div class="part-50-only">
					<table class="full">
						<tr>
							<td class="label" width="150px"><label>Kode : </label></td>
							<td><span class="field">
							  <input type="text" name="kode_supplier" id="kode_supplier" maxlength="20" required="required" oninvalid="this.setCustomValidity('Kode Supplier harus diisi')" oninput="setCustomValidity('')"/>
							</span></td>
						</tr>
						<tr>
							<td class="label"><label>Nama Supplier : </label></td>
							<td><span class="field">
							  <input type="text" name="nama" id="nama" maxlength="20" required="required" oninvalid="this.setCustomValidity('nama supplier harus diisi')" oninput="setCustomValidity('')"/>
							</span></td>
						</tr>
						<tr>
							<td class="label" style="vertical-align: top;padding-top: 3px;"><label>Alamat : </label></td>
							<td><span class="field"><textarea name="alamat" id="alamat"></textarea></span></td>
						</tr>
						<tr>
							<td class="label"><label>Kota : </label></td>
							<td><span class="field"><input type="text" name="kota" id="kota"/></span></td>
						</tr>
						<tr>
							<td class="label"><label>Kodepos : </label></td>
							<td><span class="field"><input type="text" name="kodepos" id="kodepos"/></span></td>
						</tr>
						<tr>
							<td class="label"><label>Telephone : </label></td>
							<td><span class="field">
							  <input type="text" name="no_telp2" id="no_telp2" maxlength="10" required="required" oninvalid="this.setCustomValidity('no telephone harus diisi')" oninput="setCustomValidity('')"/>
							</span></td>
						</tr>
						<tr>
							<td class="label"><label>FAX : </label></td>
							<td><span class="field"><input type="text" name="no_fax" id="no_fax"/></span></td>
						</tr>
					</table>
				</div>
				<div class="part-50-only">
					<table class="full">
						<tr>
							<td class="label" width="115px"><label>Nama Bank : </label></td>
							<td><span class="field">
							  <input type="text" name="bank" id="bank" maxlength="10" required="required" oninvalid="this.setCustomValidity('nama bank harus diisi')" oninput="setCustomValidity('')"/>
							</span></td>
						</tr>
						<tr>
							<td class="label"><label>No. Account : </label></td>
							<td><span class="field">
							  <input type="text" name="no_account" id="no_account" maxlength="10" required="required" oninvalid="this.setCustomValidity('no account bank harus diisi')" oninput="setCustomValidity('')"/>
							</span></td>
						</tr>
						<tr>
							<td class="label"><label>Atas Nama : </label></td>
							<td><span class="field">
							  <input type="text" name="atas_nama" id="atas_nama" maxlength="10" required="required" oninvalid="this.setCustomValidity('atas nama harus diisi')" oninput="setCustomValidity('')"/>
							</span></td>
						</tr>
					</table>
					<br/><hr/><br/>
					<table class="full">
						<tr>
							<td class="label" width="115px"><label>Kontak Person : </label></td>
							<td><span class="field">
							  <input type="text" name="cp" id="cp" maxlength="10" required="required" oninvalid="this.setCustomValidity('kontak person harus diisi')" oninput="setCustomValidity('')"/>
							</span></td>
						</tr>
						<tr>
							<td class="label"><label>e-Mail : </label></td>
							<td><span class="field">
							  <input type="text" name="email" id="email" maxlength="10" required="required" oninvalid="this.setCustomValidity('email harus diisi')" oninput="setCustomValidity('')"/>
							</span></td>
						</tr>
						<tr>
							<td class="label"><label>Nomor HP : </label></td>
							<td><span class="field">
							  <input type="text" name="no_hp" id="no_hp" maxlength="10" required="required" oninvalid="this.setCustomValidity('no handphone harus diisi')" oninput="setCustomValidity('')"/>
							</span></td>
						</tr>
					</table>
				</div>
				<input type="hidden" name="id_supplier" id="id_supplier"/>
			</div>
		</form>
	</div>
	<div id="dialog-filter">
		<form method="POST" action="#" id="form-filter">
			<div id="form-dialog"> 
				<div class="part-50-only">
					<table class="full">
						<tr>
							<td class="label" width="150px"><label>Kode : </label></td>
							<td><span class="field"><input type="text" name="kode_supplier" id="kode_supplier"/></span></td>
						</tr>
						<tr>
							<td class="label"><label>Nama Supplier : </label></td>
							<td><span class="field"><input type="text" name="nama" id="nama"/></span></td>
						</tr>
						<tr>
							<td class="label"><label>Kota : </label></td>
							<td><span class="field"><input type="text" name="kota" id="kota"/></span></td>
						</tr>
						<tr>
							<td class="label"><label>Kodepos : </label></td>
							<td><span class="field"><input type="text" name="kodepos" id="kodepos"/></span></td>
						</tr>
						<tr>
							<td class="label"><label>Telephone : </label></td>
							<td><span class="field"><input type="text" name="no_telp" id="no_telp"/></span></td>
						</tr>
						<tr>
							<td class="label"><label>FAX : </label></td>
							<td><span class="field"><input type="text" name="no_fax" id="no_fax"/></span></td>
						</tr>
					</table>
				</div>
				<div class="part-50-only">
					<table class="full">
						<tr>
							<td class="label" width="115px"><label>Nama Bank : </label></td>
							<td><span class="field"><input type="text" name="bank" id="bank"/></span></td>
						</tr>
						<tr>
							<td class="label"><label>No. Account : </label></td>
							<td><span class="field"><input type="text" name="no_account" id="no_account"/></span></td>
						</tr>
					</table>
				</div>
			</div>
		</form>
	</div>
	<script>
		var i = 0;
		
		function pagination_change(){
			i = 0;
		};
		
		var refresh_table_url = "<?php echo site_url('admin/master_data/supplier_table_index')?>";
		var dialog_save_url = "<?php echo site_url('admin/master_data/supplier_save')?>";
		var multiple_del_url = "<?php echo site_url('admin/master_data/supplier_multi_delete')?>";
		var get_data_url = "<?php echo site_url('admin/master_data/supplier_get_data')?>/";
		
		var attr_add = {title: "Tambah Supplier"};
		var attr_edit = {title: "Ubah Supplier"};
		var attr_search = {title: "Cari Supplier"};
		var width_form = 930;
		var height_form = 490;
		var width_filter = 930;
		var height_filter = 380;
		
		function clearForm(){
			$('#form-dialog input').val('');
			$('#form-dialog textarea').val('');
			$('#id_supplier').val('');
		};
		
		function setOtherData(){};
	</script>
	<script src="<? echo base_url('js/common-form.js')?>"></script>