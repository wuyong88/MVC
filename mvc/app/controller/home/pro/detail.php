<?php


$menu_data=select('select * from menu where module="home"');

$banner_data=('select * from banner');


// 在prduct_cates表查找pid为0的数据
$product_cates=select('select * from product_cates where pid=0');
// 三目：
$cate_id=isset($_GET['cate_id'])?$_GET['cate_id']:$product_cates[0]['id'];
// 查produnct表 条件 cate_id是否等于$cate_id...然后倒序查找9个

$product=select("select * from product where cate_id=$cate_id and is_show=1 order by id desc limit 1");


require'app/view/home/public/header.html';
require'app/view/home/pro/detail.html';