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

function trigger_overlay(){
	var overlay = $('div#overlay');
	var body_height = $(document).height() + 200;
	$('a.pop_box').on('click', function(e){
		e.preventDefault();
		console.log(body_height);
		overlay.css("height", body_height+"px");
		overlay.show();
		overlay.on('click', function(){
			overlay.hide();
		});
	});
}

var d = $(document);
d.ready(function(){
	//alert('global');
	get_search_results();

	trigger_overlay();
});