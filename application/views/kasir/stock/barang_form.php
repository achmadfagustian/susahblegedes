    <style>
	.form-wrap {
		width: 100%;
	}
	.stdform{
		margin-left:10px	
	}
	.table-radio{
		font-size:14px;
		font-weight:bold;
	}
	#tabs{
		margin:10px;
		z-index: 99!important;
	}	
	td.label{
		font-weight:bold;
		font-size:14px;
		width:160px;
		text-align:right;
		padding-right:10px;
	}
	.title-body{
		width:100%!important;text-align:left!important;
	}
	.stdform .form-group .form-group-2{
		margin-bottom:5px;
	}
	.stdtable tbody tr td{
		padding:3px;
		text-align:center;
	}
	select.kode{
		width:97%!important;
		padding:5px!important;
	}
	table.full-input{
		width:95%!important;
	}
	form .form-group-2 input[type=text]{
		width:56%!important;
	}
	</style>
	<div class="vernav iconmenu">
		<?php $this->load->view('kasir/stock/left_menu');?>
		<div class="form-group">
			<div class="form-button">
				<input type="button" value="Reset"/>
				<input type="button" name="submit" value="Submit" id="btn-submit"/>
			</div>
		</div>
    </div><!--leftmenu-->
	
	<div class="centercontent">
		<div id="main-content" style="text-align:center;">
			<div class="form-wrap">
				<form class="stdform" id="form-barang" method="POST" action="#" style="padding-bottom:5px;">
					<div class="form-group" style="clear:both;padding:20px 0px 0px 0px;">
						<div class="form-group-2">
							<label>Kode Barang : </label>
							<span class="field"><input type="text" name="kode_barang" id="kode_barang" /></span>
						</div>
                    </div>
					<div class="form-group" style="clear:both">
						<div class="form-group-2">
							<label>Nama Barang : </label>
							<span class="field"><input type="text" name="nama" id="nama" /></span>
						</div>
						<div class="form-group-2">
							<label>Jenis Barang : </label>
							<span class="field">
								<table class="table-radio">
									<tr>
										<td width="100px"><input type="radio" name="jenis" value="0"/> Barang</td>
										<td><input type="radio" name="jenis" value="1"/> Jasa</td>
									</tr>
								</table>
							</span>
						</div>
					</div>
					<div class="form-group" style="clear:both">
						<div class="form-group-2">
							<label>Nama Alias Barang : </label>
							<span class="field"><input type="text" name="nama_alias" id="nama_alias" /></span>
						</div>
						<div class="form-group-2">
							<label>Status Barang : </label>
							<span class="field">
								<table class="table-radio">
									<tr>
										<td width="100px"><input type="radio" name="status" value="1"/> Aktif</td>
										<td><input type="radio" name="status" value="0"/> Tidak Aktif</td>
									</tr>
								</table>
							</span>
						</div>
					</div>
					<div style="clear:both"></div>
					<div id="tabs">
						<ul>
							<li class="current"><a href="#tabs1">Spesifikasi</a></li>
							<li><a href="#tabs2">History</a></li>
						</ul>
						<div id="tabs1">
							<div class="part-50">
								<table class="full-input">
									<tr>
										<td width="1px" class="label">Golongan Barang : </td>
										<td>
											<span class="field">
											<select name="kode_golongan" id="kode_golongan" class="kode">
												<?php foreach($golongan as $row){?>
													<option value="<?php echo $row->kode_golongan?>"><?php echo $row->kode_golongan?>&nbsp; -> &nbsp;<?php echo $row->nama?></option>
												<?php }?>
											</select>
											</span></td>
									</tr>
									<tr>
										<td class="label">Satuan :</td>
										<td>
											<span class="field">
											<select name="kode_satuan" id="kode_satuan" class="kode" style="margin-top:3px">
												<?php foreach($satuan as $row){?>
													<option value="<?php echo $row->kode_satuan?>"><?php echo $row->kode_satuan?>&nbsp; -> &nbsp;<?php echo $row->nama?></option>
												<?php }?>
											</select>
											</span></td>
									</tr>
								</table>
								<div class="form-clear"></div>
								<label class="title-body">:: Sistem Perhitungan Komisi ::</label>
								<div style="clear:both"></div>
								<table class="full-input table-radio">
									<tr>
										<td><input type="radio" name="jenis_komisi" value="2"/> Menggunakan Prosentasi Harga Jual</td>
									</tr>
									<tr>
										<td><input type="radio" name="jenis_komisi" value="1"/> Menggunakan Jumlah Nominal</td>
									</tr>
									<tr>
										<td><input type="radio" name="jenis_komisi" value="0"/> Tidak Menggunakan Metode</td>
									</tr>
								</table>
								<div style="clear:both"></div>
								<table>
									<tr>
										<td>Prosentase Komisi</td>
										<td>: <input type="text" name="persen_komisi" id="persen_komisi" style="width:70px"/> %</td>
									</tr>
									<tr>
										<td>Nominal Komisi</td>
										<td>: <input type="text" name="nominal_komisi" id="nominal_komisi" style="width:90px"/></td>
									</tr>
								</table>
								<div class="form-clear"></div>
								<table>
									<tr>
										<td class="label" style="width:205px!important"><span class="red-label">Harga Jual :</span></td>
										<td><input type="text" name="hjual" id="hjual" style="width:100px"/></td>
									</tr>
									<tr>
										<td class="label" nowrap="nowrap"><span class="red-label">Modal/Harga Pokok : <input type="text" name="persen_modal" id="persen_modal" style="width:25px"/> %</span></td>
										<td><input type="text" name="hpp_terakhir" id="hpp_terakhir" style="width:100px"/></td>
									</tr>
									<tr>
										<td class="label"><span class="red-label">H Pokok Terbesar :</span></td>
										<td><input type="text" name="hpp_terbesar" id="hpp_terbesar" style="width:100px"/></td>
									</tr>
								</table>
							</div>
							<div class="part-50">
								<label class="title-body">:: STOCK BARANG DAN LIMIT ::</label>
								<table class="stdtable stdtablecb overviewtable2">
									<colgroup>
										<col class="con0"/>
										<col class="con1" />
										<col class="con0" />
										<col class="con1" />
									</colgroup>
									<thead>
										<tr>
											<th class="head1">KANTOR</th>
											<th class="head1">LOKASI</th>
											<th class="head0">MIN</th>
											<th class="head1">MAX</th>
											<th class="head0">STOCK</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($lokasi as $row){?>
											<tr>
												<td><input type="text" name="min" class="min" value="<?php echo !isset($row->min)?0:$row->min?>"/></td>
												<td>
													<input type="hidden" name="id_lokasi" class="id_lokasi" value="<?php echo $row->id_lokasi?>"/>
													<?php echo $row->nama?>
												</td>
												<td><input type="text" name="min" class="min" value="<?php echo !isset($row->min)?0:$row->min?>"/></td>
												<td><input type="text" name="max" class="max" value="<?php echo !isset($row->max)?0:$row->max?>"/></td>
												<td><?php echo !isset($row->stock)?0:$row->stock?></td>
											</tr>
										<?php }?>
									</tbody>
								</table>
								<label class="title-body">:: SUPPLIER ::</label>
								<table class="stdtable stdtablecb overviewtable2">
									<colgroup>
										<col class="con0"/>
										<col class="con1" />
									</colgroup>
									<thead>
										<tr>
											<th class="head1">KODE</th>
											<th class="head0">SUPPLIER</th>
										</tr>
									</thead>
									<tbody>
										<?php if($supplier!=NULL){foreach($supplier as $row){?>
											<tr>
												<td>
													<input type="hidden" name="id_supplier" class="id_supplier" value="<?php echo $row->id_supplier?>"/>
													<input type="text" name="kode_supplier" class="kode_supplier" value="<?php echo $row->kode_supplier?>"/>
												</td>
												<td><input type="text" name="nama_supplier" class="nama_supplier" value="<?php echo $row->nama?>"/></td>
											</tr>
										<?php }}?>
										<tr>
											<td>
												<input type="hidden" name="id_supplier" class="id_supplier"/>
												<input type="text" name="kode_supplier" class="kode_supplier"/>
											</td>
											<td><input type="text" name="nama_supplier" class="nama_supplier"/></td>
										</tr>
									</tbody>
								</table>
								<label class="title-body">:: CATATAN ::</label>
								<textarea name="keterangan" id="keterangan" style="width:97.5%;height:70px"></textarea>
								<div class="form-clear"></div>
							</div>
						</div>
						<div id="tabs2">
						</div>
						<input type="hidden" name="id_barang" class="id_barang"/>
				</form>    
			</div>
        </div>
	</div><!-- centercontent -->
	<div id="dialog"></div>
	<script>
		function showDialog(url){
			$("#dialog").load(url);
			$("#dialog").dialog("open");         
		}
		jQuery(function($){
			$( "#tabs" ).tabs();
			$("#dialog").dialog({
			   autoOpen: false,
			   height: 450,
			   width: 950,
			   modal: true
			});
			$('.s_item').click(function(){
				$("#dialog").dialog({title: "Stock"});
				showDialog("<?php echo site_url('common/stock')?>/"+$(this).val());
			});
			$('.total-finish').click(function(){
				$("#dialog").dialog({title: "Total Finish"});
				showDialog("<?php echo site_url('common/total_finish')?>/");
			});
			
			function clearForm(){
				$('#form-barang input').val('');
				$('#form-barang textarea').val('');
			}
			
			$('#btn-submit').click(function(){
				$.post( "<?php echo site_url('kasir/stock/barang_save')?>", $('#form-barang').serialize())
				.done(function( data ) {
					alert( "Save Successfully" );
					clearForm();
				  });
			});
		});
	</script>