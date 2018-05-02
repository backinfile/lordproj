<?php
/* if (isset($_FILES["file"])) {
	$name = $_FILES["file"]["name"];
	echo '{"q":$name}';
} else {
	echo '{}';file_get_contents("php://input")
}
*/
$ret = array('state'=>false, 'error'=>null, 'data'=>array());
do {
	if (isset($_FILES['file']) && isset($_FILES['file']['tmp_name'])) {
		if ($_FILES["file"]["error"] > 0) {
			$ret['error'] = $_FILES["file"]["error"];
			break;
		}
		if (file_exists('../img/'.$_FILES['file']['name'])) {
			$ret['error'] = "图片已存在";
		} else {
			move_uploaded_file($_FILES['file']['tmp_name'], '../img/'.$_FILES['file']['name']);
			$ret['state'] = true;
			$ret['data']['url'] = '127.0.0.1/img/'.$_FILES['file']['name'];
		}
	}
} while(0);
// $ret['files'] = $_FILES;
echo json_encode($ret,JSON_UNESCAPED_UNICODE);
?>