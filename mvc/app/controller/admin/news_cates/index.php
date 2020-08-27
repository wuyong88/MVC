<?php

// $data = select("select * from news ");

// 设置时区
// data_
// Y四位年 d天
// 参数1：格式化的字符  参数2：时间戳

// 获取当前时间
// echo date(Y-m-d)
//mb_strlen(变量，编码)>要截取的长度  //获取字符串长度
//mb_substr(变量，下标位置，个数，编码)截取字符串
// foreach ($data as $k => $v) {
// $data[$k]['is_show'] = $v['is_show'] ? '是'：'否';
// $v['cTIME']
// }
// $data = select("select * from news_cates ");
//  foreach ($data as $k => $v) {
//  	$data[$k]['cate_name'] = $v['name'] ? $v['name']:'暂无类型';//类型

// }
$page =isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :1;
$count = 5;
$start = ($page-1)*$count;

$news_cates = select("select * from news_cates");

$page_str = page('news_cates',$page,$count);


$data = getCates('news_cates');



require'app/view/admin/public/header.html';
require 'app/view/admin/news_cates/index.html';
require'app/view/admin/public/footer.html';





