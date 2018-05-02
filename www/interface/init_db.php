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
signup int,
last_login_time datetime,
code varchar(16),
code_time datetime,
time datetime) DEFAULT CHARSET=utf8;
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
note text
) DEFAULT CHARSET=utf8;
EOF;
$sql_create_service = <<<EOF
create table services (
id int not null auto_increment key,
name text,
url text,
pic1 text,
pic2 text
) DEFAULT CHARSET=utf8;
EOF;

run_sql("drop table users");
run_sql("drop table orders");
run_sql($sql_create_users);
run_sql($sql_create_orders);
run_sql($sql_create_service);

//DEFAULT CHARSET=utf8;
echo "<h1>成功</h1>";
?>