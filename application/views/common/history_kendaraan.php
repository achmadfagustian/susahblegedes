<style>
	div.form-wrap-dialog .stdtable tbody tr td {
		padding: 2px 5px!important;
	}
	.stdtable thead th{
		padding: 3px 5px!important;
	}
	#table-hist tbody tr:focus {
		background-color:#32415A!important;
	}
	#table-hist tbody tr:focus td{
		color:#ffffff!important;
	}
	#table-hist-det tbody tr:focus {
		background-color:#32415A!important;
	}
	#table-hist-det tbody tr:focus td{
		color:#ffffff!important;
	}
</style>
<div class="form-wrap-dialog">
	<form class="stdform-dialog" method="POST" action="#">
		<div id="blue-top">
			<div class="form-group-top1 group-float">
				<table>
					<tr>
						<td class="label"><label>ID Pelanggan : </label></td>
						<td>
							<span class="field">
								<input type="hidden" name="id_customer" id="id_customer_hk"/>
								<input type="text" name="id_pelanggan" id="id_pelanggan_hk" value="<?php echo $id_pelanggan;?>"/>
							</span>
						</td>
					</tr>
				</table>
			</div>
			<div class="form-group-top2 group-float">
				<table>
					<tr>
						<td class="label"><label>Nama Pemilik : </label></td>
						<td><span class="field"><input type="text" name="pemilik" id="pemilik_hk" disabled="disabled" readonly="readonly" class="inp_hk"/></span></td>
					</tr>
					<tr>
						<td class="label"><label>Tipe Kendaraan : </label></td>
						<td><span class="field"><input type="text" name="tipe" id="tipe_hk" disabled="disabled" readonly="readonly" class="inp_hk"/></span></td>
					</tr>
				</table>
			</div>
			<div class="form-group-top3 group-float">
				<table>
					<tr>
						<td class="label"><label>NO. POLISI : </label></td>
						<td><span class="field"><input type="text" name="no_polisi" id="no_polisi_hk" value="<?php echo $no_polisi;?>"/></span></td>
					</tr>
				</table>
			</div>
			<div style="clear:both"></div>
		</div>
		<hr/>
		<div>
			<div class="form-group2-60">
				<table id="table-hist" class="stdtable stdtablecb overviewtable2">
					<colgroup>
						<col class="con0"/>
						<col class="con1" />
						<col class="con0" />
						<col class="con1" />
						<col class="con0" />
						<col class="con1" />
						<col class="con0" />
						<col class="con1" />
					</colgroup>
					<thead>
						<tr>
							<th class="head1">Bill</th>
							<th class="head0">Tgl Daftar</th>
							<th class="head1">Km</th>
							<th class="head0">Mekanik</th>
							<th class="head1">User</th>
							<th class="head0 hidden">Catatan</th>
							<th class="head1 hidden">Keluhan</th>
							<th class="head0 hidden">Belum Diganti</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<div class="form-group2-40">
				<table style="width:97%">
					<tr>
						<td colspan="2" class="label"><label>::Catatan / Keterangan::</label></td>
					</tr>
					<tr>
						<td colspan="2">
							<textarea id="catatan_hk" disabled="disabled" readonly="readonly" style="height: 62px;"></textarea>
						</td>
					</tr>
					<tr>
						<td class="label"><label>::Keluhan::</label></td>
						<td class="label" style="padding-left:15px"><label>::Spare Part Belum Diganti::</label></td>
					</tr>
					<tr>
						<td>
							<textarea id="keluhan_hk" disabled="disabled" readonly="readonly"></textarea>
						</td>
						<td style="padding-left:15px">
							<textarea id="diganti_hk" disabled="disabled" readonly="readonly"></textarea>
						</td>
					</tr>
				</table>
			</div>
			<div style="clear:both"></div>
		</div>
		<hr/>
		<div>
			<table id="table-hist-det" class="stdtable stdtablecb overviewtable2">
				<colgroup>
					<col class="con0"/>
					<col class="con1" />
					<col class="con0" />
					<col class="con1" />
					<col class="con0" />
					<col class="con1" />
					<col class="con0" />
					<col class="con1" />
					<col class="con0" />
					<col class="con1" />
					<col class="con0" />
				</colgroup>
				<thead>
					<tr>
						<th class="head1">Bill</th>
						<th class="head0">Tanggal Selesai</th>
						<th class="head1">Kode</th>
						<th class="head0">Item Barang</th>
						<th class="head1">Qty</th>
						<th class="head0">Harga</th>
						<th class="head1">Diskon</th>
						<th class="head0">Sub Total</th>
						<th class="head1">Disc.T</th>
						<th class="head0">Total</th>
						<th class="head1" width="20px">Tipe</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</form>    
