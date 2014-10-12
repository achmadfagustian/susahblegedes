<style>
	.form-wrap {
		width: 100%;
	}
	
	.width-3{
		width:33%;
		float:left;
	}
	
	.width-2{
		width:50%;
		float:left;
	}
	
	.stdform{
		padding-top:0px;
	}
	
	.stdform .width-3 label {
		width: 100px;
	}
	
	.stdform .width-2 label {
		width: 130px;
	}
	
	.stdform .form-group .width-2 .form-group-2 .field {
		margin-left: 110px;
	}
	
	#table-item{
		margin:10px
	}
	
	#table-item thead th{
		font-size:15px
	}
	
	label.title-textarea-left{
		margin-left:30px;
		width: 100%!important;
		text-align: left;
	}
	
	label.title-textarea-right{
		margin-left:13px;
		width: 90%!important;
		text-align: left;
	}
	.field-textarea-left{
		margin-left:30px
	}
	.field-textarea-right{
		margin-left:0px
	}
	.stdform .form-group {
		margin: 5px 0px;
	}
	.stdform .form-group .form-group-2 {
		margin: 0px 0px 5px 0px;
	}
	label.w-130{
		width:130px!important;
	}
	font.mini{
		font-size:12px;
	}
	label.red-label{
		color:#ee1c25;
	}
	.form-dialog .stdform{
		background-color:white;
	}
	.field{
		padding-top: 2px;
	}
	</style>
