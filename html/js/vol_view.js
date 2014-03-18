function tab_swp(){
	$('ul.nav-tabs > li').on('click', function(){
		var cur = $(this);
		var tab = cur.attr('data-tab');
		if(!cur.hasClass('active')){
			$('ul.nav-tabs > li').each(function(){
					$(this).removeClass('active');
			});
			cur.addClass('active');
			$('.vol-view').each(function(){
				var $this = $(this);
				if($this.attr('id') != tab){
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

var d = $(document);
d.ready(function(){
	//alert("welcome");
	make_Tables();
	tab_swp();
});