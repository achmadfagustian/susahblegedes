    <style>
	.form-wrap {
		width: 100%;
	}
	.stdform{
		margin-left:10px	
	}
	</style>
	<div class="vernav iconmenu">
		<?php $this->load->view('kasir/data_customer/left_menu');?>
		<div class="form-group">
			<div class="form-button">
				<input type="button" name="reset" value="Reset" id="btn-reset" class="btn-form"/>
				<input type="button" name="submit" value="<?php echo (isset($id_pelanggan))? "Edit":"Add"; ?>" id="btn-submit" class="btn-form btn-submit"/>
			</div>
		</div>
    </div><!--leftmenu-->
    
	<div class="centercontent" id="kasir-wrap">
		<div id="main-content" style="text-align:center">
			<div class="form-wrap">
				<form class="stdform" id="data-customer-form" method="POST" action="#">
					<div class="form-group" style="padding-top:20px">
						<div class="form-group-2">
							<label>ID Pelanggan<span class="required">*</span> : </label>
							<span class="field"><input type="text" name="id_pelanggan" id="id_pelanggan" maxlength="100" required oninvalid="this.setCustomValidity('ID Pelanggan harus diisi')" oninput="setCustomValidity('')" value="<?php echo (isset($id_pelanggan))? $id_pelanggan:""; ?>" /></span>
						</div>
						<div class="form-group-2">
							<label>No Polisi<span class="required">*</span> : </label>
							<span class="field"><input type="text" name="no_polisi" id="no_polisi" maxlength="15" required oninvalid="this.setCustomValidity('No Polisi harus diisi')" oninput="setCustomValidity('')" value="<?php echo (isset($no_polisi))? $no_polisi:""; ?>"/></span>
						</div>
					</div>
					<div class="form-group" style="clear:both">
                        <label>Pemilik<span class="required">*</span> : </label>
						<span class="field"><input type="text" name="pemilik" id="pemilik" maxlength="255" required oninvalid="this.setCustomValidity('Pemilik harus diisi')" oninput="setCustomValidity('')" value="<?php echo (isset($pemilik))? $pemilik:""; ?>"/></span>
                    </div>
					<div class="form-group">
                        <label>Alamat : </label>
						<span class="field"><textarea name="alamat" style="height:100px"><?php echo (isset($alamat))? $alamat:""; ?></textarea></span>
                    </div>
					<div class="form-group">
                        <label>Telepon : </label>
						<span class="field"><input type="text" name="telepon" id="telepon" maxlength="50" value="<?php echo (isset($telepon))? $telepon:""; ?>"/></span>
                    </div>
					<div class="form-group">
						<div class="form-group-2">
							<label>Tipe : </label>
							<span class="field"><input type="text" name="tipe" id="tipe" maxlength="50" value="<?php echo (isset($tipe))? $tipe:""; ?>"/></span>
						</div>
						<div class="form-group-2">
							<label>Merek : </label>
							<span class="field"><input type="text" name="merek" id="merek" maxlength="50" value="<?php echo (isset($merek))? $merek:""; ?>"/></span>
						</div>
					</div>
					<div class="form-group">
						<div class="form-group-2">
							<label>Jenis : </label>
							<span class="field"><input type="text" name="jenis" id="jenis" maxlength="50" value="<?php echo (isset($jenis))? $jenis:""; ?>"/></span>
						</div>
						<div class="form-group-2">
							<label>Warna : </label>
							<span class="field"><input type="text" name="warna" id="warna" maxlength="100" value="<?php echo (isset($warna))? $warna:""; ?>"/></span>
						</div>
					</div>
					<div class="form-group">
						<div class="form-group-2">
							<label>Tahun Produksi : </label>
							<span class="field"><input type="text" name="tahun_produksi" id="tahun_produksi" maxlength="10" value="<?php echo (isset($tahun_produksi))? $tahun_produksi:""; ?>"/></span>
						</div>
                    </div>
					<div class="form-group" style="clear:both">
						<div class="form-group-2">
							<label>No. Rangka : </label>
							<span class="field"><input type="text" name="no_rangka" id="no_rangka" maxlength="100" value="<?php echo (isset($no_rangka))? $no_rangka:""; ?>"/></span>
						</div>
						<div class="form-group-2">
							<label>No. Mesin : </label>
							<span class="field"><input type="text" name="no_mesin" id="no_mesin" maxlength="100" value="<?php echo (isset($no_mesin))? $no_mesin:""; ?>"/></span>
						</div>
					</div>
					<div class="form-group" style="clear:both">
						<label>Keterangan : </label>
						<span class="field"><textarea name="keterangan" style="height:100px"><?php echo (isset($keterangan))? $keterangan:""; ?></textarea></span>
                    </div>
					<div class="form-clear"></div>
					<input type="hidden" name="id_customer" class="id_customer" value="<?php echo (isset($id_customer))? $id_customer:""; ?>"/>
					<input type="submit" name="submit" id="form-submit" style="display:none"/>
				</form>    
			</div>
        </div>
	</div><!-- centercontent -->
	<script>
		jQuery(function($){
		
			var clearForm = function(){
				$('#data-customer-form input').val('');
				$('#data-customer-form textarea').val('');
			};
			
			$('#btn-submit').click(function(){
				$('#form-submit').click();
			});
			
			$('#btn-reset').click(function(){
				<?php if(isset($id_pelanggan)){?>
					jQuery("body").addClass("loading");
					location.reload();
				<?php }else{?>
					clearForm();
				<?php }?>
			});
			
			$('#data-customer-form').submit(function(){
				$.post( "<?php echo $form_action ?>", $('#data-customer-form').serialize())
				.done(function( data ) {
					alert( "Save Successfully" );
					clearForm();
					<?php if(isset($id_pelanggan)){?>
						jQuery("body").addClass("loading");
						window.location.href='<?php echo site_url('kasir/data_customer/cust_list');?>';
					<?php }?>
				});
				return false;
			})
		});
	</script>