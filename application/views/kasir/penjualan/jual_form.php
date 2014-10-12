<style>
	
	.form-wrap {
		width: 100%;
	}
	
	.stdform{
		margin-left:10px	
	}
	
	.width-3{
		width:33%;
		float:left;
	}
	
	.width-30{
		width:30%;
		float:left;
	}
	
	.stdform .width-30 label{
		width:97px!important;
	}
	
	.width-36{
		width:36%;
		float:left;
	}
	
	.width-2{
		width:50%;
		float:left;
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
		text-align:center;
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
	font.mini{
		font-size:12px;
	}
	.vernav {
		width: 17%;
	}
	.centercontent {
		margin-left: 16.5%;
	}
	.form-button input{
		margin-left:0px;
	}
	</style>
	<div class="vernav iconmenu">
    	<ul>
        	<li class="current"><a href="<?php echo base_url('kasir/penjualan')?>" class="inbox">Jual</a></li>
            <li><a href="<?php echo base_url('kasir/listPenjualan')?>" class="inbox">List</a></li>
        </ul>
        <a class="togglemenu"></a>
		<div class="form-group">
			<div class="form-button">
				<input type="button" value="Cetak Ulang" class="btn-form"/>
				<input type="submit" value="Simpan" class="btn-form"/>
				<input type="button" value="Batal" class="btn-form"/>
			</div>
		</div>
    </div><!--leftmenu-->
    
    <div class="centercontent">
        <div id="main-content" style="text-align:center">
             <div class="form-wrap" style="float:left">
				<form class="stdform" method="POST" action="#">
					<div class="form-group" style="clear:both;padding:20px 0px;">
						<div class="width-3">
							<div class="form-group">
								<label style="width:80px" class="red-label">No. Bill : </label>
								<span class="field"><input type="text" name="kode_trx" id="kode_trx" style="width:100px"/></span>
							</div>
							<div class="form-group">
								<label style="width:80px">Tgl / Jam : </label>
								<span class="field"><input type="text" name="telepon" id="datepicker1"/> <input type="text" name="telepon" id="telepon" style="width:45px;margin-left:5px"/></span>
							</div>
						</div>
						<div class="width-3">
							<div class="form-group">
								<label>Mekanik : </label>
								<span class="field"><input type="text" name="mekanik" id="mekanik" style="width:40px"/> <input type="text" name="telepon" id="telepon" style="width:80px;margin-left:5px" readonly="true"/></span>
							</div>
						</div>
						<div class="width-3">
							<div style="border:1px solid white;padding: 0px 5px;margin: 0px 10px;">
							<div class="form-group">
								<label style="width:85px" class="red-label">Total Biaya : </label>
								<span class="field">Rp. <input type="text" name="telepon" id="telepon" style="width:100px"/></span>
							</div>
							<div class="form-group">
								<label style="width:85px" class="red-label">Kembali : </label>
								<span class="field">Rp. <input type="text" name="telepon" id="telepon" style="width:100px"/></span>
							</div>
							</div>
						</div>
						<div style="clear:both"></div>
						<hr/>
						<div class="form-group" style="height:255px;overflow-y:scroll">
							<table id="table-item">
								<thead>
									<tr>
										<th width="30px">No</th>
										<th width="40px">Kode</th>
										<th>Nama Item</th>
										<th width="60px">Satuan</th>
										<th width="40px">QTY</th>
										<th width="160px">Harga</th>
										<th width="60px">DISC %</th>
										<th width="160px">Diskon</th>
										<th width="160px">Sub Total</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><span>1</span></td>
										<td><input type="text" name="telepon" id="telepon"/></td>
										<td><span></span></td>
										<td><span></span></td>
										<td><input type="text" name="telepon" id="telepon"/></td>
										<td><span></span></td>
										<td><input type="text" name="telepon" id="telepon"/></td>
										<td><input type="text" name="telepon" id="telepon"/></td>
										<td><span></span></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div style="clear:both"></div>
						<hr/>
						<div class="width-3">
							<div class="form-group">
								<label>Catatan : </label>
								<span class="field">
									<select style="width:61.4%" id="template">
										<option value="">-- Pilih --</option>
										<?php foreach($template as $row){?>
											<option value="<?php echo $row->kode_template?>"><?php echo $row->kode_template?></option>
										<?php }?>
									</select>
								</span>
							</div>
							<div class="form-group">
								<textarea style="height:135px;width:86%" id="template_ket"></textarea>
							</div>
						</div>
						<div class="width-30">
							<div class="form-group">
								<label>Sub Total : </label>
								<span class="field"><input type="text" name="telepon" id="telepon" style="width:100px;margin-left:5px"/></span>
							</div>
							<div class="form-group">
								<label><font style="font-size:12px">Diskon</font> <input type="text" name="telepon" id="telepon" style="width:25px"/> <font style="font-size:12px">%</font>: </label>
								<span class="field"><input type="text" name="telepon" id="telepon" style="width:100px;margin-left:5px"/></span>
							</div>
							<div class="form-group">
								<label>Total Bill : </label>
								<span class="field"><input type="text" name="telepon" id="telepon" style="width:100px;margin-left:5px"/></span>
							</div>
						</div>
						<div class="width-36">
							<div class="form-group">
								<label style="width:146.6px">TUNAI / CASH : </label>
								<span class="field"><input type="text" name="telepon" id="telepon" style="width:100px"/></span>
							</div>
							<div class="form-group">
								<label style="width:147px"><font class="mini">Kartu</font> DEBIT / KREDIT : </label>
								<span class="field"><input type="text" name="telepon" id="telepon" style="width:100px"/></span>
							</div>
							<div class="form-group">
								<label style="width:75px"><font class="mini">Kartu Bayar</font> : </label>
								<span class="field"><input type="text" name="telepon" id="telepon" style="width:40px"/> <input type="text" name="telepon" id="telepon" style="width:112px;margin-left:5px;"/></span>
							</div>
							<div class="form-group">
								<label class="red-label" style="width:75px"><font class="mini">Charge</font> : </label>
								<span class="field"><input type="text" name="telepon" id="telepon" style="width:170px"/></span>
							</div>
							<div class="form-group">
								<label style="width:75px"><font class="mini" style="margin-left:15px">Card</font> : </label>
								<span class="field"><input type="text" name="telepon" id="telepon" style="width:170px"/></span>
							</div>
							<div class="form-group">
								<label style="width:75px"><font class="mini">No. Struk / Ref.</font> : </label>
								<span class="field"><input type="text" name="telepon" id="telepon" style="width:170px"/></span>
							</div>
						</div>
						<div style="clear:both"></div>
					</div>
				</form>   
			</div>
        </div><!--contentwrapper-->
    
    </div><!--centercontent-->
	<script>
		jQuery(function($){
			var arrTemplate = new Array();
			<?php foreach($template as $row){?>
				arrTemplate['<?php echo $row->kode_template?>'] = "<?php echo $row->keterangan?>";
			<?php }?>
			
			$('#template').change(function(){
				$('#template_ket').text(arrTemplate[$(this).val()]);
			});
			
			$('#datepicker1').datepicker({
				buttonImageOnly: false,
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd-mm-yy"
			}).val()
			
			$('#mekanik').keydown(function( event ) {
				if ( event.which == 13 ) {
					
				}
			});
		});
	</script>
	<script>
		$(function(){
			$("#datepicker1").mask("99-99-9999");
		})
	</script>