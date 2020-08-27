<?php




$banner = select("select * from banner");
if($_POST){
 
	$img_path =upload($_FILES['file']);  //上传原图
	
	$thumb_path = getThumb($img_path);  //缩略图
	// var_dump($_POST);die;
	if($_POST['water']==1){
  
  $water_path =getFonWater($img_path);
  // var_dump($water_path);die;
 }else if($_POST['water']==2){
  $water_path =getimgWater($img_path);
 }
  

  $title = $_POST['title'];
   
 
  $res=insert("insert into banner (title,img) values('$title','$img_path')") ;
  if (!$res) {
      echo '<script>alert("失败");window.location.href="index.php?m=1&c='.C.'&a='.A.'&id='.$id.'"</script>';
      exit;
    
    }

    echo '<script>alert("成功");window.location.href="index.php?m=1&c='.C.'&a=index"</script>';

}

require'app/view/admin/public/header.html';
require 'app/view/admin/banner/add.html';
require'app/view/admin/public/footer.html';
