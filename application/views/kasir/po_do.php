    <style>
	.accordion{
		margin-bottom:10px;
	}
	.btn{
		padding:10px;
		margin:10px 10px 10px 0px;
	}
	.red{
		background-image: -webkit-gradient(
		linear,
		left top,
		left bottom,
		color-stop(0, #FF0000),
		color-stop(1, #FF4F4F)
		)!important;
		background-image: -o-linear-gradient(bottom, #FF0000 0%, #FF4F4F 100%)!important;
		background-image: -moz-linear-gradient(bottom, #FF0000 0%, #FF4F4F 100%)!important;
		background-image: -webkit-linear-gradient(bottom, #FF0000 0%, #FF4F4F 100%)!important;
		background-image: -ms-linear-gradient(bottom, #FF0000 0%, #FF4F4F 100%)!important;
		background-image: linear-gradient(to bottom, #FF0000 0%, #FF4F4F 100%)!important;
	}
	.green{
		background-image: -webkit-gradient(
		linear,
		left top,
		left bottom,
		color-stop(0, #00AD25),
		color-stop(1, #2BC23A)
		)!important;
		background-image: -o-linear-gradient(bottom, #00AD25 0%, #2BC23A 100%)!important;
		background-image: -moz-linear-gradient(bottom, #00AD25 0%, #2BC23A 100%)!important;
		background-image: -webkit-linear-gradient(bottom, #00AD25 0%, #2BC23A 100%)!important;
		background-image: -ms-linear-gradient(bottom, #00AD25 0%, #2BC23A 100%)!important;
		background-image: linear-gradient(to bottom, #00AD25 0%, #2BC23A 100%)!important;
	}
	body.withvernav{
		background:url(../images/y.jpeg);
		background-repeat:no-repeat;
		background-attachment:fixed;
	}
	</style>
	<div class="">
		<div id="main-content" style="text-align:center">
			<div class="form-wrap">
				<form class="stdform" method="POST" action="#">
					<div class="form-group">
						<div class="form-group-2">
							<label>ID Pelanggan : </label>
							<span class="field"><input type="text" name="id_pelanggan" id="id_pelanggan" /></span>
						</div>
						<div class="form-group-2">
							<label>Tipe : </label>
							<span class="field"><input type="text" name="no_polisi" id="no_polisi" /></span>
						</div>
					</div>
					<div class="form-group">
                        <label>Nama Pelanggan : </label>
						<span class="field"><input type="text" name="id_pelanggan" id="id_pelanggan" /></span>
                    </div>
					<div class="form-group">
                        <label>Tanggal / Jam : </label>
						<span class="field"><input type="text" name="id_pelanggan" id="id_pelanggan" class="width-part"/></span>
                    </div>
					<div class="form-group">
                        <label>Mekanik Awal : </label>
						<span class="field"><input type="text" name="id_pelanggan" id="id_pelanggan" class="width-part"/></span>
                    </div>
					<div class="form-group">
                        <textarea></textarea>
                    </div>
					<div class="form-group">
                        <label>Di Handle Mekanik : </label>
						<span class="field"><input type="text" name="id_pelanggan" id="id_pelanggan" class="width-part"/></span>
                    </div>
					<div class="form-clear"></div>
					<div class="form-button">
						<input type="button" value="Reset"/>
						<input type="submit" value="Submit"/>
					</div>
				
				</form>    
			</div>
        </div>
	</div><!-- centercontent -->