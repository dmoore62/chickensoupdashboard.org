function weekly_swp(){
	$('ul.nav-tabs > li').on('click', function(){
		var cur = $(this);
		if(!cur.hasClass('active')){
			$('ul.nav-tabs > li').each(function(){
					$(this).removeClass('active');
			});
			cur.addClass('active');
			$('.week-view').each(function(){
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

function disabled_fill_clicks(){
	$('td a.filled').on('click', function(e){
		e.preventDefault();
	});
}

var d = $(document);
d.ready(function(){
	//alert("welcome");
	make_Tables();
	weekly_swp();
	disabled_fill_clicks();
});