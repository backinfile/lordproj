<?php
require('run_sql.php');
require('generate_xls.php');
$sql = <<<EOF
select phone,upper,time from users;
EOF;
$data = run_sql($sql)['data'];
generate_xls($data,'用户',array("手机号","邀请人","创建时间"));
?>