<div class="form-wrap form-dialog">
	<form class="stdform" method="POST" action="#">
		<div class="form-group" style="clear:both;">
			<div class="width-3">
				<div class="form-group">
					<label class="red-label">No. Bill : </label>
					<span class="field" id="kode_trx"><?php echo $kode_trx;?></span>
				</div><br/>
				<div class="form-group">
					<label>Tgl / Jam : </label>
					<span class="field" id="finish_datetime"><?php echo $finish_datetime;?></span>
				</div>
			</div>
			<div class="width-3">
				<div class="form-group">
					<label>Mekanik 1 : </label>
					<span class="field" id="nama_mekanik"><?php echo $mekanik_nama;?></span>
				</div>
				<div class="form-group">
					<label>Lokasi : </label>
					<span class="field" id="nama_lokasi"><?php echo $perusahaan_nama;?></span>
				</div>
			</div>
			<div class="width-3">
				<div style="border:1px solid white;padding: 0px 20px;margin: 0px 10px;">
				<div class="form-group">
					<label class="red-label">Total Biaya : </label>
					<span class="field">Rp. <span id="total_biaya"><?php echo $detail[0]->total;?></span></span>
				</div>
				<div class="form-group">
					<label class="red-label">Kembali : </label>
					<span class="field">Rp. <span id="kembali"></span></span>
				</div>
				</div>
			</div>
			<div style="clear:both"></div>
			<hr/>
			<div class="width-2">
				<div class="form-group">
					<div class="form-group-2">
						<label class="red-label">ID Pelanggan : </label>
						<span class="field" id="id_pelanggan"><?php echo $id_pelanggan;?></span>
					</div>
					<div class="form-group-2">
						<label>No. Polisi : </label>
						<span class="field" id="no_polisi"><?php echo $no_polisi;?></span>
					</div>
				</div>
				<div class="form-group" style="clear:both">
					<label>Pemilik : </label>
					<span class="field" id="pemilik"><?php echo $pemilik;?></span><br/>
				</div>
				<div class="form-group">
					<div class="form-group-2">
						<label>Tipe : </label>
						<span class="field" id="tipe"><?php echo $tipe;?></span>
					</div>
					<div class="form-group-2">
						<label>KM : </label>
						<span class="field" id="km"><?php echo $km;?></span>
					</div>
				</div>
			</div>
			<div class="width-2">
				<div class="form-group">
					<div class="form-group-2">
						<label class="title-textarea-left">Keluhan : </label><br/><span class="field-textarea-left" id="keluhan"><?php echo ltrim ($keluhan);?></span>
					</div>
					<div class="form-group-2">
						<label class="title-textarea-right">Spare Part belum di ganti : </label><br/><span class="field-textarea-right" id="diganti"><?php echo ltrim ($diganti);?></span>
					</div>
				</div>
			</div>
			<div style="clear:both"></div>
			<hr/>
			<div class="form-group" style="height:160px;overflow-y:scroll">
				<table id="table-item">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>Nama Item</th>
							<th>Satuan</th>
							<th>QTY</th>
							<th>Harga</th>
							<th>DISC</th>
							<th>Diskon</th>
							<th>Sub Total</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach($detail as $row){?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $row->kode_barang;?></td>
								<td><?php echo $row->nama;?></td>
								<td><?php echo $row->kode_satuan;?></td>
								<td><?php echo $row->qty;?></td>
								<td><?php echo $row->harga;?></td>
								<td><?php echo $row->diskon;?></td>
								<td><?php echo $row->diskon_total;?></td>
								<td><?php echo $row->sub_total;?></td>
							</tr>
						<?php $i++;}?>
					</tbody>
				</table>
			</div>
			<div style="clear:both"></div>
			<hr/>
			<div class="width-3">
				<div class="form-group">
					<label>Catatan : </label>
					<span class="field">
						<select style="width:85%" id="template">
							<option value="">-- Pilih --</option>
							<?php foreach($template as $row){?>
								<option value="<?php echo $row->kode_template?>"><?php echo $row->kode_template?></option>
							<?php }?>
						</select>
					</span>
				</div>
				<div class="form-group">
					<textarea style="height:95px;width:86%" id="template_ket"></textarea>
				</div>
			</div>
			<div class="width-3">
				<div class="form-group">
					<label>Sub Total : </label>
					<span class="field" class="total"><?php echo $detail[0]->total;?></span>
				</div>
				<div class="form-group">
					<label><font style="font-size:12px">Diskon</font> <input type="text" name="diskon" id="diskon" style="width:25px"/> <font style="font-size:12px">%</font>: </label>
					<span class="field"><input type="text" name="diskon_total" id="diskon_total" style="width:160px;margin-left:5px"/></span>
				</div>
				<div class="form-group">
					<label>Total Bill : </label>
					<span class="field"><span id="total_bill"></span></span>
				</div>
			</div>
			<div class="width-3">
				<div class="form-group">
					<label class="w-130">TUNAI / CASH : </label>
					<span class="field"><input type="text" name="telepon" id="telepon" style="width:150px"/></span>
				</div>
				<div class="form-group">
					<label style="width:170px"><font class="mini">Kartu</font> DEBIT / KREDIT : </label>
					<span class="field"><input type="text" name="telepon" id="telepon" style="width:110px"/></span>
				</div>
				<div class="form-group">
					<label><font class="mini">Kartu Bayar</font> : </label>
					<span class="field"><input type="text" name="telepon" id="telepon" style="width:40px"/> <input type="text" name="telepon" id="telepon" style="width:120px;margin-left:5px;"/></span>
				</div>
				<div class="form-group">
					<label class="red-label"><font class="mini">Charge</font> : </label>
					<span class="field"><input type="text" name="telepon" id="telepon" style="width:60px"/>
					<font class="mini" style="margin-left:15px">Card</font> : <input type="text" name="telepon" id="telepon" style="width:50px"/></span>
				</div>
				<div class="form-group">
					<label><font class="mini">No. Struk / Ref.</font> : </label>
					<span class="field"><input type="text" name="telepon" id="telepon" style="width:180px"/></span>
				</div>
			</div>
			<div style="clear:both"></div>
		</div>
		</form>   
		<div style="clear:both"></div>
	</form>    
</div>
<script>
	jQuery(function($){
		var arrTemplate = new Array();
		<?php foreach($template as $row){?>
			arrTemplate['<?php echo $row->kode_template?>'] = "<?php echo $row->keterangan?>";
		<?php }?>
		
		$('#template').change(function(){
			$('#template_ket').text(arrTemplate[$(this).val()]);
		});
		
		$('#template').focus();
		
		var total = '<?php echo $detail[0]->total;?>';
		$('#diskon').change(function(){
			$('#diskon_total').val(parseFloat(total)*($('#diskon').val()/100));
			$('#total_bill').text(parseFloat(total) - parseFloat($('#diskon_total').val()));
		});
		$('#diskon_total').change(function(){
			$('#diskon').val(($('#diskon_total').val()/parseFloat(total))*100);
			$('#total_bill').text(parseFloat(total) - parseFloat($('#diskon_total').val()));
		});
	});
</script>