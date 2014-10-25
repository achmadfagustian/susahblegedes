	<style>
	.form-wrap {
		width: 100%;
	}
	</style>
	<?php $this->load->view('admin/report/left_menu');?>
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
			<table width="512" border="0">
		    <tr>
		      	<td width="100">Nama</td>
		      	<td width="7">:</td>
		      	<td width="200"><input type="text" name="nama"/></td>
		    </tr>
		    <tr>
		      	<td width="100">NIK</td>
		      	<td width="7">:</td>
		     	<td width="100"><input type="text" name="nik"/></td>
		    </tr>
		    <tr>
		      	<td width="100">Tanggal</td>
		      	<td width="7">:</td>
		     	<td width="100">
		     		<span class="field">
		     			<input type="text" name="date_from" class="element" id="date_from" value="<?php echo set_value('date_from', isset($default['date_from']) ? $default['date_from'] : ''); ?>" size="10" maxlength="12" /></td>
		    		</span>
		    </tr>
		    <tr>
		      	<td width="100">Tanggal</td>
		      	<td width="7">:</td>
		     	<td width="100">
		     		<span class="field">
		     			<input type="text" name="date_to" class="element" id="date_to" value="<?php echo set_value('date_to', isset($default['date_to']) ? $default['date_to'] : ''); ?>" size="10" maxlength="12" /></td>
		    		</span>
		    </tr>		    
		  </table>
		</form>
	</div>

	<script type="text/javascript" src="<?php echo base_url('js/plugins/jquery.maskedinput.js')?>"></script>
	<script>		
		$(function() {
			$('#date_from').datepicker({
				buttonImageOnly: false,
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd-mm-yy"
			}).val()
		});
	
		$(function(){
			$("#date_from").mask("99-99-9999");
		})
	</script>


	<script>
		var i = 0;
		
		function pagination_change(){
			i = 0;
		};
		
		var refresh_table_url = "<?php echo site_url('admin/report/absensi_table_index')?>";
		var dialog_save_url = "";
		var multiple_del_url = "";
		var get_data_url = "";
		
		var attr_add = {title: ""};
		var attr_edit = {title: ""};
		var attr_search = {title: "Cari Absensi"};
		var width_form = 600;
		var height_form = 490;
		var width_filter = 600;
		var height_filter = 380;
		
		function clearForm(){
			$('#form-dialog input').val('');
			$('#form-dialog textarea').val('');
			$('#id_perusahaan').val('');
		};
		
		
	</script>
	<script src="<?php echo base_url('js/common-form.js')?>"></script>