</div>
<script>
	jQuery(function($){
		$('#<?php echo $pos;?>_hk').focus();
		
		var populateForm = function(data){
			$('#id_customer_hk').val(data.id_customer);
			$('#id_pelanggan_hk').val(data.id_pelanggan);
			$('#pemilik_hk').val(data.pemilik);
			$('#tipe_hk').val(data.tipe);
			$('#no_polisi_hk').val(data.no_polisi);
			
			$('#table-hist tbody').html('');
			var idx = 0;
			$.each(data.hist, function(i, d) {
				idx++;
				var tr = "<tr id="+d.id_customer_history+" class='"+(i==0?"hist-first":"")+"' tabindex='"+(i)+"'>";
				tr+="<td>"+d.kode_trx+"</td>";
				tr+="<td>"+d.finish_datetime+"</td>";
				tr+="<td>"+d.km+"</td>";
				tr+="<td>"+d.mekanik_nama+"</td>";
				tr+="<td>"+d.crby_dispname+"</td>";
				tr+="<td class='catatan hidden'>"+d.keterangan+"</td>";
				tr+="<td class='keluhan hidden'>"+d.keluhan+"</td>";
				tr+="<td class='diganti hidden'>"+d.diganti+"</td>";
				tr+="</tr>";
				$('#table-hist tbody').append(tr);
			});
			
			$('#table-hist tbody tr').focus(function(){
				$('#catatan_hk').val($(this).find('.catatan').text());
				$('#keluhan_hk').val($(this).find('.keluhan').text())
				$('#diganti_hk').val($(this).find('.diganti').text())
			});
			
			var currCell = $('#table-hist tbody tr').first();
			
			$('.hist-first').focus(function(){
				currCell = $('#table-hist tbody tr').first();
			});
			$('#table-hist tbody tr').keydown(function (e) {
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
					
					$.post( '<?php echo site_url('common/get_customer_hist_detail')?>', { id_ch: $(this).attr('id') }, function( data ) {
						if(data.result==1){
							$('table#table-hist-det tbody').html('');
							$.each(data.hist_detail, function(i, d) {
								var tr = "<tr class='"+(i==0?"det-first":"")+"' tabindex='"+(i+idx)+"'>";
										tr+="<td>"+d.kode_trx+"</td>";
										tr+="<td>"+d.finish_datetime+"</td>";
										tr+="<td>"+d.kode_barang+"</td>";
										tr+="<td>"+d.nama+"</td>";
										tr+="<td>"+d.qty+"</td>";
										tr+="<td>"+d.harga+"</td>";
										tr+="<td>"+d.diskon+"</td>";
										tr+="<td>"+d.sub_total+"</td>";
										tr+="<td>"+d.diskon_total+"</td>";
										tr+="<td>"+d.total+"</td>";
										tr+="<td>"+(d.tipe==1?"P":"C")+"</td>";
									tr+="</tr>";
								$('#table-hist-det').append(tr);	
							});
							var currCellHd = $('#table-hist-det tbody tr').first();
							$('#table-hist-det tbody tr').keydown(function (eHd) {
								var cHd = "";
								if (eHd.which == 39) {
									// Right Arrow
									cHd = currCellHd.next();
								} else if (eHd.which == 37) { 
									// Left Arrow
									cHd = currCellHd.prev();
								} else if (eHd.which == 38) { 
									// Up Arrow
									cHd = currCellHd.prev();
								} else if (eHd.which == 40) { 
									// Down Arrow
									cHd = currCellHd.next();
								}
								if (cHd.length > 0) {
									currCellHd = cHd;
									currCellHd.focus();
								}
							});
							
						}else{
							$('table#table-hist-det tbody').html('');
						}
					}, "json");	
				}
				if (c.length > 0) {
					currCell = c;
					currCell.focus();
				}
			});
		};
		
		var clearForm = function(pos){
			$('.inp_hk').val('');
			if(pos=="id_pelanggan"){
				$('#no_polisi_hk').val('');
			}else{
				$('#id_pelanggan_hk').val('');
			};
		};
		
		var processIdPelanggan = function(crit){
			$.post( '<?php echo site_url('common/get_customer_hist/id_pelanggan')?>/'+crit, { val: $('#id_pelanggan_hk').val() }, function( data ) {
				if(data.result==1){
					populateForm(data);
				}else{
					clearForm('id_pelanggan');
				}
			}, "json");
		};
		
		var processNoPolisi = function(crit){
			$.post( '<?php echo site_url('common/get_customer_hist/no_polisi')?>/'+crit, { val: $('#no_polisi_hk').val() }, function( data ) {
				if(data.result==1){
					populateForm(data);
				}else{
					clearForm('no_polisi');
				}
			}, "json");
		};
		
		if('<?php echo $pos;?>'=='id_pelanggan'){
			processIdPelanggan('where');
		}else{
			processNoPolisi('where');
		}
		
		$('#id_pelanggan_hk').autocomplete({
			source: "<?php echo site_url('common/get_id_pelanggan')?>",
			select: function( event, ui ) {
				processIdPelanggan('');
			},
			minLength:3
		});
		
		$('#no_polisi_hk').autocomplete({
			source: "<?php echo site_url('common/get_no_polisi')?>",
			select: function( event, ui ) {
				processNoPolisi('');
			},
			minLength:3
		});
		
		$('#id_pelanggan_hk').change(function(){
			processIdPelanggan('where');
		});
		$('#no_polisi_hk').change(function(){
			processNoPolisi('where');
		});
	});
	
</script>