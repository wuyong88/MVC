<?php

/*
后台管理员控制器
*/

$data=select("select * from banner");

require'app/view/admin/public/header.html';
require 'app/view/admin/banner/index.html';
require'app/view/admin/public/footer.html';
