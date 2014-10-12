Handlebars.registerHelper('ifCond', function (v1, operator, v2, options) {
	switch (operator) {
		case '==':
			return (v1 == v2) ? options.fn(this) : options.inverse(this);
		case '===':
			return (v1 === v2) ? options.fn(this) : options.inverse(this);
		case '<':
			return (v1 < v2) ? options.fn(this) : options.inverse(this);
		case '<=':
			return (v1 <= v2) ? options.fn(this) : options.inverse(this);
		case '>':
			return (v1 > v2) ? options.fn(this) : options.inverse(this);
		case '>=':
			return (v1 >= v2) ? options.fn(this) : options.inverse(this);
		case '&&':
			return (v1 && v2) ? options.fn(this) : options.inverse(this);
		case '||':
			return (v1 || v2) ? options.fn(this) : options.inverse(this);
		default:
			return options.inverse(this);
	}
});

jQuery(function($){
	var source = $("#result_table").html();
	if (source) {
	 
	var result_template = Handlebars.compile(source);
	
	var checkAll = function(){
		$('.checkall').click(function(){
			if($(this).is(':checked')){
				$('.chkbox-input').each(function(){$(this).prop('checked',true)});
			}else{
				$('.chkbox-input').each(function(){$(this).prop('checked',false)});
			}
		});
	};

	 function load_result(index) {
	  index = index || 0;
	  $.post(base_url + url + index, $('#form-hidden-filter').serialize(), function(data) {
	   $("#result_table").html(result_template({results: data.results}));
	   $("#result_table2").html($("#result_template").html());
	   $('#pagination').html(data.pagination);
	   populate_filter(data);
	   checkAll();
	  }, "json");
	 }

	 load_result();
	}

	 $('#pagination').on('click', '.paging_table a', function(e) {
	  e.preventDefault();
	  var link = $(this).attr("href").split(/\//g).pop();
	  load_result(link);
	  pagination_change();
	  return false;
	 });
});