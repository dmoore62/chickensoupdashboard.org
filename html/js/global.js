function get_search_results(){
	$('#global-search').on('keyup', function(){
		var cur_term = $(this).val();
		var result_list = $('#search-results');
		if(cur_term.length > 2){
			$.get("../search.php", {"term":cur_term}, function(msg){
				result_list.html(msg);
				setTimeout(function(){
					var inner_height = $('ul#out-list').height();
					inner_height = (inner_height == 0) ? 100 : inner_height;
					var outer_height = inner_height + 50;
					console.log(inner_height);
					result_list.css("height",outer_height+"px");
					result_list.show();
				}, 300);
			});
		}else{
			result_list.hide();
		}
	});
}

function trigger_overlay(){
	var overlay = $('div#overlay');
	$('a.pop_box').on('click', function(e){
		e.preventDefault();
		var cur = $(this);
		var model_form = "../" + cur.attr('data-form') + ".php";
		var form_data = cur.attr("data-for-id");
		if(form_data){
			var form_key = cur.attr("data-for");
			model_form += "?"+form_key+"="+form_data;
		}
		//console.log(model_form);
		$.get(model_form, function(msg){
			overlay.html(msg);
			//get top of screen and position modal
			var top = $(window).scrollTop();
			var body_height = $(document).height() + 200;
			console.log(body_height);
			var modal_top = top + 130;
			overlay.css("height", body_height+"px");
			$('div.modal').css('position', modal_top+"px");
			overlay.show();
			$('button.close').on('click', function(){
				overlay.hide();
			});
		});
	});
}

function mask_phones(){
	$('.phone-mask').mask("(999)999-9999");
}

var d = $(document);
d.ready(function(){
	//alert('global');
	get_search_results();

	trigger_overlay();

	mask_phones();
});