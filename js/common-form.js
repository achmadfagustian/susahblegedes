jQuery(function($){
	i = 0;
	var refreshTable = function(){
		i = 0;
		$('#ajaxDataList').load(refresh_table_url,$('#form-filter').serialize(), function() {});
	};
	refreshTable();
	
	$("#dialog").dialog({
	   autoOpen: false,
	   width: width_form,
	   height: height_form,
	   modal: true,
	   buttons: {
		"Save": function() {
			$.post( dialog_save_url, $('#form-data').serialize())
			  .done(function( data ) {
				alert( "Save Successfully" );
				$("#dialog").dialog( "close" );
				clearForm();
				refreshTable();
			  });
		},
		"Cancel": function() {
			$("#dialog").dialog( "close" );
		}
	   }
	});
	
	$("#dialog-filter").dialog({
	   autoOpen: false,
	   width: width_filter,
	   height: height_filter,
	   modal: true,
	   buttons: {
		"Cari": function() {
			$("#dialog-filter").dialog( "close" );
			refreshTable();
		},
		"Cancel": function() {
			$("#dialog-filter").dialog( "close" );
		}
	   }
	});
				
	$('#add').click(function(){
		clearForm();
		$("#dialog").dialog(attr_add);
		$("#dialog").dialog("open");
	});
	
	$('#multiple-del').click(function(){
		var arrId = new Array();
		$('.chkbox-input:checked').each(function(){
			arrId.push($(this).val());
		});
		$.post( multiple_del_url, {'arrId':arrId.toString()})
		  .done(function( data ) {
			alert( "Delete Successfully" );
			$("#dialog").dialog( "close" );
			clearForm();
			refreshTable();
		  });
	});
	
	$('#cari').click(function(){
		$("#dialog-filter").dialog(attr_search);
		$("#dialog-filter").dialog("open");
	});
	
	$('#ajaxDataList').hover(function(){
		if(i==0){
			$('#ajaxDataList tbody tr td').not('.chkbox').click(function(){
				$.getJSON(get_data_url + $(this).parent().attr('id'), function(data) {
					$.each( data, function( key, val ) {
						$('#'+key,'#form-data').val(val);
					});
					$("#dialog").dialog(attr_edit);
					$("#dialog").dialog("open");
					setOtherData();
				});
			});
			i = 1;
		}
	});
});