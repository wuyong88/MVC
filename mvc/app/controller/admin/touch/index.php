<?php

/*
后台管理员控制器
*/

$data=select("select * from touch");
require'app/view/admin/public/header.html';
require 'app/view/admin/touch/index.html';
require'app/view/admin/public/footer.html';
