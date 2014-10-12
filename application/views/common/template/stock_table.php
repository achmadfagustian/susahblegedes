	<style>
		#result_table2{
			padding:0px;
		}
		#stock_table tbody tr:focus {
			background-color:#32415A!important;
		}
		#stock_table tbody tr:focus td{
			color:#ffffff!important;
		}
	</style>

	<div id="result_table2"></div>
	<div id="result_table">
		<script id="result_template" type="text/x-handlebars-template">
			<table id="stock_table" cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb overviewtable2">
				<colgroup>
					<col class="con0" />
					<col class="con1" />
					<col class="con0" />
					<col class="con1" />
					<col class="con0" />
				</colgroup>
				<thead>
					<tr>
						<th class="head1">KODE</th>
						<th class="head0">NAMA BARANG</th>
						<th class="head1">NAMA ALIAS</th>
						<th class="head0">LOKASI</th>
						<th class="head1">STOCK</th>
					</tr>
				</thead>
				<tbody>
					{{#if results}}
						{{#each results}}
						<tr class="row_table" id="{{id_barang}}" tabindex="{{math @index "+" 1}}">
							<td>{{kode_barang}}</td>                                                                                   
							<td>{{nama}}</td>                                                                                   
							<td>{{nama_alias}}</td>                                                                                  
							<td>{{nama_lokasi}}</td>
							<td>{{stock}}</td>                                                                                  
						</tr>
						{{/each}}
					{{else}}
						  <tr><td colspan="5">No records found!</tr></td>
					{{/if}}
				</tbody>
			</table>
		</script>
	</div>
	<form method="POST" action="#" id="form-hidden-filter" class="hidden">
		<input type="hidden" name="search" id="f_search" value="<?php echo $search?>"/>
		<input type="hidden" name="ajax" value="true"/>
	</form>
	<div id="pagination"></div>
	<script src="<?php echo base_url('js/plugins/handlebars-v1.3.0.js') ?>"></script> 
	<script src="<?php echo base_url('js/general-handlebars.js') ?>"></script> 
	<script>
		var base_url = "<?php echo base_url(); ?>";
		var url = "common/stock_table/";	
		
		function populate_filter(data){
			$('#f_search').val(data.search);
		}
		
		jQuery(function($){
			var source = $("#result_table").html();
			if (source) {
			 
			var result_template = Handlebars.compile(source);
			
			var setClick = function(){
				$('.row_table').click(function(){
					$('.ui-icon-closethick').click();
					$('#'+idRowTemp).children().eq(1).find('.kode_barang').val($(this).children().eq(0).text());
				});
				var currCell = $('#stock_table tbody tr').first();
				$('#stock_table tbody tr').keydown(function (e) {
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
						$('.ui-icon-closethick').click();
						$('#'+idRowTemp).children().eq(1).find('.kode_barang').val(currCell.children().eq(0).text());
					}
					if (c.length > 0) {
						currCell = c;
						currCell.focus();
					}
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