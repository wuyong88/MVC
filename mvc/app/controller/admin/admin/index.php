<?php

/*
后台管理员控制器
*/
$data = select("select n.*,c.name  from admin as n left join role as c on n.role_id=c.id");

$admin_data=select("select * from admin");

// $table_data=select("select admin.*,role.name from admin left join role on admin.role_id=role.id where admin.id=$id");


require'app/view/admin/public/header.html';
require 'app/view/admin/admin/index.html';
require'app/view/admin/public/footer.html';
