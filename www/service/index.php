
<?php     
	$s = $_GET['s'];
	if ($s == 1) {
		header("Location: http://www.baidu.com"); 
	} else  {
		header("Location: http://www.souhu.com");
	}
?>