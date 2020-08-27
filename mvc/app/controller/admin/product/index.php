<?php

// $data = select("select * from product ");

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
$page =isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :1;
$count = 5;
$start = ($page-1)*$count;

$data = select("select n.*,c.name from product as n left join product_cates as c on n.cate_id=c.id order by id desc limit $start,$count");

 foreach ($data as $k => $v) {
 	$data[$k]['cate_name'] = $v['name'] ? $v['name']:'暂无类型';//类型
 	
	if (mb_strlen($v['content'],'utf-8')>2) {
		$data[$k]['content'] = mb_substr($v['content'], 0,2,'utf-8').'...';
	}//内容

	$data[$k]['ctime'] = date('Y-m-d',$v['ctime']);//时间格式修改

	$data[$k]['is_show'] = $v['is_show'] ? '是':'否';//是否发布
}
$page_str = page('product',$page,$count);


require'app/view/admin/public/header.html';
require 'app/view/admin/product/index.html';
require'app/view/admin/public/footer.html';
