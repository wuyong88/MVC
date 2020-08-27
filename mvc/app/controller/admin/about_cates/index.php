<?php


$page =isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :1;
$count = 5;
$start = ($page-1)*$count;

$about_cates = select("select * from about_cates");

$page_str = page('about_cates',$page,$count);


$data = getCates('about_cates');


require'app/view/admin/public/header.html';
require 'app/view/admin/about_cates/index.html';
require'app/view/admin/public/footer.html';
