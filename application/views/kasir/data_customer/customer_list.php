	<style>
	.form-wrap {
		width: 100%;
	}
	.w-935{
		width:93.5%!important;
	}
	textarea.w-935 {
		margin: 5px 0px;
	}
	</style>
	<div class="vernav iconmenu">
		<?php $this->load->view('kasir/data_customer/left_menu');?>
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
			<div id="blue-top">
				<table width="98%">
					<tr>
						<td class="label-search"><label>Cari : </label></td>
						<td>
							<span class="field">
								<input type="text" name="search" id="search" value="<?php echo isset($search)?$search:""?>" tabindex="1" style="width:100%"/>
							</span>
						</td>
					</tr>
				</table>
			</div>
			<input type="submit" id="submit-filter" style="display:none">
		</form>
	</div>
	<script>
		var i = 0;
		
		function pagination_change(){
			i = 0;
		};
		
		var refresh_table_url = "<?php echo site_url('kasir/data_customer/cust_table_index')?>";
		var dialog_save_url = "";
		var multiple_del_url = "";
		var get_data_url = "";
		
		var attr_search = {title: "Cari Customer"};
		var width_filter = 750;
		var height_filter = 160;
		
		function clearForm(){};
		
		jQuery(function($){
			i = 0;
			var refreshTable = function(){
				i = 0;
				$('#ajaxDataList').load(refresh_table_url,$('#form-filter').serialize(), function() {});
			};
			refreshTable();
			
			$("#dialog-filter").dialog({
			   autoOpen: false,
			   width: width_filter,
			   height: height_filter,
			   modal: true,
			   buttons: {
				"Cari": function() {
					$("#dialog-filter").dialog( "close" );
					refreshTable();
				},
				"Cancel": function() {
					$("#dialog-filter").dialog( "close" );
				}
			   }
			});
						
			$('#add').click(function(){
				clearForm();
				$("#dialog").dialog(attr_add);
				$("#dialog").dialog("open");
			});
			
			$('#multiple-del').click(function(){
				var arrId = new Array();
				$('.chkbox-input:checked').each(function(){
					arrId.push($(this).val());
				});
				$.post( multiple_del_url, {'arrId':arrId.toString()})
				  .done(function( data ) {
					alert( "Delete Successfully" );
					$("#dialog").dialog( "close" );
					clearForm();
					refreshTable();
				  });
			});
			
			$('#cari').click(function(){
				$("#dialog-filter").dialog(attr_search);
				$("#dialog-filter").dialog("open");
			});
			
			var rowClick = function(){
				$('#ajaxDataList tbody tr td').not('.chkbox').click(function(){
					jQuery("body").addClass("loading");
					window.location.href = '<?php echo site_url('kasir/data_customer/form');?>/'+$(this).parent().attr('id');
				});
			};
			
			$('#ajaxDataList').hover(function(){
				if(i==0){
					rowClick();
					i = 1;
				}
			});
			
			$('#ajaxDataList').click(function(){
				rowClick();
				i = 1;
			});
			
			$('#form-filter').submit(function(){
				$('.ui-dialog-buttonset').children().eq(0).click();
				return false;
			});
		});
	</script>