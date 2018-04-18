
<?php
function check_phone($str) {
	if (@preg_match("/^1\d{10}$/", $str)) return true;
	return false;
}
function check_digit($str) {
	if (@preg_match("/^\d{10}$/", $str)) return true;
	return false;
}
function get_post($key) {
	if (array_key_exists($key,$_POST)) {
		return $_POST[$key];
	}
	return null;
}
?>