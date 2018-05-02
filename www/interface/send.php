<?php

require 'vendor/autoload.php';
require("run_sql.php");
require("functions.php");
use Qcloud\Sms\SmsSingleSender;
date_default_timezone_set('Asia/Shanghai');
$code = rand(1000, 9999);
if (get_post("request") == "send") {
	do {
		$ret = array("state"=>false,"error"=>null,"data"=>array());
		$appid = 1400085730;
		$appkey = "5dd0ce901528d2a9397cae982b99f07f";
		$phone = get_post("phone");
		
		if (!check_phone($phone)) {
			$ret["error"] = "手机号格式不正确";
			break;
		}
		$res = run_sql('select id,signup,code_time from users where phone='.$phone.';');
		if (!$res['state']) {
			$ret['error'] = "服务器错误";
			break;
		}
		if (empty($res['data'])) {
			$res = run_sql('insert into users (phone,code,code_time,signup) values ('.
							$phone.','.$code.',now(),0);');
			if (!$res['state']) {
				$ret['error'] = '服务器错误';
				break;
			}
			$ret['state'] = true;
		} else {
			$code_time = strtotime($res['data'][0]['code_time']);
			$t = strtotime("-1 minutes");
			if ($code_time > $t) {
				$ret['error'] = "操作过于频繁";
				break;
			}
			$id = $res['data'][0]['id'];
			$res = run_sql('update users set code='.$code.',code_time=now() where id='.$id.';');
			if (!$res['state']) {
				$ret['error'] = '服务器错误';
				break;
			}
			$ret['state'] = true;
		}
	} while (0);
	if ($ret['state']) {
		$sender = new SmsSingleSender($appid, $appkey);
		$result = @$sender->send(0, "86", $phone,
			"【煋云科技】".$code."为您的登录验证码，请于2分钟内填写。如非本人操作，请忽略本短信。", "", "");
		if (isset($result)) {
			$result = json_decode($result, true);
			if (isset($result['result']) && $result['result'] == 0) {
				$ret['state'] = true;
			} else {
				$ret['state'] = false;
				$ret['error'] = "短信发送失败";
			}
		} else {
			$ret['state'] = false;
			$ret['error'] = "短信发送失败";
		}
	}
	echo json_encode($ret,JSON_UNESCAPED_UNICODE);
}

/* try {
	$sender = new SmsSingleSender($appid, $appkey);
	$result = $sender->send(0, "86", $phoneNumber1,
		"【煋云科技】".."为您的登录验证码，请于2分钟内填写。如非本人操作，请忽略本短信。", "", "");
	$rsp = json_decode($result);
	echo $result;
} catch(\Exception $e) {
	echo var_dump($e);
} */
?>