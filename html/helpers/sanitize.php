<?
function sanitize($in){
	$out = mysql_real_escape_string($in);
	return $out;
}
?>
