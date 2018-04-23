<?php
require('run_sql.php');
require('generate_xls.php');
$sql = <<<EOF
select id,phone,value,service,state,is_rewarded,reward,time,last_time,note 
from orders;
EOF;
$data = run_sql($sql)['data'];
if (empty($data)) echo "<h1>没有数据！</h1>";
else generate_xls($data,'账单',array("id","手机号","金额","服务","状态","是否已返利","返利金额","创建时间","上次更新","备注"));
?>