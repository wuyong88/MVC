<?php


$page =isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :1;
$count = 5;
$start = ($page-1)*$count;

$product_cates = select("select * from product_cates");

$page_str = page('product_cates',$page,$count);


$data = getCates('product_cates');


require'app/view/admin/public/header.html';
require 'app/view/admin/product_cates/index.html';
require'app/view/admin/public/footer.html';
