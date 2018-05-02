<?php 
require("run_sql.php");
require("functions.php");
date_default_timezone_set('Asia/Shanghai');
if (get_post("request")) {
	$ret = array("state"=>false,"error"=>null,"data"=>array());
	$request = get_post("request");
	if ($request == "query") {
		do {
			$res = run_sql("select id,name,url,pic1,pic2 from services;");
			if (!isset($res['state'])) {
				$ret['error'] = '服务器错误';
				break;
			}
			$ret['data'] = $res['data'];
			$ret['state'] = true;
		} while(0);
		
	} else if ($request == "insert") {
		do {
			$name = get_post("name");
			$url = get_post("url");
			$res = run_sql("insert into services(name,url) values($name,$url);");
			if (!isset($res['state'])) {
				$ret['error'] = '服务器错误';
				break;
			}
			$ret['state'] = true;
		} while(0);
		
	} else if ($request == "delete") {
		$id = get_post("id");
		$res = run_sql("delete from services where id=$id;");
		if (isset($res['state'])) {
			$ret['state'] = true;
		} else {
			$ret['error'] = "删除失败";
		}
		
	} else {
		$ret['error'] = 'invalid request';
	}
	echo json_encode($ret,JSON_UNESCAPED_UNICODE);
}
?>