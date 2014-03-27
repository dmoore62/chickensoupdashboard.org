function tab_swp(){
	$('ul.nav-tabs > li').on('click', function(){
		var cur = $(this);
		if(!cur.hasClass('active')){
			$('ul.nav-tabs > li').each(function(){
					$(this).removeClass('active');
			});
			cur.addClass('active');
			$('.search-view').each(function(){
				var $this = $(this);
				if($this.is(":visible")){
					$this.hide();
				}else{
					$this.show();
				}
			});
		}
	});
}

function make_Tables(){
	$('table.dynamic-table').each(function(){
		$(this).dataTable({
			"iDisplayLength" : -1,
			"bFilter" : false,
			"bPaginate" : false,
			"bSort" : false
		});
	});
}

function vol_search(){
	$('input#vol-search').on('keyup', function(){
		var result_div = $('div#vol-search-results');
		var cur_val = $(this).val();
		if(cur_val.length > 2){
			//ajax to search controller
			$.ajax({
				url: "../recip_search.php",
				data: {term : cur_val},
				method: "POST",
				success: function(data){
					$('tbody#search-results').html(data);
					result_div.show();
				}
			});
		}else{
			result_div.hide();
		}
	});
}

var d = $(document);
d.ready(function(){
	//alert("welcome");
	make_Tables();
	tab_swp();
	vol_search();
});