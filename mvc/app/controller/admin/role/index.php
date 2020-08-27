<?php

/*
后台角色修改控制器
*/



/*
后台角色修改控制器
*/

$role_data=select('select * from role');

// $meun_data=select('select * from menu where id in(1,2,3)');
foreach ($role_data as $k => $v) {
	$id = $v['permission_id'];
	$meun_data=select("select name from menu where id in($id) and module='admin'");

	$role_data[$k]['menu_name'] = '';
	foreach ($meun_data as $key => $value) {
	    $role_data[$k]['menu_name'] .=$value['name'].'-';
	}
	$role_data[$k]['menu_name'] = rtrim($role_data[$k]['menu_name'],'-');
	// var_dump($role_data[$k]['menu_name']);die;
	}
	



require'app/view/admin/public/header.html';
require 'app/view/admin/role/index.html';
require'app/view/admin/public/footer.html';


