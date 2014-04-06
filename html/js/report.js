function setup_datepicks(){
	$('.datepick').datepicker();
}

function build_table(){
	$('table.dynamic-styled').dataTable({ "aLengthMenu": [
            								[25, 50, 100, 200, -1],
            								[25, 50, 100, 200, "All"]
        									], 
										   "iDisplayLength" : -1 
										});
}

var d = $(document);

d.ready(function(){
	//alert('here');
	setup_datepicks();

	build_table();
});