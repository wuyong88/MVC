<?php
/*
后台管理员控制器
*/ 

$id = isset($_GET['id'])&&is_numeric($_GET['id']) ? $_GET['id']:'0';//is_numeric找到数字
if (!$id) {
 echo '<script>alert ("删除异常");window.location.href="index.php?m=1&c=touch&a=index"</script>';
 exit;
}

$res = delete("delete from touch where id=$id");//删除的sql语句
if (!$id) {
	echo '<script>alert ("删除失败");window.location.href="index.php?m=1&c=touch&a=index"</script>';
	exit;
}
echo '<script>alert ("删除成功");window.location.href="index.php?m=1&c=touch&a=index"</script>';
require'app/view/admin/public/header.html';
require 'app/view/admin/touch/del.html';
require'app/view/admin/public/footer.html';

 
 

