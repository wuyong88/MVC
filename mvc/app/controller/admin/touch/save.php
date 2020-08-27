<?php

/*
后台管理员控制器
*/

$id = isset($_GET['id']) && is_numeric($_GET['id'])? $_GET['id'] : 0;   //empty是否存在
// var_dump($id);die;
if (!$id) {
 echo '<script>alert ("修改异常");window.location.href="index.php?m=1&c='.C.'&a='.A.'"</script>';
 exit;
}
$data = select("select * from touch where id = $id");
// $touch_cates = select("select * from touch_cates");
if($_POST){
			$img_sql ='';
			if (isset($_FILES['file']) && $_FILES['file']['size']>0 ){
				$img_path =upload($_FILES['file']);
				$img_sql .="img = '$img_path'".',';
				$thumb_path =getThumb($img_path);
				$thumb_sql .="thumb = '$thumb_path'".',';

				/* 水印修改 */
				if($_POST['water']==1){
		              $water_path =getFonWater($img_path);
	                    }else if($_POST['water']==2){
		                   $water_path =getimgWater($img_path);
	                        }
			         }


			    if($_POST['water']==1){
		               $water_path =getFonWater($data[0]['img']);	
	                     }else if($_POST['water']==2){
		               $water_path =getimgWater($data[0]['img']);
	                  } 
		 
			$contact = $_POST['contact'];
            $gsname = $_POST['gsname'];
			  $gssite = $_POST['gssite'];
			  $zip = $_POST['zip'];    
			  $tel = $_POST['tel'];
			  $user = $_POST['user'];
			  $phone = $_POST['phone'];
			 

    $res=update("update touch set 
     	contact  		= '$contact',
     	 $img_sql   
        gsname 	= '$gsname',
        gssite 	= '$gssite',   
        zip 		= '$zip',
        user 	= $user,
         phone 	= $phone
        
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
require 'app/view/admin/touch/save.html';
require'app/view/admin/public/footer.html';


