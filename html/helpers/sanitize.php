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
?>
