<style>
.form-wrap {
	width: 100%;
	padding-top:5px;
}
#button-list {
	padding: 0px;
	text-align: center;
}
#select_mek{
	padding: 8px;
	width: 90%;
	font-size: 16px;
	font-weight: bold;
}
#bottom_cat{
	width:100%;
}
#bottom_cat th{
	width:33%;
}
#bottom_cat td textarea{
	width:90%;
	height:80px;
}
.vernav ul{
	margin:10px 0px;
}
.vernav ul li a{
	padding:2px 0px 0px 35px;
}
#button-list input {
	padding: 5px 18px;
	font-weight: bold;
	font-size: 14px;
}
.ui-tabs .ui-tabs-nav .ui-tabs-anchor{
	padding:.5em 0.5em;
}
.ui-tabs .ui-tabs-nav{
	font-size:12px;
}
.ui-tabs .ui-tabs-nav li{
	margin:3px .2em 0 0;
}
.stdform{
	background-color:white;
}
#tabs{
	margin-bottom:0px;
}
.form-button{
	margin: 0px 10px;
}
</style>
	<div class="vernav iconmenu">
		<div id="button-list">
			<input type="button" value="Register" class="show-trx" id="1"> 
			<input type="button" value="Complaint" class="show-trx" id="2">
			<div style="padding-top:5px;">
				<input type="button" value="Semua" class="show-trx-all">
			</div>
		</div>
		<ul id="cust_left" style="height:500px;overflow-y:scroll">
			<?php foreach($cust_left AS $row){ ?>
				<li class="trx<?php echo $row->tipe;?>">
					<a href="#" id="<?php echo $row->id_customer_history;?>" class="cust_left">
						<span class="pemilik-motor"><?php echo $row->pemilik;?></span><br/>
						<span class="jenis-motor"><?php echo $row->jenis;?> (<?php echo $row->no_polisi;?>)</span>
					</a>
				</li>
			<?php }?>
		</ul>
		<a class="togglemenu"></a>
		<br /><br />
	</div><!--leftmenu-->
	
	<div class="centercontent">
		<div id="main-content" style="text-align:center">
			<div class="form-wrap">
				<div id="tabs">
					<ul>
						<?php $i=0; foreach($mek_pit AS $row){ ?>
							<li class="head-tab <?php echo($i==0)?'current':''?>" pit="<?php echo $row->pit_no;?>">
								<a href="#pit<?php echo $row->pit_no;?>" class="<?php echo($row->not_available==1)?"red":"green";?>">
									Pit <?php echo $row->pit_no;?> (<?php echo $row->nama;?>)
								</a>
							</li>
						<?php $i=1; }?>
					</ul>
					<?php foreach($mek_pit AS $row){ ?>
						<div id="pit<?php echo $row->pit_no;?>">
							<form class="stdform" id="data-customer-form" method="POST" action="">
								<?php $this->load->view("kasir/service/pit_content");?>
								<input type="submit" value="Submit" style="display:none"/>
							</form>
						</div>
					<?php }?>
				</div>
				<div style="clear:both"></div>				
				<div class="form-button">
					<div style="float:left">
						<input type="button" value="" class="green total-finish"/>
					</div>
					<input type="hidden" id="id_cust_hist_temp" class="temp">
					<input type="button" id="btn_save" value="Save" class="bottom-input"/>
					<input type="button" id="btn_finish" class="btn-submit" value="Finish"/>
				</div>
			</div>
		</div>
	</div>
	<div id="dialog"></div>
	<div id="dialog-assign">
		<form method="POST" action="#" id="form-filter">
			<table id="form-dialog" style="padding-top:5px">
				<tr style="text-align:center;">
					<td>
						<span class="field">
							<select name="pit_mek" id="select_mek">
									<option value="">-- Pilih --</option>
								<?php foreach($mek_pit AS $row){ if($row->not_available==0){?>
									<option value="<?php echo $row->nik;?>&&<?php echo $row->pit_no;?>">Pit <?php echo $row->pit_no;?> (<?php echo $row->nama;?>)</option>
								<?php }}?>
							</select>
						</span>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div id="dialog_stock"></div>
	<script>
		var pitNo = "pit1";
		var idRowTemp = "";
		var kodeTemp = "";
		function showDialog(id,url){
			$("#"+id).load(url);
			$("#"+id).dialog("open");         
		}
		function showDialogStock(url){
			$("#dialog_stock").load(url);
			$("#dialog_stock").dialog("open");         
		}
		jQuery(function($){
			$( "#tabs" ).tabs();
			$('.bottom-input').hide();
			$("#dialog").dialog({
			   autoOpen: false,
			   height: 450,
			   width: 950,
			   modal: true
			});
			
			$("#dialog_stock").dialog({
			   autoOpen: false,
			   width: 980,
			   modal: true,
			   title: "Stock"
			});
			
			var calculateSubTotal = function(qty,harga,diskon,diskon_total){
				qty = parseFloat((qty=="")?0:qty);
				harga = parseFloat((harga=="")?0:harga);
				diskon = parseFloat((diskon=="")?0:diskon);
				diskon_total = parseFloat((diskon_total=="")?0:diskon_total);
				return (qty * harga) - ((diskon/100)*((qty * harga))) - diskon_total;
			};
			
			var processCalcSubTotal = function(obj){
				var sub_total = calculateSubTotal(obj.find('.qty').val(),obj.find('.harga').val(),obj.find('.diskon').val(),obj.find('.diskon_total').val());
				obj.find('.sub_total_span').text(sub_total);
				obj.find('.sub_total').val(sub_total);
			};
			
			var sItemProcess = function(){
				$('.kode_barang').bind('keypress', function(event) {
					$(this).val($.trim($(this).val()));
					if( event.which === 32 && event.ctrlKey ) {
						kodeTemp = $(this).val();
						idRowTemp = $(this).parent().parent().attr('id');
						showDialogStock("<?php echo site_url('common/stock')?>/"+$(this).val());
					}
					if( event.which === 5 && event.ctrlKey ) {$('#keluhan').focus();}
				});
				$('.qty').bind('keypress', function(event) {
					if( event.which === 5 && event.ctrlKey ) {$('#keluhan').focus();}
				});
				$('.diskon').bind('keypress', function(event) {
					if( event.which === 5 && event.ctrlKey ) {$('#keluhan').focus();}
				});
				$('.diskon_total').bind('keypress', function(event) {
					if( event.which === 5 && event.ctrlKey ) {$('#keluhan').focus();}
				});
				
				var procKodeBarang = function(ob){
					var obj = ob.parent().parent();
					$.getJSON('<?php echo site_url('common/get_barang')?>/' + ob.val(), function(data) {
						if(data.result==1){
							obj.find('.nama_span').text(data.nama);
							obj.find('.nama').val(data.nama);
							obj.find('.satuan_span').text(data.satuan);
							obj.find('.satuan').val(data.satuan);
							obj.find('.harga_span').text(data.harga);
							obj.find('.harga').val(data.harga);
						}else{
							obj.find('.data_span').text('');
							obj.find('.data_text').val('');
						}
					});
					processCalcSubTotal(obj);
				};
				$('.kode_barang').focus(function() {
					kodeTemp = $(this).val();
				});
				$('.kode_barang').change(function(){
					procKodeBarang($(this));
				});
				$('.kode_barang').focusout(function() {
					if($.trim(kodeTemp)!=$.trim($(this).val())){
						procKodeBarang($(this));
					}
				});
				
				$('.qty').change(function(){
					var obj = $(this).parent().parent();
					processCalcSubTotal(obj);
				});
				$('.diskon').change(function(){
					var obj = $(this).parent().parent();
					processCalcSubTotal(obj);
				});
				$('.diskon_total').change(function(){
					var obj = $(this).parent().parent();
					processCalcSubTotal(obj);
				});
				
			};
			var clearPitContent = function(){
				$('#table-item tbody').html('');
				$('.pemilik').text('');
				$('.jenis').text('');
				$('.no_polisi').text('');
				$('.start_datetime').text('');
				$('.status').text('');
				$('.keluhan').text('');
				$('.diganti').text('');
				$('.keterangan').text('');
				$('.bottom-input').hide();
			};
			
			var processPopulateData = function(pit_no,data){
				pitNo = 'pit'+pit_no;
				if(data.result==1){
					$('.id_customer','#pit'+pit_no).val(data.dat_cust.id_customer);
					$('.id_customer_history','#pit'+pit_no).val(data.dat_cust_hist.id_customer_history);
					$('.pemilik','#pit'+pit_no).text(data.dat_cust.pemilik);
					$('.jenis','#pit'+pit_no).text(data.dat_cust.jenis);
					$('.no_polisi','#pit'+pit_no).text(data.dat_cust.no_polisi);
					$('.start_datetime','#pit'+pit_no).text(data.dat_cust_hist.start_datetime);
					$('.status','#pit'+pit_no).addClass('red').text('Dikerjakan');
					$('.keluhan','#pit'+pit_no).text(data.dat_cust_hist.keluhan);
					$('.diganti','#pit'+pit_no).text(data.dat_cust_hist.diganti);
					$('.keterangan','#pit'+pit_no).text(data.dat_cust_hist.keterangan);
					$('.bottom-input').show();
					
					$('#'+pitNo+' table#table-item tbody').html('');
					var no=0;
					$.each( data.dat_cust_hist_det, function(i, d) {
						no++;
						var tr = "<tr id='svc"+(i+1)+"'>";
							tr+="<td><span>"+(i+1)+"</span></td>";
							tr+="<td><input type='text' name='kode_barang[]' class='kode_barang hasSearchMini' value='"+d.kode_barang+"'/></td>";
							tr+="<td><span class='nama_span data_span'>"+d.nama+"</span><input type='hidden' name='nama[]' class='nama data_text' value='"+d.nama+"'/></td>";
							tr+="<td><span class='satuan_span data_span'>"+d.kode_satuan+"</span><input type='hidden' name='kode_satuan[]' class='satuan data_text' value='"+d.kode_satuan+"'/></td>";
							tr+="<td><input type='text' name='qty[]' class='qty data_text' value='"+d.qty+"'/></td>";
							tr+="<td><span class='harga_span data_span'>"+d.harga+"</span><input type='hidden' name='harga[]' class='harga data_text' value='"+d.harga+"'/></td>";
							tr+="<td><input type='text' name='diskon[]' class='diskon data_text' value='"+d.diskon+"'/></td>";
							tr+="<td><input type='text' name='diskon_total[]' class='diskon_total data_text' value='"+d.diskon_total+"'/></td>";
							tr+="<td><span class='sub_total_span data_span'>"+d.sub_total+"</span><input type='hidden' name='sub_total[]' class='sub_total data_text' value='"+d.sub_total+"'/></td>";
							tr+="</tr>";
						$('#table-item').append(tr);
					});
					sItemProcess();
					
					$('#'+pitNo+' table#table-item').on('keydown', 'input', function (e) {
						var keyCode = e.keyCode;
						if (keyCode !== 9) return;
						$lastTr = $('tr:last', $('table#table-item'));
						if ($(e.target).parent().parent().is($lastTr) && $(e.target).hasClass('diskon_total')) {
							$lastTrClone = $('tr:last', $('#'+pitNo+' table#table-item-clone'));
							$lastTr.after($lastTrClone.clone());
							no++;
							$('tr:last', $('#'+pitNo+' table#table-item')).attr('id',"scv"+no);
							$('tr:last', $('#'+pitNo+' table#table-item')).find('.no_last_temp').text(no);
							$('tr:last', $('#'+pitNo+' table#table-item')).find('.no_last_temp').removeClass('no_last_temp');
							sItemProcess();
						}
					});
				}else{
					clearPitContent();
				};
				$('.total-finish').val('Total Finish '+data.total_finish);

			};
			
			var populateData = function(nik,pit_no){
				$.getJSON('<?php echo site_url('kasir/service/get_customer_trx_save')?>/'+$('#id_cust_hist_temp').val()+'/' + nik + '/'+ pit_no, function(data) {
					processPopulateData(pit_no,data);
				});
			};
			
			$("#dialog-assign").dialog({
			   autoOpen: false,
			   height: 170,
			   width: 650,
			   modal: true,
			   title: "Pilih Pit (Mekanik)",
			   buttons: {
					"Select": function() {
						if($('#select_mek').val()!=""){
							var arrStr = $('#select_mek').val().split("&&");
							//NIK, Pit No
							populateData(arrStr[0],arrStr[1]);
							$('#'+$('#id_cust_hist_temp').val()).parent().remove();
							$('.temp').val('');
						}
						$( this ).dialog( "close" );
					},
					"Cancel": function() {
						$( this ).dialog( "close" );
					}
			   }
			});
			
			$('.show-trx').click(function(){
				$('.trx1').hide();
				$('.trx2').hide();
				$('.trx'+$(this).attr('id')).show();
			});
			$('.show-trx-all').click(function(){
				$('.trx1').show();
				$('.trx2').show();
			});
			
			$('.cust_left').click(function(e){
				e.preventDefault();
				$('#id_cust_hist_temp').val($(this).attr('id'));
				showDialog("dialog-assign");
			});
			
			$('.head-tab').click(function(){
				var pit_no = $(this).attr('pit')
				$.getJSON('<?php echo site_url('common/get_customer_trx')?>/'+pit_no, function(data) {
					processPopulateData(pit_no,data);
				});
			});
			
			$('.total-finish').click(function(){
				$("#dialog").dialog({title: "Total Finish"});
				showDialog("dialog","<?php echo site_url('common/total_finish')?>/"+pitNo.replace(/pit/g, ""));
			});
			
			$('#ui-id-1').click();
			
			$('#'+pitNo+' #data-customer-form').submit(function(){
				$.post( '<?php echo site_url('kasir/service/save/0')?>', $('#'+pitNo+' #data-customer-form').serialize()).done(function( data ) {
					alert( "Save Successfully" );
				});
				return false;
			});
			
			$('#btn_save').click(function(){
				$.post( '<?php echo site_url('kasir/service/save/0')?>', $('#'+pitNo+' #data-customer-form').serialize()).done(function( data ) {
					alert( "Save Successfully" );
				});
				return false;
			});
			
			$('#btn_finish').click(function(){
				$.post( '<?php echo site_url('kasir/service/save/1')?>', $('#'+pitNo+' #data-customer-form').serialize()).done(function( data ) {
					alert( "Save Successfully" );
					location.reload();
				});
				return false;
			});
				
		});
	</script>