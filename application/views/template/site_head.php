<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>{title}</title>
<link rel="stylesheet" href="<?php echo base_url('css/style.default.css')?>" type="text/css" />
<script type="text/javascript" src="<?php echo base_url('js/plugins/jquery-1.10.2.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/plugins/jquery-ui-1.10.4.custom.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/plugins/jquery.cookie.js')?>"></script>
<!--script type="text/javascript" src="<?php echo base_url('js/plugins/jquery.flot.min.js')?>"></script-->
<!--script type="text/javascript" src="<?php echo base_url('js/plugins/jquery.flot.resize.min.js')?>"></script-->
<script type="text/javascript" src="<?php echo base_url('js/plugins/jquery.slimscroll.js')?>"></script>
<!--script type="text/javascript" src="<?php echo base_url('js/custom/dashboard.js')?>"></script-->
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="<?php echo base_url('js/plugins/excanvas.min.js')?>"></script><![endif]-->
<!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="<?php echo base_url('css/style.ie9.css')?>"/>
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="<?php echo base_url('css/style.ie8.css')?>"/>
<![endif]-->
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<link rel="stylesheet" href="<?php echo base_url('css/jquery-ui-1.10.4.custom.min.css')?>" type="text/css" />
<script>
	jQuery(document).on({
		ajaxStart: function() { jQuery("body").addClass("loading");},
		ajaxStop: function() { jQuery("body").removeClass("loading");}    
	});
</script>
<style>
	.modal-loading {
		display:    none;
		position:   fixed;
		z-index:    9999999;
		top:        0;
		left:       0;
		height:     100%;
		width:      100%;
		background: rgba( 255, 255, 255, .2 ) 
					url('<?php echo base_url('images/loading.gif')?>') 
					50% 50% 
					no-repeat;
	}
	
	body.loading {
		overflow: hidden;   
	}
	
	body.loading .modal-loading {
		display: block;
	}
</style>
</head>
<body class="withvernav">
<div class="modal-loading"></div>
	<div class="bodywrapper">
