<?php

/*
控制器
*/






// // 提升sql
// // 提升逻辑，使用循环语句查询

$data = [];
// 查询一级
$f_data = select('select * from menu where pid=0');
foreach ($f_data as $k => $v) {
	$data[$v['id']] = $v;
	$id = $v['id'];
	$s_data = select("select * from menu where pid = $id");
	foreach ($s_data as $key => $value) {
		$value['parent_name'] = $v['name'];
		$data[$value['id']] = $value;
	}
}




require'app/view/admin/public/header.html';
require 'app/view/admin/menu/index.html';
require'app/view/admin/public/footer.html';
