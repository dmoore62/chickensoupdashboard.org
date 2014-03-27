<?
function sanitize($in){
	require "../../config/mysql_header.php"; //The MYSQL Connection
	$out = mysql_real_escape_string($in); //Needs MYSQL Connection
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
