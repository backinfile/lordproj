<?php
require('run_sql.php');
require('generate_xls.php');
$sql = <<<EOF
select id,phone,service,state,is_rewarded,reward,time,last_time,note 
from orders;
EOF;
$data = run_sql($sql)['data'];
generate_xls($data,'用户',array("id","手机号","服务","状态","是否已返利","返利金额","创建时间","上次更新","备注"));
?>