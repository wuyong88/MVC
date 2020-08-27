<?php
/*
乐农首页

*/
// 1.查询导航--菜单表前台数据
$menu_data=select('select * from menu where module="home"');

$banner_data=('select * from banner');
//关于我们数据
$about_data = select('select * from about where id=31');

// 产品数据
$product_data = select('select * from product order by id desc  limit 6');


// 新闻数据
$news_data = select('select * from news  where cate_id=2 limit 5');
$sub_len=70;
foreach ($news_data as $k => $v) {
$news_data[$k]['cTime']=date('Y-m-d',$news_data[$k]['cTime']);

$news_data[$k]['content']=strip_tags( $news_data[$k]['content']);
// 判断长度
if($k!=0){
  $sub_len=60;
}
if(mb_strlen( $news_data[$k]['content'],'utf-8')>$sub_len){
	// 截取内容的长度
     mb_substr( $news_data[$k]['content'], 0,$sub_len,'utf-8').'......';
  
}
}

// 联系我们数据
$touch_data = select('select * from touch order by id desc limit 1');








require'app/view/home/public/header.html';
require'app/view/home/index/index.html';