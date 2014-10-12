    <style>
	#main-content{
		margin:10px;
	}
	.accordion{
		margin-bottom:10px;
	}
	.btn{
		padding:10px;
		margin:10px 10px 10px 0px;
	}
	</style>
	<div class="vernav iconmenu">
    	<ul>
        	<li><a href="<?php echo site_url('kasir/pendaftaran')?>" class="inbox">Baru</a></li>
            <li><a href="<?php echo site_url('kasir/sedangDikerjakan')?>" class="drafts">Sedang Dikerjakan</a></li>
            <li><a href="<?php echo site_url('kasir/sudahDikerjakan')?>" class="sent">Sudah Di kerjakan</a></li>
			<li class="current"><a href="<?php echo site_url('kasir/cancel')?>" class="sent">Cancel</a></li>
        </ul>
        <a class="togglemenu"></a>
        <br /><br />
    </div><!--leftmenu-->
        
    <div class="centercontent">
		<div id="main-content">
			<div id="accordion" class="accordion">
				<h3><a href="#">Filter</a></h3>
				<div>
					<p>
					
					</p>
				</div>
				
			</div>     
			<table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb overviewtable2">
				<colgroup>
					<col class="con0" style="width: 10%" />
					<col class="con1" />
					<col class="con0" />
					<col class="con1" />
					<col class="con0" />
					<col class="con1" />
				</colgroup>
				<thead>
					<tr>
						<th class="head0">No Urut</th>
						<th class="head1">Nama</th>
						<th class="head0">Jenis Motor</th>
						<th class="head1">No Polisi</th>
						<th class="head0">Waktu Pendaftaran</th>
						<th class="head1">Waktu Cancel</th>
						<th class="head1">Alasan</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Bonaventura Pinandito</td>
						<td>Jupiter Z</td>
						<td>B 1234 EPH</td>
						<td>02-05-2014 07:00 AM</td>
						<td>02-05-2014 07:00 AM</td>
						<td>Double Data</td>
					</tr>
					<tr>
						<td>2</td>
						<td>Roberthus Angga</td>
						<td>Mio</td>
						<td>B 1214 EPH</td>
						<td>02-05-2014 08:00 AM</td>
						<td>02-05-2014 08:00 AM</td>
						<td>Kembali Besok</td>
					</tr>
					<tr>
						
						<td>3</td>
						<td>Juprianty</td>
						<td>Mio</td>
						<td>B 5214 EPH</td>
						<td>02-05-2014 08:30 AM</td>
						<td>02-05-2014 08:30 AM</td>
						<td>Tidak Bawa Uang</td>
					</tr>
					<tr>
						<td>4</td>
						<td>Pramono Subagja</td>
						<td>Jupiter Z</td>
						<td>B 5294 EPH</td>
						<td>02-05-2014 08:45 AM</td>
						<td>02-05-2014 08:45 AM</td>
						<td>Tidak Bawa Uang</td>
					</tr>
					<tr>
						<td>5</td>
						<td>Brianto</td>
						<td>Mio</td>
						<td>B 5394 EPH</td>
						<td>02-05-2014 09:45 AM</td>
						<td>02-05-2014 09:45 AM</td>
						<td>Tidak Bawa Uang</td>
					</tr>
					<tr>
						<td>6</td>
						<td>Bonaventura Pinandito</td>
						<td>Jupiter Z</td>
						<td>B 1234 EPH</td>
						<td>02-05-2014 07:00 AM</td>
						<td>02-05-2014 07:00 AM</td>
						<td>Tidak Bawa Uang</td>
					</tr>
					<tr>
						<td>7</td>
						<td>Roberthus Angga</td>
						<td>Mio</td>
						<td>B 1214 EPH</td>
						<td>02-05-2014 08:00 AM</td>
						<td>02-05-2014 08:00 AM</td>
						<td>Tidak Bawa Uang</td>
					</tr>
					<tr>
						<td>8</td>
						<td>Juprianty</td>
						<td>Mio</td>
						<td>B 5214 EPH</td>
						<td>02-05-2014 08:30 AM</td>
						<td>02-05-2014 08:30 AM</td>
						<td>Tidak Bawa Uang</td>
					</tr>
					<tr>
						<td>9</td>
						<td>Pramono Subagja</td>
						<td>Jupiter Z</td>
						<td>B 5294 EPH</td>
						<td>02-05-2014 08:45 AM</td>
						<td>02-05-2014 08:45 AM</td>
						<td>Tidak Bawa Uang</td>
					</tr>
					<tr>
						<td>10</td>
						<td>Brianto</td>
						<td>Mio</td>
						<td>B 5394 EPH</td>
						<td>02-05-2014 09:45 AM</td>
						<td>02-05-2014 09:45 AM</td>
						<td>Tidak Bawa Uang</td>
					</tr>
				</tbody>
			</table>
			
			<br clear="all" />
			<div style="float:right;margin:0px 0px 20px 0px">
			<input type="button" value="First">
			<input type="button" value="Prev">
			<input type="button" value="1">
			<input type="button" value="2">
			<input type="button" value="Next">
			<input type="button" value="Last">
			</div>
        </div>
	</div><!-- centercontent -->