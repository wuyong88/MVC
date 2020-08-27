<?php



$id = isset($_GET['id']) && is_numeric($_GET['id'])? $_GET['id'] : 0;   //empty是否存在
// var_dump($id);die;
if (!$id) {
 echo '<script>alert ("修改异常");window.location.href="index.php?m=1&c='.C.'&a='.A.'"</script>';
 exit;
}
$data = select("select * from touch_cates where id = $id");
$touch_cates= select("select * from touch_cates");
if($_POST){
			
			
           	$name  = $_POST['name'];;
	       	$pid  = $_POST['pid'];

    $res=update("update touch_cates set
     	name  		= '$name',
       pid   ='$pid'
 
        
          
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
require 'app/view/admin/touch_cates/save.html';
require'app/view/admin/public/footer.html';

