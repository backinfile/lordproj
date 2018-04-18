<?php 
require("run_sql.php");
require("functions.php");
if (get_post("request")) {
	$ret = array("state"=>false,"error"=>null,"data"=>array());
	if (get_post("request") == "insertuser") do {
		$phone = get_post("phone");
		if (!$phone || !check_phone($phone)) {
			$ret['error'] = "手机号格式不正确";
			break;
		}
		$upper = get_post("upper");
		if ($upper && !check_phone($upper)) {
			if (check_digit($upper)) {
				
			} else if (check_phone($upper)) {
				
			}
			$ret['error'] = "邀请人格式不正确".$upper;
			break;
		}
		$phone = "'".$phone."'";
		if ($upper) {
			$upper = "'".$upper."'";
			// $sql_find = "select id from users where phone=".$upper.";";
		} else $upper = "null";
		
		$sql = "insert into users (phone,upper,time) values ("
			.$phone.",".$upper.",now());";
		$result = run_sql($sql);
		$ret['state'] = $result['state'];
		$ret['error'] = $result['error'];
		$ret['data'] = $result['data'];
	} while(0);
	
	echo json_encode($ret,JSON_UNESCAPED_UNICODE);
}
?>