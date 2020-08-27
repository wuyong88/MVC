<?php

// $data=getCates('menu');
//查询分类树
$id = isset($_GET['id']) && is_numeric($_GET['id'])? $_GET['id'] : 0;   //empty是否存在
// var_dump($id);die;
if (!$id) {
 echo '<script>alert ("修改异常");window.location.href="index.php?m=1&c='.C.'&a='.A.'"</script>';
 exit;
}
$data = getCates("menu");
$menu = select("select * from menu where id = $id");
if($_POST){
  $name = $_POST['name'];
  $pid = $_POST['pid'];
  $module = $_POST['module'];
  $controller = $_POST['controller'];
  $action = $_POST['action'];
  $is_show = $_POST['is_show'];

// var_dump($_POST);die;

    $res=update("update menu set
     	name  		= '$name',
     	
        pid 	= '$pid',
        module 	= '$module',   
        controller 		= '$controller',
        action='$action',
        is_show 	= $is_show
    	where id 	= $id

    	");

if (!$data) {
 	echo '<script>alert ("修改失败");window.location.href="index.php?m=1&c='.C.'&a='.A.'&id='.$id.'"</script>';
 	exit;
 }

if (!$res) {
	echo '<script>alert ("修改失败");window.location.href="index.php?m=1&c='.C.'&a='.A.'&id='.$id.'"</script>';
	exit;
}

echo '<script>alert ("修改成功");window.location.href="index.php?m=1&c='.C.'&a=index"</script>';

    }


require'app/view/admin/public/header.html';
require 'app/view/admin/menu/save.html';
require'app/view/admin/public/footer.html';

