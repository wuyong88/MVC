<?php

/*
*cms系统入口文件
*cms系统采用mvc模式，是一款亲良机框架
*优势：
   采用单入口，安全
   前后台分离
*author：wy
*date  ：2020/5/13
*/


//加载控制器
// require'app/controller/admin/login/login.php';

//经过观察，发现前后台变化
// 发现模块化
// 发现控制器文件变化
// 将变化的数据用变量代替
// $m 模块    --强调前台
// $c 控制器  --文件上面的文件夹
// $a 操作    --表示文件

// http://localhost/mvc/index.php?m=1&c=login&a=login

$module     = isset($_GET['m'])? 'admin':'home';
$controller = isset($_GET['c'])? $_GET['c'] : 'index';
$action     = isset($_GET['a'])? $_GET['a'] : 'index';

define('M',$module);
define('C',$controller);
define('A',$action);
// require'app/controller/admin/index/index.php';

// 开启session
session_start();

// 设置时区
date_default_timezone_set('Asia/Shanghai');

if(!isset($_SESSION['user_info']) && C!='login'){
	header('location:index.php?m=1&c=login&a=login');
}

require 'lib/database.php';
require 'lib/function.php';

require 'app/controller/'.M.'/'.C.'/'.A.'.php';



// echo'这是入口';
// echo'mvc index.php';
// include 'app/controller/index.php';