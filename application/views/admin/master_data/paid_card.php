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
					<td><span class="field">
					  <input type="text" name="kode_paid_card" id="kode_paid_card" maxlength="20" required="required" oninvalid="this.setCustomValidity('Kode Paid Card harus diisi')" oninput="setCustomValidity('')"/>
					</span></td>
				</tr>
				<tr>
					<td class="label"><label>Nama Paid Card : </label></td>
					<td><span class="field">
					  <input type="text" name="nama" id="nama" maxlength="20" required="required" oninvalid="this.setCustomValidity('nama paid card harus diisi')" oninput="setCustomValidity('')"/>
					</span></td>
				</tr>
				<tr>
					<td class="label" style="vertical-align: top;padding-top: 3px;"><label>Keterangan : </label></td>
					<td><span class="field"><textarea name="keterangan" id="keterangan"></textarea></span></td>
				</tr>
			</table>
			<input type="hidden" name="id_paid_card" id="id_paid_card"/>
		</form>
	</div>
	<div id="dialog-filter">
		<form method="POST" action="#" id="form-filter">
			<table id="form-dialog">
				<tr>
					<td class="label" width="150px"><label>Kode : </label></td>
					<td><span class="field">
					  <input type="text" name="kode_paid_card" id="kode_paid_card" maxlength="20" required="required" oninvalid="this.setCustomValidity('Kode Paid Card harus diisi')" oninput="setCustomValidity('')"/>
					</span></td>
				</tr>
				<tr>
					<td class="label"><label>Nama Paid Card : </label></td>
					<td><span class="field"><input type="text" name="nama"/></span></td>
				</tr>
			</table>
		</form>
	</div>
	<script>
		var i = 0;
		
		function pagination_change(){
			i = 0;
		};
		
		var refresh_table_url = "<?php echo site_url('admin/master_data/paid_card_table_index')?>";
		var dialog_save_url = "<?php echo site_url('admin/master_data/paid_card_save')?>";
		var multiple_del_url = "<?php echo site_url('admin/master_data/paid_card_multi_delete')?>";
		var get_data_url = "<?php echo site_url('admin/master_data/paid_card_get_data')?>/";
		
		var attr_add = {title: "Tambah Paid Card"};
		var attr_edit = {title: "Ubah Paid Card"};
		var attr_search = {title: "Cari Paid Card"};
		var width_form = 600;
		var height_form = 320;
		var width_filter = 600;
		var height_filter = 210;
		
		function clearForm(){
			$('#form-dialog input').val('');
			$('#form-dialog textarea').val('');
			$('#id_paid_card').val('');
		};
		
		function setOtherData(){};
	</script>
	<script src="<? echo base_url('js/common-form.js')?>"></script>