<?php
// 这是删除
$data = select("select * from menu ");
$id=$_GET['id'];
$find=select("select * from menu where pid='$id' ");
if(!$find){
     $res = delete("delete from menu where id=$id");//删除的sql语句
     echo '<script>alert ("删除成功");window.location.href="index.php?m=1&c=menu&a=index"</script>';
}echo '<script>alert ("删除失败：有子集");window.location.href="index.php?m=1&c=menu&a=index"</script>';

