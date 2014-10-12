    <style>
	.form-wrap {
		width: 100%;
	}
	.stdform{
		margin-left:10px	
	}
	
	</style>
	<div class="vernav iconmenu">
    	<ul>
        	<li><a href="<?php echo base_url('kasir/stock/add')?>" class="inbox">Add</a></li>
            <li class="current"><a href="<?php echo base_url('kasir/stock/upload')?>" class="inbox">Upload</a></li>
            <li><a href="<?php echo base_url('kasir/listPenjualan')?>" class="inbox">List</a></li>
            <li><a href="<?php echo base_url('kasir/listPenjualan')?>" class="inbox">PO</a></li>
            <li><a href="<?php echo base_url('kasir/listPenjualan')?>" class="inbox">DO</a></li>
        </ul>
        <a class="togglemenu"></a>
		<div class="form-group">
			<div class="form-button">
				<input type="button" value="Reset"/>
				<input type="button" name="submit" value="Submit" id="btnSubmit"/>
			</div>
		</div>
    </div><!--leftmenu-->
	
	<div class="centercontent">
		<div id="main-content" style="text-align:center;">
			<div class="form-wrap">
				<form class="stdform" method="POST" action="#" style="padding-bottom:265px;">
					<div class="form-group" style="clear:both;padding:20px 0px 0px 0px;">
                        <label>Periode : </label>
						<span class="field"><label style="width:80px">Bulan : </label><select></select></span>
                    </div>
					<div class="form-group">
                        <label></label>
						<span class="field"><label style="width:80px">Tahun : </label><select></select></span>
                    </div>
					<div class="form-group" style="clear:both;padding:20px 0px 0px 0px;">
                        <label>Upload File : </label>
						<span class="field"><input type="file" name="id_pelanggan" id="id_pelanggan" /></span>
                    </div>
					<div class="form-clear"></div>
				</form>    
			</div>
			
        </div>
	</div><!-- centercontent -->