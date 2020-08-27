<?php

/*
后台角色修改控制器
*/

$id = isset($_GET['id']) && is_numeric($_GET['id'])? $_GET['id'] : 0;   //empty是否存在
// var_dump($id);die;
if (!$id) {
 echo '<script>alert ("修改异常");window.location.href="index.php?m=1&c='.C.'&a='.A.'"</script>';
 exit;
}

$cur_data=select("select * from role where id=$id");
$cur_data[0]['permission_id']=explode(',', $cur_data[0]['permission_id']);


// 1.查询1级数据
$menu_data=select("select * from menu where module='admin' and pid=0");
// 2.循环一级数据：目的 根据一级id产训二级
foreach ($menu_data as $k => $v) {
	$id =$v['id'];
// 3.查询对应得的二级数据
	$data=select("select * from menu where pid=$id");
// 4.将二级数据放到对应以及数据内
	$menu_data[$k]['child']=$data;
	
}




require'app/view/admin/public/header.html';
require 'app/view/admin/role/save.html';
require'app/view/admin/public/footer.html';

