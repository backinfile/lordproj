
<?php
function check_phone($str) {
	if (@preg_match("/^1\d{10}$/", $str)) return true;
	return false;
}
function check_digit($str) {
	if (@preg_match("/^\d{1,10}$/", $str)) return true;
	return false;
}
function get_post($key) {
	if (array_key_exists($key,$_POST)) {
		return ($_POST[$key]).trim();
	}
	return null;
}
function check_sql_exist($sql, $key=null) {
	$result = run_sql($sql);
	if (!($result['state'] && $result['data'])) return false;
	if ($key) return $result['data'][0][$key];
	return true;
}
?>