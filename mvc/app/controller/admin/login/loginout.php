<?php
// 推出控制器
// echo'zheshi tuichu';
// 销毁session信息
session_destroy();

header('location:index.php?m=1&c=login&a=login');


// create table user1(
//    id int unsigned auto_increment primary key, 
//    username varchar(20) not null,
//    password varchar(32) not null,
//    sex bit default 1,
//    tel varchar(11)  unique ,
//    add_time time,
//    money decimal,
//    is_show int unsigned 
//    ) 

// insert into user1 (id,username,sex,tel,)values(1,'王五','123456','男','18799111085');