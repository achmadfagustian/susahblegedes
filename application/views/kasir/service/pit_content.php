<input type="hidden" name="id_customer" class="id_customer">
<input type="hidden" name="id_customer_history" class="id_customer_history">
<div id="content-div">
	<table cellpadding="0" cellspacing="0" border="0" class="stdtable overviewtable">
		<colgroup>
			<col class="con0" />
			<col class="con1" />
			<col class="con0" />
			<col class="con1" />
			<col class="con0" />
		</colgroup>
		<thead>
			<tr>
				<th class="head1">Pemilik</th>
				<th class="head0">Jenis Motor</th>
				<th class="head1">No Polisi</th>
				<th class="head0">Waktu Mulai Pengerjaan</th>
				<th class="head1">Status</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="pemilik"></td>
				<td class="jenis"></td>
				<td class="no_polisi"></td>
				<td class="start_datetime"></td>
				<td class="status" style="color:white"></td>
			</tr>
		</tbody>
	</table>
</div>
<div style="clear:both"></div>
<div class="form-group bottom-input" style="height:300px;overflow-y:scroll;overflow-x:hidden">
	<table id="table-item" style="margin:0px">
		<thead>
			<tr>
				<th width="30px">No</th>
				<th width="40px">Kode</th>
				<th width="170px">Nama Item</th>
				<th width="60px">Satuan</th>
				<th width="20px">QTY</th>
				<th width="90px">Harga</th>
				<th width="50px">DISC %</th>
				<th width="90px">Diskon</th>
				<th>Sub Total</th>
			</tr>
		</thead>
		<tbody>
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
<div style="clear:both"></div>
<div class="bottom-input">
	<table id="bottom_cat">
		<thead>
			<tr>
				<th>::KELUHAN::</th>
				<th>::SPARE PART BELUM DIGANTI::</th>
				<th>::CATATAN / KETERANGAN::</th>
			</tr>
		<thead>
		<tbody>
			<tr>
				<td><textarea name="keluhan" class="keluhan"></textarea></td>
				<td><textarea name="diganti" class="diganti"></textarea></td>
				<td><textarea name="keterangan" class="keterangan"></textarea></td>
			</tr>
		</tbody>
	</table>
</div>