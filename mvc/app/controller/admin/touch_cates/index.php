<?php


$page =isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :1;
$count = 5;
$start = ($page-1)*$count;

$touch_cates = select("select * from touch_cates");

$page_str = page('touch_cates',$page,$count);


$data = getCates('touch_cates');


require'app/view/admin/public/header.html';
require 'app/view/admin/touch_cates/index.html';
require'app/view/admin/public/footer.html';
