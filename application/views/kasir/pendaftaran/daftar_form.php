<style>
	.daftar-customer .form-group{
		margin: 5px 0px!important;
	}
	.pendaftaran input.hasSearch{
		width:50.9%!important;
	}
</style>
    <div class="pendaftaran">
		<div id="main-content" style="text-align:center">
		<div class="form-wrap">
			<form id="daftar-customer" class="stdform" method="POST" action="#">
				<div class="form-wrap-left daftar-customer">
					<div class="form-group" style="padding-top:20px;">
						<label>ID Pelanggan<span class="required">*</span> : </label>
						<span class="field">
							<input type="hidden" name="id_customer" id="id_customer"/>
							<input type="text" name="id_pelanggan" id="id_pelanggan" maxlength="100" required oninvalid="this.setCustomValidity('ID Pelanggan harus diisi')" oninput="setCustomValidity('')" class="hasSearch input-left"/>
						</span>
					</div>
					<div class="form-group">
						<label>No Polisi<span class="required">*</span> : </label>
						<span class="field"><input type="text" name="no_polisi" id="no_polisi" maxlength="15" required oninvalid="this.setCustomValidity('No Polisi harus diisi')" oninput="setCustomValidity('')" class="hasSearch input-left"/></span>
					</div>
					<div class="form-group">
                        <label>Pemilik<span class="required">*</span> : </label>
						<span class="field"><input type="text" name="pemilik" id="pemilik" class="input-left" maxlength="255" required oninvalid="this.setCustomValidity('Pemilik harus diisi')" oninput="setCustomValidity('')"/></span>
                    </div>
					<div class="form-group">
                        <label>Alamat : </label>
						<span class="field"><textarea style="height:80px" name="alamat" id="alamat" class="input-left"></textarea></span>
                    </div>
					<div class="form-group">
						<label>Telepon : </label>
						<span class="field"><input type="text" name="telepon" id="telepon" class="input-left" maxlength="50"/></span>
					</div>
					<div class="form-group">
						<label>Tipe : </label>
						<span class="field"><input type="text" name="tipe" id="tipe" class="input-left" maxlength="50"/></span>
					</div>
					<div class="form-group">
						<label>Merek : </label>
						<span class="field"><input type="text" name="merek" id="merek" class="input-left" maxlength="50"/></span>
					</div>
					<div class="form-group">
						<label>Jenis : </label>
						<span class="field"><input type="text" name="jenis" id="jenis" class="input-left" maxlength="50"/></span>
					</div>
					<div class="form-group">
						<label>Warna : </label>
						<span class="field"><input type="text" name="warna" id="warna" class="input-left" maxlength="100"/></span>
					</div>
					<div class="form-group">
						<label>Tahun Prod. : </label>
						<span class="field"><input type="text" name="tahun_produksi" id="tahun_produksi" class="input-left" maxlength="10"/></span>
					</div>
					<div class="form-group">
						<label>No Rangka : </label>
						<span class="field"><input type="text" name="no_rangka" id="no_rangka" class="input-left" maxlength="100"/></span>
					</div>
					<div class="form-group">
						<label>No Mesin : </label>
						<span class="field"><input type="text" name="no_mesin" id="no_mesin" class="input-left" maxlength="100"/></span>
					</div>
					<div class="form-group">
                        <label>Keterangan : </label>
						<span class="field"><textarea style="height:80px" name="keterangan" id="keterangan" class="input-left"></textarea></span>
                    </div>
				</div>
				<div class="form-wrap-right">
					<div class="form-group" style="clear:both;padding-top:8px;">
						<label class="work-order">Work Order: </label>
					</div>
					<div style="clear:both"></div>
					<div class="form-group" style="height:365px;overflow-y:scroll">
						<table id="table-item">
							<thead>
								<tr>
									<th width="30px">No</th>
									<th width="60px">Kode</th>
									<th>Nama Item</th>
									<th width="60px">Satuan</th>
									<th width="20px">QTY</th>
									<th width="90px">Harga</th>
									<th width="50px">DISC %</th>
									<th width="90px">Diskon</th>
									<th width="100px">Sub Total</th>
								</tr>
							</thead>
							<tbody>
								<tr id="1">
									<td><span>1</span></td>
									<td><input type="text" name="kode_barang[]" class="kode_barang hasSearchMini"/></td>
									<td><span class="nama_span data_span"></span><input type="hidden" name="nama[]" class="nama data_text"/></td>
									<td><span class="satuan_span data_span"></span><input type="hidden" name="satuan[]" class="satuan data_text"/></td>
									<td><input type="text" name="qty[]" class="qty data_text"/></td>
									<td><span class="harga_span data_span"></span><input type="hidden" name="harga[]" class="harga data_text"/></td>
									<td><input type="text" name="diskon[]" class="diskon data_text"/></td>
									<td><input type="text" name="diskon_total[]" class="diskon_total data_text"/></td>
									<td><span class="sub_total_span data_span"></span><input type="hidden" name="sub_total[]" class="sub_total data_text"/></td>
								</tr>
							</tbody>
						</table>
						<table id="table-item-clone" style="display:none">
							<tr id="1">
								<td><span class="no_last_temp">1</span></td>
								<td><input type="text" name="kode_barang[]" class="kode_barang hasSearchMini"/></td>
								<td><span class="nama_span data_span"></span><input type="hidden" name="nama[]" class="nama data_text"/></td>
								<td><span class="satuan_span data_span"></span><input type="hidden" name="satuan[]" class="satuan data_text"/></td>
								<td><input type="text" name="qty[]" class="qty data_text"/></td>
								<td><span class="harga_span data_span"></span><input type="hidden" name="harga[]" class="harga data_text"/></td>
								<td><input type="text" name="diskon[]" class="diskon data_text"/></td>
								<td><input type="text" name="diskon_total[]" class="diskon_total data_text"/></td>
								<td><span class="sub_total_span data_span"></span><input type="hidden" name="sub_total[]" class="sub_total data_text"/></td>
							</tr>
						</table>
					</div>
					<div class="form-group">
						<label class="title-keluhan">Keluhan : </label>
						<span class="field"><textarea name="keluhan" id="keluhan" style="height:140px;width:75%"></textarea></span>
					</div>
				</div>
				<div style="clear:both;padding-bottom:10px"></div>
				<div class="form-button">
					<input type="button" value="Reset" id="reset_all"/>
					<input type="submit" value="Submit" id="submit_all"/>
				</div>
			</form>   
		</div>
        </div>
		</div>
	</div><!-- centercontent -->
	<div id="dialog"></div>
	<div id="dialog_stock"></div>
	<script>
		var idRowTemp = "";
		var kodeTemp = "";
		var no = 1;
		function showDialog(url){
			$("#dialog").load(url);
			$("#dialog").dialog("open");         
		}
		function showDialogStock(url){
			$("#dialog_stock").load(url);
			$("#dialog_stock").dialog("open");         
		}
		jQuery(function($){
			$('.input-left').bind('keypress', function(event) {
				if( event.which === 5 && event.ctrlKey ) {
					$('#table-item tbody').children().eq(0).find('.kode_barang').focus();
				}
			});
		
			$("#dialog").dialog({
			   autoOpen: false,
			   width: 980,
			   modal: true
			});
			
			$("#dialog_stock").dialog({
			   autoOpen: false,
			   width: 980,
			   modal: true,
			   title: "Stock"
			});
			
			var attr = {title: "History Kendaraan",buttons: {
							"Select": function() {
								$('#id_pelanggan').val($('#id_pelanggan_hk').val());
								$('#no_polisi').val($('#no_polisi_hk').val());
								$( this ).dialog( "close" );
								processIdPelanggan();
							},
							"Cancel": function() {
								$( this ).dialog( "close" );
							}
						},height: 600};
						
			$('#id_pelanggan').bind('keypress', function(event) {
				$(this).val($.trim($(this).val()));
				if( event.which === 32 && event.ctrlKey ) {
					$("#dialog").dialog(attr);
					showDialog("<?php echo site_url('common/history_kendaraan/id_pelanggan')?>/"+$('#id_pelanggan').val());	
				}	
			});
			
			$('#no_polisi').bind('keypress', function(event) {
				$(this).val($.trim($(this).val()));
				if( event.which === 32 && event.ctrlKey ) {
					$("#dialog").dialog(attr);
					showDialog("<?php echo site_url('common/history_kendaraan/no_polisi')?>/"+$('#no_polisi').val());
				}	
			});
			var populateForm = function(data){
				$.each( data, function( key, val ) {
					$('#'+key,'#daftar-customer').val(val);
				});
			};
			var processRes1 = function(data){
				populateForm(data);
			};
			
			var processIdPelanggan = function(){
				$.post( '<?php echo site_url('common/get_customer/id_pelanggan')?>', { val: $('#id_pelanggan').val() }, function( data ) {
					if(data.result==1){
						processRes1(data);
					}else{
						clearForm('id_pelanggan');
					}
				}, "json");
			};
			var processNoPolisi = function(){
				$.post( '<?php echo site_url('common/get_customer/no_polisi')?>', { val: $('#no_polisi').val() }, function( data ) {
					if(data.result==1){
						processRes1(data);
					}else{
						clearForm('no_polisi');
					}
				}, "json");
			}
			$('#id_pelanggan').autocomplete({
				source: "<?php echo site_url('common/get_id_pelanggan')?>",
				select: function( event, ui ) {
					processIdPelanggan();
				},
				minLength:3
			});
			
			$('#no_polisi').autocomplete({
				source: "<?php echo site_url('common/get_no_polisi')?>",
				select: function( event, ui ) {
					processNoPolisi();
				},
				minLength:3
			});
			
			var clearForm = function(notId){
				if(notId=="id_pelanggan"){
					$('#daftar-customer input[type="text"]').not('#'+notId).val('');
				}else if(notId=="no_polisi"){
					$('#daftar-customer input[type="text"]').not('#id_pelanggan,#no_polisi').val('');
					$('#pemilik').focus();
				}else{
					$('#daftar-customer input[type="text"]').val('');
				}
				$('#daftar-customer textarea').val('');
			};
			
			$('#id_pelanggan').change(function(){
				processIdPelanggan();
			});
			
			$('#no_polisi').change(function(){
				processNoPolisi();
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
					if( event.which === 2 && event.ctrlKey ) {$('#id_pelanggan').focus();}
					
				});
				$('.qty').bind('keypress', function(event) {
					if( event.which === 5 && event.ctrlKey ) {$('#keluhan').focus();}
					if( event.which === 2 && event.ctrlKey ) {$('#id_pelanggan').focus();}
				});
				$('.diskon').bind('keypress', function(event) {
					if( event.which === 5 && event.ctrlKey ) {$('#keluhan').focus();}
					if( event.which === 2 && event.ctrlKey ) {$('#id_pelanggan').focus();}
				});
				$('.diskon_total').bind('keypress', function(event) {
					if( event.which === 5 && event.ctrlKey ) {$('#keluhan').focus();}
					if( event.which === 2 && event.ctrlKey ) {$('#id_pelanggan').focus();}
				});
				
				var procKodeBarang = function(ob){
					var obj = ob.parent().parent();
					$.post( '<?php echo site_url('common/get_barang')?>', {kode:ob.val()}, function( data ) {
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
					}, "json");
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
			sItemProcess();
			
			$('table#table-item').on('keydown', 'input', function (e) {
				var keyCode = e.keyCode;
				if (keyCode !== 9) return;
				$lastTr = $('tr:last', $('table#table-item'));
				if ($(e.target).parent().parent().is($lastTr) && $(e.target).hasClass('diskon_total')) {
					$lastTrClone = $('tr:last', $('table#table-item-clone'));
					$lastTr.after($lastTrClone.clone());
					no++;
					$('tr:last', $('table#table-item')).attr('id',no);
					$('tr:last', $('table#table-item')).find('.no_last_temp').text(no);
					$('tr:last', $('table#table-item')).find('.no_last_temp').removeClass('no_last_temp');
					sItemProcess();
				}
			});
			
			$('#daftar-customer').submit(function(){
				$.post( '<?php echo site_url('kasir/pendaftaran/save')?>', $('#daftar-customer').serialize()).done(function( data ) {
					alert( "Save Successfully" );
					jQuery("body").addClass("loading");
					location.reload();
				});
				return false;
			});
			
		});
	</script>