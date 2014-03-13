function get_search_results(){
	$('#global-search').on('keyup', function(){
		var cur_term = $(this).val();
		var result_list = $('#search-results');
		if(cur_term.length > 2){
			$.get("../search.php", {"term":cur_term}, function(msg){
				result_list.html(msg);
				var inner_height = $('ul#out-list').height();
				var outer_height = inner_height + 50;
				result_list.css("height",outer_height+"px");
				result_list.show();
			});
		}else{
			result_list.hide();
		}
	});
}

var d = $(document);
d.ready(function(){
	//alert('global');
	get_search_results();
});