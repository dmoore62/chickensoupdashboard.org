<?
function sanitize($in){
	$out = mysql_real_escape_string($in);
	$out = $in;
	return $out;
}

function format_phone($dirty){
	$syms = array("(", ")", "-");
	$clean = str_replace($syms, "", $dirty);
	return $clean;
}

function build_phone($clean){
	$dirty = "(".substr($clean, 0, 3).")".substr($clean, 3, 3)."-".substr($clean, 6, 4);
	return $dirty;
}
?>
