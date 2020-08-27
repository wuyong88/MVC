<?php

/*
后台管理员控制器
*/

$data=select("select * from content");
require'app/view/admin/public/header.html';
require 'app/view/admin/content/index.html';
require'app/view/admin/public/footer.html';
