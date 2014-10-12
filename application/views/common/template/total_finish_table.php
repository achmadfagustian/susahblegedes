	<style>
		#result_table2{
			padding:0px;
		}
		#total_finish_table tbody tr:focus {
			background-color:#32415A!important;
		}
		#total_finish_table tbody tr:focus td{
			color:#ffffff!important;
		}
	</style>

	<div id="result_table2"></div>
	<div id="result_table">
		<script id="result_template" type="text/x-handlebars-template">
			<table id="total_finish_table" cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb overviewtable2">
				<colgroup>
					<col class="con0" style="width: 2%" />
					<col class="con1" />
					<col class="con0" />
					<col class="con1" />
					<col class="con0" />
					<col class="con1" />
				</colgroup>
				<thead>
					<tr>
						<th class="head1" nowrap>NO. BILL</th>
						<th class="head0">PEMILIK</th>
						<th class="head1">JENIS MOTOR</th>
						<th class="head0">NO POLISI</th>
						<th class="head1">PENDAFTARAN</th>
						<th class="head0">MULAI PENGERJAAN</th>
						<th class="head1">SELESAI PENGERJAAN</th>
					</tr>
				</thead>
				<tbody>
					{{#if results}}
						{{#each results}}
						<tr class="row_table" id="{{id_customer_history}}" tabindex="{{math @index "+" 1}}">
							<td>{{kode_trx}}</td>                                                                                   
							<td>{{pemilik}}</td>                                                                                   
							<td>{{jenis}}</td>                                                                                   
							<td>{{no_polisi}}</td>                                                                                  
							<td>{{reg_datetime}}</td>
							<td>{{start_datetime}}</td>
							<td>{{finish_datetime}}</td>
						</tr>
						{{/each}}
					{{else}}
						  <tr><td colspan="6">No records found!</tr></td>
					{{/if}}
				</tbody>
			</table>
		</script>
	</div>
	<form method="POST" action="#" id="form-hidden-filter" class="hidden">
		<input type="hidden" name="search" id="f_search" value="<?php echo $search?>"/>
		<input type="hidden" name="pit_no" id="f_pit_no" value="<?php echo $pit_no?>"/>
		<input type="hidden" name="ajax" value="true"/>
	</form>
	<div id="pagination"></div>
	<div id="dialogIn1"></div>
	<script src="<?php echo base_url('js/plugins/handlebars-v1.3.0.js') ?>"></script> 
	<script src="<?php echo base_url('js/general-handlebars.js') ?>"></script> 
	<script>
		var base_url = "<?php echo base_url(); ?>";
		var url = "common/total_finish_table/";	
		
		function populate_filter(data){
			$('#f_search').val(data.search);
			$('#f_pit_no').val(data.pit_no);
		}
		
		function showDialogIn1(url){
			$("#dialogIn1").load(url);
			$("#dialogIn1").dialog("open");         
		}
		
		jQuery(function($){
			$("#dialogIn1").dialog({
			   title: "Detail",
			   autoOpen: false,
			   height: 700,
			   width: 980,
			   modal: true,buttons: {
					"Print": function() {
					},
					"Cancel": function() {
						$( this ).dialog( "close" );
					}
			   }
			});
			
			var source = $("#result_table").html();
			if (source) {
			 
			var result_template = Handlebars.compile(source);
			
			var setClick = function(){
				$('.row_table').click(function(){
					showDialogIn1("<?php echo site_url('common/detail_penjualan')?>/"+$(this).attr('id'));
				});
				var currCell = $('#total_finish_table tbody tr').first();
				$('#total_finish_table tbody tr').keydown(function (e) {
					var c = "";
					if (e.which == 39) {
						// Right Arrow
						c = currCell.next();
					} else if (e.which == 37) { 
						// Left Arrow
						c = currCell.prev();
					} else if (e.which == 38) { 
						// Up Arrow
						c = currCell.prev();
					} else if (e.which == 40) { 
						// Down Arrow
						c = currCell.next();
					} else if (e.which == 13 || e.which == 32) { 
						// Enter or Spacebar
						e.preventDefault();
						showDialogIn1("<?php echo site_url('common/detail_penjualan')?>/"+$(this).attr('id'));	
					}
					if (c.length > 0) {
						currCell = c;
						currCell.focus();
					}
				});
				
				$('.stdtable tbody tr').click(function(){
					showDialogIn1("<?php echo site_url('common/detail_penjualan')?>/"+$(this).attr('id'));
				});
			};
			
			 function load_result(index) {
			  index = index || 0;
			  $.post(base_url + url + index, $('#form-hidden-filter').serialize(), function(data) {
			   $("#result_table").html(result_template({results: data.results}));
			   $("#result_table2").html($("#result_template").html());
			   $('#pagination').html(data.pagination);
			   populate_filter(data);
			   setClick();
			  }, "json");
			 }

			 load_result();
			}

			 $('#pagination').on('click', '.paging_table a', function(e) {
			  e.preventDefault();
			  var link = $(this).attr("href").split(/\//g).pop();
			  load_result(link);
			  pagination_change();
			  return false;
			 });
		});
	</script>