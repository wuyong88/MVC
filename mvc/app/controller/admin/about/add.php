<?php



 $data = select("select n.*,c.name  from about as n left join about_cates as c on n.cat_id=c.id");

$about = select("select * from about_cates ");


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
  $content = strip_tags($_POST['content']);
  $title = $_POST['title'];
   $is_show = $_POST['is_show'];
   $cat_id = isset($_POST['cat_id']) ? 1:0;
   
 
  $res=insert("insert into about (content ,title,img,is_show,cat_id) values('$content ','$title','$img_path','$is_show','$cat_id')") ;
  if (!$res) {
      echo '<script>alert("失败");window.location.href="index.php?m=1&c='.C.'&a='.A.'&id='.$id.'"</script>';
      exit;
    
    }

    echo '<script>alert("成功");window.location.href="index.php?m=1&c='.C.'&a=index"</script>';

}

require'app/view/admin/public/header.html';
require 'app/view/admin/about/add.html';
require'app/view/admin/public/footer.html';
