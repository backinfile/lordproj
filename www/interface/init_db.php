<?php
require("run_sql.php");

$sql_create_db = <<<EOF
CREATE DATABASE lord
CHARACTER SET 'utf8'
COLLATE 'utf8_general_ci';
EOF;
$sql_create_users = <<<EOF
create table users (
id int not null auto_increment key,
phone varchar(32) not null unique key,
upper varchar(32),
time datetime not null) DEFAULT CHARSET=utf8;
EOF;
$sql_create_orders = <<<EOF
create table orders (
id int not null auto_increment key,
phone varchar(32) not null,
service text not null,
state int not null,
time datetime not null,
last_time datetime not null,
is_rewarded int not null,
reward text,
value text,
note text) DEFAULT CHARSET=utf8;
EOF;
run_sql("drop table users");
run_sql("drop table orders");
run_sql($sql_create_users);
run_sql($sql_create_orders);

//DEFAULT CHARSET=utf8;
?>