<?php
/*
乐农新闻中心
$page =isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :1;
$count = 5;
$start = ($page-1)*$count;
$page_str = page('news',$page,$count);
*/
// 1.查询导航--菜单表前台数据
$menu_data=select('select * from menu where module="home"');
// banner图
$banner_data=select('select * from banner');


// 查news_cates表找到pid=0的数据
$news_cate=select("select * from news_cates where pid=0");

// var_dump($news_cate)die;
// 用三目运算符判断样式  判断cate_id
$cate_id=isset($_GET['cate_id'])?($_GET['cate_id']):$news_cate[0]['id'];


// 查news表 条件 cate_id是否等于$cate_id...然后倒序查找三个
$news_data=select("select * from news where cate_id=$cate_id and is_show=1 order by id desc limit 0,3");

// $news_data[$k]['ctime']=date('Y-m-d',$news_data[$k]['ctime']);



require'app/view/home/public/header.html';
require'app/view/home/news/index.html';