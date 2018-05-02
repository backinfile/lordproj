<?php 
require("run_sql.php");
require("functions.php");
date_default_timezone_set('Asia/Shanghai');
if (get_post("request")) {
	$ret = array("state"=>false,"error"=>null,"data"=>array());
	$request = get_post("request");
	if ($request == "insertuser") {
		do {
			$phone = get_post("phone");
			$upper = get_post("upper");
			$code = get_post("code");
			if (!check_phone($phone)) {
				$ret['error'] = "手机号格式错误";
				break;
			}
			if (!check_digit($code)) {
				$ret['error'] = "邀请码格式错误";
				break;
			}
			$res = run_sql("select id,code,code_time,signup from users where phone=$phone;");
			if (!$res['state']) {
				$ret['error'] = "服务器出错";
				break;
			}
			if (empty($res['data'])) {
				$ret['error'] = "尚未发送验证码";
				break;
			}
			$id = $res['data'][0]['id'];
			$signup = $res['data'][0]['signup'];
			$code_time = strtotime($res['data'][0]['code_time']);
			$t = strtotime("-2 minutes");
			if ($code_time < $t) {
				$ret['error'] = "验证码已失效";
				break;
			}
			if ($code != $res['data'][0]['code']) {
				$ret['error'] = "验证码错误";
				break;
			}
			if ($signup == '1') {
				$res = run_sql("update users set last_login_time=now() where id=$id;");
				if (!$res['state']) {
					$ret['error'] = "服务器错误";
					break;
				}
				$ret['state'] = true;
				$ret['data'] = "login";
			} else {
				// check upper first
				if ($upper) {
					if (check_digit($upper)) {
						$res = run_sql("select phone from users where id=$upper;");
						if (!$res['state'] || empty($res['data'])) {
							$ret['error'] = "邀请人不存在";
							break;
						}
						$upper = $res['data'][0]['phone'];
					} else if (check_phone($upper)) {
						$res = run_sql("select phone from users where phone=$upper;");
						if (!$res['state'] || empty($res['data'])) {
							$ret['error'] = "邀请人不存在";
							break;
						}
					} else {
						$ret['error'] = "邀请人格式不正确";
						break;
					}
				} else {
					$upper = "null";
				}
				$res = run_sql("update users set upper=$upper,signup=1,last_login_time=now(),time=now() where phone=$phone;");
				$err = $res['error'];
				if (!$res['state']) {
					$ret['error'] = "服务器错误$err";
					break;
				}
				$ret['state'] = true;
				$ret['data'] = "signup";
			}
		} while(0);
		
	} else if ($request == "queryorder") {
		$phone = get_post("phone");
		if (!check_phone($phone)) {
			$ret['state'] = false;
			$ret['error'] = "phone error";
		} else {
			$sql = "select id,phone,service,state,is_rewarded,reward,time,last_time,note,value ".
					"from orders where phone=$phone;";
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
			$sql = "select o.id,o.phone,o.service,o.state,o.is_rewarded,o.reward,o.time,o.last_time,o.note,o.value".
					" from orders o,users u where u.upper=".$phone." and o.phone=u.phone;";
			$result = run_sql($sql);
			$ret['state'] = $result['state'];
			$ret['error'] = $result['error'];
			$ret['data'] = $result['data'];
		}
	} else if ($request == "queryorder3") {
		$id = get_post("id");
		if (!check_digit($id)) {
			$ret['state'] = false;
			$ret['error'] = "id error";
		} else {
			$sql = "select id,phone,service,state,is_rewarded,reward,time,last_time,note,value ".
					"from orders where id=".$id.";";
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
			if (!$service) {
				$service = "null";
			} else {
				$service = "'".$service."'";
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
			else $reward = "'".$reward."'";
			$note = get_post("note");
			if (!$note) $note = "null";
			else $note = "'".$note."'";
			$value = get_post("value");
			if (!$value) $value = "null";
			else $value = "'".$value."'";
			$sql = "insert into orders(phone,service,state,is_rewarded,reward,time,last_time,note,value)".
					" values(".$phone.",".$service.",".$state.",".$is_rewarded.",".$reward.
					",now(),now(),".$note.",".$value.");";
			$result = run_sql($sql);
			$ret['sql'] = $sql;
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
			if (!$service) {
				$service = "null";
			} else {
				$service = "'".$service."'";
			}
			$state = get_post("state");
			if (!check_digit($state)) {
				$ret['state'] = false;
				$ret['error'] = "state error";
				break;
			}
			$id = get_post("id");
			if (!check_digit($id)) {
				$ret['state'] = false;
				$ret['error'] = "id error";
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
			else $reward = "'".$reward."'";
			$note = get_post("note");
			if (!$note) $note = "null";
			else $note = "'".$note."'";
			$value = get_post("value");
			if (!$value) $value = "null";
			else $value = "'".$value."'";
			$sql = "update orders set phone=".$phone.",service=".$service.",state=".$state.
					",is_rewarded=".$is_rewarded.",reward=".$reward.",last_time=now(),note=".$note.
					",value=".$value." ".
					"where id=".$id.";";
			$ret['sql'] = $sql;
			$result = run_sql($sql);
			$ret['state'] = $result['state'];
			$ret['error'] = $result['error'];
		} while (0);
	} else if ($request == "querylaststate") {
		$phone = get_post("phone");
		if (!check_phone($phone)) {
			$ret['state'] = false;
			$ret['error'] = "phone error";
		} else {
			$sql = "select state,id from orders where phone=".$phone." order by time desc limit 1;";
			$result = run_sql($sql);
			$ret['state'] = $result['state'];
			$ret['error'] = $result['error'];
			$ret['data'] = $result['data'];
		}
	} else if ($request == "queryid") {
		$phone = get_post("phone");
		if (!check_phone($phone)) {
			$ret['state'] = false;
			$ret['error'] = "phone error";
		} else {
			$sql = "select id from users where phone=".$phone." order by time desc limit 1;";
			$result = run_sql($sql);
			$ret['state'] = $result['state'];
			$ret['error'] = $result['error'];
			$ret['data'] = $result['data'];
		}
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