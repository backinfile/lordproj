<?php 
require("run_sql.php");
require("functions.php");
if (get_post("request")) {
	$ret = array("state"=>false,"error"=>null,"data"=>array());
	$request = get_post("request");
	if ($request == "insertuser") { 
		do {
			$phone = get_post("phone");
			if (!$phone || !check_phone($phone)) {
				$ret['error'] = "手机号格式不正确";
				break;
			}
			$upper = get_post("upper");
			if ($upper) {
				if (check_digit($upper)) {
					die("in");
					$sql = "select phone from users where id='".$upper."';";
					$upper = check_sql_exist($sql,'phone');
					if (!$upper) {
						$ret['error'] = "邀请人不存在";
						break;
					}
				} else if (check_phone($upper)) {
					$sql = "select id from users where phone='".$upper."';";
					if (!check_sql_exist($sql)) {
						$ret['error'] = "邀请人不存在";
						break;
					}
				} else {
					$ret['error'] = "邀请人格式不正确";
					break;
				}
			}
			$phone = "'".$phone."'";
			if ($upper) {
				$upper = "'".$upper."'";
			} else $upper = "null";
			
			$sql = "insert into users (phone,upper,time) values ("
				.$phone.",".$upper.",now());";
			$result = run_sql($sql);
			$ret['state'] = $result['state'];
			$ret['error'] = $result['error'];
			$ret['data'] = $result['data'];
		} while(0);
	} else if ($request == "queryorder") {
		$phone = get_post("phone");
		if (!check_phone($phone)) {
			$ret['state'] = false;
			$ret['error'] = "phone error";
		} else {
			$sql = "select id,phone,service,state,is_rewarded,reward,time,last_time,note,value ".
					"from orders where phone=".$phone.";";
			$result = run_sql($sql);
			$ret['state'] = $result['state'];
			$ret['error'] = $result['error'];
			$ret['data'] = $result['data'];
		}
	} else if ($request == "queryorder2") {
		$phone = get_post("phone");
		if (!check_phone($phone)) {
			$ret['state'] = false;
			$ret['error'] = "phone error";
		} else {
			$sql = "select o.phone,o.service,o.state,o.is_rewarded,o.reward,o.time,o.last_time,o.note".
					" from orders o,users u where u.upper=".$phone." and o.phone=u.phone;";
			$result = run_sql($sql);
			$ret['state'] = $result['state'];
			$ret['error'] = $result['error'];
			$ret['data'] = $result['data'];
		}
	} else if ($request == "insertorder") {
		do {
			$phone = get_post("phone");
			if (!check_phone($phone)) {
				$ret['state'] = false;
				$ret['error'] = "phone error";
				break;
			}
			$service = get_post("service");
			if (!check_digit($service)) {
				$ret['state'] = false;
				$ret['error'] = "service error";
				break;
			}
			$state = get_post("state");
			if (!check_digit($state)) {
				$ret['state'] = false;
				$ret['error'] = "state error";
				break;
			}
			$is_rewarded = get_post("is_rewarded");
			if (!check_digit($is_rewarded)) {
				$ret['state'] = false;
				$ret['error'] = "is_rewarded error";
				break;
			}
			$reward = get_post("reward");
			if (!$reward) $reward = "null";
			$note = get_post("note");
			if (!$note) $note = "null";
			$sql = "insert into orders(phone,service,state,is_rewarded,reward,time,last_time,note)".
					" values(".$phone.",".$service.",".$state.",".$is_rewarded.",".$reward.
					",now(),now(),".$note.");";
			$result = run_sql($sql);
			$ret['state'] = $result['state'];
			$ret['error'] = $result['error'];
		} while (0);
	} else if ($request == "updateorder") {
		do {
			$phone = get_post("phone");
			if (!check_phone($phone)) {
				$ret['state'] = false;
				$ret['error'] = "phone error";
				break;
			}
			$service = get_post("service");
			if (!check_digit($service)) {
				$ret['state'] = false;
				$ret['error'] = "service error";
				break;
			}
			$state = get_post("state");
			if (!check_digit($state)) {
				$ret['state'] = false;
				$ret['error'] = "state error";
				break;
			}
			$is_rewarded = get_post("is_rewarded");
			if (!check_digit($is_rewarded)) {
				$ret['state'] = false;
				$ret['error'] = "is_rewarded error";
				break;
			}
			$reward = get_post("reward");
			if (!$reward) $reward = "null";
			$note = get_post("note");
			if (!$note) $note = "null";
			$sql = "update orders set phone=".$phone.",service=".$service.",state=".$state.
					",is_rewarded=".$is_rewarded.",reward=".$reward.",last_time=now(),note=".$note.");";
			$result = run_sql($sql);
			$ret['state'] = $result['state'];
			$ret['error'] = $result['error'];
		} while (0);
	} 
	/* else if ($request == "login") {
		$phone = get_post("phone");
		$sql = "select id from users where phone=".$phone.";";
		if (!check_phone($phone) || !check_sql_exist($sql)) {
			$ret['state'] = false;
			$ret['error'] = "phone error";
		} else {
			$_SESSION['phone'] = true;
			$ret['state'] = true;
		}
	} */
	echo json_encode($ret,JSON_UNESCAPED_UNICODE);
} else {
	
	//echo json_encode(array('s'=>'end'));exit;
}
?>