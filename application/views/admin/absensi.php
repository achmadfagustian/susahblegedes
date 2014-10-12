	<style>
	.form-wrap{
		width:80%;
	}
	form input[type=text]{
		width:25%;
	}
	</style>
	<div id="main-content" style="text-align:center">
		<div class="form-wrap">
			<form class="stdform" method="POST" action="<?php echo $form_action ?>" enctype="multipart/form-data">
				<div class="form-group">
					<label>Tanggal : </label>
					<span class="field"><input type="text" name="datepicker1" class="element" id="datepicker1" value="<?php echo set_value('datepicker1', isset($default['datepicker1']) ? $default['datepicker1'] : ''); ?>" size="10" maxlength="12" />  </span>
				</div>
				<div class="form-group">
					<label>Pilih Mesin : </label>
					<span class="field">
						<select name="cb_machine" >
							<?php echo $machine; ?>
						</select>
					</span>
				</div>
				<div class="form-button-child">
					<input name="submit" type="submit" id="button" value="Tampilkan Data" class="button" <?php echo $view_disabled; ?>/>
					<input name="submit" type="submit" id="button" value="Tarik Data" class="button" <?php echo $download_disabled; ?> /> 
				</div>
				<div style="border:1px #999 solid; padding:5px 5px 5px 5px; border-radius:4px; margin:10px;">
				<table width="100%" border="0">
					<tr>
						<td width="45%">
							<!--Total Rows: <?php// echo $totalrow; ?>-->
							<div class="scroll" style="border:1px #999 solid;">
								<?php
									//echo ! empty($search) ? 'Searching found  : <b>'.$total.'</b> rows<br><br>' : '';
									echo ! empty($message) ? $message : '';
									echo ! empty($table) ? $table : '';
									echo ! empty($pagination) ? '<p id="pagination">' . $pagination . '</p>' : '';
								?> 
							</div>
						</td>
						<td width="2%"></td>
						<td width="45%">
							<!--Total Rows: <?php// echo $totalrow2; ?>-->
							<div class="scroll" style="border:1px #999 solid;">
								<?php
									echo ! empty($search2) ? 'Searching found  : <b>'.$total2.'</b> rows<br><br>' : '';
									echo ! empty($message2) ? $message2 : '';
									echo ! empty($table2) ? $table2 : '';
									echo ! empty($pagination2) ? '<p id="pagination">' . $pagination2 . '</p>' : '';
								?> 
							</div>
						</td>
					</tr>
				</table>
				</div>
				<div class="form-clear"></div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="<? echo base_url('js/plugins/jquery.maskedinput.js')?>"></script>
	<script>
		$(function() {
			$('#datepicker1').datepicker({
				buttonImageOnly: false,
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd-mm-yy"
			}).val()
		});
	</script>
	<script>
		$(function(){
			$("#datepicker1").mask("99-99-9999");
		})
	</script>
	