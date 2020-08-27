<?php
/*
乐农首页

*/
// 1.查询banner表


$menu_data=select('select * from menu where module="home"');

$banner_data=('select * from banner');
//查表展示左侧导航栏
$about_cate=select("select * from about_cates where pid=0");
//三目
$cat_id=isset($_GET['cat_id'])?($_GET['cat_id']):$about_cate[0]['id'];

$about_data=select("select * from about where cat_id=$cat_id and is_show=1 ");

require'app/view/home/public/header.html';

require'app/view/home/about/index.html';
