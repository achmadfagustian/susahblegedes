<div class="form-wrap-dialog">
	<form class="stdform-dialog" id="common-stock-form" method="POST" action="#">
		<div id="blue-top">
			<table width="98%">
				<tr>
					<td class="label-search"><label>Search : </label></td>
					<td>
						<span class="field">
							<input type="text" name="search" id="search" value="<?php echo isset($search)?$search:""?>" tabindex="1"/>
						</span>
						<input type="hidden" name="pit_no" id="pit_no" value="<?php echo isset($pit_no)?$pit_no:""?>"/>
					</td>
				</tr>
			</table>
		</div>
		<div style="clear:both"></div>
		<hr/>
		<div id="ajaxDataList"></div>
		<div style="clear:both"></div>
	</form>    
</div>
<script>
	var refresh_table_url = "<?php echo site_url('common/total_finish_index')?>";
	
	jQuery(function($){
		i = 0;
		var refreshTable = function(){
			i = 0;
			$('#ajaxDataList').load(refresh_table_url,$('#common-stock-form').serialize(), function() {});
		};
		refreshTable();
		
		$('#common-stock-form').submit(function(){
			refreshTable();
			return false;
		})
		
		$('#search').focus();
	});
</script>