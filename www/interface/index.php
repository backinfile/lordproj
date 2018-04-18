<?php
require('run_sql.php');
require('generate_xls.php');
$sql = <<<EOF
select * from users;
EOF;
generate_xls(run_sql($sql)['data'],'用户');
?>