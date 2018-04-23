<?php
require('run_sql.php');
require('generate_xls.php');
$sql = <<<EOF
select id,phone,upper,time from users;
EOF;
$data = run_sql($sql)['data'];
if (empty($data)) echo "<h1>没有数据！</h1>";
else generate_xls($data,'用户',array("邀请码","手机号","邀请人","创建时间"));
?>