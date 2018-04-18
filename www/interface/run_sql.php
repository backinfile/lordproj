<?php

function run_sql($sql) {
	$res = array('state'=>false,'data'=>array(),'error'=>null,'errno'=>null);
	$con = @mysqli_connect('localhost','root','123456','lord');
	if (mysqli_connect_errno()) {
		$res['error'] = mysqli_connect_error();
		$res['errno'] = mysqli_connect_errno();
		return $res;
	}
	$result = @mysqli_query($con, $sql);
	if (mysqli_errno($con)) {
		$res['error'] = mysqli_error($con);
		$res['errno'] = mysqli_errno($con);
		mysqli_close($con);
		return $res;
	}
	$res['state'] = true;
	if (!is_bool($result)) {
		$tmp = array();
		while ($r=mysqli_fetch_array($result,MYSQLI_ASSOC))
			$tmp[] = $r;
		$res['data'] = $tmp;
		//mysqli_free_result($result);
	}
	mysqli_close($con);
	return $res;
}
?>