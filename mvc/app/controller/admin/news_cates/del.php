<?php
// 这是删除
$id = isset($_GET['id'])&&is_numeric($_GET['id']) ? $_GET['id']:'0';//is_numeric找到数字

if (!$id) {
 echo '<script>alert ("删除异常");window.location.href="index.php?m=1&c=news_cates&a=index"</script>';
 exit;
}

$res = delete("delete from news_cates where id=$id");//删除的sql语句

if (!$id) {
	echo '<script>alert ("删除失败");window.location.href="index.php?m=1&c=news_cates&a=index"</script>';
	exit;
}
echo '<script>alert ("删除成功");window.location.href="index.php?m=1&c=news_cates&a=index"</script>';

 

