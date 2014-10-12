	<style>
	.form-wrap {
		width: 100%;
	}
	</style>
	<?php $this->load->view('admin/user/left_menu');?>
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
					<td class="label" width="150px"><label>NIK : </label></td>
					<td><span class="field"><input type="text" name="nik" id="nik"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Nama Lengkap : </label></td>
					<td><span class="field"><input type="text" name="nama" id="nama"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Nama Tampilan : </label></td>
					<td><span class="field"><input type="text" name="dispname" id="dispname"/></span></td>
				</tr>
				<tr>
					<td class="label" style="vertical-align: top;padding-top: 3px;"><label>Alamat : </label></td>
					<td><span class="field"><textarea name="alamat" id="alamat" style="height:70px"></textarea></span></td>
				</tr>
				<tr>
					<td class="label"><label>Kota : </label></td>
					<td><span class="field"><input type="text" name="kota" id="kota"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>No. Telp : </label></td>
					<td><span class="field"><input type="text" name="no_telp" id="no_telp"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Tingkat Keahlian : </label></td>
					<td><span class="field"><select name="keahlian" id="keahlian"><?php echo $keahlian;?></select></span></td>
				</tr>
				<tr>
					<td class="label" style="vertical-align: top;padding-top: 3px;"><label>Keterangan : </label></td>
					<td><span class="field"><textarea name="keterangan" id="keterangan" style="height:70px"></textarea></span></td>
				</tr>
			</table>
			<input type="hidden" name="id_main_user" id="id_main_user"/>
		</form>
	</div>
	<div id="dialog-filter">
		<form method="POST" action="#" id="form-filter">
			<table id="form-dialog">
				<tr>
					<td class="label" width="150px"><label>NIK : </label></td>
					<td><span class="field"><input type="text" name="nik"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Nama Lengkap : </label></td>
					<td><span class="field"><input type="text" name="nama"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Nama Tampilan : </label></td>
					<td><span class="field"><input type="text" name="dispname"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Kota : </label></td>
					<td><span class="field"><input type="text" name="kota"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>No. Telp : </label></td>
					<td><span class="field"><input type="text" name="no_telp"/></span></td>
				</tr>
				<tr>
					<td class="label"><label>Tingkat Keahlian : </label></td>
					<td><span class="field"><select name="keahlian"><?php echo $keahlian;?></select></span></td>
				</tr>
			</table>
		</form>
	</div>
	<script>
		var i = 0;
		
		function pagination_change(){
			i = 0;
		};
		
		var refresh_table_url = "<?php echo site_url('admin/user/mekanik_table_index')?>";
		var dialog_save_url = "<?php echo site_url('admin/user/mekanik_save')?>";
		var multiple_del_url = "<?php echo site_url('admin/user/mekanik_multi_delete')?>";
		var get_data_url = "<?php echo site_url('admin/user/mekanik_get_data')?>/";
		
		var attr_add = {title: "Tambah Mekanik"};
		var attr_edit = {title: "Ubah Mekanik"};
		var attr_search = {title: "Cari Mekanik"};
		var width_form = 600;
		var height_form = 550;
		var width_filter = 600;
		var height_filter = 380;
		
		function clearForm(){
			$('#form-dialog input[type="text"]').val('');
			$('#id_main_user').val('');
			$('#form-dialog select').val('');
			$('#form-dialog textarea').val('');
		}
		
		function setOtherData(){}
	</script>
	<script src="<? echo base_url('js/common-form.js')?>"></script>