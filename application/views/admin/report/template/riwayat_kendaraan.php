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
    <script type="text/javascript">
 
 //Date picker
	$(function() {
		 
		$( "#txt_date1" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
		$( "#txt_date1" ).datepicker( "option", "dateFormat", "dd.mm.yy");
		//$( "#txt_date1" ).datepicker( "setDate", "<?php echo date('d.m.Y'); ?>" );
		
		
		$( "#txt_date2" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
		$( "#txt_date2" ).datepicker( "option", "dateFormat", "dd.mm.yy" );
		//$( "#txt_date2" ).datepicker( "setDate", "<?php echo date('d.m.Y'); ?>" );	
	});

</script>
    
		<form name="form1" method="POST" action="#" id="form-filter">
		
  <table width="512" border="0">
    <tr>
      <td width="86">Tanggal</td>
      <td width="7">:</td>
      <td width="144"><label for="txt_date1"></label>
      <input type="text" name="txt_date1" id="txt_date1" /></td>
      <td width="22">To</td>
      <td width="11">:</td>
      <td width="216"><label for="txt_date2"></label>
      <input type="text" name="txt_date2" id="txt_date2" /></td>
    </tr>
    <tr>
      <td>Type</td>
      <td>:</td>
      <td colspan="4"><select name="cb_idcab" id="cb_idcab">
        <?php $cabs = $this->fungsi->get_menu_left(1,M_REPORT_A);

foreach ($cab as $cabs)
{ 
?>
<option value="<?php echo $cabs->idcab; ?>" ><?php echo $cabs->cabname; ?></option>
<?php
}
?>  
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Submit" class="button" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
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
		
		function setOtherData(){};
	</script>
	<script src="<?php echo base_url('js/common-form.js')?>"></script>