<?php
/*
乐农产品

*/
$menu_data=select('select * from menu where module="home"');

$banner_data=select('select * from banner');
// 分页
$page =isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :1;
$count = 3;
$start = ($page-1)*$count;
// 在prduct_cates表查找pid为0的数据
$product_cates=select('select * from product_cates where pid=0');
// 三目：
$cate_id=isset($_GET['cate_id'])?$_GET['cate_id']:$product_cates[0]['id'];
// 查produnct表 条件 cate_id是否等于$cate_id...然后倒序查找9个

$product=select("select * from product where cate_id=$cate_id and is_show=1 order by id desc limit 0,9");

$page_str = pageHome('product',$page,$count);
require'app/view/home/public/header.html';
require'app/view/home/pro/index.html';


