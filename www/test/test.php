<?php
/* $con = new mysqli('localhost','root','123456','lord');
if ($con->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
$sql_create_users = <<<EOF
create table users (
id int not null auto_increment key,
phone bigint not null,
upper bigint,
pwd varchar(255),
time datetime not null,
unique(phone)
);
EOF;
$sql_create_orders = <<<EOF
create table orders (
id int not null auto_increment key,
phone bigint not null,
servise int not null,
state int not null,
time datetime not null,
is_rewarded int not null,
reward text,
note text
);
EOF;
$sql_insert_user = <<<EOF
insert into users
(phone, upper, pwd, time)
values
(12345678910, null, null, now());
EOF;
$sql_query_user = <<<EOF
select phone,upper,time from users;
EOF;




// if (!$con->query($sql_insert_user)) {
	// echo "error{".$con->error.'}';
// }
$result = $con->query($sql_query_user);
if (!$con->error) {
	var_dump($result);
	if ($result->num_rows>0) {
		while ($row=$result->fetch_assoc()) {
			echo $row['phone'].'<br>';
		}
	}
}
$con->close(); */
/* $sql = <<<EOF
insert into users
(phone, upper, pwd, time)
values
(12345678917, 12345678913, null, now());
EOF; */
/* $sql = <<<EOF
select phone,upper,time from users;
EOF;
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
echo json_encode(run_sql($sql)); */
?>








